<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\Project;
use App\Models\Category;
use App\Services\CloudinaryService;
use Illuminate\Support\Facades\Storage;

new #[Layout('layout.admin')] class extends Component {
    use WithPagination;

    public $search = '';
    public $categories;
    public $categoryFilter = '';
    public $statusFilter = '';
    public $publishedFilter = '';
    public $featuredFilter = '';
    public $selectedProjects = [];
    public $selectAll = false;

    public function mount()
    {
        $this->categories = Category::where('type', 'project')->get();
    }

    public function with()
    {
        $query = Project::query()
            ->with('category')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('client', 'like', '%' . $this->search . '%')
                        ->orWhere('location', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->categoryFilter, function ($query) {
                $query->where('category_id', $this->categoryFilter);
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->when($this->publishedFilter !== '', function ($query) {
                $query->where('is_published', $this->publishedFilter);
            })
            ->when($this->featuredFilter !== '', function ($query) {
                $query->where('is_featured', $this->featuredFilter);
            })
            ->orderBy('created_at', 'desc');

        // Get statistics
        $stats = [
            'total' => Project::count(),
            'published' => Project::where('is_published', true)->count(),
            'draft' => Project::where('is_published', false)->count(),
            'featured' => Project::where('is_featured', true)->count(),
        ];

        return [
            'projects' => $query->paginate(15),
            'stats' => $stats,
            'statuses' => Project::getStatuses(),
        ];
    }

    public function togglePublished($projectId)
    {
        $project = Project::find($projectId);
        if ($project) {
            $project->is_published = !$project->is_published;
            $project->save();

            session()->flash('message', 'Project ' . ($project->is_published ? 'published' : 'unpublished') . ' successfully.');
        }
    }

    public function toggleFeatured($projectId)
    {
        $project = Project::find($projectId);
        if ($project) {
            $project->is_featured = !$project->is_featured;
            $project->save();

            session()->flash('message', 'Project featured status updated.');
        }
    }

    public function deleteProject($projectId)
    {
        $project = Project::find($projectId);
        if ($project) {
            $cloudinary = app(CloudinaryService::class);

            // Delete associated files from Cloudinary
            if ($project->featured_image) {
                $publicId = $cloudinary->getPublicIdFromUrl($project->featured_image);
                if ($publicId) {
                    $cloudinary->deleteImage($publicId);
                }
            }
            if ($project->gallery_images) {
                foreach ($project->gallery_images as $image) {
                    $publicId = $cloudinary->getPublicIdFromUrl($image);
                    if ($publicId) {
                        $cloudinary->deleteImage($publicId);
                    }
                }
            }
            if ($project->completion_certificate) {
                $publicId = $cloudinary->getPublicIdFromUrl($project->completion_certificate);
                if ($publicId) {
                    $cloudinary->deleteImage($publicId);
                }
            }
            if ($project->case_study_pdf) {
                $publicId = $cloudinary->getPublicIdFromUrl($project->case_study_pdf);
                if ($publicId) {
                    $cloudinary->deleteImage($publicId);
                }
            }

            $project->delete();
            session()->flash('message', 'Project deleted successfully.');
        }
    }

    public function bulkDelete()
    {
        if (empty($this->selectedProjects)) {
            session()->flash('error', 'No projects selected.');
            return;
        }

        $cloudinary = app(CloudinaryService::class);
        $projects = Project::whereIn('id', $this->selectedProjects)->get();

        foreach ($projects as $project) {
            // Delete associated files from Cloudinary
            if ($project->featured_image) {
                $publicId = $cloudinary->getPublicIdFromUrl($project->featured_image);
                if ($publicId) {
                    $cloudinary->deleteImage($publicId);
                }
            }
            if ($project->gallery_images) {
                foreach ($project->gallery_images as $image) {
                    $publicId = $cloudinary->getPublicIdFromUrl($image);
                    if ($publicId) {
                        $cloudinary->deleteImage($publicId);
                    }
                }
            }
            if ($project->completion_certificate) {
                $publicId = $cloudinary->getPublicIdFromUrl($project->completion_certificate);
                if ($publicId) {
                    $cloudinary->deleteImage($publicId);
                }
            }
            if ($project->case_study_pdf) {
                $publicId = $cloudinary->getPublicIdFromUrl($project->case_study_pdf);
                if ($publicId) {
                    $cloudinary->deleteImage($publicId);
                }
            }

            $project->delete();
        }

        $this->selectedProjects = [];
        $this->selectAll = false;
        session()->flash('message', 'Selected projects deleted successfully.');
    }

    public function bulkPublish()
    {
        if (empty($this->selectedProjects)) {
            session()->flash('error', 'No projects selected.');
            return;
        }

        Project::whereIn('id', $this->selectedProjects)->update(['is_published' => true]);
        $this->selectedProjects = [];
        $this->selectAll = false;
        session()->flash('message', 'Selected projects published successfully.');
    }

    public function bulkUnpublish()
    {
        if (empty($this->selectedProjects)) {
            session()->flash('error', 'No projects selected.');
            return;
        }

        Project::whereIn('id', $this->selectedProjects)->update(['is_published' => false]);
        $this->selectedProjects = [];
        $this->selectAll = false;
        session()->flash('message', 'Selected projects unpublished successfully.');
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedProjects = Project::pluck('id')->toArray();
        } else {
            $this->selectedProjects = [];
        }
    }

    public function updating($field)
    {
        if (in_array($field, ['search', 'categoryFilter', 'statusFilter', 'publishedFilter', 'featuredFilter'])) {
            $this->resetPage();
        }
    }
}; ?>

<div class="w-full max-w-full space-y-6">
    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded-md">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700">{{ session('message') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-md">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-red-700">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl font-semibold text-gray-800">Projects</h2>
            <p class="text-sm text-gray-500 mt-1">Manage your construction portfolio</p>
        </div>
        <a href="{{ route('admin.projects.create') }}"
            class="inline-flex items-center px-4 py-2 bg-primary-dark text-white rounded-md hover:bg-primary-darker transition-colors shadow-sm w-full sm:w-auto justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add New Project
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-6 w-full min-w-0">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 lg:p-6 min-w-0">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div class="min-w-0">
                    <p class="text-xs lg:text-sm font-medium text-gray-600 break-words">Total Projects</p>
                    <h3 class="text-2xl lg:text-3xl font-bold text-gray-800 mt-1 lg:mt-2 break-words">
                        {{ $stats['total'] }}</h3>
                </div>
                <div class="hidden lg:block bg-blue-100 p-3 rounded-full flex-shrink-0">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 lg:p-6 min-w-0">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div class="min-w-0">
                    <p class="text-xs lg:text-sm font-medium text-gray-600 break-words">Published</p>
                    <h3 class="text-2xl lg:text-3xl font-bold text-green-600 mt-1 lg:mt-2 break-words">
                        {{ $stats['published'] }}</h3>
                </div>
                <div class="hidden lg:block bg-green-100 p-3 rounded-full flex-shrink-0">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 lg:p-6 min-w-0">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div class="min-w-0">
                    <p class="text-xs lg:text-sm font-medium text-gray-600 break-words">Drafts</p>
                    <h3 class="text-2xl lg:text-3xl font-bold text-yellow-600 mt-1 lg:mt-2 break-words">
                        {{ $stats['draft'] }}</h3>
                </div>
                <div class="hidden lg:block bg-yellow-100 p-3 rounded-full flex-shrink-0">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 lg:p-6 min-w-0">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div class="min-w-0">
                    <p class="text-xs lg:text-sm font-medium text-gray-600 break-words">Featured</p>
                    <h3 class="text-2xl lg:text-3xl font-bold text-purple-600 mt-1 lg:mt-2 break-words">
                        {{ $stats['featured'] }}</h3>
                </div>
                <div class="hidden lg:block bg-purple-100 p-3 rounded-full flex-shrink-0">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 lg:p-6 w-full min-w-0">
        <!-- Search -->
        <div class="mb-4">
            <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" wire:model.live.debounce.300ms="search" id="search"
                    class="pl-10 focus:ring-primary-dark focus:border-primary-dark block w-full sm:text-sm border-gray-300 rounded-md"
                    placeholder="Search by title, client, or location...">
            </div>
        </div>

        <!-- Filters Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Category Filter -->
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                <select wire:model.live="categoryFilter" id="category"
                    class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-dark focus:border-primary-dark sm:text-sm rounded-md">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Status Filter -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select wire:model.live="statusFilter" id="status"
                    class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-dark focus:border-primary-dark sm:text-sm rounded-md">
                    <option value="">All Statuses</option>
                    @foreach ($statuses as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Published Filter -->
            <div>
                <label for="published" class="block text-sm font-medium text-gray-700 mb-2">Published</label>
                <select wire:model.live="publishedFilter" id="published"
                    class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-dark focus:border-primary-dark sm:text-sm rounded-md">
                    <option value="">All</option>
                    <option value="1">Published</option>
                    <option value="0">Draft</option>
                </select>
            </div>

            <!-- Featured Filter -->
            <div>
                <label for="featured" class="block text-sm font-medium text-gray-700 mb-2">Featured</label>
                <select wire:model.live="featuredFilter" id="featured"
                    class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-dark focus:border-primary-dark sm:text-sm rounded-md">
                    <option value="">All</option>
                    <option value="1">Featured</option>
                    <option value="0">Not Featured</option>
                </select>
            </div>
        </div>

        <!-- Bulk Actions -->
        @if (count($selectedProjects) > 0)
            <div class="mt-4 pt-4 border-t border-gray-200">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                    <span class="text-sm text-gray-600 font-medium">{{ count($selectedProjects) }} project(s)
                        selected</span>
                    <div class="flex flex-wrap gap-2 w-full sm:w-auto">
                        <button wire:click="bulkPublish"
                            wire:confirm="Are you sure you want to publish the selected projects?"
                            class="flex-1 sm:flex-none inline-flex items-center justify-center px-3 py-2 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-dark">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Publish
                        </button>
                        <button wire:click="bulkUnpublish"
                            wire:confirm="Are you sure you want to unpublish the selected projects?"
                            class="flex-1 sm:flex-none inline-flex items-center justify-center px-3 py-2 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-dark">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>
                            Unpublish
                        </button>
                        <button wire:click="bulkDelete"
                            wire:confirm="Are you sure you want to delete the selected projects? This action cannot be undone."
                            class="flex-1 sm:flex-none inline-flex items-center justify-center px-3 py-2 border border-transparent shadow-sm text-xs font-medium rounded text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Projects List - Desktop Table / Mobile Cards -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 w-full min-w-0">
        <!-- Desktop Table View -->
        <div class="hidden lg:block overflow-x-auto">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3 text-left w-12">
                            <input type="checkbox" wire:model.live="selectAll"
                                class="rounded border-gray-300 text-primary-dark focus:ring-primary-dark">
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Project</th>
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Category</th>
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Client</th>
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status</th>
                        <th scope="col"
                            class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Published</th>
                        <th scope="col"
                            class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Featured</th>
                        <th scope="col"
                            class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($projects as $project)
                        <tr
                            class="hover:bg-gray-50 transition-colors {{ !$project->is_published ? 'bg-yellow-50/30' : '' }}">
                            <td class="px-4 py-4 whitespace-nowrap">
                                <input type="checkbox" wire:model.live="selectedProjects"
                                    value="{{ $project->id }}"
                                    class="rounded border-gray-300 text-primary-dark focus:ring-primary-dark">
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex-shrink-0">
                                        @if ($project->featured_image)
                                            <img class="h-12 w-12 rounded object-cover"
                                                src="{{ $project->featured_image }}" alt="{{ $project->title }}">
                                        @else
                                            <div
                                                class="h-12 w-12 rounded bg-gray-200 flex items-center justify-center">
                                                <svg class="h-6 w-6 text-gray-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-center gap-2">
                                            <p class="text-sm font-medium text-gray-900 truncate max-w-xs">
                                                {{ $project->title }}
                                            </p>
                                            @if ($project->is_featured)
                                                <span title="Featured">
                                                    <svg class="h-4 w-4 text-yellow-500 fill-current"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                </span>
                                            @endif
                                        </div>
                                        <p class="text-xs text-gray-500 truncate max-w-xs">{{ $project->location }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-900">{{ $project->category?->name ?? 'N/A' }}</span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-900">{{ $project->client ?? 'N/A' }}</span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                @php
                                    $normalizedStatus = strtolower(str_replace(' ', '_', $project->status));
                                @endphp
                                <span
                                    class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @switch($normalizedStatus)
                                        @case('draft')
                                            bg-gray-100 text-gray-800
                                            @break
                                        @case('planning')
                                            bg-yellow-100 text-yellow-800
                                            @break
                                        @case('in_progress')
                                            bg-blue-100 text-blue-800
                                            @break
                                        @case('completed')
                                            bg-green-100 text-green-800
                                            @break
                                        @case('on_hold')
                                            bg-red-100 text-red-800
                                            @break
                                        @default
                                            bg-gray-100 text-gray-800
                                    @endswitch
                                ">
                                    {{ $statuses[$normalizedStatus] ?? ucfirst(str_replace('_', ' ', $project->status)) }}
                                </span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-center">
                                <button wire:click="togglePublished({{ $project->id }})"
                                    class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-dark {{ $project->is_published ? 'bg-green-600' : 'bg-gray-200' }}"
                                    role="switch" aria-checked="{{ $project->is_published ? 'true' : 'false' }}">
                                    <span aria-hidden="true"
                                        class="pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200 {{ $project->is_published ? 'translate-x-5' : 'translate-x-0' }}"></span>
                                </button>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-center">
                                <button wire:click="toggleFeatured({{ $project->id }})"
                                    class="text-gray-400 hover:text-yellow-500 transition-colors">
                                    <svg class="h-5 w-5 {{ $project->is_featured ? 'text-yellow-500 fill-current' : '' }}"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                </button>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-right text-sm">
                                <div class="flex justify-end items-center gap-3">
                                    <a href="{{ route('admin.projects.edit', $project->id) }}"
                                        class="text-primary-dark hover:text-primary-darker transition-colors font-medium">
                                        Edit
                                    </a>
                                    <a href="{{ route('projects.show', $project->slug) }}" target="_blank"
                                        class="text-gray-600 hover:text-gray-900 transition-colors font-medium">
                                        View
                                    </a>
                                    <button wire:click="deleteProject({{ $project->id }})"
                                        wire:confirm="Are you sure you want to delete this project? This action cannot be undone."
                                        class="text-red-600 hover:text-red-900 transition-colors font-medium">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No projects found</h3>
                                <p class="mt-1 text-sm text-gray-500">Get started by creating a new project.</p>
                                <div class="mt-6">
                                    <a href="{{ route('admin.projects.create') }}"
                                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-dark hover:bg-primary-darker focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-dark">
                                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                        New Project
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="lg:hidden divide-y divide-gray-200">
            @forelse ($projects as $project)
                <div class="p-4 {{ !$project->is_published ? 'bg-yellow-50/30' : '' }}">
                    <!-- Project Header with Checkbox -->
                    <div class="flex items-start gap-3 mb-3">
                        <input type="checkbox" wire:model.live="selectedProjects" value="{{ $project->id }}"
                            class="mt-1 rounded border-gray-300 text-primary-dark focus:ring-primary-dark">

                        <div class="flex-1 min-w-0">
                            <div class="flex items-start gap-3">
                                @if ($project->featured_image)
                                    <img class="h-16 w-16 rounded object-cover flex-shrink-0"
                                        src="{{ $project->featured_image }}" alt="{{ $project->title }}">
                                @else
                                    <div
                                        class="h-16 w-16 rounded bg-gray-200 flex items-center justify-center flex-shrink-0">
                                        <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif

                                <div class="flex-1 min-w-0">
                                    <div class="flex items-start justify-between gap-2">
                                        <h3 class="text-sm font-semibold text-gray-900 break-words">
                                            {{ $project->title }}
                                        </h3>
                                        @if ($project->is_featured)
                                            <svg class="h-5 w-5 text-yellow-500 fill-current flex-shrink-0"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endif
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">{{ $project->location }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Project Details -->
                    <div class="pl-8 space-y-2">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">Category:</span>
                            <span class="text-gray-900 font-medium">{{ $project->category?->name ?? 'N/A' }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">Client:</span>
                            <span class="text-gray-900 font-medium">{{ $project->client ?? 'N/A' }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">Status:</span>
                            @php
                                $normalizedStatus = strtolower(str_replace(' ', '_', $project->status));
                            @endphp
                            <span
                                class="px-2 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full
                                @switch($normalizedStatus)
                                    @case('draft')
                                        bg-gray-100 text-gray-800
                                        @break
                                    @case('planning')
                                        bg-yellow-100 text-yellow-800
                                        @break
                                    @case('in_progress')
                                        bg-blue-100 text-blue-800
                                        @break
                                    @case('completed')
                                        bg-green-100 text-green-800
                                        @break
                                    @case('on_hold')
                                        bg-red-100 text-red-800
                                        @break
                                    @default
                                        bg-gray-100 text-gray-800
                                @endswitch
                            ">
                                {{ $statuses[$normalizedStatus] ?? ucfirst(str_replace('_', ' ', $project->status)) }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">Published:</span>
                            <button wire:click="togglePublished({{ $project->id }})"
                                class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-dark {{ $project->is_published ? 'bg-green-600' : 'bg-gray-200' }}"
                                role="switch" aria-checked="{{ $project->is_published ? 'true' : 'false' }}">
                                <span aria-hidden="true"
                                    class="pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200 {{ $project->is_published ? 'translate-x-5' : 'translate-x-0' }}"></span>
                            </button>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-4 pt-4 border-t border-gray-200 flex items-center justify-between gap-2">
                        <button wire:click="toggleFeatured({{ $project->id }})"
                            class="text-gray-400 hover:text-yellow-500 transition-colors">
                            <svg class="h-5 w-5 {{ $project->is_featured ? 'text-yellow-500 fill-current' : '' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </button>
                        <div class="flex items-center gap-3 text-sm">
                            <a href="{{ route('admin.projects.edit', $project->id) }}"
                                class="text-primary-dark hover:text-primary-darker transition-colors font-medium">
                                Edit
                            </a>
                            <a href="{{ route('projects.show', $project->slug) }}" target="_blank"
                                class="text-gray-600 hover:text-gray-900 transition-colors font-medium">
                                View
                            </a>
                            <button wire:click="deleteProject({{ $project->id }})"
                                wire:confirm="Are you sure you want to delete this project? This action cannot be undone."
                                class="text-red-600 hover:text-red-900 transition-colors font-medium">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="px-6 py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No projects found</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by creating a new project.</p>
                    <div class="mt-6">
                        <a href="{{ route('admin.projects.create') }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-dark hover:bg-primary-darker focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-dark">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            New Project
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($projects->hasPages())
            <div class="bg-white px-4 py-3 border-t border-gray-200">
                {{ $projects->links() }}
            </div>
        @endif
    </div>
</div>
