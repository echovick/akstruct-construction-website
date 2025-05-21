<?php

use App\Models\Service;
use App\Models\Setting;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('layout.web')] class extends Component {
    public function with(): array
    {
        return [
            'services' => Service::orderBy('display_order')->get(),
            'yearsExperience' => Setting::getValue('stats_years_experience', '8'),
            'projectsCompleted' => Setting::getValue('stats_projects_completed', '150'),
        ];
    }
}; ?>

<div>
    <!-- Hero Section with Parallax Effect -->
    <section class="relative bg-primary-dark text-white overflow-hidden">
        <!-- Background image with overlay -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1503387762-592deb58ef4e?q=80&w=2071&auto=format&fit=crop"
                alt="Akstruct Construction Services" class="w-full h-full object-cover object-center">
            <div class="absolute inset-0 bg-gradient-to-r from-primary-dark/90 to-primary/70"></div>
        </div>

        <!-- Floating elements (similar to homepage) -->
        <div class="absolute inset-0 z-10 pointer-events-none overflow-hidden">
            <div class="absolute top-24 left-10 w-32 h-32 bg-secondary/20 rounded-full filter blur-xl animate-pulse">
            </div>
            <div class="absolute bottom-24 right-10 w-40 h-40 bg-accent/20 rounded-full filter blur-xl animate-pulse"
                style="animation-delay: 1s;"></div>
            <div class="absolute top-1/3 right-1/4 w-24 h-24 bg-primary-light/20 rounded-full filter blur-xl animate-pulse"
                style="animation-delay: 2s;"></div>
            <div class="absolute top-1/4 right-1/5 w-16 h-16 bg-white/10 rounded-md rotate-12 animate-float"
                style="animation-delay: 0.5s;"></div>
            <div class="absolute bottom-1/3 left-1/4 w-12 h-12 bg-secondary/10 rounded-full animate-float"
                style="animation-delay: 1.5s;"></div>
        </div>

        <!-- Hero Content -->
        <div class="relative z-20 container mx-auto px-4 py-28">
            <div class="max-w-3xl" data-aos="fade-right" data-aos-duration="1000">
                <h1 class="font-heading font-bold text-4xl md:text-5xl lg:text-6xl mb-6 text-white leading-tight">Our
                    Professional Services</h1>
                <p class="text-xl text-white/90 mb-8 leading-relaxed">Comprehensive construction and engineering
                    solutions tailored to your specific needs with sustainability at the core</p>

                <!-- Breadcrumb navigation -->
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('home') }}"
                                class="inline-flex items-center text-white hover:text-secondary">
                                <i class="fas fa-home mr-2"></i>
                                Home
                            </a>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-white/50 mx-2"></i>
                                <span class="text-white/80">Services</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- Service Introduction Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Left Column with Text Content -->
                <div data-aos="fade-right" data-aos-delay="100">
                    <span class="text-secondary text-sm uppercase tracking-widest font-medium mb-2 block">WHAT WE
                        OFFER</span>
                    <h2 class="font-heading font-bold text-3xl md:text-4xl mb-6">Sustainable Construction Solutions for
                        Every Need</h2>

                    <p class="text-gray-700 mb-6">
                        At Akstruct Construction Ltd, we provide a comprehensive range of professional construction and
                        engineering services,
                        all designed with sustainability and innovation at their core. With {{ $yearsExperience }} years
                        of industry experience,
                        our team of experts delivers tailored solutions that meet the unique needs of each client.
                    </p>

                    <p class="text-gray-700 mb-8">
                        Whether you're looking for residential, commercial, or industrial construction services, our
                        commitment to quality,
                        efficiency, and environmental responsibility ensures that your project will be completed to the
                        highest standards.
                    </p>

                    <!-- Key highlights with icons -->
                    <div class="grid grid-cols-2 gap-6 mb-8">
                        <div class="flex items-center">
                            <div class="text-secondary mr-3">
                                <i class="fas fa-check-circle text-2xl"></i>
                            </div>
                            <span class="font-medium">Sustainable Designs</span>
                        </div>
                        <div class="flex items-center">
                            <div class="text-secondary mr-3">
                                <i class="fas fa-check-circle text-2xl"></i>
                            </div>
                            <span class="font-medium">Quality Construction</span>
                        </div>
                        <div class="flex items-center">
                            <div class="text-secondary mr-3">
                                <i class="fas fa-check-circle text-2xl"></i>
                            </div>
                            <span class="font-medium">Expert Engineering</span>
                        </div>
                        <div class="flex items-center">
                            <div class="text-secondary mr-3">
                                <i class="fas fa-check-circle text-2xl"></i>
                            </div>
                            <span class="font-medium">Client Satisfaction</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column with Image Gallery -->
                <div data-aos="fade-left" data-aos-delay="200">
                    <div class="relative">
                        <!-- Decorative elements -->
                        <div class="absolute -top-6 -left-6 w-24 h-24 bg-secondary/20 rounded-lg"></div>
                        <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-accent/20 rounded-lg"></div>

                        <!-- Main image -->
                        <div class="relative z-10 rounded-xl overflow-hidden shadow-2xl">
                            <img src="{{ asset('assets/IMG_7143.jpg') }}" alt="Akstruct Construction Services"
                                alt="Akstruct Construction Services" class="w-full h-auto">
                        </div>

                        <!-- Floating smaller images -->
                        <div
                            class="absolute -bottom-12 -left-12 z-20 w-32 h-32 rounded-lg overflow-hidden shadow-xl border-4 border-white transform rotate-6">
                            <img src="{{ asset('assets/IMG_7147.jpg') }}" alt="Construction Site"
                                class="w-full h-full object-cover">
                        </div>
                        <div
                            class="absolute -top-10 -right-10 z-20 w-28 h-28 rounded-lg overflow-hidden shadow-xl border-4 border-white transform -rotate-6">
                            <img src="{{ asset('assets/IMG_7145.jpg') }}" alt="Team Collaboration"
                                class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section with Enhanced Design -->
    <section class="py-20 bg-gray-50 relative overflow-hidden">
        <!-- Background elements -->
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-stone/50 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-60 h-60 bg-secondary/10 rounded-full blur-3xl"></div>
        <div class="absolute inset-0 bg-pattern opacity-5 z-0"
            style="background-image: url('{{ asset('assets/img/pattern.svg') }}');"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <span class="text-secondary text-sm uppercase tracking-widest font-medium mb-2 block"
                    data-aos="fade-down">OUR SERVICES</span>
                <h2 class="font-heading font-bold text-3xl md:text-4xl lg:text-5xl mb-4" data-aos="fade-up">
                    Comprehensive Solutions for All Your Construction Needs</h2>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    From initial design to final completion, we provide expert services tailored to meet your specific
                    requirements
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($services as $service)
                    <div class="service-card group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div
                            class="rounded-xl overflow-hidden bg-white border border-gray-100 shadow-lg hover:shadow-xl transition-all duration-300 h-full flex flex-col">
                            <!-- Service Image Header -->
                            <div class="relative h-48 overflow-hidden">
                                @php
                                    // Default image if service image_path is not available
                                    $serviceImages = [
                                        'construction-management' =>
                                            'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?q=80&w=2070&auto=format&fit=crop',
                                        'design-build' =>
                                            'https://images.unsplash.com/photo-1503387762-592deb58ef4e?q=80&w=2071&auto=format&fit=crop',
                                        'civil-engineering' =>
                                            'https://images.unsplash.com/photo-1581092921461-7d65ca45393a?q=80&w=2070&auto=format&fit=crop',
                                        'sustainable-construction' =>
                                            'https://images.unsplash.com/photo-1621905252507-b35492cc74b4?q=80&w=2069&auto=format&fit=crop',
                                        'commercial' =>
                                            'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=2070&auto=format&fit=crop',
                                        'residential' =>
                                            'https://images.unsplash.com/photo-1580587771525-78b9dba3b914?q=80&w=2074&auto=format&fit=crop',
                                        'industrial' =>
                                            'https://images.unsplash.com/photo-1565636291290-4d48ff5ab06b?q=80&w=2070&auto=format&fit=crop',
                                        'renovation' =>
                                            'https://images.unsplash.com/photo-1574359411659-13a0df4a4596?q=80&w=2070&auto=format&fit=crop',
                                        'retrofitting' =>
                                            'https://images.unsplash.com/photo-1581578731548-c64695cc6952?q=80&w=2070&auto=format&fit=crop',
                                        'renovation-and-retrofitting' =>
                                            'https://images.unsplash.com/photo-1574359411659-13a0df4a4596?q=80&w=2070&auto=format&fit=crop',
                                        'project-management' =>
                                            'https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=2070&auto=format&fit=crop',
                                        'default' =>
                                            'https://images.unsplash.com/photo-1503387762-592deb58ef4e?q=80&w=2071&auto=format&fit=crop',
                                    ];

                                    // Try to find a matching image based on service slug or title
                                    $imageUrl = $serviceImages['default'];
                                    $serviceSlug = \Str::slug($service->title ?? '');

                                    foreach ($serviceImages as $key => $url) {
                                        if (strpos($serviceSlug, $key) !== false) {
                                            $imageUrl = $url;
                                            break;
                                        }
                                    }

                                    // Use service image if available, otherwise use the mapped image
                                    $displayImage = $service->image_path ? asset($service->image_path) : $imageUrl;
                                @endphp
                                <img src="{{ $displayImage }}" alt="{{ $service->title }}"
                                    class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-primary/80 to-primary/10 opacity-90">
                                </div>
                                <div class="absolute bottom-0 left-0 p-4">
                                    <!-- Service Icon in a circle -->
                                    <div
                                        class="bg-white/90 backdrop-blur-sm text-primary h-14 w-14 rounded-full flex items-center justify-center text-xl transform -translate-y-1/2 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                                        <i class="{{ $service->icon ?? 'fas fa-tools' }}"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Service Content -->
                            <div class="p-6 flex flex-col flex-grow">
                                <h3
                                    class="text-xl font-bold mb-3 group-hover:text-secondary transition-colors duration-300">
                                    {{ $service->title }}
                                </h3>
                                <p class="text-gray-600 mb-4 flex-grow">{{ $service->short_description }}</p>

                                <!-- Features List -->
                                <div class="mb-4">
                                    @foreach (explode("\n", $service->features) as $feature)
                                        @if (!empty(trim($feature)))
                                            <div class="flex items-center mb-1 text-sm">
                                                <i class="fas fa-check-circle text-secondary mr-2"></i>
                                                <span>{{ trim($feature) }}</span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                <a href="{{ route('services.show', $service) }}"
                                    class="mt-auto inline-flex items-center text-secondary font-medium hover:text-primary-dark group">
                                    <span>Learn More</span>
                                    <i
                                        class="fas fa-arrow-right ml-2 transform transition-transform duration-300 group-hover:translate-x-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="font-heading font-bold text-3xl md:text-4xl mb-6">Our Approach</h2>
                <p class="text-gray-600 mb-8">
                    At Akstruct Construction, we take a comprehensive approach to every project, ensuring that
                    sustainability,
                    innovation, and quality are integrated at every stage. Our team of experts collaborates closely with
                    clients
                    to understand their unique needs and deliver tailored solutions that exceed expectations.
                </p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                    <div class="text-center">
                        <div class="bg-secondary h-16 w-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-primary-dark text-2xl font-bold">1</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Consult</h3>
                        <p class="text-gray-600">We begin with in-depth discussions to understand your vision,
                            requirements, and objectives.</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-secondary h-16 w-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-primary-dark text-2xl font-bold">2</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Plan</h3>
                        <p class="text-gray-600">Our team develops detailed plans incorporating sustainable solutions
                            and innovative approaches.</p>
                    </div>
                    <div class="text-center">
                        <div class="bg-secondary h-16 w-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-primary-dark text-2xl font-bold">3</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Execute</h3>
                        <p class="text-gray-600">We implement the project with precision, maintaining clear
                            communication throughout the process.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-cta-section title="Need a Specialized Service?"
        subtitle="Our team of experts is ready to discuss your specific requirements and provide tailored solutions for your project." />

    <!-- Enhanced Process Section with Modern Design -->
    <section class="py-20 bg-white relative overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute inset-0 z-0 opacity-10 bg-pattern"
            style="background-image: url('{{ asset('assets/img/pattern.svg') }}');"></div>
        <div class="absolute -top-20 -left-20 w-60 h-60 bg-accent/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -right-20 w-40 h-40 bg-secondary/10 rounded-full blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <span class="text-secondary text-sm uppercase tracking-widest font-medium mb-2 block"
                    data-aos="fade-down">OUR PROCESS</span>
                <h2 class="font-heading font-bold text-3xl md:text-4xl lg:text-5xl mb-4" data-aos="fade-up">How We
                    Bring Your Vision To Life</h2>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Our comprehensive approach ensures every project is delivered with excellence from start to finish
                </p>
            </div>

            <div class="relative">
                <!-- Progress Line -->
                <div class="absolute hidden md:block left-0 right-0 top-16 h-1 bg-gray-200 z-0">
                    <div class="absolute left-0 h-full bg-secondary w-1/4 transition-all duration-1000"
                        id="process-progress"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                    <!-- Process Steps -->
                    <div class="text-center relative z-10" data-aos="fade-up" data-aos-delay="100">
                        <div
                            class="w-20 h-20 rounded-full bg-primary text-white flex items-center justify-center text-2xl font-bold mx-auto mb-4 transform transition-transform duration-300 hover:scale-110 shadow-lg">
                            01</div>
                        <h4 class="text-xl font-bold mb-3 text-primary">Consultation</h4>
                        <p class="text-gray-600">We begin with in-depth discussions to understand your vision,
                            requirements, and objectives, ensuring we fully capture your project goals.</p>
                        <div class="mt-4">
                            <div class="flex items-center justify-center">
                                <div class="bg-primary/10 rounded-full w-9 h-9 flex items-center justify-center mr-2">
                                    <i class="fas fa-comments text-primary"></i>
                                </div>
                                <span class="text-sm font-medium">Personalized Approach</span>
                            </div>
                        </div>
                    </div>

                    <div class="text-center relative z-10" data-aos="fade-up" data-aos-delay="200">
                        <div
                            class="w-20 h-20 rounded-full bg-primary text-white flex items-center justify-center text-2xl font-bold mx-auto mb-4 transform transition-transform duration-300 hover:scale-110 shadow-lg">
                            02</div>
                        <h4 class="text-xl font-bold mb-3 text-primary">Design & Planning</h4>
                        <p class="text-gray-600">Our team develops detailed plans incorporating sustainable solutions,
                            innovative approaches, and addressing all technical specifications.</p>
                        <div class="mt-4">
                            <div class="flex items-center justify-center">
                                <div class="bg-primary/10 rounded-full w-9 h-9 flex items-center justify-center mr-2">
                                    <i class="fas fa-drafting-compass text-primary"></i>
                                </div>
                                <span class="text-sm font-medium">Sustainable Design</span>
                            </div>
                        </div>
                    </div>

                    <div class="text-center relative z-10" data-aos="fade-up" data-aos-delay="300">
                        <div
                            class="w-20 h-20 rounded-full bg-primary text-white flex items-center justify-center text-2xl font-bold mx-auto mb-4 transform transition-transform duration-300 hover:scale-110 shadow-lg">
                            03</div>
                        <h4 class="text-xl font-bold mb-3 text-primary">Construction</h4>
                        <p class="text-gray-600">We implement the project with precision, maintaining clear
                            communication, quality control, and adherence to timelines and safety standards.</p>
                        <div class="mt-4">
                            <div class="flex items-center justify-center">
                                <div class="bg-primary/10 rounded-full w-9 h-9 flex items-center justify-center mr-2">
                                    <i class="fas fa-hard-hat text-primary"></i>
                                </div>
                                <span class="text-sm font-medium">Expert Execution</span>
                            </div>
                        </div>
                    </div>

                    <div class="text-center relative z-10" data-aos="fade-up" data-aos-delay="400">
                        <div
                            class="w-20 h-20 rounded-full bg-primary text-white flex items-center justify-center text-2xl font-bold mx-auto mb-4 transform transition-transform duration-300 hover:scale-110 shadow-lg">
                            04</div>
                        <h4 class="text-xl font-bold mb-3 text-primary">Delivery & Support</h4>
                        <p class="text-gray-600">We thoroughly inspect completed work, provide detailed documentation,
                            and offer ongoing support to ensure your complete satisfaction.</p>
                        <div class="mt-4">
                            <div class="flex items-center justify-center">
                                <div class="bg-primary/10 rounded-full w-9 h-9 flex items-center justify-center mr-2">
                                    <i class="fas fa-check-circle text-primary"></i>
                                </div>
                                <span class="text-sm font-medium">Continuous Support</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Expertise & Industries Section -->
    <section class="py-20 bg-stone relative overflow-hidden">
        <!-- Background elements -->
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-stone/50 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-60 h-60 bg-secondary/10 rounded-full blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <span class="text-secondary text-sm uppercase tracking-widest font-medium mb-2 block"
                    data-aos="fade-down">OUR EXPERTISE</span>
                <h2 class="font-heading font-bold text-3xl md:text-4xl lg:text-5xl mb-4" data-aos="fade-up">Industries
                    We Serve</h2>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Our professional construction services cater to a wide range of industries with specialized
                    solutions
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Residential -->
                <div class="group" data-aos="fade-up" data-aos-delay="100">
                    <div
                        class="card h-full overflow-hidden transform transition-all duration-500 hover:-translate-y-2">
                        <div class="relative h-56 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=2070&auto=format&fit=crop"
                                alt="Residential Construction"
                                class="w-full h-full object-cover transform transition-all duration-500 group-hover:scale-110">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-primary-dark/80 to-transparent opacity-90">
                            </div>
                            <div class="absolute inset-0 flex items-end p-6">
                                <div>
                                    <div
                                        class="inline-flex items-center justify-center p-3 rounded-xl bg-white/90 backdrop-blur-sm text-primary mb-4 shadow-lg">
                                        <i class="fas fa-home text-3xl"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold text-white mb-2">Residential</h3>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 bg-white">
                            <p class="text-gray-600">From luxury homes to multi-family developments, we create living
                                spaces that combine beauty, functionality, and sustainability.</p>
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    <span>Custom homes & estates</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-500 mt-2">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    <span>Multi-family housing</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-500 mt-2">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    <span>Renovations & remodels</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Commercial -->
                <div class="group" data-aos="fade-up" data-aos-delay="200">
                    <div
                        class="card h-full overflow-hidden transform transition-all duration-500 hover:-translate-y-2">
                        <div class="relative h-56 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=2070&auto=format&fit=crop"
                                alt="Commercial Construction"
                                class="w-full h-full object-cover transform transition-all duration-500 group-hover:scale-110">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-primary-dark/80 to-transparent opacity-90">
                            </div>
                            <div class="absolute inset-0 flex items-end p-6">
                                <div>
                                    <div
                                        class="inline-flex items-center justify-center p-3 rounded-xl bg-white/90 backdrop-blur-sm text-primary mb-4 shadow-lg">
                                        <i class="fas fa-building text-3xl"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold text-white mb-2">Commercial</h3>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 bg-white">
                            <p class="text-gray-600">We develop commercial spaces that enhance productivity, impress
                                clients, and integrate sustainable features to reduce operational costs.</p>
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                                    <span>Office buildings</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-500 mt-2">
                                    <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                                    <span>Retail spaces</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-500 mt-2">
                                    <i class="fas fa-check-circle text-blue-500 mr-2"></i>
                                    <span>Hospitality facilities</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Institutional -->
                <div class="group" data-aos="fade-up" data-aos-delay="300">
                    <div
                        class="card h-full overflow-hidden transform transition-all duration-500 hover:-translate-y-2">
                        <div class="relative h-56 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1497366754035-f200968a6e72?q=80&w=2069&auto=format&fit=crop"
                                alt="Institutional Construction"
                                class="w-full h-full object-cover transform transition-all duration-500 group-hover:scale-110">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-primary-dark/80 to-transparent opacity-90">
                            </div>
                            <div class="absolute inset-0 flex items-end p-6">
                                <div>
                                    <div
                                        class="inline-flex items-center justify-center p-3 rounded-xl bg-white/90 backdrop-blur-sm text-primary mb-4 shadow-lg">
                                        <i class="fas fa-university text-3xl"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold text-white mb-2">Institutional</h3>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 bg-white">
                            <p class="text-gray-600">We build institutional facilities that serve communities,
                                prioritizing safety, accessibility, and efficient resource management.</p>
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-check-circle text-amber-500 mr-2"></i>
                                    <span>Educational facilities</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-500 mt-2">
                                    <i class="fas fa-check-circle text-amber-500 mr-2"></i>
                                    <span>Healthcare buildings</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-500 mt-2">
                                    <i class="fas fa-check-circle text-amber-500 mr-2"></i>
                                    <span>Government buildings</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Testimonials Section -->
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
                    data-aos="fade-down">CLIENT FEEDBACK</span>
                <h2 class="font-heading font-bold text-3xl md:text-4xl lg:text-5xl mb-4" data-aos="fade-up">What Our
                    Clients Say About Our Services</h2>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Hear from those who have experienced the quality and excellence of our professional services
                </p>
            </div>

            <!-- Service Testimonials -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                <!-- Left testimonial -->
                <div class="bg-stone p-8 rounded-xl shadow-lg relative overflow-hidden" data-aos="fade-right">
                    <!-- Decorative elements -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-secondary/10 rounded-bl-full"></div>

                    <div class="relative z-10">
                        <div class="flex items-center mb-6">
                            <div
                                class="w-16 h-16 rounded-full bg-primary flex items-center justify-center text-white mr-4 shadow-lg">
                                <span class="text-xl font-bold">JD</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-xl">James Doherty</h4>
                                <p class="text-gray-600">CEO, Horizon Development</p>
                            </div>
                        </div>

                        <div class="mb-6">
                            <div class="text-accent mb-4 flex">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <p class="text-gray-700 italic leading-relaxed text-lg">
                                "Akstruct's engineering team brought innovative solutions to our commercial development
                                project. Their sustainable design approach has resulted in significant energy savings
                                and a building that truly stands out in the market."
                            </p>
                        </div>

                        <div class="flex items-center text-primary">
                            <span class="font-medium mr-2">Services used:</span>
                            <span class="bg-primary/10 px-2 py-1 rounded-full text-sm mr-2">Commercial
                                Construction</span>
                            <span class="bg-primary/10 px-2 py-1 rounded-full text-sm">Sustainable Design</span>
                        </div>
                    </div>
                </div>

                <!-- Right testimonial -->
                <div class="bg-stone p-8 rounded-xl shadow-lg relative overflow-hidden" data-aos="fade-left">
                    <!-- Decorative elements -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-accent/10 rounded-bl-full"></div>

                    <div class="relative z-10">
                        <div class="flex items-center mb-6">
                            <div
                                class="w-16 h-16 rounded-full bg-primary flex items-center justify-center text-white mr-4 shadow-lg">
                                <span class="text-xl font-bold">OA</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-xl">Olufemi Adeyemi</h4>
                                <p class="text-gray-600">Project Director, GreenSpaces Nigeria</p>
                            </div>
                        </div>

                        <div class="mb-6">
                            <div class="text-accent mb-4 flex">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <p class="text-gray-700 italic leading-relaxed text-lg">
                                "We've partnered with Akstruct on multiple projects, and their professional approach to
                                construction management has consistently delivered exceptional results. Their attention
                                to detail and commitment to sustainability align perfectly with our values."
                            </p>
                        </div>

                        <div class="flex items-center text-primary">
                            <span class="font-medium mr-2">Services used:</span>
                            <span class="bg-primary/10 px-2 py-1 rounded-full text-sm mr-2">Project Management</span>
                            <span class="bg-primary/10 px-2 py-1 rounded-full text-sm">Green Building</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Testimonial Quote -->
            <div class="mt-16 bg-primary-dark text-white p-10 rounded-xl shadow-xl relative overflow-hidden"
                data-aos="fade-up">
                <!-- Decorative elements -->
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-secondary/20 rounded-full filter blur-2xl"></div>
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-accent/20 rounded-full filter blur-2xl"></div>

                <div class="relative z-10 flex flex-col md:flex-row items-center gap-8">
                    <div class="text-secondary text-8xl opacity-20 md:w-1/4 flex justify-center">
                        <i class="fas fa-quote-left"></i>
                    </div>
                    <div class="md:w-3/4">
                        <p class="text-xl md:text-2xl italic font-light leading-relaxed mb-6">
                            "Akstruct's team brought technical excellence and innovation to our hospital expansion
                            project. Their understanding of healthcare facility requirements was impressive, and the
                            final result has enhanced our ability to serve our patients."
                        </p>
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center mr-4">
                                <span class="font-bold text-secondary">DR</span>
                            </div>
                            <div>
                                <h5 class="font-semibold">Dr. Amina Kabir</h5>
                                <p class="text-white/70 text-sm">Medical Director, Lagos Central Hospital</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modern Enhanced CTA Section -->
    <section class="py-16 bg-secondary relative overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute inset-0 bg-pattern opacity-10"
            style="background-image: url('{{ asset('assets/img/pattern.svg') }}');"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full filter blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/10 rounded-full filter blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-5xl mx-auto text-center">
                <h2 class="font-heading font-bold text-3xl md:text-4xl text-primary-dark mb-6" data-aos="fade-up">
                    Ready to Discuss Your Project Requirements?</h2>
                <p class="text-lg text-primary-dark/90 mb-8 max-w-3xl mx-auto" data-aos="fade-up"
                    data-aos-delay="100">
                    Our team of experts is ready to provide tailored solutions that align with your vision, timeline,
                    and budget
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto" data-aos="fade-up"
                    data-aos-delay="200">
                    <div
                        class="bg-white/10 backdrop-blur-sm p-8 rounded-xl border border-white/20 hover:bg-white/20 transition-colors duration-300 group">
                        <div class="text-primary-dark text-4xl mb-4">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <h3 class="text-xl font-bold text-primary-dark mb-3">Request a Detailed Quote</h3>
                        <p class="text-primary-dark/80 mb-6">Get a comprehensive estimate for your construction or
                            engineering project with our detailed quoting service</p>
                        <a href="{{ route('quote') }}"
                            class="btn bg-white text-primary-dark hover:bg-gray-100 group-hover:bg-primary-dark group-hover:text-white transition-colors duration-300">
                            <span>Request a Quote</span>
                            <i
                                class="fas fa-arrow-right ml-2 transform transition-transform duration-300 group-hover:translate-x-1"></i>
                        </a>
                    </div>

                    <div
                        class="bg-white/10 backdrop-blur-sm p-8 rounded-xl border border-white/20 hover:bg-white/20 transition-colors duration-300 group">
                        <div class="text-primary-dark text-4xl mb-4">
                            <i class="fas fa-comments"></i>
                        </div>
                        <h3 class="text-xl font-bold text-primary-dark mb-3">Schedule a Consultation</h3>
                        <p class="text-primary-dark/80 mb-6">Speak with our experts to discuss your specific
                            requirements and explore tailored solutions for your project</p>
                        <a href="{{ route('contact') }}"
                            class="btn bg-white text-primary-dark hover:bg-gray-100 group-hover:bg-primary-dark group-hover:text-white transition-colors duration-300">
                            <span>Contact Us</span>
                            <i
                                class="fas fa-arrow-right ml-2 transform transition-transform duration-300 group-hover:translate-x-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Floating info badge -->
                <div class="mt-12 inline-block bg-white/20 backdrop-blur-sm py-3 px-6 rounded-full text-primary-dark">
                    <p class="flex items-center">
                        <i class="fas fa-info-circle mr-2"></i>
                        <span>Already have project specifications? Fast-track your project with our <a
                                href="{{ route('quote') }}" class="font-bold hover:text-white">online quote
                                form</a></span>
                    </p>
                </div>
            </div>

            <!-- Floating badge elements -->
            <div class="hidden lg:block">
                <div class="absolute left-8 top-1/2 transform -translate-y-1/2 bg-white/20 backdrop-blur-sm p-5 rounded-lg shadow-lg animate-float"
                    style="animation-delay: 0.3s;">
                    <div class="flex items-center">
                        <div class="bg-white/30 p-3 rounded-full mr-4">
                            <i class="fas fa-hard-hat text-2xl text-white"></i>
                        </div>
                        <div>
                            <p class="text-white font-semibold">{{ $projectsCompleted ?? '150' }}+</p>
                            <p class="text-white/80 text-sm">Projects Completed</p>
                        </div>
                    </div>
                </div>

                <div class="absolute right-8 top-1/3 transform -translate-y-1/2 bg-white/20 backdrop-blur-sm p-5 rounded-lg shadow-lg animate-float"
                    style="animation-delay: 0.7s;">
                    <div class="flex items-center">
                        <div class="bg-white/30 p-3 rounded-full mr-4">
                            <i class="fas fa-smile text-2xl text-white"></i>
                        </div>
                        <div>
                            <p class="text-white font-semibold">100%</p>
                            <p class="text-white/80 text-sm">Client Satisfaction</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript for progress animation -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
        });
    </script>
</div>
