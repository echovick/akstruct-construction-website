<?php

use App\Models\Project;
use Livewire\WithFileUploads;
use Livewire\Volt\Component;
use Illuminate\Support\Str;

new class extends Component {
    use WithFileUploads;

    public $project;
    public $projectId;
    public $title = '';
    public $slug = '';
    public $description = '';
    public $short_description = '';
    public $category = '';
    public $location = '';
    public $year = '';
    public $client = '';
    public $area = '';
    public $duration = '';
    public $floors = '';
    public $status = 'Completed';
    public $is_featured = false;
    public $image;
    public $gallery = [];
    public $existingGallery = [];

    public $statuses = ['Completed', 'In Progress', 'Planned'];
    public $categories = ['Residential', 'Commercial', 'Industrial', 'Educational', 'Healthcare', 'Hospitality', 'Mixed-Use', 'Cultural', 'Sports', 'Urban Planning'];

    public function mount($id = null)
    {
        $this->projectId = $id;

        if ($id) {
            $this->project = Project::findOrFail($id);
            $this->title = $this->project->title;
            $this->slug = $this->project->slug;
            $this->description = $this->project->description;
            $this->short_description = $this->project->short_description;
            $this->category = $this->project->category;
            $this->location = $this->project->location;
            $this->year = $this->project->year;
            $this->client = $this->project->client;
            $this->area = $this->project->area;
            $this->duration = $this->project->duration;
            $this->floors = $this->project->floors;
            $this->status = $this->project->status;
            $this->is_featured = $this->project->is_featured;
            $this->existingGallery = $this->project->gallery ?? [];
        } else {
            $this->year = date('Y');
        }
    }

    public function updatedTitle()
    {
        $this->slug = Str::slug($this->title);
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|min:3|max:255',
            'slug' => 'required|unique:projects,slug,' . $this->projectId,
            'description' => 'required',
            'category' => 'required',
            'location' => 'required',
            'year' => 'required',
            'image' => $this->projectId ? 'nullable|image|max:2048' : 'nullable|image|max:2048',
            'gallery.*' => 'nullable|image|max:2048',
        ]);

        $data = [
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'short_description' => $this->short_description,
            'category' => $this->category,
            'location' => $this->location,
            'year' => $this->year,
            'client' => $this->client,
            'area' => $this->area,
            'duration' => $this->duration,
            'floors' => $this->floors,
            'status' => $this->status,
            'is_featured' => $this->is_featured,
        ];

        // Handle main image upload
        if ($this->image) {
            $imagePath = $this->image->store('assets/projects', 'public');
            $data['image_path'] = $imagePath;
        }

        // Handle gallery images upload
        if (count($this->gallery) > 0) {
            $galleryPaths = [];

            // Include existing gallery images
            if (is_array($this->existingGallery)) {
                $galleryPaths = $this->existingGallery;
            }

            // Add new gallery images
            foreach ($this->gallery as $image) {
                $path = $image->store('assets/projects/gallery', 'public');
                $galleryPaths[] = $path;
            }

            $data['gallery'] = $galleryPaths;
        }

        if ($this->projectId) {
            $this->project->update($data);
            $message = 'Project updated successfully!';
        } else {
            Project::create($data);
            $message = 'Project created successfully!';
        }

        $this->dispatch('notify', [
            'type' => 'success',
            'message' => $message,
        ]);

        return redirect()->route('admin.projects.index');
    }

    public function removeGalleryImage($index)
    {
        unset($this->existingGallery[$index]);
        $this->existingGallery = array_values($this->existingGallery);
    }
}; ?>

<div>
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">
                {{ $projectId ? 'Edit Project' : 'Create New Project' }}
            </h2>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left mr-2"></i> Back to Projects
            </a>
        </div>

        <form wire:submit="save" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title and Slug -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title *</label>
                    <input wire:model="title" type="text" id="title" class="form-input w-full" required>
                    @error('title')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug *</label>
                    <input wire:model="slug" type="text" id="slug" class="form-input w-full" required>
                    @error('slug')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Category and Location -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                    <select wire:model="category" id="category" class="form-select w-full" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat }}">{{ $cat }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location *</label>
                    <input wire:model="location" type="text" id="location" class="form-input w-full" required>
                    @error('location')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Year and Status -->
                <div>
                    <label for="year" class="block text-sm font-medium text-gray-700 mb-1">Year *</label>
                    <input wire:model="year" type="text" id="year" class="form-input w-full" required>
                    @error('year')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select wire:model="status" id="status" class="form-select w-full">
                        @foreach ($statuses as $status)
                            <option value="{{ $status }}">{{ $status }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Client and Area -->
                <div>
                    <label for="client" class="block text-sm font-medium text-gray-700 mb-1">Client</label>
                    <input wire:model="client" type="text" id="client" class="form-input w-full">
                </div>
                <div>
                    <label for="area" class="block text-sm font-medium text-gray-700 mb-1">Area (m²)</label>
                    <input wire:model="area" type="text" id="area" class="form-input w-full">
                </div>

                <!-- Duration and Floors -->
                <div>
                    <label for="duration" class="block text-sm font-medium text-gray-700 mb-1">Duration (months)</label>
                    <input wire:model="duration" type="text" id="duration" class="form-input w-full">
                </div>
                <div>
                    <label for="floors" class="block text-sm font-medium text-gray-700 mb-1">Floors</label>
                    <input wire:model="floors" type="text" id="floors" class="form-input w-full">
                </div>

                <!-- Featured Checkbox -->
                <div class="md:col-span-2">
                    <div class="flex items-center">
                        <input wire:model="is_featured" type="checkbox" id="is_featured" class="form-checkbox">
                        <label for="is_featured" class="ml-2 text-sm text-gray-700">Feature this project on the
                            homepage</label>
                    </div>
                </div>
            </div>

            <!-- Short Description -->
            <div>
                <label for="short_description" class="block text-sm font-medium text-gray-700 mb-1">Short
                    Description</label>
                <textarea wire:model="short_description" id="short_description" rows="2" class="form-textarea w-full"
                    placeholder="Brief overview of the project (appears in listings)"></textarea>
            </div>

            <!-- Full Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Full Description *</label>
                <textarea wire:model="description" id="description" rows="6" class="form-textarea w-full" required></textarea>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Main Image Upload -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Main Project Image</label>
                <div class="mt-1 flex items-center">
                    @if ($projectId && $project->image_path && !$image)
                        <div class="mr-4 flex-shrink-0">
                            <img src="{{ asset('storage/' . $project->image_path) }}" alt="{{ $title }}"
                                class="h-32 w-auto object-cover rounded-lg border border-gray-200">
                        </div>
                    @endif

                    @if ($image)
                        <div class="mr-4 flex-shrink-0">
                            <img src="{{ $image->temporaryUrl() }}" alt="Preview"
                                class="h-32 w-auto object-cover rounded-lg border border-gray-200">
                        </div>
                    @endif

                    <div class="flex-1">
                        <input wire:model="image" type="file" id="image" class="sr-only" accept="image/*">
                        <label for="image" class="btn btn-outline-secondary cursor-pointer">
                            <i class="fas fa-upload mr-2"></i> {{ $projectId ? 'Change Image' : 'Upload Image' }}
                        </label>
                        <p class="mt-1 text-sm text-gray-500">JPG, PNG or GIF. Max 2MB.</p>
                        @error('image')
                            <span class="text-red-500 text-sm block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Gallery Images Upload -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Gallery Images</label>

                <!-- Existing Gallery Images -->
                @if (count($existingGallery) > 0)
                    <div class="mb-4">
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Existing Images</h4>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                            @foreach ($existingGallery as $index => $galleryImage)
                                <div class="relative group">
                                    <img src="{{ asset('storage/' . $galleryImage) }}"
                                        alt="Gallery image {{ $index + 1 }}"
                                        class="h-24 w-full object-cover rounded-lg border border-gray-200">
                                    <button wire:click="removeGalleryImage({{ $index }})" type="button"
                                        class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <i class="fas fa-times text-xs"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- New Gallery Images -->
                @if (count($gallery) > 0)
                    <div class="mb-4">
                        <h4 class="text-sm font-medium text-gray-700 mb-2">New Images</h4>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                            @foreach ($gallery as $index => $img)
                                <div class="relative group">
                                    <img src="{{ $img->temporaryUrl() }}"
                                        alt="New gallery image {{ $index + 1 }}"
                                        class="h-24 w-full object-cover rounded-lg border border-gray-200">
                                    <button wire:click="$set('gallery.{{ $index }}', null)" type="button"
                                        class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <i class="fas fa-times text-xs"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="flex-1">
                    <input wire:model="gallery" type="file" id="gallery" class="sr-only" accept="image/*"
                        multiple>
                    <label for="gallery" class="btn btn-outline-secondary cursor-pointer">
                        <i class="fas fa-images mr-2"></i> Add Gallery Images
                    </label>
                    <p class="mt-1 text-sm text-gray-500">Up to 10 images. JPG, PNG or GIF. Max 2MB each.</p>
                    @error('gallery.*')
                        <span class="text-red-500 text-sm block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-3 pt-5 border-t border-gray-200">
                <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    {{ $projectId ? 'Update Project' : 'Create Project' }}
                </button>
            </div>
        </form>
    </div>
</div>
