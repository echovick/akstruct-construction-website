@props(['service'])

<div class="card group h-full flex flex-col overflow-hidden">
    <div
        class="bg-primary-dark p-6 text-secondary group-hover:bg-secondary group-hover:text-primary-dark transition-colors duration-300">
        @if ($service->icon)
            <img src="{{ asset($service->icon) }}" alt="{{ $service->title }}" class="h-12 w-12 mb-4">
        @else
            <div class="h-12 w-12 mb-4 bg-secondary rounded-full flex items-center justify-center text-primary">
                <span class="text-xl font-bold">{{ substr($service->title, 0, 1) }}</span>
            </div>
        @endif
        <h3 class="text-xl font-semibold text-white group-hover:text-primary-dark">{{ $service->title }}</h3>
    </div>
    <div class="p-6 flex-grow">
        <p class="text-gray-600 mb-4">{{ $service->description }}</p>
        <a href="{{ route('services.show', $service) }}"
            class="text-secondary font-medium hover:text-secondary-dark inline-flex items-center">
            Learn More
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>
</div>
