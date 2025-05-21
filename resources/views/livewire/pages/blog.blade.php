<?php

use App\Models\Blog;
use Livewire\WithPagination;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('layout.web')] class extends Component {
    use WithPagination;

    public $search = '';
    public $category = '';
    public $categories = [];
    public $latestPosts = [];

    public function mount()
    {
        $this->categories = Blog::select('category')->distinct()->orderBy('category')->pluck('category')->toArray();

        $this->latestPosts = Blog::published()->orderBy('published_at', 'desc')->take(3)->get();
    }

    public function filterByCategory($category)
    {
        $this->resetPage();
        $this->category = $category;
    }

    public function clearFilters()
    {
        $this->resetPage();
        $this->reset('search', 'category');
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function with(): array
    {
        $query = Blog::published()->orderBy('published_at', 'desc');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('content', 'like', '%' . $this->search . '%')
                    ->orWhere('excerpt', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->category) {
            $query->where('category', $this->category);
        }

        return [
            'blogs' => $query->paginate(6),
            'totalBlogs' => Blog::published()->count(),
        ];
    }
}; ?>

<div>
    <!-- Hero Section with Parallax Effect -->
    <section class="relative bg-primary-dark text-white overflow-hidden">
        <!-- Background image with overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('assets/IMG_7144.JPG') }}" alt="Akstruct Construction Blog"
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
                <h1 class="font-heading font-bold text-4xl md:text-5xl lg:text-6xl mb-6 text-white leading-tight">
                    Insights & Updates
                </h1>
                <p class="text-xl text-white/90 mb-8 leading-relaxed">
                    Stay informed with the latest news, trends, and insights from the world of sustainable construction
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
                                <span class="text-white/80">Blog</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- Blog Content Section -->
    <section class="py-20 bg-white relative overflow-hidden">
        <!-- Background elements -->
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-stone/50 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-60 h-60 bg-secondary/10 rounded-full blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <!-- Left Sidebar -->
                <div class="lg:col-span-1">
                    <div class="sticky top-24 space-y-8">
                        <!-- Search Box -->
                        <div class="bg-stone rounded-xl p-6 shadow-md" data-aos="fade-up">
                            <h3 class="text-xl font-bold mb-4">Search Articles</h3>
                            <div class="relative">
                                <input type="text" wire:model.live.debounce.300ms="search"
                                    placeholder="Search topics..."
                                    class="form-input w-full pl-10 py-3 rounded-lg bg-white">
                                <i
                                    class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Categories -->
                        <div class="bg-stone rounded-xl p-6 shadow-md" data-aos="fade-up" data-aos-delay="100">
                            <h3 class="text-xl font-bold mb-4">Categories</h3>
                            <ul class="space-y-2">
                                <li>
                                    <button wire:click="clearFilters"
                                        class="w-full text-left py-2 px-3 rounded-md transition-colors {{ $category === '' ? 'bg-secondary text-primary-dark font-medium' : 'hover:bg-stone/70' }}">
                                        All Categories <span class="text-gray-500">({{ $totalBlogs }})</span>
                                    </button>
                                </li>
                                @foreach ($categories as $cat)
                                    <li>
                                        <button wire:click="filterByCategory('{{ $cat }}')"
                                            class="w-full text-left py-2 px-3 rounded-md transition-colors {{ $category === $cat ? 'bg-secondary text-primary-dark font-medium' : 'hover:bg-stone/70' }}">
                                            {{ $cat }} <span
                                                class="text-gray-500">({{ Blog::published()->where('category', $cat)->count() }})</span>
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Recent Posts -->
                        <div class="bg-stone rounded-xl p-6 shadow-md" data-aos="fade-up" data-aos-delay="200">
                            <h3 class="text-xl font-bold mb-4">Recent Posts</h3>
                            <div class="space-y-4">
                                @foreach ($latestPosts as $post)
                                    <div class="flex gap-3">
                                        <div class="w-20 h-20 flex-shrink-0 rounded-md overflow-hidden">
                                            <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}"
                                                class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <h4 class="font-medium hover:text-secondary transition-colors">
                                                <a
                                                    href="{{ route('blog.show', $post->slug) }}">{{ Str::limit($post->title, 50) }}</a>
                                            </h4>
                                            <p class="text-sm text-gray-500 mt-1">
                                                {{ $post->published_at->format('M d, Y') }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Tags Cloud -->
                        <div class="bg-stone rounded-xl p-6 shadow-md" data-aos="fade-up" data-aos-delay="300">
                            <h3 class="text-xl font-bold mb-4">Popular Tags</h3>
                            <div class="flex flex-wrap gap-2">
                                @php
                                    $allTags = Blog::published()
                                        ->pluck('tags')
                                        ->filter()
                                        ->flatten()
                                        ->map(function ($tag) {
                                            return json_decode($tag, true);
                                        })
                                        ->collapse()
                                        ->countBy()
                                        ->sortDesc()
                                        ->take(15);
                                @endphp

                                @foreach ($allTags as $tag => $count)
                                    <span
                                        class="inline-block px-3 py-1 bg-gray-100 hover:bg-secondary hover:text-primary-dark rounded-full text-sm cursor-pointer transition-colors">
                                        {{ $tag }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content - Blog Posts Grid -->
                <div class="lg:col-span-2">
                    <!-- Filter Summary -->
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            @if ($search || $category)
                                <div class="flex items-center gap-2">
                                    <span class="text-gray-600">Showing results for:</span>
                                    @if ($search)
                                        <div class="bg-stone px-3 py-1 rounded-full text-sm flex items-center">
                                            <span>Search: "{{ $search }}"</span>
                                            <button wire:click="$set('search', '')"
                                                class="ml-2 text-gray-500 hover:text-primary">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    @endif
                                    @if ($category)
                                        <div class="bg-stone px-3 py-1 rounded-full text-sm flex items-center">
                                            <span>Category: {{ $category }}</span>
                                            <button wire:click="$set('category', '')"
                                                class="ml-2 text-gray-500 hover:text-primary">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    @endif
                                    <button wire:click="clearFilters"
                                        class="text-secondary hover:text-secondary-dark text-sm font-medium">
                                        Clear All
                                    </button>
                                </div>
                            @else
                                <h2 class="text-2xl font-bold">Latest Articles</h2>
                            @endif
                        </div>
                        <div>
                            <span class="text-gray-600">{{ $blogs->total() }} results</span>
                        </div>
                    </div>

                    <!-- Blog Cards -->
                    @if ($blogs->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            @foreach ($blogs as $blog)
                                <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                    <x-blog-card :blog="$blog" />
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-12">
                            {{ $blogs->links() }}
                        </div>
                    @else
                        <div class="text-center bg-stone py-16 px-4 rounded-xl" data-aos="fade-up">
                            <div class="text-6xl text-secondary/30 mb-4">
                                <i class="fas fa-search"></i>
                            </div>
                            <h3 class="text-2xl font-bold mb-2">No Articles Found</h3>
                            <p class="text-gray-600 mb-6">We couldn't find any articles matching your search criteria.
                            </p>
                            <button wire:click="clearFilters" class="btn btn-secondary">
                                <span>View All Articles</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-16 bg-stone relative overflow-hidden">
        <div class="absolute inset-0 bg-pattern opacity-10 z-0"
            style="background-image: url('{{ asset('assets/img/pattern.svg') }}');"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="bg-white rounded-2xl shadow-lg p-10 max-w-5xl mx-auto" data-aos="fade-up">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
                    <div>
                        <h3 class="font-heading font-bold text-2xl md:text-3xl mb-4">Stay Updated with Our Latest
                            Insights</h3>
                        <p class="text-gray-600 mb-6">Join our newsletter to receive industry insights, sustainability
                            tips, and updates on our latest projects.</p>

                        <form class="space-y-4">
                            <div class="flex flex-col sm:flex-row gap-4">
                                <input type="email" placeholder="Your Email Address"
                                    class="form-input flex-1 rounded-lg">
                                <button type="submit" class="btn btn-primary whitespace-nowrap">
                                    <span>Subscribe</span>
                                    <i class="fas fa-paper-plane ml-2"></i>
                                </button>
                            </div>
                            <p class="text-xs text-gray-500">By subscribing, you agree to our Privacy Policy and
                                consent to receive updates from our company.</p>
                        </form>
                    </div>

                    <div class="hidden md:block">
                        <img src="{{ asset('assets/img/newsletter.svg') }}" alt="Newsletter" class="w-full h-auto">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
