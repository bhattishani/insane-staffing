<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

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
        if ($request->has('search') && ! empty($request->search['value'])) {
            $searchValue = $request->search['value'];
            $query->where(function ($q) use ($searchValue) {
                $q->where('name', 'like', "%{$searchValue}%")
                    ->orWhere('email', 'like', "%{$searchValue}%")
                    ->orWhere('phone', 'like', "%{$searchValue}%")
                    ->orWhere('inquiry_type', 'like', "%{$searchValue}%")
                    ->orWhere('message', 'like', "%{$searchValue}%");
            });
        }

        // Apply soft delete filter
        if ($request->has('deleted_filter') && $request->deleted_filter === 'deleted') {
            $query->onlyTrashed();
        } elseif ($request->has('deleted_filter') && $request->deleted_filter === 'with_deleted') {
            $query->withTrashed();
        }

        // Apply custom filters
        if ($request->has('status_filter') && ! empty($request->status_filter)) {
            $query->where('status', $request->status_filter);
        }

        if ($request->has('type_filter') && ! empty($request->type_filter)) {
            $query->where('inquiry_type', $request->type_filter);
        }

        if ($request->has('spam_filter') && ! empty($request->spam_filter)) {
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

        if ($request->has('cv_filter') && ! empty($request->cv_filter)) {
            if ($request->cv_filter === 'with-cv') {
                $query->whereNotNull('attachment_paths');
            } elseif ($request->cv_filter === 'without-cv') {
                $query->whereNull('attachment_paths');
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
        $totalQuery = Contact::query();
        if ($request->has('deleted_filter') && $request->deleted_filter === 'deleted') {
            $totalQuery->onlyTrashed();
        } elseif ($request->has('deleted_filter') && $request->deleted_filter === 'with_deleted') {
            $totalQuery->withTrashed();
        }
        $totalRecords = $totalQuery->count();
        $filteredRecords = $query->count();

        // Apply pagination
        $start = $request->start ?? 0;
        $length = $request->length ?? 25;
        $contacts = $query->skip($start)->take($length)->get();

        // Format data for DataTables
        $data = $contacts->map(function ($contact) {
            return [
                'name' => $contact->name,
                'email' => $contact->email,
                'phone' => $contact->phone,
                'inquiry_type' => $contact->inquiry_type,
                'cv_path' => $this->formatAttachmentsColumn($contact),
                'status' => $this->formatStatusColumn($contact),
                'spam_score' => $this->formatSpamScoreColumn($contact),
                'created_at' => $contact->created_at->format('M d, Y h:i A'),
                'updated_at' => $contact->updated_at->format('M d, Y h:i A'),
                'deleted_at' => $contact->deleted_at ? $contact->deleted_at->format('M d, Y h:i A') : '-',
                'actions' => $this->formatActionsColumn($contact),
                'DT_RowId' => 'contact_'.$contact->id,
            ];
        });

        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data,
        ]);
    }

    private function formatAttachmentsColumn($contact)
    {
        if ($contact->attachment_paths && count($contact->attachment_paths) > 0) {
            $attachmentCount = count($contact->attachment_paths);
            $firstAttachment = $contact->attachment_paths[0];
            $icon = $this->getFileIcon($firstAttachment['mime_type'] ?? '');

            if ($attachmentCount === 1) {
                return '<a class="text-blue-600 hover:text-blue-800 inline-flex items-center gap-1" href="'.asset('storage/'.$firstAttachment['path']).'" target="_blank" title="View '.($firstAttachment['original_name'] ?? 'file').'">
                            <i class="fas '.$icon.'"></i>
                            <span class="text-xs">View</span>
                        </a>';
            } else {
                return '<div class="inline-flex items-center gap-1">
                            <i class="fas '.$icon.' text-blue-600"></i>
                            <span class="text-xs text-blue-600">'.$attachmentCount.' files</span>
                        </div>';
            }
        }

        return '<span class="text-gray-400 text-xs">No files</span>';
    }

    private function getFileIcon($mimeType)
    {
        if (strpos($mimeType, 'image/') === 0) {
            return 'fa-image';
        } elseif (strpos($mimeType, 'video/') === 0) {
            return 'fa-video';
        } elseif ($mimeType === 'application/pdf') {
            return 'fa-file-pdf';
        } elseif (strpos($mimeType, 'word') !== false) {
            return 'fa-file-word';
        } elseif (strpos($mimeType, 'excel') !== false || strpos($mimeType, 'csv') !== false) {
            return 'fa-file-excel';
        } else {
            return 'fa-file';
        }
    }

    private function formatStatusColumn($contact)
    {
        $statusClasses = [
            'open' => 'bg-yellow-100 text-yellow-800',
            'processing' => 'bg-blue-100 text-blue-800',
            'closed' => 'bg-green-100 text-green-800',
        ];

        $class = $statusClasses[$contact->status] ?? 'bg-gray-100 text-gray-800';

        return '<span class="px-2 py-1 rounded text-sm '.$class.'">'.ucfirst($contact->status).'</span>';
    }

    private function formatSpamScoreColumn($contact)
    {
        if ($contact->spam_score !== null) {
            $scoreClasses = [
                'low' => 'bg-green-100 text-green-800',
                'medium' => 'bg-orange-100 text-orange-800',
                'high' => 'bg-red-100 text-red-800',
            ];

            $scoreLevel = $contact->spam_score < 0.2 ? 'low' : ($contact->spam_score < 0.5 ? 'medium' : 'high');
            $class = $scoreClasses[$scoreLevel];

            return '<span class="px-2 py-1 text-sm rounded-full '.$class.'">'.number_format($contact->spam_score, 2).'</span>';
        }

        return '<span class="text-gray-400">N/A</span>';
    }

    private function formatActionsColumn($contact)
    {
        if ($contact->deleted_at) {
            // Actions for soft deleted contacts
            return '<div class="flex flex-wrap gap-2">
                        <button class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-md hover:bg-green-200 transition-colors" onclick="restoreContact('.$contact->id.')" type="button" title="Restore Contact">
                            <i class="fas fa-undo mr-1"></i>
                            Restore
                        </button>
                        <button class="inline-flex items-center px-2 py-1 text-xs font-medium text-red-700 bg-red-100 rounded-md hover:bg-red-200 transition-colors" onclick="permanentDeleteContact('.$contact->id.')" type="button" title="Permanently Delete">
                            <i class="fas fa-trash-alt mr-1"></i>
                            Delete
                        </button>
                    </div>';
        } else {
            // Actions for active contacts
            return '<div class="flex flex-wrap gap-1">
                        <a class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded-md hover:bg-blue-200 transition-colors" href="'.route('admin.contacts.show', $contact).'" title="View Details">
                            <i class="fas fa-eye mr-1"></i>
                            View
                        </a>
                        <a class="inline-flex items-center px-2 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-md hover:bg-yellow-200 transition-colors" href="'.route('admin.contacts.edit', $contact).'" title="Edit Contact">
                            <i class="fas fa-edit mr-1"></i>
                            Edit
                        </a>
                        <button class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-md hover:bg-green-200 transition-colors" onclick="openFollowUpModal('.$contact->id.')" type="button" title="Add Follow-up">
                            <i class="fas fa-phone mr-1"></i>
                            Follow-up
                        </button>
                        <button class="inline-flex items-center px-2 py-1 text-xs font-medium text-red-700 bg-red-100 rounded-md hover:bg-red-200 transition-colors" onclick="deleteContact('.$contact->id.')" type="button" title="Delete Contact">
                            <i class="fas fa-trash mr-1"></i>
                            Delete
                        </button>
                    </div>';
        }
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
            'follow_up_notes' => 'nullable|string',
        ]);

        $contact->update([
            'status' => $validated['status'],
            'follow_up_notes' => $validated['follow_up_notes'],
            'last_follow_up' => now(),
        ]);

        return redirect()->back()->with('success', 'Contact status updated successfully');
    }

    public function edit(Contact $contact)
    {
        return view('admin.contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'inquiry_type' => 'required|in:Business,Job Seeker',
            'message' => 'required|string|max:5000',
            'status' => 'required|in:open,processing,closed',
            'keep_attachments' => 'array',
            'new_attachments' => 'array|max:5',
            'new_attachments.*' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png,gif,bmp,webp,mp4,avi,mov,wmv,flv,webm,xls,xlsx,csv|max:102400',
        ]);

        // Handle attachment updates
        $currentAttachments = $contact->attachment_paths ?? [];
        $keepAttachments = $request->input('keep_attachments', []);

        // Filter out removed attachments
        $updatedAttachments = [];
        foreach ($currentAttachments as $index => $attachment) {
            if (in_array($index, $keepAttachments)) {
                $updatedAttachments[] = $attachment;
            } else {
                // Delete the file from storage
                if (isset($attachment['path']) && \Storage::disk('public')->exists($attachment['path'])) {
                    \Storage::disk('public')->delete($attachment['path']);
                }
            }
        }

        // Handle new file uploads
        if ($request->hasFile('new_attachments')) {
            $newFiles = $request->file('new_attachments');

            // Validate total file count
            if (count($updatedAttachments) + count($newFiles) > 5) {
                return response()->json([
                    'message' => 'Maximum 5 files allowed total.',
                    'errors' => ['new_attachments' => ['Maximum 5 files allowed total.']],
                ], 422);
            }

            // Process each new file
            foreach ($newFiles as $file) {
                if ($file->isValid()) {
                    // Generate unique filename
                    $extension = $file->getClientOriginalExtension();
                    $filename = 'attachment_'.time().'_'.uniqid().'.'.$extension;

                    // Store file
                    $filePath = $file->storeAs('attachments', $filename, 'public');

                    $updatedAttachments[] = [
                        'path' => $filePath,
                        'original_name' => $file->getClientOriginalName(),
                        'mime_type' => $file->getClientMimeType(),
                        'size' => $file->getSize(),
                    ];
                }
            }
        }

        // Update contact with new attachment paths
        $validated['attachment_paths'] = $updatedAttachments;
        $contact->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Contact updated successfully.',
            ]);
        }

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Contact updated successfully.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return response()->json([
            'success' => true,
            'message' => 'Contact deleted successfully.',
        ]);
    }

    public function restore($id)
    {
        $contact = Contact::withTrashed()->findOrFail($id);
        $contact->restore();

        return response()->json([
            'success' => true,
            'message' => 'Contact restored successfully.',
        ]);
    }

    public function forceDelete($id)
    {
        $contact = Contact::withTrashed()->findOrFail($id);

        // Delete associated files if they exist
        if ($contact->attachment_paths) {
            foreach ($contact->attachment_paths as $attachment) {
                if (isset($attachment['path']) && \Storage::disk('public')->exists($attachment['path'])) {
                    \Storage::disk('public')->delete($attachment['path']);
                }
            }
        }

        $contact->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'Contact permanently deleted.',
        ]);
    }
}
