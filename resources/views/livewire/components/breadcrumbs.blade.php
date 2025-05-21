@props(['items' => []])

<div class="bg-gray-100 py-3">
    <div class="container mx-auto px-4">
        <div class="flex items-center text-sm">
            <a href="{{ route('home') }}" class="text-primary hover:text-secondary transition-colors">Home</a>

            @foreach ($items as $label => $url)
                <span class="mx-2 text-gray-400">/</span>

                @if ($loop->last)
                    <span class="text-gray-600">{{ $label }}</span>
                @else
                    <a href="{{ $url }}"
                        class="text-primary hover:text-secondary transition-colors">{{ $label }}</a>
                @endif
            @endforeach
        </div>
    </div>
</div>
