@props(['testimonial'])

<div class="card p-8 flex flex-col h-full">
    <div class="mb-4 text-secondary">
        <!-- Stars based on rating -->
        <div class="flex">
            @for ($i = 0; $i < $testimonial->rating; $i++)
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
            @endfor
        </div>
    </div>

    <div class="flex-grow">
        <p class="italic text-gray-600 mb-6">"{{ $testimonial->content }}"</p>
    </div>

    <div class="flex items-center mt-4">
        @if ($testimonial->image)
            <img src="{{ asset($testimonial->image) }}" alt="{{ $testimonial->client_name }}"
                class="h-12 w-12 rounded-full object-cover mr-4">
        @else
            <div class="h-12 w-12 rounded-full bg-primary-light text-white flex items-center justify-center mr-4">
                <span class="text-lg font-bold">{{ substr($testimonial->client_name, 0, 1) }}</span>
            </div>
        @endif
        <div>
            <h4 class="font-semibold text-lg m-0">{{ $testimonial->client_name }}</h4>
            <p class="text-gray-500 text-sm">
                {{ $testimonial->position }}{{ $testimonial->company ? ', ' . $testimonial->company : '' }}
            </p>
        </div>
    </div>
</div>
