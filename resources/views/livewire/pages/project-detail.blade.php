<?php

use App\Models\Project;
use App\Models\Setting;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('layout.web')] class extends Component {
    public $project;

    public function mount($slug)
    {
        $this->project = Project::where('slug', $slug)->firstOrFail();
    }

    public function with(): array
    {
        // Get related projects in the same category
        $relatedProjects = Project::where('category', $this->project->category)->where('id', '!=', $this->project->id)->take(3)->get();

        return [
            'relatedProjects' => $relatedProjects,
            'projectsCompleted' => Setting::getValue('stats_projects_completed', '150'),
        ];
    }
}; ?>

<div>
    <!-- Hero Section with Project Image -->
    <section class="relative bg-primary-dark text-white overflow-hidden">
        <!-- Background image with overlay -->
        <div class="absolute inset-0 z-0">
            @php
                // Use project image if available, otherwise use a default image
                $projectImages = [
                    'assets/IMG_7140.jpg',
                    'assets/IMG_7141.jpg',
                    'assets/IMG_7143.JPG',
                    'assets/IMG_7144.JPG',
                    'assets/IMG_7145.jpg',
                    'assets/IMG_7147.jpg',
                ];
                $backgroundImage = $projectImages[array_rand($projectImages)];
            @endphp
            <img src="{{ asset($backgroundImage) }}" alt="{{ $project->title }}"
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
                <div class="mb-6">
                    <span class="bg-accent text-white text-sm font-semibold px-3 py-1 rounded-full shadow-md">
                        {{ $project->category }}
                    </span>
                </div>
                <h1 class="font-heading font-bold text-4xl md:text-5xl lg:text-6xl mb-6 text-white leading-tight">
                    {{ $project->title }}
                </h1>
                <p class="text-xl text-white/90 mb-8 leading-relaxed">
                    {{ $project->short_description ?? Str::limit($project->description, 160) }}
                </p>

                <!-- Project info badges -->
                <div class="flex flex-wrap gap-4 mb-8">
                    <div class="bg-white/10 backdrop-blur-sm py-2 px-4 rounded-lg flex items-center">
                        <i class="fas fa-map-marker-alt text-secondary mr-2"></i>
                        <span>{{ $project->location }}</span>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm py-2 px-4 rounded-lg flex items-center">
                        <i class="fas fa-calendar-alt text-secondary mr-2"></i>
                        <span>{{ $project->year }}</span>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm py-2 px-4 rounded-lg flex items-center">
                        <i class="fas fa-tag text-secondary mr-2"></i>
                        <span>{{ $project->status ?? 'Completed' }}</span>
                    </div>
                </div>

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
                        <li class="inline-flex items-center">
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-white/50 mx-2"></i>
                                <a href="{{ route('projects') }}" class="text-white hover:text-secondary">
                                    Projects
                                </a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-white/50 mx-2"></i>
                                <span class="text-white/80">{{ $project->title }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- Project Detail Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Project content - left wide column -->
                <div class="lg:col-span-2">
                    <!-- Project Gallery -->
                    <div class="mb-12" data-aos="fade-up">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @php
                                $galleryImages = [
                                    'assets/IMG_7140.jpg',
                                    'assets/IMG_7141.jpg',
                                    'assets/IMG_7143.JPG',
                                    'assets/IMG_7144.JPG',
                                ];
                            @endphp

                            <!-- Main large image -->
                            <div class="md:col-span-2">
                                <div class="rounded-xl overflow-hidden shadow-lg h-96">
                                    <img src="{{ asset('assets/IMG_7147.jpg') }}" alt="{{ $project->title }}"
                                        class="w-full h-full object-cover">
                                </div>
                            </div>

                            <!-- Smaller gallery images -->
                            @foreach ($galleryImages as $index => $image)
                                <div class="rounded-xl overflow-hidden shadow-lg h-48">
                                    <img src="{{ asset($image) }}"
                                        alt="{{ $project->title }} - Image {{ $index + 1 }}"
                                        class="w-full h-full object-cover">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Project Description -->
                    <div data-aos="fade-up" data-aos-delay="100">
                        <h2 class="font-heading font-bold text-3xl mb-6">Project Overview</h2>
                        <div class="prose prose-lg max-w-none text-gray-700 mb-8">
                            <p>{{ $project->description }}</p>

                            <!-- If we don't have actual content, generate some dummy paragraphs -->
                            @if (strlen($project->description) < 300)
                                <p>This project exemplifies Akstruct Construction's commitment to quality craftsmanship
                                    and sustainable building practices. From the initial design phase to final
                                    construction, our team worked closely with the client to ensure all requirements
                                    were met while incorporating innovative solutions.</p>

                                <p>The design incorporates several sustainable features including energy-efficient
                                    systems, locally sourced materials, and optimal space utilization. These elements
                                    not only reduce the environmental impact but also provide long-term cost savings for
                                    the building operators.</p>
                            @endif
                        </div>

                        <!-- Project Highlights -->
                        <div class="mb-10">
                            <h3 class="font-bold text-2xl mb-4">Project Highlights</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="flex items-start">
                                    <div class="bg-secondary/10 rounded-full p-2 mr-4">
                                        <i class="fas fa-check text-secondary"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-lg">Sustainable Materials</h4>
                                        <p class="text-gray-600">Eco-friendly and locally sourced materials were used
                                            throughout the construction</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="bg-secondary/10 rounded-full p-2 mr-4">
                                        <i class="fas fa-check text-secondary"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-lg">Energy Efficiency</h4>
                                        <p class="text-gray-600">State-of-the-art systems to minimize energy consumption
                                            and reduce costs</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="bg-secondary/10 rounded-full p-2 mr-4">
                                        <i class="fas fa-check text-secondary"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-lg">Innovative Design</h4>
                                        <p class="text-gray-600">Modern architectural elements balanced with practical
                                            functionality</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="bg-secondary/10 rounded-full p-2 mr-4">
                                        <i class="fas fa-check text-secondary"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-lg">On-Time Delivery</h4>
                                        <p class="text-gray-600">Project completed within the specified timeline and
                                            budget constraints</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Project Statistics -->
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-10">
                            <div class="bg-stone p-4 rounded-xl text-center">
                                <div class="text-2xl font-bold text-secondary mb-1">{{ $project->area ?? '1,500' }} m²
                                </div>
                                <div class="text-sm text-gray-500">Total Area</div>
                            </div>
                            <div class="bg-stone p-4 rounded-xl text-center">
                                <div class="text-2xl font-bold text-secondary mb-1">{{ $project->duration ?? '18' }}
                                    months</div>
                                <div class="text-sm text-gray-500">Duration</div>
                            </div>
                            <div class="bg-stone p-4 rounded-xl text-center">
                                <div class="text-2xl font-bold text-secondary mb-1">{{ $project->floors ?? '6' }}</div>
                                <div class="text-sm text-gray-500">Floors</div>
                            </div>
                            <div class="bg-stone p-4 rounded-xl text-center">
                                <div class="text-2xl font-bold text-secondary mb-1">
                                    {{ $project->completed ?? '100%' }}</div>
                                <div class="text-sm text-gray-500">Completion</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar - right column -->
                <div class="lg:col-span-1">
                    <div class="sticky top-32">
                        <!-- Project meta information -->
                        <div class="bg-stone rounded-xl p-6 mb-8 shadow-md" data-aos="fade-left">
                            <h3 class="font-bold text-xl mb-4 border-b border-gray-200 pb-2">Project Details</h3>
                            <div class="space-y-4">
                                <div>
                                    <div class="text-gray-500 text-sm">Client</div>
                                    <div class="font-medium">{{ $project->client ?? 'Confidential' }}</div>
                                </div>
                                <div>
                                    <div class="text-gray-500 text-sm">Location</div>
                                    <div class="font-medium">{{ $project->location }}</div>
                                </div>
                                <div>
                                    <div class="text-gray-500 text-sm">Completion Year</div>
                                    <div class="font-medium">{{ $project->year }}</div>
                                </div>
                                <div>
                                    <div class="text-gray-500 text-sm">Project Type</div>
                                    <div class="font-medium">{{ $project->category }}</div>
                                </div>
                                <div>
                                    <div class="text-gray-500 text-sm">Status</div>
                                    <div class="font-medium">{{ $project->status ?? 'Completed' }}</div>
                                </div>
                            </div>

                            <div class="mt-6">
                                <h4 class="font-medium mb-2 text-gray-700">Share This Project</h4>
                                <div class="flex space-x-3">
                                    <a href="#"
                                        class="bg-blue-600 text-white w-8 h-8 rounded-full flex items-center justify-center hover:bg-blue-700">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="#"
                                        class="bg-blue-400 text-white w-8 h-8 rounded-full flex items-center justify-center hover:bg-blue-500">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="#"
                                        class="bg-red-600 text-white w-8 h-8 rounded-full flex items-center justify-center hover:bg-red-700">
                                        <i class="fab fa-pinterest-p"></i>
                                    </a>
                                    <a href="#"
                                        class="bg-green-600 text-white w-8 h-8 rounded-full flex items-center justify-center hover:bg-green-700">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- CTA Box -->
                        <div class="bg-primary-dark rounded-xl p-6 text-white shadow-xl overflow-hidden relative"
                            data-aos="fade-left" data-aos-delay="100">
                            <!-- Decorative elements -->
                            <div
                                class="absolute -top-10 -right-10 w-32 h-32 bg-secondary/30 rounded-full filter blur-xl">
                            </div>
                            <div
                                class="absolute -bottom-10 -left-10 w-32 h-32 bg-accent/30 rounded-full filter blur-xl">
                            </div>

                            <div class="relative z-10">
                                <h3 class="font-bold text-xl mb-3">Have a Similar Project?</h3>
                                <p class="text-white/80 mb-6">Let's discuss how we can bring your vision to life with
                                    our sustainable construction solutions.</p>
                                <div class="flex flex-col space-y-3">
                                    <a href="{{ route('quote') }}"
                                        class="btn bg-white text-primary-dark hover:bg-gray-100">
                                        <span>Request a Quote</span>
                                        <i class="fas fa-file-invoice ml-2"></i>
                                    </a>
                                    <a href="{{ route('contact') }}"
                                        class="btn bg-transparent border border-white text-white hover:bg-white/10">
                                        <span>Contact Us</span>
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Projects Section -->
    <section class="py-20 bg-stone relative overflow-hidden">
        <!-- Background pattern for visual interest -->
        <div class="absolute inset-0 bg-pattern opacity-5 z-0"
            style="background-image: url('{{ asset('assets/img/pattern.svg') }}');"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <span class="text-secondary text-sm uppercase tracking-widest font-medium mb-2 block"
                    data-aos="fade-down">MORE PROJECTS</span>
                <h2 class="font-heading font-bold text-3xl md:text-4xl mb-4" data-aos="fade-up">Related Projects</h2>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Explore other projects in the {{ $project->category }} category
                </p>
            </div>

            <!-- Related Projects Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                @if (count($relatedProjects) > 0)
                    @foreach ($relatedProjects as $index => $relatedProject)
                        <div class="project-card rounded-xl shadow-xl overflow-hidden group" data-aos="fade-up"
                            data-aos-delay="{{ $index * 100 }}">
                            <div class="relative h-72 overflow-hidden">
                                @php
                                    // Use different images for each project or fallback to default images
                                    $projectImages = [
                                        'assets/IMG_7140.jpg',
                                        'assets/IMG_7141.jpg',
                                        'assets/IMG_7144.JPG',
                                    ];
                                    $imageIndex = $index % count($projectImages);
                                @endphp
                                <img src="{{ asset($projectImages[$imageIndex]) }}"
                                    alt="{{ $relatedProject->title }}"
                                    class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-110">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-primary-dark/95 via-primary-dark/80 to-transparent opacity-80 group-hover:opacity-90 transition-all duration-500">
                                </div>
                                <div class="absolute inset-0 flex flex-col justify-end p-6">
                                    <div
                                        class="transform transition-transform duration-500 translate-y-4 group-hover:translate-y-0">
                                        <div
                                            class="bg-accent inline-block px-3 py-1 text-sm font-semibold rounded mb-3 shadow-md">
                                            {{ $relatedProject->category }}
                                        </div>
                                        <h3 class="text-xl font-bold mb-2 text-white drop-shadow-md">
                                            {{ $relatedProject->title }}
                                        </h3>
                                        <p class="mb-4 text-white/90 drop-shadow-md line-clamp-2">
                                            {{ $relatedProject->description }}
                                        </p>
                                        <a href="{{ isset($relatedProject) && $relatedProject->slug ? route('projects.show', $relatedProject) : '#' }}"
                                            class="btn btn-secondary btn-sm shadow-lg hover:shadow-xl">
                                            View Project
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- If no related projects, show a message -->
                    <div class="col-span-full text-center py-12">
                        <div class="text-gray-400 mb-4">
                            <i class="fas fa-folder-open text-5xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-2">No Related Projects</h3>
                        <p class="text-gray-600 mb-6">Currently there are no other projects in this category.</p>
                        <a href="{{ route('projects') }}" class="btn btn-primary">
                            <span>Explore All Projects</span>
                            <i class="fas fa-th ml-2"></i>
                        </a>
                    </div>
                @endif
            </div>

            <!-- Back to all projects button -->
            <div class="text-center" data-aos="fade-up">
                <a href="{{ route('projects') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left mr-2"></i>
                    <span>Back to All Projects</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Project Inquiry CTA Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="bg-primary rounded-2xl shadow-lg overflow-hidden relative">
                <div class="absolute inset-0 z-0">
                    <div class="absolute top-0 right-0 w-96 h-96 bg-secondary/20 rounded-full filter blur-3xl"></div>
                    <div class="absolute bottom-0 left-0 w-96 h-96 bg-accent/20 rounded-full filter blur-3xl"></div>
                </div>

                <div class="relative z-10 p-10 md:p-16 flex flex-col md:flex-row items-center justify-between gap-10">
                    <div class="md:w-2/3">
                        <h2 class="font-heading font-bold text-3xl md:text-4xl text-white mb-4">Ready to Start Your
                            Next Project?</h2>
                        <p class="text-white/80 text-lg mb-0">Contact our team today to discuss your construction needs
                            and how we can help bring your vision to life.</p>
                    </div>
                    <div class="md:w-1/3 flex flex-col space-y-4">
                        <a href="{{ route('quote') }}" class="btn bg-white text-primary hover:bg-gray-100 w-full">
                            Request a Quote
                        </a>
                        <a href="{{ route('contact') }}"
                            class="btn bg-secondary text-white hover:bg-secondary-dark w-full">
                            Contact Us
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
