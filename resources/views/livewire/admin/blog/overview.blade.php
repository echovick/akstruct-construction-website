<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\Blog;
use App\Models\Category;

new #[Layout('layout.admin')] class extends Component {
    use WithPagination;

    public $search = '';
    public $categories;
    public $categoryFilter = '';
    public $authorFilter = '';

    public function mount()
    {
        $this->categories = Category::where('type', 'blog')->get();
    }

    public function getBlogPosts()
    {
        return Blog::query()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')->orWhere('excerpt', 'like', '%' . $this->search . '%');
            })
            ->when($this->categoryFilter, function ($query) {
                $query->where('category_id', $this->categoryFilter);
            })
            ->when($this->authorFilter, function ($query) {
                $query->where('author_id', $this->authorFilter);
            })
            ->with(['author', 'category'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function togglePublished($postId)
    {
        $post = Blog::find($postId);
        $post->published = !$post->published;
        $post->published_at = $post->published ? now() : null;
        $post->save();
    }

    public function deletePost($postId)
    {
        Blog::find($postId)->delete();
        session()->flash('message', 'Blog post deleted successfully.');
    }

    public function updating($field)
    {
        if (in_array($field, ['search', 'categoryFilter', 'authorFilter'])) {
            $this->resetPage();
        }
    }
}; ?>

<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-semibold text-gray-800">Blog Posts</h2>
        <a href="{{ route('admin.blog.create') }}"
            class="inline-flex items-center px-4 py-2 bg-primary-dark text-white rounded-md hover:bg-primary-darker transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add New Post
        </a>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Search -->
            <div class="md:col-span-1">
                <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" wire:model.live="search" id="search"
                        class="pl-10 focus:ring-primary-dark focus:border-primary-dark block w-full sm:text-sm border-gray-300 rounded-md"
                        placeholder="Search posts...">
                </div>
            </div>

            <!-- Category Filter -->
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                <select wire:model.live="categoryFilter" id="category"
                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-dark focus:border-primary-dark sm:text-sm rounded-md">
                    <option value="">All Categories</option>
                    {{-- @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach --}}
                </select>
            </div>

            <!-- Author Filter -->
            <div>
                <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
                <select wire:model.live="authorFilter" id="author"
                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-dark focus:border-primary-dark sm:text-sm rounded-md">
                    <option value="">All Authors</option>
                    @foreach (\App\Models\User::whereHas('blogPosts')->get() as $author)
                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Blog Posts Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Category</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Author</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Published</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($this->getBlogPosts() as $post)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $post->title }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($post->excerpt, 100) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $post->category?->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $post->author?->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button wire:click="togglePublished({{ $post->id }})"
                                    class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-dark {{ $post->published ? 'bg-primary-dark' : 'bg-gray-200' }}"
                                    role="switch" aria-checked="{{ $post->published ? 'true' : 'false' }}">
                                    <span aria-hidden="true"
                                        class="pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200 {{ $post->published ? 'translate-x-5' : 'translate-x-0' }}"></span>
                                </button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">
                                    {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Draft' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex space-x-3">
                                    <a href="{{ route('admin.blog.overview.edit', $post->id) }}"
                                        class="text-primary-dark hover:text-primary-darker">Edit</a>
                                    <button wire:click="deletePost({{ $post->id }})"
                                        wire:confirm="Are you sure you want to delete this post?"
                                        class="text-red-600 hover:text-red-900">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $this->getBlogPosts()->links() }}
        </div>
    </div>
</div>
