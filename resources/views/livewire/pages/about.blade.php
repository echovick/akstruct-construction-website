<?php

use App\Models\Setting;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('layout.web')] class extends Component {
    public function with(): array
    {
        return [
            'vision' => Setting::getValue('vision', 'To ensure sustainable infrastructures are attained, creating a legacy of epic professionalism, durable structures, and strict adherence to health and safety measures (HSE) at our sites.'),
            'mission' => Setting::getValue('mission', 'To actively contribute to professional engineering and construction practices by providing environmentally friendly, innovative, sustainable, and client-centric solutions to our clients and society at large.'),
            'companyFoundingYear' => Setting::getValue('company_founding_year', '2015'),
            'yearsExperience' => Setting::getValue('stats_years_experience', '8'),
        ];
    }
}; ?>

<div>
    <!-- Hero Section with Parallax Effect -->
    <section class="relative bg-primary-dark text-white overflow-hidden">
        <!-- Background image with overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('assets/IMG_7144.JPG') }}" alt="Akstruct Construction"
                class="w-full h-full object-cover object-center">
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
                <h1 class="font-heading font-bold text-4xl md:text-5xl lg:text-6xl mb-6 text-white leading-tight">About
                    Akstruct Construction</h1>
                <p class="text-xl text-white/90 mb-8 leading-relaxed">Building sustainable futures with innovative
                    construction solutions since {{ $companyFoundingYear }}</p>

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
                                <span class="text-white/80">About Us</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- Company Info Section with Enhanced Design -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Left Column with Image Gallery -->
                <div data-aos="fade-right" data-aos-delay="100">
                    <div class="relative">
                        <!-- Decorative elements -->
                        <div class="absolute -top-6 -left-6 w-24 h-24 bg-secondary/20 rounded-lg"></div>
                        <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-accent/20 rounded-lg"></div>

                        <!-- Main image -->
                        <div class="relative z-10 rounded-xl overflow-hidden shadow-2xl">
                            <img src="{{ asset('assets/IMG_6292.JPG') }}" alt="Akstruct Construction Team"
                                class="w-full h-auto">
                        </div>

                        <!-- Floating smaller images -->
                        <div
                            class="absolute -bottom-12 -left-12 z-20 w-32 h-32 rounded-lg overflow-hidden shadow-xl border-4 border-white transform rotate-6">
                            <img src="{{ asset('assets/img/about/about-2.jpg') }}" alt="Construction Site"
                                class="w-full h-full object-cover">
                        </div>
                        <div
                            class="absolute -top-10 -right-10 z-20 w-28 h-28 rounded-lg overflow-hidden shadow-xl border-4 border-white transform -rotate-6">
                            <img src="{{ asset('assets/img/about/about-1.jpg') }}" alt="Team Collaboration"
                                class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>

                <!-- Right Column with Text Content -->
                <div data-aos="fade-left" data-aos-delay="200">
                    <span class="text-secondary text-sm uppercase tracking-widest font-medium mb-2 block">OUR
                        STORY</span>
                    <h2 class="font-heading font-bold text-3xl md:text-4xl mb-6">Building Excellence Since <span
                            class="text-secondary">{{ date('Y') - $yearsExperience }}</span></h2>

                    <p class="text-gray-700 mb-6">
                        Akstruct Construction Ltd. is a leading sustainable construction company in Nigeria,
                        specializing in innovative, environmentally responsible building solutions. Established in
                        {{ $companyFoundingYear }}, we have grown from a small team of dedicated engineers to a
                        comprehensive construction firm with a portfolio of successful projects across residential,
                        commercial, industrial, and institutional sectors.
                    </p>

                    <p class="text-gray-700 mb-6">
                        At Akstruct Construction Limited, we are committed to delivering top-notch professional
                        engineering solutions that prioritize sustainability, innovation, and excellence. With a mission
                        to actively contribute to professional engineering and construction practices, we collaborate
                        with forward-thinking organizations, institutions, and private sector stakeholders.
                    </p>

                    <p class="text-gray-700 mb-8">
                        We deliver high-quality, cost-efficient infrastructure solutions—optimizing timelines without
                        compromising excellence. Our team combines technical expertise with a deep commitment to
                        sustainability, ensuring that every project we undertake not only meets but exceeds industry
                        standards for quality, efficiency, and environmental responsibility.
                    </p>

                    <!-- Key highlights with icons -->
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
                </div>
            </div>
        </div>
    </section>

    <!-- Vision & Mission Section with Modern Card Design -->
    <section class="py-16 bg-gray-50 relative overflow-hidden">
        <!-- Background elements -->
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-stone/50 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-60 h-60 bg-secondary/10 rounded-full blur-3xl"></div>
        <div class="absolute inset-0 bg-pattern opacity-5 z-0"
            style="background-image: url('{{ asset('assets/img/pattern.svg') }}');"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-12">
                <span class="text-secondary text-sm uppercase tracking-widest font-medium mb-2 block"
                    data-aos="fade-down">OUR DIRECTION</span>
                <h2 class="font-heading font-bold text-3xl md:text-4xl lg:text-5xl mb-4" data-aos="fade-up">Vision &
                    Mission</h2>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Guiding principles that drive our every decision and approach to sustainable construction
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Vision -->
                <div class="card p-8 rounded-xl shadow-xl bg-white relative overflow-hidden h-full transform transition-transform duration-500 hover:-translate-y-2"
                    data-aos="fade-right" data-aos-delay="100">
                    <!-- Decorative corner -->
                    <div class="absolute top-0 right-0 w-24 h-24 bg-secondary/10 rounded-bl-full"></div>

                    <div class="mb-6 text-secondary relative z-10">
                        <div class="h-16 w-16 rounded-xl bg-secondary/10 flex items-center justify-center">
                            <i class="fas fa-eye text-3xl text-secondary"></i>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 relative z-10">Our Vision</h3>
                    <p class="text-gray-600 flex-grow relative z-10">{{ $vision }}</p>
                </div>

                <!-- Mission -->
                <div class="card p-8 rounded-xl shadow-xl bg-white relative overflow-hidden h-full transform transition-transform duration-500 hover:-translate-y-2"
                    data-aos="fade-left" data-aos-delay="200">
                    <!-- Decorative corner -->
                    <div class="absolute top-0 right-0 w-24 h-24 bg-accent/10 rounded-bl-full"></div>

                    <div class="mb-6 text-accent relative z-10">
                        <div class="h-16 w-16 rounded-xl bg-accent/10 flex items-center justify-center">
                            <i class="fas fa-bullseye text-3xl text-accent"></i>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 relative z-10">Our Mission</h3>
                    <p class="text-gray-600 flex-grow relative z-10">{{ $mission }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-20 bg-white relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-secondary/5 rounded-full blur-3xl"></div>
        <div class="absolute top-20 right-20 w-20 h-20 bg-accent/10 rounded-full blur-xl"></div>
        <div class="absolute top-40 left-1/3 w-16 h-16 bg-secondary/10 rounded-full animate-float"
            style="animation-delay: 0.7s;"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <span class="text-secondary text-sm uppercase tracking-widest font-medium mb-2 block"
                    data-aos="fade-down">OUR LEADERSHIP</span>
                <h2 class="font-heading font-bold text-3xl md:text-4xl lg:text-5xl mb-4" data-aos="fade-up">Meet the
                    Team Behind Akstruct</h2>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Our team of experts brings together decades of experience in construction, engineering, and
                    sustainable design
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <!-- Team Member 1 - CEO -->
                <div class="group" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative rounded-xl overflow-hidden shadow-lg mb-5">
                        <img src="{{ asset('assets/Team5.jpg') }}" alt="John Doe - CEO"
                            class="w-full h-80 object-cover object-center transform transition-transform duration-500 group-hover:scale-110">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-primary-dark/90 to-transparent opacity-0 group-hover:opacity-90 transition-all duration-300 flex flex-col justify-end p-6">
                            <!-- Social links -->
                            <div class="flex space-x-3 mb-4">
                                <a href="#"
                                    class="bg-white/20 hover:bg-white/40 p-2 rounded-full text-white transition-colors">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#"
                                    class="bg-white/20 hover:bg-white/40 p-2 rounded-full text-white transition-colors">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#"
                                    class="bg-white/20 hover:bg-white/40 p-2 rounded-full text-white transition-colors">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>
                            <p class="text-white/80 text-sm">With over 15 years of experience in sustainable
                                construction, John leads our team with a focus on innovation and excellence.</p>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-primary-dark group-hover:text-secondary transition-colors">John
                        Doe</h3>
                    <p class="text-gray-600">Chief Executive Officer</p>
                </div>

                <!-- Team Member 2 - COO -->
                <div class="group" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative rounded-xl overflow-hidden shadow-lg mb-5">
                        <img src="{{ asset('assets/Team1.jpg') }}" alt="Sarah Johnson - COO"
                            class="w-full h-80 object-cover object-center transform transition-transform duration-500 group-hover:scale-110">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-primary-dark/90 to-transparent opacity-0 group-hover:opacity-90 transition-all duration-300 flex flex-col justify-end p-6">
                            <!-- Social links -->
                            <div class="flex space-x-3 mb-4">
                                <a href="#"
                                    class="bg-white/20 hover:bg-white/40 p-2 rounded-full text-white transition-colors">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#"
                                    class="bg-white/20 hover:bg-white/40 p-2 rounded-full text-white transition-colors">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#"
                                    class="bg-white/20 hover:bg-white/40 p-2 rounded-full text-white transition-colors">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>
                            <p class="text-white/80 text-sm">Sarah oversees our day-to-day operations, ensuring
                                efficiency and quality across all projects and departments.</p>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-primary-dark group-hover:text-secondary transition-colors">Sarah
                        Johnson</h3>
                    <p class="text-gray-600">Chief Operations Officer</p>
                </div>

                <!-- Team Member 3 - CTO -->
                <div class="group" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative rounded-xl overflow-hidden shadow-lg mb-5">
                        <img src="{{ asset('assets/Team2.jpg') }}" alt="Michael Chen - CTO"
                            class="w-full h-80 object-cover object-center transform transition-transform duration-500 group-hover:scale-110">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-primary-dark/90 to-transparent opacity-0 group-hover:opacity-90 transition-all duration-300 flex flex-col justify-end p-6">
                            <!-- Social links -->
                            <div class="flex space-x-3 mb-4">
                                <a href="#"
                                    class="bg-white/20 hover:bg-white/40 p-2 rounded-full text-white transition-colors">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#"
                                    class="bg-white/20 hover:bg-white/40 p-2 rounded-full text-white transition-colors">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#"
                                    class="bg-white/20 hover:bg-white/40 p-2 rounded-full text-white transition-colors">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>
                            <p class="text-white/80 text-sm">Michael brings cutting-edge technology to our construction
                                practices, implementing innovative solutions that enhance sustainability.</p>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-primary-dark group-hover:text-secondary transition-colors">
                        Michael Chen</h3>
                    <p class="text-gray-600">Chief Technology Officer</p>
                </div>

                <!-- Team Member 4 - Design Director -->
                <div class="group" data-aos="fade-up" data-aos-delay="400">
                    <div class="relative rounded-xl overflow-hidden shadow-lg mb-5">
                        <img src="{{ asset('assets/Team3.jpg') }}" alt="Amina Osei - Design Director"
                            class="w-full h-80 object-cover object-center transform transition-transform duration-500 group-hover:scale-110">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-primary-dark/90 to-transparent opacity-0 group-hover:opacity-90 transition-all duration-300 flex flex-col justify-end p-6">
                            <!-- Social links -->
                            <div class="flex space-x-3 mb-4">
                                <a href="#"
                                    class="bg-white/20 hover:bg-white/40 p-2 rounded-full text-white transition-colors">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="#"
                                    class="bg-white/20 hover:bg-white/40 p-2 rounded-full text-white transition-colors">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#"
                                    class="bg-white/20 hover:bg-white/40 p-2 rounded-full text-white transition-colors">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>
                            <p class="text-white/80 text-sm">Amina leads our design team with a passion for creating
                                spaces that are both aesthetically pleasing and environmentally responsible.</p>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-primary-dark group-hover:text-secondary transition-colors">Amina
                        Osei</h3>
                    <p class="text-gray-600">Design Director</p>
                </div>
            </div>

            <!-- Join The Team CTA -->
            <div class="mt-16 text-center" data-aos="fade-up" data-aos-delay="500">
                <h3 class="text-2xl font-bold mb-4">Join Our Team</h3>
                <p class="text-gray-600 max-w-2xl mx-auto mb-8">We're always looking for talented individuals who share
                    our passion for sustainable construction and innovation</p>
                <a href="{{ route('careers') }}" class="btn btn-primary">
                    <span>View Open Positions</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Core Values -->
    <section class="py-16 bg-white">
        <!-- ... existing code ... -->
    </section>

    <!-- Certifications & Accreditations -->
    <section class="py-16 bg-gray-50 relative overflow-hidden">
        <!-- Background elements -->
        <div class="absolute inset-0 bg-pattern opacity-5"
            style="background-image: url('{{ asset('assets/img/pattern.svg') }}');"></div>
        <div class="absolute -top-20 -left-20 w-60 h-60 bg-accent/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -right-20 w-40 h-40 bg-secondary/10 rounded-full blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <span class="text-secondary text-sm uppercase tracking-widest font-medium mb-2 block"
                    data-aos="fade-down">RECOGNIZED EXCELLENCE</span>
                <h2 class="font-heading font-bold text-3xl md:text-4xl lg:text-5xl mb-4" data-aos="fade-up">
                    Certifications & Accreditations</h2>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Our commitment to excellence is recognized by these industry standards
                </p>
            </div>

            <!-- Modern certificates layout with hover effects -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                <!-- ISO 9001 -->
                <div class="bg-white p-6 rounded-xl shadow-lg transition-all duration-300 hover:shadow-2xl transform hover:-translate-y-2 group"
                    data-aos="fade-up" data-aos-delay="100">
                    <div
                        class="p-2 rounded-lg bg-gray-50 transition-colors duration-300 group-hover:bg-secondary/10 flex items-center justify-center mb-4">
                        <img src="{{ asset('assets/img/certifications/iso-9001.svg') }}" alt="ISO 9001"
                            class="h-16">
                    </div>
                    <div class="text-center">
                        <p
                            class="font-bold text-primary-dark mb-1 group-hover:text-secondary transition-colors duration-300">
                            ISO 9001</p>
                        <p class="text-gray-600 text-sm">Quality Management System</p>
                    </div>
                </div>

                <!-- ISO 14001 -->
                <div class="bg-white p-6 rounded-xl shadow-lg transition-all duration-300 hover:shadow-2xl transform hover:-translate-y-2 group"
                    data-aos="fade-up" data-aos-delay="200">
                    <div
                        class="p-2 rounded-lg bg-gray-50 transition-colors duration-300 group-hover:bg-secondary/10 flex items-center justify-center mb-4">
                        <img src="{{ asset('assets/img/certifications/iso-14001.svg') }}" alt="ISO 14001"
                            class="h-16">
                    </div>
                    <div class="text-center">
                        <p
                            class="font-bold text-primary-dark mb-1 group-hover:text-secondary transition-colors duration-300">
                            ISO 14001</p>
                        <p class="text-gray-600 text-sm">Environmental Management</p>
                    </div>
                </div>

                <!-- LEED -->
                <div class="bg-white p-6 rounded-xl shadow-lg transition-all duration-300 hover:shadow-2xl transform hover:-translate-y-2 group"
                    data-aos="fade-up" data-aos-delay="300">
                    <div
                        class="p-2 rounded-lg bg-gray-50 transition-colors duration-300 group-hover:bg-secondary/10 flex items-center justify-center mb-4">
                        <img src="{{ asset('assets/img/certifications/leed.svg') }}" alt="LEED" class="h-16">
                    </div>
                    <div class="text-center">
                        <p
                            class="font-bold text-primary-dark mb-1 group-hover:text-secondary transition-colors duration-300">
                            LEED</p>
                        <p class="text-gray-600 text-sm">Green Building Certification</p>
                    </div>
                </div>

                <!-- COREN -->
                <div class="bg-white p-6 rounded-xl shadow-lg transition-all duration-300 hover:shadow-2xl transform hover:-translate-y-2 group"
                    data-aos="fade-up" data-aos-delay="400">
                    <div
                        class="p-2 rounded-lg bg-gray-50 transition-colors duration-300 group-hover:bg-secondary/10 flex items-center justify-center mb-4">
                        <img src="{{ asset('assets/img/certifications/coren.svg') }}" alt="COREN" class="h-16">
                    </div>
                    <div class="text-center">
                        <p
                            class="font-bold text-primary-dark mb-1 group-hover:text-secondary transition-colors duration-300">
                            COREN</p>
                        <p class="text-gray-600 text-sm">Council for the Regulation of Engineering in Nigeria</p>
                    </div>
                </div>

                <!-- OHSAS 18001 -->
                <div class="bg-white p-6 rounded-xl shadow-lg transition-all duration-300 hover:shadow-2xl transform hover:-translate-y-2 group"
                    data-aos="fade-up" data-aos-delay="500">
                    <div
                        class="p-2 rounded-lg bg-gray-50 transition-colors duration-300 group-hover:bg-secondary/10 flex items-center justify-center mb-4">
                        <img src="{{ asset('assets/img/certifications/ohsas-18001.svg') }}" alt="OHSAS 18001"
                            class="h-16">
                    </div>
                    <div class="text-center">
                        <p
                            class="font-bold text-primary-dark mb-1 group-hover:text-secondary transition-colors duration-300">
                            OHSAS 18001</p>
                        <p class="text-gray-600 text-sm">Occupational Health and Safety</p>
                    </div>
                </div>
            </div>

            <!-- Additional achievements description -->
            <div class="mt-16 bg-white p-8 rounded-xl shadow-lg" data-aos="fade-up" data-aos-delay="600">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                    <div>
                        <h3 class="text-2xl font-bold mb-4">Our Achievements</h3>
                        <p class="text-gray-600 mb-4">Beyond certifications, our work has been recognized with various
                            awards for excellence in construction, sustainability, and innovation.</p>
                        <p class="text-gray-600">We continuously invest in training our team and upgrading our systems
                            to maintain the highest industry standards and stay at the forefront of sustainable
                            construction practices.</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-4 rounded-lg text-center">
                            <div class="text-4xl font-bold text-secondary mb-2">15+</div>
                            <p class="text-gray-600">Industry Awards</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg text-center">
                            <div class="text-4xl font-bold text-secondary mb-2">100%</div>
                            <p class="text-gray-600">Quality Compliance</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg text-center">
                            <div class="text-4xl font-bold text-secondary mb-2">20+</div>
                            <p class="text-gray-600">Certified Professionals</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg text-center">
                            <div class="text-4xl font-bold text-secondary mb-2">8</div>
                            <p class="text-gray-600">Years of Excellence</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What It Takes to Build Trust Section - Updated with Modern Design -->
    <section class="py-16 bg-white relative overflow-hidden">
        <!-- Background elements -->
        <div class="absolute -top-40 -left-40 w-80 h-80 bg-stone/50 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -right-40 w-80 h-80 bg-secondary/10 rounded-full blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <span class="text-secondary text-sm uppercase tracking-widest font-medium mb-2 block"
                    data-aos="fade-down">OUR FOUNDATION</span>
                <h2 class="font-heading font-bold text-3xl md:text-4xl lg:text-5xl mb-4" data-aos="fade-up">What It
                    Takes to Build Trust</h2>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Behind every successful project is our unwavering commitment to excellence
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Quality Card -->
                <div class="card overflow-hidden group" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative h-72">
                        <img src="https://images.unsplash.com/photo-1599707254554-027aeb4deacd"
                            alt="Quality Construction"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-primary-dark via-primary-dark/60 to-transparent opacity-80 group-hover:opacity-70 transition-all duration-300">
                        </div>
                        <div class="absolute inset-0 flex flex-col justify-end p-8">
                            <div
                                class="p-3 bg-white/80 backdrop-blur-sm w-16 h-16 rounded-xl flex items-center justify-center mb-4 text-primary shadow-lg transform -translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                <i class="fas fa-gem text-3xl"></i>
                            </div>
                            <h3
                                class="text-2xl font-bold text-white mb-3 drop-shadow-md transform -translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                Uncompromising Quality</h3>
                            <p
                                class="text-white/90 mb-4 opacity-0 group-hover:opacity-100 transition-all duration-500">
                                Every material, every connection, every finish – we maintain the highest standards
                                throughout our construction process to ensure lasting durability and performance.</p>
                        </div>
                    </div>
                </div>

                <!-- Expertise Card -->
                <div class="card overflow-hidden group" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative h-72">
                        <img src="https://images.unsplash.com/photo-1581094288338-2314dddb7ece"
                            alt="Technical Expertise"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-primary-dark via-primary-dark/60 to-transparent opacity-80 group-hover:opacity-70 transition-all duration-300">
                        </div>
                        <div class="absolute inset-0 flex flex-col justify-end p-8">
                            <div
                                class="p-3 bg-white/80 backdrop-blur-sm w-16 h-16 rounded-xl flex items-center justify-center mb-4 text-primary shadow-lg transform -translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                <i class="fas fa-brain text-3xl"></i>
                            </div>
                            <h3
                                class="text-2xl font-bold text-white mb-3 drop-shadow-md transform -translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                Technical Expertise</h3>
                            <p
                                class="text-white/90 mb-4 opacity-0 group-hover:opacity-100 transition-all duration-500">
                                Our team of highly skilled engineers, architects, and construction professionals brings
                                years of experience and innovative thinking to every challenge we face.</p>
                        </div>
                    </div>
                </div>

                <!-- Sustainability Card -->
                <div class="card overflow-hidden group" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative h-72">
                        <img src="https://images.unsplash.com/photo-1624569098144-bda5cbbf46af"
                            alt="Environmental Commitment"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-primary-dark via-primary-dark/60 to-transparent opacity-80 group-hover:opacity-70 transition-all duration-300">
                        </div>
                        <div class="absolute inset-0 flex flex-col justify-end p-8">
                            <div
                                class="p-3 bg-white/80 backdrop-blur-sm w-16 h-16 rounded-xl flex items-center justify-center mb-4 text-primary shadow-lg transform -translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                <i class="fas fa-leaf text-3xl"></i>
                            </div>
                            <h3
                                class="text-2xl font-bold text-white mb-3 drop-shadow-md transform -translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                Environmental Commitment</h3>
                            <p
                                class="text-white/90 mb-4 opacity-0 group-hover:opacity-100 transition-all duration-500">
                                We integrate sustainable practices throughout our projects, from energy-efficient
                                designs to waste reduction strategies, ensuring our buildings contribute positively to
                                the environment.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-secondary">
        <div class="container mx-auto px-4 text-center">
            <h2 class="font-heading font-bold text-3xl md:text-4xl text-primary-dark mb-6">Partner with Akstruct for
                Your Next Project</h2>
            <p class="text-lg text-primary-dark mb-8 max-w-3xl mx-auto">Let's work together to bring your vision to
                life with innovative, sustainable solutions.</p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="{{ route('quote') }}" class="btn btn-primary">Request a Quote</a>
                <a href="{{ route('contact') }}" class="btn bg-white text-primary-dark hover:bg-gray-100">Contact
                    Us</a>
            </div>
        </div>
    </section>

    <!-- CTA Section with Modern Design -->
    <section class="py-16 bg-secondary relative overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute inset-0 bg-pattern opacity-10"
            style="background-image: url('{{ asset('assets/img/pattern.svg') }}');"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full filter blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/10 rounded-full filter blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-5xl mx-auto text-center">
                <h2 class="font-heading font-bold text-3xl md:text-4xl text-primary-dark mb-6" data-aos="fade-up">
                    Partner with Akstruct for Your Next Project</h2>
                <p class="text-lg text-primary-dark/90 mb-8 max-w-3xl mx-auto" data-aos="fade-up"
                    data-aos-delay="100">
                    Let's work together to bring your vision to life with innovative, sustainable solutions.
                </p>
                <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4"
                    data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('quote') }}" class="btn btn-primary text-center">
                        <span>Request a Quote</span>
                        <i class="fas fa-file-invoice ml-2"></i>
                    </a>
                    <a href="{{ route('contact') }}"
                        class="btn bg-white text-primary-dark hover:bg-gray-100 text-center">
                        <span>Contact Us</span>
                        <i class="fas fa-envelope ml-2"></i>
                    </a>
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
                            <p class="text-white font-semibold">{{ $happyClients ?? '123' }}+</p>
                            <p class="text-white/80 text-sm">Happy Clients</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
