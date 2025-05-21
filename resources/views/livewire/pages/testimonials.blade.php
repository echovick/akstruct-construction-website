<?php

use App\Models\Testimonial;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('layout.web')] class extends Component {
    public function with(): array
    {
        return [
            'testimonials' => Testimonial::where('is_featured', true)->get(),
            'pageTitle' => 'What Our Clients Say | Akstruct Construction',
        ];
    }
}; ?>

<div>
    <!-- Page Header -->
    <x-breadcrumbs :title="'Testimonials'" :subtitle="'What Our Clients Say'" />

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

            <!-- Testimonials Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" data-aos="fade-up">
                <!-- Testimonial 1 -->
                <div
                    class="bg-white rounded-xl shadow-lg p-8 h-full flex flex-col transition-transform duration-300 hover:-translate-y-2 border border-gray-100">
                    <div class="text-secondary mb-6">
                        <i class="fas fa-quote-left text-3xl opacity-20"></i>
                    </div>
                    <div class="mb-6 flex-grow">
                        <p class="text-gray-600 italic leading-relaxed">"Working with Akstruct was a seamless
                            experience. Their attention to detail and commitment to sustainability exceeded our
                            expectations."</p>
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

                <!-- Testimonial 2 -->
                <div
                    class="bg-white rounded-xl shadow-lg p-8 h-full flex flex-col transition-transform duration-300 hover:-translate-y-2 border border-gray-100">
                    <div class="text-secondary mb-6">
                        <i class="fas fa-quote-left text-3xl opacity-20"></i>
                    </div>
                    <div class="mb-6 flex-grow">
                        <p class="text-gray-600 italic leading-relaxed">"From design to execution, Akstruct delivered a
                            high-quality project on time and within budget. Their team's expertise in sustainable
                            construction practices is truly impressive."</p>
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

                <!-- Testimonial 3 -->
                <div
                    class="bg-white rounded-xl shadow-lg p-8 h-full flex flex-col transition-transform duration-300 hover:-translate-y-2 border border-gray-100">
                    <div class="text-secondary mb-6">
                        <i class="fas fa-quote-left text-3xl opacity-20"></i>
                    </div>
                    <div class="mb-6 flex-grow">
                        <p class="text-gray-600 italic leading-relaxed">"Akstruct's approach to our office renovation
                            was exceptional. They incorporated energy-efficient solutions that have significantly
                            reduced our operational costs while creating a more comfortable work environment."</p>
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

                <!-- Testimonial 4 -->
                <div
                    class="bg-white rounded-xl shadow-lg p-8 h-full flex flex-col transition-transform duration-300 hover:-translate-y-2 border border-gray-100">
                    <div class="text-secondary mb-6">
                        <i class="fas fa-quote-left text-3xl opacity-20"></i>
                    </div>
                    <div class="mb-6 flex-grow">
                        <p class="text-gray-600 italic leading-relaxed">"The team at Akstruct has consistently
                            demonstrated a deep understanding of sustainable engineering principles. Their innovative
                            approach to our commercial project resulted in a building that not only looks spectacular
                            but also operates with remarkable energy efficiency."</p>
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
                                <span class="text-lg font-bold">O</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-lg">Oluwaseun Ademola</h4>
                                <p class="text-gray-500 text-sm">Real Estate Developer, Lagos</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 5 -->
                <div
                    class="bg-white rounded-xl shadow-lg p-8 h-full flex flex-col transition-transform duration-300 hover:-translate-y-2 border border-gray-100">
                    <div class="text-secondary mb-6">
                        <i class="fas fa-quote-left text-3xl opacity-20"></i>
                    </div>
                    <div class="mb-6 flex-grow">
                        <p class="text-gray-600 italic leading-relaxed">"We were impressed by Akstruct's ability to
                            handle complex engineering challenges without compromising on deadlines or quality. Their
                            commitment to sustainability goes beyond mere words—it's embedded in every aspect of their
                            work."</p>
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
                                <span class="text-lg font-bold">N</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-lg">Ngozi Eze</h4>
                                <p class="text-gray-500 text-sm">Facilities Manager, GreenTech Solutions</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 6 -->
                <div
                    class="bg-white rounded-xl shadow-lg p-8 h-full flex flex-col transition-transform duration-300 hover:-translate-y-2 border border-gray-100">
                    <div class="text-secondary mb-6">
                        <i class="fas fa-quote-left text-3xl opacity-20"></i>
                    </div>
                    <div class="mb-6 flex-grow">
                        <p class="text-gray-600 italic leading-relaxed">"As a repeat client, I can attest to Akstruct's
                            consistency in delivering exceptional results. Their attention to detail and proactive
                            problem-solving approach makes them a reliable partner for any construction project."</p>
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
                                <span class="text-lg font-bold">I</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-lg">Ibrahim Musa</h4>
                                <p class="text-gray-500 text-sm">Property Developer, Northern Estates</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video Testimonial Section -->
            <div class="mt-20">
                <div class="text-center mb-12">
                    <span class="text-secondary text-sm uppercase tracking-widest font-medium mb-2 block">VIDEO
                        TESTIMONIALS</span>
                    <h3 class="font-heading font-bold text-2xl md:text-3xl mb-4">Hear Directly From Our Clients</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Video Testimonial 1 -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden" data-aos="fade-up">
                        <div class="aspect-w-16 aspect-h-9">
                            <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen class="w-full h-full object-cover"></iframe>
                        </div>
                        <div class="p-6">
                            <h4 class="font-bold text-xl mb-2">Project Showcase: Lagos Office Complex</h4>
                            <p class="text-gray-600">Client testimonial and walkthrough of our sustainable office
                                development in Lagos.</p>
                        </div>
                    </div>

                    <!-- Video Testimonial 2 -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden" data-aos="fade-up"
                        data-aos-delay="100">
                        <div class="aspect-w-16 aspect-h-9">
                            <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen class="w-full h-full object-cover"></iframe>
                        </div>
                        <div class="p-6">
                            <h4 class="font-bold text-xl mb-2">Client Interview: Residential Development</h4>
                            <p class="text-gray-600">Hear from our residential clients about their experience working
                                with Akstruct Construction.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Client Logos Section -->
            <div class="mt-20 bg-white rounded-xl shadow-lg p-10" data-aos="fade-up">
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

    <!-- Call-to-Action Section -->
    <section class="py-16 bg-stone relative overflow-hidden">
        <div class="absolute inset-0 bg-pattern opacity-10 z-0"
            style="background-image: url('{{ asset('assets/img/pattern.svg') }}');"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="bg-white rounded-2xl shadow-lg p-10 max-w-5xl mx-auto" data-aos="fade-up">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
                    <div>
                        <h3 class="font-heading font-bold text-2xl md:text-3xl mb-4">Become Our Next Success Story</h3>
                        <p class="text-gray-600 mb-6">Start your journey with Akstruct today and experience the
                            difference that quality, sustainability, and professionalism make in construction.</p>

                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="{{ route('quote') }}" class="btn btn-primary">Request a Quote</a>
                            <a href="{{ route('contact') }}" class="btn btn-outline-primary">Contact Us</a>
                        </div>
                    </div>

                    <div class="hidden md:block">
                        <img src="{{ asset('assets/img/cta-image.svg') }}" alt="Start Your Project"
                            class="w-full h-auto">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
