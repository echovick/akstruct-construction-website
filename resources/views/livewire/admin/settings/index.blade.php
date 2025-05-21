<?php

use App\Models\Setting;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

new #[Layout('layout.admin', ['title' => 'Settings'])] class extends Component {
    use WithFileUploads;

    // General Settings
    public $settings = [];
    public $heroImages = [];

    // Form validation messages
    public $successMessage = '';

    public function mount()
    {
        // Load settings from database
        $dbSettings = Setting::all();

        foreach ($dbSettings as $setting) {
            if ($setting->type === 'json') {
                $this->settings[$setting->key] = json_decode($setting->value, true);
            } else {
                $this->settings[$setting->key] = $setting->value;
            }
        }
    }

    public function updateGeneralSettings()
    {
        // Validate the settings
        $this->validate([
            'settings.company_name' => 'required|string|max:255',
            'settings.company_email' => 'required|email|max:255',
            'settings.company_phone' => 'required|string|max:50',
            'settings.company_address' => 'required|string|max:500',
            'settings.office_hours' => 'nullable|string|max:255',
        ]);

        // Save each setting
        foreach ($this->settings as $key => $value) {
            if (is_array($value)) {
                $value = json_encode($value);
                $type = 'json';
            } else {
                $type = 'string';
            }

            Setting::updateOrCreate(['key' => $key], ['value' => $value, 'type' => $type]);
        }

        $this->successMessage = 'Settings updated successfully!';
    }

    public function updateHeroSettings()
    {
        // Validate hero settings
        $this->validate([
            'settings.hero_title' => 'required|string|max:255',
            'settings.hero_subtitle' => 'required|string|max:500',
            'heroImages.*' => 'nullable|image|max:5120', // 5MB max
        ]);

        // Process hero carousel images if uploaded
        if (!empty($this->heroImages)) {
            $carouselImages = $this->settings['hero_carousel_images'] ?? [];

            foreach ($this->heroImages as $image) {
                $filename = 'hero-' . time() . '-' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('public/assets/img/hero', $filename);
                $carouselImages[] = 'storage/assets/img/hero/' . $filename;
            }

            $this->settings['hero_carousel_images'] = $carouselImages;
        }

        // Save hero settings
        foreach ($this->settings as $key => $value) {
            if (is_array($value)) {
                $value = json_encode($value);
                $type = 'json';
            } else {
                $type = 'string';
            }

            Setting::updateOrCreate(['key' => $key], ['value' => $value, 'type' => $type]);
        }

        $this->reset('heroImages');
        $this->successMessage = 'Hero settings updated successfully!';
    }

    public function updateStatSettings()
    {
        // Validate statistics settings
        $this->validate([
            'settings.stats_projects_completed' => 'required|numeric',
            'settings.stats_happy_clients' => 'required|numeric',
            'settings.stats_years_experience' => 'required|numeric',
        ]);

        // Save statistics settings
        foreach ($this->settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value, 'type' => 'string']);
        }

        $this->successMessage = 'Statistics updated successfully!';
    }

    public function removeHeroImage($index)
    {
        $images = $this->settings['hero_carousel_images'] ?? [];

        if (isset($images[$index])) {
            // Remove the file if it exists
            $path = str_replace('storage/', 'public/', $images[$index]);
            if (Storage::exists($path)) {
                Storage::delete($path);
            }

            // Remove from array
            unset($images[$index]);
            $this->settings['hero_carousel_images'] = array_values($images);

            // Save updated setting
            Setting::updateOrCreate(['key' => 'hero_carousel_images'], ['value' => json_encode(array_values($images)), 'type' => 'json']);

            $this->successMessage = 'Image removed successfully!';
        }
    }
}; ?>

<div>
    @if ($successMessage)
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ $successMessage }}</p>
        </div>
    @endif

    <div class="space-y-6">
        <!-- General Settings -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="p-6 bg-gray-50 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-800">General Settings</h2>
            </div>

            <div class="p-6">
                <form wire:submit="updateGeneralSettings">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">Company
                                Name</label>
                            <input type="text" id="company_name" wire:model="settings.company_name"
                                class="w-full rounded-md shadow-sm border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50">
                            @error('settings.company_name')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="company_email" class="block text-sm font-medium text-gray-700 mb-1">Company
                                Email</label>
                            <input type="email" id="company_email" wire:model="settings.company_email"
                                class="w-full rounded-md shadow-sm border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50">
                            @error('settings.company_email')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="company_phone" class="block text-sm font-medium text-gray-700 mb-1">Company
                                Phone</label>
                            <input type="text" id="company_phone" wire:model="settings.company_phone"
                                class="w-full rounded-md shadow-sm border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50">
                            @error('settings.company_phone')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="office_hours" class="block text-sm font-medium text-gray-700 mb-1">Office
                                Hours</label>
                            <input type="text" id="office_hours" wire:model="settings.office_hours"
                                class="w-full rounded-md shadow-sm border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50">
                            @error('settings.office_hours')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="company_address" class="block text-sm font-medium text-gray-700 mb-1">Company
                            Address</label>
                        <textarea id="company_address" wire:model="settings.company_address" rows="3"
                            class="w-full rounded-md shadow-sm border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50"></textarea>
                        @error('settings.company_address')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="google_map_embed" class="block text-sm font-medium text-gray-700 mb-1">Google Map
                            Embed URL</label>
                        <input type="text" id="google_map_embed" wire:model="settings.google_map_embed"
                            class="w-full rounded-md shadow-sm border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50">
                        <p class="text-xs text-gray-500 mt-1">Enter the full iframe URL from Google Maps embed code</p>
                        @error('settings.google_map_embed')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="btn bg-primary-dark text-white hover:bg-primary-dark/90">
                            Save General Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Hero Settings -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="p-6 bg-gray-50 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-800">Homepage Hero Settings</h2>
            </div>

            <div class="p-6">
                <form wire:submit="updateHeroSettings">
                    <div class="mb-6">
                        <label for="hero_title" class="block text-sm font-medium text-gray-700 mb-1">Hero Title</label>
                        <input type="text" id="hero_title" wire:model="settings.hero_title"
                            class="w-full rounded-md shadow-sm border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50">
                        @error('settings.hero_title')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="hero_subtitle" class="block text-sm font-medium text-gray-700 mb-1">Hero
                            Subtitle</label>
                        <textarea id="hero_subtitle" wire:model="settings.hero_subtitle" rows="2"
                            class="w-full rounded-md shadow-sm border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50"></textarea>
                        @error('settings.hero_subtitle')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Carousel Images</label>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                            @if (isset($settings['hero_carousel_images']) && is_array($settings['hero_carousel_images']))
                                @foreach ($settings['hero_carousel_images'] as $index => $image)
                                    <div class="relative group">
                                        <img src="{{ asset($image) }}" alt="Hero Image"
                                            class="h-32 w-full object-cover rounded-md">
                                        <button type="button" wire:click="removeHeroImage({{ $index }})"
                                            class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <label for="hero_images" class="block text-sm font-medium text-gray-700 mb-1">Add New
                            Images</label>
                        <input type="file" id="hero_images" wire:model="heroImages" multiple accept="image/*"
                            class="w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-secondary focus:border-secondary">
                        <p class="text-xs text-gray-500 mt-1">You can select multiple images. Max 5MB per image.</p>
                        @error('heroImages.*')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="btn bg-primary-dark text-white hover:bg-primary-dark/90">
                            Save Hero Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Statistics Settings -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="p-6 bg-gray-50 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-800">Statistics Settings</h2>
            </div>

            <div class="p-6">
                <form wire:submit="updateStatSettings">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div>
                            <label for="stats_projects_completed"
                                class="block text-sm font-medium text-gray-700 mb-1">Projects Completed</label>
                            <input type="number" id="stats_projects_completed"
                                wire:model="settings.stats_projects_completed"
                                class="w-full rounded-md shadow-sm border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50">
                            @error('settings.stats_projects_completed')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="stats_happy_clients"
                                class="block text-sm font-medium text-gray-700 mb-1">Happy Clients</label>
                            <input type="number" id="stats_happy_clients" wire:model="settings.stats_happy_clients"
                                class="w-full rounded-md shadow-sm border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50">
                            @error('settings.stats_happy_clients')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="stats_years_experience"
                                class="block text-sm font-medium text-gray-700 mb-1">Years of Experience</label>
                            <input type="number" id="stats_years_experience"
                                wire:model="settings.stats_years_experience"
                                class="w-full rounded-md shadow-sm border-gray-300 focus:border-secondary focus:ring focus:ring-secondary focus:ring-opacity-50">
                            @error('settings.stats_years_experience')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="btn bg-primary-dark text-white hover:bg-primary-dark/90">
                            Save Statistics
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
