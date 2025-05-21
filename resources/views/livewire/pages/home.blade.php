<?php

use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Setting;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('layout.web')] class extends Component {
    public function with(): array
    {
        return [
            'featuredProjects' => Project::where('is_featured', true)->take(3)->get(),
            'featuredServices' => Service::where('is_featured', true)->orderBy('display_order')->get(),
            'testimonials' => Testimonial::where('is_featured', true)->take(3)->get(),
            'heroTitle' => Setting::getValue('hero_title', 'Building Tomorrow\'s Infrastructure Today'),
            'heroSubtitle' => Setting::getValue('hero_subtitle', 'Sustainable engineering solutions with cutting-edge technology and uncompromising quality'),
            'heroImages' => Setting::getValue('hero_carousel_images', ['assets/img/hero/project1.jpg', 'assets/img/hero/project2.jpg', 'assets/img/hero/project3.jpg']),
            'useVideoBackground' => Setting::getValue('use_video_background', true),
            'heroVideo' => Setting::getValue('hero_video', 'assets/video/construction-background.mp4'),
            'projectsCompleted' => Setting::getValue('stats_projects_completed', '150'),
            'happyClients' => Setting::getValue('stats_happy_clients', '123'),
            'yearsExperience' => Setting::getValue('stats_years_experience', '8'),
        ];
    }
}; ?>

<div>
    <!-- Modern Hero Section with Video or Floating Elements -->
    <section class="hero-section relative overflow-hidden min-h-[85vh] flex items-center">
        <!-- Video Background (if enabled) -->
        @if ($useVideoBackground)
            <div class="absolute inset-0 z-0">
                <video class="object-cover w-full h-full" autoplay loop playsinline>
                    <source src="{{ asset('assets/AKSTUCT (MARCH,2025) revised .MP4') }}" type="video/mp4">
                    <!-- Fallback image if video can't play -->
                    <div class="absolute inset-0 bg-cover bg-center"
                        style="background-image: url('{{ asset('assets/IMG_7144.JPG') }}')"></div>
                </video>
                <div class="absolute inset-0 bg-gradient-to-r from-primary-dark/70 to-primary/40"></div>
            </div>
        @else
            <!-- Background Image Carousel -->
            <div class="absolute inset-0 z-0">
                <div class="hero-carousel h-full">
                    @foreach (['assets/IMG_7144.JPG', 'assets/IMG_7139.JPG', 'assets/IMG_7141.JPG'] as $index => $image)
                        <div class="hero-slide absolute inset-0 opacity-0 transition-opacity duration-1500 ease-in-out bg-center bg-cover"
                            style="background-image: url('{{ asset($image) }}')">
                            <div class="absolute inset-0 bg-gradient-to-r from-primary-dark/70 to-primary/40"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Animated Shapes -->
        <div class="absolute inset-0 z-10 pointer-events-none overflow-hidden">
            <div class="absolute top-24 left-10 w-32 h-32 bg-secondary/20 rounded-full filter blur-xl animate-pulse">
            </div>
            <div class="absolute bottom-24 right-10 w-40 h-40 bg-accent/20 rounded-full filter blur-xl animate-pulse"
                style="animation-delay: 1s;"></div>
            <div class="absolute top-1/3 right-1/4 w-24 h-24 bg-primary-light/20 rounded-full filter blur-xl animate-pulse"
                style="animation-delay: 2s;"></div>

            <!-- Add floating geometric elements -->
            <div class="absolute top-1/4 right-1/5 w-16 h-16 bg-white/10 rounded-md rotate-12 animate-float"
                style="animation-delay: 0.5s;"></div>
            <div class="absolute bottom-1/3 left-1/4 w-12 h-12 bg-secondary/10 rounded-full animate-float"
                style="animation-delay: 1.5s;"></div>
            <div class="absolute top-2/3 right-1/3 w-20 h-20 border-2 border-white/20 rounded-lg rotate-45 animate-float"
                style="animation-delay: 2s;"></div>
        </div>

        <!-- Hero Content -->
        <div class="container relative z-20 mx-auto px-4 py-20">
            <div class="max-w-3xl" data-aos="fade-right" data-aos-duration="1000">
                <h1 class="font-heading font-extrabold text-4xl sm:text-5xl lg:text-7xl mb-6 text-white leading-tight">
                    <span class="block">{{ $heroTitle }}</span>
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-white/90 leading-relaxed">{{ $heroSubtitle }}</p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="#" class="btn btn-secondary text-center">
                        <span>Explore Projects</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                    <a href="{{ route('quote') }}"
                        class="btn border-2 border-white text-white hover:bg-white hover:text-primary-dark text-center">
                        <span>Get a Quote</span>
                        <i class="fas fa-file-invoice ml-2"></i>
                    </a>
                </div>

                <!-- Scroll indicator -->
                <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 hidden md:block">
                    <div class="animate-bounce">
                        <a href="#company-pillars" class="text-white flex flex-col items-center">
                            <span class="text-xs mb-2">Scroll Down</span>
                            <i class="fas fa-chevron-down"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Floating achievement badges -->
            <div class="hidden lg:block absolute right-10 top-1/2 transform -translate-y-1/2 space-y-6">
                <div class="bg-white/10 backdrop-blur-md p-4 rounded-xl shadow-lg animate-float"
                    style="animation-delay: 0.7s;">
                    <div class="flex items-center">
                        <div class="bg-secondary/20 p-2 rounded-full mr-3">
                            <i class="fas fa-award text-secondary"></i>
                        </div>
                        <div>
                            <p class="text-white font-semibold">Award Winning</p>
                            <p class="text-white/80 text-sm">Design Excellence</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white/10 backdrop-blur-md p-4 rounded-xl shadow-lg animate-float"
                    style="animation-delay: 1.2s;">
                    <div class="flex items-center">
                        <div class="bg-accent/20 p-2 rounded-full mr-3">
                            <i class="fas fa-leaf text-accent"></i>
                        </div>
                        <div>
                            <p class="text-white font-semibold">Eco Friendly</p>
                            <p class="text-white/80 text-sm">Sustainable Construction</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white/10 backdrop-blur-md p-4 rounded-xl shadow-lg animate-float"
                    style="animation-delay: 1.7s;">
                    <div class="flex items-center">
                        <div class="bg-secondary/20 p-2 rounded-full mr-3">
                            <i class="fas fa-clock text-secondary"></i>
                        </div>
                        <div>
                            <p class="text-white font-semibold">On Time</p>
                            <p class="text-white/80 text-sm">Project Delivery</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Company Pillars Section -->
    <section id="company-pillars" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <span class="text-secondary text-sm uppercase tracking-widest font-medium mb-2 block"
                    data-aos="fade-down">OUR CORE VALUES</span>
                <h2 class="font-heading font-bold text-3xl md:text-4xl lg:text-5xl mb-4" data-aos="fade-up">Building on
                    Strong Foundations</h2>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    At Akstruct Construction Ltd, our foundation is built on principles that drive excellence in every
                    project.
                    These values define who we are and how we deliver for our clients.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Sustainability Pillar -->
                <div class="group" data-aos="fade-up" data-aos-delay="100">
                    <div class="card h-full overflow-hidden transform transition-all duration-500 hover:-translate-y-2">
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ asset('assets/img/core-values/sustainability.jpg') }}" alt="Sustainability"
                                class="w-full h-full object-cover transform transition-all duration-500 group-hover:scale-110">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-primary-dark/80 to-transparent opacity-90">
                            </div>
                            <div class="absolute inset-0 flex items-end p-6">
                                <div>
                                    <div
                                        class="inline-flex items-center justify-center p-3 rounded-xl bg-white/90 backdrop-blur-sm text-primary mb-4 shadow-lg">
                                        <i class="fas fa-leaf text-3xl"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold text-white mb-2">Sustainability</h3>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 bg-white">
                            <p class="text-gray-600">Every project reflects our commitment to environmental
                                responsibility and long-term resilience. We prioritize green building practices, waste
                                reduction, and minimizing carbon footprint.</p>
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    <span>Eco-friendly materials</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-500 mt-2">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    <span>Energy-efficient designs</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-500 mt-2">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    <span>Reduced carbon footprint</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Innovation Pillar -->
                <div class="group" data-aos="fade-up" data-aos-delay="200">
                    <div
                        class="card h-full overflow-hidden transform transition-all duration-500 hover:-translate-y-2">
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ asset('assets/img/core-values/innovation.jpg') }}" alt="Innovation"
                                class="w-full h-full object-cover transform transition-all duration-500 group-hover:scale-110">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-primary-dark/80 to-transparent opacity-90">
                            </div>
                            <div class="absolute inset-0 flex items-end p-6">
                                <div>
                                    <div
                                        class="inline-flex items-center justify-center p-3 rounded-xl bg-white/90 backdrop-blur-sm text-primary mb-4 shadow-lg">
                                        <i class="fas fa-lightbulb text-3xl"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold text-white mb-2">Innovation</h3>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 bg-white">
                            <p class="text-gray-600">We embrace cutting-edge technologies and creative solutions to
                                build smarter, more sustainable infrastructures that meet the challenges of today and
                                tomorrow.</p>
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                                    <span>Cutting-edge technologies</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-500 mt-2">
                                    <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                                    <span>Smart building systems</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-500 mt-2">
                                    <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                                    <span>Creative problem-solving</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Professionalism Pillar -->
                <div class="group" data-aos="fade-up" data-aos-delay="300">
                    <div
                        class="card h-full overflow-hidden transform transition-all duration-500 hover:-translate-y-2">
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ asset('assets/img/core-values/professionalism.jpg') }}" alt="Professionalism"
                                class="w-full h-full object-cover transform transition-all duration-500 group-hover:scale-110">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-primary-dark/80 to-transparent opacity-90">
                            </div>
                            <div class="absolute inset-0 flex items-end p-6">
                                <div>
                                    <div
                                        class="inline-flex items-center justify-center p-3 rounded-xl bg-white/90 backdrop-blur-sm text-primary mb-4 shadow-lg">
                                        <i class="fas fa-handshake text-3xl"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold text-white mb-2">Professionalism</h3>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 bg-white">
                            <p class="text-gray-600">We uphold the highest standards of expertise, ethics, and
                                accountability in all aspects of our work, ensuring exceptional quality and client
                                satisfaction.</p>
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-check-circle text-amber-500 mr-2"></i>
                                    <span>Highest industry standards</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-500 mt-2">
                                    <i class="fas fa-check-circle text-amber-500 mr-2"></i>
                                    <span>Expert team leadership</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-500 mt-2">
                                    <i class="fas fa-check-circle text-amber-500 mr-2"></i>
                                    <span>Strict HSE adherence</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Value Pillars -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mt-10">
                <!-- Integrity & Confidentiality Pillar -->
                <div class="group" data-aos="fade-up" data-aos-delay="400">
                    <div
                        class="card h-full overflow-hidden transform transition-all duration-500 hover:-translate-y-2">
                        <div class="relative h-40 overflow-hidden">
                            <img src="{{ asset('assets/img/core-values/integrity.jpg') }}"
                                alt="Integrity and Confidentiality"
                                class="w-full h-full object-cover transform transition-all duration-500 group-hover:scale-110">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-primary-dark/80 to-transparent opacity-90">
                            </div>
                            <div class="absolute inset-0 flex items-end p-6">
                                <div>
                                    <div
                                        class="inline-flex items-center justify-center p-3 rounded-xl bg-white/90 backdrop-blur-sm text-primary mb-4 shadow-lg">
                                        <i class="fas fa-shield-alt text-3xl"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold text-white mb-2">Integrity & Confidentiality</h3>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 bg-white">
                            <p class="text-gray-600">Honesty and transparency guide our actions, with strict
                                confidentiality to protect client trust and sensitive information.</p>
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-check-circle text-purple-500 mr-2"></i>
                                    <span>Transparent business practices</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-500 mt-2">
                                    <i class="fas fa-check-circle text-purple-500 mr-2"></i>
                                    <span>Client data protection</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Collaboration Pillar -->
                <div class="group" data-aos="fade-up" data-aos-delay="500">
                    <div
                        class="card h-full overflow-hidden transform transition-all duration-500 hover:-translate-y-2">
                        <div class="relative h-40 overflow-hidden">
                            <img src="{{ asset('assets/img/core-values/collaboration.jpg') }}" alt="Collaboration"
                                class="w-full h-full object-cover transform transition-all duration-500 group-hover:scale-110">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-primary-dark/80 to-transparent opacity-90">
                            </div>
                            <div class="absolute inset-0 flex items-end p-6">
                                <div>
                                    <div
                                        class="inline-flex items-center justify-center p-3 rounded-xl bg-white/90 backdrop-blur-sm text-primary mb-4 shadow-lg">
                                        <i class="fas fa-users text-3xl"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold text-white mb-2">Collaboration</h3>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 bg-white">
                            <p class="text-gray-600">Success is a team effort—we work closely with clients, partners,
                                and communities to achieve shared goals and create lasting value.</p>
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-check-circle text-teal-500 mr-2"></i>
                                    <span>Stakeholder engagement</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-500 mt-2">
                                    <i class="fas fa-check-circle text-teal-500 mr-2"></i>
                                    <span>Cross-functional teamwork</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section with Parallax -->
    <section class="py-20 relative overflow-hidden bg-stone">
        <div class="absolute inset-0 z-0 opacity-10 bg-pattern"
            style="background-image: url('{{ asset('assets/img/pattern.svg') }}');"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Column with Image -->
                <div class="relative" data-aos="fade-right">
                    <div class="absolute -top-4 -left-4 w-24 h-24 bg-secondary/20 rounded-lg"></div>
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-accent/20 rounded-lg"></div>
                    <div class="relative z-10 rounded-xl overflow-hidden shadow-lg">
                        <img src="{{ asset('assets/IMG_6292.JPG') }}" alt="Akstruct Construction"
                            class="w-full h-auto">
                    </div>
                </div>

                <!-- Right Column with Text -->
                <div data-aos="fade-left">
                    <span class="text-secondary text-sm uppercase tracking-widest font-medium mb-2 block">ABOUT
                        AKSTRUCT</span>
                    <h2 class="font-heading font-bold text-3xl md:text-4xl mb-6">Building Excellence Since <span
                            class="text-secondary">{{ date('Y') - $yearsExperience }}</span></h2>
                    <p class="text-gray-700 mb-6">
                        At Akstruct Construction Limited, we are committed to delivering top-notch professional
                        engineering solutions that prioritize sustainability, innovation, and excellence. With a mission
                        to actively contribute to professional engineering and construction practices, we collaborate
                        with forward-thinking organizations, institutions, and private sector stakeholders.
                    </p>
                    <p class="text-gray-700 mb-8">
                        We deliver high-quality, cost-efficient infrastructure solutions—optimizing timelines without
                        compromising excellence. Our vision is to ensure sustainable infrastructures are attained,
                        shaping a better future for generations to come.
                    </p>

                    <div class="grid grid-cols-2 gap-6 mb-8">
                        <div class="flex items-center">
                            <div class="text-secondary mr-3">
                                <i class="fas fa-check-circle text-2xl"></i>
                            </div>
                            <span class="font-medium">Professional Team</span>
                        </div>
                        <div class="flex items-center">
                            <div class="text-secondary mr-3">
                                <i class="fas fa-check-circle text-2xl"></i>
                            </div>
                            <span class="font-medium">Innovative Solutions</span>
                        </div>
                        <div class="flex items-center">
                            <div class="text-secondary mr-3">
                                <i class="fas fa-check-circle text-2xl"></i>
                            </div>
                            <span class="font-medium">Sustainable Practices</span>
                        </div>
                        <div class="flex items-center">
                            <div class="text-secondary mr-3">
                                <i class="fas fa-check-circle text-2xl"></i>
                            </div>
                            <span class="font-medium">Quality Assurance</span>
                        </div>
                    </div>

                    <a href="{{ route('about') }}" class="btn btn-primary">
                        <span>Learn More About Us</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section with Modern Card Design -->
    <section class="py-20 bg-white relative overflow-hidden">
        <!-- Background elements -->
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-stone/50 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-60 h-60 bg-secondary/10 rounded-full blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <span class="text-secondary text-sm uppercase tracking-widest font-medium mb-2 block"
                    data-aos="fade-down">WHAT WE OFFER</span>
                <h2 class="font-heading font-bold text-3xl md:text-4xl lg:text-5xl mb-4" data-aos="fade-up">Our
                    Services</h2>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Comprehensive construction and engineering solutions tailored to your specific needs
                </p>
            </div>

            <!-- Services in a visually engaging format -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Left column with featured image -->
                <div class="lg:col-span-1" data-aos="fade-right">
                    <div class="relative h-full rounded-2xl overflow-hidden shadow-xl">
                        <img src="{{ asset('assets/IMG_7150.JPG') }}" alt="Akstruct Construction Services"
                            class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-primary-dark/90 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-8 text-white">
                            <h3 class="text-2xl font-bold mb-2">Comprehensive Solutions</h3>
                            <p class="mb-4">From design to completion, we deliver end-to-end construction excellence
                            </p>
                            <div class="flex items-center">
                                <div class="flex -space-x-2">
                                    <img src="{{ asset('assets/img/team/team1.jpg') }}" alt="Team Member"
                                        class="w-10 h-10 rounded-full border-2 border-white">
                                    <img src="{{ asset('assets/img/team/team2.jpg') }}" alt="Team Member"
                                        class="w-10 h-10 rounded-full border-2 border-white">
                                    <img src="{{ asset('assets/img/team/team3.jpg') }}" alt="Team Member"
                                        class="w-10 h-10 rounded-full border-2 border-white">
                                </div>
                                <span class="ml-3">Expert Team</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right column with service cards -->
                <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Construction Management -->
                    <div class="service-card group" data-aos="fade-up" data-aos-delay="100">
                        <div
                            class="rounded-xl overflow-hidden bg-white border border-gray-100 shadow-lg hover:shadow-xl transition-all duration-300 h-full flex flex-col">
                            <!-- Service Image Header -->
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ asset('assets/img/services/service-1.jpg') }}"
                                    alt="Construction Management"
                                    class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-primary/80 to-primary/10 opacity-90">
                                </div>
                                <div class="absolute bottom-0 left-0 p-4">
                                    <!-- Service Icon in a circle -->
                                    <div
                                        class="bg-white/90 backdrop-blur-sm text-primary h-14 w-14 rounded-full flex items-center justify-center text-xl transform -translate-y-1/2 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                                        <i class="fas fa-hard-hat"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Service Content -->
                            <div class="p-6 flex flex-col flex-grow">
                                <h3
                                    class="text-xl font-bold mb-3 group-hover:text-secondary transition-colors duration-300 flex items-center">
                                    Construction Management
                                </h3>
                                <p class="text-gray-600 mb-4 flex-grow">We provide end-to-end construction management
                                    services, ensuring projects are completed on time, within budget, and to the highest
                                    standards.</p>

                                <!-- Features List -->
                                <div class="mb-4">
                                    <div class="flex items-center mb-1 text-sm">
                                        <i class="fas fa-check-circle text-secondary mr-2"></i>
                                        <span>Project planning & scheduling</span>
                                    </div>
                                    <div class="flex items-center mb-1 text-sm">
                                        <i class="fas fa-check-circle text-secondary mr-2"></i>
                                        <span>Resource optimization</span>
                                    </div>
                                    <div class="flex items-center mb-1 text-sm">
                                        <i class="fas fa-check-circle text-secondary mr-2"></i>
                                        <span>Quality control</span>
                                    </div>
                                </div>

                                <a href="{{ route('services') }}"
                                    class="mt-auto inline-flex items-center text-secondary font-medium hover:text-primary-dark group">
                                    <span>Learn More</span>
                                    <i
                                        class="fas fa-arrow-right ml-2 transform transition-transform duration-300 group-hover:translate-x-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Sustainable Design and Build -->
                    <div class="service-card group" data-aos="fade-up" data-aos-delay="200">
                        <div
                            class="rounded-xl overflow-hidden bg-white border border-gray-100 shadow-lg hover:shadow-xl transition-all duration-300 h-full flex flex-col">
                            <!-- Service Image Header -->
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ asset('assets/img/services/service-2.jpg') }}" alt="Sustainable Design"
                                    class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-primary/80 to-primary/10 opacity-90">
                                </div>
                                <div class="absolute bottom-0 left-0 p-4">
                                    <!-- Service Icon in a circle -->
                                    <div
                                        class="bg-white/90 backdrop-blur-sm text-primary h-14 w-14 rounded-full flex items-center justify-center text-xl transform -translate-y-1/2 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                                        <i class="fas fa-leaf"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Service Content -->
                            <div class="p-6 flex flex-col flex-grow">
                                <h3
                                    class="text-xl font-bold mb-3 group-hover:text-secondary transition-colors duration-300 flex items-center">
                                    Sustainable Design and Build
                                </h3>
                                <p class="text-gray-600 mb-4 flex-grow">Our services focus on creating
                                    energy-efficient, environmentally friendly structures aligned with global
                                    sustainability goals.</p>

                                <!-- Features List -->
                                <div class="mb-4">
                                    <div class="flex items-center mb-1 text-sm">
                                        <i class="fas fa-check-circle text-secondary mr-2"></i>
                                        <span>Eco-friendly materials</span>
                                    </div>
                                    <div class="flex items-center mb-1 text-sm">
                                        <i class="fas fa-check-circle text-secondary mr-2"></i>
                                        <span>Energy efficiency</span>
                                    </div>
                                    <div class="flex items-center mb-1 text-sm">
                                        <i class="fas fa-check-circle text-secondary mr-2"></i>
                                        <span>Green building certification</span>
                                    </div>
                                </div>

                                <a href="{{ route('services') }}"
                                    class="mt-auto inline-flex items-center text-secondary font-medium hover:text-primary-dark group">
                                    <span>Learn More</span>
                                    <i
                                        class="fas fa-arrow-right ml-2 transform transition-transform duration-300 group-hover:translate-x-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Real Estate Development -->
                    <div class="service-card group" data-aos="fade-up" data-aos-delay="300">
                        <div
                            class="rounded-xl overflow-hidden bg-white border border-gray-100 shadow-lg hover:shadow-xl transition-all duration-300 h-full flex flex-col">
                            <!-- Service Image Header -->
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ asset('assets/img/services/service-3.jpg') }}"
                                    alt="Real Estate Development"
                                    class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-primary/80 to-primary/10 opacity-90">
                                </div>
                                <div class="absolute bottom-0 left-0 p-4">
                                    <!-- Service Icon in a circle -->
                                    <div
                                        class="bg-white/90 backdrop-blur-sm text-primary h-14 w-14 rounded-full flex items-center justify-center text-xl transform -translate-y-1/2 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                                        <i class="fas fa-building"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Service Content -->
                            <div class="p-6 flex flex-col flex-grow">
                                <h3
                                    class="text-xl font-bold mb-3 group-hover:text-secondary transition-colors duration-300 flex items-center">
                                    Real Estate Development
                                </h3>
                                <p class="text-gray-600 mb-4 flex-grow">From residential complexes to commercial hubs,
                                    we combine innovative design with sustainable construction practices.</p>

                                <!-- Features List -->
                                <div class="mb-4">
                                    <div class="flex items-center mb-1 text-sm">
                                        <i class="fas fa-check-circle text-secondary mr-2"></i>
                                        <span>Property development</span>
                                    </div>
                                    <div class="flex items-center mb-1 text-sm">
                                        <i class="fas fa-check-circle text-secondary mr-2"></i>
                                        <span>Land acquisition</span>
                                    </div>
                                    <div class="flex items-center mb-1 text-sm">
                                        <i class="fas fa-check-circle text-secondary mr-2"></i>
                                        <span>Market analysis</span>
                                    </div>
                                </div>

                                <a href="{{ route('services') }}"
                                    class="mt-auto inline-flex items-center text-secondary font-medium hover:text-primary-dark group">
                                    <span>Learn More</span>
                                    <i
                                        class="fas fa-arrow-right ml-2 transform transition-transform duration-300 group-hover:translate-x-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Engineering Solutions -->
                    <div class="service-card group" data-aos="fade-up" data-aos-delay="400">
                        <div
                            class="rounded-xl overflow-hidden bg-white border border-gray-100 shadow-lg hover:shadow-xl transition-all duration-300 h-full flex flex-col">
                            <!-- Service Image Header -->
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ asset('assets/img/services/service-4.jpg') }}"
                                    alt="Engineering Solutions"
                                    class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-primary/80 to-primary/10 opacity-90">
                                </div>
                                <div class="absolute bottom-0 left-0 p-4">
                                    <!-- Service Icon in a circle -->
                                    <div
                                        class="bg-white/90 backdrop-blur-sm text-primary h-14 w-14 rounded-full flex items-center justify-center text-xl transform -translate-y-1/2 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                                        <i class="fas fa-cogs"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Service Content -->
                            <div class="p-6 flex flex-col flex-grow">
                                <h3
                                    class="text-xl font-bold mb-3 group-hover:text-secondary transition-colors duration-300 flex items-center">
                                    Engineering Solutions
                                </h3>
                                <p class="text-gray-600 mb-4 flex-grow">We specialize in structural, mechanical, and
                                    electrical engineering services that are both functional and sustainable.</p>

                                <!-- Features List -->
                                <div class="mb-4">
                                    <div class="flex items-center mb-1 text-sm">
                                        <i class="fas fa-check-circle text-secondary mr-2"></i>
                                        <span>Structural engineering</span>
                                    </div>
                                    <div class="flex items-center mb-1 text-sm">
                                        <i class="fas fa-check-circle text-secondary mr-2"></i>
                                        <span>MEP systems design</span>
                                    </div>
                                    <div class="flex items-center mb-1 text-sm">
                                        <i class="fas fa-check-circle text-secondary mr-2"></i>
                                        <span>Technical consulting</span>
                                    </div>
                                </div>

                                <a href="{{ route('services') }}"
                                    class="mt-auto inline-flex items-center text-secondary font-medium hover:text-primary-dark group">
                                    <span>Learn More</span>
                                    <i
                                        class="fas fa-arrow-right ml-2 transform transition-transform duration-300 group-hover:translate-x-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-16 bg-stone rounded-2xl p-8 shadow-lg" data-aos="fade-up">
                <h3 class="text-center text-3xl font-bold mb-10">Our Process</h3>

                <div class="relative">
                    <!-- Progress Line -->
                    <div class="absolute hidden md:block left-0 right-0 top-16 h-1 bg-gray-200 z-0">
                        <div class="absolute left-0 h-full bg-secondary w-1/3 transition-all duration-1000"
                            id="process-progress"></div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                        <!-- Process Steps -->
                        <div class="text-center relative z-10" data-aos="fade-right">
                            <div
                                class="w-20 h-20 rounded-full bg-primary text-white flex items-center justify-center text-2xl font-bold mx-auto mb-4 transform transition-transform duration-300 hover:scale-110 shadow-lg">
                                01</div>
                            <h4 class="text-xl font-bold mb-3 text-primary">Consultation & Planning</h4>
                            <p class="text-gray-600">Understanding your vision, requirements, and budget to develop a
                                detailed project plan that aligns with your goals.</p>
                            <div class="mt-4">
                                <div class="flex items-center justify-center">
                                    <div
                                        class="bg-primary/10 rounded-full w-9 h-9 flex items-center justify-center mr-2">
                                        <i class="fas fa-comments text-primary"></i>
                                    </div>
                                    <span class="text-sm font-medium">Personalized Approach</span>
                                </div>
                            </div>
                        </div>

                        <div class="text-center relative z-10" data-aos="fade-up" data-aos-delay="100">
                            <div
                                class="w-20 h-20 rounded-full bg-primary text-white flex items-center justify-center text-2xl font-bold mx-auto mb-4 transform transition-transform duration-300 hover:scale-110 shadow-lg">
                                02</div>
                            <h4 class="text-xl font-bold mb-3 text-primary">Design & Engineering</h4>
                            <p class="text-gray-600">Creating sustainable designs that align with goals and comply with
                                regulatory standards, with expert engineering solutions.</p>
                            <div class="mt-4">
                                <div class="flex items-center justify-center">
                                    <div
                                        class="bg-primary/10 rounded-full w-9 h-9 flex items-center justify-center mr-2">
                                        <i class="fas fa-drafting-compass text-primary"></i>
                                    </div>
                                    <span class="text-sm font-medium">Innovative Design</span>
                                </div>
                            </div>
                        </div>

                        <div class="text-center relative z-10" data-aos="fade-left" data-aos-delay="200">
                            <div
                                class="w-20 h-20 rounded-full bg-primary text-white flex items-center justify-center text-2xl font-bold mx-auto mb-4 transform transition-transform duration-300 hover:scale-110 shadow-lg">
                                03</div>
                            <h4 class="text-xl font-bold mb-3 text-primary">Construction & Delivery</h4>
                            <p class="text-gray-600">Executing with precision using modern equipment and sustainable
                                practices, with rigorous quality checks and on-time delivery.</p>
                            <div class="mt-4">
                                <div class="flex items-center justify-center">
                                    <div
                                        class="bg-primary/10 rounded-full w-9 h-9 flex items-center justify-center mr-2">
                                        <i class="fas fa-hard-hat text-primary"></i>
                                    </div>
                                    <span class="text-sm font-medium">Quality Assurance</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-12 text-center">
                    <a href="{{ route('services') }}" class="btn btn-primary">
                        <span>Learn About Our Services</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Projects Section with Hover Effects -->
    <section class="py-20 bg-stone relative overflow-hidden">
        <!-- Background pattern for visual interest -->
        <div class="absolute inset-0 bg-pattern opacity-5 z-0"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <span class="text-secondary text-sm uppercase tracking-widest font-medium mb-2 block"
                    data-aos="fade-down">OUR WORK</span>
                <h2 class="font-heading font-bold text-3xl md:text-4xl lg:text-5xl mb-4" data-aos="fade-up">Featured
                    Projects</h2>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Explore our showcase of sustainable construction excellence across Nigeria
                </p>
            </div>

            <!-- Decorative element -->
            <div class="absolute -left-20 top-1/3 w-40 h-40 bg-secondary/10 rounded-full blur-3xl z-0"></div>
            <div class="absolute -right-20 bottom-1/3 w-40 h-40 bg-accent/10 rounded-full blur-3xl z-0"></div>

            <!-- Projects Gallery -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                @php $delay = 0; @endphp

                <!-- Feature the first project more prominently -->
                @if (isset($featuredProjects[0]))
                    @php $project = $featuredProjects[0]; @endphp
                    <div class="md:col-span-8 relative group overflow-hidden rounded-xl shadow-xl" data-aos="fade-up"
                        data-aos-delay="{{ $delay }}">
                        <div class="aspect-[16/9] overflow-hidden">
                            <img src="{{ asset('assets/IMG_7147.jpg') }}" alt="{{ $project->title }}"
                                class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-110">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-primary-dark/95 via-primary-dark/80 to-transparent opacity-80 group-hover:opacity-90 transition-all duration-500">
                            </div>
                        </div>
                        <div
                            class="absolute inset-0 p-6 flex flex-col justify-end text-white transition-transform duration-500 translate-y-4 group-hover:translate-y-0">
                            <div
                                class="transform transition-transform duration-500 translate-y-4 group-hover:translate-y-0">
                                <div
                                    class="bg-accent inline-block px-3 py-1 text-sm font-semibold rounded mb-3 shadow-md">
                                    {{ $project->category }}</div>
                                <h3 class="text-2xl font-bold mb-2 text-white drop-shadow-md">{{ $project->title }}
                                </h3>
                                <p class="mb-4 text-white/90 drop-shadow-md line-clamp-2">
                                    {{ Str::limit($project->description, 120) }}</p>
                            </div>
                            <div
                                class="flex justify-between items-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                <div class="flex space-x-4 text-sm text-white">
                                    <span
                                        class="flex items-center bg-primary-dark/50 backdrop-blur-sm px-2 py-1 rounded"><i
                                            class="fas fa-map-marker-alt mr-1"></i>
                                        {{ $project->location }}</span>
                                    <span
                                        class="flex items-center bg-primary-dark/50 backdrop-blur-sm px-2 py-1 rounded"><i
                                            class="fas fa-calendar mr-1"></i>
                                        {{ $project->year }}</span>
                                </div>
                                <a href="{{ isset($project) && $project->slug ? route('projects.show', $project) : '#' }}"
                                    class="btn btn-secondary btn-sm shadow-lg hover:shadow-xl">View Project</a>
                            </div>
                        </div>
                    </div>
                    @php $delay += 100; @endphp
                @endif

                <div class="md:col-span-4 flex flex-col space-y-6">
                    @if (isset($featuredProjects[1]))
                        @php $project = $featuredProjects[1]; @endphp
                        <div class="relative group overflow-hidden rounded-xl shadow-xl h-full" data-aos="fade-up"
                            data-aos-delay="{{ $delay }}">
                            <div class="aspect-[4/3] h-full overflow-hidden">
                                <img src="{{ asset('assets/IMG_7145.jpg') }}" alt="{{ $project->title }}"
                                    class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-110">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-primary-dark/95 via-primary-dark/80 to-transparent opacity-80 group-hover:opacity-90 transition-all duration-500">
                                </div>
                            </div>
                            <div class="absolute inset-0 p-4 flex flex-col justify-end text-white">
                                <div
                                    class="transform transition-transform duration-500 translate-y-4 group-hover:translate-y-0">
                                    <div
                                        class="bg-accent inline-block px-2 py-0.5 text-xs font-semibold rounded mb-2 shadow-md">
                                        {{ $project->category }}</div>
                                    <h3 class="text-xl font-bold mb-1 text-white drop-shadow-md">{{ $project->title }}
                                    </h3>
                                    <p class="text-sm text-white/90 drop-shadow-md mb-2 line-clamp-2">
                                        {{ Str::limit($project->description, 60) }}</p>
                                    <a href="{{ isset($project) && $project->slug ? route('projects.show', $project) : '#' }}"
                                        class="text-secondary font-medium hover:text-white inline-flex items-center text-sm bg-primary-dark/50 backdrop-blur-sm px-3 py-1 rounded shadow-md">
                                        View Details <i class="fas fa-arrow-right ml-1 text-xs"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @php $delay += 100; @endphp
                    @endif
                </div>

                <!-- Additional projects in a row below -->
                <div class="md:col-span-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-0">
                    @if (isset($featuredProjects[2]))
                        @php $project = $featuredProjects[2]; @endphp
                        <div class="project-card rounded-xl shadow-xl overflow-hidden group" data-aos="fade-up"
                            data-aos-delay="{{ $delay }}">
                            <div class="relative h-72 overflow-hidden">
                                <img src="{{ asset('assets/IMG_7140.jpg') }}" alt="{{ $project->title }}"
                                    class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-110">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-primary-dark/95 via-primary-dark/80 to-transparent opacity-80 group-hover:opacity-90 transition-all duration-500">
                                </div>
                                <div class="absolute inset-0 flex flex-col justify-end p-6">
                                    <div
                                        class="transform transition-transform duration-500 translate-y-4 group-hover:translate-y-0">
                                        <div
                                            class="bg-accent inline-block px-3 py-1 text-sm font-semibold rounded mb-3 shadow-md">
                                            {{ $project->category }}</div>
                                        <h3 class="text-xl font-bold mb-2 text-white drop-shadow-md">
                                            {{ $project->title }}</h3>
                                        <p class="mb-4 text-white/90 drop-shadow-md line-clamp-2">
                                            {{ Str::limit($project->description, 100) }}</p>
                                        <a href="{{ isset($project) && $project->slug ? route('projects.show', $project) : '#' }}"
                                            class="btn btn-secondary btn-sm shadow-lg hover:shadow-xl">
                                            View Project
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php $delay += 100; @endphp
                    @endif

                    <!-- Immersive Project Preview -->
                    <div class="relative group rounded-xl shadow-xl overflow-hidden" data-aos="fade-up"
                        data-aos-delay="{{ $delay }}">
                        <div class="relative h-72 overflow-hidden bg-primary-dark">
                            <!-- Video preview with autoplay on hover -->
                            <video
                                class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity duration-500"
                                muted loop poster="{{ asset('assets/IMG_7143.JPG') }}" onmouseover="this.play()"
                                onmouseout="this.pause()">
                                <source src="{{ asset('assets/Akstruct (Guzape site).MP4') }}" type="video/mp4">
                            </video>
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-primary-dark/90 to-transparent opacity-60 group-hover:opacity-40 transition-all duration-500">
                            </div>
                            <div class="absolute inset-0 p-6 flex flex-col justify-end text-white">
                                <h3 class="text-xl font-bold mb-2">Site Walkthrough</h3>
                                <p class="mb-4 text-sm">Experience our active construction sites through immersive
                                    footage</p>
                                <a href="#"
                                    class="inline-flex items-center text-secondary font-medium hover:text-white text-sm">
                                    <span>View Projects</span>
                                    <i class="fas fa-cube ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Interactive Project Map -->
                    <div class="relative group rounded-xl shadow-xl overflow-hidden" data-aos="fade-up"
                        data-aos-delay="{{ $delay + 100 }}">
                        <div class="relative h-72 overflow-hidden">
                            <img src="{{ asset('assets/IMG_7143.JPG') }}" alt="Project Locations"
                                class="w-full h-full object-cover">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-primary-dark/90 to-transparent opacity-60 group-hover:opacity-40 transition-all duration-500">
                            </div>
                            <div class="absolute inset-0">
                                <!-- Project location markers -->
                                <div class="absolute top-1/4 left-1/3 w-4 h-4 bg-accent rounded-full animate-ping">
                                </div>
                                <div class="absolute top-1/3 right-1/4 w-4 h-4 bg-secondary rounded-full animate-ping"
                                    style="animation-delay: 0.5s"></div>
                                <div class="absolute bottom-1/3 left-2/5 w-4 h-4 bg-accent rounded-full animate-ping"
                                    style="animation-delay: 1s"></div>
                            </div>
                            <div class="absolute inset-0 p-6 flex flex-col justify-end text-white">
                                <h3 class="text-xl font-bold mb-2">Our Project Sites</h3>
                                <p class="mb-4 text-sm">Explore our current and completed projects across Nigeria</p>
                                <a href="#"
                                    class="inline-flex items-center text-secondary font-medium hover:text-white text-sm">
                                    <span>View All Projects</span>
                                    <i class="fas fa-map-marked-alt ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12" data-aos="fade-up">
                <a href="#" class="btn btn-primary">
                    <span>Explore All Projects</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Statistics Section with Counter Animation -->
    <section class="py-20 bg-primary-dark text-white relative overflow-hidden">
        <!-- Abstract background patterns -->
        <div class="absolute inset-0 z-0">
            <div class="absolute top-0 right-0 w-96 h-96 bg-primary/30 rounded-full filter blur-3xl opacity-20"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-secondary/30 rounded-full filter blur-3xl opacity-20">
            </div>
            <div class="absolute top-1/2 left-1/3 w-64 h-64 bg-accent/20 rounded-full filter blur-3xl opacity-20">
            </div>
        </div>
        <div class="absolute inset-0 bg-pattern opacity-10 z-0"
            style="background-image: url('{{ asset('assets/img/pattern.svg') }}');"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-12">
                <span class="text-secondary text-sm uppercase tracking-widest font-medium mb-2 block"
                    data-aos="fade-down">OUR ACHIEVEMENTS</span>
                <h2 class="font-heading font-bold text-3xl md:text-4xl lg:text-5xl mb-4" data-aos="fade-up">Making an
                    Impact</h2>
            </div>

            <div class="max-w-5xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Projects Completed -->
                    <div class="stat-card group relative" data-aos="fade-up" data-aos-delay="100">
                        <div
                            class="bg-primary-light/10 backdrop-blur-lg p-8 rounded-2xl border border-white/10 shadow-xl h-full transition-all duration-500 transform group-hover:scale-105 group-hover:bg-primary-light/20">
                            <!-- Decorative element -->
                            <div
                                class="absolute -bottom-4 -right-4 w-24 h-24 bg-secondary/10 rounded-full blur-xl group-hover:bg-secondary/20 transition-colors duration-500">
                            </div>

                            <div class="flex items-center justify-center mb-6">
                                <div
                                    class="h-20 w-20 rounded-xl bg-gradient-to-br from-primary to-primary-light flex items-center justify-center shadow-lg transform transition-transform duration-500 group-hover:rotate-6">
                                    <i class="fas fa-building text-3xl text-white"></i>
                                </div>
                            </div>
                            <div class="text-6xl font-bold text-center mb-2 bg-clip-text text-transparent bg-gradient-to-r from-secondary to-secondary-light"
                                data-counter>{{ $projectsCompleted }}</div>
                            <p class="text-xl text-center font-medium text-white/90">Projects Completed</p>

                            <div class="mt-4 pt-4 border-t border-white/10">
                                <div class="text-sm text-white/70 text-center">
                                    Delivering excellence across Nigeria
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Satisfied Clients -->
                    <div class="stat-card group relative" data-aos="fade-up" data-aos-delay="200">
                        <div
                            class="bg-primary-light/10 backdrop-blur-lg p-8 rounded-2xl border border-white/10 shadow-xl h-full transition-all duration-500 transform group-hover:scale-105 group-hover:bg-primary-light/20">
                            <!-- Decorative element -->
                            <div
                                class="absolute -bottom-4 -right-4 w-24 h-24 bg-accent/10 rounded-full blur-xl group-hover:bg-accent/20 transition-colors duration-500">
                            </div>

                            <div class="flex items-center justify-center mb-6">
                                <div
                                    class="h-20 w-20 rounded-xl bg-gradient-to-br from-accent to-accent-light flex items-center justify-center shadow-lg transform transition-transform duration-500 group-hover:rotate-6">
                                    <i class="fas fa-smile text-3xl text-white"></i>
                                </div>
                            </div>
                            <div class="text-6xl font-bold text-center mb-2 bg-clip-text text-transparent bg-gradient-to-r from-accent to-accent-light"
                                data-counter>{{ $happyClients }}</div>
                            <p class="text-xl text-center font-medium text-white/90">Satisfied Clients</p>

                            <div class="mt-4 pt-4 border-t border-white/10">
                                <div class="text-sm text-white/70 text-center">
                                    Creating lasting partnerships
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Years of Experience -->
                    <div class="stat-card group relative" data-aos="fade-up" data-aos-delay="300">
                        <div
                            class="bg-primary-light/10 backdrop-blur-lg p-8 rounded-2xl border border-white/10 shadow-xl h-full transition-all duration-500 transform group-hover:scale-105 group-hover:bg-primary-light/20">
                            <!-- Decorative element -->
                            <div
                                class="absolute -bottom-4 -right-4 w-24 h-24 bg-secondary/10 rounded-full blur-xl group-hover:bg-secondary/20 transition-colors duration-500">
                            </div>

                            <div class="flex items-center justify-center mb-6">
                                <div
                                    class="h-20 w-20 rounded-xl bg-gradient-to-br from-secondary to-secondary-light flex items-center justify-center shadow-lg transform transition-transform duration-500 group-hover:rotate-6">
                                    <i class="fas fa-calendar-check text-3xl text-white"></i>
                                </div>
                            </div>
                            <div class="text-6xl font-bold text-center mb-2 bg-clip-text text-transparent bg-gradient-to-r from-secondary to-secondary-light"
                                data-counter>{{ $yearsExperience }}</div>
                            <p class="text-xl text-center font-medium text-white/90">Years of Experience</p>

                            <div class="mt-4 pt-4 border-t border-white/10">
                                <div class="text-sm text-white/70 text-center">
                                    Building trust through expertise
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Decorative bottom wave -->
            <div class="absolute bottom-0 left-0 right-0 h-12 overflow-hidden">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"
                    class="w-full h-auto absolute bottom-0 left-0 text-white">
                    <path fill="currentColor" fill-opacity="0.05"
                        d="M0,96L48,112C96,128,192,160,288,186.7C384,213,480,235,576,213.3C672,192,768,128,864,117.3C960,107,1056,149,1152,149.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                    </path>
                </svg>
            </div>
        </div>
    </section>

    <!-- Testimonials Section with Modern Design -->
    <section class="py-20 bg-white relative overflow-hidden">
        <!-- Background elements -->
        <div class="absolute left-0 top-0 w-full h-64 bg-primary-dark opacity-5 skew-y-6 transform origin-top-left">
        </div>
        <div
            class="absolute right-0 bottom-0 w-full h-32 bg-secondary opacity-5 -skew-y-6 transform origin-bottom-right">
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <span class="text-secondary text-sm uppercase tracking-widest font-medium mb-2 block"
                    data-aos="fade-down">TESTIMONIALS</span>
                <h2 class="font-heading font-bold text-3xl md:text-4xl lg:text-5xl mb-4" data-aos="fade-up">What Our
                    Clients Say</h2>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Hear from those who have experienced our commitment to excellence and sustainability
                </p>
            </div>

            <!-- Testimonials Carousel -->
            <div class="relative px-8 pb-16" data-aos="fade-up">
                <!-- Decorative elements -->
                <div class="absolute left-0 top-1/4 -translate-y-1/2 w-20 h-20 bg-accent/10 rounded-full blur-xl">
                </div>
                <div
                    class="absolute right-0 bottom-1/4 translate-y-1/2 w-16 h-16 bg-secondary/10 rounded-full blur-xl">
                </div>

                <!-- Swiper container with uniform card styling -->
                <div class="swiper-container testimonial-slider overflow-hidden">
                    <div class="swiper-wrapper">
                        <!-- Testimonial 1 -->
                        <div class="swiper-slide p-4">
                            <div
                                class="bg-white rounded-xl shadow-lg p-8 h-full flex flex-col transition-transform duration-300 hover:-translate-y-2 border border-gray-100">
                                <div class="text-secondary mb-6">
                                    <i class="fas fa-quote-left text-3xl opacity-20"></i>
                                </div>
                                <div class="mb-6 flex-grow">
                                    <p class="text-gray-600 italic leading-relaxed">"Working with Akstruct was a
                                        seamless experience. Their attention to detail and commitment to sustainability
                                        exceeded our expectations."</p>
                                </div>
                                <div class="w-16 h-1 bg-secondary/20 mb-6"></div>
                                <div class="flex flex-col">
                                    <div class="flex text-accent mb-4">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div class="flex items-center">
                                        <div
                                            class="w-12 h-12 rounded-full bg-primary flex items-center justify-center text-white mr-4">
                                            <span class="text-lg font-bold">A</span>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-lg">Adebayo Johnson</h4>
                                            <p class="text-gray-500 text-sm">Project Manager, Horizon Development</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 2 -->
                        <div class="swiper-slide p-4">
                            <div
                                class="bg-white rounded-xl shadow-lg p-8 h-full flex flex-col transition-transform duration-300 hover:-translate-y-2 border border-gray-100">
                                <div class="text-secondary mb-6">
                                    <i class="fas fa-quote-left text-3xl opacity-20"></i>
                                </div>
                                <div class="mb-6 flex-grow">
                                    <p class="text-gray-600 italic leading-relaxed">"From design to execution, Akstruct
                                        delivered a high-quality project on time and within budget. Their team's
                                        expertise in sustainable construction practices is truly impressive."</p>
                                </div>
                                <div class="w-16 h-1 bg-secondary/20 mb-6"></div>
                                <div class="flex flex-col">
                                    <div class="flex text-accent mb-4">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <div class="flex items-center">
                                        <div
                                            class="w-12 h-12 rounded-full bg-primary flex items-center justify-center text-white mr-4">
                                            <span class="text-lg font-bold">C</span>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-lg">Chika Okonkwo</h4>
                                            <p class="text-gray-500 text-sm">CEO, EcoSpaces Nigeria</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 3 -->
                        <div class="swiper-slide p-4">
                            <div
                                class="bg-white rounded-xl shadow-lg p-8 h-full flex flex-col transition-transform duration-300 hover:-translate-y-2 border border-gray-100">
                                <div class="text-secondary mb-6">
                                    <i class="fas fa-quote-left text-3xl opacity-20"></i>
                                </div>
                                <div class="mb-6 flex-grow">
                                    <p class="text-gray-600 italic leading-relaxed">"Akstruct's approach to our office
                                        renovation was exceptional. They incorporated energy-efficient solutions that
                                        have significantly reduced our operational costs while creating a more
                                        comfortable work environment."</p>
                                </div>
                                <div class="w-16 h-1 bg-secondary/20 mb-6"></div>
                                <div class="flex flex-col">
                                    <div class="flex text-accent mb-4">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div class="flex items-center">
                                        <div
                                            class="w-12 h-12 rounded-full bg-primary flex items-center justify-center text-white mr-4">
                                            <span class="text-lg font-bold">F</span>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-lg">Fatima Aliyu</h4>
                                            <p class="text-gray-500 text-sm">Director of Operations, TechHub Abuja</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination dots -->
                    <div class="swiper-pagination mt-8"></div>
                </div>

                <!-- Navigation arrows -->
                <div
                    class="swiper-button-prev testimonial-button-prev absolute left-0 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white shadow-lg text-primary flex items-center justify-center z-10 transition-transform duration-300 hover:scale-110">
                    <i class="fas fa-chevron-left"></i>
                </div>
                <div
                    class="swiper-button-next testimonial-button-next absolute right-0 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white shadow-lg text-primary flex items-center justify-center z-10 transition-transform duration-300 hover:scale-110">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>

            <!-- Client logos -->
            <div class="mt-16 bg-white rounded-xl shadow-lg p-10" data-aos="fade-up">
                <h3 class="text-center text-2xl font-bold mb-10">Trusted By</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 items-center">
                    <div
                        class="flex justify-center grayscale hover:grayscale-0 opacity-60 hover:opacity-100 transition-all duration-300">
                        <img src="{{ asset('assets/img/clients/logo1.png') }}" alt="TechCorp Logo"
                            class="h-12 object-contain">
                    </div>
                    <div
                        class="flex justify-center grayscale hover:grayscale-0 opacity-60 hover:opacity-100 transition-all duration-300">
                        <img src="{{ asset('assets/img/clients/logo2.png') }}" alt="EcoBuilders Logo"
                            class="h-12 object-contain">
                    </div>
                    <div
                        class="flex justify-center grayscale hover:grayscale-0 opacity-60 hover:opacity-100 transition-all duration-300">
                        <img src="{{ asset('assets/img/clients/logo3.png') }}" alt="InnovateSol Logo"
                            class="h-12 object-contain">
                    </div>
                    <div
                        class="flex justify-center grayscale hover:grayscale-0 opacity-60 hover:opacity-100 transition-all duration-300">
                        <img src="{{ asset('assets/img/clients/logo4.png') }}" alt="MetroGroup Logo"
                            class="h-12 object-contain">
                    </div>
                    <div
                        class="flex justify-center grayscale hover:grayscale-0 opacity-60 hover:opacity-100 transition-all duration-300">
                        <img src="{{ asset('assets/img/clients/logo5.png') }}" alt="GreenSpaces Logo"
                            class="h-12 object-contain">
                    </div>
                    <div
                        class="flex justify-center grayscale hover:grayscale-0 opacity-60 hover:opacity-100 transition-all duration-300">
                        <img src="{{ asset('assets/img/clients/logo6.png') }}" alt="FutureBuild Logo"
                            class="h-12 object-contain">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call-to-Action Section for Newsletter -->
    <section class="py-16 bg-stone relative overflow-hidden">
        <div class="absolute inset-0 bg-pattern opacity-10 z-0"
            style="background-image: url('{{ asset('assets/img/pattern.svg') }}');"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="bg-white rounded-2xl shadow-lg p-10 max-w-5xl mx-auto" data-aos="fade-up">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
                    <div>
                        <h3 class="font-heading font-bold text-2xl md:text-3xl mb-4">Stay Updated with Our Latest News
                        </h3>
                        <p class="text-gray-600 mb-6">Join our newsletter to receive project updates, industry
                            insights, and exclusive content directly to your inbox.</p>

                        <form class="space-y-4">
                            <div class="flex flex-col sm:flex-row gap-4">
                                <input type="email" placeholder="Your Email Address"
                                    class="form-input flex-1 rounded-lg">
                                <button type="submit" class="btn btn-primary whitespace-nowrap">
                                    <span>Subscribe</span>
                                    <i class="fas fa-paper-plane ml-2"></i>
                                </button>
                            </div>
                            <p class="text-xs text-gray-500">By subscribing, you agree to our Privacy Policy and
                                consent to receive updates from our company.</p>
                        </form>
                    </div>

                    <div class="hidden md:block">
                        <img src="{{ asset('assets/img/newsletter.svg') }}" alt="Newsletter" class="w-full h-auto">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Try to autoplay video with sound (addressing browser autoplay policies)
        const heroVideo = document.querySelector('.hero-section video');
        if (heroVideo) {
            // Try to play immediately
            const playPromise = heroVideo.play();

            if (playPromise !== undefined) {
                playPromise.catch(error => {
                    // Auto-play was prevented by the browser
                    console.log("Autoplay prevented, waiting for user interaction");

                    // Add a click listener to the entire document to play on first interaction
                    const playVideoOnce = function() {
                        heroVideo.play();
                        document.removeEventListener('click', playVideoOnce);
                        document.removeEventListener('touchstart', playVideoOnce);
                        document.removeEventListener('keydown', playVideoOnce);
                    };

                    document.addEventListener('click', playVideoOnce);
                    document.addEventListener('touchstart', playVideoOnce);
                    document.addEventListener('keydown', playVideoOnce);
                });
            }
        }

        // Initialize the testimonial slider if Swiper is available
        if (typeof Swiper !== 'undefined') {
            new Swiper('.testimonial-slider', {
                slidesPerView: 1,
                spaceBetween: 30,
                grabCursor: true,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.testimonial-button-next',
                    prevEl: '.testimonial-button-prev',
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    1024: {
                        slidesPerView: 2,
                        spaceBetween: 40,
                    },
                    1280: {
                        slidesPerView: 3,
                        spaceBetween: 40,
                    },
                },
                effect: 'slide',
                speed: 800,
            });
        }

        // Hero carousel animation for image slider
        const heroSlides = document.querySelectorAll('.hero-slide');
        if (heroSlides.length > 0) {
            let currentSlide = 0;

            // Set first slide active initially
            heroSlides[currentSlide].classList.add('opacity-100');

            // Change slides every 5 seconds
            setInterval(() => {
                // Hide current slide
                heroSlides[currentSlide].classList.remove('opacity-100');

                // Move to next slide or go back to first
                currentSlide = (currentSlide + 1) % heroSlides.length;

                // Show new slide
                heroSlides[currentSlide].classList.add('opacity-100');
            }, 5000);
        }

        // Process progress animation
        const processProgress = document.getElementById('process-progress');
        if (processProgress) {
            // Observer for scrolling to process section
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Animate progress line through all steps
                        setTimeout(() => {
                            processProgress.style.width = '100%';
                        }, 500);
                    }
                });
            }, {
                threshold: 0.3
            });

            observer.observe(processProgress.parentElement);
        }

        // Video play/pause on hover for project videos
        const projectVideos = document.querySelectorAll('.project-video');
        projectVideos.forEach(video => {
            video.addEventListener('mouseover', function() {
                this.play();
            });
            video.addEventListener('mouseout', function() {
                this.pause();
            });
        });

        // Counter animation for statistics section
        const counterElements = document.querySelectorAll('[data-counter]');
        if (counterElements.length > 0) {
            const counterObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const element = entry.target;
                        const target = parseInt(element.textContent);
                        let count = 0;
                        const duration = 2000; // ms
                        const increment = Math.ceil(target / (duration / 30));

                        const timer = setInterval(() => {
                            count += increment;
                            if (count >= target) {
                                element.textContent = target;
                                clearInterval(timer);
                            } else {
                                element.textContent = count;
                            }
                        }, 30);

                        // Unobserve after animation
                        counterObserver.unobserve(element);
                    }
                });
            }, {
                threshold: 0.5
            });

            counterElements.forEach(element => {
                counterObserver.observe(element);
            });
        }
    });
</script>
