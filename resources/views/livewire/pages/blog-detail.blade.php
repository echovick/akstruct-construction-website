<?php

use App\Models\Blog;
use Illuminate\Support\Facades\Cache;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('layout.web')] class extends Component {
    public $blog;
    public $relatedPosts = [];
    public $prevPost;
    public $nextPost;

    public function mount($slug)
    {
        $this->blog = Blog::published()->where('slug', $slug)->firstOrFail();

        // Increment view count in cache
        $cacheKey = 'blog_views_' . $this->blog->id;
        $views = Cache::get($cacheKey, 0);
        Cache::forever($cacheKey, $views + 1);

        // Get related posts from same category, excluding current post
        $this->relatedPosts = Blog::published()->where('category', $this->blog->category)->where('id', '!=', $this->blog->id)->orderBy('published_at', 'desc')->take(3)->get();

        // Get previous and next posts
        $this->prevPost = Blog::published()->where('published_at', '<', $this->blog->published_at)->orderBy('published_at', 'desc')->first();

        $this->nextPost = Blog::published()->where('published_at', '>', $this->blog->published_at)->orderBy('published_at', 'asc')->first();
    }
}; ?>

<div>
    <!-- Hero Section with smaller height -->
    <section class="relative bg-primary-dark text-white overflow-hidden">
        <!-- Background image with overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset($blog->featured_image) }}" alt="{{ $blog->title }}"
                class="w-full h-full object-cover object-center">
            <div class="absolute inset-0 bg-gradient-to-r from-primary-dark/90 to-primary/70"></div>
        </div>

        <!-- Floating elements (similar to homepage) -->
        <div class="absolute inset-0 z-10 pointer-events-none overflow-hidden">
            <div class="absolute top-24 left-10 w-32 h-32 bg-secondary/20 rounded-full filter blur-xl animate-pulse">
            </div>
            <div class="absolute bottom-24 right-10 w-40 h-40 bg-accent/20 rounded-full filter blur-xl animate-pulse"
                style="animation-delay: 1s;"></div>
        </div>

        <!-- Hero Content -->
        <div class="relative z-20 container mx-auto px-4 py-20">
            <div class="max-w-3xl" data-aos="fade-right" data-aos-duration="1000">
                <!-- Category badge -->
                <div class="inline-block bg-secondary text-primary-dark px-4 py-1 rounded-md font-medium mb-4">
                    {{ $blog->category }}
                </div>

                <h1 class="font-heading font-bold text-3xl md:text-4xl lg:text-5xl mb-6 text-white leading-tight">
                    {{ $blog->title }}
                </h1>

                <div class="flex flex-wrap items-center text-white/80 gap-6 mb-6">
                    <div class="flex items-center">
                        <div
                            class="w-10 h-10 rounded-full bg-secondary/30 flex items-center justify-center text-white mr-3">
                            <i class="fas fa-user"></i>
                        </div>
                        <span>{{ $blog->author }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="far fa-calendar-alt mr-2"></i>
                        <span>{{ $blog->published_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="far fa-clock mr-2"></i>
                        <span>{{ $blog->reading_time }} min read</span>
                    </div>
                    <div class="flex items-center">
                        <i class="far fa-eye mr-2"></i>
                        <span>{{ Cache::get('blog_views_' . $blog->id, 0) }} views</span>
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
                                <a href="{{ route('blog') }}" class="text-white hover:text-secondary">Blog</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-white/50 mx-2"></i>
                                <span class="text-white/80">{{ Str::limit($blog->title, 30) }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <!-- Main Content - Article Body -->
                <div class="lg:col-span-2">
                    <!-- Blog Content -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden" data-aos="fade-up">
                        @if ($blog->featured_image)
                            <div class="h-[400px] overflow-hidden">
                                <img src="{{ asset($blog->featured_image) }}" alt="{{ $blog->title }}"
                                    class="w-full h-full object-cover">
                            </div>
                        @endif

                        <div class="p-8">
                            <!-- Content -->
                            <div class="prose prose-lg max-w-none mb-10">
                                {!! $blog->content !!}
                            </div>

                            <!-- Tags -->
                            @if (!empty(json_decode($blog->tags)))
                                <div class="mt-8 pt-8 border-t border-gray-100">
                                    <h4 class="font-bold text-lg mb-4">Tags</h4>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach (json_decode($blog->tags) as $tag)
                                            <span class="inline-block px-3 py-1 bg-stone rounded-full text-sm">
                                                {{ $tag }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Share Buttons -->
                            <div class="mt-8 pt-8 border-t border-gray-100">
                                <h4 class="font-bold text-lg mb-4">Share This Article</h4>
                                <div class="flex space-x-4">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                        target="_blank" rel="noopener noreferrer"
                                        class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition-colors">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($blog->title) }}"
                                        target="_blank" rel="noopener noreferrer"
                                        class="w-10 h-10 rounded-full bg-blue-400 text-white flex items-center justify-center hover:bg-blue-500 transition-colors">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
                                        target="_blank" rel="noopener noreferrer"
                                        class="w-10 h-10 rounded-full bg-blue-800 text-white flex items-center justify-center hover:bg-blue-900 transition-colors">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                    <a href="https://wa.me/?text={{ urlencode($blog->title . ' ' . request()->url()) }}"
                                        target="_blank" rel="noopener noreferrer"
                                        class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center hover:bg-green-600 transition-colors">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation between posts -->
                    <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if ($prevPost)
                            <a href="{{ route('blog.show', $prevPost->slug) }}"
                                class="bg-stone p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow group">
                                <p class="text-secondary flex items-center mb-2">
                                    <i class="fas fa-arrow-left mr-2"></i>
                                    <span>Previous Article</span>
                                </p>
                                <h4 class="font-bold text-lg group-hover:text-secondary transition-colors">
                                    {{ Str::limit($prevPost->title, 50) }}</h4>
                            </a>
                        @endif

                        @if ($nextPost)
                            <a href="{{ route('blog.show', $nextPost->slug) }}"
                                class="bg-stone p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow text-right group">
                                <p class="text-secondary flex items-center justify-end mb-2">
                                    <span>Next Article</span>
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </p>
                                <h4 class="font-bold text-lg group-hover:text-secondary transition-colors">
                                    {{ Str::limit($nextPost->title, 50) }}</h4>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="sticky top-24 space-y-8">
                        <!-- Author Bio -->
                        <div class="bg-stone rounded-xl p-6 shadow-md" data-aos="fade-left">
                            <h3 class="text-xl font-bold mb-4">About the Author</h3>
                            <div class="flex items-center mb-4">
                                <div
                                    class="w-16 h-16 rounded-full bg-primary flex items-center justify-center text-white mr-4">
                                    <span class="text-xl font-bold">{{ substr($blog->author, 0, 1) }}</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold">{{ $blog->author }}</h4>
                                    <p class="text-gray-600 text-sm">Content Writer</p>
                                </div>
                            </div>
                            <p class="text-gray-600">
                                Expert in sustainable construction and engineering practices with a passion for sharing
                                industry knowledge and insights.
                            </p>
                        </div>

                        <!-- Related Articles -->
                        <div class="bg-stone rounded-xl p-6 shadow-md" data-aos="fade-left" data-aos-delay="100">
                            <h3 class="text-xl font-bold mb-4">Related Articles</h3>
                            @if ($relatedPosts->count() > 0)
                                <div class="space-y-4">
                                    @foreach ($relatedPosts as $related)
                                        <div class="flex gap-3">
                                            <div class="w-20 h-20 flex-shrink-0 rounded-md overflow-hidden">
                                                <img src="{{ asset($related->featured_image) }}"
                                                    alt="{{ $related->title }}" class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <h4 class="font-medium hover:text-secondary transition-colors">
                                                    <a
                                                        href="{{ route('blog.show', $related->slug) }}">{{ Str::limit($related->title, 50) }}</a>
                                                </h4>
                                                <p class="text-sm text-gray-500 mt-1">
                                                    {{ $related->published_at->format('M d, Y') }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500">No related articles found.</p>
                            @endif
                        </div>

                        <!-- Categories -->
                        <div class="bg-stone rounded-xl p-6 shadow-md" data-aos="fade-left" data-aos-delay="200">
                            <h3 class="text-xl font-bold mb-4">Categories</h3>
                            <ul class="space-y-2">
                                @foreach (Blog::select('category')->distinct()->orderBy('category')->pluck('category') as $category)
                                    <li>
                                        <a href="{{ route('blog', ['category' => $category]) }}"
                                            class="flex justify-between py-2 px-3 rounded-md hover:bg-stone/70 transition-colors {{ $blog->category === $category ? 'bg-secondary/10 text-secondary font-medium' : '' }}">
                                            <span>{{ $category }}</span>
                                            <span
                                                class="text-gray-500">{{ Blog::published()->where('category', $category)->count() }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Newsletter Signup -->
                        <div class="bg-primary-dark text-white rounded-xl p-6 shadow-md relative overflow-hidden"
                            data-aos="fade-left" data-aos-delay="300">
                            <!-- Decorative elements -->
                            <div class="absolute top-0 right-0 w-32 h-32 bg-secondary/10 rounded-full filter blur-xl">
                            </div>
                            <div class="absolute bottom-0 left-0 w-32 h-32 bg-accent/10 rounded-full filter blur-xl">
                            </div>

                            <div class="relative z-10">
                                <h3 class="text-xl font-bold mb-4">Subscribe to Newsletter</h3>
                                <p class="text-white/80 mb-4">Stay updated with our latest articles and industry
                                    insights.</p>
                                <form class="space-y-3">
                                    <input type="email" placeholder="Your Email Address"
                                        class="form-input w-full bg-white/10 border-white/20 text-white placeholder-white/60 rounded-lg">
                                    <button type="submit" class="btn btn-secondary w-full">
                                        <span>Subscribe</span>
                                        <i class="fas fa-paper-plane ml-2"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- More Articles Section -->
    <section class="py-16 bg-stone relative overflow-hidden">
        <div class="absolute inset-0 bg-pattern opacity-10 z-0"
            style="background-image: url('{{ asset('assets/img/pattern.svg') }}');"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-12">
                <span class="text-secondary text-sm uppercase tracking-widest font-medium mb-2 block"
                    data-aos="fade-down">EXPLORE MORE</span>
                <h2 class="font-heading font-bold text-3xl md:text-4xl mb-4" data-aos="fade-up">Latest Articles</h2>
                <p class="mt-4 text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Discover more of our insights and updates on sustainable construction
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach (Blog::published()->where('id', '!=', $blog->id)->orderBy('published_at', 'desc')->take(3)->get() as $recentBlog)
                    <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <x-blog-card :blog="$recentBlog" />
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12" data-aos="fade-up">
                <a href="{{ route('blog') }}" class="btn btn-primary">
                    <span>View All Articles</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-primary-dark relative overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute inset-0 bg-pattern opacity-10"
            style="background-image: url('{{ asset('assets/img/pattern.svg') }}');"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full filter blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/5 rounded-full filter blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center text-white">
                <h2 class="font-heading font-bold text-3xl md:text-4xl mb-6" data-aos="fade-up">
                    Ready to Start Your Sustainable Construction Project?
                </h2>
                <p class="text-lg text-white/80 mb-8 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Contact our team of experts today to discuss how we can bring your vision to life with our
                    sustainable construction solutions.
                </p>
                <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4"
                    data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('quote') }}" class="btn btn-secondary text-center">
                        <span>Request a Quote</span>
                        <i class="fas fa-file-invoice ml-2"></i>
                    </a>
                    <a href="{{ route('contact') }}"
                        class="btn bg-white text-primary-dark hover:bg-gray-100 text-center">
                        <span>Contact Us</span>
                        <i class="fas fa-envelope ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
