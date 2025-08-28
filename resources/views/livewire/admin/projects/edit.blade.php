<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Support\Str;

new #[Layout('layout.admin')] class extends Component {
    use WithFileUploads;

    // Basic Info
    public $project;
    public $title;
    public $slug;
    public $client;
    public $location;
    public $completion_date;
    public $project_value;
    public $category_id;

    // Media
    public $featured_image;
    public $gallery = [];
    public $gallery_order = [];
    public $existing_gallery = [];

    // Content
    public $description;
    public $challenge;
    public $solution;

    // Meta
    public $meta_title;
    public $meta_description;

    // Settings
    public $status;
    public $published;

    public $statuses = [
        'planning' => 'Planning',
        'in_progress' => 'In Progress',
        'completed' => 'Completed',
        'on_hold' => 'On Hold',
    ];

    public function mount($id)
    {
        $this->project = Project::findOrFail($id);
        $this->categories = Category::where('type', 'project')->get();

        // Load project data
        $this->title = $this->project->title;
        $this->slug = $this->project->slug;
        $this->client = $this->project->client;
        $this->location = $this->project->location;
        $this->completion_date = $this->project->completion_date;
        $this->project_value = $this->project->project_value;
        $this->category_id = $this->project->category_id;
        $this->description = $this->project->description;
        $this->challenge = $this->project->challenge;
        $this->solution = $this->project->solution;
        $this->meta_title = $this->project->meta_title;
        $this->meta_description = $this->project->meta_description;
        $this->status = $this->project->status;
        $this->published = $this->project->published;

        // Load existing gallery
        $this->existing_gallery = $this->project->images()->orderBy('sort_order')->get();
    }

    public function updatedTitle()
    {
        $this->slug = Str::slug($this->title);
    }

    public function updatedGallery()
    {
        foreach ($this->gallery as $photo) {
            $photo->store('gallery', 'public');
        }
    }

    public function removeGalleryImage($index, $type = 'new')
    {
        if ($type === 'new') {
            unset($this->gallery[$index]);
            $this->gallery = array_values($this->gallery);
        } else {
            $image = $this->existing_gallery[$index];
            $image->delete();
            unset($this->existing_gallery[$index]);
            $this->existing_gallery = array_values($this->existing_gallery->toArray());
        }
    }

    public function reorderGallery($orderedIds)
    {
        foreach ($orderedIds as $index => $id) {
            $this->project
                ->images()
                ->where('id', $id)
                ->update(['sort_order' => $index]);
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|min:3',
            'slug' => 'required|unique:projects,slug,' . $this->project->id,
            'client' => 'required',
            'location' => 'required',
            'completion_date' => 'required|date',
            'project_value' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'featured_image' => $this->featured_image ? 'image|max:2048' : '',
            'description' => 'required',
            'challenge' => 'required',
            'solution' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'status' => 'required|in:' . implode(',', array_keys($this->statuses)),
            'gallery.*' => 'image|max:2048',
        ]);

        if ($this->featured_image) {
            $featured_image_path = $this->featured_image->store('projects', 'public');
            $this->project->featured_image = $featured_image_path;
        }

        $this->project->update([
            'title' => $this->title,
            'slug' => $this->slug,
            'client' => $this->client,
            'location' => $this->location,
            'completion_date' => $this->completion_date,
            'project_value' => $this->project_value,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'challenge' => $this->challenge,
            'solution' => $this->solution,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'status' => $this->status,
            'published' => $this->published,
            'updated_by' => auth()->id(),
        ]);

        // Handle new gallery images
        if (!empty($this->gallery)) {
            foreach ($this->gallery as $index => $image) {
                $path = $image->store('project-gallery/' . $this->project->id, 'public');
                $this->project->images()->create([
                    'image_path' => $path,
                    'sort_order' => count($this->existing_gallery) + $index,
                ]);
            }
        }

        session()->flash('message', 'Project updated successfully.');
        return redirect()->route('admin.projects.overview');
    }
}; ?>

<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-semibold text-gray-800">Edit Project: {{ $title }}</h2>
        <div class="flex space-x-4">
            <button wire:click="save"
                class="inline-flex items-center px-4 py-2 bg-primary-dark text-white rounded-md hover:bg-primary-darker transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Save Changes
            </button>
            <a href="{{ route('admin.projects.overview') }}"
                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                Cancel
            </a>
        </div>
    </div>

    <form wire:submit="save" class="space-y-6">
        <!-- Basic Info -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div class="col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" wire:model="title" id="title"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm">
                    @error('title')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-2">
                    <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                    <input type="text" wire:model="slug" id="slug"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm bg-gray-50"
                        readonly>
                    @error('slug')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="client" class="block text-sm font-medium text-gray-700">Client</label>
                    <input type="text" wire:model="client" id="client"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm">
                    @error('client')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                    <input type="text" wire:model="location" id="location"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm">
                    @error('location')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="completion_date" class="block text-sm font-medium text-gray-700">Completion Date</label>
                    <input type="date" wire:model="completion_date" id="completion_date"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm">
                    @error('completion_date')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="project_value" class="block text-sm font-medium text-gray-700">Project Value</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">$</span>
                        </div>
                        <input type="number" wire:model="project_value" id="project_value"
                            class="pl-7 mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm"
                            step="0.01">
                    </div>
                    @error('project_value')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                    <select wire:model="category_id" id="category"
                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-dark focus:border-primary-dark sm:text-sm rounded-md">
                        <option value="">Select a category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Media -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Media</h3>

            <div class="space-y-6">
                <!-- Featured Image -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Featured Image</label>
                    <div
                        class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                        <div class="space-y-1 text-center">
                            @if ($featured_image)
                                <img src="{{ $featured_image->temporaryUrl() }}" class="mx-auto h-32 w-auto">
                            @else
                                <img src="{{ Storage::url($project->featured_image) }}" class="mx-auto h-32 w-auto">
                            @endif
                            <div class="flex text-sm text-gray-600">
                                <label for="featured-image"
                                    class="relative cursor-pointer bg-white rounded-md font-medium text-primary-dark hover:text-primary-darker focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary-dark">
                                    <span>Change image</span>
                                    <input wire:model="featured_image" id="featured-image" type="file"
                                        class="sr-only">
                                </label>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                        </div>
                    </div>
                    @error('featured_image')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Gallery -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Project Gallery</label>

                    <!-- Existing Images -->
                    @if (count($existing_gallery) > 0)
                        <div class="mb-4">
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Existing Images</h4>
                            <div class="flex flex-wrap gap-4">
                                @foreach ($existing_gallery as $index => $image)
                                    <div class="relative">
                                        <img src="{{ Storage::url($image->image_path) }}" class="h-32 w-auto">
                                        <button type="button"
                                            wire:click="removeGalleryImage({{ $index }}, 'existing')"
                                            class="absolute top-0 right-0 -mt-2 -mr-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600">
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

                    <!-- New Images -->
                    <div
                        class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                        <div class="space-y-1 text-center">
                            <div class="flex flex-wrap gap-4 justify-center">
                                @if ($gallery)
                                    @foreach ($gallery as $index => $image)
                                        <div class="relative">
                                            <img src="{{ $image->temporaryUrl() }}" class="h-32 w-auto">
                                            <button type="button"
                                                wire:click="removeGalleryImage({{ $index }})"
                                                class="absolute top-0 right-0 -mt-2 -mr-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="flex text-sm text-gray-600">
                                <label for="gallery"
                                    class="relative cursor-pointer bg-white rounded-md font-medium text-primary-dark hover:text-primary-darker focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary-dark">
                                    <span>Add to gallery</span>
                                    <input wire:model="gallery" id="gallery" type="file" class="sr-only"
                                        multiple>
                                </label>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                        </div>
                    </div>
                    @error('gallery.*')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Content</h3>
            <div class="space-y-6">
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <div class="mt-1">
                        <textarea wire:model="description" id="description" rows="4"
                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm"></textarea>
                    </div>
                    @error('description')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="challenge" class="block text-sm font-medium text-gray-700">Challenge</label>
                    <div class="mt-1">
                        <textarea wire:model="challenge" id="challenge" rows="4"
                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm"></textarea>
                    </div>
                    @error('challenge')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="solution" class="block text-sm font-medium text-gray-700">Solution</label>
                    <div class="mt-1">
                        <textarea wire:model="solution" id="solution" rows="4"
                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm"></textarea>
                    </div>
                    @error('solution')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Meta -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">SEO Information</h3>
            <div class="space-y-6">
                <div>
                    <label for="meta_title" class="block text-sm font-medium text-gray-700">Meta Title</label>
                    <input type="text" wire:model="meta_title" id="meta_title"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm">
                    @error('meta_title')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="meta_description" class="block text-sm font-medium text-gray-700">Meta
                        Description</label>
                    <textarea wire:model="meta_description" id="meta_description" rows="3"
                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm"></textarea>
                    @error('meta_description')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Publish Settings -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Publish Settings</h3>
            <div class="space-y-6">
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select wire:model="status" id="status"
                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-dark focus:border-primary-dark sm:text-sm rounded-md">
                        @foreach ($statuses as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('status')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center">
                    <button type="button" wire:click="$toggle('published')"
                        class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-dark {{ $published ? 'bg-primary-dark' : 'bg-gray-200' }}"
                        role="switch" aria-checked="{{ $published ? 'true' : 'false' }}">
                        <span class="sr-only">Published status</span>
                        <span aria-hidden="true"
                            class="pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200 {{ $published ? 'translate-x-5' : 'translate-x-0' }}"></span>
                    </button>
                    <span class="ml-3">
                        <span class="text-sm font-medium text-gray-900">Published</span>
                    </span>
                </div>

                <div class="text-sm text-gray-500">
                    <p>Created by: {{ $project->creator->name }}</p>
                    <p>Last updated: {{ $project->updated_at->format('M d, Y H:i') }}</p>
                </div>
            </div>
        </div>
    </form>
</div>
