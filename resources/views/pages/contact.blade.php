@extends('layouts.main')

@section('title', 'Contact Insane Staffing | 24/7 Support | Get in Touch')

@section('meta')
	<meta
		content="Contact Insane Staffing for all your staffing needs. Available 24/7 via phone or email. Get expert recruitment solutions for your business or find your next career opportunity."
		name="description"
	>
	<meta
		content="contact Insane Staffing, staffing agency contact, recruitment agency toronto, hiring support, job search help, staffing solutions contact"
		name="keywords"
	>
	<meta
		content="Insane Staffing"
		name="author"
	>
	<meta
		content="Contact Insane Staffing | Available 24/7"
		property="og:title"
	>
	<meta
		content="Get in touch with Canada's leading staffing agency. Available 24/7 for all your recruitment and career needs."
		property="og:description"
	>
	<meta
		content="{{ asset('assets/images/resources/insane-staffing-logo-black-text.png') }}"
		property="og:image"
	>
	<meta
		content="https://insanestaffing.ca/contact"
		property="og:url"
	>
	<meta
		content="summary_large_image"
		name="twitter:card"
	>
	<meta
		content="Contact Insane Staffing | 24/7 Support"
		name="twitter:title"
	>
	<meta
		content="Need staffing solutions? Contact us anytime. Available 24/7 to help with your recruitment needs."
		name="twitter:description"
	>
	<link
		href="https://insanestaffing.ca/contact"
		rel="canonical"
	>
	<meta
		content="index, follow"
		name="robots"
	>
	<script
		src="https://www.google.com/recaptcha/api.js"
		async
		defer
	></script>
@endsection

@section('style')
	<style>
		body {
			font-family: 'Poppins', sans-serif;
		}

		nav.scrolled {
			box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
			background-color: white;
		}

		.spinner {
			display: none;
			width: 20px;
			height: 20px;
			border: 3px solid #f3f3f3;
			border-radius: 50%;
			border-top: 3px solid #1f2937;
			animation: spin 1s linear infinite;
			margin-left: 10px;
		}

		@keyframes spin {
			0% {
				transform: rotate(0deg);
			}

			100% {
				transform: rotate(360deg);
			}
		}

		.button-content {
			display: flex;
			align-items: center;
			justify-content: center;
		}

		/* Modal styles */
		.modal {
			display: none;
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background-color: rgba(0, 0, 0, 0.5);
			z-index: 1000;
			padding: 20px;
		}

		.modal-content {
			background-color: white;
			max-width: 500px;
			margin: 50px auto;
			border-radius: 8px;
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
			transform: translateY(-50px);
			opacity: 0;
			transition: all 0.3s ease-out;
		}

		.modal.active .modal-content {
			transform: translateY(0);
			opacity: 1;
		}

		.modal-header {
			padding: 1.5rem;
			border-bottom: 1px solid #e5e7eb;
		}

		.modal-body {
			padding: 1.5rem;
		}

		.modal-footer {
			padding: 1rem 1.5rem;
			border-top: 1px solid #e5e7eb;
			display: flex;
			justify-content: flex-end;
		}

		.social-links {
			display: flex;
			justify-content: center;
			gap: 1rem;
			margin-top: 1rem;
		}

		.social-links a {
			color: #4b5563;
			transition: color 0.2s;
		}

		.social-links a:hover {
			color: #1f2937;
		}
	</style>
@endsection

@section('main')
	<!-- Page Header -->
	<section class="bg-dark-700 text-white text-center py-16">
		<div class="container mx-auto px-6">
			<h1 class="text-4xl font-bold">Get In Touch</h1>
			<p class="mt-2 text-lg text-dark-200">We're here to help 24/7. Reach out to us anytime.</p>
		</div>
	</section>

	<!-- Contact Section -->
	<section class="py-20">
		<div class="container mx-auto px-6">
			<div
				class="flex flex-row items-center gap-4 mb-8"
				id="success-message"
				style="display: none"
			>
				<i class="fas fa-check-circle text-green-500 text-4xl"></i>
				<h3 class="text-2xl font-bold text-gray-900">
					Thank You for Contacting Us!
				</h3>
			</div>
			<div class="grid md:grid-cols-2 gap-12">
				<!-- Contact Form -->
				<div class="bg-white p-8 rounded-lg shadow-lg">
					<h2 class="text-2xl font-bold mb-6">Send Us a Message</h2>
					<form
						action="{{ route('contact.submit') }}"
						method="POST"
						onsubmit="return false"
					>
						@csrf
						<div class="mb-4">
							<label
								class="block text-gray-700 font-semibold mb-2"
								for="name"
							>Name</label>
							<input
								class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
								id="name"
								name="name"
								required
								type="text"
							>
						</div>
						<div class="mb-4">
							<label
								class="block text-gray-700 font-semibold mb-2"
								for="email"
							>Email</label>
							<input
								class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
								id="email"
								name="email"
								required
								type="email"
							>
						</div>
						<div class="mb-4">
							<label
								class="block text-gray-700 font-semibold mb-2"
								for="phone"
							>Phone</label>
							<input
								class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
								id="phone"
								name="phone"
								required
								type="tel"
							>
						</div>
						<div class="mb-4">
							<label
								class="block text-gray-700 font-semibold mb-2"
								for="inquiry_type"
							>I am a...</label>
							<select
								class="w-full px-4 py-2 border rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
								id="inquiry_type"
								name="inquiry_type"
							>
								<option
									selected
									value="Business"
								>Business</option>
								<option value="Job Seeker">Job Seeker</option>
							</select>
						</div>
						<div class="mb-6">
							<label
								class="block text-gray-700 font-semibold mb-2"
								for="message"
							>Message</label>
							<textarea
							 class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
							 id="message"
							 name="message"
							 required
							 rows="5"
							></textarea>
						</div>
						<div class="mb-6">
							<div
								class="g-recaptcha"
								data-sitekey="{{ config('recaptcha.site_key') }}"
							></div>
						</div>
						<div
							class="mb-4 text-red-600 hidden"
							id="form-error"
						></div>
						<div>
							<button
								class="w-full bg-dark-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-dark-700 transition-colors"
								id="submit-button"
								type="submit"
							>
								<span class="button-content">
									<span>Send Message</span>
									<span
										class="spinner"
										id="submit-spinner"
									></span>
								</span>
							</button>
						</div>
						<input
							id="device_fingerprint"
							name="device_fingerprint"
							type="hidden"
						>
					</form>
				</div>
				<!-- Contact Info -->
				<div class="space-y-8">
					<div class="bg-white p-8 rounded-lg shadow-lg">
						<h3 class="text-2xl font-bold mb-4">Contact Information</h3>
						<p class="text-lg mb-4">Feel free to call or email us. We are available around the clock to
							assist you with your staffing needs or career questions.</p>
						<div class="space-y-4">
							<p class="text-lg flex items-center">
								<i class="fas fa-phone text-dark-600 mr-4"></i>
								<span>
									<span class="font-semibold block">Call us 24/7:</span>
									<a
										class="text-gray-700 hover:text-dark-600"
										href="tel:+16472670072"
									>+1 (647) 267-0072</a>
								</span>
							</p>
							<p class="text-lg flex items-center">
								<i class="fas fa-envelope text-dark-600 mr-4"></i>
								<span>
									<span class="font-semibold block">Email us:</span>
									<a
										class="text-gray-700 hover:text-dark-600"
										href="mailto:insanestaffing@gmail.com"
									>insanestaffing@gmail.com</a>
								</span>
							</p>
						</div>
					</div>
					<div class="bg-white p-8 rounded-lg shadow-lg">
						<h3 class="text-2xl font-bold mb-4">Connect With Us</h3>
						<div class="flex space-x-4">
							<a
								class="text-gray-600 hover:text-dark-600 text-3xl"
								href="https://www.instagram.com/insanestaffing"
								rel="noopener noreferrer"
								target="_blank"
							><i class="fab fa-instagram"></i></a>
							<a
								class="text-gray-600 hover:text-dark-600 text-3xl"
								href="https://www.linkedin.com/company/insane-staffing"
								rel="noopener noreferrer"
								target="_blank"
							><i class="fab fa-linkedin"></i></a>
							<a
								class="text-gray-600 hover:text-dark-600 text-3xl"
								href="https://x.com/InsaneStaffing"
								rel="noopener noreferrer"
								target="_blank"
							><i class="fab fa-twitter"></i></a>
							<a
								class="text-gray-600 hover:text-dark-600 text-3xl"
								href="https://www.facebook.com/share/1AM1tcqV9L"
								rel="noopener noreferrer"
								target="_blank"
							><i class="fab fa-facebook"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Success Modal -->
	<div
		class="modal"
		id="success-modal"
	>
		<div class="modal-content">
			<div class="modal-header flex flex-row items-center gap-4">
				<i class="fas fa-check-circle text-green-500 text-4xl"></i>
				<h3 class="text-2xl font-bold text-gray-900">
					Thank You for Contacting Us!
				</h3>
			</div>
			<div class="modal-body">
				<div class="mb-4">
					<p class="text-gray-600 mb-4">Your message has been successfully sent. Our team will process your request and
						contact you as soon as possible.</p>
					<p class="text-gray-600">Meanwhile, please feel free to explore our social media channels for more updates and
						information about our services:</p>
				</div>
				<div class="social-links text-2xl">
					<a
						href="https://www.instagram.com/insanestaffing"
						rel="noopener noreferrer"
						target="_blank"
						title="Follow us on Instagram"
					><i class="fab fa-instagram"></i></a>
					<a
						href="https://www.linkedin.com/company/insane-staffing"
						rel="noopener noreferrer"
						target="_blank"
						title="Connect with us on LinkedIn"
					><i class="fab fa-linkedin"></i></a>
					<a
						href="https://x.com/InsaneStaffing"
						rel="noopener noreferrer"
						target="_blank"
						title="Follow us on X"
					><i class="fab fa-twitter"></i></a>
					<a
						href="https://www.facebook.com/share/1AM1tcqV9L"
						rel="noopener noreferrer"
						target="_blank"
						title="Like us on Facebook"
					><i class="fab fa-facebook"></i></a>
				</div>
			</div>
			<div class="modal-footer">
				<button
					class="bg-dark-600 text-white px-4 py-2 rounded hover:bg-dark-700 transition-colors"
					id="close-modal"
					type="button"
				>Close</button>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script src="https://unpkg.com/@fingerprintjs/fingerprintjs@3/dist/fp.min.js"></script>
	<script>
		// Cookie management functions
		const setCookie = (name, value, days) => {
			const d = new Date();
			d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
			const expires = "expires=" + d.toUTCString();
			document.cookie = name + "=" + value + ";" + expires + ";path=/";
		};

		const getCookie = (name) => {
			const value = `; ${document.cookie}`;
			const parts = value.split(`; ${name}=`);
			if (parts.length === 2) return parts.pop().split(';').shift();
			return null;
		};

		document.addEventListener('DOMContentLoaded', async function() {
			const fpPromise = FingerprintJS.load();
			const successMessage = document.getElementById('success-message');

			// Check for success cookie on page load
			const submittedVisitorId = getCookie('contact_submitted');
			const currentVisitorId = getCookie('visitor_id');

			if (submittedVisitorId && currentVisitorId && submittedVisitorId === currentVisitorId) {
				successMessage.style.display = 'flex';
			}

			// Get the visitor identifier when you need it.
			fpPromise
				.then(fp => fp.get())
				.then(result => {
					// This is the visitor identifier:
					const visitorId = result.visitorId;
					document.getElementById('device_fingerprint').value = visitorId;
					// Store visitor ID in cookie
					setCookie('visitor_id', visitorId, 30); // Store for 30 days
				})

			// Form submission
			document.querySelector('form').addEventListener('submit', async function(e) {
				e.preventDefault();
				const form = e.target;
				const submitButton = document.getElementById('submit-button');
				const submitSpinner = document.getElementById('submit-spinner');
				const errorDiv = document.getElementById('form-error');
				const inputs = form.querySelectorAll('input, textarea, select');

				// Reset validation styling
				inputs.forEach(input => {
					input.classList.remove('border-red-500');
				});
				errorDiv.classList.add('hidden');
				submitButton.disabled = true;
				submitSpinner.style.display = 'block';

				try {
					const response = await fetch(form.action, {
						method: 'POST',
						body: new FormData(form),
						headers: {
							'X-Requested-With': 'XMLHttpRequest',
							"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
								.getAttribute('content')
						}
					});

					const data = await response.json();

					if (response.ok) {
						form.reset();
						grecaptcha.reset();

						// Store submission in cookie
						const visitorId = document.getElementById('device_fingerprint').value;
						setCookie('contact_submitted', visitorId, 30); // Store for 30 days

						// Show success message
						document.getElementById('success-message').style.display = 'flex';

						// Show success modal
						const modal = document.getElementById('success-modal');
						modal.style.display = 'block';
						setTimeout(() => modal.classList.add('active'), 10);

						// Handle modal close
						const closeModal = () => {
							modal.classList.remove('active');
							setTimeout(() => modal.style.display = 'none', 300);
						};

						// Close modal on button click
						document.getElementById('close-modal').onclick = closeModal;

						// Close modal on outside click
						modal.onclick = (e) => {
							if (e.target === modal) closeModal();
						};

						// Close modal on escape key
						document.addEventListener('keydown', (e) => {
							if (e.key === 'Escape' && modal.style.display === 'block')
								closeModal();
						});
					} else {
						if (data.errors) {
							Object.keys(data.errors).forEach(key => {
								const input = form.querySelector(`[name="${key}"]`);
								if (input) {
									input.classList.add('border-red-500');
								}
							});
							errorDiv.textContent = Object.values(data.errors).flat().join(' ');
							errorDiv.classList.remove('hidden');
						} else {
							errorDiv.textContent = data.message ||
								'An error occurred. Please try again.';
							errorDiv.classList.remove('hidden');
						}
					}
				} catch (error) {
					errorDiv.textContent = 'An error occurred. Please try again.';
					errorDiv.classList.remove('hidden');
				} finally {
					submitButton.disabled = false;
					submitSpinner.style.display = 'none';
				}
			});
		});
	</script>
@endsection
