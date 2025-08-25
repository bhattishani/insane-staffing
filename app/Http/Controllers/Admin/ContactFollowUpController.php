<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\ContactFollowUp;
use Illuminate\Http\Request;

class ContactFollowUpController extends Controller
{
    public function store(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'status' => 'required|string',
            'follow_up_type' => 'required|string',
            'follow_up_date' => 'required|date',
            'next_follow_up_date' => 'nullable|date',
            'notes' => 'required|string',
            'outcome' => 'nullable|string',
        ]);

        $contact->followUps()->create($validated);

        return redirect()->back()->with('success', 'Follow-up added successfully');
    }

    public function destroy(Contact $contact, ContactFollowUp $followUp)
    {
        $followUp->delete();
        return redirect()->back()->with('success', 'Follow-up deleted successfully');
    }
}
