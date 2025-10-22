@props(['project'])

<div class="card overflow-hidden group h-full flex flex-col">
    <div class="relative overflow-hidden h-64">
        <img src="{{ $project->featured_image }}" alt="{{ $project->title }}"
            class="h-full w-full object-cover group-hover:scale-110 transition-transform duration-500">
        <div
            class="absolute inset-0 bg-primary-dark bg-opacity-20 group-hover:bg-opacity-0 transition-opacity duration-300">
        </div>
        <div class="absolute bottom-0 left-0 p-4 bg-primary bg-opacity-90 text-white">
            <span class="inline-block">{{ $project->category }}</span>
        </div>
    </div>
    <div class="p-6 flex-grow">
        <h3 class="text-xl font-semibold mb-2">{{ $project->title }}</h3>
        <p class="text-gray-600 mb-4">
            {{ \Illuminate\Support\Str::limit($project->description, 100) }}</p>
        <div class="flex justify-between items-center text-sm text-gray-500 mb-4">
            <span>{{ $project->location }}</span>
            <span>{{ $project->year }}</span>
        </div>
        <a href="{{ isset($project) && $project->slug ? route('projects.show', $project) : '#' }}"
            class="text-secondary font-medium hover:text-secondary-dark inline-flex items-center">
            View Project
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>
</div>
