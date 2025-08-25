<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta
		content="width=device-width, initial-scale=1.0"
		name="viewport"
	>
	<title>
		@yield('title')
	</title>
	@yield('meta')
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
		href="https://fonts.googleapis.com"
		rel="preconnect"
	>
	<link
		crossorigin
		href="https://fonts.gstatic.com"
		rel="preconnect"
	>
	<link
		href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
		rel="stylesheet"
	>
	@yield('style')
</head>

<body class="text-gray-800">
	@include('components.header')
	<main>
		@yield('main')
	</main>

	@include('components.footer')

	<script>
		const navbar = document.getElementById('navbar');
		const mobileMenuButton = document.getElementById('mobile-menu-button');
		const mobileMenu = document.getElementById('mobile-menu');

		// Navbar scroll effect
		window.addEventListener('scroll', () => {
			if (window.scrollY > 50) {
				navbar.classList.add('scrolled');
				navbar.classList.remove('bg-transparent');
			} else {
				navbar.classList.remove('scrolled');
				navbar.classList.add('bg-transparent');
			}
		});

		// Mobile menu toggle
		mobileMenuButton.addEventListener('click', () => {
			mobileMenu.classList.toggle('hidden');
		});

		// Scroll Reveal Animation
		const revealElements = document.querySelectorAll('.reveal');
		const revealOnScroll = () => {
			const windowHeight = window.innerHeight;
			revealElements.forEach(el => {
				const elementTop = el.getBoundingClientRect().top;
				const elementVisible = 100;
				if (elementTop < windowHeight - elementVisible) {
					el.classList.add('active');
				}
			});
		};

		window.addEventListener('scroll', revealOnScroll);
		// Trigger on load with a slight delay for hero elements
		setTimeout(revealOnScroll, 100);
	</script>

	@yield('script')
</body>

</html>
