<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Log;

class RecaptchaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        \Validator::extend('recaptcha', function ($attribute, $value, $parameters, $validator) {
            $client = new \GuzzleHttp\Client();
            $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
                'form_params' => [
                    'secret' => config('recaptcha.secret_key'),
                    'response' => $value,
                    'remoteip' => request()->ip()
                ]
            ]);

            $body = json_decode((string) $response->getBody());
            Log::info('reCAPTCHA response: ' . json_encode($body));
            return $body->success;
        });
    }
}
