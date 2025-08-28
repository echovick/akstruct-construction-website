<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Category;

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
        $this->categories = Category::where('type', 'project')->with('parent')->orderBy('name')->get();
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
        $this->description = $this->editingCategory->description;
        $this->parent_id = $this->editingCategory->parent_id;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|min:2',
            'slug' => $this->editingCategory ? 'required|unique:categories,slug,' . $this->editingCategory->id : 'required|unique:categories,slug',
            'description' => 'nullable',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        if ($this->editingCategory) {
            $this->editingCategory->update([
                'name' => $this->name,
                'slug' => $this->slug,
                'description' => $this->description,
                'parent_id' => $this->parent_id ?: null,
            ]);
        } else {
            Category::create([
                'name' => $this->name,
                'slug' => $this->slug,
                'description' => $this->description,
                'parent_id' => $this->parent_id ?: null,
                'type' => 'project',
            ]);
        }

        $this->loadCategories();
        $this->closeModal();
        session()->flash('message', $this->editingCategory ? 'Category updated successfully.' : 'Category created successfully.');
    }

    public function deleteCategory($categoryId)
    {
        $category = Category::find($categoryId);

        // Check if category has children
        if ($category->children()->exists()) {
            session()->flash('error', 'Cannot delete category with subcategories.');
            return;
        }

        // Check if category has projects
        if ($category->projects()->exists()) {
            session()->flash('error', 'Cannot delete category with associated projects.');
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

<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-semibold text-gray-800">Project Categories</h2>
        <button wire:click="createCategory"
            class="inline-flex items-center px-4 py-2 bg-primary-dark text-white rounded-md hover:bg-primary-darker transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add Category
        </button>
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

    <!-- Categories Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Parent
                        Category</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Description</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($categories as $category)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $category->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{ $category->slug }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{ $category->parent ? $category->parent->name : '-' }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-500">{{ Str::limit($category->description, 50) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex space-x-3">
                                <button wire:click="editCategory({{ $category->id }})"
                                    class="text-primary-dark hover:text-primary-darker">Edit</button>
                                <button wire:click="deleteCategory({{ $category->id }})"
                                    wire:confirm="Are you sure you want to delete this category?"
                                    class="text-red-600 hover:text-red-900">Delete</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    @if ($showModal)
        <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <form wire:submit="save">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="mb-4">
                                <h3 class="text-lg font-medium text-gray-900">
                                    {{ $editingCategory ? 'Edit Category' : 'Create Category' }}</h3>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                    <input type="text" wire:model="name" id="name"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm">
                                    @error('name')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                                    <input type="text" wire:model="slug" id="slug"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm bg-gray-50"
                                        readonly>
                                    @error('slug')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="parent_id" class="block text-sm font-medium text-gray-700">Parent
                                        Category</label>
                                    <select wire:model="parent_id" id="parent_id"
                                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-dark focus:border-primary-dark sm:text-sm rounded-md">
                                        <option value="">None</option>
                                        @foreach ($categories as $category)
                                            @if (!$editingCategory || $category->id !== $editingCategory->id)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="description"
                                        class="block text-sm font-medium text-gray-700">Description</label>
                                    <textarea wire:model="description" id="description" rows="3"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm"></textarea>
                                    @error('description')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary-dark text-base font-medium text-white hover:bg-primary-darker focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-dark sm:ml-3 sm:w-auto sm:text-sm">
                                {{ $editingCategory ? 'Update' : 'Create' }}
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
