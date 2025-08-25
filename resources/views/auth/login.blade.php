<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta
		content="width=device-width, initial-scale=1.0"
		name="viewport"
	>
	<title>Admin Login - Insane Staffing</title>
	<script
		data-cfasync="false"
		src="https://cdn.tailwindcss.com"
	></script>
	<script>
		tailwind.config = {
			theme: {
				extend: {
					colors: {
						'dark': {
							500: '#1f2937',
							600: '#1f2937',
							700: '#1f2937'
						}
					}
				}
			}
		}
	</script>
	<link
		href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
		rel="stylesheet"
	>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen px-4 sm:px-6 lg:px-8">
	<div class="max-w-md w-full">
		<div class="text-center mb-6 sm:mb-8">
			<h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Admin Login</h2>
			<p class="text-sm sm:text-base text-gray-600 mt-2">Enter your credentials to access the admin dashboard</p>
		</div>

		<div class="bg-white p-6 sm:p-8 rounded-lg shadow-md">
			@if ($errors->any())
				<div
					class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
					role="alert"
				>
					@foreach ($errors->all() as $error)
						<p>{{ $error }}</p>
					@endforeach
				</div>
			@endif

			<form
				action="{{ route('login') }}"
				class="space-y-6"
				method="POST"
			>
				@csrf
				<div>
					<label
						class="block text-sm font-medium text-gray-700"
						for="email"
					>Email</label>
					<input
						class="w-full rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none shadow-sm p-3 text-sm text-gray-800 placeholder-gray-400 resize-none transition duration-200"
						id="email"
						name="email"
						required
						type="email"
						value="{{ old('email') }}"
					>
				</div>

				<div>
					<label
						class="block text-sm font-medium text-gray-700"
						for="password"
					>Password</label>
					<input
						class="w-full rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 focus:outline-none shadow-sm p-3 text-sm text-gray-800 placeholder-gray-400 resize-none transition duration-200"
						id="password"
						name="password"
						required
						type="password"
					>
				</div>

				<div class="flex items-center justify-between">
					<div class="flex items-center">
						<input
							class="h-4 w-4 text-dark-600 focus:ring-dark-600 rounded"
							id="remember"
							name="remember"
							type="checkbox"
						>
						<label
							class="ml-2 block text-sm text-gray-700"
							for="remember"
						>Remember me</label>
					</div>
				</div>

				<button
					class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-dark-600 hover:bg-dark-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-dark-600"
					type="submit"
				>
					Sign in
				</button>
			</form>
		</div>
	</div>
</body>

</html>
