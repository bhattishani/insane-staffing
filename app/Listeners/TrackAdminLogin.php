<?php

namespace App\Listeners;

use App\Models\AdminLoginTrack;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class TrackAdminLogin
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(Login $event): void
    {
        $user = $event->user;
        $agent = new Agent;

        // Get location data from headers (Cloudflare or similar)
        $country = $this->request->header('CF-IPCountry');
        $city = $this->request->header('CF-IPCity');
        $ip = $this->request->header('CF-Connecting-IP') ?? $this->request->ip();

        AdminLoginTrack::create([
            'user_id' => $user->id,
            'email' => $user->email,
            'ip_address' => $ip,
            'user_agent' => $this->request->userAgent(),
            'country' => $country,
            'city' => $city,
            'device_type' => $this->getDeviceType($agent),
            'browser' => $agent->browser(),
            'platform' => $agent->platform(),
            'is_successful' => true,
        ]);
    }

    private function getDeviceType(Agent $agent): string
    {
        if ($agent->isMobile()) {
            return 'Mobile';
        } elseif ($agent->isTablet()) {
            return 'Tablet';
        } elseif ($agent->isDesktop()) {
            return 'Desktop';
        }

        return 'Unknown';
    }
}
