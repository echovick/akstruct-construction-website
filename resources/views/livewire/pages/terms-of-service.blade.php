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
            <img src="{{ asset('assets/IMG_7139.JPG') }}" alt="Terms of Service"
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
                    Terms of Service</h1>
                <p class="text-xl text-white/90 mb-8 leading-relaxed">The terms that govern your use of our website and
                    services</p>

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
                                <span class="text-white/80">Terms of Service</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- Terms of Service Content Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="mb-12">
                    <p class="text-gray-600 mb-6">Last Updated: {{ date('F d, Y') }}</p>
                    <p class="text-gray-700 mb-8">
                        Welcome to Akstruct Construction Ltd.'s website. These Terms of Service ("Terms") govern your
                        access to and use of our website, services, and content. By accessing or using our website, you
                        agree to be bound by these Terms. If you do not agree with any part of these Terms, you may not
                        access or use our website or services.
                    </p>
                    <p class="text-gray-700 mb-8">
                        Please read these Terms carefully before using our website. Your use of our website constitutes
                        your acceptance of these Terms.
                    </p>
                </div>

                <!-- Acceptance of Terms Section -->
                <div class="mb-12" data-aos="fade-up">
                    <h2 class="text-2xl font-bold text-primary-dark mb-4">1. Acceptance of Terms</h2>
                    <div class="bg-stone rounded-xl p-6 shadow-sm">
                        <p class="text-gray-700 mb-4">By accessing or using our website, you acknowledge that you have
                            read, understood, and agree to be bound by these Terms, as well as our Privacy Policy, which
                            is incorporated by reference.</p>
                        <p class="text-gray-700">These Terms apply to all visitors, users, and others who access or use
                            our website and services. If you are using our website on behalf of a company or
                            organization, you represent that you have the authority to bind such entity to these Terms.
                        </p>
                    </div>
                </div>

                <!-- Use of Website Section -->
                <div class="mb-12" data-aos="fade-up" data-aos-delay="100">
                    <h2 class="text-2xl font-bold text-primary-dark mb-4">2. Use of Website</h2>
                    <div class="bg-stone rounded-xl p-6 shadow-sm">
                        <h3 class="text-xl font-semibold mb-3">Permitted Use</h3>
                        <p class="text-gray-700 mb-4">You may use our website for lawful purposes and in accordance with
                            these Terms. You agree not to use our website:</p>
                        <ul class="list-disc pl-6 text-gray-700 space-y-2 mb-6">
                            <li>In any way that violates any applicable federal, state, local, or international law or
                                regulation</li>
                            <li>To transmit or procure the sending of any advertising or promotional material without
                                our prior written consent</li>
                            <li>To impersonate or attempt to impersonate Akstruct Construction, an Akstruct employee,
                                another user, or any other person or entity</li>
                            <li>To engage in any conduct that restricts or inhibits anyone's use or enjoyment of the
                                website</li>
                            <li>To attempt to gain unauthorized access to, interfere with, damage, or disrupt any parts
                                of the website, the server on which the website is stored, or any server, computer, or
                                database connected to the website</li>
                        </ul>

                        <h3 class="text-xl font-semibold mb-3">User Accounts</h3>
                        <p class="text-gray-700 mb-4">If you create an account on our website, you are responsible for
                            maintaining the confidentiality of your account details and for all activities that occur
                            under your account. You agree to notify us immediately of any unauthorized access or use of
                            your account.</p>
                    </div>
                </div>

                <!-- Intellectual Property Section -->
                <div class="mb-12" data-aos="fade-up" data-aos-delay="150">
                    <h2 class="text-2xl font-bold text-primary-dark mb-4">3. Intellectual Property Rights</h2>
                    <div class="bg-stone rounded-xl p-6 shadow-sm">
                        <p class="text-gray-700 mb-4">Our website and its entire contents, features, and functionality
                            (including but not limited to all information, software, text, displays, images, video, and
                            audio, and the design, selection, and arrangement thereof) are owned by Akstruct
                            Construction Ltd., its licensors, or other providers of such material and are protected by
                            Nigerian and international copyright, trademark, patent, trade secret, and other
                            intellectual property or proprietary rights laws.</p>
                        <p class="text-gray-700 mb-4">These Terms permit you to use our website for personal,
                            non-commercial use only. You must not:</p>
                        <ul class="list-disc pl-6 text-gray-700 space-y-2">
                            <li>Reproduce, distribute, modify, create derivative works of, publicly display, publicly
                                perform, republish, download, store, or transmit any of the material on our website,
                                except as it is created and displayed by the website for your personal use</li>
                            <li>Delete or alter any copyright, trademark, or other proprietary rights notices from
                                copies of materials from our website</li>
                            <li>Access or use for any commercial purposes any part of the website or any services or
                                materials available through the website</li>
                        </ul>
                    </div>
                </div>

                <!-- Content Standards Section -->
                <div class="mb-12" data-aos="fade-up" data-aos-delay="200">
                    <h2 class="text-2xl font-bold text-primary-dark mb-4">4. User Content Standards</h2>
                    <div class="bg-stone rounded-xl p-6 shadow-sm">
                        <p class="text-gray-700 mb-4">If our website allows you to post, submit, publish, display, or
                            transmit content (such as comments, reviews, or project inquiries), you are entirely
                            responsible for the content you contribute.</p>
                        <p class="text-gray-700 mb-4">Any content you post must:</p>
                        <ul class="list-disc pl-6 text-gray-700 space-y-2 mb-4">
                            <li>Be accurate and compliant with applicable laws</li>
                            <li>Not infringe any patent, trademark, trade secret, copyright, or other intellectual
                                property or contractual rights</li>
                            <li>Not be defamatory, obscene, offensive, or harmful to others</li>
                            <li>Not contain any material that is unlawful, threatening, abusive, or otherwise
                                objectionable</li>
                            <li>Not impersonate any person or misrepresent your identity or affiliation with any person
                                or organization</li>
                        </ul>
                        <p class="text-gray-700">We have the right to remove any content that, in our judgment, violates
                            these Terms or may be offensive, illegal, or violate the rights of any third party, or may
                            harm or threaten the safety of any person.</p>
                    </div>
                </div>

                <!-- Disclaimer of Warranties Section -->
                <div class="mb-12" data-aos="fade-up" data-aos-delay="250">
                    <h2 class="text-2xl font-bold text-primary-dark mb-4">5. Disclaimer of Warranties</h2>
                    <div class="bg-stone rounded-xl p-6 shadow-sm">
                        <p class="text-gray-700 mb-4">YOUR USE OF OUR WEBSITE AND SERVICES IS AT YOUR SOLE RISK. THE
                            WEBSITE AND SERVICES ARE PROVIDED ON AN "AS IS" AND "AS AVAILABLE" BASIS, WITHOUT WARRANTIES
                            OF ANY KIND, EITHER EXPRESS OR IMPLIED.</p>
                        <p class="text-gray-700 mb-4">TO THE FULLEST EXTENT PERMITTED BY LAW, AKSTRUCT CONSTRUCTION LTD.
                            DISCLAIMS ALL WARRANTIES, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO IMPLIED
                            WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, AND NON-INFRINGEMENT.</p>
                        <p class="text-gray-700">WE DO NOT WARRANT THAT THE WEBSITE WILL BE UNINTERRUPTED OR ERROR-FREE,
                            THAT DEFECTS WILL BE CORRECTED, OR THAT THE WEBSITE OR SERVER IS FREE OF VIRUSES OR OTHER
                            HARMFUL COMPONENTS.</p>
                    </div>
                </div>

                <!-- Limitation of Liability Section -->
                <div class="mb-12" data-aos="fade-up" data-aos-delay="300">
                    <h2 class="text-2xl font-bold text-primary-dark mb-4">6. Limitation of Liability</h2>
                    <div class="bg-stone rounded-xl p-6 shadow-sm">
                        <p class="text-gray-700 mb-4">TO THE FULLEST EXTENT PERMITTED BY LAW, IN NO EVENT SHALL AKSTRUCT
                            CONSTRUCTION LTD., ITS AFFILIATES, DIRECTORS, OFFICERS, EMPLOYEES, AGENTS, OR SERVICE
                            PROVIDERS BE LIABLE FOR ANY INDIRECT, INCIDENTAL, SPECIAL, CONSEQUENTIAL, OR PUNITIVE
                            DAMAGES, INCLUDING BUT NOT LIMITED TO, LOSS OF PROFITS, DATA, USE, GOODWILL, OR OTHER
                            INTANGIBLE LOSSES, RESULTING FROM:</p>
                        <ul class="list-disc pl-6 text-gray-700 space-y-2">
                            <li>YOUR ACCESS TO OR USE OF OR INABILITY TO ACCESS OR USE THE WEBSITE</li>
                            <li>ANY CONDUCT OR CONTENT OF ANY THIRD PARTY ON THE WEBSITE</li>
                            <li>ANY CONTENT OBTAINED FROM THE WEBSITE</li>
                            <li>UNAUTHORIZED ACCESS, USE, OR ALTERATION OF YOUR TRANSMISSIONS OR CONTENT</li>
                        </ul>
                    </div>
                </div>

                <!-- Indemnification Section -->
                <div class="mb-12" data-aos="fade-up" data-aos-delay="350">
                    <h2 class="text-2xl font-bold text-primary-dark mb-4">7. Indemnification</h2>
                    <div class="bg-stone rounded-xl p-6 shadow-sm">
                        <p class="text-gray-700">You agree to defend, indemnify, and hold harmless Akstruct Construction
                            Ltd., its affiliates, licensors, and service providers, and its and their respective
                            officers, directors, employees, contractors, agents, licensors, suppliers, successors, and
                            assigns from and against any claims, liabilities, damages, judgments, awards, losses, costs,
                            expenses, or fees (including reasonable attorneys' fees) arising out of or relating to your
                            violation of these Terms or your use of the website.</p>
                    </div>
                </div>

                <!-- Governing Law Section -->
                <div class="mb-12" data-aos="fade-up" data-aos-delay="400">
                    <h2 class="text-2xl font-bold text-primary-dark mb-4">8. Governing Law and Jurisdiction</h2>
                    <div class="bg-stone rounded-xl p-6 shadow-sm">
                        <p class="text-gray-700">These Terms and any dispute or claim arising out of or in connection
                            with them or their subject matter or formation shall be governed by and construed in
                            accordance with the laws of the Federal Republic of Nigeria. Any legal suit, action, or
                            proceeding arising out of or related to these Terms or the website shall be instituted
                            exclusively in the federal or state courts located in the Federal Capital Territory, Abuja,
                            Nigeria.</p>
                    </div>
                </div>

                <!-- Changes to Terms Section -->
                <div class="mb-12" data-aos="fade-up" data-aos-delay="450">
                    <h2 class="text-2xl font-bold text-primary-dark mb-4">9. Changes to Terms of Service</h2>
                    <div class="bg-stone rounded-xl p-6 shadow-sm">
                        <p class="text-gray-700">We may revise and update these Terms from time to time at our sole
                            discretion. All changes are effective immediately when posted, and they apply to all access
                            to and use of the website thereafter. Your continued use of the website following the
                            posting of revised Terms means that you accept and agree to the changes.</p>
                    </div>
                </div>

                <!-- Termination Section -->
                <div class="mb-12" data-aos="fade-up" data-aos-delay="500">
                    <h2 class="text-2xl font-bold text-primary-dark mb-4">10. Termination</h2>
                    <div class="bg-stone rounded-xl p-6 shadow-sm">
                        <p class="text-gray-700">We may terminate or suspend your access to all or part of our website,
                            without notice, for any conduct that we, in our sole discretion, believe violates these
                            Terms or is harmful to other users of the website or third parties, or for any other reason.
                        </p>
                    </div>
                </div>

                <!-- Entire Agreement Section -->
                <div class="mb-12" data-aos="fade-up" data-aos-delay="550">
                    <h2 class="text-2xl font-bold text-primary-dark mb-4">11. Entire Agreement</h2>
                    <div class="bg-stone rounded-xl p-6 shadow-sm">
                        <p class="text-gray-700">These Terms, together with our Privacy Policy, constitute the entire
                            agreement between you and Akstruct Construction Ltd. regarding our website and supersede all
                            prior and contemporaneous understandings, agreements, representations, and warranties, both
                            written and oral.</p>
                    </div>
                </div>

                <!-- Contact Information Section -->
                <div class="bg-stone rounded-xl p-8 shadow-md" data-aos="fade-up" data-aos-delay="600">
                    <h2 class="text-2xl font-bold text-primary-dark mb-4">Contact Us</h2>
                    <p class="text-gray-700 mb-6">
                        If you have any questions about these Terms of Service, please contact us at:
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
