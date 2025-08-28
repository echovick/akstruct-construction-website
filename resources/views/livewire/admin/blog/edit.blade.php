<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Str;

new #[Layout('layout.admin')] class extends Component {
    use WithFileUploads;

    // Basic Info
    public $post;
    public $title;
    public $slug;
    public $content;
    public $excerpt;
    public $category_id;
    public $categories;

    // Media
    public $featured_image;
    public $existing_featured_image;

    // Meta
    public $meta_title;
    public $meta_description;

    // Settings
    public $published;

    public function mount($id)
    {
        $this->post = Blog::findOrFail($id);
        $this->title = $this->post->title;
        $this->slug = $this->post->slug;
        $this->content = $this->post->content;
        $this->excerpt = $this->post->excerpt;
        $this->category_id = $this->post->category_id;
        $this->meta_title = $this->post->meta_title;
        $this->meta_description = $this->post->meta_description;
        $this->published = $this->post->published;
        $this->existing_featured_image = $this->post->featured_image;

        $this->categories = Category::where('type', 'blog')->get();
    }

    public function updatedTitle()
    {
        if ($this->slug === $this->post->slug) {
            $this->slug = Str::slug($this->title);
        }
    }

    public function save()
    {
        $validatedData = $this->validate([
            'title' => 'required|min:3',
            'slug' => 'required|unique:blog_posts,slug,' . $this->post->id,
            'content' => 'required',
            'excerpt' => 'required|max:300',
            'category_id' => 'required|exists:categories,id',
            'featured_image' => 'nullable|image|max:2048',
            'meta_title' => 'nullable|max:60',
            'meta_description' => 'nullable|max:160',
        ]);

        $this->post->title = $this->title;
        $this->post->slug = $this->slug;
        $this->post->content = $this->content;
        $this->post->excerpt = $this->excerpt;
        $this->post->category_id = $this->category_id;
        $this->post->meta_title = $this->meta_title;
        $this->post->meta_description = $this->meta_description;
        $this->post->published = $this->published;
        $this->post->published_at = $this->published ? $this->post->published_at ?? now() : null;

        if ($this->featured_image) {
            // Delete old image if exists
            if ($this->existing_featured_image) {
                Storage::disk('public')->delete($this->existing_featured_image);
            }
            $this->post->featured_image = $this->featured_image->store('blog', 'public');
        }

        $this->post->save();

        session()->flash('message', 'Blog post updated successfully.');
        return redirect()->route('admin.blog.overview');
    }
}; ?>

<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-semibold text-gray-800">Edit Blog Post</h2>
        <div class="flex space-x-4">
            <button wire:click="save"
                class="inline-flex items-center px-4 py-2 bg-primary-dark text-white rounded-md hover:bg-primary-darker transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Save Changes
            </button>
            <a href="{{ route('admin.blog.overview') }}"
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
                    <label for="excerpt" class="block text-sm font-medium text-gray-700">Excerpt</label>
                    <textarea wire:model="excerpt" id="excerpt" rows="3"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm"
                        placeholder="Brief summary of the post..."></textarea>
                    @error('excerpt')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <textarea wire:model="content" id="content" rows="20"
                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm"></textarea>
                    </div>
                    @error('content')
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
                        <div class="mt-2 mb-4">
                            <img src="{{ Storage::url($existing_featured_image) }}" alt="Current featured image"
                                class="h-32 w-auto object-cover rounded-lg">
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
                                    <span>Upload a new image</span>
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
                    <p>Author: {{ $post->author->name ?? 'Unknown' }}</p>
                    <p>Created: {{ $post->created_at->format('M d, Y H:i') }}</p>
                    @if ($post->published_at)
                        <p>Published: {{ $post->published_at->format('M d, Y H:i') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </form>
</div>
