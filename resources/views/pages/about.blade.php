@extends('layouts.main')

@section('title', 'About Insane Staffing | Leading Canadian Staffing Agency | Our Story')

@section('meta')
	<meta
		content="Learn about Insane Staffing, Canada's premier staffing agency. Meet our founder Harmanjot Singh and discover how we're revolutionizing recruitment across multiple industries."
		name="description"
	>
	<meta
		content="Insane Staffing about us, Canadian recruitment agency, Harmanjot Singh, staffing company Canada, employment agency Toronto, job recruitment agency"
		name="keywords"
	>
	<meta
		content="Insane Staffing"
		name="author"
	>
	<meta
		content="About Insane Staffing | Leading Canadian Staffing Agency"
		property="og:title"
	>
	<meta
		content="Discover how Insane Staffing is revolutionizing recruitment in Canada. Learn about our mission, vision, and commitment to connecting top talent with leading companies."
		property="og:description"
	>
	<meta
		content="{{ asset('assets/images/team/founder.jpg') }}"
		property="og:image"
	>
	<meta
		content="https://insanestaffing.ca/about"
		property="og:url"
	>
	<meta
		content="summary_large_image"
		name="twitter:card"
	>
	<meta
		content="About Insane Staffing | Our Story"
		name="twitter:title"
	>
	<meta
		content="Meet the team behind Canada's innovative staffing solutions. Learn about our mission and how we're transforming recruitment."
		name="twitter:description"
	>
	<link
		href="https://insanestaffing.ca/about"
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
	</style>
@endsection

@section('main')

	<main>
		<!-- Page Header -->
		<section class="bg-dark-700 text-white text-center py-16">
			<div class="container mx-auto px-6">
				<h1 class="text-4xl font-bold">About Insane Staffing</h1>
				<p class="mt-2 text-lg text-dark-200">Your Partner in Talent and Opportunity</p>
			</div>
		</section>

		<!-- Who We Are -->
		<section class="py-20">
			<div class="container mx-auto px-6">
				<div class="grid md:grid-cols-2 gap-12 items-center">
					<div>
						<h2 class="text-3xl font-bold mb-4">Who We Are</h2>
						<p class="text-lg mb-6">At Insane Staffing, we connect businesses with top-tier, pre-vetted
							talent. Our mission is to bridge the gap between skilled professionals and the companies
							that need them, creating powerful synergies that drive growth and success across Canada.</p>
						<p class="text-lg">We specialize in a wide range of industries, ensuring we can meet the diverse
							needs of our clients.</p>
					</div>
					<div>
						<h3 class="text-2xl font-bold mb-4">Industries We Serve:</h3>
						<ul class="space-y-3">
							<li class="flex items-center text-lg"><i class="fas fa-check-circle text-green-500 mr-3"></i>Skilled Trades</li>
							<li class="flex items-center text-lg"><i class="fas fa-check-circle text-green-500 mr-3"></i>Business & Finance
							</li>
							<li class="flex items-center text-lg"><i class="fas fa-check-circle text-green-500 mr-3"></i>Transportation</li>
							<li class="flex items-center text-lg"><i class="fas fa-check-circle text-green-500 mr-3"></i>Technology &
								Engineering</li>
							<li class="flex items-center text-lg"><i class="fas fa-check-circle text-green-500 mr-3"></i>Healthcare</li>
							<li class="flex items-center text-lg"><i class="fas fa-check-circle text-green-500 mr-3"></i>Customer Service &
								Sales</li>
						</ul>
					</div>
				</div>
			</div>
		</section>

		<!-- Why Choose Us Grid -->
		<section class="bg-white py-20">
			<div class="container mx-auto px-6 text-center">
				<h2 class="text-3xl font-bold mb-12">Why Choose Us?</h2>
				<div class="grid md:grid-cols-3 gap-8">
					<div class="p-6 border rounded-lg shadow-sm">
						<i class="fas fa-headset text-4xl text-dark-600 mb-4"></i>
						<h3 class="text-xl font-bold">24/7 Availability</h3>
						<p>We're always on, because business never stops.</p>
					</div>
					<div class="p-6 border rounded-lg shadow-sm">
						<i class="fas fa-cogs text-4xl text-dark-600 mb-4"></i>
						<h3 class="text-xl font-bold">Industry-Specific Talent</h3>
						<p>Experts who understand your unique field.</p>
					</div>
					<div class="p-6 border rounded-lg shadow-sm">
						<i class="fas fa-rocket text-4xl text-dark-600 mb-4"></i>
						<h3 class="text-xl font-bold">Speed & Scalability</h3>
						<p>Hire fast and scale your team effortlessly.</p>
					</div>
					<div class="p-6 border rounded-lg shadow-sm">
						<i class="fas fa-user-check text-4xl text-dark-600 mb-4"></i>
						<h3 class="text-xl font-bold">Pre-Screened & Reliable</h3>
						<p>Quality candidates you can trust from day one.</p>
					</div>
					<div class="p-6 border rounded-lg shadow-sm">
						<i class="fas fa-globe-americas text-4xl text-dark-600 mb-4"></i>
						<h3 class="text-xl font-bold">Nationwide Reach</h3>
						<p>Connecting talent and companies across Canada.</p>
					</div>
					<div class="p-6 border rounded-lg shadow-sm">
						<i class="fas fa-handshake text-4xl text-dark-600 mb-4"></i>
						<h3 class="text-xl font-bold">Dedicated Support</h3>
						<p>A partnership approach to your success.</p>
					</div>
				</div>
			</div>
		</section>

		<!-- Vision & Mission -->
		<section class="py-20">
			<div class="container mx-auto px-6 grid md:grid-cols-2 gap-12">
				<div class="bg-dark-700 p-8 rounded-lg text-white">
					<h3 class="text-2xl font-bold mb-4">Our Vision</h3>
					<p class="text-lg opacity-90">To be the go-to staffing partner known for speed, trust, and unmatched
						talent,
						empowering businesses and professionals to achieve their full potential.</p>
				</div>
				<div class="bg-dark-600 p-8 rounded-lg text-white">
					<h3 class="text-2xl font-bold mb-4">Our Mission</h3>
					<p class="text-lg opacity-90">To deliver fast, reliable, and industry-specific staffing solutions
						that help our
						clients thrive and our candidates build rewarding careers.</p>
				</div>
			</div>
		</section>

		<!-- Founder's Message -->
		<section class="bg-white py-20">
			<div class="container mx-auto px-6">
				<div class="flex flex-col md:flex-row items-center gap-12">
					<div class="md:w-1/3 text-center">
						<div class="rounded-lg overflow-hidden">
							<img
								alt="Founder Harmanjot Singh"
								class="mx-auto w-64 h-64 object-cover shadow-lg rounded-lg hover:scale-105 transition-transform duration-300"
								src="{{ asset('assets/images/team/founder.jpg') }}"
							>
						</div>
						<h3 class="text-2xl font-bold mt-4">Harmanjot Singh</h3>
						<p class="text-gray-600">Founder & CEO</p>
					</div>
					<div class="md:w-2/3">
						<h2 class="text-3xl font-bold mb-4">A Message from Our Founder</h2>
						<p class="text-lg italic text-gray-700">"I started <strong>Insane Staffing</strong> with a
							simple goal: to
							make the hiring process better for everyone. Having seen the challenges from both sides—as a
							job seeker and as a hiring manager—I knew there had to be a more efficient, reliable, and
							human-centric way to connect great people with great companies. We built this agency on the
							principles of speed, integrity, and a deep understanding of the Canadian job market. Our
							commitment is to you, our partners in success."</p>
					</div>
				</div>
			</div>
		</section>
	</main>

@endsection

@section('script')
	<script></script>
@endsection
