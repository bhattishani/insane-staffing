@extends('layouts.admin')

@section('title', 'Profile Settings')

@section('content')
	<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
		<div class="bg-white rounded-lg shadow-md p-4 sm:p-6">
			<h2 class="text-xl sm:text-2xl font-bold mb-6">Profile Settings</h2>

			@if (session('success'))
				<div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
					{{ session('success') }}
				</div>
			@endif

			<form
				action="{{ route('admin.profile.update') }}"
				class="space-y-6"
				method="POST"
			>
				@csrf
				@method('PATCH')

				<div>
					<label
						class="block text-sm font-medium text-gray-700 mb-2"
						for="name"
					>
						Name
					</label>
					<input
						class="w-full rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none shadow-sm p-3 text-sm text-gray-800 @error('name') border-red-500 @enderror"
						id="name"
						name="name"
						required
						type="text"
						value="{{ old('name', auth()->user()->name) }}"
					>
					@error('name')
						<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
					@enderror
				</div>

				<div>
					<label
						class="block text-sm font-medium text-gray-700 mb-2"
						for="email"
					>
						Email Address
					</label>
					<input
						class="w-full rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none shadow-sm p-3 text-sm text-gray-800 @error('email') border-red-500 @enderror"
						id="email"
						name="email"
						required
						type="email"
						value="{{ old('email', auth()->user()->email) }}"
					>
					@error('email')
						<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
					@enderror
				</div>

				<div class="border-t pt-6">
					<h3 class="text-lg font-semibold mb-4">Change Password</h3>

					<div class="space-y-4">
						<div>
							<label
								class="block text-sm font-medium text-gray-700 mb-2"
								for="current_password"
							>
								Current Password
							</label>
							<input
								class="w-full rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none shadow-sm p-3 text-sm text-gray-800 @error('current_password') border-red-500 @enderror"
								id="current_password"
								name="current_password"
								type="password"
							>
							@error('current_password')
								<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
							@enderror
						</div>

						<div>
							<label
								class="block text-sm font-medium text-gray-700 mb-2"
								for="password"
							>
								New Password
							</label>
							<input
								class="w-full rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none shadow-sm p-3 text-sm text-gray-800 @error('password') border-red-500 @enderror"
								id="password"
								name="password"
								type="password"
							>
							@error('password')
								<p class="mt-1 text-sm text-red-600">{{ $message }}</p>
							@enderror
						</div>

						<div>
							<label
								class="block text-sm font-medium text-gray-700 mb-2"
								for="password_confirmation"
							>
								Confirm New Password
							</label>
							<input
								class="w-full rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none shadow-sm p-3 text-sm text-gray-800"
								id="password_confirmation"
								name="password_confirmation"
								type="password"
							>
						</div>
					</div>
				</div>

				<div class="flex justify-end pt-6">
					<button
						class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200"
						type="submit"
					>
						Save Changes
					</button>
				</div>
			</form>
		</div>
	</div>
@endsection
