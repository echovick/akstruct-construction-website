<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('layout.web')] class extends Component {}; ?>

<div>
    <!-- Hero Section with Project Image -->
    <section class="relative h-[85vh] bg-gray-900 overflow-hidden">
        <!-- Blurred background image -->
        <img src="{{ asset('assets/WhatsApp Image 2025-08-18 at 18.39.14.jpeg') }}" alt="Background"
            class="absolute inset-0 w-full h-full object-cover blur-lg scale-110 opacity-40">

        <!-- Main image (non-cropped) -->
        <img src="{{ asset('assets/WhatsApp Image 2025-08-18 at 18.39.14.jpeg') }}"
            alt="HH II GUZAPE - Residential Development" class="relative z-10 w-full h-full object-contain opacity-90">

        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent z-20"></div>
        <div class="absolute bottom-0 left-0 right-0 p-8 md:p-16 z-30">
            <div class="max-w-7xl mx-auto">
                <span class="inline-block px-4 py-2 bg-orange-500 text-white text-sm font-semibold rounded-full mb-4">
                    Residential Development
                </span>
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-4">
                    HH II GUZAPE
                </h1>
                <p class="text-xl text-gray-200 max-w-3xl">
                    Premium residential development in the prestigious Guzape district of Abuja, showcasing modern
                    architecture and sustainable construction practices
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
                        <p>
                            HH II GUZAPE represents the pinnacle of residential excellence in Abuja's most sought-after
                            district.
                            This flagship project by Akstruct Construction Ltd demonstrates our commitment to creating
                            exceptional
                            living spaces that blend luxury, comfort, and environmental responsibility.
                        </p>
                        <p>
                            Located in the prestigious Guzape district, this development features contemporary
                            architectural design
                            with premium finishes throughout. The project incorporates sustainable building practices
                            and
                            energy-efficient systems, making it a model for modern residential construction in Nigeria.
                        </p>
                        <p>
                            Our team has meticulously planned every aspect of this development, from the foundation
                            systems
                            to the interior finishes, ensuring that each unit meets the highest standards of quality and
                            craftsmanship. The project showcases our expertise in creating homes that are both beautiful
                            and functionally superior.
                        </p>
                    </div>

                    <!-- Key Features -->
                    <div class="mt-12">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Key Features</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 text-orange-500 mt-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Premium Location</h4>
                                    <p class="text-gray-600">Prime position in Guzape district</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 text-orange-500 mt-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Modern Architecture</h4>
                                    <p class="text-gray-600">Contemporary design with luxury finishes</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 text-orange-500 mt-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Sustainable Construction</h4>
                                    <p class="text-gray-600">Eco-friendly materials and practices</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 text-orange-500 mt-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Quality Assurance</h4>
                                    <p class="text-gray-600">Rigorous quality control standards</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Project Details Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-gray-50 rounded-lg p-8 sticky top-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Project Details</h3>
                        <dl class="space-y-4">
                            <div class="border-b border-gray-200 pb-4">
                                <dt class="text-sm font-medium text-gray-500">Project Name</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">HH II GUZAPE</dd>
                            </div>
                            <div class="border-b border-gray-200 pb-4">
                                <dt class="text-sm font-medium text-gray-500">Location</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">Guzape District, Abuja</dd>
                            </div>
                            <div class="border-b border-gray-200 pb-4">
                                <dt class="text-sm font-medium text-gray-500">Project Type</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">Residential Development</dd>
                            </div>
                            <div class="border-b border-gray-200 pb-4">
                                <dt class="text-sm font-medium text-gray-500">Status</dt>
                                <dd class="mt-1 text-lg font-semibold text-green-600">Completed</dd>
                            </div>
                            <div class="border-b border-gray-200 pb-4">
                                <dt class="text-sm font-medium text-gray-500">Year</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">2024</dd>
                            </div>
                            <div class="border-b border-gray-200 pb-4">
                                <dt class="text-sm font-medium text-gray-500">Developer</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">Akstruct Construction Ltd</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Category</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">Luxury Residential</dd>
                            </div>
                        </dl>

                        <!-- CTA Buttons -->
                        <div class="mt-8 space-y-3">
                            <a href="{{ route('contact') }}"
                                class="w-full bg-orange-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-orange-600 transition text-center block">
                                Contact Us
                            </a>
                            <a href="{{ route('quote') }}"
                                class="w-full border-2 border-gray-300 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:border-gray-400 transition text-center block">
                                Request Quote
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Project Gallery -->
    <section class="py-16 bg-gray-50" x-data="galleryLightbox()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Project Gallery</h2>
            
            <!-- Gallery Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div @click="openLightbox(0)" class="relative group cursor-pointer overflow-hidden rounded-lg bg-white">
                    <img src="{{ asset('assets/e71ba21a-d8f0-49ac-b874-2aca01a5e644.jpeg') }}" 
                         alt="HH II GUZAPE - Exterior View" 
                         class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300 relative z-10">
                    <div class="absolute inset-0 bg-transparent group-hover:bg-black group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center z-20">
                        <svg class="w-12 h-12 text-white opacity-0 group-hover:opacity-100 transform scale-75 group-hover:scale-100 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"></path>
                        </svg>
                    </div>
                </div>
                
                <div @click="openLightbox(1)" class="relative group cursor-pointer overflow-hidden rounded-lg bg-white">
                    <img src="{{ asset('assets/WhatsApp Image 2025-08-18 at 18.39.14.jpeg') }}" 
                         alt="HH II GUZAPE - Construction Progress" 
                         class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300 relative z-10">
                    <div class="absolute inset-0 bg-transparent group-hover:bg-black group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center z-20">
                        <svg class="w-12 h-12 text-white opacity-0 group-hover:opacity-100 transform scale-75 group-hover:scale-100 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"></path>
                        </svg>
                    </div>
                </div>
                
                <div @click="openLightbox(2)" class="relative group cursor-pointer overflow-hidden rounded-lg bg-white">
                    <img src="{{ asset('assets/IMG_7147.jpg') }}" 
                         alt="HH II GUZAPE - Detail View" 
                         class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300 relative z-10">
                    <div class="absolute inset-0 bg-transparent group-hover:bg-black group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center z-20">
                        <svg class="w-12 h-12 text-white opacity-0 group-hover:opacity-100 transform scale-75 group-hover:scale-100 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"></path>
                        </svg>
                    </div>
                </div>
                
                <div @click="openLightbox(3)" class="relative group cursor-pointer overflow-hidden rounded-lg bg-white">
                    <img src="{{ asset('assets/IMG_7145.jpg') }}" 
                         alt="HH II GUZAPE - Construction Phase" 
                         class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300 relative z-10">
                    <div class="absolute inset-0 bg-transparent group-hover:bg-black group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center z-20">
                        <svg class="w-12 h-12 text-white opacity-0 group-hover:opacity-100 transform scale-75 group-hover:scale-100 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"></path>
                        </svg>
                    </div>
                </div>
                
                <div @click="openLightbox(4)" class="relative group cursor-pointer overflow-hidden rounded-lg bg-white">
                    <img src="{{ asset('assets/IMG_7141.JPG') }}" 
                         alt="HH II GUZAPE - Architectural Detail" 
                         class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300 relative z-10">
                    <div class="absolute inset-0 bg-transparent group-hover:bg-black group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center z-20">
                        <svg class="w-12 h-12 text-white opacity-0 group-hover:opacity-100 transform scale-75 group-hover:scale-100 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"></path>
                        </svg>
                    </div>
                </div>
                
                <div @click="openLightbox(5)" class="relative group cursor-pointer overflow-hidden rounded-lg bg-white">
                    <img src="{{ asset('assets/IMG_7143.JPG') }}" 
                         alt="HH II GUZAPE - Finishing Work" 
                         class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300 relative z-10">
                    <div class="absolute inset-0 bg-transparent group-hover:bg-black group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center z-20">
                        <svg class="w-12 h-12 text-white opacity-0 group-hover:opacity-100 transform scale-75 group-hover:scale-100 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Lightbox Modal -->
        <div x-show="isOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="closeLightbox()"
             @keydown.escape.window="closeLightbox()"
             class="fixed inset-0 z-50 bg-black bg-opacity-95 flex items-center justify-center p-4">
            
            <!-- Close Button -->
            <button @click="closeLightbox()" 
                    class="absolute top-4 right-4 text-white hover:text-gray-300 transition z-50">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            
            <!-- Navigation Arrows -->
            <button @click.stop="previousImage()" 
                    class="absolute left-4 top-1/2 -translate-y-1/2 text-white hover:text-gray-300 transition bg-black bg-opacity-50 rounded-full p-2">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            
            <button @click.stop="nextImage()" 
                    class="absolute right-4 top-1/2 -translate-y-1/2 text-white hover:text-gray-300 transition bg-black bg-opacity-50 rounded-full p-2">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
            
            <!-- Image Container -->
            <div @click.stop class="relative max-w-7xl max-h-[90vh] mx-auto">
                <img :src="currentImage.src" 
                     :alt="currentImage.alt"
                     class="max-w-full max-h-[90vh] object-contain"
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
                    <button @click.stop="setCurrentImage(index)" 
                            :class="{'ring-2 ring-white': currentIndex === index}"
                            class="flex-shrink-0 w-16 h-16 rounded overflow-hidden opacity-70 hover:opacity-100 transition">
                        <img :src="image.src" :alt="image.alt" class="w-full h-full object-cover">
                    </button>
                </template>
            </div>
        </div>
    </section>

    </section>

    <!-- Project Video -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Project Video</h2>
            <div class="bg-gray-100 rounded-xl p-8">
                <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden shadow-xl">
                    <video class="w-full h-full object-cover" controls>
                        <source src="{{ asset('assets/Akstruct (Guzape site).MP4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <p class="text-center mt-4 text-gray-600">
                    Take a virtual tour of our HH II GUZAPE project and see our construction excellence in action
                </p>
            </div>
        </div>
    </section>

    <!-- Location Section with Google Maps -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Location Info -->
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Prime Location</h2>
                    <p class="text-lg text-gray-600 mb-6">
                        HH II GUZAPE is strategically located in the prestigious Guzape district of Abuja,
                        one of the most sought-after residential areas in Nigeria's capital city.
                    </p>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-start space-x-3">
                            <svg class="w-6 h-6 text-orange-500 mt-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-gray-900">Address</h4>
                                <p class="text-gray-600">Guzape District, Abuja, FCT, Nigeria</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <svg class="w-6 h-6 text-orange-500 mt-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-gray-900">Accessibility</h4>
                                <p class="text-gray-600">Easy access to major roads and city center</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <svg class="w-6 h-6 text-orange-500 mt-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-gray-900">Neighborhood</h4>
                                <p class="text-gray-600">Premium residential area with modern amenities</p>
                            </div>
                        </div>
                    </div>

                    <a href="https://maps.app.goo.gl/p1XMDa8y8cVnNQYV8?g_st=aw" target="_blank"
                        class="inline-flex items-center bg-orange-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-orange-600 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        View on Google Maps
                    </a>
                </div>

                <!-- Aesthetic Google Maps Integration -->
                <div class="relative">
                    <div class="rounded-xl overflow-hidden shadow-2xl bg-white p-4">
                        <div class="aspect-w-16 aspect-h-12 rounded-lg overflow-hidden">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3939.9876!2d7.4975!3d9.0579!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x104e0baf7da48acd%3A0x4a983031a95bffeb!2sGuzape%20District%2C%20Abuja!5e0!3m2!1sen!2sng!4v1692636789!5m2!1sen!2sng"
                                width="100%" height="400" style="border:0; border-radius: 8px;"
                                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                                class="w-full h-full">
                            </iframe>
                        </div>

                        <!-- Map Overlay Info -->
                        <div
                            class="absolute top-8 left-8 bg-white/95 backdrop-blur-sm rounded-lg p-4 shadow-lg max-w-xs">
                            <h4 class="font-bold text-gray-900 mb-2">HH II GUZAPE</h4>
                            <p class="text-sm text-gray-600 mb-2">Premium residential development in Guzape District
                            </p>
                            <div class="flex items-center text-xs text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Guzape, Abuja
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Technical Specifications -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Project Specifications</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Construction Details</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li>• Reinforced concrete structure</li>
                        <li>• Premium finishing materials</li>
                        <li>• Modern architectural design</li>
                        <li>• Quality assurance standards</li>
                    </ul>
                </div>
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Features & Amenities</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li>• Spacious living areas</li>
                        <li>• Modern kitchen designs</li>
                        <li>• Premium bathroom fittings</li>
                        <li>• Covered parking spaces</li>
                    </ul>
                </div>
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Sustainability</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li>• Energy-efficient design</li>
                        <li>• Sustainable materials</li>
                        <li>• Water conservation systems</li>
                        <li>• Green building practices</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-orange-500">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">
                Interested in Similar Quality Construction?
            </h2>
            <p class="text-xl text-orange-100 mb-8">
                Let Akstruct Construction Ltd bring the same level of excellence to your next project.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact') }}"
                    class="bg-white text-orange-500 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                    Contact Us Today
                </a>
                <a href="{{ route('project-portfolio') }}"
                    class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-orange-500 transition">
                    View More Projects
                </a>
            </div>
        </div>
    </section>
    
    <script>
        function galleryLightbox() {
            return {
                isOpen: false,
                currentIndex: 0,
                images: [
                    { src: '{{ asset("assets/e71ba21a-d8f0-49ac-b874-2aca01a5e644.jpeg") }}', alt: 'HH II GUZAPE - Exterior View' },
                    { src: '{{ asset("assets/WhatsApp Image 2025-08-18 at 18.39.14.jpeg") }}', alt: 'HH II GUZAPE - Construction Progress' },
                    { src: '{{ asset("assets/IMG_7147.jpg") }}', alt: 'HH II GUZAPE - Detail View' },
                    { src: '{{ asset("assets/IMG_7145.jpg") }}', alt: 'HH II GUZAPE - Construction Phase' },
                    { src: '{{ asset("assets/IMG_7141.JPG") }}', alt: 'HH II GUZAPE - Architectural Detail' },
                    { src: '{{ asset("assets/IMG_7143.JPG") }}', alt: 'HH II GUZAPE - Finishing Work' }
                ],
                get currentImage() {
                    return this.images[this.currentIndex];
                },
                openLightbox(index) {
                    this.currentIndex = index;
                    this.isOpen = true;
                    document.body.style.overflow = 'hidden';
                },
                closeLightbox() {
                    this.isOpen = false;
                    document.body.style.overflow = 'auto';
                },
                nextImage() {
                    this.currentIndex = (this.currentIndex + 1) % this.images.length;
                },
                previousImage() {
                    this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
                },
                setCurrentImage(index) {
                    this.currentIndex = index;
                }
            }
        }
    </script>

</div>
