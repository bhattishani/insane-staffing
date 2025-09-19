<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Jobs\ContactSubmissionJob;
use App\Models\Contact;
use Arr;
use Illuminate\Support\Facades\Http;
use Log;

class ContactController extends Controller
{
    public function store(StoreContactRequest $request)
    {
        // Check for multiple submissions from same fingerprint
        $recentSubmission = Contact::where('device_fingerprint', $request->device_fingerprint)
            ->where('created_at', '>', now()->subMinutes(15))
            ->latest()
            ->first();

        if ($recentSubmission) {
            $expiresAt = $recentSubmission->created_at->addMinutes(15);
            $remainingMinutes = now()->diffInMinutes($expiresAt, true);
            $remainingSeconds = now()->diffInSeconds($expiresAt, true);

            return response()->json([
                'message' => "Please wait {$remainingMinutes} minutes "
                        . "and " . ($remainingSeconds % 60) . " seconds before submitting again.",
            ], 429);
        }


        // Get Cloudflare headers
        $ip = $request->header('CF-Connecting-IP') ?? $request->ip();
        $country = $request->header('CF-IPCountry');
        $city = $request->header('CF-IPCity');

        // Handle CV file upload
        $cvPath = null;
        if ($request->hasFile('cv_file') && $request->file('cv_file')->isValid()) {
            $file = $request->file('cv_file');

            // Validate file type and size
            if ($file->getClientMimeType() !== 'application/pdf') {
                return response()->json([
                    'message' => 'CV file must be a PDF.',
                    'errors' => ['cv_file' => ['CV file must be a PDF.']],
                ], 422);
            }

            if ($file->getSize() > 5 * 1024 * 1024) { // 5MB
                return response()->json([
                    'message' => 'CV file size must be less than 5MB.',
                    'errors' => ['cv_file' => ['CV file size must be less than 5MB.']],
                ], 422);
            }

            // Generate unique filename
            $filename = 'cv_'.time().'_'.uniqid().'.pdf';

            // Store file in storage/app/public/cvs directory
            $cvPath = $file->storeAs('cvs', $filename, 'public');
        }

        // Check spam score with Gemini API
        $spamScore = $this->checkSpamScore($request->validated());

        // Create contact
        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'inquiry_type' => $request->inquiry_type,
            'message' => $request->message,
            'cv_path' => $cvPath,
            'ip_address' => $ip,
            'country' => $country,
            'city' => $city,
            'device_fingerprint' => $request->device_fingerprint,
            'spam_score' => $spamScore,
        ]);

        // Dispatch email job
        ContactSubmissionJob::dispatch($contact);

        return response()->json([
            'message' => 'Thank you for your message. We will get back to you shortly.',
        ]);
    }

    private function checkSpamScore(string|array $data): float
    {
        if (is_array($data)) {
            $message = Arr::except($data, ['g-recaptcha-response', 'device_fingerprint']);
            $message = json_encode($message);
        } else {
            $message = $data;
        }
        $apiKey = env('GEMINI_API_KEY');
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$apiKey}", [
            'contents' => [
                'parts' => [
                    [
                        'text' => "Please analyze this form data and provide a spam score between 0 and 1, where 0 is definitely not spam and 1 is definitely spam. Only respond with a number between 0 and 1. Form: $message",
                    ],
                ],
            ],
        ]);

        if ($response->successful()) {
            $response = Arr::get($response->json(), 'candidates.0.content.parts.0.text', 0);
            $score = floatval($response);
            $responseLog = json_encode($response);
            Log::info("Spam score for contact form submission: {$responseLog}");

            return max(0, min(1, $score));
        }

        return 0;
    }
}
