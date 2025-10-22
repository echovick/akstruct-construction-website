<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Project;
use App\Models\Category;

new #[Layout('layout.admin')] class extends Component {
    public $stats;
    public $recentProjects;
    public $contentStats;

    public function mount()
    {
        // Real statistics from database
        $this->stats = [
            'total_projects' => Project::count(),
            'published_projects' => Project::where('is_published', true)->count(),
            'draft_projects' => Project::where('is_published', false)->count(),
            'featured_projects' => Project::where('is_featured', true)->count(),
            'total_categories' => Category::where('type', 'project')->count(),
            'completed_projects' => Project::where('status', 'completed')->count(),
            'in_progress_projects' => Project::where('status', 'in_progress')->count(),
        ];

        // Recent projects activity
        $this->recentProjects = Project::with('category')->orderBy('updated_at', 'desc')->take(10)->get();

        // Content statistics
        $this->contentStats = [
            'projects' => [
                'published' => Project::where('is_published', true)->count(),
                'draft' => Project::where('is_published', false)->count(),
            ],
        ];
    }

    public function getStatusBadgeClass($status)
    {
        return match ($status) {
            'draft' => 'bg-gray-100 text-gray-800',
            'planning' => 'bg-yellow-100 text-yellow-800',
            'in_progress' => 'bg-blue-100 text-blue-800',
            'completed' => 'bg-green-100 text-green-800',
            'on_hold' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }
}; ?>

<div class="space-y-6">
    <!-- Welcome Section -->
    <div
        class="bg-gradient-to-r from-primary-dark to-primary-light rounded-lg p-6 shadow-sm border border-gray-200 text-white">
        <h2 class="text-2xl font-semibold">Welcome to AKStruct CMS</h2>
        <p class="mt-2 text-white/90">Manage your construction portfolio and projects efficiently.</p>
        <div class="mt-4 flex space-x-4">
            <a href="{{ route('admin.projects.create') }}"
                class="inline-flex items-center px-4 py-2 bg-white text-primary-dark rounded-md hover:bg-gray-100 transition-colors text-sm font-medium">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                New Project
            </a>
            <a href="{{ route('home') }}" target="_blank"
                class="inline-flex items-center px-4 py-2 bg-white/10 text-white rounded-md hover:bg-white/20 transition-colors text-sm font-medium border border-white/30">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg>
                View Website
            </a>
        </div>
    </div>

    <!-- Overview Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Projects -->
        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Projects</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['total_projects'] }}</h3>
                    <p class="text-xs text-gray-500 mt-1">All time</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Published Projects -->
        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Published</p>
                    <h3 class="text-3xl font-bold text-green-600 mt-2">{{ $stats['published_projects'] }}</h3>
                    <p class="text-xs text-gray-500 mt-1">Live on website</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Draft Projects -->
        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Drafts</p>
                    <h3 class="text-3xl font-bold text-yellow-600 mt-2">{{ $stats['draft_projects'] }}</h3>
                    <p class="text-xs text-gray-500 mt-1">Unpublished</p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Featured Projects -->
        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Featured</p>
                    <h3 class="text-3xl font-bold text-purple-600 mt-2">{{ $stats['featured_projects'] }}</h3>
                    <p class="text-xs text-gray-500 mt-1">Highlighted</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Project Status Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Completed Projects</h3>
                <span class="text-2xl font-bold text-green-600">{{ $stats['completed_projects'] }}</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-green-600 h-2 rounded-full"
                    style="width: {{ $stats['total_projects'] > 0 ? ($stats['completed_projects'] / $stats['total_projects']) * 100 : 0 }}%">
                </div>
            </div>
            <p class="text-xs text-gray-500 mt-2">
                {{ $stats['total_projects'] > 0 ? round(($stats['completed_projects'] / $stats['total_projects']) * 100, 1) : 0 }}%
                of total
            </p>
        </div>

        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">In Progress</h3>
                <span class="text-2xl font-bold text-blue-600">{{ $stats['in_progress_projects'] }}</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-blue-600 h-2 rounded-full"
                    style="width: {{ $stats['total_projects'] > 0 ? ($stats['in_progress_projects'] / $stats['total_projects']) * 100 : 0 }}%">
                </div>
            </div>
            <p class="text-xs text-gray-500 mt-2">
                {{ $stats['total_projects'] > 0 ? round(($stats['in_progress_projects'] / $stats['total_projects']) * 100, 1) : 0 }}%
                of total
            </p>
        </div>

        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Categories</h3>
                <span class="text-2xl font-bold text-purple-600">{{ $stats['total_categories'] }}</span>
            </div>
            <a href="{{ route('admin.projects.categories') }}"
                class="inline-flex items-center text-sm text-primary-dark hover:text-primary-darker font-medium mt-2">
                Manage Categories
                <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>

    <!-- Content Stats and Recent Activity Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Quick Stats -->
        <div class="lg:col-span-1 bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Publication Status</h3>
                <div class="space-y-4">
                    @foreach ($contentStats as $type => $stats)
                        <div>
                            <div class="flex justify-between text-sm text-gray-600 mb-1">
                                <span class="capitalize font-medium">{{ str_replace('_', ' ', $type) }}</span>
                                <span class="font-semibold">{{ $stats['published'] + $stats['draft'] }} total</span>
                            </div>
                            <div class="h-3 bg-gray-200 rounded-full overflow-hidden">
                                @php
                                    $total = $stats['published'] + $stats['draft'];
                                    $publishedWidth = $total > 0 ? ($stats['published'] / $total) * 100 : 0;
                                @endphp
                                <div class="h-3 bg-gradient-to-r from-green-500 to-green-600 rounded-full transition-all duration-500"
                                    style="width: {{ $publishedWidth }}%"></div>
                            </div>
                            <div class="flex justify-between text-xs text-gray-500 mt-1">
                                <span class="flex items-center">
                                    <span class="h-2 w-2 bg-green-500 rounded-full mr-1"></span>
                                    {{ $stats['published'] }} published
                                </span>
                                <span class="flex items-center">
                                    <span class="h-2 w-2 bg-gray-400 rounded-full mr-1"></span>
                                    {{ $stats['draft'] }} draft
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h4 class="text-sm font-medium text-gray-700 mb-3">Quick Actions</h4>
                    <div class="space-y-2">
                        <a href="{{ route('admin.projects.create') }}"
                            class="flex items-center text-sm text-gray-700 hover:text-primary-dark hover:bg-gray-50 p-2 rounded transition-colors">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Create New Project
                        </a>
                        <a href="{{ route('admin.projects.overview') }}"
                            class="flex items-center text-sm text-gray-700 hover:text-primary-dark hover:bg-gray-50 p-2 rounded transition-colors">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                            </svg>
                            View All Projects
                        </a>
                        <a href="{{ route('admin.projects.categories') }}"
                            class="flex items-center text-sm text-gray-700 hover:text-primary-dark hover:bg-gray-50 p-2 rounded transition-colors">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            Manage Categories
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Projects Activity -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Recent Projects</h3>
                    <a href="{{ route('admin.projects.overview') }}"
                        class="text-sm text-primary-dark hover:text-primary-darker font-medium">
                        View All →
                    </a>
                </div>
                <div class="overflow-x-auto">
                    @if ($recentProjects->count() > 0)
                        <table class="min-w-full">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="text-left py-3 px-4 text-xs font-medium text-gray-600 uppercase">Project
                                    </th>
                                    <th class="text-left py-3 px-4 text-xs font-medium text-gray-600 uppercase">
                                        Category</th>
                                    <th class="text-left py-3 px-4 text-xs font-medium text-gray-600 uppercase">Status
                                    </th>
                                    <th class="text-left py-3 px-4 text-xs font-medium text-gray-600 uppercase">Updated
                                    </th>
                                    <th class="text-right py-3 px-4 text-xs font-medium text-gray-600 uppercase">Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($recentProjects as $project)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="py-3 px-4">
                                            <div class="flex items-center">
                                                @if ($project->featured_image)
                                                    <img src="{{ $project->featured_image }}"
                                                        alt="{{ $project->title }}"
                                                        class="h-10 w-10 rounded object-cover mr-3">
                                                @else
                                                    <div
                                                        class="h-10 w-10 rounded bg-gray-200 flex items-center justify-center mr-3">
                                                        <svg class="h-5 w-5 text-gray-400" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                @endif
                                                <div>
                                                    <p class="text-sm font-medium text-gray-800">
                                                        {{ Str::limit($project->title, 30) }}</p>
                                                    <p class="text-xs text-gray-500">{{ $project->location }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3 px-4 text-sm text-gray-700">
                                            {{ $project->category?->name ?? 'N/A' }}
                                        </td>
                                        <td class="py-3 px-4">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $this->getStatusBadgeClass($project->status) }}">
                                                {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 text-xs text-gray-500">
                                            {{ $project->updated_at->diffForHumans() }}
                                        </td>
                                        <td class="py-3 px-4 text-right">
                                            <a href="{{ route('admin.projects.edit', $project->id) }}"
                                                class="text-sm text-primary-dark hover:text-primary-darker font-medium">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No projects yet</h3>
                            <p class="mt-1 text-sm text-gray-500">Get started by creating your first project.</p>
                            <div class="mt-6">
                                <a href="{{ route('admin.projects.create') }}"
                                    class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-dark hover:bg-primary-darker">
                                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    Create Project
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
