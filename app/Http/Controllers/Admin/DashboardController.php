<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\ContactFollowUp;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Calculate statistics
        $stats = [
            'total_requests' => Contact::count(),
            'genuine_requests' => Contact::where('spam_score', '<', 0.2)->count(),
            'potential_spam' => Contact::whereBetween('spam_score', [0.2, 0.5])->count(),
            'confirmed_spam' => Contact::where('spam_score', '>', 0.5)->count(),
        ];

        // Get upcoming follow-ups
        $upcomingFollowUps = ContactFollowUp::with('contact')
            ->where('follow_up_date', '>=', now())
            ->where('status', 'scheduled')
            ->orderBy('follow_up_date')
            ->limit(5)
            ->get();

        // Get weekly stats
        $weeklyStats = $this->getWeeklyStats();

        return view('admin.dashboard', compact('stats', 'upcomingFollowUps', 'weeklyStats'));
    }

    private function getWeeklyStats()
    {
        $dates = collect();
        $stats = collect();

        // Get data for the last 7 days
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dates->push($date->format('M d'));

            $count = Contact::whereDate('created_at', $date)->count();
            $stats->push($count);
        }

        return [
            'labels' => $dates->toArray(),
            'total' => $stats->toArray(),
        ];
    }
}
