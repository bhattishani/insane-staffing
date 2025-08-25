@extends('layouts.admin')

@section('title', 'Contact Details')

@section('content')
	<div class="max-w-3xl mx-auto">
		<div class="bg-white rounded-lg shadow-md p-6">
			<div class="mb-6">
				<a
					class="text-blue-600 hover:text-blue-800"
					href="{{ route('admin.contacts.index') }}"
				>
					<i class="fas fa-arrow-left mr-2"></i>Back to list
				</a>
			</div>

			<div class="grid md:grid-cols-2 gap-6 mb-6">
				<div>
					<h3 class="text-lg font-semibold mb-4">Contact Information</h3>
					<div class="space-y-3">
						<p><span class="font-medium">Name:</span> {{ $contact->name }}</p>
						<p><span class="font-medium">Email:</span> {{ $contact->email }}</p>
						<p><span class="font-medium">Phone:</span> {{ $contact->phone }}</p>
						<p><span class="font-medium">Type:</span> {{ $contact->inquiry_type }}</p>
					</div>
				</div>
				<div>
					<h3 class="text-lg font-semibold mb-4">Submission Details</h3>
					<div class="space-y-3">
						<p><span class="font-medium">Submitted:</span> {{ $contact->created_at->format('M d, Y h:i A A') }}</p>
						<p><span class="font-medium">Location:</span> {{ $contact->city }}, {{ $contact->country }}</p>
						<p><span class="font-medium">Last Follow-up:</span>
							{{ $contact->followUps->isNotEmpty() ? $contact->followUps->last()->follow_up_date->format('M d, Y h:i A A') : 'No follow-up yet' }}
						</p>
						<p><span class="font-medium">Spam Score:</span> {{ $contact->spam_score }}</p>
					</div>
				</div>
			</div>

			<div class="mb-6">
				<h3 class="text-lg font-semibold mb-4">Message</h3>
				<div class="bg-gray-50 p-4 rounded">
					{!! nl2br(e($contact->message)) !!}
				</div>
			</div>

			<div class="mb-6">
				<div class="space-y-4">
					@forelse($contact->followUps as $followUp)
						<div class="border rounded-lg p-4">
							<div class="flex justify-between items-start">
								<div>
									<h4 class="font-medium">{{ ucfirst($followUp->follow_up_type) }} - {{ ucfirst($followUp->status) }}</h4>
									<p class="text-sm text-gray-600">{{ $followUp->follow_up_date->format('M d, Y h:i A') }}</p>
								</div>
								@if ($followUp->next_follow_up_date)
									<span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm rounded-full">
										Next: {{ $followUp->next_follow_up_date->format('M d, Y') }}
									</span>
								@endif
							</div>
							<div class="mt-3">
								<p class="text-sm">{{ $followUp->notes }}</p>
								@if ($followUp->outcome)
									<p class="mt-2 text-sm font-medium">Outcome: {{ $followUp->outcome }}</p>
								@endif
							</div>
						</div>
					@empty
						<p class="text-gray-500 text-center py-4">No follow-ups recorded yet.</p>
					@endforelse
				</div>
			</div>

			<form
				action="{{ route('admin.contacts.update-status', $contact) }}"
				class="space-y-4"
				method="POST"
			>
				@csrf
				@method('PATCH')

				<div>
					<label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
					<select
						class="w-full"
						name="status"
					>
						<option
							{{ $contact->status === 'open' ? 'selected' : '' }}
							value="open"
						>Open</option>
						<option
							{{ $contact->status === 'processing' ? 'selected' : '' }}
							value="processing"
						>Processing</option>
						<option
							{{ $contact->status === 'closed' ? 'selected' : '' }}
							value="closed"
						>Closed</option>
					</select>
				</div>

				<div class="mb-4">
					<label
						class="block text-sm font-medium text-gray-700 mb-2"
						for="follow_up_notes"
					>
						Follow-up Notes
					</label>
					<textarea
					 class="w-full rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none shadow-sm p-3 text-sm text-gray-800 placeholder-gray-400 resize-none transition duration-200"
					 id="follow_up_notes"
					 name="follow_up_notes"
					 placeholder="Write your notes here..."
					 rows="4"
					>{{ $contact->follow_up_notes }}</textarea>
				</div>

				<div>
					<button
						class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
						type="submit"
					>
						Update Status
					</button>
				</div>
			</form>
		</div>
	</div>
@endsection
