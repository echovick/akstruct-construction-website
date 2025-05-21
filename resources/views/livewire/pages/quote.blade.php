<?php

use App\Models\Quote;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

new #[Layout('layout.web')] class extends Component {
    use WithFileUploads;

    public $name;
    public $email;
    public $phone;
    public $company;
    public $projectType;
    public $budgetRange;
    public $location;
    public $projectDescription;
    public $timeline;
    public $documents = [];

    public $successMessage = '';

    public function submitQuoteRequest()
    {
        $this->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'phone' => 'required|string',
            'projectType' => 'required|string',
            'budgetRange' => 'required|string',
            'projectDescription' => 'required|string|min:10',
            'documents.*' => 'nullable|file|max:10240', // 10MB max file size
        ]);

        try {
            $quote = new Quote();
            $quote->name = $this->name;
            $quote->email = $this->email;
            $quote->phone = $this->phone;
            $quote->company = $this->company;
            $quote->project_type = $this->projectType;
            $quote->budget_range = $this->budgetRange;
            $quote->location = $this->location;
            $quote->project_description = $this->projectDescription;
            $quote->timeline = $this->timeline;

            // Handle file uploads
            if (!empty($this->documents)) {
                $documentPaths = [];

                foreach ($this->documents as $document) {
                    $path = $document->store('quotes/documents', 'public');
                    $documentPaths[] = $path;
                }

                $quote->documents = json_encode($documentPaths);
            }

            $quote->save();

            // Send notification email to admin and confirmation email to user
            // Mail::to(config('mail.admin_email'))->send(new QuoteRequestNotification($quote));
            // Mail::to($this->email)->send(new QuoteRequestConfirmation($quote));

            $this->reset(['name', 'email', 'phone', 'company', 'projectType', 'budgetRange', 'location', 'projectDescription', 'timeline', 'documents']);
            $this->successMessage = 'Your quote request has been submitted successfully. Our team will contact you shortly.';
        } catch (\Exception $e) {
            session()->flash('error', 'There was an error submitting your quote request. Please try again later.');
        }
    }

    public function with(): array
    {
        return [
            'projectTypes' => ['Residential Construction', 'Commercial Construction', 'Industrial Construction', 'Renovation & Retrofitting', 'Sustainable Design & Build', 'Project Consultancy', 'Real Estate Development', 'Engineering Solutions', 'Other'],
            'budgetRanges' => ['Under ₦10 Million', '₦10 Million - ₦50 Million', '₦50 Million - ₦100 Million', '₦100 Million - ₦500 Million', '₦500 Million - ₦1 Billion', 'Over ₦1 Billion', 'To Be Determined'],
            'timelines' => ['Immediate (1-3 months)', 'Short-term (3-6 months)', 'Medium-term (6-12 months)', 'Long-term (1-2 years)', 'Strategic (2+ years)', 'To Be Determined'],
        ];
    }
}; ?>

<div>
    <!-- Hero Section with Parallax Effect -->
    <section class="relative bg-primary-dark text-white overflow-hidden">
        <!-- Background image with overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('assets/IMG_7144.JPG') }}" alt="Request a Quote"
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
                    Request a Quote</h1>
                <p class="text-xl text-white/90 mb-8 leading-relaxed">Let us bring your vision to life with our
                    sustainable construction solutions</p>

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
                                <span class="text-white/80">Request a Quote</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- Quote Request Form Section -->
    <section class="py-20 bg-white relative overflow-hidden">
        <!-- Background elements -->
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-stone/50 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-60 h-60 bg-secondary/10 rounded-full blur-3xl"></div>
        <div class="absolute inset-0 bg-pattern opacity-5 z-0"
            style="background-image: url('{{ asset('assets/img/pattern.svg') }}');"></div>

        <div class="container mx-auto px-4 relative z-10">
            @if ($successMessage)
                <div class="bg-green-50 border-l-4 border-green-500 p-6 rounded-lg shadow-lg mb-12" data-aos="fade-up">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-green-500 text-3xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-medium text-green-800">Quote Request Submitted Successfully!</h3>
                            <p class="mt-2 text-green-700">{{ $successMessage }}</p>
                            <div class="mt-4">
                                <a href="{{ route('home') }}"
                                    class="inline-flex items-center text-secondary hover:text-primary">
                                    <i class="fas fa-arrow-left mr-2"></i>
                                    Return to Home
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-12">
                    <!-- Left column: Form -->
                    <div class="lg:col-span-3" data-aos="fade-right">
                        <div class="bg-white rounded-xl shadow-xl p-8 border border-gray-100">
                            <h2 class="font-heading font-bold text-2xl md:text-3xl mb-6">Tell Us About Your Project</h2>
                            <p class="text-gray-600 mb-8">
                                Please complete the form below to request a detailed quote for your construction
                                project. Our team will review your requirements and respond within 24-48 hours.
                            </p>

                            <form wire:submit.prevent="submitQuoteRequest" class="space-y-6">
                                <!-- Personal Information -->
                                <div>
                                    <h3 class="text-xl font-semibold mb-4 text-primary-dark">Contact Information</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- Name -->
                                        <div>
                                            <label for="name"
                                                class="block text-sm font-medium text-gray-700 mb-1">Full Name <span
                                                    class="text-red-500">*</span></label>
                                            <input type="text" id="name" wire:model="name"
                                                class="form-input w-full rounded-lg" placeholder="Enter your full name">
                                            @error('name')
                                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                                        <div>
                                            <label for="email"
                                                class="block text-sm font-medium text-gray-700 mb-1">Email Address <span
                                                    class="text-red-500">*</span></label>
                                            <input type="email" id="email" wire:model="email"
                                                class="form-input w-full rounded-lg"
                                                placeholder="Enter your email address">
                                            @error('email')
                                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Phone -->
                                        <div>
                                            <label for="phone"
                                                class="block text-sm font-medium text-gray-700 mb-1">Phone Number <span
                                                    class="text-red-500">*</span></label>
                                            <input type="tel" id="phone" wire:model="phone"
                                                class="form-input w-full rounded-lg"
                                                placeholder="Enter your phone number">
                                            @error('phone')
                                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Company -->
                                        <div>
                                            <label for="company"
                                                class="block text-sm font-medium text-gray-700 mb-1">Company/Organization</label>
                                            <input type="text" id="company" wire:model="company"
                                                class="form-input w-full rounded-lg"
                                                placeholder="Enter your company name (if applicable)">
                                        </div>
                                    </div>
                                </div>

                                <!-- Project Details -->
                                <div>
                                    <h3 class="text-xl font-semibold mb-4 text-primary-dark">Project Details</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- Project Type -->
                                        <div>
                                            <label for="projectType"
                                                class="block text-sm font-medium text-gray-700 mb-1">Project Type <span
                                                    class="text-red-500">*</span></label>
                                            <select id="projectType" wire:model="projectType"
                                                class="form-select w-full rounded-lg">
                                                <option value="">Select project type</option>
                                                @foreach ($projectTypes as $type)
                                                    <option value="{{ $type }}">{{ $type }}</option>
                                                @endforeach
                                            </select>
                                            @error('projectType')
                                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Budget Range -->
                                        <div>
                                            <label for="budgetRange"
                                                class="block text-sm font-medium text-gray-700 mb-1">Budget Range <span
                                                    class="text-red-500">*</span></label>
                                            <select id="budgetRange" wire:model="budgetRange"
                                                class="form-select w-full rounded-lg">
                                                <option value="">Select budget range</option>
                                                @foreach ($budgetRanges as $range)
                                                    <option value="{{ $range }}">{{ $range }}</option>
                                                @endforeach
                                            </select>
                                            @error('budgetRange')
                                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Location -->
                                        <div>
                                            <label for="location"
                                                class="block text-sm font-medium text-gray-700 mb-1">Project
                                                Location</label>
                                            <input type="text" id="location" wire:model="location"
                                                class="form-input w-full rounded-lg"
                                                placeholder="Enter project location">
                                        </div>

                                        <!-- Timeline -->
                                        <div>
                                            <label for="timeline"
                                                class="block text-sm font-medium text-gray-700 mb-1">Expected
                                                Timeline</label>
                                            <select id="timeline" wire:model="timeline"
                                                class="form-select w-full rounded-lg">
                                                <option value="">Select expected timeline</option>
                                                @foreach ($timelines as $option)
                                                    <option value="{{ $option }}">{{ $option }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Project Description -->
                                    <div class="mt-6">
                                        <label for="projectDescription"
                                            class="block text-sm font-medium text-gray-700 mb-1">Project Description
                                            <span class="text-red-500">*</span></label>
                                        <textarea id="projectDescription" wire:model="projectDescription" rows="5"
                                            class="form-textarea w-full rounded-lg"
                                            placeholder="Please describe your project, including specific requirements, objectives, and any other relevant details"></textarea>
                                        @error('projectDescription')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- File Uploads -->
                                    <div class="mt-6">
                                        <label for="documents"
                                            class="block text-sm font-medium text-gray-700 mb-2">Upload
                                            Documents</label>
                                        <p class="text-sm text-gray-500 mb-3">Upload any relevant files such as
                                            drawings, specifications, or reference materials (optional). Maximum 10MB
                                            per file.</p>
                                        <div
                                            class="relative border-2 border-dashed border-gray-300 rounded-lg p-6 flex flex-col items-center justify-center hover:bg-gray-50 transition-colors">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                                fill="none" viewBox="0 0 48 48">
                                                <path
                                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                    stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <div class="mt-4 text-center">
                                                <label for="file-upload" class="cursor-pointer">
                                                    <span class="btn btn-primary text-sm py-2">Select Files</span>
                                                    <input id="file-upload" wire:model="documents" type="file"
                                                        class="sr-only" multiple>
                                                </label>
                                            </div>
                                            <p class="text-xs text-gray-500 mt-2">PDF, DWG, DXF, JPG, PNG up to 10MB
                                            </p>
                                        </div>

                                        @error('documents.*')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror

                                        <!-- File Preview -->
                                        @if (!empty($documents))
                                            <div class="mt-4">
                                                <h4 class="text-sm font-medium text-gray-700 mb-2">Selected Files:</h4>
                                                <ul class="space-y-2">
                                                    @foreach ($documents as $document)
                                                        <li
                                                            class="bg-gray-50 rounded-lg p-2 flex items-center justify-between">
                                                            <div class="flex items-center">
                                                                <i class="fas fa-file-alt text-primary mr-2"></i>
                                                                <span
                                                                    class="text-sm">{{ $document->getClientOriginalName() }}</span>
                                                            </div>
                                                            <span
                                                                class="text-xs text-gray-500">{{ round($document->getSize() / 1024) }}
                                                                KB</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Privacy Policy & Submit -->
                                <div class="pt-4">
                                    <div class="flex items-start mb-6">
                                        <div class="flex items-center h-5">
                                            <input id="privacy" type="checkbox" required
                                                class="focus:ring-secondary h-4 w-4 text-secondary border-gray-300 rounded">
                                        </div>
                                        <label for="privacy" class="ml-2 text-sm text-gray-600">
                                            I agree to the processing of my personal data in accordance with Akstruct's
                                            <a href="#" class="text-secondary hover:underline">Privacy
                                                Policy</a>.
                                        </label>
                                    </div>

                                    <button type="submit" class="btn btn-primary w-full md:w-auto">
                                        <span>Submit Quote Request</span>
                                        <i class="fas fa-paper-plane ml-2"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Right column: Info -->
                    <div class="lg:col-span-2" data-aos="fade-left">
                        <!-- Quote Process -->
                        <div class="bg-stone rounded-xl shadow-lg p-8 mb-8">
                            <h3 class="text-xl font-bold text-primary-dark mb-6">Our Quote Process</h3>

                            <div class="space-y-6">
                                <!-- Step 1 -->
                                <div class="flex items-start">
                                    <div
                                        class="flex-shrink-0 bg-secondary text-primary-dark w-8 h-8 rounded-full flex items-center justify-center font-bold mt-0.5">
                                        1</div>
                                    <div class="ml-4">
                                        <h4 class="font-medium">Submit Request</h4>
                                        <p class="text-gray-600 text-sm mt-1">Fill out our quote request form with your
                                            project details.</p>
                                    </div>
                                </div>

                                <!-- Step 2 -->
                                <div class="flex items-start">
                                    <div
                                        class="flex-shrink-0 bg-secondary text-primary-dark w-8 h-8 rounded-full flex items-center justify-center font-bold mt-0.5">
                                        2</div>
                                    <div class="ml-4">
                                        <h4 class="font-medium">Initial Review</h4>
                                        <p class="text-gray-600 text-sm mt-1">Our team reviews your requirements within
                                            24-48 hours.</p>
                                    </div>
                                </div>

                                <!-- Step 3 -->
                                <div class="flex items-start">
                                    <div
                                        class="flex-shrink-0 bg-secondary text-primary-dark w-8 h-8 rounded-full flex items-center justify-center font-bold mt-0.5">
                                        3</div>
                                    <div class="ml-4">
                                        <h4 class="font-medium">Consultation</h4>
                                        <p class="text-gray-600 text-sm mt-1">We schedule a consultation to discuss
                                            your project in detail.</p>
                                    </div>
                                </div>

                                <!-- Step 4 -->
                                <div class="flex items-start">
                                    <div
                                        class="flex-shrink-0 bg-secondary text-primary-dark w-8 h-8 rounded-full flex items-center justify-center font-bold mt-0.5">
                                        4</div>
                                    <div class="ml-4">
                                        <h4 class="font-medium">Detailed Quote</h4>
                                        <p class="text-gray-600 text-sm mt-1">We provide a comprehensive quote tailored
                                            to your specific needs.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Why Choose Us -->
                        <div class="bg-primary-dark text-white rounded-xl shadow-lg p-8 mb-8 relative overflow-hidden">
                            <!-- Decorative elements -->
                            <div class="absolute top-0 right-0 w-32 h-32 bg-secondary/20 rounded-bl-full"></div>
                            <div class="absolute bottom-0 left-0 w-32 h-32 bg-accent/20 rounded-tr-full"></div>

                            <h3 class="text-xl font-bold mb-6 relative z-10">Why Choose Akstruct</h3>

                            <div class="space-y-4 relative z-10">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 text-secondary mr-3">
                                        <i class="fas fa-check-circle text-xl"></i>
                                    </div>
                                    <p>Sustainable Construction Practices</p>
                                </div>

                                <div class="flex items-center">
                                    <div class="flex-shrink-0 text-secondary mr-3">
                                        <i class="fas fa-check-circle text-xl"></i>
                                    </div>
                                    <p>Experienced & Professional Team</p>
                                </div>

                                <div class="flex items-center">
                                    <div class="flex-shrink-0 text-secondary mr-3">
                                        <i class="fas fa-check-circle text-xl"></i>
                                    </div>
                                    <p>Innovative Design Solutions</p>
                                </div>

                                <div class="flex items-center">
                                    <div class="flex-shrink-0 text-secondary mr-3">
                                        <i class="fas fa-check-circle text-xl"></i>
                                    </div>
                                    <p>Transparent Pricing & Timeline</p>
                                </div>

                                <div class="flex items-center">
                                    <div class="flex-shrink-0 text-secondary mr-3">
                                        <i class="fas fa-check-circle text-xl"></i>
                                    </div>
                                    <p>Quality Assurance Guarantee</p>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8">
                            <h3 class="text-xl font-bold text-primary-dark mb-6">Need Assistance?</h3>

                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-stone p-2 rounded-full mr-3">
                                        <i class="fas fa-phone text-primary"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Call us directly</p>
                                        <p class="font-medium">08140993888 | 07082323113</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-stone p-2 rounded-full mr-3">
                                        <i class="fas fa-envelope text-primary"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Email us at</p>
                                        <p class="font-medium">akstructltd@gmail.com</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-stone p-2 rounded-full mr-3">
                                        <i class="fas fa-map-marker-alt text-primary"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Visit our office</p>
                                        <p class="font-medium">Third Floor, Global Plaza, Suit C410, Jabi, Abuja
                                            900108, Federal Capital Territory</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- FAQ Preview Section -->
    <section class="py-16 bg-stone relative overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-white/50 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-60 h-60 bg-secondary/10 rounded-full blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-12">
                <h2 class="font-heading font-bold text-3xl mb-4">Frequently Asked Questions</h2>
                <p class="text-gray-600 max-w-3xl mx-auto">Find answers to common questions about our quote process and
                    services</p>
            </div>

            <div class="max-w-3xl mx-auto">
                <div class="space-y-4">
                    <!-- FAQ Item 1 -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <button class="flex justify-between items-center w-full text-left focus:outline-none">
                            <h3 class="font-medium text-lg">How long does it take to receive a quote?</h3>
                            <i class="fas fa-chevron-down text-secondary"></i>
                        </button>
                        <div class="mt-4">
                            <p class="text-gray-600">After submitting your quote request, our team will review it
                                within 24-48 hours. For standard projects, you can expect to receive a preliminary quote
                                within 3-5 business days. Complex projects may require additional time and consultation
                                to provide an accurate estimate.</p>
                        </div>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <button class="flex justify-between items-center w-full text-left focus:outline-none">
                            <h3 class="font-medium text-lg">What information do I need to provide for an accurate
                                quote?</h3>
                            <i class="fas fa-chevron-down text-secondary"></i>
                        </button>
                        <div class="mt-4">
                            <p class="text-gray-600">The more detailed information you provide, the more accurate our
                                quote will be. Project type, scope, location, budget expectations, and timeline are
                                essential. If available, architectural drawings, specifications, and site information
                                are extremely helpful. Feel free to upload these documents with your quote request.</p>
                        </div>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <button class="flex justify-between items-center w-full text-left focus:outline-none">
                            <h3 class="font-medium text-lg">Is my quote binding, and how long is it valid?</h3>
                            <i class="fas fa-chevron-down text-secondary"></i>
                        </button>
                        <div class="mt-4">
                            <p class="text-gray-600">Quotes are typically valid for 30 days from issuance. They serve
                                as estimates based on the information provided and current market conditions. Final
                                pricing may vary based on detailed assessments, site conditions, and any changes to
                                project scope or materials.</p>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-8">
                    <a href="{{ route('faq') }}" class="btn btn-primary">
                        <span>View All FAQs</span>
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Preview -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="font-heading font-bold text-3xl mb-4">What Our Clients Say</h2>
                <p class="text-gray-600 max-w-3xl mx-auto">Feedback from clients who have experienced our professional
                    services</p>
            </div>

            <div class="max-w-5xl mx-auto">
                <div class="bg-primary-dark text-white p-10 rounded-xl shadow-xl relative overflow-hidden">
                    <!-- Decorative elements -->
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-secondary/20 rounded-full filter blur-2xl">
                    </div>
                    <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-accent/20 rounded-full filter blur-2xl">
                    </div>

                    <div class="relative z-10 flex flex-col md:flex-row items-center gap-8">
                        <div class="text-secondary text-8xl opacity-20 md:w-1/4 flex justify-center">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <div class="md:w-3/4">
                            <p class="text-xl md:text-2xl italic font-light leading-relaxed mb-6">
                                "Working with Akstruct was a seamless experience. Their attention to detail and
                                commitment to sustainability exceeded our expectations. The team's responsive
                                communication and ability to adapt to our changing requirements made the entire process
                                stress-free."
                            </p>
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-full bg-white/10 flex items-center justify-center mr-4">
                                    <span class="font-bold text-secondary">AJ</span>
                                </div>
                                <div>
                                    <h5 class="font-semibold">Adebayo Johnson</h5>
                                    <p class="text-white/70 text-sm">Project Manager, Horizon Development</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-secondary relative overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute inset-0 bg-pattern opacity-10"
            style="background-image: url('{{ asset('assets/img/pattern.svg') }}');"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full filter blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/10 rounded-full filter blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="font-heading font-bold text-3xl md:text-4xl text-primary-dark mb-6" data-aos="fade-up">
                    Still Have Questions?</h2>
                <p class="text-lg text-primary-dark/90 mb-8 max-w-3xl mx-auto" data-aos="fade-up"
                    data-aos-delay="100">
                    Our team is happy to address any questions you may have. Contact us directly for personalized
                    assistance.
                </p>
                <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4"
                    data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('contact') }}"
                        class="btn bg-white text-primary-dark hover:bg-gray-100 text-center">
                        <span>Contact Us</span>
                        <i class="fas fa-envelope ml-2"></i>
                    </a>
                    <a href="{{ route('faq') }}"
                        class="btn bg-primary-dark text-white hover:bg-primary-dark/90 text-center">
                        <span>Browse FAQs</span>
                        <i class="fas fa-question-circle ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
