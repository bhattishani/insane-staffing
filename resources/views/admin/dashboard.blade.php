@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="space-y-6">
        <!-- Period Filter -->
        <div class="bg-white rounded-lg shadow-md p-4">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <h2 class="text-xl font-bold text-gray-900">Analytics Dashboard</h2>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.dashboard', ['period' => 'today']) }}" 
                       class="px-3 py-2 text-sm rounded-md {{ $period === 'today' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Today
                    </a>
                    <a href="{{ route('admin.dashboard', ['period' => 'week']) }}" 
                       class="px-3 py-2 text-sm rounded-md {{ $period === 'week' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        This Week
                    </a>
                    <a href="{{ route('admin.dashboard', ['period' => 'biweekly']) }}" 
                       class="px-3 py-2 text-sm rounded-md {{ $period === 'biweekly' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        2 Weeks
                    </a>
                    <a href="{{ route('admin.dashboard', ['period' => 'month']) }}" 
                       class="px-3 py-2 text-sm rounded-md {{ $period === 'month' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        This Month
                    </a>
                    <a href="{{ route('admin.dashboard', ['period' => 'last_month']) }}" 
                       class="px-3 py-2 text-sm rounded-md {{ $period === 'last_month' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Last Month
                    </a>
                    <a href="{{ route('admin.dashboard', ['period' => 'year']) }}" 
                       class="px-3 py-2 text-sm rounded-md {{ $period === 'year' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        This Year
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Total Requests</p>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $stats['total_requests'] }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-inbox text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Genuine Requests</p>
                        <h3 class="text-2xl font-bold text-green-600">{{ $stats['genuine_requests'] }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Business Inquiries</p>
                        <h3 class="text-2xl font-bold text-purple-600">{{ $stats['business_inquiries'] }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-building text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Job Seekers</p>
                        <h3 class="text-2xl font-bold text-indigo-600">{{ $stats['job_seekers'] }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user-tie text-indigo-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Secondary Statistics -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">CVs Uploaded</p>
                        <h3 class="text-2xl font-bold text-cyan-600">{{ $stats['with_cv'] }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-cyan-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-file-pdf text-cyan-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Open Requests</p>
                        <h3 class="text-2xl font-bold text-yellow-600">{{ $stats['open_requests'] }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-clock text-yellow-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Processing</p>
                        <h3 class="text-2xl font-bold text-blue-600">{{ $stats['processing_requests'] }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-cog text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Closed</p>
                        <h3 class="text-2xl font-bold text-green-600">{{ $stats['closed_requests'] }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-check text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Time Trends Chart -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4">Contact Trends</h3>
                <div class="h-80">
                    <canvas id="trendsChart"></canvas>
                </div>
            </div>
            
            <!-- Spam Distribution Chart -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4">Request Quality Distribution</h3>
                <div class="h-80">
                    <canvas id="spamChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Follow-up Analytics -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Follow-up Status Chart -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4">Follow-up Status</h3>
                <div class="h-80">
                    <canvas id="followUpStatusChart"></canvas>
                </div>
            </div>
            
            <!-- Follow-up Type Chart -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold mb-4">Follow-up Types</h3>
                <div class="h-80">
                    <canvas id="followUpTypeChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Conversion Funnel -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold mb-4">Conversion Funnel</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="text-center">
                    <div class="w-full bg-blue-600 text-white py-4 rounded-lg mb-2">
                        <div class="text-2xl font-bold">{{ $conversionStats['total'] }}</div>
                        <div class="text-sm">Total Contacts</div>
                    </div>
                    <div class="text-sm text-gray-600">100%</div>
                </div>
                <div class="text-center">
                    <div class="w-full bg-green-600 text-white py-4 rounded-lg mb-2">
                        <div class="text-2xl font-bold">{{ $conversionStats['contacted'] }}</div>
                        <div class="text-sm">Contacted</div>
                    </div>
                    <div class="text-sm text-gray-600">{{ $conversionStats['contact_rate'] }}%</div>
                </div>
                <div class="text-center">
                    <div class="w-full bg-yellow-600 text-white py-4 rounded-lg mb-2">
                        <div class="text-2xl font-bold">{{ $conversionStats['processing'] }}</div>
                        <div class="text-sm">Processing</div>
                    </div>
                    <div class="text-sm text-gray-600">{{ $conversionStats['processing_rate'] }}%</div>
                </div>
                <div class="text-center">
                    <div class="w-full bg-purple-600 text-white py-4 rounded-lg mb-2">
                        <div class="text-2xl font-bold">{{ $conversionStats['closed'] }}</div>
                        <div class="text-sm">Closed</div>
                    </div>
                    <div class="text-sm text-gray-600">{{ $conversionStats['closure_rate'] }}%</div>
                </div>
            </div>
        </div>

        <!-- Admin Login Logs -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Recent Admin Logins</h3>
                <span class="text-sm text-gray-500">Last 10 logins</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Admin</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">IP Address</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Location</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Device</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Time</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($adminLogs as $log)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">
                                    <div class="font-medium">{{ $log->user->name ?? 'Unknown' }}</div>
                                    <div class="text-sm text-gray-500">{{ $log->email }}</div>
                                </td>
                                <td class="px-4 py-3 text-sm">{{ $log->ip_address }}</td>
                                <td class="px-4 py-3 text-sm">
                                    @if($log->city && $log->country)
                                        {{ $log->city }}, {{ $log->country }}
                                    @else
                                        <span class="text-gray-400">Unknown</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if($log->device_type)
                                        {{ $log->device_type }}
                                        @if($log->browser)
                                            <br><span class="text-gray-500">{{ $log->browser }}</span>
                                        @endif
                                    @else
                                        <span class="text-gray-400">Unknown</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">{{ $log->created_at->format('M d, Y h:i A') }}</td>
                                <td class="px-4 py-3">
                                    @if($log->is_successful)
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Success</span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Failed</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-4 py-3 text-center text-gray-500" colspan="6">
                                    No login logs found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Upcoming Follow-ups -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Upcoming Follow-ups</h3>
                <a href="{{ route('admin.contacts.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                    View All
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Contact</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Type</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Date</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Status</th>
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($upcomingFollowUps as $followUp)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">
                                    <div class="font-medium">{{ $followUp->contact->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $followUp->contact->email }}</div>
                                </td>
                                <td class="px-4 py-3 text-sm">{{ ucfirst($followUp->follow_up_type) }}</td>
                                <td class="px-4 py-3 text-sm">{{ $followUp->follow_up_date->format('M d, Y h:i A') }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 text-xs rounded-full
                                        @if ($followUp->status === 'scheduled') bg-blue-100 text-blue-800
                                        @elseif($followUp->status === 'completed') bg-green-100 text-green-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($followUp->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('admin.contacts.show', $followUp->contact) }}" 
                                       class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-4 py-3 text-center text-gray-500" colspan="5">
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
        // Time Trends Chart
        new Chart(document.getElementById('trendsChart'), {
            type: 'line',
            data: {
                labels: {!! json_encode($timeStats['labels']) !!},
                datasets: [
                    {
                        label: 'Contacts',
                        data: {!! json_encode($timeStats['contacts']) !!},
                        borderColor: '#3B82F6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Follow-ups',
                        data: {!! json_encode($timeStats['followUps']) !!},
                        borderColor: '#10B981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        tension: 0.4,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });

        // Spam Distribution Chart
        new Chart(document.getElementById('spamChart'), {
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
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Follow-up Status Chart
        new Chart(document.getElementById('followUpStatusChart'), {
            type: 'bar',
            data: {
                labels: ['Scheduled', 'Completed', 'No Response', 'Cancelled'],
                datasets: [{
                    label: 'Follow-ups',
                    data: [
                        {{ $followUpStats['scheduled'] }},
                        {{ $followUpStats['completed'] }},
                        {{ $followUpStats['no_response'] }},
                        {{ $followUpStats['cancelled'] }}
                    ],
                    backgroundColor: ['#3B82F6', '#10B981', '#F59E0B', '#EF4444']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Follow-up Type Chart
        new Chart(document.getElementById('followUpTypeChart'), {
            type: 'pie',
            data: {
                labels: ['Phone Call', 'Email', 'Meeting'],
                datasets: [{
                    data: [
                        {{ $followUpStats['by_type']['call'] }},
                        {{ $followUpStats['by_type']['email'] }},
                        {{ $followUpStats['by_type']['meeting'] }}
                    ],
                    backgroundColor: ['#8B5CF6', '#06B6D4', '#84CC16']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
@endsection