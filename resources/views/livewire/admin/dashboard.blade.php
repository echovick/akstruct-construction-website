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
            'total_projects' => 24,
            'published_projects' => 18,
            'draft_projects' => 6,
            'total_categories' => 5,
        ];

        $this->recentActivity = [
            [
                'type' => 'Project',
                'title' => 'Modern Office Complex',
                'action' => 'updated',
                'author' => 'Admin',
                'timestamp' => '2 hours ago',
            ],
            [
                'type' => 'Project',
                'title' => 'Residential Building Phase 2',
                'action' => 'published',
                'author' => 'Admin',
                'timestamp' => '3 hours ago',
            ],
            [
                'type' => 'Project',
                'title' => 'Commercial Plaza Development',
                'action' => 'created',
                'author' => 'Admin',
                'timestamp' => '5 hours ago',
            ],
            [
                'type' => 'Category',
                'title' => 'Residential',
                'action' => 'updated',
                'author' => 'Admin',
                'timestamp' => '1 day ago',
            ],
            [
                'type' => 'Project',
                'title' => 'Infrastructure Project',
                'action' => 'published',
                'author' => 'Admin',
                'timestamp' => '2 days ago',
            ],
        ];

        $this->contentStats = [
            'projects' => ['published' => 18, 'draft' => 6],
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
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Projects -->
        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Projects</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ $stats['total_projects'] }}</h3>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Published Projects -->
        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Published</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ $stats['published_projects'] }}</h3>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Draft Projects -->
        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Drafts</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ $stats['draft_projects'] }}</h3>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Categories -->
        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Categories</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ $stats['total_categories'] }}</h3>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
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
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Project Status</h3>
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
                                            @case('Category')
                                                bg-purple-100 text-purple-800
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
