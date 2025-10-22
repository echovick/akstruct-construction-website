<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Category;
use Illuminate\Support\Str;

new #[Layout('layout.admin')] class extends Component {
    public $categories;
    public $showModal = false;
    public $editingCategory = null;

    // Form fields
    public $name = '';
    public $slug = '';
    public $description = '';
    public $parent_id = '';

    public function mount()
    {
        $this->loadCategories();
    }

    public function loadCategories()
    {
        $this->categories = Category::where('type', 'project')
            ->with(['parent', 'projects'])
            ->withCount('projects')
            ->orderBy('name')
            ->get();
    }

    public function createCategory()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function editCategory($categoryId)
    {
        $this->editingCategory = Category::find($categoryId);
        $this->name = $this->editingCategory->name;
        $this->slug = $this->editingCategory->slug;
        $this->description = $this->editingCategory->description ?? '';
        $this->parent_id = $this->editingCategory->parent_id ?? '';
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|min:2|max:255',
            'slug' => $this->editingCategory ? 'required|unique:categories,slug,' . $this->editingCategory->id . '|max:255' : 'required|unique:categories,slug|max:255',
            'description' => 'nullable|max:500',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        if ($this->editingCategory) {
            $this->editingCategory->update([
                'name' => $this->name,
                'slug' => $this->slug,
                'description' => $this->description,
                'parent_id' => $this->parent_id ?: null,
            ]);
            session()->flash('message', 'Category updated successfully.');
        } else {
            Category::create([
                'name' => $this->name,
                'slug' => $this->slug,
                'description' => $this->description,
                'parent_id' => $this->parent_id ?: null,
                'type' => 'project',
            ]);
            session()->flash('message', 'Category created successfully.');
        }

        $this->loadCategories();
        $this->closeModal();
    }

    public function deleteCategory($categoryId)
    {
        $category = Category::find($categoryId);

        // Check if category has children
        if ($category->children()->exists()) {
            session()->flash('error', 'Cannot delete category with subcategories. Please delete or reassign the subcategories first.');
            return;
        }

        // Check if category has projects
        if ($category->projects()->exists()) {
            session()->flash('error', 'Cannot delete category with ' . $category->projects()->count() . ' associated project(s). Please reassign the projects first.');
            return;
        }

        $category->delete();
        session()->flash('message', 'Category deleted successfully.');
        $this->loadCategories();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->editingCategory = null;
        $this->name = '';
        $this->slug = '';
        $this->description = '';
        $this->parent_id = '';
    }

    public function updatedName()
    {
        $this->slug = Str::slug($this->name);
    }
}; ?>

<div class="w-full max-w-full space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-semibold text-gray-800">Project Categories</h2>
            <p class="mt-1 text-sm text-gray-600">Organize your projects into categories</p>
        </div>
        <button wire:click="createCategory"
            class="inline-flex items-center px-4 py-2 bg-primary-dark text-white rounded-md hover:bg-primary-darker transition-colors shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add Category
        </button>
    </div>

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

    <!-- Statistics Card -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
            <div class="flex items-center">
                <div class="bg-purple-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Categories</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $categories->count() }}</h3>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
            <div class="flex items-center">
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Projects</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $categories->sum('projects_count') }}</h3>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-200">
            <div class="flex items-center">
                <div class="bg-green-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Parent Categories</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $categories->whereNull('parent_id')->count() }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Grid -->
    @if ($categories->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($categories as $category)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
                    <div class="p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $category->name }}</h3>
                                @if ($category->parent)
                                    <p class="text-xs text-gray-500 mt-1">
                                        <span class="inline-flex items-center">
                                            <svg class="h-3 w-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                            </svg>
                                            Subcategory of {{ $category->parent->name }}
                                        </span>
                                    </p>
                                @endif
                            </div>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $category->projects_count }} {{ Str::plural('project', $category->projects_count) }}
                            </span>
                        </div>

                        @if ($category->description)
                            <p class="mt-3 text-sm text-gray-600">{{ Str::limit($category->description, 100) }}</p>
                        @endif

                        <div class="mt-4 pt-4 border-t border-gray-200 flex items-center justify-between">
                            <code
                                class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">{{ $category->slug }}</code>
                            <div class="flex space-x-2">
                                <button wire:click="editCategory({{ $category->id }})"
                                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-dark">
                                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </button>
                                <button wire:click="deleteCategory({{ $category->id }})"
                                    wire:confirm="Are you sure you want to delete this category?"
                                    class="inline-flex items-center px-3 py-1.5 border border-transparent shadow-sm text-xs font-medium rounded text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No categories yet</h3>
            <p class="mt-1 text-sm text-gray-500">Get started by creating your first category.</p>
            <div class="mt-6">
                <button wire:click="createCategory"
                    class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-dark hover:bg-primary-darker">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Create Category
                </button>
            </div>
        </div>
    @endif

    <!-- Modal -->
    @if ($showModal)
        <div class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
            aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"
                    wire:click="closeModal"></div>

                <!-- Center modal -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <form wire:submit.prevent="save">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="mb-4">
                                <h3 class="text-lg font-medium text-gray-900">
                                    {{ $editingCategory ? 'Edit Category' : 'Create Category' }}
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    {{ $editingCategory ? 'Update the category details below.' : 'Fill in the details for the new category.' }}
                                </p>
                            </div>

                            <div class="space-y-4">
                                <!-- Name -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                        Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" wire:model.live.debounce.300ms="name" id="name"
                                        class="block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm"
                                        placeholder="e.g., Residential, Commercial">
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Slug -->
                                <div>
                                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">
                                        Slug <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" wire:model="slug" id="slug"
                                        class="block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm bg-gray-50"
                                        readonly>
                                    <p class="mt-1 text-xs text-gray-500">Auto-generated from name</p>
                                    @error('slug')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Parent Category -->
                                <div>
                                    <label for="parent_id" class="block text-sm font-medium text-gray-700 mb-1">
                                        Parent Category
                                    </label>
                                    <select wire:model="parent_id" id="parent_id"
                                        class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-dark focus:border-primary-dark sm:text-sm rounded-md">
                                        <option value="">None (Top Level)</option>
                                        @foreach ($categories as $category)
                                            @if (!$editingCategory || $category->id !== $editingCategory->id)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <p class="mt-1 text-xs text-gray-500">Optional: Make this a subcategory</p>
                                    @error('parent_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                                        Description
                                    </label>
                                    <textarea wire:model="description" id="description" rows="3"
                                        class="block w-full px-3 py-2 border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm"
                                        placeholder="Brief description of this category"></textarea>
                                    <p class="mt-1 text-xs text-gray-500">{{ strlen($description) }}/500 characters
                                    </p>
                                    @error('description')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Modal Actions -->
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" wire:loading.attr="disabled"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary-dark text-base font-medium text-white hover:bg-primary-darker focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-dark sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50">
                                <span wire:loading.remove wire:target="save">
                                    {{ $editingCategory ? 'Update Category' : 'Create Category' }}
                                </span>
                                <span wire:loading wire:target="save">
                                    Saving...
                                </span>
                            </button>
                            <button type="button" wire:click="closeModal"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-dark sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
