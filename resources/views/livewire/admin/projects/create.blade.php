<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use App\Models\Project;
use App\Models\Category;
use App\Services\CloudinaryService;
use Illuminate\Support\Str;

new #[Layout('layout.admin')] class extends Component {
    use WithFileUploads;

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
    public $gallery_images = [];
    public $video_path = '';

    // Documents
    public $completion_certificate;
    public $case_study_pdf;

    // Content
    public $highlights = [''];
    public $sustainability_focus = '';

    // Technical
    public $specifications = [['key' => '', 'value' => '']];

    // Location
    public $map_coordinates = '';
    public $google_maps_url = '';

    // Metadata
    public $is_featured = false;
    public $is_published = false;

    // Other
    public $categories;
    public $currentTab = 'basic';

    public function mount()
    {
        $this->categories = Category::where('type', 'project')->get();
        $this->year = now()->year;
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

    public function save($publish = false)
    {
        if ($publish) {
            $this->is_published = true;
        }

        $validatedData = $this->validate([
            'title' => 'required|min:3|max:255',
            'slug' => 'required|unique:projects,slug|max:255',
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
            'featured_image' => 'required|image|max:5120',
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

            // Upload featured image to Cloudinary
            $featured_image_path = $cloudinary->uploadImage($this->featured_image, 'projects/featured');

            if (!$featured_image_path) {
                session()->flash('error', 'Failed to upload featured image. Please check your Cloudinary configuration and try again.');
                return;
            }

            // Upload gallery images to Cloudinary
            $gallery_paths = [];
            if (!empty($this->gallery_images)) {
                $gallery_paths = $cloudinary->uploadMultipleImages($this->gallery_images, 'projects/gallery');
            }

            // Upload documents to Cloudinary
            $certificate_path = null;
            if ($this->completion_certificate) {
                $certificate_path = $cloudinary->uploadDocument($this->completion_certificate, 'projects/certificates');
            }

            $case_study_path = null;
            if ($this->case_study_pdf) {
                $case_study_path = $cloudinary->uploadDocument($this->case_study_pdf, 'projects/case-studies');
            }

            // Filter and prepare data
            $highlights = array_filter($this->highlights, fn($h) => !empty($h));
            $specifications = array_filter($this->specifications, fn($s) => !empty($s['key']) && !empty($s['value']));

            // Create project
            $project = Project::create([
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
                'featured_image' => $featured_image_path,
                'gallery_images' => $gallery_paths,
                'video_path' => $this->video_path,
                'completion_certificate' => $certificate_path,
                'case_study_pdf' => $case_study_path,
                'highlights' => $highlights,
                'sustainability_focus' => $this->sustainability_focus,
                'specifications' => $specifications,
                'map_coordinates' => $this->map_coordinates,
                'google_maps_url' => $this->google_maps_url,
                'is_featured' => $this->is_featured,
                'is_published' => $this->is_published,
            ]);

            session()->flash('message', 'Project created successfully!');
            return redirect()->route('admin.projects.overview');
        } catch (\Exception $e) {
            session()->flash('error', 'Error creating project: ' . $e->getMessage());
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
            <h2 class="text-2xl font-semibold text-gray-800">Create New Project</h2>
            <p class="mt-1 text-sm text-gray-600">Add a new project to your portfolio</p>
        </div>
        <div class="flex flex-wrap gap-3 w-full sm:w-auto">
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

            <!-- Project Details Tab -->
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
                                                    <span class="font-semibold">Click to upload</span> certificate
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
                                                    <span class="font-semibold">Click to upload</span> case study
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
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Featured Image <span class="text-red-500">*</span>
                    </label>
                    <div class="flex items-center justify-center w-full">
                        <label for="featured_image"
                            class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                            @if ($featured_image)
                                <img src="{{ $featured_image->temporaryUrl() }}"
                                    class="h-full w-auto object-contain rounded-lg">
                            @else
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to
                                            upload</span> featured image</p>
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
                                        upload</span> gallery images</p>
                                <p class="text-xs text-gray-500">Multiple images allowed (MAX. 5MB each)</p>
                            </div>
                            <input wire:model="gallery_images" id="gallery_images" type="file" class="hidden"
                                accept="image/*" multiple>
                        </label>
                    </div>

                    @if (!empty($gallery_images))
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach ($gallery_images as $index => $image)
                                <div class="relative group">
                                    <img src="{{ $image->temporaryUrl() }}"
                                        class="h-32 w-full object-cover rounded-lg">
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
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        Project Description <span class="text-red-500">*</span>
                    </label>
                    <input id="description" type="hidden" wire:model="description">
                    <trix-editor input="description" class="trix-content border border-gray-300 rounded-md"
                        placeholder="Detailed description of the project..."></trix-editor>
                    <p class="mt-1 text-xs text-gray-500">Use the toolbar above to format your text</p>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

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

                    <!-- Map Preview -->
                    @if ($map_coordinates)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Map Preview</label>
                            <div class="bg-gray-100 rounded-lg h-64 flex items-center justify-center">
                                <p class="text-gray-500 text-sm">Map preview would appear here</p>
                            </div>
                        </div>
                    @endif
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
                            <label for="is_published" class="font-medium text-gray-700">Publish Immediately</label>
                            <p class="text-gray-500">Make this project visible to the public immediately upon saving
                            </p>
                        </div>
                    </div>

                    <!-- Metadata Info -->
                    <div class="pt-6 border-t border-gray-200">
                        <h3 class="text-sm font-medium text-gray-900 mb-4">Additional Information</h3>
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Slug</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $slug ?: 'Will be generated from title' }}
                                </dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Status</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ collect(App\Models\Project::getStatuses())->get($status) }}</dd>
                            </div>
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">Note</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    @if ($is_published)
                                        This project will be published and visible to the public.
                                    @else
                                        This project will be saved as a draft and will not be visible to the public.
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

@push('scripts')
    <script>
        // Alpine.js will handle the tab switching through x-show directives
        document.addEventListener('alpine:init', () => {
            // Any additional JavaScript can go here
        });
    </script>
@endpush
