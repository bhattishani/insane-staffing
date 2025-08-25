<!-- Footer -->
<footer class="bg-gray-900 text-white">
	<div class="container mx-auto px-6 py-12">
		<div class="grid md:grid-cols-4 gap-8 mb-8">
			<div class="flex items-center flex-col">
				<a href="{{ route('home') }}">
					<img
						alt="Insane Staffing Inc Logo"
						src="{{ asset('assets/images/resources/insane-staffing-logo-white-small.png') }}"
						style="height: 150px;"
					>
				</a>
				<p class="text-gray-400 text-center mt-2">Next-generation talent solutions for Canada's leading
					industries.</p>
			</div>
			<div>
				<h4 class="text-lg font-semibold mb-4">Quick Links</h4>
				<ul>
					<li><a
							class="text-gray-400 hover:text-white"
							href="{{ route('about') }}"
						>About Us</a></li>
					<li><a
							class="text-gray-400 hover:text-white"
							href="{{ route('services') }}"
						>Services</a></li>
					<li><a
							class="text-gray-400 hover:text-white"
							href="{{ route('contact') }}"
						>Contact</a></li>
				</ul>
			</div>
			<div>
				<h4 class="text-lg font-semibold mb-4">Contact Info</h4>
				<p class="text-gray-400"><i class="fas fa-phone mr-2"></i> <a
						class="hover:text-white"
						href="tel:+16472670072"
					>+1 (647) 267-0072</a></p>
				<p class="text-gray-400"><i class="fas fa-envelope mr-2"></i> <a
						class="hover:text-white"
						href="mailto:insanestaffing@gmail.com"
					>insanestaffing@gmail.com</a>
				</p>
			</div>
			<div>
				<h4 class="text-lg font-semibold mb-4">Follow Us</h4>
				<div class="flex space-x-4">
					<a
						class="text-gray-400 hover:text-white text-2xl"
						href="https://www.instagram.com/insanestaffing"
						rel="noopener noreferrer"
						target="_blank"
					><i class="fab fa-instagram"></i></a>
					<a
						class="text-gray-400 hover:text-white text-2xl"
						href="https://www.linkedin.com/company/insane-staffing"
						rel="noopener noreferrer"
						target="_blank"
					><i class="fab fa-linkedin"></i></a>
					<a
						class="text-gray-400 hover:text-white text-2xl"
						href="https://x.com/InsaneStaffing"
						rel="noopener noreferrer"
						target="_blank"
					><i class="fab fa-twitter"></i></a>
					<a
						class="text-gray-400 hover:text-white text-2xl"
						href="https://www.facebook.com/share/1AM1tcqV9L"
						rel="noopener noreferrer"
						target="_blank"
					><i class="fab fa-facebook"></i></a>
				</div>
			</div>
		</div>
		<div class="border-t border-gray-700 pt-6 text-center text-gray-500">
			<p>&copy; {{ date('Y') }} Insane Staffing. All Rights Reserved.</p>
		</div>
	</div>
</footer>
