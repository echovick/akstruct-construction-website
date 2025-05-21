@props(['title' => '', 'subtitle' => '', 'items' => []])

<div class="relative py-16 bg-primary-dark text-white">
    <!-- Background pattern -->
    <div class="absolute inset-0 bg-pattern opacity-10 z-0"
        style="background-image: url('{{ asset('assets/img/pattern.svg') }}');"></div>

    <!-- Content -->
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center">
            <h1 class="font-heading font-bold text-4xl md:text-5xl mb-4">{{ $title }}</h1>
            @if ($subtitle)
                <p class="text-lg text-white/80 max-w-3xl mx-auto">{{ $subtitle }}</p>
            @endif
        </div>

        <!-- Breadcrumbs -->
        <div class="flex justify-center mt-8">
            <div class="flex items-center text-sm bg-white/10 px-4 py-2 rounded-full backdrop-blur-sm">
                <a href="{{ route('home') }}" class="text-white hover:text-secondary transition-colors">Home</a>

                @foreach ($items as $label => $url)
                    <span class="mx-2 text-gray-400">/</span>

                    @if ($loop->last)
                        <span class="text-white/90">{{ $label }}</span>
                    @else
                        <a href="{{ $url }}"
                            class="text-white hover:text-secondary transition-colors">{{ $label }}</a>
                    @endif
                @endforeach

                @if (count($items) === 0 && $title)
                    <span class="mx-2 text-gray-400">/</span>
                    <span class="text-white/90">{{ $title }}</span>
                @endif
            </div>
        </div>
    </div>
</div>
