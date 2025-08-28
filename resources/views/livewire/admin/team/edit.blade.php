<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use App\Models\TeamMember;

new #[Layout('layout.admin')] class extends Component {
    use WithFileUploads;

    // Model
    public $member;

    // Basic Info
    public $name;
    public $position;
    public $department;
    public $bio;

    // Contact Info
    public $email;
    public $phone;

    // Media
    public $image;
    public $existing_image;

    // Social Links
    public $linkedin;
    public $twitter;
    public $facebook;
    public $instagram;

    // Settings
    public $published;

    public function mount($id)
    {
        $this->member = TeamMember::findOrFail($id);
        $this->name = $this->member->name;
        $this->position = $this->member->position;
        $this->department = $this->member->department;
        $this->bio = $this->member->bio;
        $this->email = $this->member->email;
        $this->phone = $this->member->phone;
        $this->published = $this->member->published;
        $this->existing_image = $this->member->image;

        // Parse social links from JSON
        $socialLinks = json_decode($this->member->social_links, true) ?? [];
        $this->linkedin = $socialLinks['linkedin'] ?? '';
        $this->twitter = $socialLinks['twitter'] ?? '';
        $this->facebook = $socialLinks['facebook'] ?? '';
        $this->instagram = $socialLinks['instagram'] ?? '';
    }

    public function save()
    {
        $validatedData = $this->validate([
            'name' => 'required|min:2',
            'position' => 'required',
            'department' => 'required',
            'bio' => 'nullable',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'image' => 'nullable|image|max:2048',
            'linkedin' => 'nullable|url',
            'twitter' => 'nullable|url',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
        ]);

        $this->member->name = $this->name;
        $this->member->position = $this->position;
        $this->member->department = $this->department;
        $this->member->bio = $this->bio;
        $this->member->email = $this->email;
        $this->member->phone = $this->phone;
        $this->member->published = $this->published;

        // Handle social links
        $socialLinks = array_filter([
            'linkedin' => $this->linkedin,
            'twitter' => $this->twitter,
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
        ]);
        $this->member->social_links = !empty($socialLinks) ? json_encode($socialLinks) : null;

        // Handle image upload
        if ($this->image) {
            // Delete old image if exists
            if ($this->existing_image) {
                Storage::disk('public')->delete($this->existing_image);
            }
            $this->member->image = $this->image->store('team', 'public');
        }

        $this->member->save();

        session()->flash('message', 'Team member updated successfully.');
        return redirect()->route('admin.team.overview');
    }
}; ?>

<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-semibold text-gray-800">Edit Team Member</h2>
        <div class="flex space-x-4">
            <button wire:click="save"
                class="inline-flex items-center px-4 py-2 bg-primary-dark text-white rounded-md hover:bg-primary-darker transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Save Changes
            </button>
            <a href="{{ route('admin.team.overview') }}"
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
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" wire:model="name" id="name"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm">
                        @error('name')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
                        <input type="text" wire:model="position" id="position"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm">
                        @error('position')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="department" class="block text-sm font-medium text-gray-700">Department</label>
                    <input type="text" wire:model="department" id="department"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm">
                    @error('department')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
                    <textarea wire:model="bio" id="bio" rows="4"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm"
                        placeholder="Brief biography..."></textarea>
                    @error('bio')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Contact Information</h3>
            <div class="space-y-6">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" wire:model="email" id="email"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm">
                        @error('email')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                        <input type="tel" wire:model="phone" id="phone"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-dark focus:border-primary-dark sm:text-sm">
                        @error('phone')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Image -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Profile Image</h3>
            <div>
                @if ($existing_image)
                    <div class="mb-4">
                        <img src="{{ Storage::url($existing_image) }}" alt="Current profile image"
                            class="h-32 w-32 object-cover rounded-lg">
                    </div>
                @endif
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                            viewBox="0 0 48 48" aria-hidden="true">
                            <path
                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="image"
                                class="relative cursor-pointer bg-white rounded-md font-medium text-primary-dark hover:text-primary-darker focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary-dark">
                                <span>Upload a new image</span>
                                <input wire:model="image" id="image" type="file" class="sr-only">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                    </div>
                </div>
                @error('image')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Social Links -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Social Media Links</h3>
            <div class="space-y-6">
                <div>
                    <label for="linkedin" class="block text-sm font-medium text-gray-700">LinkedIn</label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <span
                            class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                            https://
                        </span>
                        <input type="text" wire:model="linkedin" id="linkedin"
                            class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-primary-dark focus:border-primary-dark sm:text-sm border-gray-300"
                            placeholder="linkedin.com/in/username">
                    </div>
                    @error('linkedin')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="twitter" class="block text-sm font-medium text-gray-700">Twitter</label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <span
                            class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                            https://
                        </span>
                        <input type="text" wire:model="twitter" id="twitter"
                            class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-primary-dark focus:border-primary-dark sm:text-sm border-gray-300"
                            placeholder="twitter.com/username">
                    </div>
                    @error('twitter')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="facebook" class="block text-sm font-medium text-gray-700">Facebook</label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <span
                            class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                            https://
                        </span>
                        <input type="text" wire:model="facebook" id="facebook"
                            class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-primary-dark focus:border-primary-dark sm:text-sm border-gray-300"
                            placeholder="facebook.com/username">
                    </div>
                    @error('facebook')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="instagram" class="block text-sm font-medium text-gray-700">Instagram</label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <span
                            class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                            https://
                        </span>
                        <input type="text" wire:model="instagram" id="instagram"
                            class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-primary-dark focus:border-primary-dark sm:text-sm border-gray-300"
                            placeholder="instagram.com/username">
                    </div>
                    @error('instagram')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Publish Settings -->
        <div class="bg-white rounded-lg shadow p-6">
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
                        {{ $published ? '- Visible on the website' : '- Hidden from the website' }}
                    </span>
                </span>
            </div>
        </div>
    </form>
</div>
