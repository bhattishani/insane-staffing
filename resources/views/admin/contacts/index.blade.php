@extends('layouts.admin')

@section('title', 'Contact Submissions')

@section('content')
	<div class="bg-white rounded-lg shadow-md p-4 sm:p-6">
		<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 sm:gap-6 mb-6">
			<h2 class="text-xl sm:text-2xl font-bold">Contact Submissions</h2>
			<div class="w-full sm:w-auto">
				<form
					action="{{ route('admin.contacts.index') }}"
					class="flex items-center gap-2"
					method="GET"
				>
					<label
						class="flex items-center gap-2 cursor-pointer px-3 py-2 rounded-lg border border-red-500 bg-red-50 hover:bg-red-100 text-red-600 font-medium shadow-sm transition"
					>
						<input
							{{ request()->has('show_spam') ? 'checked' : '' }}
							class="h-4 w-4 text-red-600 border-red-400 focus:ring-red-500 focus:ring-opacity-50 rounded"
							name="show_spam"
							onchange="this.form.submit()"
							type="checkbox"
							value="1"
						>
						🚨 Show Spam
					</label>

				</form>
			</div>
		</div>

		<div class="overflow-x-auto">
			<div class="min-w-full inline-block align-middle">
				<div class="overflow-hidden">
					<table class="min-w-full divide-y divide-gray-200">
						<thead>
							<tr class="bg-gray-50">
								<th class="px-4 py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">Name</th>
								<th
									class="hidden sm:table-cell px-4 py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider"
								>Email</th>
								<th
									class="hidden md:table-cell px-4 py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider"
								>Phone</th>
								<th
									class="hidden lg:table-cell px-4 py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider"
								>Type</th>
								<th class="px-4 py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">Status</th>
								<th class="px-4 py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">Spam Score
								</th>
								<th
									class="hidden sm:table-cell px-4 py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider"
								>Submitted</th>
								<th class="px-4 py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">Actions
								</th>
							</tr>
						</thead>
						<tbody class="divide-y">
							@forelse ($contacts as $contact)
								<tr class="hover:bg-gray-50">
									<td class="px-4 py-3">{{ $contact->name }}</td>
									<td class="px-4 py-3">{{ $contact->email }}</td>
									<td class="px-4 py-3">{{ $contact->phone }}</td>
									<td class="px-4 py-3">{{ $contact->inquiry_type }}</td>
									<td class="px-4 py-3">
										<span
											class="px-2 py-1 rounded text-sm
                                    @if ($contact->status === 'open') bg-yellow-100 text-yellow-800
                                    @elseif($contact->status === 'processing') bg-blue-100 text-blue-800
                                    @else bg-green-100 text-green-800 @endif"
										>
											{{ ucfirst($contact->status) }}
										</span>
									</td>
									<td class="px-4 py-3">
										@if ($contact->spam_score !== null)
											<span
												class="px-2 py-1 text-sm rounded-full
										@if ($contact->spam_score < 0.2) bg-green-100 text-green-800
										@elseif($contact->spam_score < 0.5) bg-orange-100 text-orange-800
										@else bg-red-100 text-red-800 @endif"
											>
												{{ number_format($contact->spam_score, 2) }}
											</span>
										@else
											<span class="text-gray-400">N/A</span>
										@endif
									</td>
									<td class="px-4 py-3">{{ $contact->created_at->format('M d, Y H:i') }}</td>
									<td class="px-4 py-3 space-x-2">
										<a
											class="text-blue-600 hover:text-blue-800"
											href="{{ route('admin.contacts.show', $contact) }}"
										>
											<i class="fas fa-eye"></i>
										</a>
										<button
											class="text-green-600 hover:text-green-800"
											onclick="openFollowUpModal({{ $contact->id }})"
											type="button"
										>
											<i class="fas fa-phone"></i>
										</button>
									</td>
								</tr>
							@empty
								<tr>
									<td
										class="px-4 py-8 text-center text-gray-500"
										colspan="8"
									>
										<div class="flex flex-col items-center justify-center">
											<i class="fas fa-inbox text-4xl mb-3"></i>
											<p class="text-lg font-medium">No contact submissions found</p>
											<p class="text-sm">Contact submissions will appear here when customers fill out the contact form.</p>
										</div>
									</td>
								</tr>
							@endforelse
						</tbody>
					</table>
				</div>

				<div class="mt-4">
					{{ $contacts->links() }}
				</div>
			</div>

			<!-- Follow-up Modal -->
			<div
				class="fixed inset-0 bg-gray-500 bg-opacity-75 hidden"
				id="followUpModal"
				x-cloak
				x-show="open"
			>
				<div class="flex items-center justify-center min-h-screen p-4">
					<div class="bg-white rounded-lg shadow-xl max-w-lg w-full">
						<div class="p-6">
							<div class="flex justify-between items-center mb-4">
								<h3 class="text-lg font-semibold">Add Follow-up</h3>
								<button
									onclick="closeFollowUpModal()"
									type="button"
								>
									<i class="fas fa-times"></i>
								</button>
							</div>

							<form
								action=""
								class="space-y-4"
								id="followUpForm"
								method="POST"
							>
								@csrf
								<input
									id="contactId"
									name="contact_id"
									type="hidden"
								>

								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
									<select
										class="w-full rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none shadow-sm p-3 text-sm text-gray-800 placeholder-gray-400 resize-none transition duration-200"
										name="status"
										required
									>
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
										name="follow_up_type"
										required
									>
										<option value="call">Phone Call</option>
										<option value="email">Email</option>
										<option value="meeting">Meeting</option>
									</select>
								</div>

								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Follow-up Date</label>
									<input
										class="w-full rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none shadow-sm p-3 text-sm text-gray-800 placeholder-gray-400 resize-none transition duration-200"
										name="follow_up_date"
										required
										type="datetime-local"
									>
								</div>

								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Next Follow-up Date</label>
									<input
										class="w-full rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none shadow-sm p-3 text-sm text-gray-800 placeholder-gray-400 resize-none transition duration-200"
										name="next_follow_up_date"
										type="datetime-local"
									>
								</div>

								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
									<textarea
									 class="w-full rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none shadow-sm p-3 text-sm text-gray-800 placeholder-gray-400 resize-none transition duration-200"
									 name="notes"
									 required
									 rows="4"
									></textarea>
								</div>

								<div>
									<label class="block text-sm font-medium text-gray-700 mb-2">Outcome</label>
									<input
										class="w-full rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none shadow-sm p-3 text-sm text-gray-800 placeholder-gray-400 resize-none transition duration-200"
										name="outcome"
										type="text"
									>
								</div>

								<div class="flex justify-end space-x-3">
									<button
										class="px-4 py-2 text-sm border rounded-md hover:bg-gray-50"
										onclick="closeFollowUpModal()"
										type="button"
									>
										Cancel
									</button>
									<button
										class="px-4 py-2 text-sm bg-blue-600 text-white rounded-md hover:bg-blue-700"
										type="submit"
									>
										Save Follow-up
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<script>
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
