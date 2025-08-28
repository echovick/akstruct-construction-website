<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Support\Str;

new #[Layout('layout.admin')] class extends Component {
    use WithFileUploads;

    // Basic Info
    public $service;
    public $title;
    public $slug;
    public $icon;
    public $short_description;
    public $detailed_description;
    public $category_id;
    public $categories;

    // Media
    public $featured_image;
    public $existing_featured_image;

    // Features
    public $features = [];

    // Meta
    public $meta_title;
    public $meta_description;

    // Settings
    public $published;

    public function mount($id)
    {
        $this->service = Service::with('features')->findOrFail($id);
        $this->categories = Category::where('type', 'service')->get();

        // Load basic info
        $this->title = $this->service->title;
        $this->slug = $this->service->slug;
        $this->icon = $this->service->icon;
        $this->short_description = $this->service->short_description;
        $this->detailed_description = $this->service->detailed_description;
        $this->category_id = $this->service->category_id;

        // Load media
        $this->existing_featured_image = $this->service->featured_image;

        // Load features
        $this->features = $this->service->features
            ->map(function ($feature) {
                return [
                    'id' => $feature->id,
                    'title' => $feature->title,
                    'description' => $feature->description,
                    'icon' => $feature->icon,
                ];
            })
            ->toArray();

        // Load meta
        $this->meta_title = $this->service->meta_title;
        $this->meta_description = $this->service->meta_description;

        // Load settings
        $this->published = $this->service->published;
    }

    public function updatedTitle()
    {
        if ($this->slug === $this->service->slug) {
            $this->slug = Str::slug($this->title);
        }
    }

    public function addFeature()
    {
        $this->features[] = ['title' => '', 'description' => '', 'icon' => ''];
    }

    public function removeFeature($index)
    {
        unset($this->features[$index]);
        $this->features = array_values($this->features);
    }

    public function save()
    {
        $validatedData = $this->validate([
            'title' => 'required|min:3',
            'slug' => 'required|unique:services,slug,' . $this->service->id,
            'icon' => 'required',
            'short_description' => 'required',
            'detailed_description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'featured_image' => 'nullable|image|max:2048',
            'features' => 'array|min:1',
            'features.*.title' => 'required|min:3',
            'features.*.description' => 'required',
            'features.*.icon' => 'required',
            'meta_title' => 'nullable|max:60',
            'meta_description' => 'nullable|max:160',
        ]);

        $this->service->title = $this->title;
        $this->service->slug = $this->slug;
        $this->service->icon = $this->icon;
        $this->service->short_description = $this->short_description;
        $this->service->detailed_description = $this->detailed_description;
        $this->service->category_id = $this->category_id;
        $this->service->meta_title = $this->meta_title;
        $this->service->meta_description = $this->meta_description;
        $this->service->published = $this->published;
        $this->service->updated_by = auth()->id();

        if ($this->featured_image) {
            $this->service->featured_image = $this->featured_image->store('services', 'public');
        }

        $this->service->save();

        // Update features
        $this->service->features()->delete();
        foreach ($this->features as $feature) {
            $this->service->features()->create([
                'title' => $feature['title'],
                'description' => $feature['description'],
                'icon' => $feature['icon'],
            ]);
        }

        session()->flash('message', 'Service updated successfully.');
        return redirect()->route('admin.services.overview');
    }
}; ?>

<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-semibold text-gray-800">Edit Service: {{ $title }}</h2>
        <div class="flex space-x-4">
            <button wire:click="save"
                class="inline-flex items-center px-4 py-2 bg-primary-dark text-white rounded-md hover:bg-primary-darker transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Save Changes
            </button>
            <a href="{{ route('admin.services.overview') }}"
                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                Cancel
            </a>
        </div>
    </div>

    <form wire:submit="save" class="space-y-6">
        <!-- Basic Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
            <div class="space-y-6">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" wire:model="title" id="title"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm">
                        @error('title')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                        <input type="text" wire:model="slug" id="slug"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm">
                        @error('slug')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
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

                <div>
                    <label for="icon" class="block text-sm font-medium text-gray-700">Icon Class</label>
                    <input type="text" wire:model="icon" id="icon"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm"
                        placeholder="fas fa-wrench">
                    @error('icon')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="short_description" class="block text-sm font-medium text-gray-700">Short
                        Description</label>
                    <textarea wire:model="short_description" id="short_description" rows="3"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm"></textarea>
                    @error('short_description')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="detailed_description" class="block text-sm font-medium text-gray-700">Detailed
                        Description</label>
                    <textarea wire:model="detailed_description" id="detailed_description" rows="6"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm"></textarea>
                    @error('detailed_description')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Media -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Media</h3>
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Featured Image</label>
                    @if ($existing_featured_image)
                        <div class="mt-2">
                            <img src="{{ Storage::url($existing_featured_image) }}" alt="Featured Image"
                                class="h-32 w-32 object-cover rounded-lg">
                        </div>
                    @endif
                    <div
                        class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                viewBox="0 0 48 48" aria-hidden="true">
                                <path
                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="featured_image"
                                    class="relative cursor-pointer bg-white rounded-md font-medium text-primary-dark hover:text-primary-darker focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary-dark">
                                    <span>Upload a file</span>
                                    <input wire:model="featured_image" id="featured_image" type="file"
                                        class="sr-only">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                        </div>
                    </div>
                    @error('featured_image')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Service Features -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">Service Features</h3>
                <button type="button" wire:click="addFeature"
                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-white bg-primary-dark hover:bg-primary-darker focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-dark">
                    Add Feature
                </button>
            </div>

            <div class="space-y-4">
                @foreach ($features as $index => $feature)
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex justify-between items-start mb-4">
                            <h4 class="text-sm font-medium text-gray-900">Feature {{ $index + 1 }}</h4>
                            <button type="button" wire:click="removeFeature({{ $index }})"
                                class="text-red-600 hover:text-red-900">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>

                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Title</label>
                                <input type="text" wire:model="features.{{ $index }}.title"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm">
                                @error("features.{$index}.title")
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Icon Class</label>
                                <input type="text" wire:model="features.{{ $index }}.icon"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm"
                                    placeholder="fas fa-check">
                                @error("features.{$index}.icon")
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea wire:model="features.{{ $index }}.description" rows="3"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm"></textarea>
                                @error("features.{$index}.description")
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endforeach
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
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <button type="button" wire:click="$toggle('published')"
                        class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-dark {{ $published ? 'bg-primary-dark' : 'bg-gray-200' }}"
                        role="switch" aria-checked="{{ $published ? 'true' : 'false' }}">
                        <span aria-hidden="true"
                            class="pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200 {{ $published ? 'translate-x-5' : 'translate-x-0' }}"></span>
                    </button>
                    <span class="ml-3">
                        <span class="text-sm font-medium text-gray-900">Published</span>
                        <span class="text-sm text-gray-500">
                            {{ $published ? '- Visible to the public' : '- Draft' }}
                        </span>
                    </span>
                </div>

                <div class="text-sm text-gray-500">
                    <p>Created by: {{ $service->creator->name ?? 'Unknown' }}</p>
                    <p>Last updated: {{ $service->updated_at->format('M d, Y H:i') }}</p>
                </div>
            </div>
        </div>
    </form>
</div>
