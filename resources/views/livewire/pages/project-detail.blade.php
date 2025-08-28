<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('layout.web')] class extends Component {
    
}; ?>

<div>
    <!-- Hero Section with Project Image -->
    <section class="relative h-[60vh] bg-gray-900 overflow-hidden">
        <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=1920&h=1080&fit=crop" 
             alt="Modern Office Building" 
             class="w-full h-full object-cover opacity-70">
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
        <div class="absolute bottom-0 left-0 right-0 p-8 md:p-16">
            <div class="max-w-7xl mx-auto">
                <span class="inline-block px-4 py-2 bg-orange-500 text-white text-sm font-semibold rounded-full mb-4">
                    Commercial Buildings
                </span>
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-4">
                    Skyline Business Center
                </h1>
                <p class="text-xl text-gray-200 max-w-3xl">
                    A state-of-the-art commercial complex featuring sustainable design and modern architecture
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
                            The Skyline Business Center represents a pinnacle of modern commercial architecture, 
                            seamlessly blending functionality with aesthetic excellence. This 25-story tower 
                            stands as a testament to innovative design principles and sustainable construction practices.
                        </p>
                        <p>
                            Located in the heart of the business district, this project encompasses 150,000 square feet 
                            of premium office space, featuring floor-to-ceiling windows that maximize natural light 
                            and provide panoramic city views. The building's distinctive glass facade incorporates 
                            advanced solar control technology, reducing energy consumption by 40% compared to 
                            traditional designs.
                        </p>
                        <p>
                            Our team meticulously planned every aspect of this development, from the reinforced 
                            foundation system capable of withstanding seismic activity to the rooftop garden that 
                            serves as both a recreational space and a natural cooling system. The integration of 
                            smart building technology allows for automated climate control, security, and lighting 
                            systems, creating an intelligent workspace for the 21st century.
                        </p>
                    </div>

                    <!-- Key Features -->
                    <div class="mt-12">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Key Features</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 text-orange-500 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <div>
                                    <h4 class="font-semibold text-gray-900">LEED Platinum Certified</h4>
                                    <p class="text-gray-600">Highest level of green building certification</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 text-orange-500 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Smart Building Systems</h4>
                                    <p class="text-gray-600">IoT-enabled automation and control</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 text-orange-500 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Earthquake Resistant</h4>
                                    <p class="text-gray-600">Advanced seismic protection systems</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <svg class="w-6 h-6 text-orange-500 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Rooftop Garden</h4>
                                    <p class="text-gray-600">5,000 sq ft of green recreational space</p>
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
                                <dt class="text-sm font-medium text-gray-500">Client</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">Global Corporate Holdings</dd>
                            </div>
                            <div class="border-b border-gray-200 pb-4">
                                <dt class="text-sm font-medium text-gray-500">Location</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">Lagos, Nigeria</dd>
                            </div>
                            <div class="border-b border-gray-200 pb-4">
                                <dt class="text-sm font-medium text-gray-500">Project Type</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">Commercial Building</dd>
                            </div>
                            <div class="border-b border-gray-200 pb-4">
                                <dt class="text-sm font-medium text-gray-500">Area</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">150,000 sq ft</dd>
                            </div>
                            <div class="border-b border-gray-200 pb-4">
                                <dt class="text-sm font-medium text-gray-500">Duration</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">24 months</dd>
                            </div>
                            <div class="border-b border-gray-200 pb-4">
                                <dt class="text-sm font-medium text-gray-500">Completion</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">December 2023</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Project Value</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">₦2.5 Billion</dd>
                            </div>
                        </dl>

                        <!-- CTA Buttons -->
                        <div class="mt-8 space-y-3">
                            <button class="w-full bg-orange-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-orange-600 transition">
                                Download Brochure
                            </button>
                            <button class="w-full border-2 border-gray-300 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:border-gray-400 transition">
                                Request Similar Project
                            </button>
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
            
            <!-- Normal Grid Gallery -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div @click="openLightbox(0)" class="relative group cursor-pointer overflow-hidden rounded-lg bg-gray-200">
                    <img src="https://via.placeholder.com/800x600/1a365d/ffffff?text=Building+Exterior" 
                         alt="Building Exterior" 
                         class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500"
                         onerror="this.src='https://via.placeholder.com/800x600/1a365d/ffffff?text=Building+Exterior'">
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                        <svg class="w-12 h-12 text-white opacity-0 group-hover:opacity-100 transform scale-50 group-hover:scale-100 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"></path>
                        </svg>
                    </div>
                </div>
                
                <div @click="openLightbox(1)" class="relative group cursor-pointer overflow-hidden rounded-lg bg-gray-200">
                    <img src="https://via.placeholder.com/800x600/2d3748/ffffff?text=Office+Interior" 
                         alt="Office Interior" 
                         class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500"
                         onerror="this.src='https://via.placeholder.com/800x600/2d3748/ffffff?text=Office+Interior'">
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                        <svg class="w-12 h-12 text-white opacity-0 group-hover:opacity-100 transform scale-50 group-hover:scale-100 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"></path>
                        </svg>
                    </div>
                </div>
                
                <div @click="openLightbox(2)" class="relative group cursor-pointer overflow-hidden rounded-lg bg-gray-200">
                    <img src="https://via.placeholder.com/800x600/4a5568/ffffff?text=Conference+Room" 
                         alt="Conference Room" 
                         class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500"
                         onerror="this.src='https://via.placeholder.com/800x600/4a5568/ffffff?text=Conference+Room'">
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                        <svg class="w-12 h-12 text-white opacity-0 group-hover:opacity-100 transform scale-50 group-hover:scale-100 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"></path>
                        </svg>
                    </div>
                </div>
                
                <div @click="openLightbox(3)" class="relative group cursor-pointer overflow-hidden rounded-lg bg-gray-200">
                    <img src="https://via.placeholder.com/800x600/718096/ffffff?text=Office+Space" 
                         alt="Office Space" 
                         class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500"
                         onerror="this.src='https://via.placeholder.com/800x600/718096/ffffff?text=Office+Space'">
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                        <svg class="w-12 h-12 text-white opacity-0 group-hover:opacity-100 transform scale-50 group-hover:scale-100 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"></path>
                        </svg>
                    </div>
                </div>
                
                <div @click="openLightbox(4)" class="relative group cursor-pointer overflow-hidden rounded-lg bg-gray-200">
                    <img src="https://via.placeholder.com/800x600/ed8936/ffffff?text=Building+Facade" 
                         alt="Building Facade" 
                         class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500"
                         onerror="this.src='https://via.placeholder.com/800x600/ed8936/ffffff?text=Building+Facade'">
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                        <svg class="w-12 h-12 text-white opacity-0 group-hover:opacity-100 transform scale-50 group-hover:scale-100 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"></path>
                        </svg>
                    </div>
                </div>
                
                <div @click="openLightbox(5)" class="relative group cursor-pointer overflow-hidden rounded-lg bg-gray-200">
                    <img src="https://via.placeholder.com/800x600/38a169/ffffff?text=Rooftop+View" 
                         alt="Rooftop View" 
                         class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500"
                         onerror="this.src='https://via.placeholder.com/800x600/38a169/ffffff?text=Rooftop+View'">
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                        <svg class="w-12 h-12 text-white opacity-0 group-hover:opacity-100 transform scale-50 group-hover:scale-100 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"></path>
                        </svg>
                    </div>
                </div>
                
                <div @click="openLightbox(6)" class="relative group cursor-pointer overflow-hidden rounded-lg bg-gray-200">
                    <img src="https://via.placeholder.com/800x600/2563eb/ffffff?text=Night+View" 
                         alt="Night View" 
                         class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500"
                         onerror="this.src='https://via.placeholder.com/800x600/2563eb/ffffff?text=Night+View'">
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                        <svg class="w-12 h-12 text-white opacity-0 group-hover:opacity-100 transform scale-50 group-hover:scale-100 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"></path>
                        </svg>
                    </div>
                </div>
                
                <div @click="openLightbox(7)" class="relative group cursor-pointer overflow-hidden rounded-lg bg-gray-200">
                    <img src="https://via.placeholder.com/800x600/7c3aed/ffffff?text=Lobby+Area" 
                         alt="Lobby Area" 
                         class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500"
                         onerror="this.src='https://via.placeholder.com/800x600/7c3aed/ffffff?text=Lobby+Area'">
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                        <svg class="w-12 h-12 text-white opacity-0 group-hover:opacity-100 transform scale-50 group-hover:scale-100 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"></path>
                        </svg>
                    </div>
                </div>
                
                <div @click="openLightbox(8)" class="relative group cursor-pointer overflow-hidden rounded-lg bg-gray-200">
                    <img src="https://via.placeholder.com/800x600/dc2626/ffffff?text=Architectural+Detail" 
                         alt="Architectural Detail" 
                         class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500"
                         onerror="this.src='https://via.placeholder.com/800x600/dc2626/ffffff?text=Architectural+Detail'">
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                        <svg class="w-12 h-12 text-white opacity-0 group-hover:opacity-100 transform scale-50 group-hover:scale-100 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
    
    <script>
        function galleryLightbox() {
            return {
                isOpen: false,
                currentIndex: 0,
                images: [
                    { src: 'https://via.placeholder.com/1920x1080/1a365d/ffffff?text=Building+Exterior', alt: 'Building Exterior' },
                    { src: 'https://via.placeholder.com/1920x1080/2d3748/ffffff?text=Office+Interior', alt: 'Office Interior' },
                    { src: 'https://via.placeholder.com/1920x1080/4a5568/ffffff?text=Conference+Room', alt: 'Conference Room' },
                    { src: 'https://via.placeholder.com/1920x1080/718096/ffffff?text=Office+Space', alt: 'Office Space' },
                    { src: 'https://via.placeholder.com/1920x1080/ed8936/ffffff?text=Building+Facade', alt: 'Building Facade' },
                    { src: 'https://via.placeholder.com/1920x1080/38a169/ffffff?text=Rooftop+View', alt: 'Rooftop View' },
                    { src: 'https://via.placeholder.com/1920x1080/2563eb/ffffff?text=Night+View', alt: 'Night View' },
                    { src: 'https://via.placeholder.com/1920x1080/7c3aed/ffffff?text=Lobby+Area', alt: 'Lobby Area' },
                    { src: 'https://via.placeholder.com/1920x1080/dc2626/ffffff?text=Architectural+Detail', alt: 'Architectural Detail' }
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

    <!-- Technical Specifications -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Technical Specifications</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Structural System</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li>• Reinforced concrete frame</li>
                        <li>• Post-tensioned slabs</li>
                        <li>• Deep pile foundation</li>
                        <li>• Seismic dampers</li>
                    </ul>
                </div>
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">MEP Systems</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li>• VRF air conditioning</li>
                        <li>• LED lighting throughout</li>
                        <li>• Backup power generators</li>
                        <li>• Fire suppression system</li>
                    </ul>
                </div>
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Sustainability Features</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li>• Solar panels (500kW)</li>
                        <li>• Rainwater harvesting</li>
                        <li>• Double-glazed windows</li>
                        <li>• Energy recovery systems</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Project Timeline -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Project Timeline</h2>
            <div class="relative">
                <div class="absolute left-8 top-0 bottom-0 w-0.5 bg-orange-500"></div>
                <div class="space-y-8">
                    <div class="flex items-center">
                        <div class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold">
                            Q1
                        </div>
                        <div class="ml-8 bg-white rounded-lg p-6 flex-1">
                            <h3 class="font-semibold text-gray-900">Project Initiation & Design</h3>
                            <p class="text-gray-600 mt-1">Conceptual design, permits, and site preparation</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold">
                            Q2
                        </div>
                        <div class="ml-8 bg-white rounded-lg p-6 flex-1">
                            <h3 class="font-semibold text-gray-900">Foundation & Structure</h3>
                            <p class="text-gray-600 mt-1">Deep foundation work and structural frame construction</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold">
                            Q3
                        </div>
                        <div class="ml-8 bg-white rounded-lg p-6 flex-1">
                            <h3 class="font-semibold text-gray-900">MEP & Facade Installation</h3>
                            <p class="text-gray-600 mt-1">Mechanical, electrical, plumbing systems and exterior cladding</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold">
                            Q4
                        </div>
                        <div class="ml-8 bg-white rounded-lg p-6 flex-1">
                            <h3 class="font-semibold text-gray-900">Finishing & Handover</h3>
                            <p class="text-gray-600 mt-1">Interior finishing, testing, and project completion</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Projects -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Related Projects</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Project 1 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition">
                    <img src="https://images.unsplash.com/photo-1565623006066-82f23c79210b?w=600&h=400&fit=crop" 
                         alt="Tech Hub Plaza" 
                         class="w-full h-48 object-cover">
                    <div class="p-6">
                        <span class="text-orange-500 text-sm font-semibold">Commercial</span>
                        <h3 class="text-xl font-bold text-gray-900 mt-2">Tech Hub Plaza</h3>
                        <p class="text-gray-600 mt-2">Modern technology park with co-working spaces</p>
                        <a href="#" class="inline-flex items-center text-orange-500 font-semibold mt-4 hover:text-orange-600">
                            View Project
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Project 2 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition">
                    <img src="https://images.unsplash.com/photo-1464938050520-ef2270bb8ce8?w=600&h=400&fit=crop" 
                         alt="Marina Towers" 
                         class="w-full h-48 object-cover">
                    <div class="p-6">
                        <span class="text-orange-500 text-sm font-semibold">Mixed Use</span>
                        <h3 class="text-xl font-bold text-gray-900 mt-2">Marina Towers</h3>
                        <p class="text-gray-600 mt-2">Luxury waterfront development with retail spaces</p>
                        <a href="#" class="inline-flex items-center text-orange-500 font-semibold mt-4 hover:text-orange-600">
                            View Project
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Project 3 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition">
                    <img src="https://images.unsplash.com/photo-1481026469463-66327c86e544?w=600&h=400&fit=crop" 
                         alt="Financial District Tower" 
                         class="w-full h-48 object-cover">
                    <div class="p-6">
                        <span class="text-orange-500 text-sm font-semibold">Commercial</span>
                        <h3 class="text-xl font-bold text-gray-900 mt-2">Financial District Tower</h3>
                        <p class="text-gray-600 mt-2">Premium office complex in the business district</p>
                        <a href="#" class="inline-flex items-center text-orange-500 font-semibold mt-4 hover:text-orange-600">
                            View Project
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                <a href="/contact" class="bg-white text-orange-500 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                    Start Your Project
                </a>
                <a href="/project-portfolio" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-orange-500 transition">
                    View All Projects
                </a>
            </div>
        </div>
    </section>
</div>