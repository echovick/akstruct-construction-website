<?php

use App\Models\Career;
use App\Models\Setting;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('layout.web')] class extends Component {
    // Properties
    public $selectedDepartment = 'all';
    public $searchTerm = '';
    public $isRemoteOnly = false;
    public $locations = [];
    public $departments = [];

    // Initialize component
    public function mount()
    {
        $this->departments = Career::active()->select('department')->distinct()->pluck('department')->toArray();
        $this->locations = Career::active()->select('location')->whereNotNull('location')->distinct()->pluck('location')->toArray();
    }

    // Filter jobs based on selected criteria
    public function filterJobs()
    {
        $query = Career::active();

        if ($this->selectedDepartment !== 'all') {
            $query->where('department', $this->selectedDepartment);
        }

        if ($this->isRemoteOnly) {
            $query->where('is_remote', true);
        }

        if (!empty($this->searchTerm)) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('department', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('location', 'like', '%' . $this->searchTerm . '%');
            });
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    // Reset all filters
    public function resetFilters()
    {
        $this->selectedDepartment = 'all';
        $this->searchTerm = '';
        $this->isRemoteOnly = false;
    }

    public function with(): array
    {
        return [
            'careers' => $this->filterJobs(),
            'yearsExperience' => Setting::getValue('stats_years_experience', '8'),
        ];
    }
}; ?>

<div>
    <!-- Hero Section with Parallax Effect -->
    <section class="relative bg-primary-dark text-white overflow-hidden">
        <!-- Background image with overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('assets/Team1.jpg') }}" alt="Careers at Akstruct Construction"
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
                <h1 class="font-heading font-bold text-4xl md:text-5xl lg:text-6xl mb-6 text-white leading-tight">Join
                    Our Team</h1>
                <p class="text-xl text-white/90 mb-8 leading-relaxed">Build your career with a company that's shaping
                    the future of sustainable construction</p>

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
                                <span class="text-white/80">Careers</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- Company Culture Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Left Column with Content -->
                <div data-aos="fade-right">
                    <span class="text-secondary text-sm uppercase tracking-widest font-medium mb-2 block">WHY JOIN
                        US</span>
                    <h2 class="font-heading font-bold text-3xl md:text-4xl mb-6">Build Your Career With a Purpose</h2>

                    <p class="text-gray-700 mb-6">
                        At Akstruct Construction Ltd, we believe our people are our greatest asset. When you join our
                        team, you become part of a culture that values innovation, sustainability, and professional
                        growth. With {{ $yearsExperience }} years of industry experience, we provide an environment
                        where talent thrives and careers flourish.
                    </p>

                    <p class="text-gray-700 mb-8">
                        We are committed to building not just sustainable structures, but sustainable careers. Our team
                        members enjoy opportunities to work on diverse, challenging projects while developing their
                        skills and advancing professionally in a supportive environment.
                    </p>

                    <!-- Benefits with icons -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="flex items-start">
                            <div class="text-secondary mr-3 mt-1">
                                <i class="fas fa-chart-line text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="font-medium text-lg mb-1">Professional Growth</h3>
                                <p class="text-gray-600 text-sm">Continuous learning and advancement opportunities</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="text-secondary mr-3 mt-1">
                                <i class="fas fa-users text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="font-medium text-lg mb-1">Collaborative Culture</h3>
                                <p class="text-gray-600 text-sm">Work with talented professionals in a supportive
                                    environment</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="text-secondary mr-3 mt-1">
                                <i class="fas fa-leaf text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="font-medium text-lg mb-1">Sustainability Focus</h3>
                                <p class="text-gray-600 text-sm">Make a positive impact on the environment and society
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="text-secondary mr-3 mt-1">
                                <i class="fas fa-medal text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="font-medium text-lg mb-1">Competitive Benefits</h3>
                                <p class="text-gray-600 text-sm">Comprehensive package including health benefits and
                                    incentives</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column with Image Gallery -->
                <div data-aos="fade-left">
                    <div class="relative">
                        <!-- Decorative elements -->
                        <div class="absolute -top-6 -left-6 w-24 h-24 bg-secondary/20 rounded-lg"></div>
                        <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-accent/20 rounded-lg"></div>

                        <!-- Main image -->
                        <div class="relative z-10 rounded-xl overflow-hidden shadow-2xl">
                            <img src="{{ asset('assets/Team5.jpg') }}" alt="Akstruct Team" class="w-full h-auto">
                        </div>

                        <!-- Floating smaller images -->
                        <div
                            class="absolute -bottom-12 -left-12 z-20 w-32 h-32 rounded-lg overflow-hidden shadow-xl border-4 border-white transform rotate-6">
                            <img src="{{ asset('assets/Team2.jpg') }}" alt="Team Collaboration"
                                class="w-full h-full object-cover">
                        </div>
                        <div
                            class="absolute -top-10 -right-10 z-20 w-28 h-28 rounded-lg overflow-hidden shadow-xl border-4 border-white transform -rotate-6">
                            <img src="{{ asset('assets/Team3.jpg') }}" alt="Team Member"
                                class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Job Openings Section -->
    <section class="py-20 bg-stone relative overflow-hidden">
        <!-- Background elements -->
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-stone/50 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-60 h-60 bg-secondary/10 rounded-full blur-3xl"></div>
        <div class="absolute inset-0 bg-pattern opacity-5 z-0"
            style="background-image: url('{{ asset('assets/img/pattern.svg') }}');"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-12">
                <span class="text-secondary text-sm uppercase tracking-widest font-medium mb-2 block"
                    data-aos="fade-down">OPPORTUNITIES</span>
                <h2 class="font-heading font-bold text-3xl md:text-4xl lg:text-5xl mb-4" data-aos="fade-up">Current
                    Openings</h2>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Explore our current job opportunities and find your perfect role in sustainable construction
                </p>
            </div>

            <!-- Search and Filter Controls -->
            <div class="bg-white p-6 rounded-xl shadow-lg mb-8" data-aos="fade-up">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Search -->
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                        <div class="relative">
                            <input type="text" id="search" wire:model.live="searchTerm"
                                placeholder="Search by title, keyword..."
                                class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg w-full focus:ring-secondary focus:border-secondary">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Department Filter -->
                    <div>
                        <label for="department"
                            class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                        <select id="department" wire:model.live="selectedDepartment"
                            class="border border-gray-300 rounded-lg w-full py-2 px-3 focus:ring-secondary focus:border-secondary">
                            <option value="all">All Departments</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department }}">{{ $department }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Remote Filter -->
                    <div class="flex items-end">
                        <label for="remote" class="flex items-center cursor-pointer w-full h-10">
                            <div class="mr-3">
                                <input type="checkbox" id="remote" wire:model.live="isRemoteOnly"
                                    class="sr-only">
                                <div class="toggle-bg bg-gray-200 border-2 border-gray-200 h-6 w-11 rounded-full">
                                </div>
                            </div>
                            <span class="text-gray-700">Remote Only</span>
                        </label>

                        <button wire:click="resetFilters"
                            class="ml-auto px-4 py-2 text-sm text-gray-600 hover:text-secondary focus:outline-none">
                            <i class="fas fa-redo mr-1"></i> Reset
                        </button>
                    </div>
                </div>
            </div>

            <!-- Job Listings -->
            <div class="grid grid-cols-1 gap-8">
                @forelse($careers as $job)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-2"
                        data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="p-6 md:p-8">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                <div>
                                    <h3 class="text-2xl font-bold text-primary-dark mb-2">{{ $job->title }}</h3>
                                    <div class="flex flex-wrap items-center text-gray-600 mb-4">
                                        <div class="flex items-center mr-4 mb-2">
                                            <i class="fas fa-briefcase text-secondary mr-2"></i>
                                            <span>{{ $job->department }}</span>
                                        </div>
                                        @if ($job->location)
                                            <div class="flex items-center mr-4 mb-2">
                                                <i class="fas fa-map-marker-alt text-secondary mr-2"></i>
                                                <span>{{ $job->location }}</span>
                                            </div>
                                        @endif
                                        @if ($job->is_remote)
                                            <div class="flex items-center mr-4 mb-2">
                                                <i class="fas fa-home text-secondary mr-2"></i>
                                                <span>Remote</span>
                                            </div>
                                        @endif
                                        @if ($job->valid_until)
                                            <div class="flex items-center mb-2">
                                                <i class="fas fa-clock text-secondary mr-2"></i>
                                                <span>Apply by {{ $job->valid_until->format('M d, Y') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-4 md:mt-0">
                                    <button type="button" onclick="toggleJobDetails('job-{{ $job->id }}')"
                                        class="btn btn-primary btn-sm">
                                        <span>View Details</span>
                                        <i class="fas fa-chevron-down ml-2 transition-transform duration-300"
                                            id="icon-job-{{ $job->id }}"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Collapsible Job Details -->
                            <div class="job-details-container hidden overflow-hidden transition-all duration-300 ease-in-out"
                                id="job-{{ $job->id }}">
                                <div class="pt-6 border-t border-gray-200 mt-6">
                                    <h4 class="text-lg font-semibold mb-3">Description</h4>
                                    <p class="text-gray-700 mb-6">{{ $job->description }}</p>

                                    <h4 class="text-lg font-semibold mb-3">Responsibilities</h4>
                                    <div class="mb-6">
                                        {!! nl2br(e($job->responsibilities)) !!}
                                    </div>

                                    <h4 class="text-lg font-semibold mb-3">Requirements</h4>
                                    <div class="mb-6">
                                        {!! nl2br(e($job->requirements)) !!}
                                    </div>

                                    @if ($job->benefits)
                                        <h4 class="text-lg font-semibold mb-3">Benefits</h4>
                                        <div class="mb-6">
                                            {!! nl2br(e($job->benefits)) !!}
                                        </div>
                                    @endif

                                    <div
                                        class="flex flex-col sm:flex-row justify-between items-center mt-8 pt-6 border-t border-gray-200">
                                        <div class="mb-4 sm:mb-0">
                                            @if ($job->salary_min && $job->salary_max)
                                                <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm">
                                                    Salary: ₦{{ number_format($job->salary_min) }} -
                                                    ₦{{ number_format($job->salary_max) }}
                                                </span>
                                            @endif
                                        </div>
                                        <a href="mailto:akstructltd@gmail.com?subject=Application for {{ $job->title }}"
                                            class="btn btn-secondary">
                                            <span>Apply Now</span>
                                            <i class="fas fa-paper-plane ml-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-xl shadow-lg p-8 text-center" data-aos="fade-up">
                        <div class="text-6xl text-gray-300 mb-4">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-700 mb-2">No Open Positions Found</h3>
                        <p class="text-gray-600 mb-6">We couldn't find any job openings matching your criteria.</p>
                        <button wire:click="resetFilters" class="btn btn-secondary">
                            <span>Reset Filters</span>
                            <i class="fas fa-redo ml-2"></i>
                        </button>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Application Process Section -->
    <section class="py-20 bg-white relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-secondary/5 rounded-full blur-3xl"></div>
        <div class="absolute top-20 right-20 w-20 h-20 bg-accent/10 rounded-full blur-xl"></div>
        <div class="absolute top-40 left-1/3 w-16 h-16 bg-secondary/10 rounded-full animate-float"
            style="animation-delay: 0.7s;"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <span class="text-secondary text-sm uppercase tracking-widest font-medium mb-2 block"
                    data-aos="fade-down">HOW TO APPLY</span>
                <h2 class="font-heading font-bold text-3xl md:text-4xl lg:text-5xl mb-4" data-aos="fade-up">Our
                    Application Process</h2>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Simple steps to join our team and start building your career in sustainable construction
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
                        <h4 class="text-xl font-bold mb-3 text-primary">Find a Position</h4>
                        <p class="text-gray-600">Browse our current job openings to find the role that matches your
                            skills and career goals.</p>
                        <div class="mt-4">
                            <div class="flex items-center justify-center">
                                <div class="bg-primary/10 rounded-full w-9 h-9 flex items-center justify-center mr-2">
                                    <i class="fas fa-search text-primary"></i>
                                </div>
                                <span class="text-sm font-medium">Search Opportunities</span>
                            </div>
                        </div>
                    </div>

                    <div class="text-center relative z-10" data-aos="fade-up" data-aos-delay="200">
                        <div
                            class="w-20 h-20 rounded-full bg-primary text-white flex items-center justify-center text-2xl font-bold mx-auto mb-4 transform transition-transform duration-300 hover:scale-110 shadow-lg">
                            02</div>
                        <h4 class="text-xl font-bold mb-3 text-primary">Apply</h4>
                        <p class="text-gray-600">Submit your application via email with your CV, cover letter, and any
                            required documents.</p>
                        <div class="mt-4">
                            <div class="flex items-center justify-center">
                                <div class="bg-primary/10 rounded-full w-9 h-9 flex items-center justify-center mr-2">
                                    <i class="fas fa-paper-plane text-primary"></i>
                                </div>
                                <span class="text-sm font-medium">Send Application</span>
                            </div>
                        </div>
                    </div>

                    <div class="text-center relative z-10" data-aos="fade-up" data-aos-delay="300">
                        <div
                            class="w-20 h-20 rounded-full bg-primary text-white flex items-center justify-center text-2xl font-bold mx-auto mb-4 transform transition-transform duration-300 hover:scale-110 shadow-lg">
                            03</div>
                        <h4 class="text-xl font-bold mb-3 text-primary">Interview</h4>
                        <p class="text-gray-600">Participate in our interview process, which may include phone
                            screening, technical assessment, and in-person meetings.</p>
                        <div class="mt-4">
                            <div class="flex items-center justify-center">
                                <div class="bg-primary/10 rounded-full w-9 h-9 flex items-center justify-center mr-2">
                                    <i class="fas fa-comments text-primary"></i>
                                </div>
                                <span class="text-sm font-medium">Meet Our Team</span>
                            </div>
                        </div>
                    </div>

                    <div class="text-center relative z-10" data-aos="fade-up" data-aos-delay="400">
                        <div
                            class="w-20 h-20 rounded-full bg-primary text-white flex items-center justify-center text-2xl font-bold mx-auto mb-4 transform transition-transform duration-300 hover:scale-110 shadow-lg">
                            04</div>
                        <h4 class="text-xl font-bold mb-3 text-primary">Welcome Aboard</h4>
                        <p class="text-gray-600">Receive your offer, complete onboarding, and begin your journey with
                            the Akstruct team.</p>
                        <div class="mt-4">
                            <div class="flex items-center justify-center">
                                <div class="bg-primary/10 rounded-full w-9 h-9 flex items-center justify-center mr-2">
                                    <i class="fas fa-handshake text-primary"></i>
                                </div>
                                <span class="text-sm font-medium">Start Your Career</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Application Tips -->
            <div class="mt-20 bg-stone p-8 rounded-xl shadow-lg" data-aos="fade-up">
                <h3 class="text-2xl font-bold mb-6 text-center">Application Tips</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <div class="text-secondary mr-3 mt-1">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <p class="text-gray-700">Customize your resume and cover letter to highlight relevant
                                    skills and experience for the specific role.</p>
                            </li>
                            <li class="flex items-start">
                                <div class="text-secondary mr-3 mt-1">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <p class="text-gray-700">Research our company, projects, and values to understand how
                                    your background aligns with our mission.</p>
                            </li>
                            <li class="flex items-start">
                                <div class="text-secondary mr-3 mt-1">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <p class="text-gray-700">Clearly demonstrate your interest in sustainable construction
                                    and any relevant experience or training.</p>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <div class="text-secondary mr-3 mt-1">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <p class="text-gray-700">Include specific examples of projects you've worked on that
                                    relate to the position you're applying for.</p>
                            </li>
                            <li class="flex items-start">
                                <div class="text-secondary mr-3 mt-1">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <p class="text-gray-700">Prepare for technical questions related to your field and be
                                    ready to discuss how your skills can contribute to our team.</p>
                            </li>
                            <li class="flex items-start">
                                <div class="text-secondary mr-3 mt-1">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <p class="text-gray-700">Follow up after your application and interview to express your
                                    continued interest in joining our team.</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section with Spontaneous Application Option -->
    <section class="py-16 bg-secondary relative overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute inset-0 bg-pattern opacity-10"
            style="background-image: url('{{ asset('assets/img/pattern.svg') }}');"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full filter blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/10 rounded-full filter blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-5xl mx-auto text-center">
                <h2 class="font-heading font-bold text-3xl md:text-4xl text-primary-dark mb-6" data-aos="fade-up">
                    Don't See the Right Position?</h2>
                <p class="text-lg text-primary-dark/90 mb-8 max-w-3xl mx-auto" data-aos="fade-up"
                    data-aos-delay="100">
                    We're always looking for talented individuals to join our team. Send us your resume and we'll keep
                    it on file for future opportunities.
                </p>
                <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4"
                    data-aos="fade-up" data-aos-delay="200">
                    <a href="mailto:akstructltd@gmail.com?subject=Spontaneous Application"
                        class="btn btn-primary text-center">
                        <span>Submit Your CV</span>
                        <i class="fas fa-file-alt ml-2"></i>
                    </a>
                    <a href="{{ route('contact') }}"
                        class="btn bg-white text-primary-dark hover:bg-gray-100 text-center">
                        <span>Contact Our HR Team</span>
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
                            <i class="fas fa-users text-2xl text-white"></i>
                        </div>
                        <div>
                            <p class="text-white font-semibold">Join Our Team</p>
                            <p class="text-white/80 text-sm">Grow with us</p>
                        </div>
                    </div>
                </div>

                <div class="absolute right-8 top-1/3 transform -translate-y-1/2 bg-white/20 backdrop-blur-sm p-5 rounded-lg shadow-lg animate-float"
                    style="animation-delay: 0.7s;">
                    <div class="flex items-center">
                        <div class="bg-white/30 p-3 rounded-full mr-4">
                            <i class="fas fa-graduation-cap text-2xl text-white"></i>
                        </div>
                        <div>
                            <p class="text-white font-semibold">Professional Development</p>
                            <p class="text-white/80 text-sm">Continuous learning</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript for progress animation and job detail toggle -->
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

            // Style for toggle switch
            const toggleBgs = document.querySelectorAll('.toggle-bg');
            toggleBgs.forEach(bg => {
                bg.classList.add('after:content-[\'\']', 'after:absolute', 'after:top-[2px]',
                    'after:left-[2px]',
                    'after:bg-white', 'after:border-gray-300', 'after:border', 'after:rounded-full',
                    'after:h-5', 'after:w-5', 'after:transition-all', 'relative');

                const checkbox = bg.parentElement.querySelector('input[type="checkbox"]');
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        bg.classList.add('bg-secondary', 'border-secondary');
                        bg.classList.add('after:translate-x-full');
                    } else {
                        bg.classList.remove('bg-secondary', 'border-secondary');
                        bg.classList.remove('after:translate-x-full');
                    }
                });
            });
        });

        // Toggle job details visibility
        function toggleJobDetails(id) {
            const container = document.getElementById(id);
            const icon = document.getElementById('icon-' + id);

            if (container.classList.contains('hidden')) {
                container.classList.remove('hidden');
                container.style.maxHeight = container.scrollHeight + 'px';
                icon.classList.add('rotate-180');
            } else {
                container.style.maxHeight = '0px';
                icon.classList.remove('rotate-180');
                setTimeout(() => {
                    container.classList.add('hidden');
                }, 300);
            }
        }
    </script>
</div>
