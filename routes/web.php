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
Volt::route('/projects/hh-guzape', 'pages.hh-guzape-project')->name('projects.hh-guzape');
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
Route::middleware(['guest'])->prefix('admin')->group(function () {
    Volt::route('/', 'admin.dashboard')->name('admin.dashboard');

    // Projects
    Volt::route('/projects/overview', 'admin.projects.overview')->name('admin.projects.overview');
    Volt::route('/projects/create', 'admin.projects.create')->name('admin.projects.create');
    Volt::route('/projects/{project}/edit', 'admin.projects.edit')->name('admin.projects.edit');
    Volt::route('/projects/categories', 'admin.projects.categories')->name('admin.projects.categories');

    // Services
    Volt::route('/services', 'admin.services.overview')->name('admin.services.overview');
    Volt::route('/services/create', 'admin.services.create')->name('admin.services.create');
    Volt::route('/services/{service}/edit', 'admin.services.edit')->name('admin.services.edit');

    // Pages
    Route::get('/pages', \App\Livewire\Admin\Pages\Overview::class)->name('admin.pages.overview');
    Route::get('/pages/create', \App\Livewire\Admin\Pages\Create::class)->name('admin.pages.create');
    Route::get('/pages/{page}/edit', \App\Livewire\Admin\Pages\Edit::class)->name('admin.pages.edit');

    // Blog
    Volt::route('/blog', 'admin.blog.overview')->name('admin.blog.overview');
    Volt::route('/blog/create', 'admin.blog.create')->name('admin.blog.create');
    Volt::route('/blog/{blog}/edit', 'admin.blog.overview.edit')->name('admin.blog.overview.edit');
    Volt::route('/blog/categories', 'admin.blog.categories')->name('admin.blog.categories');

    // Team
    Volt::route('/team', 'admin.team')->name('admin.team');
    Volt::route('/team/create', 'admin.team.create')->name('admin.team.create');
    Volt::route('/team/{team}/edit', 'admin.team.edit')->name('admin.team.edit');

    // Job Listings
    Volt::route('/job-listings', 'admin.job-listings')->name('admin.job-listings');
    Volt::route('/job-listings/create', 'admin.job-listings.create')->name('admin.job-listings.create');
    Volt::route('/job-listings/{job-listing}/edit', 'admin.job-listings.edit')->name('admin.job-listings.edit');
    Volt::route('/job-listings/applications', 'admin.job-listings.applications')->name('admin.job-listings.all-applications');
    Volt::route('/job-listings/{job-listing}/applications', 'admin.job-listings.applications')->name('admin.job-listings.applications');

    // Media Library
    Volt::route('/media-library', 'admin.media-library')->name('admin.media-library');

    // Users & Permissions
    Volt::route('/users', 'admin.users')->name('admin.users');
    Volt::route('/roles', 'admin.roles')->name('admin.roles');
    Volt::route('/permissions', 'admin.permissions')->name('admin.permissions');

    // Settings
    Volt::route('/general', 'admin.general')->name('admin.general');
    Volt::route('/seo', 'admin.seo')->name('admin.seo');
    Volt::route('/social-media', 'admin.social-media')->name('admin.social-media');
    Volt::route('/contact', 'admin.contact')->name('admin.contact');
});

// Blog Routes
// Route::prefix('admin/blog')->middleware(['auth'])->group(function () {
//     Route::get('/', \App\Livewire\Admin\Blog\Overview::class)->name('admin.blog.overview');
//     Route::get('/create', \App\Livewire\Admin\Blog\Create::class)->name('admin.blog.create');
//     Route::get('/{id}/edit', \App\Livewire\Admin\Blog\Edit::class)->name('admin.blog.overview.edit');
//     Route::get('/categories', \App\Livewire\Admin\Blog\Categories::class)->name('admin.blog.categories');
// });

// Admin Team Management
// Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
//     Route::get('/team', \App\Livewire\Admin\Team\Overview::class)->name('team.overview');
//     Route::get('/team/create', \App\Livewire\Admin\Team\Create::class)->name('team.create');
//     Route::get('/team/{id}/edit', \App\Livewire\Admin\Team\Edit::class)->name('team.edit');
// });

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
