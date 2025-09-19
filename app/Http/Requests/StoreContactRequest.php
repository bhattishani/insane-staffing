<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', new \App\Rules\NotTempEmail],
            'phone' => ['required', 'string', new \App\Rules\ValidPhoneNumber],
            'inquiry_type' => 'required|in:Business,Job Seeker',
            'message' => 'required|string|max:5000',
            'g-recaptcha-response' => 'required|recaptcha',
            'device_fingerprint' => 'required|string'
        ];

        // Add CV validation only for Job Seekers
        if ($this->input('inquiry_type') === 'Job Seeker') {
            $rules['cv_file'] = 'nullable|file|mimes:pdf|max:5120'; // 5MB in KB
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter your name.',
            'email.required' => 'Please enter your email address.',
            'phone.required' => 'Please enter your phone number.',
            'inquiry_type.required' => 'Please select an inquiry type.',
            'message.required' => 'Please enter your message.',
            'g-recaptcha-response.required' => 'Please complete the reCAPTCHA.',
            'g-recaptcha-response.recaptcha' => 'Please reload the page and try again.',
            'device_fingerprint.required' => 'Device fingerprint is required.',
            'cv_file.file' => 'CV must be a valid file.',
            'cv_file.mimes' => 'CV must be a PDF file.',
            'cv_file.max' => 'CV file size must be less than 5MB.'
        ];
    }
}
