<?php

use App\Models\Setting;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('layout.web')] class extends Component {
    public $name;
    public $email;
    public $phone;
    public $subject;
    public $message;
    public $success = false;

    public function submitContactForm()
    {
        $this->validate([
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|min:2|max:100',
            'message' => 'required|string|min:10|max:1000',
        ]);

        // Here you would typically send this to an email or save to database
        // For now, we'll just show a success message
        $this->success = true;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->subject = '';
        $this->message = '';
    }

    public function with(): array
    {
        return [
            'address' => Setting::getValue('company_address', 'Third Floor, Global Plaza, Suit C410, Jabi, Abuja 900108, Federal Capital Territory'),
            'phone1' => Setting::getValue('company_phone_1', '08140993888'),
            'phone2' => Setting::getValue('company_phone_2', '07082323113'),
            'email' => Setting::getValue('company_email', 'akstructltd@gmail.com'),
            'instagram' => Setting::getValue('instagram_handle', '@akstruct_africa'),
            'instagramUrl' => Setting::getValue('instagram_url', 'https://www.instagram.com/akstruct_ltd?igsh=MTNueWcxa2ZsNWp4Mw=='),
            'officeHours' => Setting::getValue('office_hours', 'Monday - Friday: 8:00 AM - 5:00 PM | Saturday: 9:00 AM - 1:00 PM'),
            'mapEmbedUrl' => Setting::getValue('map_embed_url', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3939.9262738913984!2d7.4102385!3d9.062379!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x104e0babd4d6c2e5%3A0x82d36e1c3f08c0d1!2sGlobal%20Plaza%2C%20Jabi%2C%20Abuja!5e0!3m2!1sen!2sng!4v1651234567890!5m2!1sen!2sng'),
        ];
    }
}; ?>

<div>
    <!-- Hero Section with Parallax Effect -->
    <section class="relative bg-primary-dark text-white overflow-hidden">
        <!-- Background image with overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('assets/IMG_7143.JPG') }}" alt="Contact Akstruct Construction"
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
                <h1 class="font-heading font-bold text-4xl md:text-5xl lg:text-6xl mb-6 text-white leading-tight">Let's
                    Build Together</h1>
                <p class="text-xl text-white/90 mb-8 leading-relaxed">Get in touch with our team to discuss your project
                    requirements or simply learn more about our services.</p>

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
                                <span class="text-white/80">Contact Us</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- Contact Information Section -->
    <section class="py-20 bg-white relative overflow-hidden">
        <!-- Background elements -->
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-stone/50 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-60 h-60 bg-secondary/10 rounded-full blur-3xl"></div>
        <div class="absolute inset-0 bg-pattern opacity-5 z-0"
            style="background-image: url('{{ asset('assets/img/pattern.svg') }}');"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <span class="text-secondary text-sm uppercase tracking-widest font-medium mb-2 block"
                    data-aos="fade-down">CONTACT US</span>
                <h2 class="font-heading font-bold text-3xl md:text-4xl lg:text-5xl mb-4" data-aos="fade-up">
                    Get In Touch With Our Team</h2>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    We're eager to hear about your project and discuss how our sustainable construction solutions can
                    bring your vision to life
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Form Card -->
                <div data-aos="fade-right">
                    <div class="bg-white rounded-xl shadow-xl p-8 h-full relative overflow-hidden">
                        <!-- Decorative corner -->
                        <div class="absolute top-0 right-0 w-24 h-24 bg-secondary/10 rounded-bl-full"></div>

                        <div class="relative z-10">
                            <h3 class="text-2xl font-bold mb-6">Send Us a Message</h3>

                            @if ($success)
                                <div
                                    class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
                                    <div class="flex items-center">
                                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                        <p>Your message has been sent successfully! We'll be in touch with you shortly.
                                        </p>
                                    </div>
                                </div>
                            @endif

                            <form wire:submit.prevent="submitContactForm" class="space-y-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" id="name" wire:model="name" placeholder="Your name"
                                        class="form-input w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-secondary focus:border-secondary">
                                    @error('name')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email
                                            Address <span class="text-red-500">*</span></label>
                                        <input type="email" id="email" wire:model="email"
                                            placeholder="Your email address"
                                            class="form-input w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-secondary focus:border-secondary">
                                        @error('email')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone
                                            Number</label>
                                        <input type="text" id="phone" wire:model="phone"
                                            placeholder="Your phone number"
                                            class="form-input w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-secondary focus:border-secondary">
                                        @error('phone')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" id="subject" wire:model="subject"
                                        placeholder="Message subject"
                                        class="form-input w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-secondary focus:border-secondary">
                                    @error('subject')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message
                                        <span class="text-red-500">*</span></label>
                                    <textarea id="message" wire:model="message" rows="5" placeholder="Your message"
                                        class="form-textarea w-full rounded-lg px-4 py-3 border border-gray-300 focus:ring-2 focus:ring-secondary focus:border-secondary"></textarea>
                                    @error('message')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-primary w-full justify-center">
                                        <span>Send Message</span>
                                        <i class="fas fa-paper-plane ml-2"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div data-aos="fade-left">
                    <div class="space-y-8">
                        <!-- Address Card -->
                        <div
                            class="bg-white rounded-xl shadow-lg p-6 flex items-start transition-all duration-300 hover:shadow-xl">
                            <div class="bg-primary/10 p-3 rounded-full mr-4">
                                <i class="fas fa-map-marker-alt text-primary text-xl"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold mb-2">Our Office</h4>
                                <p class="text-gray-600">{{ $address }}</p>
                            </div>
                        </div>

                        <!-- Phones Card -->
                        <div
                            class="bg-white rounded-xl shadow-lg p-6 flex items-start transition-all duration-300 hover:shadow-xl">
                            <div class="bg-secondary/10 p-3 rounded-full mr-4">
                                <i class="fas fa-phone-alt text-secondary text-xl"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold mb-2">Phone Numbers</h4>
                                <p class="text-gray-600 mb-1">{{ $phone1 }}</p>
                                <p class="text-gray-600">{{ $phone2 }}</p>
                            </div>
                        </div>

                        <!-- Email Card -->
                        <div
                            class="bg-white rounded-xl shadow-lg p-6 flex items-start transition-all duration-300 hover:shadow-xl">
                            <div class="bg-accent/10 p-3 rounded-full mr-4">
                                <i class="fas fa-envelope text-accent text-xl"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold mb-2">Email Address</h4>
                                <p class="text-gray-600">{{ $email }}</p>
                            </div>
                        </div>

                        <!-- Office Hours Card -->
                        <div
                            class="bg-white rounded-xl shadow-lg p-6 flex items-start transition-all duration-300 hover:shadow-xl">
                            <div class="bg-primary-dark/10 p-3 rounded-full mr-4">
                                <i class="fas fa-clock text-primary-dark text-xl"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold mb-2">Office Hours</h4>
                                <p class="text-gray-600">{{ $officeHours }}</p>
                            </div>
                        </div>

                        <!-- Social Media Card -->
                        <div
                            class="bg-white rounded-xl shadow-lg p-6 flex items-start transition-all duration-300 hover:shadow-xl">
                            <div class="bg-purple-100 p-3 rounded-full mr-4">
                                <i class="fab fa-instagram text-purple-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold mb-2">Follow Us</h4>
                                <p class="text-gray-600">Instagram: <a href="{{ $instagramUrl }}" target="_blank"
                                        class="text-purple-600 hover:underline">{{ $instagram }}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-16 bg-stone relative overflow-hidden">
        <!-- Background pattern -->
        <div class="absolute inset-0 bg-pattern opacity-10 z-0"
            style="background-image: url('{{ asset('assets/img/pattern.svg') }}');"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-12">
                <span class="text-secondary text-sm uppercase tracking-widest font-medium mb-2 block"
                    data-aos="fade-down">FIND US</span>
                <h2 class="font-heading font-bold text-3xl md:text-4xl mb-4" data-aos="fade-up">Our Location</h2>
                <p class="mt-4 text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Visit our office to discuss your project in person or simply to learn more about our services
                </p>
            </div>

            <div class="bg-white p-4 rounded-xl shadow-xl" data-aos="fade-up">
                <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden">
                    <iframe src="{{ $mapEmbedUrl }}" width="100%" height="450" style="border:0;"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                        class="rounded-lg"></iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-20 bg-white relative overflow-hidden">
        <!-- Background elements -->
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-stone/50 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-60 h-60 bg-secondary/10 rounded-full blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <span class="text-secondary text-sm uppercase tracking-widest font-medium mb-2 block"
                    data-aos="fade-down">QUESTIONS</span>
                <h2 class="font-heading font-bold text-3xl md:text-4xl lg:text-5xl mb-4" data-aos="fade-up">
                    Frequently Asked Questions</h2>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Find quick answers to common questions about our services and process
                </p>
            </div>

            <div class="max-w-4xl mx-auto" data-aos="fade-up">
                <div class="space-y-6">
                    <!-- FAQ Item 1 -->
                    <div
                        class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
                        <button class="faq-question flex justify-between items-center w-full px-6 py-4 text-left">
                            <span class="text-lg font-semibold">What types of projects does Akstruct specialize
                                in?</span>
                            <i class="fas fa-plus text-primary transition-transform duration-300"></i>
                        </button>
                        <div class="faq-answer px-6 pb-4 hidden">
                            <p class="text-gray-600">We specialize in residential, commercial, and industrial
                                construction, as well as renovation and retrofitting projects. Our expertise encompasses
                                sustainable design and build, engineering solutions, and comprehensive project
                                management.</p>
                        </div>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div
                        class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
                        <button class="faq-question flex justify-between items-center w-full px-6 py-4 text-left">
                            <span class="text-lg font-semibold">How does Akstruct ensure sustainability in its
                                projects?</span>
                            <i class="fas fa-plus text-primary transition-transform duration-300"></i>
                        </button>
                        <div class="faq-answer px-6 pb-4 hidden">
                            <p class="text-gray-600">We integrate sustainable practices throughout our construction
                                process, from energy-efficient designs to waste reduction strategies. We use
                                eco-friendly materials, implement green building technologies, and focus on minimizing
                                carbon footprints to ensure long-term environmental benefits.</p>
                        </div>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div
                        class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
                        <button class="faq-question flex justify-between items-center w-full px-6 py-4 text-left">
                            <span class="text-lg font-semibold">Can Akstruct handle large-scale projects?</span>
                            <i class="fas fa-plus text-primary transition-transform duration-300"></i>
                        </button>
                        <div class="faq-answer px-6 pb-4 hidden">
                            <p class="text-gray-600">Yes, we have the expertise, resources, and experience to handle
                                large-scale projects with high quality and efficiency. Our team has successfully
                                completed numerous complex projects across various sectors, ensuring timely delivery
                                without compromising on quality or sustainability standards.</p>
                        </div>
                    </div>

                    <!-- FAQ Item 4 -->
                    <div
                        class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
                        <button class="faq-question flex justify-between items-center w-full px-6 py-4 text-left">
                            <span class="text-lg font-semibold">What is the process for getting started with
                                Akstruct?</span>
                            <i class="fas fa-plus text-primary transition-transform duration-300"></i>
                        </button>
                        <div class="faq-answer px-6 pb-4 hidden">
                            <p class="text-gray-600">Our process begins with an initial consultation to understand your
                                vision and requirements. We then develop a detailed project plan, including designs,
                                timelines, and cost estimates. Once approved, we move through the design,
                                pre-construction, construction, and handover phases, maintaining clear communication
                                throughout the process.</p>
                        </div>
                    </div>

                    <!-- FAQ Item 5 -->
                    <div
                        class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
                        <button class="faq-question flex justify-between items-center w-full px-6 py-4 text-left">
                            <span class="text-lg font-semibold">How can I request a detailed quote for my
                                project?</span>
                            <i class="fas fa-plus text-primary transition-transform duration-300"></i>
                        </button>
                        <div class="faq-answer px-6 pb-4 hidden">
                            <p class="text-gray-600">You can request a detailed quote by contacting us through our
                                website, email, or phone. Alternatively, visit our "Request a Quote" page to fill out a
                                form with your project details. Our team will review your requirements and provide a
                                comprehensive quote tailored to your specific needs.</p>
                            <div class="mt-4">
                                <a href="{{ route('quote') }}"
                                    class="inline-flex items-center text-secondary hover:text-primary-dark">
                                    <span>Get a Quote Now</span>
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
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
                    Ready to Transform Your Vision Into Reality?</h2>
                <p class="text-lg text-primary-dark/90 mb-8 max-w-3xl mx-auto" data-aos="fade-up"
                    data-aos-delay="100">
                    Partner with Akstruct Construction for innovative, sustainable solutions tailored to your specific
                    needs
                </p>
                <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4"
                    data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('quote') }}" class="btn btn-primary text-center">
                        <span>Request a Quote</span>
                        <i class="fas fa-file-invoice ml-2"></i>
                    </a>
                    <a href="{{ route('project-portfolio') }}"
                        class="btn bg-white text-primary-dark hover:bg-gray-100 text-center">
                        <span>Explore Our Projects</span>
                        <i class="fas fa-building ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // FAQ accordion functionality
            const faqQuestions = document.querySelectorAll('.faq-question');

            faqQuestions.forEach(question => {
                question.addEventListener('click', function() {
                    const answer = this.nextElementSibling;
                    const icon = this.querySelector('i');

                    // Toggle current answer
                    answer.classList.toggle('hidden');
                    icon.classList.toggle('fa-plus');
                    icon.classList.toggle('fa-minus');
                    icon.classList.toggle('rotate-45');

                    // Close other answers
                    faqQuestions.forEach(otherQuestion => {
                        if (otherQuestion !== question) {
                            const otherAnswer = otherQuestion.nextElementSibling;
                            const otherIcon = otherQuestion.querySelector('i');

                            otherAnswer.classList.add('hidden');
                            otherIcon.classList.add('fa-plus');
                            otherIcon.classList.remove('fa-minus');
                            otherIcon.classList.remove('rotate-45');
                        }
                    });
                });
            });
        });
    </script>
</div>
