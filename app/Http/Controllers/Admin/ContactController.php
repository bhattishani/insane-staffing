<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        // Handle DataTables AJAX request
        if ($request->ajax()) {
            return $this->getDataTablesData($request);
        }

        // Regular page load
        $contacts = collect(); // Empty collection for initial load
        return view('admin.contacts.index', compact('contacts'));
    }

    private function getDataTablesData(Request $request)
    {
        $query = Contact::query();

        // Apply server-side search
        if ($request->has('search') && !empty($request->search['value'])) {
            $searchValue = $request->search['value'];
            $query->where(function($q) use ($searchValue) {
                $q->where('name', 'like', "%{$searchValue}%")
                  ->orWhere('email', 'like', "%{$searchValue}%")
                  ->orWhere('phone', 'like', "%{$searchValue}%")
                  ->orWhere('inquiry_type', 'like', "%{$searchValue}%")
                  ->orWhere('message', 'like', "%{$searchValue}%");
            });
        }

        // Apply custom filters
        if ($request->has('status_filter') && !empty($request->status_filter)) {
            $query->where('status', $request->status_filter);
        }

        if ($request->has('type_filter') && !empty($request->type_filter)) {
            $query->where('inquiry_type', $request->type_filter);
        }

        if ($request->has('spam_filter') && !empty($request->spam_filter)) {
            switch ($request->spam_filter) {
                case 'low':
                    $query->where('spam_score', '<', 0.2);
                    break;
                case 'medium':
                    $query->whereBetween('spam_score', [0.2, 0.5]);
                    break;
                case 'high':
                    $query->where('spam_score', '>=', 0.5);
                    break;
            }
        }

        if ($request->has('cv_filter') && !empty($request->cv_filter)) {
            if ($request->cv_filter === 'with-cv') {
                $query->whereNotNull('cv_path');
            } elseif ($request->cv_filter === 'without-cv') {
                $query->whereNull('cv_path');
            }
        }

        // Apply ordering
        if ($request->has('order')) {
            $columns = ['name', 'email', 'phone', 'inquiry_type', 'cv_path', 'status', 'spam_score', 'created_at'];
            $orderColumn = $columns[$request->order[0]['column']] ?? 'created_at';
            $orderDirection = $request->order[0]['dir'] ?? 'desc';
            $query->orderBy($orderColumn, $orderDirection);
        } else {
            $query->latest();
        }

        // Get total count before pagination
        $totalRecords = Contact::count();
        $filteredRecords = $query->count();

        // Apply pagination
        $start = $request->start ?? 0;
        $length = $request->length ?? 25;
        $contacts = $query->skip($start)->take($length)->get();

        // Format data for DataTables
        $data = $contacts->map(function($contact) {
            return [
                'name' => $contact->name,
                'email' => $contact->email,
                'phone' => $contact->phone,
                'inquiry_type' => $contact->inquiry_type,
                'cv_path' => $this->formatCvColumn($contact),
                'status' => $this->formatStatusColumn($contact),
                'spam_score' => $this->formatSpamScoreColumn($contact),
                'created_at' => $contact->created_at->format('M d, Y h:i A'),
                'actions' => $this->formatActionsColumn($contact),
                'DT_RowId' => 'contact_' . $contact->id
            ];
        });

        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data
        ]);
    }

    private function formatCvColumn($contact)
    {
        if ($contact->cv_path) {
            return '<a class="text-blue-600 hover:text-blue-800 inline-flex items-center gap-1" href="' . asset('storage/' . $contact->cv_path) . '" target="_blank" title="View CV">
                        <i class="fas fa-file-pdf"></i>
                        <span class="text-xs">View</span>
                    </a>';
        }
        return '<span class="text-gray-400 text-xs">No CV</span>';
    }

    private function formatStatusColumn($contact)
    {
        $statusClasses = [
            'open' => 'bg-yellow-100 text-yellow-800',
            'processing' => 'bg-blue-100 text-blue-800',
            'closed' => 'bg-green-100 text-green-800'
        ];
        
        $class = $statusClasses[$contact->status] ?? 'bg-gray-100 text-gray-800';
        
        return '<span class="px-2 py-1 rounded text-sm ' . $class . '">' . ucfirst($contact->status) . '</span>';
    }

    private function formatSpamScoreColumn($contact)
    {
        if ($contact->spam_score !== null) {
            $scoreClasses = [
                'low' => 'bg-green-100 text-green-800',
                'medium' => 'bg-orange-100 text-orange-800',
                'high' => 'bg-red-100 text-red-800'
            ];
            
            $scoreLevel = $contact->spam_score < 0.2 ? 'low' : ($contact->spam_score < 0.5 ? 'medium' : 'high');
            $class = $scoreClasses[$scoreLevel];
            
            return '<span class="px-2 py-1 text-sm rounded-full ' . $class . '">' . number_format($contact->spam_score, 2) . '</span>';
        }
        
        return '<span class="text-gray-400">N/A</span>';
    }

    private function formatActionsColumn($contact)
    {
        return '<div class="space-x-2">
                    <a class="text-blue-600 hover:text-blue-800" href="' . route('admin.contacts.show', $contact) . '" title="View Details">
                        <i class="fas fa-eye"></i>
                    </a>
                    <button class="text-green-600 hover:text-green-800" onclick="openFollowUpModal(' . $contact->id . ')" type="button" title="Add Follow-up">
                        <i class="fas fa-phone"></i>
                    </button>
                </div>';
    }

    public function show(Contact $contact)
    {
        $contact->load('followUps');
        return view('admin.contacts.show', compact('contact'));
    }

    public function updateStatus(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'status' => 'required|in:open,processing,closed',
            'follow_up_notes' => 'nullable|string'
        ]);

        $contact->update([
            'status' => $validated['status'],
            'follow_up_notes' => $validated['follow_up_notes'],
            'last_follow_up' => now()
        ]);

        return redirect()->back()->with('success', 'Contact status updated successfully');
    }
}
