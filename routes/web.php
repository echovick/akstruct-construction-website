<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// Main pages
Volt::route('/', 'pages.home')->name('home');
Volt::route('/about', 'pages.about')->name('about');
Volt::route('/services', 'pages.services')->name('services');
Volt::route('/project-portfolio', 'pages.project-portfolio')->name('project-portfolio');
Volt::route('/services/{service}', 'pages.service-detail')->name('services.show');
Volt::route('/projects/{project}', 'pages.project-detail')->name('projects.show');
Volt::route('/contact', 'pages.contact')->name('contact');

// Quote request
Volt::route('/quote', 'pages.quote')->name('quote');

// Testimonials
Volt::route('/testimonials', 'pages.testimonials')->name('testimonials');

// Blog
Volt::route('/blog', 'pages.blog')->name('blog');
Volt::route('/blog/{slug}', 'pages.blog-detail')->name('blog.show');

// Careers
Volt::route('/careers', 'pages.careers')->name('careers');

// FAQ
Volt::route('/faq', 'pages.faq')->name('faq');

// Privacy Policy
Volt::route('/privacy-policy', 'pages.privacy-policy')->name('privacy-policy');

// terms of service
Volt::route('/terms-of-service', 'pages.terms-of-service')->name('terms-of-service');

// Admin routes (optional - protected by authentication)
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Volt::route('/', 'admin.dashboard')->name('dashboard');

    // Projects management
    Route::get('/projects', \App\Livewire\Admin\Projects\Index::class)->name('projects.index');
    Route::get('/projects/create', \App\Livewire\Admin\Projects\Form::class)->name('projects.create');
    Route::get('/projects/{project}/edit', \App\Livewire\Admin\Projects\Form::class)->name('projects.edit');

    // Services management
    Volt::route('/services', 'admin.services.index')->name('services.index');
    Volt::route('/services/create', 'admin.services.create')->name('services.create');
    Volt::route('/services/{service}/edit', 'admin.services.edit')->name('services.edit');

    // Testimonials management
    Volt::route('/testimonials', 'admin.testimonials.index')->name('testimonials.index');
    Volt::route('/testimonials/create', 'admin.testimonials.create')->name('testimonials.create');
    Volt::route('/testimonials/{testimonial}/edit', 'admin.testimonials.edit')->name('testimonials.edit');

    // Blog management
    Volt::route('/blog', 'admin.blog.index')->name('blog.index');
    Volt::route('/blog/create', 'admin.blog.create')->name('blog.create');
    Volt::route('/blog/{blog}/edit', 'admin.blog.edit')->name('blog.edit');

    // FAQs management
    Volt::route('/faqs', 'admin.faqs.index')->name('faqs.index');
    Volt::route('/faqs/create', 'admin.faqs.create')->name('faqs.create');
    Volt::route('/faqs/{faq}/edit', 'admin.faqs.edit')->name('faqs.edit');

    // Careers management
    Volt::route('/careers', 'admin.careers.index')->name('careers.index');
    Volt::route('/careers/create', 'admin.careers.create')->name('careers.create');
    Volt::route('/careers/{career}/edit', 'admin.careers.edit')->name('careers.edit');

    // Quotes management
    Volt::route('/quotes', 'admin.quotes.index')->name('quotes.index');
    Volt::route('/quotes/{quote}', 'admin.quotes.show')->name('quotes.show');

    // Settings
    Volt::route('/settings', 'admin.settings')->name('settings');
});

Route::get('/artisan/optimize', function () {
    Artisan::call('optimize:clear');
    return 'Application optimized successfully!';
});

Route::get('/artisan/storage-link', function () {
    Artisan::call('storage:link');
    return 'Symlink Created Successfully successfully!';
});

Route::get('/artisan/migrate', function () {
    Artisan::call('migrate');
    return 'Migrations executed successfully!';
});
