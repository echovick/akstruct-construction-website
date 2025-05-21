<?php

use App\Models\Faq;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('layout.web')] class extends Component {
    public $faqs;
    public $categories;
    public $selectedCategory = null;
    public $searchQuery = '';

    public function mount()
    {
        $this->loadFaqs();
    }

    public function loadFaqs()
    {
        $query = Faq::published()->ordered();

        if ($this->selectedCategory) {
            $query->where('category', $this->selectedCategory);
        }

        if ($this->searchQuery) {
            $query->where(function ($q) {
                $q->where('question', 'like', '%' . $this->searchQuery . '%')->orWhere('answer', 'like', '%' . $this->searchQuery . '%');
            });
        }

        $this->faqs = $query->get();
    }

    public function filterByCategory($category = null)
    {
        $this->selectedCategory = $category;
        $this->loadFaqs();
    }

    public function updatedSearchQuery()
    {
        $this->loadFaqs();
    }

    public function with(): array
    {
        $allCategories = Faq::published()->select('category')->distinct()->whereNotNull('category')->orderBy('category')->pluck('category')->toArray();

        return [
            'allCategories' => $allCategories,
        ];
    }
}; ?>

<div>
    <!-- Hero Section with Parallax Effect -->
    <section class="relative bg-primary-dark text-white overflow-hidden">
        <!-- Background image with overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('assets/IMG_7144.JPG') }}" alt="Frequently Asked Questions"
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
                    Frequently Asked Questions</h1>
                <p class="text-xl text-white/90 mb-8 leading-relaxed">Find answers to common questions about our
                    services, processes, and sustainable construction approaches</p>

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
                                <span class="text-white/80">FAQs</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- FAQ Search and Filter Section -->
    <section class="py-16 bg-white relative overflow-hidden">
        <!-- Background elements -->
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-stone/50 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-60 h-60 bg-secondary/10 rounded-full blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto">
                <!-- Search Box -->
                <div class="mb-10" data-aos="fade-up">
                    <div class="relative">
                        <input type="text" wire:model.debounce.300ms="searchQuery" placeholder="Search FAQs..."
                            class="w-full pl-12 pr-4 py-4 rounded-xl border border-gray-200 shadow-md focus:ring-2 focus:ring-secondary focus:border-secondary">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        @if ($searchQuery)
                            <button wire:click="$set('searchQuery', '')"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times"></i>
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Category Filters -->
                <div class="mb-12" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex flex-wrap justify-center gap-3">
                        <button wire:click="filterByCategory(null)"
                            class="px-5 py-2 rounded-full text-sm font-medium transition-all duration-300 {{ $selectedCategory === null ? 'bg-primary text-white' : 'bg-stone hover:bg-gray-200 text-gray-700' }}">
                            All Categories
                        </button>

                        @foreach ($allCategories as $category)
                            <button wire:click="filterByCategory('{{ $category }}')"
                                class="px-5 py-2 rounded-full text-sm font-medium transition-all duration-300 {{ $selectedCategory === $category ? 'bg-primary text-white' : 'bg-stone hover:bg-gray-200 text-gray-700' }}">
                                {{ $category }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ List Section -->
    <section class="py-10 pb-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                @if ($faqs->isEmpty())
                    <div class="text-center py-16" data-aos="fade-up">
                        <i class="fas fa-search text-5xl text-gray-300 mb-4"></i>
                        <h3 class="text-2xl font-semibold mb-2">No FAQs Found</h3>
                        <p class="text-gray-600">
                            @if ($searchQuery)
                                No results match your search term "{{ $searchQuery }}". Please try a different search
                                term or browse by category.
                            @elseif($selectedCategory)
                                No FAQs found in the "{{ $selectedCategory }}" category. Please try a different
                                category.
                            @else
                                No FAQs are currently available. Please check back later.
                            @endif
                        </p>
                        @if ($searchQuery || $selectedCategory)
                            <button wire:click="$set('searchQuery', ''); filterByCategory(null)"
                                class="mt-6 btn btn-primary">
                                <span>View All FAQs</span>
                                <i class="fas fa-redo ml-2"></i>
                            </button>
                        @endif
                    </div>
                @else
                    <!-- Display FAQs by category -->
                    @php
                        $currentCategory = null;
                    @endphp

                    @foreach ($faqs as $faq)
                        @if (!$selectedCategory && $currentCategory !== $faq->category)
                            @php $currentCategory = $faq->category; @endphp
                            <div class="mb-8 mt-12 first:mt-0" data-aos="fade-up">
                                <h2
                                    class="text-2xl font-bold text-primary-dark border-b-2 border-secondary pb-2 inline-block">
                                    {{ $faq->category ?? 'General' }}</h2>
                            </div>
                        @endif

                        <div class="mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                            <div
                                class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
                                <button
                                    class="faq-question flex justify-between items-center w-full px-6 py-4 text-left">
                                    <span class="text-lg font-semibold">{{ $faq->question }}</span>
                                    <i class="fas fa-plus text-primary transition-transform duration-300"></i>
                                </button>
                                <div class="faq-answer px-6 pb-6 hidden">
                                    <p class="text-gray-600">{{ $faq->answer }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <!-- Can't Find Answer Section -->
    <section class="py-16 bg-stone relative overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-white/50 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-60 h-60 bg-secondary/10 rounded-full blur-3xl"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-10" data-aos="fade-up">
                <div class="text-center mb-8">
                    <h2 class="font-heading font-bold text-2xl md:text-3xl mb-4">Can't Find Your Answer?</h2>
                    <p class="text-gray-600">If you couldn't find the information you were looking for, our team is
                        ready to help.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="text-center p-6 rounded-xl bg-stone hover:bg-stone/80 transition-colors duration-300">
                        <div
                            class="h-16 w-16 bg-primary-dark/10 rounded-full flex items-center justify-center text-primary mx-auto mb-4">
                            <i class="fas fa-envelope text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Contact Us</h3>
                        <p class="text-gray-600 mb-4">Reach out to our team with your specific questions and get
                            personalized answers.</p>
                        <a href="{{ route('contact') }}" class="btn btn-primary">
                            <span>Send a Message</span>
                            <i class="fas fa-paper-plane ml-2"></i>
                        </a>
                    </div>

                    <div class="text-center p-6 rounded-xl bg-stone hover:bg-stone/80 transition-colors duration-300">
                        <div
                            class="h-16 w-16 bg-primary-dark/10 rounded-full flex items-center justify-center text-primary mx-auto mb-4">
                            <i class="fas fa-file-invoice text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Request a Quote</h3>
                        <p class="text-gray-600 mb-4">Have a specific project in mind? Request a detailed quote
                            tailored to your needs.</p>
                        <a href="{{ route('quote') }}" class="btn btn-primary">
                            <span>Get a Quote</span>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Contact Info -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                        <div
                            class="h-16 w-16 bg-primary-dark rounded-full flex items-center justify-center text-white mx-auto mb-4">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Call Us</h3>
                        <p class="text-gray-600">08140993888 | 07082323113</p>
                    </div>

                    <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                        <div
                            class="h-16 w-16 bg-primary-dark rounded-full flex items-center justify-center text-white mx-auto mb-4">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Email Us</h3>
                        <p class="text-gray-600">akstructltd@gmail.com</p>
                    </div>

                    <div class="text-center" data-aos="fade-up" data-aos-delay="300">
                        <div
                            class="h-16 w-16 bg-primary-dark rounded-full flex items-center justify-center text-white mx-auto mb-4">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Visit Us</h3>
                        <p class="text-gray-600">Third Floor, Global Plaza, Suit C410, Jabi, Abuja</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript for FAQ accordion -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.addEventListener('click', function(e) {
                if (e.target.closest('.faq-question')) {
                    const question = e.target.closest('.faq-question');
                    const answer = question.nextElementSibling;
                    const icon = question.querySelector('i');

                    // Toggle current FAQ
                    answer.classList.toggle('hidden');
                    icon.classList.toggle('fa-plus');
                    icon.classList.toggle('fa-minus');
                    icon.classList.toggle('transform');
                    icon.classList.toggle('rotate-45');
                }
            });

            // Add Livewire hook to reinitialize accordion after DOM updates
            document.addEventListener('livewire:load', function() {
                Livewire.hook('message.processed', (message, component) => {
                    // This runs after a Livewire update
                });
            });
        });
    </script>
</div>
