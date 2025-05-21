<?php

use App\Models\Service;
use App\Models\Project;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('layout.web')] class extends Component {
    public $serviceId;

    public function mount($service)
    {
        $this->serviceId = $service;
    }

    public function with(): array
    {
        $service = Service::findOrFail($this->serviceId);

        // Find related projects (in a real app, you might have a relationship defined)
        $relatedProjects = Project::where('category', 'like', '%' . $service->title . '%')
            ->orWhere('description', 'like', '%' . $service->title . '%')
            ->take(3)
            ->get();

        return [
            'service' => $service,
            'relatedProjects' => $relatedProjects,
        ];
    }
}; ?>

<div>
    <x-livewire.components.page-header :title="$service->title" background="assets/img/services/service-detail-header.jpg" />

    <x-livewire.components.breadcrumbs :items="['Services' => route('services'), $service->title => '']" />

    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <div class="lg:col-span-2">
                    <div class="mb-8">
                        @if ($service->icon)
                            <img src="{{ asset($service->icon) }}" alt="{{ $service->title }}" class="h-16 w-16 mb-6">
                        @endif
                        <h2 class="font-heading font-bold text-3xl mb-6">About This Service</h2>

                        <div class="prose prose-lg max-w-none text-gray-600">
                            <p class="mb-4">{{ $service->description }}</p>

                            @if ($service->long_description)
                                <div class="mt-6">
                                    {{ $service->long_description }}
                                </div>
                            @else
                                <p>Our {{ $service->title }} service is designed to meet the needs of modern
                                    construction projects with a focus on sustainability, efficiency, and quality. We
                                    leverage our expertise and experience to deliver exceptional results that exceed
                                    client expectations.</p>

                                <h3 class="text-xl font-semibold mt-8 mb-4">Key Features</h3>
                                <ul class="list-disc pl-6 space-y-2">
                                    <li>Comprehensive planning and execution by experienced professionals</li>
                                    <li>Sustainable approaches that minimize environmental impact</li>
                                    <li>Innovative solutions to complex challenges</li>
                                    <li>Attention to detail and commitment to quality</li>
                                    <li>Clear communication throughout the project lifecycle</li>
                                </ul>

                                <h3 class="text-xl font-semibold mt-8 mb-4">Our Process</h3>
                                <p>We follow a structured process to ensure the success of every project:</p>
                                <ol class="list-decimal pl-6 space-y-2 mt-2">
                                    <li><strong>Initial Consultation:</strong> We meet with you to understand your needs
                                        and vision.</li>
                                    <li><strong>Assessment & Planning:</strong> Our team conducts a thorough analysis
                                        and develops a comprehensive plan.</li>
                                    <li><strong>Implementation:</strong> We execute the plan with precision and
                                        attention to detail.</li>
                                    <li><strong>Quality Assurance:</strong> Rigorous quality checks ensure all work
                                        meets our high standards.</li>
                                    <li><strong>Completion & Handover:</strong> We deliver the finished project and
                                        provide follow-up support.</li>
                                </ol>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                        <h3 class="text-xl font-semibold mb-4">Why Choose Us</h3>
                        <ul class="space-y-4">
                            <li class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6 text-secondary flex-shrink-0 mr-2" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Experienced and certified professionals</span>
                            </li>
                            <li class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6 text-secondary flex-shrink-0 mr-2" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Sustainable approaches and materials</span>
                            </li>
                            <li class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6 text-secondary flex-shrink-0 mr-2" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Innovative solutions to complex challenges</span>
                            </li>
                            <li class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6 text-secondary flex-shrink-0 mr-2" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Attention to detail and quality</span>
                            </li>
                            <li class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6 text-secondary flex-shrink-0 mr-2" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Timely delivery and clear communication</span>
                            </li>
                        </ul>

                        <div class="mt-8">
                            <h3 class="text-xl font-semibold mb-4">Get Started</h3>
                            <p class="text-gray-600 mb-4">Ready to discuss your project needs? Contact us for a
                                consultation.</p>
                            <a href="{{ route('quote') }}" class="btn btn-primary w-full text-center">Request a
                                Quote</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if ($relatedProjects->isNotEmpty())
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <h2 class="font-heading font-bold text-3xl mb-10 text-center">Related Projects</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach ($relatedProjects as $project)
                        <x-livewire.components.project-card :project="$project" />
                    @endforeach
                </div>

                <div class="text-center mt-10">
                    <a href="{{ route('projects') }}" class="btn btn-outline">View All Projects</a>
                </div>
            </div>
        </section>
    @endif

    <x-livewire.components.cta-section />
</div>
