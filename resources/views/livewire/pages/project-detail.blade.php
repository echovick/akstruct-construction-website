<?php

use App\Models\Project;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('layout.web')] class extends Component {
    public Project $project; // Auto route-model binding via slug

    public function with(): array
    {
        return [
            'relatedProjects' => Project::where('category_id', $this->project->category_id)->where('id', '!=', $this->project->id)->limit(3)->get(),
            'galleryImagesJson' => $this->getGalleryImagesJson(),
        ];
    }

    private function getGalleryImagesJson(): string
    {
        if (!$this->project->gallery_images) {
            return '[]';
        }

        $images = collect($this->project->gallery_images)
            ->map(function ($image, $index) {
                $imageUrl = filter_var($image, FILTER_VALIDATE_URL) ? $image : asset($image);
                return [
                    'src' => $imageUrl,
                    'alt' => $this->project->title . ' - Image ' . ($index + 1),
                ];
            })
            ->toArray();

        return json_encode($images);
    }
}; ?>

<div>
    <!-- Hero Section with Project Image -->
    <section class="relative h-[60vh] bg-gray-900 overflow-hidden">
        @if ($project->featured_image || $project->image_path)
            <img src="{{ $project->featured_image ?? $project->image_path }}" alt="{{ $project->title }}"
                class="w-full h-full object-cover opacity-70">
        @else
            <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1920&h=1080&fit=crop"
                alt="{{ $project->title }}" class="w-full h-full object-cover opacity-70">
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
        <div class="absolute bottom-0 left-0 right-0 p-8 md:p-16">
            <div class="max-w-7xl mx-auto">
                <span class="inline-block px-4 py-2 bg-orange-500 text-white text-sm font-semibold rounded-full mb-4">
                    {{ $project->category->name ?? 'Construction Project' }}
                </span>
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-4">
                    {{ $project->title }}
                </h1>
                <p class="text-xl text-gray-200 max-w-3xl">
                    {{ $project->short_description ?? Str::limit($project->description, 150) }}
                </p>
            </div>
        </div>
    </section>

    <!-- Project Overview -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Project Overview</h2>
                    <div class="prose prose-lg text-gray-600 max-w-none">
                        {!! nl2br(e($project->description)) !!}

                        @if ($project->sustainability_focus)
                            <div class="mt-6 p-4 bg-green-50 border-l-4 border-green-500 rounded">
                                <h4 class="font-semibold text-green-900 mb-2">Sustainability Focus</h4>
                                <p class="text-green-800">{{ $project->sustainability_focus }}</p>
                            </div>
                        @endif
                    </div>

                    <!-- Key Features -->
                    @if ($project->highlights && is_array($project->highlights) && count($project->highlights) > 0)
                        <div class="mt-12">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6">Key Features</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach ($project->highlights as $highlight)
                                    <div class="flex items-start space-x-3">
                                        <svg class="w-6 h-6 text-orange-500 mt-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <div>
                                            <p class="text-gray-900">{{ $highlight }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Project Details Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-gray-50 rounded-lg p-8 sticky top-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Project Details</h3>
                        <dl class="space-y-4">
                            @if ($project->client)
                                <div class="border-b border-gray-200 pb-4">
                                    <dt class="text-sm font-medium text-gray-500">Client</dt>
                                    <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $project->client }}</dd>
                                </div>
                            @endif

                            @if ($project->developer)
                                <div class="border-b border-gray-200 pb-4">
                                    <dt class="text-sm font-medium text-gray-500">Developer</dt>
                                    <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $project->developer }}</dd>
                                </div>
                            @endif

                            @if ($project->architect)
                                <div class="border-b border-gray-200 pb-4">
                                    <dt class="text-sm font-medium text-gray-500">Architect</dt>
                                    <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $project->architect }}</dd>
                                </div>
                            @endif

                            @if ($project->contractor)
                                <div class="border-b border-gray-200 pb-4">
                                    <dt class="text-sm font-medium text-gray-500">Contractor</dt>
                                    <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $project->contractor }}
                                    </dd>
                                </div>
                            @endif

                            <div class="border-b border-gray-200 pb-4">
                                <dt class="text-sm font-medium text-gray-500">Location</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $project->location }}</dd>
                            </div>

                            <div class="border-b border-gray-200 pb-4">
                                <dt class="text-sm font-medium text-gray-500">Project Type</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">
                                    {{ $project->category->name ?? 'N/A' }}</dd>
                            </div>

                            @if ($project->area)
                                <div class="border-b border-gray-200 pb-4">
                                    <dt class="text-sm font-medium text-gray-500">Area</dt>
                                    <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $project->area }}</dd>
                                </div>
                            @endif

                            @if ($project->floors)
                                <div class="border-b border-gray-200 pb-4">
                                    <dt class="text-sm font-medium text-gray-500">Floors</dt>
                                    <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $project->floors }}</dd>
                                </div>
                            @endif

                            @if ($project->duration)
                                <div class="border-b border-gray-200 pb-4">
                                    <dt class="text-sm font-medium text-gray-500">Duration</dt>
                                    <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $project->duration }}</dd>
                                </div>
                            @endif

                            <div class="border-b border-gray-200 pb-4">
                                <dt class="text-sm font-medium text-gray-500">Status</dt>
                                <dd class="mt-1 text-lg font-semibold text-green-600">{{ $project->status }}</dd>
                            </div>

                            @if ($project->completed_at)
                                <div class="border-b border-gray-200 pb-4">
                                    <dt class="text-sm font-medium text-gray-500">Completion</dt>
                                    <dd class="mt-1 text-lg font-semibold text-gray-900">
                                        {{ $project->completed_at->format('F Y') }}</dd>
                                </div>
                            @endif

                            @if ($project->cost)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Project Value</dt>
                                    <dd class="mt-1 text-lg font-semibold text-gray-900">
                                        ₦{{ number_format($project->cost, 2) }}</dd>
                                </div>
                            @endif
                        </dl>

                        <!-- CTA Buttons -->
                        <div class="mt-8 space-y-3">
                            @if ($project->case_study_pdf)
                                <a href="{{ asset($project->case_study_pdf) }}" download
                                    class="w-full bg-orange-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-orange-600 transition text-center block">
                                    Download Case Study
                                </a>
                            @endif

                            @if ($project->completion_certificate)
                                <a href="{{ asset($project->completion_certificate) }}" download
                                    class="w-full border-2 border-gray-300 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:border-gray-400 transition text-center block">
                                    View Certificate
                                </a>
                            @endif

                            <a href="{{ route('contact') }}"
                                class="w-full border-2 border-orange-500 text-orange-500 px-6 py-3 rounded-lg font-semibold hover:bg-orange-500 hover:text-white transition text-center block">
                                Request Similar Project
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Project Gallery -->
    @if ($project->gallery_images && is_array($project->gallery_images) && count($project->gallery_images) > 0)
        <section class="py-16 bg-gray-50" x-data="{
            isOpen: false,
            currentIndex: 0,
            images: {!! $galleryImagesJson !!},
            get currentImage() { return this.images[this.currentIndex]; },
            openLightbox(index) {
                this.currentIndex = index;
                this.isOpen = true;
                document.body.style.overflow = 'hidden';
            },
            closeLightbox() {
                this.isOpen = false;
                document.body.style.overflow = 'auto';
            },
            nextImage() { this.currentIndex = (this.currentIndex + 1) % this.images.length; },
            previousImage() { this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length; },
            setCurrentImage(index) { this.currentIndex = index; }
        }">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Project Gallery</h2>

                <!-- Normal Grid Gallery -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($project->gallery_images as $index => $image)
                        @php
                            $imageUrl = filter_var($image, FILTER_VALIDATE_URL) ? $image : asset($image);
                        @endphp
                        <div @click="openLightbox({{ $index }})"
                            class="relative group cursor-pointer overflow-hidden rounded-lg bg-gray-200">
                            <img src="{{ $imageUrl }}" alt="{{ $project->title }} - Image {{ $index + 1 }}"
                                class="gallery-image w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500"
                                loading="eager" onload="console.log('Gallery image loaded:', this.src)"
                                onerror="console.error('Gallery image failed to load:', this.src); this.style.display='none'; this.parentElement.innerHTML += '<div class=\'flex items-center justify-center h-64 bg-gray-300 text-gray-600\'>Image Unavailable</div>'"
                                <div
                                class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                            <svg class="w-12 h-12 text-white opacity-0 group-hover:opacity-100 transform scale-50 group-hover:scale-100 transition-all duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"></path>
                            </svg>
                        </div>
                </div>
    @endforeach


    <!-- Lightbox Modal -->
    <div x-show="isOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="closeLightbox()"
        @keydown.escape.window="closeLightbox()"
        class="fixed inset-0 z-50 bg-black bg-opacity-95 flex items-center justify-center p-4">

        <!-- Close Button -->
        <button @click="closeLightbox()"
            class="absolute top-4 right-4 text-white hover:text-gray-300 transition z-50">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                </path>
            </svg>
        </button>

        <!-- Navigation Arrows -->
        <button @click.stop="previousImage()"
            class="absolute left-4 top-1/2 -translate-y-1/2 text-white hover:text-gray-300 transition bg-black bg-opacity-50 rounded-full p-2">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                </path>
            </svg>
        </button>

        <button @click.stop="nextImage()"
            class="absolute right-4 top-1/2 -translate-y-1/2 text-white hover:text-gray-300 transition bg-black bg-opacity-50 rounded-full p-2">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                </path>
            </svg>
        </button>

        <!-- Image Container -->
        <div @click.stop class="relative max-w-7xl max-h-[90vh] mx-auto">
            <img :src="currentImage.src" :alt="currentImage.alt" class="max-w-full max-h-[90vh] object-contain"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100">

            <!-- Image Caption -->
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-6">
                <p class="text-white text-lg font-semibold" x-text="currentImage.alt"></p>
                <p class="text-gray-300 text-sm mt-1" x-text="`${currentIndex + 1} / ${images.length}`"></p>
            </div>
        </div>

        <!-- Thumbnail Strip -->
        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 overflow-x-auto max-w-full px-4">
            <template x-for="(image, index) in images" :key="index">
                <button @click.stop="setCurrentImage(index)" :class="{ 'ring-2 ring-white': currentIndex === index }"
                    class="flex-shrink-0 w-16 h-16 rounded overflow-hidden opacity-70 hover:opacity-100 transition">
                    <img :src="image.src" :alt="image.alt" class="w-full h-full object-cover">
                </button>
            </template>
        </div>
    </div>
    </section>
    @endif

    <!-- Technical Specifications -->
    @if ($project->specifications && is_array($project->specifications) && count($project->specifications) > 0)
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Project Specifications</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($project->specifications as $category => $items)
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ $category }}</h3>
                            <ul class="space-y-2 text-gray-600">
                                @foreach ($items as $item)
                                    <li>• {{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Project Timeline -->
    @if ($project->timeline && is_array($project->timeline) && count($project->timeline) > 0)
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Project Timeline</h2>
                <div class="relative">
                    <div class="absolute left-8 top-0 bottom-0 w-0.5 bg-orange-500"></div>
                    <div class="space-y-8">
                        @foreach ($project->timeline as $milestone)
                            <div class="flex items-center">
                                <div
                                    class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                    {{ $milestone['phase'] ?? '' }}
                                </div>
                                <div class="ml-8 bg-white rounded-lg p-6 flex-1">
                                    <h3 class="font-semibold text-gray-900">{{ $milestone['title'] ?? '' }}</h3>
                                    <p class="text-gray-600 mt-1">{{ $milestone['description'] ?? '' }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Project Video -->
    @if ($project->video_path)
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Project Video</h2>
                <div class="bg-gray-100 rounded-xl p-8">
                    <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden shadow-xl">
                        <video class="w-full h-full object-cover" controls>
                            <source src="{{ asset($project->video_path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <p class="text-center mt-4 text-gray-600">
                        Take a virtual tour of {{ $project->title }} and see our construction excellence in action
                    </p>
                </div>
            </div>
        </section>
    @endif

    <!-- Google Maps Location -->
    @if ($project->google_maps_url || $project->map_coordinates)
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Prime Location</h2>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <p class="text-lg text-gray-600 mb-6">
                            {{ $project->title }} is strategically located in {{ $project->location }}.
                        </p>
                        @if ($project->google_maps_url)
                            <a href="{{ $project->google_maps_url }}" target="_blank"
                                class="inline-flex items-center bg-orange-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-orange-600 transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                    </path>
                                </svg>
                                View on Google Maps
                            </a>
                        @endif
                    </div>
                    <div>
                        @if ($project->google_maps_url)
                            <div class="rounded-xl overflow-hidden shadow-2xl">
                                <iframe
                                    src="{{ str_replace('maps.app.goo.gl', 'www.google.com/maps/embed?pb', $project->google_maps_url) }}"
                                    width="100%" height="400" style="border:0;" allowfullscreen=""
                                    loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                                    class="w-full h-full rounded-lg">
                                </iframe>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Related Projects -->
    @if (isset($relatedProjects) && $relatedProjects->count() > 0)
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Related Projects</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach ($relatedProjects as $relatedProject)
                        <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition">
                            @if ($relatedProject->featured_image || $relatedProject->image_path)
                                <img src="{{ $relatedProject->featured_image ?? $relatedProject->image_path }}"
                                    alt="{{ $relatedProject->title }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-400">No Image</span>
                                </div>
                            @endif
                            <div class="p-6">
                                <span
                                    class="text-orange-500 text-sm font-semibold">{{ $relatedProject->category->name ?? 'Project' }}</span>
                                <h3 class="text-xl font-bold text-gray-900 mt-2">{{ $relatedProject->title }}</h3>
                                <p class="text-gray-600 mt-2">
                                    {{ Str::limit($relatedProject->short_description ?? $relatedProject->description, 80) }}
                                </p>
                                <a href="{{ route('projects.show', $relatedProject) }}"
                                    class="inline-flex items-center text-orange-500 font-semibold mt-4 hover:text-orange-600">
                                    View Project
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- CTA Section -->
    <section class="py-16 bg-orange-500">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">
                Have a Similar Project in Mind?
            </h2>
            <p class="text-xl text-orange-100 mb-8">
                Let's discuss how we can bring your vision to life with our expertise and innovation.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/contact"
                    class="bg-white text-orange-500 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                    Start Your Project
                </a>
                <a href="/project-portfolio"
                    class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-orange-500 transition">
                    View All Projects
                </a>
            </div>
        </div>
    </section>
</div>
