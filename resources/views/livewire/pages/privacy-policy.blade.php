<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('layout.web')] class extends Component {
    public function with(): array
    {
        return [];
    }
}; ?>

<div>
    <!-- Hero Section with Parallax Effect -->
    <section class="relative bg-primary-dark text-white overflow-hidden">
        <!-- Background image with overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('assets/IMG_7144.JPG') }}" alt="Privacy Policy"
                class="w-full h-full object-cover object-center">
            <div class="absolute inset-0 bg-gradient-to-r from-primary-dark/90 to-primary/70"></div>
        </div>

        <!-- Floating elements -->
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
                <h1 class="font-heading font-bold text-4xl md:text-5xl lg:text-6xl mb-6 text-white leading-tight">
                    Privacy Policy</h1>
                <p class="text-xl text-white/90 mb-8 leading-relaxed">How we collect, use, and protect your information
                </p>

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
                                <span class="text-white/80">Privacy Policy</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- Privacy Policy Content Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="mb-12">
                    <p class="text-gray-600 mb-6">Last Updated: {{ date('F d, Y') }}</p>
                    <p class="text-gray-700 mb-8">
                        At Akstruct Construction Ltd., we are committed to protecting your privacy and ensuring the
                        security of your personal information. This Privacy Policy outlines our practices regarding the
                        collection, use, and disclosure of your information when you use our website or services.
                    </p>
                    <p class="text-gray-700 mb-8">
                        By accessing or using our website, you agree to the terms of this Privacy Policy. Please read
                        this policy carefully to understand our practices regarding your personal data.
                    </p>
                </div>

                <!-- Information Collection Section -->
                <div class="mb-12" data-aos="fade-up">
                    <h2 class="text-2xl font-bold text-primary-dark mb-4">Information We Collect</h2>
                    <div class="bg-stone rounded-xl p-6 shadow-sm mb-6">
                        <h3 class="text-xl font-semibold mb-3">Personal Information</h3>
                        <p class="text-gray-700 mb-4">We may collect the following personal information when you
                            voluntarily provide it to us:</p>
                        <ul class="list-disc pl-6 text-gray-700 space-y-2 mb-4">
                            <li>Contact information (name, email address, phone number, address)</li>
                            <li>Professional information (company, job title)</li>
                            <li>Project details when requesting quotes or services</li>
                            <li>Job application information (resume, cover letter, employment history)</li>
                            <li>Payment information for transactions</li>
                        </ul>
                    </div>

                    <div class="bg-stone rounded-xl p-6 shadow-sm">
                        <h3 class="text-xl font-semibold mb-3">Automatically Collected Information</h3>
                        <p class="text-gray-700 mb-4">When you visit our website, we may automatically collect certain
                            information about your device and usage, including:</p>
                        <ul class="list-disc pl-6 text-gray-700 space-y-2">
                            <li>IP address and location data</li>
                            <li>Browser type and version</li>
                            <li>Operating system information</li>
                            <li>Pages visited and navigation patterns</li>
                            <li>Time and date of visits</li>
                            <li>Referring websites or sources</li>
                        </ul>
                    </div>
                </div>

                <!-- How We Use Information Section -->
                <div class="mb-12" data-aos="fade-up" data-aos-delay="100">
                    <h2 class="text-2xl font-bold text-primary-dark mb-4">How We Use Your Information</h2>
                    <p class="text-gray-700 mb-4">We use the collected information for the following purposes:</p>
                    <ul class="list-disc pl-6 text-gray-700 space-y-2">
                        <li>To provide and improve our services</li>
                        <li>To respond to inquiries and service requests</li>
                        <li>To process quote requests and project proposals</li>
                        <li>To communicate with you about our services, projects, and events</li>
                        <li>To send newsletters and marketing materials (with your consent)</li>
                        <li>To process job applications</li>
                        <li>To comply with legal obligations</li>
                        <li>To analyze website usage and improve user experience</li>
                        <li>To protect against unauthorized access, fraud, or illegal activity</li>
                    </ul>
                </div>

                <!-- Information Sharing Section -->
                <div class="mb-12" data-aos="fade-up" data-aos-delay="150">
                    <h2 class="text-2xl font-bold text-primary-dark mb-4">Information Sharing and Disclosure</h2>
                    <p class="text-gray-700 mb-4">We may share your personal information with:</p>
                    <ul class="list-disc pl-6 text-gray-700 space-y-2">
                        <li>Service providers and contractors who help us operate our business and website</li>
                        <li>Business partners for specific project collaborations (with your consent)</li>
                        <li>Legal and regulatory authorities when required by law</li>
                        <li>Professional advisors such as lawyers, accountants, and insurers</li>
                    </ul>
                    <p class="text-gray-700 mt-4">
                        We do not sell, rent, or trade your personal information to third parties for marketing purposes
                        without your explicit consent.
                    </p>
                </div>

                <!-- Data Security Section -->
                <div class="mb-12" data-aos="fade-up" data-aos-delay="200">
                    <h2 class="text-2xl font-bold text-primary-dark mb-4">Data Security</h2>
                    <p class="text-gray-700 mb-4">
                        We implement appropriate technical and organizational measures to protect your personal
                        information against unauthorized access, alteration, disclosure, or destruction. However, no
                        method of transmission over the Internet or electronic storage is 100% secure, and we cannot
                        guarantee absolute security.
                    </p>
                    <p class="text-gray-700">
                        In the event of a data breach that may compromise your personal information, we will notify you
                        in accordance with applicable laws.
                    </p>
                </div>

                <!-- Cookies and Tracking Section -->
                <div class="mb-12" data-aos="fade-up" data-aos-delay="250">
                    <h2 class="text-2xl font-bold text-primary-dark mb-4">Cookies and Tracking Technologies</h2>
                    <p class="text-gray-700 mb-4">
                        Our website uses cookies and similar tracking technologies to collect information about your
                        browsing activities. Cookies are small text files stored on your device that help us improve
                        website functionality and user experience.
                    </p>
                    <p class="text-gray-700 mb-4">We use the following types of cookies:</p>
                    <ul class="list-disc pl-6 text-gray-700 space-y-2">
                        <li><strong>Essential cookies:</strong> Necessary for the website to function properly</li>
                        <li><strong>Analytical cookies:</strong> Help us understand how visitors interact with our
                            website</li>
                        <li><strong>Functional cookies:</strong> Remember your preferences and settings</li>
                        <li><strong>Marketing cookies:</strong> Track your browsing habits to deliver targeted
                            advertising</li>
                    </ul>
                    <p class="text-gray-700 mt-4">
                        You can control cookie settings through your browser preferences. However, disabling certain
                        cookies may impact your experience on our website.
                    </p>
                </div>

                <!-- Your Rights Section -->
                <div class="mb-12" data-aos="fade-up" data-aos-delay="300">
                    <h2 class="text-2xl font-bold text-primary-dark mb-4">Your Privacy Rights</h2>
                    <p class="text-gray-700 mb-4">Depending on your location, you may have the following rights
                        regarding your personal information:</p>
                    <ul class="list-disc pl-6 text-gray-700 space-y-2">
                        <li>Right to access and receive a copy of your personal information</li>
                        <li>Right to correct inaccurate or incomplete information</li>
                        <li>Right to delete your personal information (under certain circumstances)</li>
                        <li>Right to restrict or object to processing of your information</li>
                        <li>Right to data portability</li>
                        <li>Right to withdraw consent where processing is based on consent</li>
                    </ul>
                    <p class="text-gray-700 mt-4">
                        To exercise these rights, please contact us using the details provided in the "Contact Us"
                        section below.
                    </p>
                </div>

                <!-- Children's Privacy Section -->
                <div class="mb-12" data-aos="fade-up" data-aos-delay="350">
                    <h2 class="text-2xl font-bold text-primary-dark mb-4">Children's Privacy</h2>
                    <p class="text-gray-700">
                        Our website and services are not directed to individuals under 18 years of age. We do not
                        knowingly collect personal information from children. If you believe we have inadvertently
                        collected information from a child, please contact us immediately, and we will take steps to
                        delete such information.
                    </p>
                </div>

                <!-- Policy Changes Section -->
                <div class="mb-12" data-aos="fade-up" data-aos-delay="400">
                    <h2 class="text-2xl font-bold text-primary-dark mb-4">Changes to This Privacy Policy</h2>
                    <p class="text-gray-700">
                        We may update this Privacy Policy from time to time to reflect changes in our practices or legal
                        requirements. We will post the revised policy on our website with the effective date. We
                        encourage you to review this policy periodically for any changes. Your continued use of our
                        website after any modifications indicates your acceptance of the updated Privacy Policy.
                    </p>
                </div>

                <!-- Contact Information Section -->
                <div class="bg-stone rounded-xl p-8 shadow-md" data-aos="fade-up" data-aos-delay="450">
                    <h2 class="text-2xl font-bold text-primary-dark mb-4">Contact Us</h2>
                    <p class="text-gray-700 mb-6">
                        If you have any questions, concerns, or requests regarding this Privacy Policy or our data
                        practices, please contact us at:
                    </p>
                    <div class="flex flex-col space-y-3">
                        <div class="flex items-start">
                            <i class="fas fa-building text-secondary mt-1 mr-3"></i>
                            <span>Akstruct Construction Ltd.</span>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-map-marker-alt text-secondary mt-1 mr-3"></i>
                            <span>Third Floor, Global Plaza, Suit C410, Jabi, Abuja 900108, Federal Capital
                                Territory</span>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-envelope text-secondary mt-1 mr-3"></i>
                            <span>akstructltd@gmail.com</span>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-phone text-secondary mt-1 mr-3"></i>
                            <span>08140993888 | 07082323113</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
