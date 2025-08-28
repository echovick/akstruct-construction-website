<div class="p-6">
    <div class="mb-8">
        <h1 class="text-2xl font-semibold text-gray-900">Edit Page</h1>
        <p class="mt-2 text-sm text-gray-700">Update this page with structured content blocks.</p>
    </div>

    <form wire:submit="save" class="space-y-8">
        <!-- Basic Page Information -->
        <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Page Information</h3>
                    <p class="mt-1 text-sm text-gray-500">Basic information about your page.</p>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Page Name</label>
                            <input type="text" wire:model="name" id="name"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-6">
                            <label for="title" class="block text-sm font-medium text-gray-700">Page Title</label>
                            <input type="text" wire:model="title" id="title"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            @error('title')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-6">
                            <label for="description" class="block text-sm font-medium text-gray-700">Meta
                                Description</label>
                            <textarea wire:model="description" id="description" rows="3"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md"></textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="template" class="block text-sm font-medium text-gray-700">Template</label>
                            <select wire:model="template" id="template"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="default">Default</option>
                                <option value="landing">Landing Page</option>
                                <option value="blog">Blog Layout</option>
                            </select>
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="sort_order" class="block text-sm font-medium text-gray-700">Sort Order</label>
                            <input type="number" wire:model="sort_order" id="sort_order"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div class="col-span-6">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input wire:model="is_published" id="is_published" type="checkbox"
                                        class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="is_published" class="font-medium text-gray-700">Published</label>
                                    <p class="text-gray-500">Make this page visible on the website.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Builder -->
        <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Page Content</h3>
                    <p class="mt-1 text-sm text-gray-500">Build your page using content blocks.</p>

                    <div class="mt-4">
                        <p class="text-sm font-medium text-gray-700 mb-2">Add Content Block:</p>
                        <div class="space-y-2">
                            <button type="button" wire:click="addContentBlock('hero')"
                                class="w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md border">+
                                Hero Section</button>
                            <button type="button" wire:click="addContentBlock('text')"
                                class="w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md border">+
                                Text Block</button>
                            <button type="button" wire:click="addContentBlock('image')"
                                class="w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md border">+
                                Image</button>
                            <button type="button" wire:click="addContentBlock('cta')"
                                class="w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md border">+
                                Call to Action</button>
                            <button type="button" wire:click="addContentBlock('features')"
                                class="w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md border">+
                                Features</button>
                        </div>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="space-y-4">
                        @foreach ($contentBlocks as $index => $block)
                            <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                                <div class="flex justify-between items-center mb-4">
                                    <h4 class="text-sm font-medium text-gray-900 capitalize">{{ $block['type'] }} Block
                                    </h4>
                                    <div class="flex space-x-2">
                                        @if ($index > 0)
                                            <button type="button" wire:click="moveBlockUp({{ $index }})"
                                                class="text-gray-400 hover:text-gray-600">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        @endif
                                        @if ($index < count($contentBlocks) - 1)
                                            <button type="button" wire:click="moveBlockDown({{ $index }})"
                                                class="text-gray-400 hover:text-gray-600">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        @endif
                                        <button type="button" wire:click="removeContentBlock({{ $index }})"
                                            class="text-red-400 hover:text-red-600">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                @if ($block['type'] === 'hero')
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Title</label>
                                            <input type="text"
                                                wire:model="contentBlocks.{{ $index }}.data.title"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Subtitle</label>
                                            <input type="text"
                                                wire:model="contentBlocks.{{ $index }}.data.subtitle"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm">
                                        </div>
                                        <div class="col-span-2">
                                            <label class="block text-sm font-medium text-gray-700">Description</label>
                                            <textarea wire:model="contentBlocks.{{ $index }}.data.description" rows="3"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm"></textarea>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Button Text</label>
                                            <input type="text"
                                                wire:model="contentBlocks.{{ $index }}.data.button_text"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Button URL</label>
                                            <input type="text"
                                                wire:model="contentBlocks.{{ $index }}.data.button_url"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm">
                                        </div>
                                    </div>
                                @elseif ($block['type'] === 'text')
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Content</label>
                                        <textarea wire:model="contentBlocks.{{ $index }}.data.content" rows="4"
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm"></textarea>
                                    </div>
                                @elseif ($block['type'] === 'image')
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Image URL</label>
                                            <input type="text"
                                                wire:model="contentBlocks.{{ $index }}.data.src"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Alt Text</label>
                                            <input type="text"
                                                wire:model="contentBlocks.{{ $index }}.data.alt"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm">
                                        </div>
                                        <div class="col-span-2">
                                            <label class="block text-sm font-medium text-gray-700">Caption</label>
                                            <input type="text"
                                                wire:model="contentBlocks.{{ $index }}.data.caption"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm">
                                        </div>
                                    </div>
                                @elseif ($block['type'] === 'cta')
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Title</label>
                                            <input type="text"
                                                wire:model="contentBlocks.{{ $index }}.data.title"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Button Text</label>
                                            <input type="text"
                                                wire:model="contentBlocks.{{ $index }}.data.button_text"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm">
                                        </div>
                                        <div class="col-span-2">
                                            <label class="block text-sm font-medium text-gray-700">Description</label>
                                            <textarea wire:model="contentBlocks.{{ $index }}.data.description" rows="2"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm"></textarea>
                                        </div>
                                        <div class="col-span-2">
                                            <label class="block text-sm font-medium text-gray-700">Button URL</label>
                                            <input type="text"
                                                wire:model="contentBlocks.{{ $index }}.data.button_url"
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.pages.overview') }}"
                class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Cancel
            </a>
            <button type="submit"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Update Page
            </button>
        </div>
    </form>
</div>
