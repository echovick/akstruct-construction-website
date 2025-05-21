<?php

use App\Models\Project;
use App\Models\Setting;
use App\Models\Category;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;

new #[Layout('layout.web')] class extends Component {
    public $projects;
    public $categories;
    public $years;
    public $locations;

    // Filters
    public $selectedCategory = null;
    public $selectedYear = null;
    public $selectedLocation = null;

    public function mount()
    {
        $this->projects = Project::with('category')->orderBy('completed_at', 'desc')->get();
        $this->categories = Category::whereHas('projects')->orderBy('name')->get();
        $this->years = Project::selectRaw('YEAR(completed_at) as year')->distinct()->orderBy('year', 'desc')->pluck('year')->toArray();
        $this->locations = Project::select('location')->distinct()->orderBy('location')->pluck('location')->toArray();
    }

    public function filterProjects()
    {
        $query = Project::with('category')->orderBy('completed_at', 'desc');

        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }

        if ($this->selectedYear) {
            $query->whereRaw('YEAR(completed_at) = ?', [$this->selectedYear]);
        }

        if ($this->selectedLocation) {
            $query->where('location', $this->selectedLocation);
        }

        $this->projects = $query->get();
    }

    public function resetFilters()
    {
        $this->selectedCategory = null;
        $this->selectedYear = null;
        $this->selectedLocation = null;
        $this->filterProjects();
    }

    public function with(): array
    {
        return [
            'featuredProjects' => Project::where('is_featured', true)->take(5)->get(),
            'totalProjects' => Project::count(),
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
            <img src="{{ asset('assets/IMG_7140.jpg') }}" alt="Akstruct Construction Projects"
                class="w-full h-full object-cover object-center">
            <div class="absolute inset-0 bg-gradient-to-r from-primary-dark/90 to-primary/70"></div>
        </div>

        <!-- Floating elements (similar to other pages) -->
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
                    Project Portfolio</h1>
                <p class="text-xl text-white/90 mb-8 leading-relaxed">Explore our showcase of sustainable construction
                    excellence across Nigeria</p>

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
                                <span class="text-white/80">Projects</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- Portfolio Introduction -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Left Column with Text Content -->
                <div data-aos="fade-right" data-aos-delay="100">
                    <span class="text-secondary text-sm uppercase tracking-widest font-medium mb-2 block">OUR
                        WORK</span>
                    <h2 class="font-heading font-bold text-3xl md:text-4xl mb-6">Showcasing Excellence in Sustainable
                        Construction</h2>

                    <p class="text-gray-700 mb-6">
                        At Akstruct Construction Ltd, we take pride in our diverse portfolio of completed projects that
                        demonstrate our commitment to quality, sustainability, and innovation. Our portfolio spans
                        residential, commercial, and industrial sectors, each reflecting our dedication to excellence.
                    </p>

                    <p class="text-gray-700 mb-8">
                        Explore our completed projects below to see how we've transformed our clients' visions into
                        reality while adhering to the highest standards of sustainable construction practices.
                    </p>

                    <!-- Key Stats -->
                    <div class="grid grid-cols-3 gap-6 mb-8">
                        <div class="text-center p-4 bg-stone rounded-lg">
                            <div class="text-4xl font-bold text-primary">{{ $totalProjects ?? '50' }}+</div>
                            <p class="text-gray-600 text-sm">Total Projects</p>
                        </div>
                        <div class="text-center p-4 bg-stone rounded-lg">
                            <div class="text-4xl font-bold text-secondary">{{ $yearsExperience }}</div>
                            <p class="text-gray-600 text-sm">Years Experience</p>
                        </div>
                        <div class="text-center p-4 bg-stone rounded-lg">
                            <div class="text-4xl font-bold text-accent">15+</div>
                            <p class="text-gray-600 text-sm">Project Awards</p>
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
                            <img src="{{ asset('assets/IMG_7147.jpg') }}" alt="Akstruct Construction Projects"
                                class="w-full h-auto">
                        </div>

                        <!-- Floating smaller images -->
                        <div
                            class="absolute -bottom-12 -left-12 z-20 w-32 h-32 rounded-lg overflow-hidden shadow-xl border-4 border-white transform rotate-6">
                            <img src="{{ asset('assets/IMG_7145.jpg') }}" alt="Construction Site"
                                class="w-full h-full object-cover">
                        </div>
                        <div
                            class="absolute -top-10 -right-10 z-20 w-28 h-28 rounded-lg overflow-hidden shadow-xl border-4 border-white transform -rotate-6">
                            <img src="{{ asset('assets/IMG_7139.jpg') }}" alt="Project Completion"
                                class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Filter Section -->
    <section class="py-10 bg-stone">
        <div class="container mx-auto px-4">
            <div class="bg-white p-6 rounded-xl shadow-lg" data-aos="fade-up">
                <h3 class="text-2xl font-bold text-primary-dark mb-6">Find Projects</h3>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <!-- Category Filter -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Project
                            Category</label>
                        <select id="category" wire:model="selectedCategory" wire:change="filterProjects"
                            class="w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Year Filter -->
                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-700 mb-2">Year</label>
                        <select id="year" wire:model="selectedYear" wire:change="filterProjects"
                            class="w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary">
                            <option value="">All Years</option>
                            @foreach ($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Location Filter -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <select id="location" wire:model="selectedLocation" wire:change="filterProjects"
                            class="w-full rounded-lg border-gray-300 focus:ring-primary focus:border-primary">
                            <option value="">All Locations</option>
                            @foreach ($locations as $location)
                                <option value="{{ $location }}">{{ $location }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Reset Button -->
                    <div class="flex items-end">
                        <button wire:click="resetFilters" class="btn btn-secondary w-full">
                            <i class="fas fa-sync-alt mr-2"></i>
                            Reset Filters
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Projects Section -->
    <section class="py-16 bg-white relative overflow-hidden">
        <!-- Background elements -->
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-stone/50 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-60 h-60 bg-secondary/10 rounded-full blur-3xl"></div>
        <div class="absolute inset-0 bg-pattern opacity-5 z-0"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <span class="text-secondary text-sm uppercase tracking-widest font-medium mb-2 block"
                    data-aos="fade-down">SHOWCASE</span>
                <h2 class="font-heading font-bold text-3xl md:text-4xl lg:text-5xl mb-4" data-aos="fade-up">Featured
                    Projects</h2>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Highlighting our most innovative and impactful sustainable construction projects
                </p>
            </div>

            <!-- Featured Projects in an engaging layout -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
                @if (isset($featuredProjects[0]))
                    @php $project = $featuredProjects[0]; @endphp
                    <!-- First featured project (larger) -->
                    <div class="md:col-span-7 group relative overflow-hidden rounded-xl shadow-xl h-[500px]"
                        data-aos="fade-right">
                        <div class="absolute inset-0 overflow-hidden">
                            <img src="{{ asset('assets/IMG_7147.jpg') }}"
                                alt="{{ $project->title ?? 'Featured Project' }}"
                                class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-110">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-primary-dark/95 via-primary-dark/80 to-transparent opacity-80 group-hover:opacity-90 transition-all duration-500">
                            </div>
                        </div>
                        <div class="absolute inset-0 p-8 flex flex-col justify-end text-white">
                            <div
                                class="transform transition-transform duration-500 translate-y-4 group-hover:translate-y-0">
                                <div
                                    class="bg-accent inline-block px-3 py-1 text-sm font-semibold rounded mb-4 shadow-md">
                                    {{ $project->category->name ?? 'Commercial' }}
                                </div>
                                <h3 class="text-3xl font-bold mb-3 text-white drop-shadow-md">
                                    {{ $project->title ?? 'Modern Office Complex' }}</h3>
                                <p class="mb-6 text-white/90 drop-shadow-md max-w-2xl">
                                    {{ $project->description ?? 'A state-of-the-art commercial building featuring sustainable materials, energy-efficient systems, and smart building technology. This project demonstrates our commitment to environmental responsibility while delivering exceptional functionality.' }}
                                </p>
                                <div class="flex justify-between items-center">
                                    <div class="flex space-x-4 text-sm text-white">
                                        <span
                                            class="flex items-center bg-primary-dark/50 backdrop-blur-sm px-3 py-1 rounded">
                                            <i class="fas fa-map-marker-alt mr-2"></i>
                                            {{ $project->location ?? 'Abuja, Nigeria' }}
                                        </span>
                                        <span
                                            class="flex items-center bg-primary-dark/50 backdrop-blur-sm px-3 py-1 rounded">
                                            <i class="fas fa-calendar mr-2"></i>
                                            {{ $project->year ?? '2023' }}
                                        </span>
                                    </div>
                                    <a href="{{ isset($project) && isset($project->slug) ? route('projects.show', $project) : '#' }}"
                                        class="btn btn-secondary btn-sm shadow-lg hover:shadow-xl">
                                        View Project
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="md:col-span-5 flex flex-col gap-8">
                    @if (isset($featuredProjects[1]))
                        @php $project = $featuredProjects[1]; @endphp
                        <!-- Second featured project -->
                        <div class="group relative overflow-hidden rounded-xl shadow-xl h-[240px]"
                            data-aos="fade-left" data-aos-delay="100">
                            <div class="absolute inset-0 overflow-hidden">
                                <img src="{{ asset('assets/IMG_7145.jpg') }}"
                                    alt="{{ $project->title ?? 'Featured Project' }}"
                                    class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-110">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-primary-dark/95 via-primary-dark/80 to-transparent opacity-80 group-hover:opacity-90 transition-all duration-500">
                                </div>
                            </div>
                            <div class="absolute inset-0 p-6 flex flex-col justify-end text-white">
                                <div
                                    class="transform transition-transform duration-500 translate-y-4 group-hover:translate-y-0">
                                    <div
                                        class="bg-accent inline-block px-2 py-0.5 text-xs font-semibold rounded mb-2 shadow-md">
                                        {{ $project->category->name ?? 'Residential' }}
                                    </div>
                                    <h3 class="text-xl font-bold mb-2 text-white drop-shadow-md">
                                        {{ $project->title ?? 'Luxury Residential Complex' }}</h3>
                                    <div class="flex justify-between items-center">
                                        <div class="flex space-x-2 text-xs text-white">
                                            <span
                                                class="flex items-center bg-primary-dark/50 backdrop-blur-sm px-2 py-0.5 rounded">
                                                {{ $project->location ?? 'Abuja, Nigeria' }}
                                            </span>
                                        </div>
                                        <a href="{{ isset($project) && isset($project->slug) ? route('projects.show', $project) : '#' }}"
                                            class="text-secondary hover:text-white transition-colors">
                                            View Details <i class="fas fa-arrow-right ml-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (isset($featuredProjects[2]))
                        @php $project = $featuredProjects[2]; @endphp
                        <!-- Third featured project -->
                        <div class="group relative overflow-hidden rounded-xl shadow-xl h-[240px]"
                            data-aos="fade-left" data-aos-delay="200">
                            <div class="absolute inset-0 overflow-hidden">
                                <img src="{{ asset('assets/IMG_7141.jpg') }}"
                                    alt="{{ $project->title ?? 'Featured Project' }}"
                                    class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-110">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-primary-dark/95 via-primary-dark/80 to-transparent opacity-80 group-hover:opacity-90 transition-all duration-500">
                                </div>
                            </div>
                            <div class="absolute inset-0 p-6 flex flex-col justify-end text-white">
                                <div
                                    class="transform transition-transform duration-500 translate-y-4 group-hover:translate-y-0">
                                    <div
                                        class="bg-accent inline-block px-2 py-0.5 text-xs font-semibold rounded mb-2 shadow-md">
                                        {{ $project->category->name ?? 'Industrial' }}
                                    </div>
                                    <h3 class="text-xl font-bold mb-2 text-white drop-shadow-md">
                                        {{ $project->title ?? 'Manufacturing Facility' }}</h3>
                                    <div class="flex justify-between items-center">
                                        <div class="flex space-x-2 text-xs text-white">
                                            <span
                                                class="flex items-center bg-primary-dark/50 backdrop-blur-sm px-2 py-0.5 rounded">
                                                {{ $project->location ?? 'Abuja, Nigeria' }}
                                            </span>
                                        </div>
                                        <a href="{{ isset($project) && isset($project->slug) ? route('projects.show', $project) : '#' }}"
                                            class="text-secondary hover:text-white transition-colors">
                                            View Details <i class="fas fa-arrow-right ml-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Video Showcase -->
            <div class="mt-16 bg-stone p-8 rounded-xl shadow-lg" data-aos="fade-up">
                <h3 class="text-2xl font-bold mb-6 text-center">Project Highlights Video</h3>
                <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden shadow-xl">
                    <video class="w-full h-full object-cover" poster="{{ asset('assets/IMG_7143.JPG') }}" controls>
                        <source src="{{ asset('assets/Akstruct (Guzape site).MP4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <p class="text-center mt-4 text-gray-600">Experience our construction excellence through this showcase
                    of our recent projects</p>
            </div>
        </div>
    </section>

    <!-- Project Gallery Grid -->
    <section class="py-20 bg-stone relative overflow-hidden">
        <!-- Background elements -->
        <div class="absolute inset-0 bg-pattern opacity-5 z-0"></div>
        <div class="absolute -top-40 -left-40 w-80 h-80 bg-secondary/5 rounded-full blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-10">
                <span class="text-secondary text-sm uppercase tracking-widest font-medium mb-2 block"
                    data-aos="fade-down">OUR PORTFOLIO</span>
                <h2 class="font-heading font-bold text-3xl md:text-4xl mb-4" data-aos="fade-up">Explore All Projects
                </h2>
                <p class="text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Browse through our comprehensive portfolio of completed and ongoing construction projects
                </p>
            </div>

            <!-- Projects Grid with Masonry Layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($projects as $index => $project)
                    <div class="project-card group" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                        <div
                            class="rounded-xl overflow-hidden bg-white shadow-lg h-full flex flex-col transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                            <!-- Project Image -->
                            <div class="relative h-64 overflow-hidden">
                                @php
                                    // Rotate between the available images for demonstration
                                    $images = [
                                        'assets/IMG_7139.JPG',
                                        'assets/IMG_7140.jpg',
                                        'assets/IMG_7141.jpg',
                                        'assets/IMG_7143.JPG',
                                        'assets/IMG_7144.JPG',
                                        'assets/IMG_7145.jpg',
                                        'assets/IMG_7147.jpg',
                                    ];
                                    $imageIndex = $index % count($images);
                                    $image = $images[$imageIndex];
                                @endphp
                                <img src="{{ asset($image) }}" alt="{{ $project->title }}"
                                    class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-110">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-primary-dark/90 to-transparent opacity-60 group-hover:opacity-80 transition-all duration-300">
                                </div>
                                <div class="absolute top-4 left-4">
                                    <div class="bg-accent px-3 py-1 text-sm font-semibold rounded shadow-md">
                                        {{ $project->category->name ?? 'Commercial' }}
                                    </div>
                                </div>
                            </div>

                            <!-- Project Details -->
                            <div class="p-6 flex flex-col flex-grow">
                                <h3
                                    class="text-xl font-bold mb-2 group-hover:text-secondary transition-colors duration-300">
                                    {{ $project->title }}
                                </h3>
                                <p class="text-gray-600 mb-4 flex-grow line-clamp-3">
                                    {{ $project->short_description ?? Str::limit($project->description, 100) }}
                                </p>

                                <!-- Project Metadata -->
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span class="inline-flex items-center bg-stone px-2 py-1 rounded-md text-xs">
                                        <i class="fas fa-map-marker-alt mr-1 text-secondary"></i>
                                        {{ $project->location ?? 'Abuja, Nigeria' }}
                                    </span>
                                    <span class="inline-flex items-center bg-stone px-2 py-1 rounded-md text-xs">
                                        <i class="fas fa-calendar mr-1 text-secondary"></i>
                                        {{ $project->year ?? date('Y', strtotime($project->completed_at)) }}
                                    </span>
                                    @if ($project->client)
                                        <span class="inline-flex items-center bg-stone px-2 py-1 rounded-md text-xs">
                                            <i class="fas fa-user mr-1 text-secondary"></i>
                                            {{ $project->client }}
                                        </span>
                                    @endif
                                </div>

                                <a href="{{ isset($project->slug) ? route('projects.show', $project) : '#' }}"
                                    class="inline-flex items-center text-secondary font-medium hover:text-primary-dark">
                                    <span>View Project</span>
                                    <i
                                        class="fas fa-arrow-right ml-2 transform transition-transform duration-300 group-hover:translate-x-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center">
                        <div class="bg-white p-8 rounded-xl shadow-lg max-w-2xl mx-auto">
                            <div class="text-4xl text-gray-300 mb-4">
                                <i class="fas fa-search"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-primary-dark mb-2">No Projects Found</h3>
                            <p class="text-gray-600 mb-6">
                                We couldn't find any projects matching your current filter criteria. Please try
                                adjusting your filters.
                            </p>
                            <button wire:click="resetFilters" class="btn btn-secondary">
                                <i class="fas fa-sync-alt mr-2"></i>
                                Reset Filters
                            </button>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Project Categories Showcase -->
    <section class="py-20 bg-white relative overflow-hidden">
        <!-- Background elements -->
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-stone/50 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-60 h-60 bg-secondary/10 rounded-full blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <span class="text-secondary text-sm uppercase tracking-widest font-medium mb-2 block"
                    data-aos="fade-down">SPECIALIZATIONS</span>
                <h2 class="font-heading font-bold text-3xl md:text-4xl lg:text-5xl mb-4" data-aos="fade-up">Our
                    Project Categories</h2>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Explore our expertise across various construction sectors
                </p>
            </div>

            <!-- Project Categories Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Commercial Category -->
                <div class="group cursor-pointer" data-aos="fade-up" data-aos-delay="100"
                    onclick="document.getElementById('category').value='1'; Livewire.emit('filterProjects')">
                    <div
                        class="card h-full overflow-hidden transform transition-all duration-500 hover:-translate-y-2">
                        <div class="relative h-64 overflow-hidden">
                            <img src="{{ asset('assets/IMG_7147.jpg') }}" alt="Commercial Construction"
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
                            <p class="text-gray-600 mb-4">Office buildings, retail spaces, and mixed-use developments
                                designed for optimal functionality and sustainable operations.</p>
                            <div class="mt-2 text-secondary font-medium">
                                <span class="inline-flex items-center">
                                    View Projects <i
                                        class="fas fa-arrow-right ml-2 transform transition-transform duration-300 group-hover:translate-x-2"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Residential Category -->
                <div class="group cursor-pointer" data-aos="fade-up" data-aos-delay="200"
                    onclick="document.getElementById('category').value='2'; Livewire.emit('filterProjects')">
                    <div
                        class="card h-full overflow-hidden transform transition-all duration-500 hover:-translate-y-2">
                        <div class="relative h-64 overflow-hidden">
                            <img src="{{ asset('assets/IMG_7144.JPG') }}" alt="Residential Construction"
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
                            <p class="text-gray-600 mb-4">Luxury homes, multi-family housing, and residential complexes
                                that combine comfort, aesthetics, and energy efficiency.</p>
                            <div class="mt-2 text-secondary font-medium">
                                <span class="inline-flex items-center">
                                    View Projects <i
                                        class="fas fa-arrow-right ml-2 transform transition-transform duration-300 group-hover:translate-x-2"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Industrial Category -->
                <div class="group cursor-pointer" data-aos="fade-up" data-aos-delay="300"
                    onclick="document.getElementById('category').value='3'; Livewire.emit('filterProjects')">
                    <div
                        class="card h-full overflow-hidden transform transition-all duration-500 hover:-translate-y-2">
                        <div class="relative h-64 overflow-hidden">
                            <img src="{{ asset('assets/IMG_7143.JPG') }}" alt="Industrial Construction"
                                class="w-full h-full object-cover transform transition-all duration-500 group-hover:scale-110">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-primary-dark/80 to-transparent opacity-90">
                            </div>
                            <div class="absolute inset-0 flex items-end p-6">
                                <div>
                                    <div
                                        class="inline-flex items-center justify-center p-3 rounded-xl bg-white/90 backdrop-blur-sm text-primary mb-4 shadow-lg">
                                        <i class="fas fa-industry text-3xl"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold text-white mb-2">Industrial</h3>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 bg-white">
                            <p class="text-gray-600 mb-4">Manufacturing facilities, warehouses, and industrial
                                complexes designed for operational efficiency and sustainable production.</p>
                            <div class="mt-2 text-secondary font-medium">
                                <span class="inline-flex items-center">
                                    View Projects <i
                                        class="fas fa-arrow-right ml-2 transform transition-transform duration-300 group-hover:translate-x-2"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive Project Map -->
    <section class="py-20 bg-stone relative overflow-hidden">
        <!-- Background elements -->
        <div class="absolute inset-0 bg-pattern opacity-5 z-0"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <span class="text-secondary text-sm uppercase tracking-widest font-medium mb-2 block"
                    data-aos="fade-down">PROJECT LOCATIONS</span>
                <h2 class="font-heading font-bold text-3xl md:text-4xl lg:text-5xl mb-4" data-aos="fade-up">Our
                    Footprint Across Nigeria</h2>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Discover our construction projects spread across major cities and regions
                </p>
            </div>

            <div class="bg-white p-8 rounded-xl shadow-xl" data-aos="fade-up">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <!-- Map Visualization -->
                    <div class="relative">
                        <div class="rounded-xl overflow-hidden shadow-lg h-[400px] relative">
                            <img src="https://mapsvg.com/static/maps/geo-calibrated/nigeria.png" alt="Map of Nigeria"
                                class="w-full h-full object-contain">
                            <div
                                class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/70 to-transparent">
                                <h3 class="text-xl font-bold text-white">Project Locations</h3>
                                <p class="text-sm text-white/90">Our construction excellence across Nigeria</p>
                            </div>

                            <!-- Project Marker Dots (Transparent overlays) -->
                            <div class="absolute top-1/4 left-1/3 w-4 h-4 bg-accent rounded-full animate-ping"></div>
                            <div class="absolute top-1/3 right-1/4 w-4 h-4 bg-secondary rounded-full animate-ping"
                                style="animation-delay: 0.5s"></div>
                            <div class="absolute bottom-1/3 left-2/5 w-4 h-4 bg-accent rounded-full animate-ping"
                                style="animation-delay: 1s"></div>
                            <div class="absolute bottom-1/4 right-1/3 w-4 h-4 bg-primary rounded-full animate-ping"
                                style="animation-delay: 1.5s"></div>

                            <!-- Map Tooltips -->
                            <div class="absolute top-1/4 left-1/3 transform -translate-x-1/2 -translate-y-1/2">
                                <div
                                    class="w-6 h-6 bg-accent rounded-full flex items-center justify-center border-2 border-white">
                                    <div class="group relative cursor-pointer">
                                        <span class="w-2 h-2 bg-white rounded-full block"></span>
                                        <div
                                            class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-3 hidden group-hover:block w-48 bg-white p-3 rounded-lg shadow-lg text-left z-10">
                                            <div class="text-accent font-bold mb-1">Abuja Projects</div>
                                            <div class="text-gray-700 text-sm">5 Commercial & Residential Projects
                                            </div>
                                            <div
                                                class="absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1/2 rotate-45 w-3 h-3 bg-white">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="absolute top-1/3 right-1/4 transform -translate-x-1/2 -translate-y-1/2">
                                <div
                                    class="w-6 h-6 bg-secondary rounded-full flex items-center justify-center border-2 border-white">
                                    <div class="group relative cursor-pointer">
                                        <span class="w-2 h-2 bg-white rounded-full block"></span>
                                        <div
                                            class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-3 hidden group-hover:block w-48 bg-white p-3 rounded-lg shadow-lg text-left z-10">
                                            <div class="text-secondary font-bold mb-1">Lagos Projects</div>
                                            <div class="text-gray-700 text-sm">8 Commercial & Industrial Projects</div>
                                            <div
                                                class="absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1/2 rotate-45 w-3 h-3 bg-white">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Project Locations List -->
                    <div>
                        <h3 class="text-2xl font-bold mb-6">Our Key Project Locations</h3>
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div
                                    class="bg-accent h-8 w-8 rounded-full flex items-center justify-center text-white shrink-0 mr-4">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg">Abuja</h4>
                                    <p class="text-gray-600 mb-2">The Federal Capital Territory hosts our flagship
                                        commercial and government projects.</p>
                                    <div class="flex flex-wrap gap-2">
                                        <span class="bg-stone rounded-full px-3 py-1 text-xs">Office Buildings</span>
                                        <span class="bg-stone rounded-full px-3 py-1 text-xs">Residential
                                            Complexes</span>
                                        <span class="bg-stone rounded-full px-3 py-1 text-xs">Government
                                            Facilities</span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div
                                    class="bg-secondary h-8 w-8 rounded-full flex items-center justify-center text-white shrink-0 mr-4">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg">Lagos</h4>
                                    <p class="text-gray-600 mb-2">Nigeria's commercial hub is home to our innovative
                                        commercial and industrial projects.</p>
                                    <div class="flex flex-wrap gap-2">
                                        <span class="bg-stone rounded-full px-3 py-1 text-xs">Commercial Centers</span>
                                        <span class="bg-stone rounded-full px-3 py-1 text-xs">Industrial
                                            Facilities</span>
                                        <span class="bg-stone rounded-full px-3 py-1 text-xs">Waterfront
                                            Developments</span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div
                                    class="bg-primary h-8 w-8 rounded-full flex items-center justify-center text-white shrink-0 mr-4">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg">Port Harcourt</h4>
                                    <p class="text-gray-600 mb-2">Our industrial and energy sector projects are
                                        concentrated in this oil-rich region.</p>
                                    <div class="flex flex-wrap gap-2">
                                        <span class="bg-stone rounded-full px-3 py-1 text-xs">Industrial
                                            Complexes</span>
                                        <span class="bg-stone rounded-full px-3 py-1 text-xs">Oil & Gas
                                            Facilities</span>
                                        <span class="bg-stone rounded-full px-3 py-1 text-xs">Office Buildings</span>
                                    </div>
                                </div>
                            </div>

                            <a href="#" class="inline-flex items-center text-secondary font-medium mt-4">
                                <span>View All Locations</span>
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 360° Project Experience -->
    <section class="py-16 bg-white relative overflow-hidden">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div data-aos="fade-right">
                    <span class="text-secondary text-sm uppercase tracking-widest font-medium mb-2 block">IMMERSIVE
                        EXPERIENCE</span>
                    <h2 class="font-heading font-bold text-3xl md:text-4xl mb-6">Experience Our Projects in 360°</h2>

                    <p class="text-gray-700 mb-6">
                        Step inside our completed projects with immersive 360° virtual tours that allow you to explore
                        spaces as if you were there in person. These interactive experiences showcase our attention to
                        detail, design excellence, and build quality.
                    </p>

                    <p class="text-gray-700 mb-8">
                        Navigate through various rooms, explore exteriors, and get a real sense of the spaces we create
                        for our clients. Our virtual tours are optimized for both desktop and mobile devices.
                    </p>

                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="#" class="btn btn-primary">
                            <span>Launch 360° Tour</span>
                            <i class="fas fa-vr-cardboard ml-2"></i>
                        </a>
                        <a href="#" class="btn btn-outline-primary">
                            <span>View Project Gallery</span>
                            <i class="fas fa-images ml-2"></i>
                        </a>
                    </div>
                </div>

                <div data-aos="fade-left" class="relative">
                    <!-- 360 Tour Preview -->
                    <div class="relative rounded-xl overflow-hidden shadow-2xl">
                        <img src="{{ asset('assets/IMG_7140.jpg') }}" alt="360 Tour Preview" class="w-full h-auto">

                        <!-- Play Button -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="bg-white/20 backdrop-blur-sm p-4 rounded-full animate-pulse">
                                <div
                                    class="bg-secondary text-white rounded-full w-16 h-16 flex items-center justify-center">
                                    <i class="fas fa-play text-xl"></i>
                                </div>
                            </div>
                        </div>

                        <!-- 360 Indicator -->
                        <div
                            class="absolute bottom-4 right-4 bg-white/80 backdrop-blur-sm px-4 py-2 rounded-full shadow-lg">
                            <div class="flex items-center">
                                <i class="fas fa-360-degrees text-secondary mr-2"></i>
                                <span class="font-medium">Drag to explore</span>
                            </div>
                        </div>
                    </div>

                    <!-- Other Tour Previews -->
                    <div
                        class="absolute -bottom-8 -left-8 w-24 h-24 rounded-lg overflow-hidden shadow-lg border-2 border-white transform rotate-6">
                        <img src="{{ asset('assets/IMG_7139.JPG') }}" alt="Project Preview"
                            class="w-full h-full object-cover">
                    </div>
                    <div
                        class="absolute -top-8 -right-8 w-24 h-24 rounded-lg overflow-hidden shadow-lg border-2 border-white transform -rotate-6">
                        <img src="{{ asset('assets/IMG_7141.jpg') }}" alt="Project Preview"
                            class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-primary-dark relative overflow-hidden">
        <!-- Background elements -->
        <div class="absolute inset-0 bg-pattern opacity-10"
            style="background-image: url('{{ asset('assets/img/pattern.svg') }}');"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-secondary/10 rounded-full filter blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-accent/10 rounded-full filter blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="font-heading font-bold text-3xl md:text-4xl text-white mb-6" data-aos="fade-up">Ready to
                    Start Your Project with Akstruct?</h2>
                <p class="text-lg text-white/80 mb-8 mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Let's collaborate to bring your construction vision to life with sustainable, innovative solutions
                    tailored to your specific needs
                </p>

                <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4"
                    data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('quote') }}" class="btn btn-secondary text-center">
                        <span>Request a Quote</span>
                        <i class="fas fa-file-invoice ml-2"></i>
                    </a>
                    <a href="{{ route('contact') }}"
                        class="btn bg-white text-primary-dark hover:bg-gray-100 text-center">
                        <span>Contact Our Team</span>
                        <i class="fas fa-envelope ml-2"></i>
                    </a>
                </div>

                <!-- Stats Counters -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-16">
                    <div class="bg-white/10 backdrop-blur-md p-6 rounded-xl" data-aos="fade-up" data-aos-delay="100">
                        <div class="text-4xl font-bold text-white mb-2">{{ $projectsCompleted }}+</div>
                        <p class="text-white/80">Projects Completed</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md p-6 rounded-xl" data-aos="fade-up" data-aos-delay="200">
                        <div class="text-4xl font-bold text-white mb-2">{{ $yearsExperience }}</div>
                        <p class="text-white/80">Years of Experience</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md p-6 rounded-xl" data-aos="fade-up" data-aos-delay="300">
                        <div class="text-4xl font-bold text-white mb-2">100%</div>
                        <p class="text-white/80">Client Satisfaction</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript for animations and interactions -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Here we would initialize any JavaScript libraries or custom code for the gallery
            // For production, we could add lightbox functionality, interactive filtering, etc.

            // Example function to trigger category filtering via Livewire
            window.filterByCategory = function(categoryId) {
                document.getElementById('category').value = categoryId;
                Livewire.emit('filterProjects');
            }
        });
    </script>
</div>
