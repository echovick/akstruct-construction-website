@props(['title', 'subtitle' => '', 'background' => 'assets/img/page-header-bg.jpg'])

<section class="bg-primary-dark py-16 md:py-20 text-white relative">
    <div class="absolute inset-0 opacity-20"
        style="background-image: url('{{ asset($background) }}'); background-size: cover; background-position: center;">
    </div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-3xl">
            <h1 class="font-heading font-bold text-4xl md:text-5xl mb-4 text-white">{{ $title }}</h1>
            @if ($subtitle)
                <p class="text-xl text-gray-100">{{ $subtitle }}</p>
            @endif
        </div>
    </div>
</section>
