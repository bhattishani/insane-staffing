<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NotTempEmail implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $tempEmailDomains = [
            'tempmail.com',
            'temp-mail.org',
            'guerrillamail.com',
            'disposablemail.com',
            '10minutemail.com',
            'throwawaymail.com'
        ];

        $domain = substr(strrchr($value, "@"), 1);

        if (in_array(strtolower($domain), $tempEmailDomains)) {
            $fail('The :attribute cannot be a temporary email address.');
        }
    }
}
