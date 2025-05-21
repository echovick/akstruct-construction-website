@props(['blog'])

<div class="card overflow-hidden group h-full flex flex-col">
    <div class="relative overflow-hidden h-52">
        <img src="{{ asset($blog->featured_image) }}" alt="{{ $blog->title }}"
            class="h-full w-full object-cover group-hover:scale-110 transition-transform duration-500">
        <div
            class="absolute inset-0 bg-primary-dark bg-opacity-40 group-hover:bg-opacity-20 transition-opacity duration-300">
        </div>
        <div class="absolute bottom-0 left-0 p-3 bg-secondary text-primary-dark">
            <span class="inline-block text-sm font-medium">{{ $blog->category }}</span>
        </div>
    </div>
    <div class="p-6 flex-grow">
        <div class="flex items-center gap-4 text-sm text-gray-500 mb-3">
            <span class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                {{ $blog->published_at->format('M d, Y') }}
            </span>
            <span class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ $blog->reading_time }} min read
            </span>
        </div>
        <h3 class="text-xl font-semibold mb-2">{{ $blog->title }}</h3>
        <p class="text-gray-600 mb-4">
            {{ $blog->excerpt ? $blog->excerpt : \Illuminate\Support\Str::limit(strip_tags($blog->content), 120) }}
        </p>
        <a href="{{ route('blog.show', $blog->slug) }}"
            class="text-secondary font-medium hover:text-secondary-dark inline-flex items-center">
            Read More
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>
</div>
