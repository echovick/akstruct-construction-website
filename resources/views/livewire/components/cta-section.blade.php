@props(['title' => 'Ready to Start Your Project?', 'subtitle' => 'Let\'s discuss your project and how we can bring your vision to life with innovative, sustainable solutions.'])

<section class="py-16 bg-secondary">
    <div class="container mx-auto px-4 text-center">
        <h2 class="font-heading font-bold text-3xl md:text-4xl text-primary-dark mb-6">{{ $title }}</h2>
        <p class="text-lg text-primary-dark mb-8 max-w-3xl mx-auto">{{ $subtitle }}</p>
        <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
            <a href="{{ route('quote') }}" class="btn btn-primary">Request a Quote</a>
            <a href="{{ route('contact') }}" class="btn bg-white text-primary-dark hover:bg-gray-100">Contact Us</a>
        </div>
    </div>
</section>
