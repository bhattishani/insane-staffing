@extends('layouts.main')

@section('title', 'Insane Staffing - Next-Gen Talent Solutions for Canada | Premier Staffing Agency')

@section('meta')
	<meta
		content="Insane Staffing connects top Canadian companies with elite talent. Expert staffing solutions across tech, finance, healthcare & trades. 24/7 dedicated support. Find your next opportunity today!"
		name="description"
	>
	<meta
		content="staffing agency canada, recruitment agency, job search, hiring solutions, tech jobs canada, finance recruitment, healthcare staffing, skilled trades jobs"
		name="keywords"
	>
	<meta
		content="Insane Staffing"
		name="author"
	>
	<meta
		content="Insane Staffing - Next-Gen Talent Solutions for Canada"
		property="og:title"
	>
	<meta
		content="Premier staffing solutions connecting top Canadian companies with elite talent. Expert recruitment across tech, finance, healthcare & trades sectors."
		property="og:description"
	>
	<meta
		content="{{ asset('assets/images/resources/insane-staffing-logo-black-text.png') }}"
		property="og:image"
	>
	<meta
		content="{{ url('/') }}"
		property="og:url"
	>
	<meta
		content="summary_large_image"
		name="twitter:card"
	>
	<meta
		content="Insane Staffing - Next-Gen Talent Solutions"
		name="twitter:title"
	>
	<meta
		content="Elite staffing solutions for Canadian businesses. Find top talent or your next career opportunity with Insane Staffing."
		name="twitter:description"
	>
	<link
		href="https://insanestaffing.ca"
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
			background-color: #f8f9fa;
		}

		.hero-section {
			background-image: linear-gradient(rgba(17, 24, 39, 0.7), rgba(17, 24, 39, 0.7)), url('/assets/images/breadcrumb/breadcrumb-1.jpg');
			background-size: cover;
			background-position: center;
		}

		.glass-effect {
			background: rgba(255, 255, 255, 0.05);
			backdrop-filter: blur(10px);
			border: 1px solid rgba(255, 255, 255, 0.1);
		}

		nav.scrolled {
			background-color: rgba(255, 255, 255, 0.9);
			backdrop-filter: blur(10px);
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
		}

		.industry-card {
			background-size: cover;
			background-position: center;
			transition: transform 0.4s ease, box-shadow 0.4s ease;
		}

		.industry-card:hover {
			transform: scale(1.05);
			box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
		}

		.timeline-item::before {
			content: '';
			position: absolute;
			left: 19px;
			top: 0;
			bottom: 0;
			width: 2px;
			background: #e5e7eb;
		}

		.timeline-dot {
			position: absolute;
			left: 0;
			top: 0;
			transform: translateX(-50%);
			width: 24px;
			height: 24px;
		}

		/* Scroll Animation */
		.reveal {
			opacity: 0;
			transform: translateY(40px);
			transition: opacity 0.8s ease, transform 0.8s ease;
		}

		.reveal.active {
			opacity: 1;
			transform: translateY(0);
		}
	</style>
@endsection

@section('main')
	<!-- 1. Hero Section -->
	<section class="relative min-h-screen flex items-center">
		<!-- Background with overlay -->
		<div class="absolute inset-0 z-0">
			<div class="absolute inset-0 bg-gradient-to-r from-dark-700/90 to-dark-700/80"></div>
			<img
				alt="Hero Background"
				class="w-full h-full object-cover"
				src="{{ asset('assets/images/slides/slide-v1-3.jpg') }}"
			>
		</div>

		<!-- Content -->
		<div class="container mx-auto px-6 relative z-10 py-20">
			<div class="max-w-4xl mx-auto text-center">
				<h1 class="text-4xl md:text-6xl font-bold text-white leading-tight mb-6 reveal">
					Connecting Top Talent with Leading Companies
				</h1>
				<p
					class="text-lg md:text-xl text-gray-200 max-w-3xl mx-auto mb-12 reveal"
					style="transition-delay: 200ms;"
				>
					We leverage cutting-edge solutions to connect Canada's most innovative companies with elite,
					pre-vetted talent—24/7.
				</p>

				<!-- Enhanced CTA Section -->
				<div
					class="grid md:grid-cols-2 gap-6 max-w-2xl mx-auto reveal"
					style="transition-delay: 400ms;"
				>
					<!-- For Employers -->
					<div class="bg-white/10 backdrop-blur-md rounded-xl p-6 hover:bg-white/15 transition-all duration-300">
						<div class="text-white mb-4">
							<i class="fas fa-building text-3xl mb-2"></i>
							<h3 class="text-xl font-semibold">For Employers</h3>
							<p class="text-sm text-gray-300 mt-1">Looking to hire top talent?</p>
						</div>
						<a
							class="inline-block w-full bg-white text-dark-600 font-semibold py-3 px-6 rounded-lg hover:bg-gray-100 transition-colors"
							href="{{ route('contact') }}"
						>
							Post a Job
							<i class="fas fa-arrow-right ml-2"></i>
						</a>
					</div>

					<!-- For Job Seekers -->
					<div class="bg-white/10 backdrop-blur-md rounded-xl p-6 hover:bg-white/15 transition-all duration-300">
						<div class="text-white mb-4">
							<i class="fas fa-user-tie text-3xl mb-2"></i>
							<h3 class="text-xl font-semibold">For Job Seekers</h3>
							<p class="text-sm text-gray-300 mt-1">Ready for your next opportunity?</p>
						</div>
						<a
							class="inline-block w-full bg-white text-dark-600 font-semibold py-3 px-6 rounded-lg hover:bg-gray-100 transition-colors"
							href="{{ route('contact') }}"
						>
							Find Jobs
							<i class="fas fa-arrow-right ml-2"></i>
						</a>
					</div>
				</div>

				<!-- Additional Quick Links -->
				<div
					class="flex justify-center gap-8 mt-8 reveal"
					style="transition-delay: 600ms;"
				>
					<a
						class="text-white hover:text-gray-300 transition-colors"
						href="{{ route('about') }}"
					>
						<i class="fas fa-info-circle mr-2"></i>
						Learn More
					</a>
					<a
						class="text-white hover:text-gray-300 transition-colors"
						href="tel:+16472670072"
					>
						<i class="fas fa-phone mr-2"></i>
						Call Us
					</a>
				</div>
			</div>
		</div>

		<!-- Scroll Indicator -->
		<div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 text-white animate-bounce">
			<i class="fas fa-chevron-down"></i>
		</div>
	</section>

	<!-- 2. Market Impact Section -->
	<section class="py-16 bg-gray-100">
		<div class="container mx-auto px-6">
			<h3 class="text-center text-sm font-semibold text-gray-500 uppercase tracking-wider mb-12 reveal">Our
				Impact Across Canada</h3>
			<div class="grid md:grid-cols-4 gap-8">
				<div class="text-center reveal">
					<div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
						<i class="fas fa-map-marker-alt text-dark-600 text-3xl mb-4"></i>
						<h4 class="text-4xl font-bold text-dark-600 mb-2">7+</h4>
						<p class="text-gray-600">Provinces Served</p>
					</div>
				</div>
				<div
					class="text-center reveal"
					style="transition-delay: 200ms;"
				>
					<div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
						<i class="fas fa-industry text-dark-600 text-3xl mb-4"></i>
						<h4 class="text-4xl font-bold text-dark-600 mb-2">12+</h4>
						<p class="text-gray-600">Industries Supported</p>
					</div>
				</div>
				<div
					class="text-center reveal"
					style="transition-delay: 400ms;"
				>
					<div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
						<i class="fas fa-clock text-dark-600 text-3xl mb-4"></i>
						<h4 class="text-4xl font-bold text-dark-600 mb-2">24/7</h4>
						<p class="text-gray-600">Support Available</p>
					</div>
				</div>
				<div
					class="text-center reveal"
					style="transition-delay: 600ms;"
				>
					<div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
						<i class="fas fa-check-circle text-dark-600 text-3xl mb-4"></i>
						<h4 class="text-4xl font-bold text-dark-600 mb-2">98%</h4>
						<p class="text-gray-600">Success Rate</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- 3. Industries We Serve -->
	<section class="py-20">
		<div class="container mx-auto px-6">
			<div class="text-center mb-12">
				<h2 class="text-3xl md:text-4xl font-bold reveal">Specialized Talent for Every Sector</h2>
				<p
					class="text-gray-600 mt-2 max-w-2xl mx-auto reveal"
					style="transition-delay: 200ms;"
				>We provide
					expert staffing solutions across a wide range of high-demand industries.</p>
			</div>
			<div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
				<div
					class="industry-card rounded-xl overflow-hidden text-white relative h-80 reveal"
					style="background-image: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.8)), url('https://placehold.co/400x600/3b82f6/ffffff?text=Tech');"
				>
					<div class="absolute bottom-0 left-0 p-6">
						<i class="fas fa-laptop-code text-3xl mb-2"></i>
						<h3 class="text-2xl font-bold">Technology & Engineering</h3>
					</div>
				</div>
				<div
					class="industry-card rounded-xl overflow-hidden text-white relative h-80 reveal"
					style="transition-delay: 200ms; background-image: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.8)), url('https://placehold.co/400x600/10b981/ffffff?text=Finance');"
				>
					<div class="absolute bottom-0 left-0 p-6">
						<i class="fas fa-chart-pie text-3xl mb-2"></i>
						<h3 class="text-2xl font-bold">Business & Finance</h3>
					</div>
				</div>
				<div
					class="industry-card rounded-xl overflow-hidden text-white relative h-80 reveal"
					style="transition-delay: 400ms; background-image: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.8)), url('https://placehold.co/400x600/6366f1/ffffff?text=Healthcare');"
				>
					<div class="absolute bottom-0 left-0 p-6">
						<i class="fas fa-user-md text-3xl mb-2"></i>
						<h3 class="text-2xl font-bold">Healthcare</h3>
					</div>
				</div>
				<div
					class="industry-card rounded-xl overflow-hidden text-white relative h-80 reveal"
					style="transition-delay: 600ms; background-image: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.8)), url('https://placehold.co/400x600/8b5cf6/ffffff?text=Trades');"
				>
					<div class="absolute bottom-0 left-0 p-6">
						<i class="fas fa-hard-hat text-3xl mb-2"></i>
						<h3 class="text-2xl font-bold">Skilled Trades</h3>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- 4. How Our Process Works -->
	<section class="py-20 bg-white">
		<div class="container mx-auto px-6">
			<div class="text-center mb-16">
				<h2 class="text-3xl md:text-4xl font-bold reveal">Dedicated Pathways to Excellence</h2>
				<p
					class="text-gray-600 mt-2 max-w-2xl mx-auto reveal"
					style="transition-delay: 200ms;"
				>
					Two specialized service tracks, one commitment to excellence. Choose your path to success with
					our dedicated solutions.
				</p>
			</div>
			<div class="grid md:grid-cols-2 gap-16">
				<!-- For Businesses -->
				<div class="reveal bg-dark-700 rounded-2xl p-8 shadow-lg">
					<div class="mb-8">
						<div class="flex items-center mb-4 border-b border-gray-600 pb-4">
							<div class="bg-white/10 p-3 rounded-lg mr-4">
								<i class="fas fa-building text-3xl text-white"></i>
							</div>
							<div>
								<h3 class="text-2xl font-bold text-white">For Businesses</h3>
								<p class="text-gray-300 mt-1">Strategic Staffing Solutions</p>
							</div>
						</div>
						<p class="text-gray-300">Transform your workforce with our expert staffing solutions. We
							connect you with pre-vetted professionals who align with your company's vision and
							goals.</p>
					</div>
					<div class="relative pl-12 space-y-12 mb-8">
						<div class="timeline-item">
							<div
								class="timeline-dot bg-white text-dark-600 rounded-full flex items-center justify-center ring-4 ring-dark-600 shadow-md"
							>
								<i class="fas fa-search"></i>
							</div>
							<h4 class="font-bold text-xl text-white">1. Discovery & Strategy</h4>
							<p class="text-gray-300">In-depth consultation to understand your unique needs, culture,
								and growth objectives.</p>
						</div>
						<div class="timeline-item">
							<div
								class="timeline-dot bg-white text-dark-600 rounded-full flex items-center justify-center ring-4 ring-dark-600 shadow-md"
							>
								<i class="fas fa-users"></i>
							</div>
							<h4 class="font-bold text-xl text-white">2. Talent Sourcing</h4>
							<p class="text-gray-300">Strategic talent acquisition from our curated network of
								pre-vetted professionals.</p>
						</div>
						<div class="timeline-item">
							<div
								class="timeline-dot bg-white text-dark-600 rounded-full flex items-center justify-center ring-4 ring-dark-600 shadow-md"
							>
								<i class="fas fa-handshake"></i>
							</div>
							<h4 class="font-bold text-xl text-white">3. Integration & Support</h4>
							<p class="text-gray-300">Seamless onboarding process with ongoing dedicated support for
								lasting success.</p>
						</div>
					</div>
					<div class="text-center mt-8 pt-6 border-t border-gray-600">
						<p class="text-xl text-white mb-4">Are you a business owner looking for staffing solutions?
						</p>
						<a
							class="inline-block bg-white text-dark-600 font-semibold px-8 py-3 rounded-lg shadow-md hover:bg-gray-100 transition-colors"
							href="{{ route('services') }}"
						>
							Access Business Portal
							<i class="fas fa-arrow-right ml-2"></i>
						</a>
					</div>
				</div>
				<!-- For Job Seekers -->
				<div class="reveal bg-dark-600 rounded-2xl p-8 shadow-lg">
					<div class="mb-8">
						<div class="flex items-center mb-4 border-b border-gray-500 pb-4">
							<div class="bg-white/10 p-3 rounded-lg mr-4">
								<i class="fas fa-user-tie text-3xl text-white"></i>
							</div>
							<div>
								<h3 class="text-2xl font-bold text-white">For Job Seekers</h3>
								<p class="text-gray-300 mt-1">Career Growth & Opportunities</p>
							</div>
						</div>
						<p class="text-gray-300">Take the next step in your career journey. We provide personalized
							job matching and career guidance to help you find the perfect opportunity.</p>
					</div>
					<div class="relative pl-12 space-y-12 mb-8">
						<div class="timeline-item">
							<div
								class="timeline-dot bg-white text-dark-600 rounded-full flex items-center justify-center ring-4 ring-dark-600 shadow-md"
							>
								<i class="fas fa-file-signature"></i>
							</div>
							<h4 class="font-bold text-xl text-white">1. Career Consultation</h4>
							<p class="text-gray-300">Personalized assessment of your skills, experience, and career
								aspirations, goals, and opportunities.</p>
						</div>
						<div class="timeline-item">
							<div
								class="timeline-dot bg-white text-dark-600 rounded-full flex items-center justify-center ring-4 ring-dark-600 shadow-md"
							>
								<i class="fas fa-bullseye"></i>
							</div>
							<h4 class="font-bold text-xl text-white">2. Strategic Matching</h4>
							<p class="text-gray-300">Direct access to exclusive opportunities aligned with your
								career goals and aspirations for growth.</p>
						</div>
						<div class="timeline-item">
							<div
								class="timeline-dot bg-white text-dark-600 rounded-full flex items-center justify-center ring-4 ring-dark-600 shadow-md"
							>
								<i class="fas fa-rocket"></i>
							</div>
							<h4 class="font-bold text-xl text-white">3. Career Advancement</h4>
							<p class="text-gray-300">Complete support every step of the way — from interviews and
								negotiations to smooth, stress-free onboarding success.</p>
						</div>
					</div>
					<div class="text-center mt-8 pt-6 border-t border-gray-500">
						<p class="text-xl text-white mb-4">Looking for a job? Find a match for you here.</p>
						<a
							class="inline-block bg-white text-dark-600 font-semibold px-8 py-3 rounded-lg shadow-md hover:bg-gray-100 transition-colors"
							href="{{ route('services') }}"
						>
							Access Job Portal
							<i class="fas fa-arrow-right ml-2"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- 5. Why Partner With Us -->
	<section class="py-20">
		<div class="container mx-auto px-6">
			<div class="text-center mb-12">
				<h2 class="text-3xl md:text-4xl font-bold reveal">The Insane Staffing Advantage</h2>
			</div>
			<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
				<div class="bg-white p-8 rounded-xl shadow-md reveal hover:shadow-xl transition-shadow">
					<i class="fas fa-bolt text-3xl text-dark-500 mb-4"></i>
					<h3 class="font-bold text-xl mb-2">Unmatched Speed</h3>
					<p class="text-gray-600">Our agile process delivers qualified candidates faster than traditional
						agencies.</p>
				</div>
				<div
					class="bg-white p-8 rounded-xl shadow-md reveal hover:shadow-xl transition-shadow"
					style="transition-delay: 200ms;"
				>
					<i class="fas fa-user-check text-3xl text-dark-500 mb-4"></i>
					<h3 class="font-bold text-xl mb-2">Elite Vetting</h3>
					<p class="text-gray-600">We go beyond resumes, ensuring every candidate is a perfect technical
						and cultural fit.</p>
				</div>
				<div
					class="bg-white p-8 rounded-xl shadow-md reveal hover:shadow-xl transition-shadow"
					style="transition-delay: 400ms;"
				>
					<i class="fas fa-headset text-3xl text-dark-500 mb-4"></i>
					<h3 class="font-bold text-xl mb-2">24/7 Dedicated Support</h3>
					<p class="text-gray-600">Your success is our priority. We're always available to support your
						needs.</p>
				</div>
			</div>
		</div>
	</section>

	<!-- NEW ZEBRA SECTIONS START -->
	<section class="py-20 bg-white overflow-hidden">
		<div class="container mx-auto px-6">
			<!-- Section 1: Image Left -->
			<div class="grid md:grid-cols-2 gap-12 items-center mb-20">
				<div class="reveal">
					<img
						alt="Data Analytics"
						class="rounded-xl shadow-2xl"
						src="{{ asset('assets/images/about/data-analytics.jpg') }}"
					>
				</div>
				<div class="reveal">
					<h3 class="text-3xl font-bold mb-4">Precision Matching Through Data-Driven Insights</h3>

					<p class="text-gray-600 mb-4">
						We move beyond simple keyword matching. At <strong>Insane Staffing</strong>, our
						proprietary platform
						leverages advanced analytics, market intelligence, and performance benchmarking to evaluate
						each candidate
						on a deeper level. This ensures that we don’t just match resumes to job descriptions, but
						people to
						environments where they can thrive.
					</p>

					<p class="text-gray-600 mb-4">
						By analyzing real-time market data, skill trends, and industry benchmarks, we create a
						complete picture of
						candidate potential. This data-driven approach helps us anticipate future needs, identify
						transferable
						skills, and highlight professionals who are best positioned for long-term success within
						your organization.
					</p>

					<p class="text-gray-600 mb-4">
						The result is a smarter hiring process that minimizes guesswork, reduces turnover, and
						accelerates team
						performance. With precision matching, you gain access to talent that not only fits your
						current requirements
						but also adapts as your business evolves.
					</p>

					<a
						class="text-dark-600 font-semibold hover:underline"
						href="{{ route('about') }}"
					>
						Learn More About Our Tech <i class="fas fa-arrow-right ml-1"></i>
					</a>
				</div>

			</div>

			<!-- Section 2: Image Right -->
			<div class="grid md:grid-cols-2 gap-12 items-center mb-20">
				<div class="reveal md:order-2">
					<img
						alt="Team Collaboration"
						class="rounded-xl shadow-2xl"
						src="{{ asset('assets/images/about/team-work.jpg') }}"
					>
				</div>
				<div class="reveal md:order-1">
					<h3 class="text-3xl font-bold mb-4">Vetting for Culture, Not Just Credentials</h3>

					<p class="text-gray-600 mb-4">
						A great resume is only the beginning. At <strong>Insane Staffing</strong>, we
						understand that true success
						comes from finding individuals who not only meet the technical requirements of the job but
						also fit seamlessly
						into the DNA of your organization. That’s why our comprehensive vetting process goes far
						beyond skills on paper.
					</p>

					<p class="text-gray-600 mb-4">
						Every candidate undergoes behavioral interviews, soft-skill assessments, and scenario-based
						evaluations to
						ensure
						alignment with your company’s values, work environment, and long-term vision. This cultural
						alignment leads to
						stronger collaboration, higher retention rates, and teams that operate with greater trust
						and cohesion.
					</p>

					<p class="text-gray-600 mb-4">
						By prioritizing culture as much as credentials, we reduce hiring risks and build teams that
						thrive together.
						The result is a workforce that doesn’t just work for you but grows with you — driving
						sustainable performance
						and long-term organizational success.
					</p>

					<a
						class="text-dark-600 font-semibold hover:underline"
						href="{{ route('about') }}"
					>
						Our Vetting Process <i class="fas fa-arrow-right ml-1"></i>
					</a>
				</div>

			</div>

			<!-- Section 3: Image Left -->
			<div class="grid md:grid-cols-2 gap-12 items-center">
				<div class="reveal">
					<img
						alt="Business Growth"
						class="rounded-xl shadow-2xl"
						src="{{ asset('assets/images/about/business-growth.jpg') }}"
					>
				</div>
				<div class="reveal">
					<h3 class="text-3xl font-bold mb-4">
						More Than a Recruiter, We're Your Growth Partner
					</h3>

					<p class="text-gray-600 mb-4">
						At <strong>Insane Staffing</strong>, we believe recruitment is more than just filling
						open positions —
						it’s about shaping the future of your business. We don’t stop at simply connecting you with
						candidates;
						we go beyond the transactional approach to create meaningful partnerships built on trust,
						alignment,
						and long-term value.
					</p>

					<p class="text-gray-600 mb-4">
						We invest deeply in your success. That means taking the time to understand your company’s
						culture,
						growth trajectory, and the challenges unique to your industry. From providing market
						insights to helping
						you forecast workforce trends, we act as a strategic extension of your team. Whether you’re
						scaling
						a fast-growing startup or stabilizing a well-established enterprise, our goal is to ensure
						you always
						have the right people at the right time.
					</p>

					<p class="text-gray-600 mb-4">
						Our commitment doesn’t end with a hire. We stand beside you throughout the entire journey —
						from onboarding
						and training support to performance tracking and retention strategies. By offering
						comprehensive, 24/7
						staffing solutions, we help reduce hiring risks while enabling scalability and innovation at
						speed.
					</p>

					<p class="text-gray-600 mb-4">
						At the heart of everything we do is partnership. We aim to fuel sustainable growth by
						aligning talent with
						opportunity, ensuring that every placement drives measurable business impact. With
						<strong>Insane Staffing</strong>, you’re not just hiring a recruiter — you’re gaining a
						trusted growth
						partner dedicated to your long-term success.
					</p>

					<a
						class="text-dark-600 font-semibold hover:underline"
						href="{{ route('about') }}"
					>
						Partner With Us <i class="fas fa-arrow-right ml-1"></i>
					</a>
				</div>

			</div>
		</div>
	</section>
	<!-- NEW ZEBRA SECTIONS END -->

	<!-- 6. Testimonials -->
	<section class="py-20 bg-gray-800 text-white">
		<div class="container mx-auto px-6">
			<div class="text-center mb-12">
				<h2 class="text-3xl md:text-4xl font-bold reveal">What Our Partners Say</h2>
			</div>
			<div class="grid md:grid-cols-2 gap-8">
				<div class="glass-effect p-8 rounded-xl reveal">
					<p class="text-gray-300 italic mb-6">"Insane Staffing revolutionized our hiring process. They
						delivered top-tier sales talent in record time, directly impacting our bottom line. They are
						truly a strategic partner."</p>
					<div class="flex items-center">
						<img
							alt="John Smith"
							class="rounded-full mr-4"
							src="https://placehold.co/50x50/e2e8f0/334155?text=JS"
						>
						<div>
							<p class="font-bold">John Smith</p>
							<p class="text-sm text-gray-400">Director of Sales, InnovateCorp</p>
						</div>
					</div>
				</div>
				<div
					class="glass-effect p-8 rounded-xl reveal"
					style="transition-delay: 200ms;"
				>
					<p class="text-gray-300 italic mb-6">"As a job seeker, the experience was phenomenal. They found
						me an opportunity that perfectly matched my skills and career goals. I couldn't be happier
						in my new role."</p>
					<div class="flex items-center">
						<img
							alt="Alice Dubois"
							class="rounded-full mr-4"
							src="https://placehold.co/50x50/e2e8f0/334155?text=AD"
						>
						<div>
							<p class="font-bold">Alice Dubois</p>
							<p class="text-sm text-gray-400">Senior Software Engineer</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- 7. Get Started Today CTA -->
	<section class="py-20">
		<div class="container mx-auto px-6 text-center">
			<h2 class="text-3xl md:text-4xl font-bold reveal">Ready to Elevate Your Team or Career?</h2>
			<p
				class="text-gray-600 mt-2 mb-8 max-w-2xl mx-auto reveal"
				style="transition-delay: 200ms;"
			>Connect
				with us today and discover the future of staffing. Our experts are available 24/7 to help you
				achieve your goals.</p>
			<div
				class="reveal"
				style="transition-delay: 400ms;"
			>
				<a
					class="bg-dark-600 text-white font-semibold py-4 px-10 rounded-lg hover:bg-dark-700 transition-all duration-300 transform hover:scale-105 shadow-xl text-lg"
					href="{{ route('contact') }}"
				>Get
					Started Now</a>
			</div>
		</div>
	</section>
@endsection

@section('script')

@endsection
