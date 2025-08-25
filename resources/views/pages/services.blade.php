@extends('layouts.main')

@section('title', 'Staffing Services | Sales, Labour & Security Solutions | Insane Staffing')

@section('meta')
	<meta
		content="Expert staffing solutions in sales, general labour, and security. Get reliable, pre-vetted professionals for your business needs. Available 24/7 across Canada."
		name="description"
	>
	<meta
		content="sales staffing, general labour staffing, security guards Canada, temporary staffing, employment agency, recruitment services, staffing solutions"
		name="keywords"
	>
	<meta
		content="Insane Staffing"
		name="author"
	>
	<meta
		content="Professional Staffing Services | Insane Staffing"
		property="og:title"
	>
	<meta
		content="Find top talent in sales, labour, and security. Pre-vetted professionals ready to strengthen your workforce. Expert staffing solutions across Canada."
		property="og:description"
	>
	<meta
		content="{{ asset('assets/images/resources/insane-staffing-logo-black-text.png') }}"
		property="og:image"
	>
	<meta
		content="https://insanestaffing.ca/services"
		property="og:url"
	>
	<meta
		content="summary_large_image"
		name="twitter:card"
	>
	<meta
		content="Expert Staffing Solutions | Insane Staffing"
		name="twitter:title"
	>
	<meta
		content="Professional staffing services in sales, labour, and security. Get the workforce you need, when you need it."
		name="twitter:description"
	>
	<link
		href="https://insanestaffing.ca/services"
		rel="canonical"
	>
	<meta
		content="index, follow"
		name="robots"
	>
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

		.service-card:nth-child(odd) {
			flex-direction: row;
		}

		.service-card:nth-child(even) {
			flex-direction: row-reverse;
		}

		@media (max-width: 768px) {

			.service-card,
			.service-card:nth-child(even) {
				flex-direction: column;
			}
		}
	</style>
@endsection

@section('main')
	<!-- Page Header -->
	<section class="bg-dark-700 text-white text-center py-16">
		<div class="container mx-auto px-6">
			<h1 class="text-4xl font-bold">Our Staffing Solutions</h1>
			<p class="mt-2 text-lg text-dark-200">Designed to meet the diverse needs of Canadian businesses.</p>
		</div>
	</section>

	<!-- Services Sections -->
	<section class="py-20">
		<div class="container mx-auto px-6 space-y-16">

			<!-- Service 1: Sales Reps -->
			<div class="service-card bg-white p-8 rounded-lg shadow-lg flex gap-8 items-center overflow-hidden">
				<div class="w-full md:w-1/2">
					<h2 class="text-3xl font-bold text-dark-800">Sales Reps — Our Signature Service</h2>
					<p class="text-xl font-semibold text-gray-700 my-3">Sales Talent That Actually Sells</p>
					<p class="text-lg mb-6">We specialize in sourcing elite sales professionals who don't just meet
						quotas—they exceed them. Our rigorous vetting process ensures you get candidates with the
						right skills, experience, and drive to boost your revenue from day one.</p>
					<ul class="space-y-2">
						<li class="flex items-start"><i class="fas fa-check text-green-500 mr-2 mt-1"></i><strong>Industry-Specific
								Matching:</strong> Talent that knows your market.</li>
						<li class="flex items-start"><i class="fas fa-check text-green-500 mr-2 mt-1"></i><strong>Proven Track
								Records:</strong> Candidates with a history of success.</li>
						<li class="flex items-start"><i class="fas fa-check text-green-500 mr-2 mt-1"></i><strong>Measurable
								Results:</strong> Focused on driving your bottom line.</li>
					</ul>
				</div>
				<div class="hidden md:flex w-1/2 justify-center items-center">
					<i class="fas fa-chart-line text-9xl text-dark-200"></i>
				</div>
			</div>

			<!-- Service 2: General Labour -->
			<div class="service-card bg-white p-8 rounded-lg shadow-lg flex gap-8 items-center overflow-hidden">
				<div class="w-full md:w-1/2">
					<h2 class="text-3xl font-bold text-dark-800">General Labour</h2>
					<p class="text-xl font-semibold text-gray-700 my-3">The Workforce You Can Count On</p>
					<p class="text-lg mb-6">Whether you need an extra set of hands for a day or a full team for a
						long-term project, we provide reliable and hardworking individuals for a variety of general
						labour roles. Our workers are vetted for dependability and a strong work ethic.</p>
					<ul class="space-y-2">
						<li class="flex items-start"><i class="fas fa-check text-green-500 mr-2 mt-1"></i><strong>Skilled & Unskilled
								Options:</strong> The right fit for any task.</li>
						<li class="flex items-start"><i class="fas fa-check text-green-500 mr-2 mt-1"></i><strong>Short & Long-Term
								Placements:</strong> Flexible to your project needs.</li>
						<li class="flex items-start"><i class="fas fa-check text-green-500 mr-2 mt-1"></i><strong>Dependable & Vetted
								Workers:</strong> Punctual and ready to work.</li>
					</ul>
				</div>
				<div class="hidden md:flex w-1/2 justify-center items-center">
					<i class="fas fa-hard-hat text-9xl text-dark-200"></i>
				</div>
			</div>

			<!-- Service 3: Security Guards -->
			<div class="service-card bg-white p-8 rounded-lg shadow-lg flex gap-8 items-center overflow-hidden">
				<div class="w-full md:w-1/2">
					<h2 class="text-3xl font-bold text-dark-800">Security Guards</h2>
					<p class="text-xl font-semibold text-gray-700 my-3">Your Safety, Our Priority</p>
					<p class="text-lg mb-6">Protect your people, property, and assets with our professional security
						services. We provide fully licensed, trained, and uniformed security guards for commercial,
						industrial, and event security needs. Our team is your first line of defense.</p>
					<ul class="space-y-2">
						<li class="flex items-start"><i class="fas fa-check text-green-500 mr-2 mt-1"></i><strong>Licensed & Trained
								Personnel:</strong> Certified and highly skilled.</li>
						<li class="flex items-start"><i class="fas fa-check text-green-500 mr-2 mt-1"></i><strong>Professional
								Presence:</strong> Deterrents to potential threats.</li>
						<li class="flex items-start"><i class="fas fa-check text-green-500 mr-2 mt-1"></i><strong>Flexible
								Scheduling:</strong> 24/7 protection available.</li>
					</ul>
				</div>
				<div class="hidden md:flex w-1/2 justify-center items-center">
					<i class="fas fa-shield-alt text-9xl text-dark-200"></i>
				</div>
			</div>

		</div>
	</section>
@endsection

@section('script')
	<script></script>
@endsection
