<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Category;
use Illuminate\Support\Str;

new #[Layout('layout.admin')] class extends Component {
    public $categories;
    public $name = '';
    public $description = '';
    public $editingCategoryId = null;
    public $editingName = '';
    public $editingDescription = '';

    public function mount()
    {
        $this->loadCategories();
    }

    public function loadCategories()
    {
        $this->categories = Category::where('type', 'blog')->orderBy('name')->get();
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|min:3|unique:categories,name,NULL,id,type,blog',
            'description' => 'nullable|max:500',
        ]);

        Category::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
            'type' => 'blog',
        ]);

        $this->reset(['name', 'description']);
        $this->loadCategories();
        session()->flash('message', 'Category created successfully.');
    }

    public function startEditing($categoryId)
    {
        $category = Category::find($categoryId);
        $this->editingCategoryId = $categoryId;
        $this->editingName = $category->name;
        $this->editingDescription = $category->description;
    }

    public function cancelEditing()
    {
        $this->reset(['editingCategoryId', 'editingName', 'editingDescription']);
    }

    public function updateCategory()
    {
        $this->validate([
            'editingName' => 'required|min:3|unique:categories,name,' . $this->editingCategoryId . ',id,type,blog',
            'editingDescription' => 'nullable|max:500',
        ]);

        $category = Category::find($this->editingCategoryId);
        $category->update([
            'name' => $this->editingName,
            'slug' => Str::slug($this->editingName),
            'description' => $this->editingDescription,
        ]);

        $this->reset(['editingCategoryId', 'editingName', 'editingDescription']);
        $this->loadCategories();
        session()->flash('message', 'Category updated successfully.');
    }

    public function deleteCategory($categoryId)
    {
        $category = Category::find($categoryId);

        // Check if category has any blog posts
        if ($category->blogPosts()->count() > 0) {
            session()->flash('error', 'Cannot delete category. It has associated blog posts.');
            return;
        }

        $category->delete();
        $this->loadCategories();
        session()->flash('message', 'Category deleted successfully.');
    }
}; ?>

<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-semibold text-gray-800">Blog Categories</h2>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Add New Category Form -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Add New Category</h3>
        <form wire:submit="save" class="space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" wire:model="name" id="name"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm">
                @error('name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea wire:model="description" id="description" rows="3"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm"></textarea>
                @error('description')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-primary-dark text-white rounded-md hover:bg-primary-darker transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Category
                </button>
            </div>
        </form>
    </div>

    <!-- Categories List -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Description</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Posts
                        Count</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($categories as $category)
                    <tr>
                        <td class="px-6 py-4">
                            @if ($editingCategoryId === $category->id)
                                <input type="text" wire:model="editingName"
                                    class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm">
                                @error('editingName')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            @else
                                <div class="text-sm font-medium text-gray-900">{{ $category->name }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-500">{{ $category->slug }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @if ($editingCategoryId === $category->id)
                                <textarea wire:model="editingDescription" rows="2"
                                    class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm"></textarea>
                                @error('editingDescription')
                                    <span class="text-red-600 text-sm">{{ $message }}</span>
                                @enderror
                            @else
                                <div class="text-sm text-gray-500">{{ $category->description }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-500">{{ $category->blogPosts()->count() }}</div>
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium">
                            <div class="flex space-x-3">
                                @if ($editingCategoryId === $category->id)
                                    <button wire:click="updateCategory"
                                        class="text-primary-dark hover:text-primary-darker">Save</button>
                                    <button wire:click="cancelEditing"
                                        class="text-gray-600 hover:text-gray-900">Cancel</button>
                                @else
                                    <button wire:click="startEditing({{ $category->id }})"
                                        class="text-primary-dark hover:text-primary-darker">Edit</button>
                                    <button wire:click="deleteCategory({{ $category->id }})"
                                        wire:confirm="Are you sure you want to delete this category?"
                                        class="text-red-600 hover:text-red-900">Delete</button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
