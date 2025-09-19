<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\ContactFollowUp;
use App\Models\AdminLoginTrack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'week');
        
        // Calculate statistics
        $stats = $this->getStats($period);
        
        // Get upcoming follow-ups
        $upcomingFollowUps = ContactFollowUp::with('contact')
            ->where('follow_up_date', '>=', now())
            ->where('status', 'scheduled')
            ->orderBy('follow_up_date')
            ->limit(10)
            ->get();

        // Get time-based stats
        $timeStats = $this->getTimeStats($period);
        
        // Get follow-up analytics
        $followUpStats = $this->getFollowUpStats($period);
        
        // Get admin login logs
        $adminLogs = AdminLoginTrack::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
            
        // Get contact type distribution
        $contactTypeStats = $this->getContactTypeStats($period);
        
        // Get conversion funnel
        $conversionStats = $this->getConversionStats($period);

        return view('admin.dashboard', compact(
            'stats', 
            'upcomingFollowUps', 
            'timeStats', 
            'followUpStats',
            'adminLogs',
            'contactTypeStats',
            'conversionStats',
            'period'
        ));
    }

    private function getStats($period)
    {
        $query = Contact::query();
        $this->applyPeriodFilter($query, $period);
        
        $totalRequests = $query->count();
        $genuineRequests = (clone $query)->where('spam_score', '<', 0.2)->count();
        $potentialSpam = (clone $query)->whereBetween('spam_score', [0.2, 0.5])->count();
        $confirmedSpam = (clone $query)->where('spam_score', '>', 0.5)->count();
        
        // Additional stats
        $withAttachments = (clone $query)->whereNotNull('attachment_paths')->count();
        $businessInquiries = (clone $query)->where('inquiry_type', 'Business')->count();
        $jobSeekers = (clone $query)->where('inquiry_type', 'Job Seeker')->count();
        $openRequests = (clone $query)->where('status', 'open')->count();
        $processingRequests = (clone $query)->where('status', 'processing')->count();
        $closedRequests = (clone $query)->where('status', 'closed')->count();

        return [
            'total_requests' => $totalRequests,
            'genuine_requests' => $genuineRequests,
            'potential_spam' => $potentialSpam,
            'confirmed_spam' => $confirmedSpam,
            'with_attachments' => $withAttachments,
            'business_inquiries' => $businessInquiries,
            'job_seekers' => $jobSeekers,
            'open_requests' => $openRequests,
            'processing_requests' => $processingRequests,
            'closed_requests' => $closedRequests,
        ];
    }

    private function getTimeStats($period)
    {
        $dates = collect();
        $contacts = collect();
        $followUps = collect();
        
        switch ($period) {
            case 'today':
                for ($i = 23; $i >= 0; $i--) {
                    $hour = Carbon::now()->subHours($i);
                    $dates->push($hour->format('H:00'));
                    $contacts->push(Contact::whereBetween('created_at', [$hour, $hour->copy()->addHour()])->count());
                    $followUps->push(ContactFollowUp::whereBetween('created_at', [$hour, $hour->copy()->addHour()])->count());
                }
                break;
                
            case 'week':
                for ($i = 6; $i >= 0; $i--) {
                    $date = Carbon::now()->subDays($i);
                    $dates->push($date->format('M d'));
                    $contacts->push(Contact::whereDate('created_at', $date)->count());
                    $followUps->push(ContactFollowUp::whereDate('created_at', $date)->count());
                }
                break;
                
            case 'biweekly':
                for ($i = 13; $i >= 0; $i--) {
                    $date = Carbon::now()->subDays($i);
                    $dates->push($date->format('M d'));
                    $contacts->push(Contact::whereDate('created_at', $date)->count());
                    $followUps->push(ContactFollowUp::whereDate('created_at', $date)->count());
                }
                break;
                
            case 'month':
                for ($i = 29; $i >= 0; $i--) {
                    $date = Carbon::now()->subDays($i);
                    $dates->push($date->format('M d'));
                    $contacts->push(Contact::whereDate('created_at', $date)->count());
                    $followUps->push(ContactFollowUp::whereDate('created_at', $date)->count());
                }
                break;
                
            case 'year':
                for ($i = 11; $i >= 0; $i--) {
                    $date = Carbon::now()->subMonths($i);
                    $dates->push($date->format('M Y'));
                    $contacts->push(Contact::whereYear('created_at', $date->year)->whereMonth('created_at', $date->month)->count());
                    $followUps->push(ContactFollowUp::whereYear('created_at', $date->year)->whereMonth('created_at', $date->month)->count());
                }
                break;
        }

        return [
            'labels' => $dates->toArray(),
            'contacts' => $contacts->toArray(),
            'followUps' => $followUps->toArray(),
        ];
    }

    private function getFollowUpStats($period)
    {
        $query = ContactFollowUp::query();
        $this->applyPeriodFilter($query, $period);
        
        return [
            'total' => $query->count(),
            'scheduled' => (clone $query)->where('status', 'scheduled')->count(),
            'completed' => (clone $query)->where('status', 'completed')->count(),
            'no_response' => (clone $query)->where('status', 'no-response')->count(),
            'cancelled' => (clone $query)->where('status', 'cancelled')->count(),
            'by_type' => [
                'call' => (clone $query)->where('follow_up_type', 'call')->count(),
                'email' => (clone $query)->where('follow_up_type', 'email')->count(),
                'meeting' => (clone $query)->where('follow_up_type', 'meeting')->count(),
            ]
        ];
    }
    
    private function getContactTypeStats($period)
    {
        $query = Contact::query();
        $this->applyPeriodFilter($query, $period);
        
        return [
            'business' => (clone $query)->where('inquiry_type', 'Business')->count(),
            'job_seeker' => (clone $query)->where('inquiry_type', 'Job Seeker')->count(),
        ];
    }
    
    private function getConversionStats($period)
    {
        $query = Contact::query();
        $this->applyPeriodFilter($query, $period);
        
        $total = $query->count();
        $contacted = (clone $query)->whereHas('followUps')->count();
        $processing = (clone $query)->where('status', 'processing')->count();
        $closed = (clone $query)->where('status', 'closed')->count();
        
        return [
            'total' => $total,
            'contacted' => $contacted,
            'processing' => $processing,
            'closed' => $closed,
            'contact_rate' => $total > 0 ? round(($contacted / $total) * 100, 1) : 0,
            'processing_rate' => $total > 0 ? round(($processing / $total) * 100, 1) : 0,
            'closure_rate' => $total > 0 ? round(($closed / $total) * 100, 1) : 0,
        ];
    }

    private function applyPeriodFilter($query, $period)
    {
        switch ($period) {
            case 'today':
                $query->whereDate('created_at', Carbon::today());
                break;
            case 'week':
                $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'biweekly':
                $query->whereBetween('created_at', [Carbon::now()->subWeeks(2), Carbon::now()]);
                break;
            case 'month':
                $query->whereMonth('created_at', Carbon::now()->month)
                      ->whereYear('created_at', Carbon::now()->year);
                break;
            case 'last_month':
                $query->whereMonth('created_at', Carbon::now()->subMonth()->month)
                      ->whereYear('created_at', Carbon::now()->subMonth()->year);
                break;
            case 'year':
                $query->whereYear('created_at', Carbon::now()->year);
                break;
        }
    }
}
