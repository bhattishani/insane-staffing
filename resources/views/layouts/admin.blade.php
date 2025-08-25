<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta
		content="width=device-width, initial-scale=1.0"
		name="viewport"
	>
	<title>@yield('title', 'Admin Dashboard') - Insane Staffing</title>
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
	<link
		href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
		rel="stylesheet"
	/>
</head>

<body class="bg-gray-100">
	<div class="min-h-screen flex flex-col lg:flex-row relative">
		<!-- Mobile Menu Button -->
		<button
			class="lg:hidden fixed top-4 left-4 z-50 bg-dark-700 text-white p-2 rounded-lg"
			onclick="toggleSidebar()"
			type="button"
		>
			<i class="fas fa-bars"></i>
		</button>

		<!-- Sidebar -->
		<nav
			class="w-64 bg-dark-700 text-white p-4 fixed inset-y-0 left-0 transform -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out lg:relative z-30"
			id="sidebar"
		>
			<div class="mb-8 mt-14 lg:mt-0">
				<h1 class="text-2xl font-bold">Admin Dashboard</h1>
			</div>
			<ul class="space-y-2">
				<li>
					<a
						class="block py-2 px-4 rounded hover:bg-dark-600 {{ request()->routeIs('admin.dashboard') ? 'bg-dark-600' : '' }}"
						href="{{ route('admin.dashboard') }}"
					>
						<i class="fas fa-tachometer-alt mr-2"></i> Dashboard
					</a>
				</li>
				<li>
					<a
						class="block py-2 px-4 rounded hover:bg-dark-600 {{ request()->routeIs('admin.contacts.*') ? 'bg-dark-600' : '' }}"
						href="{{ route('admin.contacts.index') }}"
					>
						<i class="fas fa-envelope mr-2"></i> Contact Submissions
					</a>
				</li>
				<li>
					<a
						class="block py-2 px-4 rounded hover:bg-dark-600 {{ request()->routeIs('admin.profile.*') ? 'bg-dark-600' : '' }}"
						href="{{ route('admin.profile.edit') }}"
					>
						<i class="fas fa-user-circle mr-2"></i> Profile Settings
					</a>
				</li>
				<li>
					<form
						action="{{ route('logout') }}"
						class="block"
						method="POST"
					>
						@csrf
						<button
							class="w-full text-left py-2 px-4 rounded hover:bg-dark-600"
							type="submit"
						>
							<i class="fas fa-sign-out-alt mr-2"></i> Logout
						</button>
					</form>
				</li>
			</ul>
		</nav>

		<!-- Overlay -->
		<div
			class="fixed inset-0 bg-black opacity-50 z-20 hidden lg:hidden"
			id="overlay"
			onclick="toggleSidebar()"
		></div>

		<!-- Main Content -->
		<main class="flex-1 p-4 lg:p-8 mt-14 lg:mt-0">
			@if (session('success'))
				<div
					class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
					role="alert"
				>
					<span class="block sm:inline">{{ session('success') }}</span>
				</div>
			@endif

			@yield('content')
		</main>

		<script>
			function toggleSidebar() {
				const sidebar = document.getElementById('sidebar');
				const overlay = document.getElementById('overlay');

				if (sidebar.classList.contains('-translate-x-full')) {
					sidebar.classList.remove('-translate-x-full');
					overlay.classList.remove('hidden');
				} else {
					sidebar.classList.add('-translate-x-full');
					overlay.classList.add('hidden');
				}
			}
		</script>
		<script
			src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
			integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
			crossorigin="anonymous"
			referrerpolicy="no-referrer"
		></script>
		<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
		<script>
			document.addEventListener('DOMContentLoaded', function() {
				// Initialize Select2 on all select elements
				$('select').select2({
					width: "100%"
				});
			});
		</script>
	</div>
</body>

</html>
