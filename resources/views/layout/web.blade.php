<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Akstruct Construction - Building Sustainable Futures">
    <meta name="keywords" content="construction, sustainable building, engineering, Nigeria, Africa">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Akstruct Construction' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('build/assets/app-Bapl2Iy-.css') }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Icons (using FontAwesome CDN for simplicity) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @livewireStyles
</head>

<body class="antialiased bg-stone min-h-screen flex flex-col" x-data="{ scrolled: false }" x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })">
    <!-- Top Bar -->
    <div class="bg-primary-dark text-white">
        <div class="container mx-auto px-4 py-2">
            <div class="flex flex-col sm:flex-row justify-between items-center text-sm">
                <!-- Contact Info -->
                <div class="flex flex-col sm:flex-row items-center space-y-2 sm:space-y-0 sm:space-x-6 mb-2 sm:mb-0">
                    <div class="flex items-center" data-aos="fade-right" data-aos-delay="100">
                        <i class="fas fa-phone-alt text-secondary mr-2"></i>
                        <span>08140993888 | 07082323113</span>
                    </div>
                    <div class="flex items-center" data-aos="fade-right" data-aos-delay="200">
                        <i class="fas fa-envelope text-secondary mr-2"></i>
                        <span>akstructltd@gmail.com</span>
                    </div>
                    <div class="flex items-center" data-aos="fade-right" data-aos-delay="300">
                        <i class="fas fa-map-marker-alt text-secondary mr-2"></i>
                        <span>Abuja, Nigeria</span>
                    </div>
                </div>

                <!-- Social Media & CTA -->
                <div class="flex items-center space-x-4" data-aos="fade-left">
                    <a href="#" class="social-icon hover:text-secondary" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-icon hover:text-secondary" aria-label="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="social-icon hover:text-secondary" aria-label="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-icon hover:text-secondary" aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Header with Sticky Navigation -->
    <header class="sticky top-0 z-50 w-full transition-all duration-300"
        :class="{ 'bg-white/85 backdrop-blur-sm shadow-lg': scrolled, 'bg-primary-dark backdrop-blur-sm': !scrolled }">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-3">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-2 z-10"
                    aria-label="Akstruct Construction">
                    <img :src="scrolled ? '{{ asset('assets/akstruct-logo-cropped.png') }}' :
                        '{{ asset('assets/akstruct-logo-cropped.png') }}'"
                        alt="Akstruct Logo" class="h-12 w-auto transition-all duration-300"
                        style="max-width: 200px; object-fit: contain;">
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center space-x-6 font-medium">
                    <a href="{{ route('home') }}"
                        class="nav-link relative py-2 px-1 text-base transition-all duration-300 hover:text-secondary {{ request()->routeIs('home') ? 'text-secondary' : '' }}"
                        :class="scrolled ? 'text-primary-dark' : 'text-white'">
                        <span class="relative z-10 pb-1 inline-block">Home</span>
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-secondary transform scale-x-0 transition-transform duration-300 origin-left {{ request()->routeIs('home') ? 'scale-x-100' : '' }} group-hover:scale-x-100"></span>
                    </a>
                    <a href="{{ route('about') }}"
                        class="nav-link relative py-2 px-1 text-base transition-all duration-300 hover:text-secondary {{ request()->routeIs('about') ? 'text-secondary' : '' }}"
                        :class="scrolled ? 'text-primary-dark' : 'text-white'">
                        <span class="relative z-10 pb-1 inline-block">About</span>
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-secondary transform scale-x-0 transition-transform duration-300 origin-left {{ request()->routeIs('about') ? 'scale-x-100' : '' }} group-hover:scale-x-100"></span>
                    </a>
                    <a href="{{ route('services') }}"
                        class="nav-link relative py-2 px-1 text-base transition-all duration-300 hover:text-secondary {{ request()->routeIs('services*') ? 'text-secondary' : '' }}"
                        :class="scrolled ? 'text-primary-dark' : 'text-white'">
                        <span class="relative z-10 pb-1 inline-block">Services</span>
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-secondary transform scale-x-0 transition-transform duration-300 origin-left {{ request()->routeIs('services*') ? 'scale-x-100' : '' }} group-hover:scale-x-100"></span>
                    </a>
                    <a href="{{ route('project-portfolio') }}"
                        class="nav-link relative py-2 px-1 text-base transition-all duration-300 hover:text-secondary {{ request()->routeIs('project-portfolio*') ? 'text-secondary' : '' }}"
                        :class="scrolled ? 'text-primary-dark' : 'text-white'">
                        <span class="relative z-10 pb-1 inline-block">Projects</span>
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-secondary transform scale-x-0 transition-transform duration-300 origin-left {{ request()->routeIs('project-portfolio*') ? 'scale-x-100' : '' }} group-hover:scale-x-100"></span>
                    </a>
                    <a href="{{ route('blog') }}"
                        class="nav-link relative py-2 px-1 text-base transition-all duration-300 hover:text-secondary {{ request()->routeIs('blog*') ? 'text-secondary' : '' }}"
                        :class="scrolled ? 'text-primary-dark' : 'text-white'">
                        <span class="relative z-10 pb-1 inline-block">Blog</span>
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-secondary transform scale-x-0 transition-transform duration-300 origin-left {{ request()->routeIs('blog*') ? 'scale-x-100' : '' }} group-hover:scale-x-100"></span>
                    </a>
                    <a href="{{ route('careers') }}"
                        class="nav-link relative py-2 px-1 text-base transition-all duration-300 hover:text-secondary {{ request()->routeIs('careers*') ? 'text-secondary' : '' }}"
                        :class="scrolled ? 'text-primary-dark' : 'text-white'">
                        <span class="relative z-10 pb-1 inline-block">Careers</span>
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-secondary transform scale-x-0 transition-transform duration-300 origin-left {{ request()->routeIs('careers*') ? 'scale-x-100' : '' }} group-hover:scale-x-100"></span>
                    </a>
                    <a href="{{ route('contact') }}"
                        class="nav-link relative py-2 px-1 text-base transition-all duration-300 hover:text-secondary {{ request()->routeIs('contact') ? 'text-secondary' : '' }}"
                        :class="scrolled ? 'text-primary-dark' : 'text-white'">
                        <span class="relative z-10 pb-1 inline-block">Contact</span>
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-secondary transform scale-x-0 transition-transform duration-300 origin-left {{ request()->routeIs('contact') ? 'scale-x-100' : '' }} group-hover:scale-x-100"></span>
                    </a>
                </nav>

                <!-- CTA Button -->
                <a href="{{ route('quote') }}"
                    class="hidden lg:flex items-center btn rounded-full py-2 px-5 shadow-md transform transition-all duration-300 hover:-translate-y-1 hover:shadow-lg"
                    :class="scrolled ? 'bg-accent text-white' : 'bg-white/90 text-primary-dark'">
                    <span class="text-sm font-medium">Request a Quote</span>
                    <i class="fas fa-arrow-right ml-2 transition-transform group-hover:translate-x-1 text-xs"></i>
                </a>

                <!-- Mobile Menu Button -->
                <div class="lg:hidden" x-data="{ open: false }">
                    <button type="button"
                        class="w-9 h-9 flex items-center justify-center rounded-full transition-colors duration-300 focus:outline-none"
                        :class="scrolled ? 'bg-primary/90 text-white hover:bg-primary-light' :
                            'bg-white/10 backdrop-blur-sm text-white hover:bg-white/20'"
                        @click="open = !open" aria-label="Toggle menu">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5" x-show="!open">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5" x-show="open"
                            style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <!-- Mobile Menu Dropdown -->
                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 -translate-y-4"
                        class="absolute top-full left-0 w-full bg-white/90 backdrop-blur-sm shadow-md rounded-b-lg py-3 z-50"
                        style="display: none;" @click.away="open = false">
                        <div class="container mx-auto px-4 flex flex-col space-y-1">
                            <a href="{{ route('home') }}"
                                class="block py-2.5 px-4 rounded-lg hover:bg-stone/50 text-sm {{ request()->routeIs('home') ? 'text-secondary border-l-2 border-secondary pl-3 font-medium' : 'text-primary' }}">
                                Home
                            </a>
                            <a href="{{ route('about') }}"
                                class="block py-2.5 px-4 rounded-lg hover:bg-stone/50 text-sm {{ request()->routeIs('about') ? 'text-secondary border-l-2 border-secondary pl-3 font-medium' : 'text-primary' }}">
                                About
                            </a>
                            <a href="{{ route('services') }}"
                                class="block py-2.5 px-4 rounded-lg hover:bg-stone/50 text-sm {{ request()->routeIs('services*') ? 'text-secondary border-l-2 border-secondary pl-3 font-medium' : 'text-primary' }}">
                                Services
                            </a>
                            <a href="{{ route('project-portfolio') }}"
                                class="block py-2.5 px-4 rounded-lg hover:bg-stone/50 text-sm {{ request()->routeIs('project-portfolio*') ? 'text-secondary border-l-2 border-secondary pl-3 font-medium' : 'text-primary' }}">
                                Projects
                            </a>
                            <a href="{{ route('blog') }}"
                                class="block py-2.5 px-4 rounded-lg hover:bg-stone/50 text-sm {{ request()->routeIs('blog*') ? 'text-secondary border-l-2 border-secondary pl-3 font-medium' : 'text-primary' }}">
                                Blog
                            </a>
                            <a href="{{ route('careers') }}"
                                class="block py-2.5 px-4 rounded-lg hover:bg-stone/50 text-sm {{ request()->routeIs('careers*') ? 'text-secondary border-l-2 border-secondary pl-3 font-medium' : 'text-primary' }}">
                                Careers
                            </a>
                            <a href="{{ route('contact') }}"
                                class="block py-2.5 px-4 rounded-lg hover:bg-stone/50 text-sm {{ request()->routeIs('contact') ? 'text-secondary border-l-2 border-secondary pl-3 font-medium' : 'text-primary' }}">
                                Contact
                            </a>
                            <div class="pt-2 mt-1 border-t border-gray-100">
                                <a href="{{ route('quote') }}"
                                    class="block py-2.5 px-4 mt-2 btn bg-accent/90 hover:bg-accent text-white text-sm rounded-lg text-center">
                                    Request a Quote
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow relative z-10">
        {{ $slot }}
    </main>

    <!-- Call to Action Section -->
    <section class="relative py-20 overflow-hidden" data-aos="fade-up">
        <div class="absolute inset-0 bg-primary-dark opacity-90 z-0"></div>
        <div class="absolute inset-0 z-0">
            <div class="bg-pattern absolute inset-0 opacity-10"
                style="background-image: url('{{ asset('assets/img/pattern.svg') }}');"></div>
        </div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Ready to Build Your Sustainable Future?</h2>
                <p class="text-gray-200 text-lg mb-8 max-w-2xl mx-auto">Contact us today to discuss your project needs
                    and discover how we can bring your vision to life with our innovative and sustainable construction
                    solutions.</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('quote') }}" class="btn btn-accent">Get a Free Quote</a>
                    <a href="{{ route('contact') }}" class="btn bg-white text-primary hover:bg-gray-100">Contact
                        Us</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-primary-dark text-white pt-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <!-- Company Info -->
                <div data-aos="fade-up" data-aos-delay="100">
                    <div class="mb-6">
                        <img src="{{ asset('assets/akstruct-logo-cropped.png') }}" alt="Akstruct Construction"
                            class="h-12" style="max-width: 180px; object-fit: contain;">
                    </div>
                    <p class="text-gray-300 mb-6">Building sustainable futures with innovative construction solutions
                        that prioritize quality, durability, and environmental responsibility.</p>
                    <div class="flex space-x-4">
                        <a href="https://www.instagram.com/akstruct_africa?igsh=dTB0YWY2cjAzeDVv"
                            class="social-icon h-10 w-10 rounded-full border border-gray-600 flex items-center justify-center hover:border-secondary hover:bg-secondary hover:text-primary-dark"
                            aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#"
                            class="social-icon h-10 w-10 rounded-full border border-gray-600 flex items-center justify-center hover:border-secondary hover:bg-secondary hover:text-primary-dark"
                            aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div data-aos="fade-up" data-aos-delay="200">
                    <h3
                        class="font-semibold text-xl mb-6 relative pb-2 after:absolute after:bottom-0 after:left-0 after:w-16 after:h-0.5 after:bg-secondary">
                        Quick Links</h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="{{ route('about') }}" class="footer-link flex items-center group">
                                <i
                                    class="fas fa-chevron-right text-xs text-secondary mr-2 transition-transform duration-300 group-hover:translate-x-1"></i>
                                <span>About Us</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('services') }}" class="footer-link flex items-center group">
                                <i
                                    class="fas fa-chevron-right text-xs text-secondary mr-2 transition-transform duration-300 group-hover:translate-x-1"></i>
                                <span>Services</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="footer-link flex items-center group">
                                <i
                                    class="fas fa-chevron-right text-xs text-secondary mr-2 transition-transform duration-300 group-hover:translate-x-1"></i>
                                <span>Projects</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('blog') }}" class="footer-link flex items-center group">
                                <i
                                    class="fas fa-chevron-right text-xs text-secondary mr-2 transition-transform duration-300 group-hover:translate-x-1"></i>
                                <span>Blog</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('faq') }}" class="footer-link flex items-center group">
                                <i
                                    class="fas fa-chevron-right text-xs text-secondary mr-2 transition-transform duration-300 group-hover:translate-x-1"></i>
                                <span>FAQs</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('careers') }}" class="footer-link flex items-center group">
                                <i
                                    class="fas fa-chevron-right text-xs text-secondary mr-2 transition-transform duration-300 group-hover:translate-x-1"></i>
                                <span>Careers</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}" class="footer-link flex items-center group">
                                <i
                                    class="fas fa-chevron-right text-xs text-secondary mr-2 transition-transform duration-300 group-hover:translate-x-1"></i>
                                <span>Contact Us</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div data-aos="fade-up" data-aos-delay="300">
                    <h3
                        class="font-semibold text-xl mb-6 relative pb-2 after:absolute after:bottom-0 after:left-0 after:w-16 after:h-0.5 after:bg-secondary">
                        Contact Us</h3>
                    <ul class="space-y-4">
                        <li class="flex">
                            <div
                                class="h-10 w-10 rounded-full bg-primary flex items-center justify-center text-secondary mr-4">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <span class="text-gray-300">Third Floor, Global Plaza, Suit C410, Jabi, Abuja 900108,
                                    Federal Capital Territory</span>
                            </div>
                        </li>
                        <li class="flex">
                            <div
                                class="h-10 w-10 rounded-full bg-primary flex items-center justify-center text-secondary mr-4">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div>
                                <span class="text-gray-300">08140993888 | 07082323113</span>
                            </div>
                        </li>
                        <li class="flex">
                            <div
                                class="h-10 w-10 rounded-full bg-primary flex items-center justify-center text-secondary mr-4">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <span class="text-gray-300">akstructltd@gmail.com</span>
                            </div>
                        </li>
                        <li class="flex mt-4">
                            <div
                                class="h-10 w-10 rounded-full bg-primary flex items-center justify-center text-secondary mr-4">
                                <i class="fab fa-instagram"></i>
                            </div>
                            <div>
                                <span class="text-gray-300">@akstruct_africa</span>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div data-aos="fade-up" data-aos-delay="400">
                    <h3
                        class="font-semibold text-xl mb-6 relative pb-2 after:absolute after:bottom-0 after:left-0 after:w-16 after:h-0.5 after:bg-secondary">
                        Newsletter</h3>
                    <p class="text-gray-300 mb-6">Subscribe to our newsletter for the latest updates on our projects,
                        industry insights, and company news.</p>
                    <form action="#" method="POST" class="space-y-4">
                        <div class="relative">
                            <input type="email" name="email" placeholder="Your Email Address"
                                class="w-full px-4 py-3 rounded-lg bg-primary bg-opacity-50 border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent">
                            <button type="submit"
                                class="absolute right-0 top-0 h-full px-4 bg-secondary text-white rounded-r-lg hover:bg-secondary-dark transition-colors duration-300">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                        <button type="submit" class="hidden">Subscribe</button>
                    </form>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-700 py-8 text-center text-gray-400 text-sm">
                <div class="md:flex justify-between items-center">
                    <div>
                        <p>&copy; {{ date('Y') }} Akstruct Construction. All Rights Reserved.</p>
                        <p class="mt-2">Designed & Developed by <a href="https://echospectrang.com" target="_blank"
                                class="text-secondary hover:text-secondary-light transition-colors">Echospectra
                                Technology Limited</a></p>
                    </div>
                    <div class="mt-4 md:mt-0 flex justify-center md:justify-end space-x-6">
                        <a href="{{ route('privacy-policy') }}" class="text-gray-400 hover:text-secondary">Privacy
                            Policy</a>
                        <a href="{{ route('terms-of-service') }}" class="text-gray-400 hover:text-secondary">Terms of
                            Service</a>
                        <a href="#" class="text-gray-400 hover:text-secondary">Sitemap</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back to Top Button -->
        <button id="back-to-top"
            class="fixed bottom-6 right-6 h-12 w-12 bg-accent text-white rounded-full shadow-lg z-50 flex items-center justify-center opacity-0 invisible transition-all duration-300 hover:bg-accent-dark">
            <i class="fas fa-arrow-up"></i>
        </button>
    </footer>

    <!-- Scripts for image fallbacks -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const placeholderBaseUrl = 'https://placehold.co';

            // Handle image errors and replace with color placeholders
            document.querySelectorAll('img').forEach(img => {
                img.addEventListener('error', function() {
                    // Skip images that are already placeholders
                    if (this.src.includes(placeholderBaseUrl)) return;

                    const width = this.width || 800;
                    const height = this.height || 600;

                    // Get image context from alt text or parent elements
                    const altText = this.alt.toLowerCase();
                    let bgColor = '1e3a54'; // Default to primary color
                    let textColor = 'ffffff';

                    // Set different colors based on context
                    if (altText.includes('sustainability') || altText.includes('eco')) {
                        bgColor = '4CAF50'; // Green
                    } else if (altText.includes('innovation') || altText.includes('tech')) {
                        bgColor = '2196F3'; // Blue
                    } else if (altText.includes('professional') || altText.includes('team')) {
                        bgColor = 'FFC107'; // Amber
                    } else if (altText.includes('project') || altText.includes('work')) {
                        bgColor = '59c1cc'; // Secondary color
                    } else if (altText.includes('client') || altText.includes('logo')) {
                        bgColor = 'f5f5f0'; // Stone color
                        textColor = '1e3a54'; // Dark text for light backgrounds
                    }

                    // Create the placeholder text from alt or generate a category name
                    let text = this.alt;
                    if (!text || text.length < 2) {
                        // Try to determine category from parent elements or classes
                        const parentText = this.closest('.card')?.querySelector('h3, h4')
                            ?.textContent;
                        text = parentText || 'Image';
                    }

                    // Create encoded text for the placeholder
                    const encodedText = encodeURIComponent(text.substring(0, 20));

                    // Set the placeholder image
                    this.src =
                        `${placeholderBaseUrl}/${width}x${height}/${bgColor}/${textColor}?text=${encodedText}`;

                    // Add styling to maintain aspect ratio
                    this.style.objectFit = 'cover';
                });

                // Trigger error event in case images are already broken
                if (img.complete && img.naturalHeight === 0) {
                    img.dispatchEvent(new Event('error'));
                }
            });
        });
    </script>

    <!-- Scroll to top script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Back to top button
            const backToTopButton = document.getElementById('back-to-top');

            if (backToTopButton) {
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 300) {
                        backToTopButton.classList.add('opacity-100');
                        backToTopButton.classList.remove('invisible');
                    } else {
                        backToTopButton.classList.remove('opacity-100');
                        backToTopButton.classList.add('invisible');
                    }
                });

                backToTopButton.addEventListener('click', function() {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }
        });
    </script>
    <script src="{{ asset('build/assets/app-C8v_h5bs.js') }}"></script>
    @livewireScripts
</body>

</html>
