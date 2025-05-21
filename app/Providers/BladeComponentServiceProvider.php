<?php
namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeComponentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerComponentNamespaces();
    }

    /**
     * Register component namespaces.
     */
    private function registerComponentNamespaces(): void
    {
        // Auto-register anonymous components from both directories
        // This will make <x-components.xyz> work with components in resources/views/components/
        Blade::anonymousComponentPath(resource_path('views/components'));

        // This will make <x-livewire.components.xyz> work with components in resources/views/livewire/components/
        Blade::anonymousComponentPath(resource_path('views/livewire/components'), 'livewire.components');
    }
}
