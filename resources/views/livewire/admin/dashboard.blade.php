<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('layout.admin')] class extends Component {
    public $stats;
    public $recentActivity;
    public $contentStats;

    public function mount()
    {
        // In a real implementation, these would come from the database
        $this->stats = [
            'projects' => 24,
            'services' => 8,
            'blog_posts' => 15,
            'team_members' => 12,
            'active_listings' => 6,
        ];

        $this->recentActivity = [
            [
                'type' => 'Project',
                'title' => 'Modern Office Complex',
                'action' => 'updated',
                'author' => 'John Doe',
                'timestamp' => '2 hours ago',
            ],
            [
                'type' => 'Blog Post',
                'title' => 'Sustainable Construction Practices',
                'action' => 'published',
                'author' => 'Jane Smith',
                'timestamp' => '3 hours ago',
            ],
            [
                'type' => 'Service',
                'title' => 'Commercial Construction',
                'action' => 'created',
                'author' => 'Mike Johnson',
                'timestamp' => '5 hours ago',
            ],
            [
                'type' => 'Team Member',
                'title' => 'Sarah Wilson',
                'action' => 'added',
                'author' => 'Admin',
                'timestamp' => '1 day ago',
            ],
            [
                'type' => 'Job Listing',
                'title' => 'Senior Project Manager',
                'action' => 'published',
                'author' => 'HR Team',
                'timestamp' => '1 day ago',
            ],
        ];

        $this->contentStats = [
            'projects' => ['published' => 18, 'draft' => 6],
            'services' => ['published' => 6, 'draft' => 2],
            'blog_posts' => ['published' => 12, 'draft' => 3],
            'job_listings' => ['published' => 4, 'draft' => 2],
        ];
    }
}; ?>

<div class="space-y-6">
    <!-- Welcome Section -->
    <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
        <h2 class="text-2xl font-semibold text-gray-800">Welcome to AKStruct CMS</h2>
        <p class="mt-2 text-gray-600">Here's what's happening with your website today.</p>
    </div>

    <!-- Overview Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
        <!-- Total Projects -->
        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Projects</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ $stats['projects'] }}</h3>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Services -->
        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Services</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ $stats['services'] }}</h3>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Blog Posts -->
        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Blog Posts</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ $stats['blog_posts'] }}</h3>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Team Members -->
        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Team Members</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ $stats['team_members'] }}</h3>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Active Listings -->
        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Active Listings</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ $stats['active_listings'] }}</h3>
                </div>
                <div class="bg-red-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Stats and Recent Activity Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Quick Stats -->
        <div class="lg:col-span-1 bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Content Status</h3>
                <div class="space-y-4">
                    @foreach ($contentStats as $type => $stats)
                        <div>
                            <div class="flex justify-between text-sm text-gray-600 mb-1">
                                <span class="capitalize">{{ str_replace('_', ' ', $type) }}</span>
                                <span>{{ $stats['published'] + $stats['draft'] }} total</span>
                            </div>
                            <div class="h-2 bg-gray-200 rounded-full">
                                @php
                                    $publishedWidth =
                                        ($stats['published'] / ($stats['published'] + $stats['draft'])) * 100;
                                @endphp
                                <div class="h-2 bg-green-500 rounded-full" style="width: {{ $publishedWidth }}%"></div>
                            </div>
                            <div class="flex justify-between text-xs text-gray-500 mt-1">
                                <span>{{ $stats['published'] }} published</span>
                                <span>{{ $stats['draft'] }} draft</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Activity</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">Type</th>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">Title</th>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">Action</th>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">Author</th>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentActivity as $activity)
                                <tr class="border-b border-gray-100">
                                    <td class="py-3 px-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @switch($activity['type'])
                                            @case('Project')
                                                bg-blue-100 text-blue-800
                                                @break
                                            @case('Blog Post')
                                                bg-purple-100 text-purple-800
                                                @break
                                            @case('Service')
                                                bg-green-100 text-green-800
                                                @break
                                            @case('Team Member')
                                                bg-yellow-100 text-yellow-800
                                                @break
                                            @default
                                                bg-gray-100 text-gray-800
                                        @endswitch
                                    ">
                                            {{ $activity['type'] }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-sm text-gray-800">{{ $activity['title'] }}</td>
                                    <td class="py-3 px-4 text-sm text-gray-600">{{ $activity['action'] }}</td>
                                    <td class="py-3 px-4 text-sm text-gray-600">{{ $activity['author'] }}</td>
                                    <td class="py-3 px-4 text-sm text-gray-500">{{ $activity['timestamp'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
