<!-- Header & Navigation -->
<header
	class="bg-white sticky top-0 z-50 transition-shadow duration-300"
	id="navbar"
>
	<nav class="container mx-auto px-6 py-4 flex justify-between items-center">
		<a
			class="flex items-center"
			href="{{ route('home') }}"
		>
			<img
				alt="Insane Staffing Inc Logo"
				class="h-4 w-auto"
				src="{{ asset('assets/images/resources/insane-staffing-logo-black-text.png') }}"
				style="min-width: 100px;"
			>
		</a>
		<div class="hidden md:flex space-x-6">
			<a
				class="text-gray-600 hover:text-dark-600 {{ Request::routeIs('home') ? 'text-dark-600 font-semibold border-b-2 border-dark-600' : '' }}"
				href="{{ route('home') }}"
			>Home</a>
			<a
				class="text-gray-600 hover:text-dark-600 {{ Request::routeIs('about') ? 'text-dark-600 font-semibold border-b-2 border-dark-600' : '' }}"
				href="{{ route('about') }}"
			>About Us</a>
			<a
				class="text-gray-600 hover:text-dark-600 {{ Request::routeIs('services') ? 'text-dark-600 font-semibold border-b-2 border-dark-600' : '' }}"
				href="{{ route('services') }}"
			>Our Services</a>
			<a
				class="text-gray-600 hover:text-dark-600 {{ Request::routeIs('contact') ? 'text-dark-600 font-semibold border-b-2 border-dark-600' : '' }}"
				href="{{ route('contact') }}"
			>Contact</a>
		</div>
		<!-- Mobile Menu Button -->
		<button
			class="md:hidden text-gray-700 focus:outline-none"
			id="mobile-menu-button"
		>
			<i class="fas fa-bars text-2xl"></i>
		</button>
	</nav>
	<!-- Mobile Menu -->
	<div
		class="hidden md:hidden px-6 pb-4"
		id="mobile-menu"
	>
		<a
			class="block py-2 text-gray-600 hover:text-dark-600 {{ Request::routeIs('home') ? 'text-dark-600 font-semibold' : '' }}"
			href="{{ route('home') }}"
		>Home</a>
		<a
			class="block py-2 text-gray-600 hover:text-dark-600 {{ Request::routeIs('about') ? 'text-dark-600 font-semibold' : '' }}"
			href="{{ route('about') }}"
		>About Us</a>
		<a
			class="block py-2 text-gray-600 hover:text-dark-600 {{ Request::routeIs('services') ? 'text-dark-600 font-semibold' : '' }}"
			href="{{ route('services') }}"
		>Our Services</a>
		<a
			class="block py-2 text-gray-600 hover:text-dark-600 {{ Request::routeIs('contact') ? 'text-dark-600 font-semibold' : '' }}"
			href="{{ route('contact') }}"
		>Contact</a>
	</div>
</header>
