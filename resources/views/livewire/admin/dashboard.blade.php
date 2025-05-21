<?php

use App\Models\Project;
use App\Models\Quote;
use App\Models\Blog;
use App\Models\Service;
use App\Models\Testimonial;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('layout.admin', ['title' => 'Dashboard'])] class extends Component {
    public function with(): array
    {
        return [
            'projectsCount' => Project::count(),
            'servicesCount' => Service::count(),
            'testimonialsCount' => Testimonial::count(),
            'blogsCount' => Blog::count(),
            'recentQuotes' => Quote::latest()->take(5)->get(),
            'featuredProjects' => Project::where('is_featured', true)->take(3)->get(),
        ];
    }
}; ?>

<div>
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center">
                <div class="bg-primary-dark/10 p-3 rounded-full mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary-dark" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Total Projects</p>
                    <h3 class="text-2xl font-semibold">{{ $projectsCount }}</h3>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center">
                <div class="bg-secondary/10 p-3 rounded-full mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-secondary" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Services</p>
                    <h3 class="text-2xl font-semibold">{{ $servicesCount }}</h3>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center">
                <div class="bg-green-100 p-3 rounded-full mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Testimonials</p>
                    <h3 class="text-2xl font-semibold">{{ $testimonialsCount }}</h3>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center">
                <div class="bg-blue-100 p-3 rounded-full mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Blog Posts</p>
                    <h3 class="text-2xl font-semibold">{{ $blogsCount }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Quote Requests -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="p-6 bg-gray-50 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-800">Recent Quote Requests</h2>
                </div>

                <div class="divide-y divide-gray-100">
                    @forelse($recentQuotes as $quote)
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="font-medium">{{ $quote->name }}</h3>
                                    <p class="text-sm text-gray-500">{{ $quote->email }} | {{ $quote->phone }}</p>
                                    <p class="text-sm mt-1">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-dark/10 text-primary-dark">
                                            {{ ucfirst($quote->project_type) }}
                                        </span>

                                        @if ($quote->budget_range)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 ml-2">
                                                {{ str_replace('_', ' ', ucfirst($quote->budget_range)) }}
                                            </span>
                                        @endif
                                    </p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-gray-500">{{ $quote->created_at->diffForHumans() }}</p>
                                    <a href="{{ route('admin.quotes.show', $quote) }}"
                                        class="text-sm text-secondary hover:text-secondary-dark font-medium mt-2 inline-block">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center text-gray-500">
                            No recent quote requests found.
                        </div>
                    @endforelse
                </div>

                <div class="p-4 bg-gray-50 border-t border-gray-100">
                    <a href="{{ route('admin.quotes.index') }}"
                        class="text-secondary hover:text-secondary-dark text-sm font-medium">
                        View All Quote Requests →
                    </a>
                </div>
            </div>
        </div>

        <!-- Featured Projects -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="p-6 bg-gray-50 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-800">Featured Projects</h2>
                </div>

                <div class="divide-y divide-gray-100">
                    @forelse($featuredProjects as $project)
                        <div class="p-4">
                            <div class="flex">
                                <img src="{{ asset($project->featured_image) }}" alt="{{ $project->title }}"
                                    class="h-16 w-16 object-cover rounded-md mr-4">
                                <div>
                                    <h3 class="font-medium">{{ $project->title }}</h3>
                                    <p class="text-sm text-gray-500">{{ $project->category }} |
                                        {{ $project->location }}</p>
                                    <a href="{{ route('admin.projects.edit', $project) }}"
                                        class="text-xs text-secondary hover:text-secondary-dark font-medium mt-1 inline-block">
                                        Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center text-gray-500">
                            No featured projects found.
                        </div>
                    @endforelse
                </div>

                <div class="p-4 bg-gray-50 border-t border-gray-100">
                    <a href="{{ route('admin.projects.index') }}"
                        class="text-secondary hover:text-secondary-dark text-sm font-medium">
                        Manage Projects →
                    </a>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden mt-6">
                <div class="p-6 bg-gray-50 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-800">Quick Actions</h2>
                </div>

                <div class="p-6 grid grid-cols-2 gap-3">
                    <a href="{{ route('admin.projects.create') }}"
                        class="bg-primary-dark text-white py-3 px-4 rounded-md text-center text-sm font-medium hover:bg-primary-dark/90 transition-colors">
                        Add Project
                    </a>
                    <a href="{{ route('admin.blog.create') }}"
                        class="bg-secondary text-primary-dark py-3 px-4 rounded-md text-center text-sm font-medium hover:bg-secondary/90 transition-colors">
                        Add Blog Post
                    </a>
                    <a href="{{ route('admin.services.create') }}"
                        class="bg-gray-600 text-white py-3 px-4 rounded-md text-center text-sm font-medium hover:bg-gray-700 transition-colors">
                        Add Service
                    </a>
                    <a href="{{ route('admin.settings') }}"
                        class="bg-gray-200 text-gray-800 py-3 px-4 rounded-md text-center text-sm font-medium hover:bg-gray-300 transition-colors">
                        Settings
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
