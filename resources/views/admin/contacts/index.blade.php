@extends('layouts.admin')

@section('title', 'Contact Submissions')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <style>
        /* Custom Tailwind-based DataTables styling */
        .dataTables_wrapper {
            font-size: 0.875rem;
        }

        .dataTables_length {
            margin-bottom: 1rem;
        }

        .dataTables_length select {
            padding: 0.5rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            background-color: white;
            font-size: 0.875rem;
            margin-left: 0.5rem;
        }

        .dataTables_length select:focus {
            outline: none;
            ring: 2px;
            ring-color: #3b82f6;
        }

        .dataTables_filter {
            margin-bottom: 1rem;
        }

        .dataTables_filter input {
            padding: 0.5rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            margin-left: 0.5rem;
        }

        .dataTables_filter input:focus {
            outline: none;
            ring: 2px;
            ring-color: #3b82f6;
        }

        .dataTables_info {
            color: #6b7280;
            font-size: 0.875rem;
            margin-top: 1rem;
        }

        .dataTables_paginate {
            margin-top: 1rem;
        }

        .dataTables_paginate .paginate_button {
            padding: 0.5rem 0.75rem;
            margin: 0 0.125rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            color: #374151;
            cursor: pointer;
            text-decoration: none;
        }

        .dataTables_paginate .paginate_button:hover {
            background-color: #f9fafb;
        }

        .dataTables_paginate .paginate_button.current {
            background-color: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        .dataTables_paginate .paginate_button.current:hover {
            background-color: #1d4ed8;
        }

        .dataTables_paginate .paginate_button.disabled {
            color: #9ca3af;
            cursor: not-allowed;
        }

        .dataTables_paginate .paginate_button.disabled:hover {
            background-color: white;
        }

        .dataTables_processing {
            background-color: white;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            padding: 1rem;
            text-align: center;
        }

        .dt-buttons {
            margin-bottom: 1rem;
        }

        .dt-button {
            padding: 0.5rem 1rem;
            background-color: #059669;
            color: white;
            border-radius: 0.375rem;
            margin-right: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            border: none;
            cursor: pointer;
        }

        .dt-button:hover {
            background-color: #047857;
        }

        table.dataTable thead th {
            background-color: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
            font-weight: 500;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-size: 0.75rem;
            padding: 0.75rem 1.5rem;
        }

        table.dataTable tbody tr:hover {
            background-color: #f9fafb;
        }

        table.dataTable tbody tr {
            border-bottom: 1px solid #f3f4f6;
        }

        table.dataTable tbody td {
            padding: 0.75rem 1.5rem;
            font-size: 0.875rem;
            color: #111827;
        }

        .dataTables_empty {
            text-align: center;
            padding: 2rem;
            color: #6b7280;
        }

        /* Remove default DataTables styling */
        table.dataTable {
            border-collapse: separate;
            border-spacing: 0;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_processing,
        .dataTables_wrapper .dataTables_paginate {
            color: inherit;
        }
    </style>
@endsection

@section('content')
    <div class="bg-white rounded-lg shadow-md p-4 sm:p-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 sm:gap-6 mb-6">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold">Contact Submissions</h2>
                <p class="text-sm text-gray-600 mt-1">
                    <strong>Spam Score:</strong> The lower the spam score, the more genuine the request. Spam scores are
                    calculated between 0 and 1.
                </p>
            </div>
        </div>

        <!-- Advanced Filters -->
        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select id="status-filter"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Statuses</option>
                        <option value="open">Open</option>
                        <option value="processing">Processing</option>
                        <option value="closed">Closed</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Inquiry Type</label>
                    <select id="type-filter"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Types</option>
                        <option value="Business">Business</option>
                        <option value="Job Seeker">Job Seeker</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Spam Score</label>
                    <select id="spam-filter"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Scores</option>
                        <option value="low">Low (0-0.2)</option>
                        <option value="medium">Medium (0.2-0.5)</option>
                        <option value="high">High (0.5-1.0)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">CV Status</label>
                    <select id="cv-filter"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All</option>
                        <option value="with-cv">With CV</option>
                        <option value="without-cv">Without CV</option>
                    </select>
                </div>
            </div>
            <div class="mt-4 flex gap-2">
                <button id="clear-filters" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                    Clear Filters
                </button>
                <button id="export-csv" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                    Export CSV
                </button>
            </div>
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table id="contacts-table" class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CV</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Spam
                            Score</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submitted
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Data will be loaded via AJAX -->
                </tbody>
            </table>
        </div>

        <!-- Follow-up Modal -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 hidden" id="followUpModal" x-cloak x-show="open">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="bg-white rounded-lg shadow-xl max-w-lg w-full">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Add Follow-up</h3>
                            <button onclick="closeFollowUpModal()" type="button">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>

                        <form action="" class="space-y-4" id="followUpForm" method="POST">
                            @csrf
                            <input id="contactId" name="contact_id" type="hidden">

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                <select
                                    class="w-full rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none shadow-sm p-3 text-sm text-gray-800 placeholder-gray-400 resize-none transition duration-200"
                                    name="status" required>
                                    <option value="scheduled">Scheduled</option>
                                    <option value="completed">Completed</option>
                                    <option value="no-response">No Response</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Follow-up Type</label>
                                <select
                                    class="w-full rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none shadow-sm p-3 text-sm text-gray-800 placeholder-gray-400 resize-none transition duration-200"
                                    name="follow_up_type" required>
                                    <option value="call">Phone Call</option>
                                    <option value="email">Email</option>
                                    <option value="meeting">Meeting</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Follow-up Date</label>
                                <input
                                    class="w-full rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none shadow-sm p-3 text-sm text-gray-800 placeholder-gray-400 resize-none transition duration-200"
                                    name="follow_up_date" required type="datetime-local">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Next Follow-up Date</label>
                                <input
                                    class="w-full rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none shadow-sm p-3 text-sm text-gray-800 placeholder-gray-400 resize-none transition duration-200"
                                    name="next_follow_up_date" type="datetime-local">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                                <textarea
                                    class="w-full rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none shadow-sm p-3 text-sm text-gray-800 placeholder-gray-400 resize-none transition duration-200"
                                    name="notes" required rows="4"></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Outcome</label>
                                <input
                                    class="w-full rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none shadow-sm p-3 text-sm text-gray-800 placeholder-gray-400 resize-none transition duration-200"
                                    name="outcome" type="text">
                            </div>

                            <div class="flex justify-end space-x-3">
                                <button class="px-4 py-2 text-sm border rounded-md hover:bg-gray-50"
                                    onclick="closeFollowUpModal()" type="button">
                                    Cancel
                                </button>
                                <button class="px-4 py-2 text-sm bg-blue-600 text-white rounded-md hover:bg-blue-700"
                                    type="submit">
                                    Save Follow-up
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable with server-side processing
            const table = $('#contacts-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('admin.contacts.index') }}',
                    data: function(d) {
                        d.status_filter = $('#status-filter').val();
                        d.type_filter = $('#type-filter').val();
                        d.spam_filter = $('#spam-filter').val();
                        d.cv_filter = $('#cv-filter').val();
                    }
                },
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'inquiry_type',
                        name: 'inquiry_type'
                    },
                    {
                        data: 'cv_path',
                        name: 'cv_path',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'spam_score',
                        name: 'spam_score'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ],
                responsive: true,
                pageLength: 25,
                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                order: [
                    [7, 'desc']
                ], // Sort by submitted date descending
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'csv',
                    text: 'Export CSV',
                    className: 'dt-button',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7] // Exclude actions column
                    }
                }],
                language: {
                    search: "Search contacts:",
                    lengthMenu: "Show _MENU_ contacts per page",
                    info: "Showing _START_ to _END_ of _TOTAL_ contacts",
                    infoEmpty: "No contacts found",
                    infoFiltered: "(filtered from _MAX_ total contacts)",
                    emptyTable: "No contact submissions found",
                    zeroRecords: "No matching contacts found",
                    processing: "Loading contacts..."
                }
            });

            // Filter event handlers
            $('#status-filter, #type-filter, #spam-filter, #cv-filter').on('change', function() {
                table.draw();
            });

            // Clear filters
            $('#clear-filters').on('click', function() {
                $('#status-filter, #type-filter, #spam-filter, #cv-filter').val('');
                table.draw();
            });

            // Export CSV button
            $('#export-csv').on('click', function() {
                table.button('.buttons-csv').trigger();
            });
        });

        function openFollowUpModal(contactId) {
            document.getElementById('contactId').value = contactId;
            document.getElementById('followUpForm').action = `/admin/contacts/${contactId}/follow-ups`;
            document.getElementById('followUpModal').classList.remove('hidden');
        }

        function closeFollowUpModal() {
            document.getElementById('followUpModal').classList.add('hidden');
            document.getElementById('followUpForm').reset();
        }
    </script>
@endsection
