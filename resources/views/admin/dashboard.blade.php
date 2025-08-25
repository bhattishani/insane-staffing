@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
	<div class="space-y-4 sm:space-y-6">
		<!-- Statistics Cards -->
		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
			<div class="bg-white rounded-lg shadow-md p-4 sm:p-6">
				<div class="flex items-center justify-between">
					<div>
						<p class="text-gray-500 text-sm">Total Requests</p>
						<h3 class="text-xl sm:text-2xl font-bold">{{ $stats['total_requests'] }}</h3>
					</div>
					<div class="text-blue-500">
						<i class="fas fa-inbox text-xl sm:text-2xl"></i>
					</div>
				</div>
			</div>
			<div class="bg-white rounded-lg shadow-md p-6">
				<div class="flex items-center justify-between">
					<div>
						<p class="text-gray-500 text-sm">Genuine Requests</p>
						<h3 class="text-2xl font-bold text-green-600">{{ $stats['genuine_requests'] }}</h3>
					</div>
					<div class="text-green-500">
						<i class="fas fa-check-circle text-2xl"></i>
					</div>
				</div>
			</div>
			<div class="bg-white rounded-lg shadow-md p-6">
				<div class="flex items-center justify-between">
					<div>
						<p class="text-gray-500 text-sm">Potential Spam</p>
						<h3 class="text-2xl font-bold text-orange-600">{{ $stats['potential_spam'] }}</h3>
					</div>
					<div class="text-orange-500">
						<i class="fas fa-exclamation-circle text-2xl"></i>
					</div>
				</div>
			</div>
			<div class="bg-white rounded-lg shadow-md p-6">
				<div class="flex items-center justify-between">
					<div>
						<p class="text-gray-500 text-sm">Confirmed Spam</p>
						<h3 class="text-2xl font-bold text-red-600">{{ $stats['confirmed_spam'] }}</h3>
					</div>
					<div class="text-red-500">
						<i class="fas fa-ban text-2xl"></i>
					</div>
				</div>
			</div>
		</div>

		<!-- Charts Row -->
		<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
			<div class="bg-white rounded-lg shadow-md p-4 sm:p-6">
				<h3 class="text-base sm:text-lg font-semibold mb-4">Contact Requests Distribution</h3>
				<div class="relative aspect-w-16 aspect-h-9">
					<canvas id="requestsChart"></canvas>
				</div>
			</div>
			<div class="bg-white rounded-lg shadow-md p-4 sm:p-6">
				<h3 class="text-base sm:text-lg font-semibold mb-4">Weekly Trends</h3>
				<div class="relative aspect-w-16 aspect-h-9">
					<canvas id="trendsChart"></canvas>
				</div>
			</div>
		</div>

		<!-- Upcoming Follow-ups -->
		<div class="bg-white rounded-lg shadow-md p-4 sm:p-6">
			<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-2 sm:gap-0">
				<h3 class="text-base sm:text-lg font-semibold">Upcoming Follow-ups</h3>
				<a
					class="text-blue-600 hover:text-blue-800 text-sm whitespace-nowrap"
					href="{{ route('admin.contacts.index') }}"
				>View All</a>
			</div>
			<div class="overflow-x-auto">
				<table class="w-full">
					<thead>
						<tr class="bg-gray-50">
							<th class="px-4 py-3 text-left text-sm">Contact</th>
							<th class="px-4 py-3 text-left text-sm">Type</th>
							<th class="px-4 py-3 text-left text-sm">Date</th>
							<th class="px-4 py-3 text-left text-sm">Status</th>
							<th class="px-4 py-3 text-left text-sm">Actions</th>
						</tr>
					</thead>
					<tbody class="divide-y">
						@forelse ($upcomingFollowUps as $followUp)
							<tr class="hover:bg-gray-50">
								<td class="px-4 py-3">
									<div>
										<div class="font-medium">{{ $followUp->contact->name }}</div>
										<div class="text-sm text-gray-500">{{ $followUp->contact->email }}</div>
									</div>
								</td>
								<td class="px-4 py-3">{{ ucfirst($followUp->follow_up_type) }}</td>
								<td class="px-4 py-3">{{ $followUp->follow_up_date->format('M d, Y H:i') }}</td>
								<td class="px-4 py-3">
									<span
										class="px-2 py-1 text-sm rounded-full
                                    @if ($followUp->status === 'scheduled') bg-blue-100 text-blue-800
                                    @elseif($followUp->status === 'completed') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800 @endif"
									>
										{{ ucfirst($followUp->status) }}
									</span>
								</td>
								<td class="px-4 py-3">
									<a
										class="text-blue-600 hover:text-blue-800"
										href="{{ route('admin.contacts.show', $followUp->contact) }}"
									>
										<i class="fas fa-eye"></i>
									</a>
								</td>
							</tr>
						@empty
							<tr>
								<td
									class="px-4 py-3 text-center text-gray-500"
									colspan="5"
								>
									No upcoming follow-ups
								</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script>
		// Contact Requests Distribution Chart
		new Chart(document.getElementById('requestsChart'), {
			type: 'doughnut',
			data: {
				labels: ['Genuine', 'Potential Spam', 'Confirmed Spam'],
				datasets: [{
					data: [
						{{ $stats['genuine_requests'] }},
						{{ $stats['potential_spam'] }},
						{{ $stats['confirmed_spam'] }}
					],
					backgroundColor: ['#10B981', '#F59E0B', '#EF4444']
				}]
			},
			options: {
				responsive: true,
				plugins: {
					legend: {
						position: 'bottom'
					}
				}
			}
		});

		// Weekly Trends Chart
		new Chart(document.getElementById('trendsChart'), {
			type: 'line',
			data: {
				labels: {!! json_encode($weeklyStats['labels']) !!},
				datasets: [{
					label: 'Total Requests',
					data: {!! json_encode($weeklyStats['total']) !!},
					borderColor: '#3B82F6',
					tension: 0.1
				}]
			},
			options: {
				responsive: true,
				scales: {
					y: {
						beginAtZero: true
					}
				}
			}
		});
	</script>
@endsection
