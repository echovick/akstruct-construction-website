<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use App\Models\Project;
use App\Models\Category;
use App\Services\CloudinaryService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

new #[Layout('layout.admin')] class extends Component {
    use WithFileUploads;

    public $project;

    // Basic Info
    public $title = '';
    public $slug = '';
    public $short_description = '';
    public $description = '';
    public $location = '';
    public $year = '';
    public $client = '';
    public $category_id = '';

    // Team/Stakeholders
    public $developer = '';
    public $architect = '';
    public $contractor = '';

    // Project Details
    public $area = '';
    public $duration = '';
    public $floors = '';
    public $cost = '';

    // Status & Timeline
    public $status = 'draft';
    public $completed_at = '';

    // Media
    public $featured_image;
    public $existing_featured_image = '';
    public $gallery_images = [];
    public $existing_gallery_images = [];
    public $video_path = '';

    // Documents
    public $completion_certificate;
    public $existing_completion_certificate = '';
    public $case_study_pdf;
    public $existing_case_study_pdf = '';

    // Content
    public $highlights = [];
    public $sustainability_focus = '';

    // Technical
    public $specifications = [];

    // Location
    public $map_coordinates = '';
    public $google_maps_url = '';

    // Metadata
    public $is_featured = false;
    public $is_published = false;

    // Other
    public $categories;
    public $currentTab = 'basic';

    public function mount($project)
    {
        $this->project = Project::findOrFail($project);
        $this->categories = Category::where('type', 'project')->get();

        // Load existing data
        $this->title = $this->project->title;
        $this->slug = $this->project->slug;
        $this->short_description = $this->project->short_description;
        $this->description = $this->project->description;
        $this->location = $this->project->location;
        $this->year = $this->project->year;
        $this->client = $this->project->client;
        $this->category_id = $this->project->category_id;
        $this->developer = $this->project->developer;
        $this->architect = $this->project->architect;
        $this->contractor = $this->project->contractor;
        $this->area = $this->project->area;
        $this->duration = $this->project->duration;
        $this->floors = $this->project->floors;
        $this->cost = $this->project->cost;
        $this->status = $this->project->status;
        $this->completed_at = $this->project->completed_at ? $this->project->completed_at->format('Y-m-d') : '';
        $this->existing_featured_image = $this->project->featured_image;

        // Handle gallery_images - ensure it's always an array
        $gallery = $this->project->gallery_images;
        if (is_string($gallery)) {
            $gallery = json_decode($gallery, true);
        }
        $this->existing_gallery_images = is_array($gallery) ? $gallery : [];

        $this->video_path = $this->project->video_path;
        $this->existing_completion_certificate = $this->project->completion_certificate;
        $this->existing_case_study_pdf = $this->project->case_study_pdf;

        // Handle highlights - ensure it's always an array
        $highlights = $this->project->highlights;
        if (is_string($highlights)) {
            $highlights = json_decode($highlights, true);
        }
        $this->highlights = is_array($highlights) ? $highlights : [''];

        $this->sustainability_focus = $this->project->sustainability_focus;

        // Handle specifications - ensure it's always an array
        $specs = $this->project->specifications;
        if (is_string($specs)) {
            $specs = json_decode($specs, true);
        }
        $this->specifications = is_array($specs) ? $specs : [['key' => '', 'value' => '']];

        $this->map_coordinates = $this->project->map_coordinates;
        $this->google_maps_url = $this->project->google_maps_url;
        $this->is_featured = $this->project->is_featured;
        $this->is_published = $this->project->is_published;

        // Ensure at least one empty field
        if (empty($this->highlights)) {
            $this->highlights = [''];
        }
        if (empty($this->specifications) || !is_array($this->specifications)) {
            $this->specifications = [['key' => '', 'value' => '']];
        }
    }

    public function updatedTitle()
    {
        $this->slug = Str::slug($this->title);
    }

    public function addHighlight()
    {
        $this->highlights[] = '';
    }

    public function removeHighlight($index)
    {
        unset($this->highlights[$index]);
        $this->highlights = array_values($this->highlights);
    }

    public function addSpecification()
    {
        $this->specifications[] = ['key' => '', 'value' => ''];
    }

    public function removeSpecification($index)
    {
        unset($this->specifications[$index]);
        $this->specifications = array_values($this->specifications);
    }

    public function removeGalleryImage($index)
    {
        unset($this->gallery_images[$index]);
        $this->gallery_images = array_values($this->gallery_images);
    }

    public function removeExistingGalleryImage($index)
    {
        $cloudinary = app(CloudinaryService::class);
        $imageUrl = $this->existing_gallery_images[$index];

        // Delete from Cloudinary
        $publicId = $cloudinary->getPublicIdFromUrl($imageUrl);
        if ($publicId) {
            $cloudinary->deleteImage($publicId);
        }

        unset($this->existing_gallery_images[$index]);
        $this->existing_gallery_images = array_values($this->existing_gallery_images);
    }

    public function removeExistingDocument($type)
    {
        $cloudinary = app(CloudinaryService::class);

        if ($type === 'certificate' && $this->existing_completion_certificate) {
            // Delete from Cloudinary
            $publicId = $cloudinary->getPublicIdFromUrl($this->existing_completion_certificate);
            if ($publicId) {
                $cloudinary->deleteImage($publicId);
            }

            $this->existing_completion_certificate = '';
            $this->project->completion_certificate = null;
            $this->project->save();
        } elseif ($type === 'case_study' && $this->existing_case_study_pdf) {
            // Delete from Cloudinary
            $publicId = $cloudinary->getPublicIdFromUrl($this->existing_case_study_pdf);
            if ($publicId) {
                $cloudinary->deleteImage($publicId);
            }

            $this->existing_case_study_pdf = '';
            $this->project->case_study_pdf = null;
            $this->project->save();
        }
        session()->flash('message', 'Document removed successfully.');
    }

    public function save($publish = false)
    {
        if ($publish) {
            $this->is_published = true;
        }

        $validatedData = $this->validate([
            'title' => 'required|min:3|max:255',
            'slug' => 'required|max:255|unique:projects,slug,' . $this->project->id,
            'short_description' => 'nullable|max:500',
            'description' => 'required',
            'location' => 'required|max:255',
            'year' => 'required|digits:4',
            'client' => 'nullable|max:255',
            'category_id' => 'required|exists:categories,id',
            'developer' => 'nullable|max:255',
            'architect' => 'nullable|max:255',
            'contractor' => 'nullable|max:255',
            'area' => 'nullable|max:100',
            'duration' => 'nullable|max:100',
            'floors' => 'nullable|max:50',
            'cost' => 'nullable|numeric|min:0',
            'status' => 'required|in:draft,planning,in_progress,completed,on_hold',
            'completed_at' => 'nullable|date',
            'featured_image' => 'nullable|image|max:5120',
            'gallery_images.*' => 'nullable|image|max:5120',
            'video_path' => 'nullable|url',
            'completion_certificate' => 'nullable|file|mimes:pdf|max:10240',
            'case_study_pdf' => 'nullable|file|mimes:pdf|max:10240',
            'sustainability_focus' => 'nullable',
            'map_coordinates' => 'nullable|max:255',
            'google_maps_url' => 'nullable|url',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
        ]);

        try {
            $cloudinary = app(CloudinaryService::class);

            // Upload new featured image if provided
            if ($this->featured_image) {
                $uploadedUrl = $cloudinary->uploadImage($this->featured_image, 'projects/featured');

                if ($uploadedUrl) {
                    // Delete old image from Cloudinary if it exists
                    if ($this->existing_featured_image) {
                        $publicId = $cloudinary->getPublicIdFromUrl($this->existing_featured_image);
                        if ($publicId) {
                            $cloudinary->deleteImage($publicId);
                        }
                    }
                    $this->existing_featured_image = $uploadedUrl;
                } else {
                    session()->flash('error', 'Failed to upload featured image. Please try again.');
                    return;
                }
            }

            // Upload new gallery images if provided
            $all_gallery_images = $this->existing_gallery_images;
            if (!empty($this->gallery_images)) {
                $newGalleryUrls = $cloudinary->uploadMultipleImages($this->gallery_images, 'projects/gallery');
                $all_gallery_images = array_merge($all_gallery_images, $newGalleryUrls);
            }

            // Upload new documents if provided
            if ($this->completion_certificate) {
                $uploadedUrl = $cloudinary->uploadDocument($this->completion_certificate, 'projects/certificates');

                if ($uploadedUrl) {
                    if ($this->existing_completion_certificate) {
                        $publicId = $cloudinary->getPublicIdFromUrl($this->existing_completion_certificate);
                        if ($publicId) {
                            $cloudinary->deleteImage($publicId);
                        }
                    }
                    $this->existing_completion_certificate = $uploadedUrl;
                }
            }

            if ($this->case_study_pdf) {
                $uploadedUrl = $cloudinary->uploadDocument($this->case_study_pdf, 'projects/case-studies');

                if ($uploadedUrl) {
                    if ($this->existing_case_study_pdf) {
                        $publicId = $cloudinary->getPublicIdFromUrl($this->existing_case_study_pdf);
                        if ($publicId) {
                            $cloudinary->deleteImage($publicId);
                        }
                    }
                    $this->existing_case_study_pdf = $uploadedUrl;
                }
            }

            // Filter and prepare data
            $highlights = array_filter($this->highlights, fn($h) => !empty($h));
            $specifications = array_filter($this->specifications, fn($s) => !empty($s['key']) && !empty($s['value']));

            // Update project
            $this->project->update([
                'title' => $this->title,
                'slug' => $this->slug,
                'short_description' => $this->short_description,
                'description' => $this->description,
                'location' => $this->location,
                'year' => $this->year,
                'client' => $this->client,
                'category_id' => $this->category_id,
                'developer' => $this->developer,
                'architect' => $this->architect,
                'contractor' => $this->contractor,
                'area' => $this->area,
                'duration' => $this->duration,
                'floors' => $this->floors,
                'cost' => $this->cost,
                'status' => $this->status,
                'completed_at' => $this->completed_at ? $this->completed_at : null,
                'featured_image' => $this->existing_featured_image,
                'gallery_images' => $all_gallery_images,
                'video_path' => $this->video_path,
                'completion_certificate' => $this->existing_completion_certificate,
                'case_study_pdf' => $this->existing_case_study_pdf,
                'highlights' => $highlights,
                'sustainability_focus' => $this->sustainability_focus,
                'specifications' => $specifications,
                'map_coordinates' => $this->map_coordinates,
                'google_maps_url' => $this->google_maps_url,
                'is_featured' => $this->is_featured,
                'is_published' => $this->is_published,
            ]);

            session()->flash('message', 'Project updated successfully!');
            return redirect()->route('admin.projects.overview');
        } catch (\Exception $e) {
            session()->flash('error', 'Error updating project: ' . $e->getMessage());
        }
    }

    public function saveDraft()
    {
        $this->is_published = false;
        $this->save();
    }

    public function saveAndPublish()
    {
        $this->save(true);
    }
}; ?>

<div class="w-full max-w-full space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl font-semibold text-gray-800">Edit Project: {{ $project->title }}</h2>
            <p class="mt-1 text-sm text-gray-600">Last updated: {{ $project->updated_at->diffForHumans() }}</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.projects.overview') }}"
                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                Cancel
            </a>
            <a href="{{ route('projects.show', $project->slug) }}" target="_blank"
                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                Preview
            </a>
            <button wire:click="saveDraft" wire:loading.attr="disabled"
                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors disabled:opacity-50">
                <span wire:loading.remove wire:target="saveDraft">Save as Draft</span>
                <span wire:loading wire:target="saveDraft">Saving...</span>
            </button>
            <button wire:click="saveAndPublish" wire:loading.attr="disabled"
                class="inline-flex items-center px-4 py-2 bg-primary-dark text-white rounded-md hover:bg-primary-darker transition-colors disabled:opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span wire:loading.remove wire:target="saveAndPublish">Save & Publish</span>
                <span wire:loading wire:target="saveAndPublish">Publishing...</span>
            </button>
        </div>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
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
                    <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

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

    <!-- Tabs Navigation -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 w-full min-w-0">
        <div class="border-b border-gray-200 overflow-x-auto">
            <nav class="-mb-px flex space-x-8 px-4 md:px-6 min-w-max md:min-w-0" aria-label="Tabs">
                <button wire:click="$set('currentTab', 'basic')" type="button"
                    class="py-4 px-1 border-b-2 font-medium text-sm transition-colors {{ $currentTab === 'basic' ? 'border-primary-dark text-primary-dark' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Basic Information
                </button>
                <button wire:click="$set('currentTab', 'details')" type="button"
                    class="py-4 px-1 border-b-2 font-medium text-sm transition-colors {{ $currentTab === 'details' ? 'border-primary-dark text-primary-dark' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Project Details
                </button>
                <button wire:click="$set('currentTab', 'media')" type="button"
                    class="py-4 px-1 border-b-2 font-medium text-sm transition-colors {{ $currentTab === 'media' ? 'border-primary-dark text-primary-dark' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Media & Gallery
                </button>
                <button wire:click="$set('currentTab', 'content')" type="button"
                    class="py-4 px-1 border-b-2 font-medium text-sm transition-colors {{ $currentTab === 'content' ? 'border-primary-dark text-primary-dark' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Content
                </button>
                <button wire:click="$set('currentTab', 'location')" type="button"
                    class="py-4 px-1 border-b-2 font-medium text-sm transition-colors {{ $currentTab === 'location' ? 'border-primary-dark text-primary-dark' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Location & Maps
                </button>
                <button wire:click="$set('currentTab', 'settings')" type="button"
                    class="py-4 px-1 border-b-2 font-medium text-sm transition-colors {{ $currentTab === 'settings' ? 'border-primary-dark text-primary-dark' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Settings
                </button>
            </nav>
        </div>

        <!-- Tab Content -->
        <div class="p-4 md:p-6">
            <!-- Basic Information Tab -->
            <div class="space-y-6 {{ $currentTab === 'basic' ? '' : 'hidden' }}">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                            Project Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model.live.debounce.300ms="title" id="title"
                            class="block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm"
                            placeholder="Enter project title">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div class="md:col-span-2">
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">
                            Slug <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="slug" id="slug"
                            class="block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm bg-gray-50"
                            readonly>
                        <p class="mt-1 text-xs text-gray-500">Auto-generated from title</p>
                        @error('slug')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Short Description -->
                    <div class="md:col-span-2">
                        <label for="short_description" class="block text-sm font-medium text-gray-700 mb-1">
                            Short Description
                        </label>
                        <textarea wire:model="short_description" id="short_description" rows="2"
                            class="block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm"
                            placeholder="Brief one-line description"></textarea>
                        <p class="mt-1 text-xs text-gray-500">{{ strlen($short_description) }}/500 characters</p>
                        @error('short_description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <select wire:model="category_id" id="category_id"
                            class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-dark focus:border-primary-dark sm:text-sm rounded-md">
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Year -->
                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-700 mb-1">
                            Year <span class="text-red-500">*</span>
                        </label>
                        <input type="number" wire:model="year" id="year" min="1900" max="2100"
                            class="block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm">
                        @error('year')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Client -->
                    <div>
                        <label for="client" class="block text-sm font-medium text-gray-700 mb-1">Client Name</label>
                        <input type="text" wire:model="client" id="client"
                            class="block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm">
                        @error('client')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Location -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-1">
                            Location <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="location" id="location"
                            class="block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm"
                            placeholder="City, State, Country">
                        @error('location')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Team/Stakeholders Section -->
                    <div class="md:col-span-2 pt-4 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Team & Stakeholders</h3>
                    </div>

                    <!-- Developer -->
                    <div>
                        <label for="developer" class="block text-sm font-medium text-gray-700 mb-1">Developer</label>
                        <input type="text" wire:model="developer" id="developer"
                            class="block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm">
                        @error('developer')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Architect -->
                    <div>
                        <label for="architect" class="block text-sm font-medium text-gray-700 mb-1">Architect</label>
                        <input type="text" wire:model="architect" id="architect"
                            class="block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm">
                        @error('architect')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contractor -->
                    <div class="md:col-span-2">
                        <label for="contractor"
                            class="block text-sm font-medium text-gray-700 mb-1">Contractor</label>
                        <input type="text" wire:model="contractor" id="contractor"
                            class="block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm">
                        @error('contractor')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Project Details Tab - Same as create page but with tabs expanded -->
            <div class="space-y-6 {{ $currentTab === 'details' ? '' : 'hidden' }}">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Area -->
                    <div>
                        <label for="area" class="block text-sm font-medium text-gray-700 mb-1">Area</label>
                        <input type="text" wire:model="area" id="area"
                            class="block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm"
                            placeholder="e.g., 5,000 sq.m">
                        @error('area')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Duration -->
                    <div>
                        <label for="duration" class="block text-sm font-medium text-gray-700 mb-1">Duration</label>
                        <input type="text" wire:model="duration" id="duration"
                            class="block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm"
                            placeholder="e.g., 18 months">
                        @error('duration')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Floors -->
                    <div>
                        <label for="floors" class="block text-sm font-medium text-gray-700 mb-1">Number of
                            Floors</label>
                        <input type="text" wire:model="floors" id="floors"
                            class="block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm"
                            placeholder="e.g., G+3">
                        @error('floors')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Cost -->
                    <div>
                        <label for="cost" class="block text-sm font-medium text-gray-700 mb-1">Project Value
                            (USD)</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <input type="number" wire:model="cost" id="cost" step="0.01"
                                class="pl-7 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm"
                                placeholder="0.00">
                        </div>
                        @error('cost')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select wire:model="status" id="status"
                            class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-dark focus:border-primary-dark sm:text-sm rounded-md">
                            @foreach (App\Models\Project::getStatuses() as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Completed At -->
                    <div>
                        <label for="completed_at" class="block text-sm font-medium text-gray-700 mb-1">Completion
                            Date</label>
                        <input type="date" wire:model="completed_at" id="completed_at"
                            class="block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm">
                        @error('completed_at')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Specifications Section -->
                    <div class="md:col-span-2 pt-4 border-t border-gray-200">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Technical Specifications</h3>
                            <button type="button" wire:click="addSpecification"
                                class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50">
                                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                Add Specification
                            </button>
                        </div>
                        <div class="space-y-3">
                            @foreach ($specifications as $index => $spec)
                                <div class="flex gap-3">
                                    <input type="text" wire:model="specifications.{{ $index }}.key"
                                        class="flex-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm"
                                        placeholder="Key (e.g., Foundation Type)">
                                    <input type="text" wire:model="specifications.{{ $index }}.value"
                                        class="flex-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm"
                                        placeholder="Value (e.g., Reinforced Concrete)">
                                    @if (count($specifications) > 1)
                                        <button type="button" wire:click="removeSpecification({{ $index }})"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Documents Section -->
                    <div class="md:col-span-2 pt-4 border-t border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Project Documents</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Completion Certificate -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Completion Certificate
                                    (PDF)</label>
                                @if ($existing_completion_certificate)
                                    <div class="mb-3 p-4 bg-gray-50 rounded-md flex items-center justify-between">
                                        <div class="flex items-center">
                                            <svg class="h-8 w-8 text-red-600" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span class="ml-2 text-sm text-gray-700">Certificate.pdf</span>
                                        </div>
                                        <div class="flex space-x-2">
                                            <a href="{{ Storage::url($existing_completion_certificate) }}"
                                                target="_blank"
                                                class="text-primary-dark hover:text-primary-darker text-sm">View</a>
                                            <button type="button" wire:click="removeExistingDocument('certificate')"
                                                class="text-red-600 hover:text-red-900 text-sm">Remove</button>
                                        </div>
                                    </div>
                                @endif
                                <div class="flex items-center justify-center w-full">
                                    <label for="completion_certificate"
                                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-2 text-gray-500" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                            <p class="mb-2 text-xs text-gray-500">
                                                @if ($completion_certificate)
                                                    {{ $completion_certificate->getClientOriginalName() }}
                                                @else
                                                    <span class="font-semibold">Click to upload</span>
                                                    {{ $existing_completion_certificate ? 'new' : '' }} certificate
                                                @endif
                                            </p>
                                            <p class="text-xs text-gray-500">PDF (MAX. 10MB)</p>
                                        </div>
                                        <input wire:model="completion_certificate" id="completion_certificate"
                                            type="file" class="hidden" accept=".pdf">
                                    </label>
                                </div>
                                @error('completion_certificate')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Case Study PDF -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Case Study (PDF)</label>
                                @if ($existing_case_study_pdf)
                                    <div class="mb-3 p-4 bg-gray-50 rounded-md flex items-center justify-between">
                                        <div class="flex items-center">
                                            <svg class="h-8 w-8 text-red-600" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span class="ml-2 text-sm text-gray-700">Case-Study.pdf</span>
                                        </div>
                                        <div class="flex space-x-2">
                                            <a href="{{ Storage::url($existing_case_study_pdf) }}" target="_blank"
                                                class="text-primary-dark hover:text-primary-darker text-sm">View</a>
                                            <button type="button" wire:click="removeExistingDocument('case_study')"
                                                class="text-red-600 hover:text-red-900 text-sm">Remove</button>
                                        </div>
                                    </div>
                                @endif
                                <div class="flex items-center justify-center w-full">
                                    <label for="case_study_pdf"
                                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-2 text-gray-500" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                            <p class="mb-2 text-xs text-gray-500">
                                                @if ($case_study_pdf)
                                                    {{ $case_study_pdf->getClientOriginalName() }}
                                                @else
                                                    <span class="font-semibold">Click to upload</span>
                                                    {{ $existing_case_study_pdf ? 'new' : '' }} case study
                                                @endif
                                            </p>
                                            <p class="text-xs text-gray-500">PDF (MAX. 10MB)</p>
                                        </div>
                                        <input wire:model="case_study_pdf" id="case_study_pdf" type="file"
                                            class="hidden" accept=".pdf">
                                    </label>
                                </div>
                                @error('case_study_pdf')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Media & Gallery Tab -->
            <div class="space-y-6 {{ $currentTab === 'media' ? '' : 'hidden' }}">
                <!-- Featured Image -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>
                    <div class="flex items-center justify-center w-full">
                        <label for="featured_image"
                            class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                            @if ($featured_image)
                                <img src="{{ $featured_image->temporaryUrl() }}"
                                    class="h-full w-auto object-contain rounded-lg">
                            @elseif ($existing_featured_image)
                                <img src="{{ Storage::url($existing_featured_image) }}"
                                    class="h-full w-auto object-contain rounded-lg">
                            @else
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to
                                            upload</span> new featured image</p>
                                    <p class="text-xs text-gray-500">PNG, JPG or WEBP (MAX. 5MB)</p>
                                </div>
                            @endif
                            <input wire:model="featured_image" id="featured_image" type="file" class="hidden"
                                accept="image/*">
                        </label>
                    </div>
                    @error('featured_image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gallery Images -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Project Gallery</label>

                    <!-- Existing Gallery Images -->
                    @if (!empty($existing_gallery_images))
                        <div class="mb-4">
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Existing Images</h4>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach ($existing_gallery_images as $index => $image)
                                    <div class="relative group">
                                        <img src="{{ Storage::url($image) }}"
                                            class="h-32 w-full object-cover rounded-lg">
                                        <button type="button"
                                            wire:click="removeExistingGalleryImage({{ $index }})"
                                            wire:confirm="Are you sure you want to remove this image?"
                                            class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1.5 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Upload New Images -->
                    <div class="flex items-center justify-center w-full mb-4">
                        <label for="gallery_images"
                            class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to
                                        upload</span> more images</p>
                                <p class="text-xs text-gray-500">Multiple images allowed (MAX. 5MB each)</p>
                            </div>
                            <input wire:model="gallery_images" id="gallery_images" type="file" class="hidden"
                                accept="image/*" multiple>
                        </label>
                    </div>

                    <!-- New Images Preview -->
                    @if (!empty($gallery_images))
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach ($gallery_images as $index => $image)
                                <div class="relative group">
                                    <img src="{{ $image->temporaryUrl() }}"
                                        class="h-32 w-full object-cover rounded-lg">
                                    <span
                                        class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded">New</span>
                                    <button type="button" wire:click="removeGalleryImage({{ $index }})"
                                        class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1.5 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @error('gallery_images.*')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Video Path -->
                <div>
                    <label for="video_path" class="block text-sm font-medium text-gray-700 mb-1">Project Video
                        URL</label>
                    <input type="url" wire:model="video_path" id="video_path"
                        class="block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm"
                        placeholder="https://www.youtube.com/watch?v=...">
                    <p class="mt-1 text-xs text-gray-500">YouTube or Vimeo URL</p>
                    @error('video_path')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Content Tab -->
            <div class="space-y-6 {{ $currentTab === 'content' ? '' : 'hidden' }}">
                <!-- Description -->
                <div wire:ignore>
                    <label for="description-edit" class="block text-sm font-medium text-gray-700 mb-1">
                        Project Description <span class="text-red-500">*</span>
                    </label>
                    <input id="description-edit" type="hidden" wire:model="description"
                        value="{{ $description }}">
                    <trix-editor input="description-edit" class="trix-content border border-gray-300 rounded-md"
                        placeholder="Detailed description of the project..."></trix-editor>
                    <p class="mt-1 text-xs text-gray-500">Use the toolbar above to format your text</p>
                </div>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror

                <!-- Sustainability Focus -->
                <div>
                    <label for="sustainability_focus"
                        class="block text-sm font-medium text-gray-700 mb-1">Sustainability Focus</label>
                    <textarea wire:model="sustainability_focus" id="sustainability_focus" rows="4"
                        class="block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm"
                        placeholder="Describe the sustainability aspects of this project..."></textarea>
                    @error('sustainability_focus')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Project Highlights -->
                <div>
                    <div class="flex justify-between items-center mb-3">
                        <label class="block text-sm font-medium text-gray-700">Project Highlights</label>
                        <button type="button" wire:click="addHighlight"
                            class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Add Highlight
                        </button>
                    </div>
                    <div class="space-y-3">
                        @foreach ($highlights as $index => $highlight)
                            <div class="flex gap-3">
                                <input type="text" wire:model="highlights.{{ $index }}"
                                    class="flex-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm"
                                    placeholder="Enter a key highlight...">
                                @if (count($highlights) > 1)
                                    <button type="button" wire:click="removeHighlight({{ $index }})"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Location & Maps Tab -->
            <div class="space-y-6 {{ $currentTab === 'location' ? '' : 'hidden' }}">
                <div class="grid grid-cols-1 gap-6">
                    <!-- Google Maps URL -->
                    <div>
                        <label for="google_maps_url" class="block text-sm font-medium text-gray-700 mb-1">Google Maps
                            URL</label>
                        <input type="url" wire:model="google_maps_url" id="google_maps_url"
                            class="block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm"
                            placeholder="https://maps.google.com/...">
                        <p class="mt-1 text-xs text-gray-500">Full Google Maps link to project location</p>
                        @error('google_maps_url')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Map Coordinates -->
                    <div>
                        <label for="map_coordinates" class="block text-sm font-medium text-gray-700 mb-1">Map
                            Coordinates</label>
                        <input type="text" wire:model="map_coordinates" id="map_coordinates"
                            class="block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm"
                            placeholder="Latitude, Longitude (e.g., 9.0579, 7.4951)">
                        <p class="mt-1 text-xs text-gray-500">For embedding maps on project detail page</p>
                        @error('map_coordinates')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Settings Tab -->
            <div class="space-y-6 {{ $currentTab === 'settings' ? '' : 'hidden' }}">
                <div class="space-y-6">
                    <!-- Featured Toggle -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="checkbox" wire:model="is_featured" id="is_featured"
                                class="h-4 w-4 text-primary-dark focus:ring-primary-dark border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="is_featured" class="font-medium text-gray-700">Featured Project</label>
                            <p class="text-gray-500">Mark this project as featured to display it prominently on the
                                homepage</p>
                        </div>
                    </div>

                    <!-- Published Toggle -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="checkbox" wire:model="is_published" id="is_published"
                                class="h-4 w-4 text-primary-dark focus:ring-primary-dark border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="is_published" class="font-medium text-gray-700">Published</label>
                            <p class="text-gray-500">Make this project visible to the public</p>
                        </div>
                    </div>

                    <!-- Metadata Info -->
                    <div class="pt-6 border-t border-gray-200">
                        <h3 class="text-sm font-medium text-gray-900 mb-4">Project Information</h3>
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Created</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $project->created_at->format('M d, Y') }}
                                </dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $project->updated_at->diffForHumans() }}
                                </dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Status</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ collect(App\Models\Project::getStatuses())->get($status) }}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Visibility</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    @if ($is_published)
                                        <span class="text-green-600 font-medium">Published</span>
                                    @else
                                        <span class="text-yellow-600 font-medium">Draft</span>
                                    @endif
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Action Bar -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 sticky bottom-0">
        <div class="flex justify-between items-center">
            <div class="text-sm text-gray-600">
                <span class="font-medium">Current Tab:</span>
                <span class="capitalize">{{ str_replace('_', ' ', $currentTab) }}</span>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.projects.overview') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button wire:click="saveDraft" wire:loading.attr="disabled"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors disabled:opacity-50">
                    <span wire:loading.remove wire:target="saveDraft">Save as Draft</span>
                    <span wire:loading wire:target="saveDraft">Saving...</span>
                </button>
                <button wire:click="saveAndPublish" wire:loading.attr="disabled"
                    class="inline-flex items-center px-4 py-2 bg-primary-dark text-white rounded-md hover:bg-primary-darker transition-colors disabled:opacity-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span wire:loading.remove wire:target="saveAndPublish">Save & Publish</span>
                    <span wire:loading wire:target="saveAndPublish">Publishing...</span>
                </button>
            </div>
        </div>
    </div>
</div>
