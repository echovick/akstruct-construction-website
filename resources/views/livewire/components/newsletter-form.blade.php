<?php

use App\Models\NewsletterSubscriber;
use Livewire\Volt\Component;

new class extends Component {
    public $email = '';
    public $successMessage = '';
    public $errorMessage = '';

    public function subscribe()
    {
        $this->successMessage = '';
        $this->errorMessage = '';

        $this->validate([
            'email' => 'required|email|max:255',
        ]);

        try {
            // Check if email already exists
            $exists = NewsletterSubscriber::where('email', $this->email)->exists();

            if ($exists) {
                $this->errorMessage = 'This email is already subscribed to our newsletter.';
                return;
            }

            // Create new subscriber
            NewsletterSubscriber::create([
                'email' => $this->email,
                'subscribed_at' => now(),
            ]);

            $this->successMessage = 'Thank you for subscribing! You will receive our latest updates.';
            $this->email = '';
        } catch (\Exception $e) {
            $this->errorMessage = 'An error occurred. Please try again later.';
        }
    }
}; ?>

<div>
    <form wire:submit.prevent="subscribe" class="space-y-4">
        @if($successMessage)
            <div class="bg-green-500/20 border border-green-500 text-green-100 px-4 py-3 rounded-lg text-sm">
                {{ $successMessage }}
            </div>
        @endif

        @if($errorMessage)
            <div class="bg-red-500/20 border border-red-500 text-red-100 px-4 py-3 rounded-lg text-sm">
                {{ $errorMessage }}
            </div>
        @endif

        <div class="relative">
            <input
                type="email"
                wire:model="email"
                placeholder="Your Email Address"
                class="w-full px-4 py-3 rounded-lg bg-primary bg-opacity-50 border border-gray-600 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent @error('email') border-red-500 @enderror">
            <button
                type="submit"
                wire:loading.attr="disabled"
                class="absolute right-0 top-0 h-full px-4 bg-secondary text-white rounded-r-lg hover:bg-secondary-dark transition-colors duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                <span wire:loading.remove>
                    <i class="fas fa-paper-plane"></i>
                </span>
                <span wire:loading>
                    <i class="fas fa-spinner fa-spin"></i>
                </span>
            </button>
        </div>

        @error('email')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </form>
</div>
