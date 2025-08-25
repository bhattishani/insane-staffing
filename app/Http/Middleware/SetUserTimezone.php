<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Torann\GeoIP\Facades\GeoIP;

class SetUserTimezone
{
    public function handle($request, Closure $next)
    {
        $timezone = null;

        // 1. Preferred: Cloudflare-provided timezone header
        if ($request->headers->has('cf-timezone')) {
            $timezone = $request->header('cf-timezone');
        }

        // 2. Cloudflare country → map to timezone
        if (!$timezone && $request->headers->has('cf-ipcountry')) {
            $country = $request->header('cf-ipcountry');
            $timezone = $this->mapCountryToTimezone($country);
        }

        // 3. Cloudflare connecting IP → try geo lookup (requires a geo service)
        if (!$timezone && $request->headers->has('cf-connecting-ip')) {
            $ip = $request->header('cf-connecting-ip');
            $timezone = $this->geoIpLookup($ip);
        }

        // 4. Fall back: Use Laravel app default
        if (!$timezone) {
            $timezone = config('app.timezone', 'UTC');
        }

        // ✅ Validate timezone
        if (!in_array($timezone, timezone_identifiers_list())) {
            $timezone = config('app.timezone', 'UTC');
        }
        // Apply timezone globally
        Config::set('app.timezone', $timezone);
        date_default_timezone_set($timezone);

        // Optional: log for debugging
        Log::info("User timezone set to: {$timezone}");

        return $next($request);
    }

    private function mapCountryToTimezone(string $country): ?string
    {
        $map = [
            'CA' => 'America/Toronto', // Canada default
            'US' => 'America/New_York',
            'IN' => 'Asia/Kolkata',
            // add more mappings as needed
        ];

        return $map[$country] ?? null;
    }

    private function geoIpLookup(string $ip): ?string
    {
        try {
            // If using torann/geoip or stevebauman/location
            if (class_exists(GeoIP::class)) {
                $record = GeoIP::getLocation($ip);
                return $record->timezone ?? null;
            }
        } catch (\Exception $e) {
            Log::warning("GeoIP lookup failed for {$ip}: " . $e->getMessage());
        }

        return null;
    }
}
