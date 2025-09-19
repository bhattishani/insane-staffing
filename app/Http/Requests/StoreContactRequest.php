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

        // Add attachment validation only for Job Seekers
        if ($this->input('inquiry_type') === 'Job Seeker') {
            $rules['attachment_files'] = 'nullable|array|max:5';
            $rules['attachment_files.*'] = 'file|mimes:pdf,doc,docx,jpg,jpeg,png,gif,bmp,webp,mp4,avi,mov,wmv,flv,webm,xls,xlsx,csv|max:102400'; // 100MB in KB
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
            'attachment_files.array' => 'Attachments must be an array of files.',
            'attachment_files.max' => 'Maximum 5 files allowed.',
            'attachment_files.*.file' => 'Each attachment must be a valid file.',
            'attachment_files.*.mimes' => 'Allowed file types: PDF, Word, Images, Videos, Excel/CSV.',
            'attachment_files.*.max' => 'Each file must be less than 100MB.'
        ];
    }
}
