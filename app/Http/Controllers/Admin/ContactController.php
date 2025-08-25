<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::latest();

        // Filter by spam score
        if ($request->has('show_spam')) {
            // Show all records when spam filter is enabled
            $showSpam = true;
        } else {
            // By default, show only non-spam records
            $query->where('spam_score', '<', 0.4);
            $showSpam = false;
        }

        $contacts = $query->paginate(10)->withQueryString();
        return view('admin.contacts.index', compact('contacts', 'showSpam'));
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
