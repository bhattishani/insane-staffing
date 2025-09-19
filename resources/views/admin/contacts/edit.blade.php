@extends('layouts.admin')

@section('title', 'Edit Contact')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="mb-6">
                <a class="text-blue-600 hover:text-blue-800" href="{{ route('admin.contacts.index') }}">
                    <i class="fas fa-arrow-left mr-2"></i>Back to list
                </a>
            </div>

            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Edit Contact</h2>
                <p class="text-gray-600 mt-1">Update contact information and status</p>
            </div>

            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.contacts.update', $contact) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="name">Name</label>
                        <input
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="name" name="name" type="text" value="{{ old('name', $contact->name) }}" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="email">Email</label>
                        <input
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="email" name="email" type="email" value="{{ old('email', $contact->email) }}" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="phone">Phone</label>
                        <input
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="phone" name="phone" type="tel" value="{{ old('phone', $contact->phone) }}" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="inquiry_type">Inquiry Type</label>
                        <select
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="inquiry_type" name="inquiry_type" required>
                            <option value="Business" {{ old('inquiry_type', $contact->inquiry_type) === 'Business' ? 'selected' : '' }}>Business</option>
                            <option value="Job Seeker" {{ old('inquiry_type', $contact->inquiry_type) === 'Job Seeker' ? 'selected' : '' }}>Job Seeker</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="status">Status</label>
                        <select
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="status" name="status" required>
                            <option value="open" {{ old('status', $contact->status) === 'open' ? 'selected' : '' }}>Open</option>
                            <option value="processing" {{ old('status', $contact->status) === 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="closed" {{ old('status', $contact->status) === 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="message">Message</label>
                        <textarea
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="message" name="message" rows="6" required>{{ old('message', $contact->message) }}</textarea>
                    </div>
                </div>

                <!-- Attachment Management -->
                <div class="mt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-3">Attachments</h3>
                    
                    <!-- Existing Attachments -->
                    @if ($contact->attachment_paths && count($contact->attachment_paths) > 0)
                        <div class="mb-4">
                            <h4 class="text-md font-medium text-gray-700 mb-2">Current Attachments</h4>
                            <div id="existing-attachments" class="space-y-2">
                                @foreach ($contact->attachment_paths as $index => $attachment)
                                    @php
                                        $mimeType = $attachment['mime_type'] ?? '';
                                        $icon = 'fa-file';
                                        if (strpos($mimeType, 'image/') === 0) $icon = 'fa-image';
                                        elseif (strpos($mimeType, 'video/') === 0) $icon = 'fa-video';
                                        elseif ($mimeType === 'application/pdf') $icon = 'fa-file-pdf';
                                        elseif (strpos($mimeType, 'word') !== false) $icon = 'fa-file-word';
                                        elseif (strpos($mimeType, 'excel') !== false || strpos($mimeType, 'csv') !== false) $icon = 'fa-file-excel';
                                    @endphp
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg" data-attachment-index="{{ $index }}">
                                        <div class="flex items-center flex-1 min-w-0">
                                            <i class="fas {{ $icon }} text-blue-600 mr-3"></i>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate">
                                                    {{ $attachment['original_name'] ?? 'Unknown file' }}
                                                </p>
                                                <p class="text-xs text-gray-500">
                                                    {{ number_format(($attachment['size'] ?? 0) / 1024 / 1024, 2) }} MB
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2 ml-2">
                                            <a class="text-blue-600 hover:text-blue-800"
                                                href="{{ asset('storage/' . $attachment['path']) }}" target="_blank" title="View File">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>
                                            <button type="button" class="text-red-600 hover:text-red-800" 
                                                onclick="removeExistingAttachment({{ $index }})" title="Remove File">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        <input type="hidden" name="keep_attachments[]" value="{{ $index }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Add New Attachments -->
                    <div>
                        <h4 class="text-md font-medium text-gray-700 mb-2">Add New Attachments</h4>
                        <div id="new-attachment-section">
                            <!-- File Input -->
                            <div id="file-input-container">
                                <input
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    id="new_attachments" type="file" multiple
                                    accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.bmp,.webp,.mp4,.avi,.mov,.wmv,.flv,.webm,.xls,.xlsx,.csv">
                                <div class="mt-2 space-y-1">
                                    <p class="text-sm text-gray-600"><strong>Allowed file types:</strong> PDF, Word, Images, Videos, Excel/CSV</p>
                                    <p class="text-sm text-gray-600"><strong>Maximum:</strong> 5 files total, 100MB total</p>
                                </div>
                            </div>

                            <!-- Add More Files Button -->
                            <div id="add-more-container" style="display: none;" class="mt-3">
                                <button type="button" id="add-more-files" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-sm">
                                    <i class="fas fa-plus mr-2"></i>Add More Files
                                </button>
                            </div>

                            <!-- Error Display -->
                            <div class="mt-2">
                                <p class="text-sm text-red-600" id="file-error" style="display: none;"></p>
                            </div>

                            <!-- New File Preview -->
                            <div id="new-file-preview" class="mt-4" style="display: none;">
                                <div class="flex justify-between items-center mb-3">
                                    <p class="text-sm font-medium text-gray-700">New files to upload:</p>
                                    <span class="text-xs text-gray-500" id="new-file-count">0 files</span>
                                </div>
                                <div id="new-file-list" class="space-y-2 max-h-60 overflow-y-auto border rounded-lg p-3 bg-gray-50"></div>
                                <div class="mt-2 flex justify-between items-center text-xs text-gray-600">
                                    <span id="new-total-size">New files size: 0 MB</span>
                                    <button type="button" id="clear-new-files" class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash mr-1"></i>Clear New Files
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Follow-ups Section -->
                <div class="mt-8">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Follow-ups</h3>
                        <button type="button" id="add-followup-btn" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 text-sm">
                            <i class="fas fa-plus mr-2"></i>Add Follow-up
                        </button>
                    </div>
                    
                    <div id="followups-container">
                        @forelse($contact->followUps as $followUp)
                            <div class="border rounded-lg p-4 mb-4 followup-item" data-followup-id="{{ $followUp->id }}">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ ucfirst($followUp->follow_up_type) }} - {{ ucfirst($followUp->status) }}</h4>
                                        <p class="text-sm text-gray-600">{{ $followUp->follow_up_date->format('M d, Y h:i A') }}</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button type="button" class="text-blue-600 hover:text-blue-800 edit-followup-btn" data-followup-id="{{ $followUp->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="text-red-600 hover:text-red-800 delete-followup-btn" data-followup-id="{{ $followUp->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="text-sm text-gray-700">
                                    <p><strong>Notes:</strong> {{ $followUp->notes }}</p>
                                    @if($followUp->outcome)
                                        <p class="mt-1"><strong>Outcome:</strong> {{ $followUp->outcome }}</p>
                                    @endif
                                    @if($followUp->next_follow_up_date)
                                        <p class="mt-1"><strong>Next Follow-up:</strong> {{ $followUp->next_follow_up_date->format('M d, Y h:i A') }}</p>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">No follow-ups recorded yet.</p>
                        @endforelse
                    </div>
                </div>

                <div class="mt-8 flex justify-end space-x-4">
                    <a class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50"
                        href="{{ route('admin.contacts.index') }}">
                        Cancel
                    </a>
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700" type="submit">
                        Update Contact
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Follow-up Modal -->
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 hidden" id="followupModal">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-lg w-full">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold" id="followup-modal-title">Add Follow-up</h3>
                        <button onclick="closeFollowupModal()" type="button">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <form id="followupForm" class="space-y-4">
                        <input id="followup-id" type="hidden">
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select id="followup-status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                <option value="scheduled">Scheduled</option>
                                <option value="completed">Completed</option>
                                <option value="no-response">No Response</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Follow-up Type</label>
                            <select id="followup-type" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                <option value="call">Phone Call</option>
                                <option value="email">Email</option>
                                <option value="meeting">Meeting</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Follow-up Date</label>
                            <input id="followup-date" type="datetime-local" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Next Follow-up Date</label>
                            <input id="next-followup-date" type="datetime-local" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                            <textarea id="followup-notes" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Outcome</label>
                            <input id="followup-outcome" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="button" class="px-4 py-2 text-sm border rounded-md hover:bg-gray-50" onclick="closeFollowupModal()">
                                Cancel
                            </button>
                            <button type="submit" class="px-4 py-2 text-sm bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Save Follow-up
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // File management variables
    let newSelectedFiles = [];
    let newFileIdCounter = 0;
    let removedAttachments = [];

    $(document).ready(function() {
        // File management
        $('#new_attachments').on('change', function() {
            const files = this.files;
            if (files.length > 0) {
                addNewFilesToArray(files);
                $(this).val('');
            }
        });

        $('#add-more-files').on('click', function() {
            $('#new_attachments').click();
        });

        $('#clear-new-files').on('click', function() {
            clearNewFiles();
        });

        // Follow-up management
        $('#add-followup-btn').on('click', function() {
            openFollowupModal();
        });

        $('.edit-followup-btn').on('click', function() {
            const followupId = $(this).data('followup-id');
            editFollowup(followupId);
        });

        $('.delete-followup-btn').on('click', function() {
            const followupId = $(this).data('followup-id');
            deleteFollowup(followupId);
        });

        $('#followupForm').on('submit', function(e) {
            e.preventDefault();
            saveFollowup();
        });
    });

    // File management functions
    function addNewFilesToArray(files) {
        const $errorDiv = $('#file-error');
        $errorDiv.hide();

        const allowedTypes = [
            'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/bmp', 'image/webp',
            'video/mp4', 'video/avi', 'video/quicktime', 'video/x-ms-wmv', 'video/x-flv', 'video/webm',
            'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'text/csv'
        ];

        const currentAttachmentCount = $('#existing-attachments .flex').length - removedAttachments.length;
        const totalFiles = currentAttachmentCount + newSelectedFiles.length;

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            
            if (totalFiles + i >= 5) {
                $errorDiv.text('Maximum 5 files allowed total.').show();
                break;
            }

            if (!allowedTypes.includes(file.type)) {
                $errorDiv.text(`File "${file.name}" is not an allowed file type.`).show();
                continue;
            }

            const currentTotalSize = newSelectedFiles.reduce((total, f) => total + f.size, 0);
            if (currentTotalSize + file.size > 100 * 1024 * 1024) {
                $errorDiv.text('Total file size would exceed 100MB limit.').show();
                continue;
            }

            newSelectedFiles.push({
                id: ++newFileIdCounter,
                file: file,
                name: file.name,
                size: file.size,
                type: file.type
            });
        }

        updateNewFilePreview();
    }

    function updateNewFilePreview() {
        const $previewDiv = $('#new-file-preview');
        const $fileList = $('#new-file-list');
        const $fileCount = $('#new-file-count');
        const $totalSize = $('#new-total-size');
        const $addMoreContainer = $('#add-more-container');
        const $fileInputContainer = $('#file-input-container');

        if (newSelectedFiles.length === 0) {
            $previewDiv.hide();
            $addMoreContainer.hide();
            $fileInputContainer.show();
            return;
        }

        $previewDiv.show();
        $fileInputContainer.hide();
        $addMoreContainer.show();

        $fileCount.text(`${newSelectedFiles.length} files`);

        const totalSize = newSelectedFiles.reduce((total, f) => total + f.size, 0);
        $totalSize.text(`New files size: ${(totalSize / 1024 / 1024).toFixed(2)} MB`);

        $fileList.empty();

        newSelectedFiles.forEach(fileObj => {
            const fileType = getFileTypeIcon(fileObj.type);
            const fileSize = (fileObj.size / 1024 / 1024).toFixed(2);
            const truncatedName = truncateFileName(fileObj.name, 30);
            
            const fileItem = $(`
                <div class="flex items-center justify-between p-2 bg-white rounded border hover:bg-gray-50 transition-colors">
                    <div class="flex items-center space-x-3 flex-1 min-w-0">
                        <i class="fas ${fileType.icon} ${fileType.color} flex-shrink-0"></i>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate" title="${fileObj.name}">
                                ${truncatedName}
                            </p>
                            <p class="text-xs text-gray-500">${fileSize} MB</p>
                        </div>
                    </div>
                    <button type="button" class="text-red-600 hover:text-red-800 text-sm" onclick="removeNewFile(${fileObj.id})">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `);
            
            $fileList.append(fileItem);
        });

        const currentAttachmentCount = $('#existing-attachments .flex').length - removedAttachments.length;
        if (currentAttachmentCount + newSelectedFiles.length >= 5) {
            $addMoreContainer.hide();
        }
    }

    function removeNewFile(fileId) {
        newSelectedFiles = newSelectedFiles.filter(f => f.id !== fileId);
        updateNewFilePreview();
        $('#file-error').hide();
    }

    function clearNewFiles() {
        newSelectedFiles = [];
        updateNewFilePreview();
        $('#file-error').hide();
    }

    function removeExistingAttachment(index) {
        Swal.fire({
            title: 'Remove Attachment?',
            text: "This attachment will be removed from the contact.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, remove it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $(`[data-attachment-index="${index}"]`).hide();
                $(`[data-attachment-index="${index}"] input[name="keep_attachments[]"]`).remove();
                removedAttachments.push(index);
                updateNewFilePreview(); // Update file count limits
            }
        });
    }

    function getFileTypeIcon(mimeType) {
        if (mimeType.startsWith('image/')) {
            return { icon: 'fa-image', color: 'text-green-600' };
        } else if (mimeType.startsWith('video/')) {
            return { icon: 'fa-video', color: 'text-red-600' };
        } else if (mimeType === 'application/pdf') {
            return { icon: 'fa-file-pdf', color: 'text-red-600' };
        } else if (mimeType.includes('word')) {
            return { icon: 'fa-file-word', color: 'text-blue-600' };
        } else if (mimeType.includes('excel') || mimeType.includes('csv')) {
            return { icon: 'fa-file-excel', color: 'text-green-600' };
        } else {
            return { icon: 'fa-file', color: 'text-gray-600' };
        }
    }

    function truncateFileName(fileName, maxLength) {
        if (fileName.length <= maxLength) {
            return fileName;
        }
        
        const extension = fileName.split('.').pop();
        const nameWithoutExt = fileName.substring(0, fileName.lastIndexOf('.'));
        const truncatedName = nameWithoutExt.substring(0, maxLength - extension.length - 4) + '...';
        
        return truncatedName + '.' + extension;
    }

    // Follow-up management functions
    function openFollowupModal(followupData = null) {
        if (followupData) {
            $('#followup-modal-title').text('Edit Follow-up');
            $('#followup-id').val(followupData.id);
            $('#followup-status').val(followupData.status);
            $('#followup-type').val(followupData.follow_up_type);
            $('#followup-date').val(followupData.follow_up_date);
            $('#next-followup-date').val(followupData.next_follow_up_date || '');
            $('#followup-notes').val(followupData.notes);
            $('#followup-outcome').val(followupData.outcome || '');
        } else {
            $('#followup-modal-title').text('Add Follow-up');
            $('#followupForm')[0].reset();
            $('#followup-id').val('');
        }
        $('#followupModal').removeClass('hidden');
    }

    function closeFollowupModal() {
        $('#followupModal').addClass('hidden');
        $('#followupForm')[0].reset();
    }

    function editFollowup(followupId) {
        // In a real implementation, you'd fetch the followup data via AJAX
        // For now, we'll extract it from the DOM
        const followupElement = $(`.followup-item[data-followup-id="${followupId}"]`);
        // This is a simplified version - you'd want to fetch actual data via AJAX
        openFollowupModal();
    }

    function deleteFollowup(followupId) {
        Swal.fire({
            title: 'Delete Follow-up?',
            text: "This follow-up will be permanently deleted.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/contacts/{{ $contact->id }}/follow-ups/${followupId}`,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire('Deleted!', 'Follow-up deleted successfully.', 'success');
                        $(`.followup-item[data-followup-id="${followupId}"]`).remove();
                    },
                    error: function(xhr) {
                        Swal.fire('Error!', 'Something went wrong.', 'error');
                    }
                });
            }
        });
    }

    function saveFollowup() {
        const followupId = $('#followup-id').val();
        const isEdit = followupId !== '';
        
        const data = {
            status: $('#followup-status').val(),
            follow_up_type: $('#followup-type').val(),
            follow_up_date: $('#followup-date').val(),
            next_follow_up_date: $('#next-followup-date').val(),
            notes: $('#followup-notes').val(),
            outcome: $('#followup-outcome').val()
        };

        const url = isEdit 
            ? `/admin/contacts/{{ $contact->id }}/follow-ups/${followupId}`
            : `/admin/contacts/{{ $contact->id }}/follow-ups`;
        
        const method = isEdit ? 'PUT' : 'POST';

        $.ajax({
            url: url,
            type: method,
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                Swal.fire('Success!', 'Follow-up saved successfully.', 'success');
                closeFollowupModal();
                location.reload(); // Reload to show updated follow-ups
            },
            error: function(xhr) {
                Swal.fire('Error!', 'Something went wrong.', 'error');
            }
        });
    }

    // Form submission with files
    $('form').on('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        // Add new files
        newSelectedFiles.forEach((fileObj, index) => {
            formData.append(`new_attachments[${index}]`, fileObj.file);
        });

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                Swal.fire('Success!', 'Contact updated successfully.', 'success')
                    .then(() => {
                        window.location.href = '{{ route("admin.contacts.index") }}';
                    });
            },
            error: function(xhr) {
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let errorMessage = Object.values(xhr.responseJSON.errors).flat().join('\n');
                    Swal.fire('Validation Error', errorMessage, 'error');
                } else {
                    Swal.fire('Error!', 'Something went wrong.', 'error');
                }
            }
        });
    });

    // Global functions for onclick handlers
    window.removeNewFile = removeNewFile;
    window.removeExistingAttachment = removeExistingAttachment;
</script>
@endsection