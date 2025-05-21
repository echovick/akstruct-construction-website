<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Admin Dashboard' }} - Akstruct Construction</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    @livewireStyles
</head>

<body class="font-sans antialiased bg-gray-100 min-h-screen flex">
    <!-- Sidebar -->
    <aside class="bg-primary-dark text-white w-64 flex-shrink-0 hidden md:block">
        <div class="p-4 border-b border-primary-light">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center">
                <img src="{{ asset('assets/img/logo-white.svg') }}" alt="Akstruct Construction" class="h-8">
                <span class="ml-2 font-medium">Admin Panel</span>
            </a>
        </div>

        <nav class="p-4">
            <div class="space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                    class="px-3 py-2 rounded-md flex items-center {{ request()->routeIs('admin.dashboard') ? 'bg-primary-light' : 'hover:bg-primary-light' }} transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.projects.index') }}"
                    class="px-3 py-2 rounded-md flex items-center {{ request()->routeIs('admin.projects*') ? 'bg-primary-light' : 'hover:bg-primary-light' }} transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Projects
                </a>

                <a href="{{ route('admin.services.index') }}"
                    class="px-3 py-2 rounded-md flex items-center {{ request()->routeIs('admin.services*') ? 'bg-primary-light' : 'hover:bg-primary-light' }} transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Services
                </a>

                <a href="{{ route('admin.testimonials.index') }}"
                    class="px-3 py-2 rounded-md flex items-center {{ request()->routeIs('admin.testimonials*') ? 'bg-primary-light' : 'hover:bg-primary-light' }} transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                    Testimonials
                </a>

                <a href="{{ route('admin.blog.index') }}"
                    class="px-3 py-2 rounded-md flex items-center {{ request()->routeIs('admin.blog*') ? 'bg-primary-light' : 'hover:bg-primary-light' }} transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    Blog
                </a>

                <a href="{{ route('admin.faqs.index') }}"
                    class="px-3 py-2 rounded-md flex items-center {{ request()->routeIs('admin.faqs*') ? 'bg-primary-light' : 'hover:bg-primary-light' }} transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    FAQs
                </a>

                <a href="{{ route('admin.careers.index') }}"
                    class="px-3 py-2 rounded-md flex items-center {{ request()->routeIs('admin.careers*') ? 'bg-primary-light' : 'hover:bg-primary-light' }} transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Careers
                </a>

                <a href="{{ route('admin.quotes.index') }}"
                    class="px-3 py-2 rounded-md flex items-center {{ request()->routeIs('admin.quotes*') ? 'bg-primary-light' : 'hover:bg-primary-light' }} transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Quote Requests
                </a>

                <a href="{{ route('admin.settings') }}"
                    class="px-3 py-2 rounded-md flex items-center {{ request()->routeIs('admin.settings*') ? 'bg-primary-light' : 'hover:bg-primary-light' }} transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Settings
                </a>
            </div>

            <div class="pt-8 mt-8 border-t border-primary-light">
                <a href="{{ route('home') }}" target="_blank"
                    class="px-3 py-2 rounded-md flex items-center hover:bg-primary-light transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    View Website
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-3 py-2 rounded-md flex items-center hover:bg-primary-light transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow">
            <div class="px-4 py-3 flex justify-between items-center">
                <button type="button" class="md:hidden text-gray-500 hover:text-gray-700 focus:outline-none"
                    id="sidebar-toggle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <div class="flex items-center">
                    <span class="text-sm text-gray-500 mr-4">{{ Auth::user()->name }}</span>
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=132D3A&color=fff"
                        alt="{{ Auth::user()->name }}" class="h-8 w-8 rounded-full">
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto p-4 md:p-8">
            @if (isset($header))
                <div class="mb-6">
                    {{ $header }}
                </div>
            @else
                <h1 class="text-2xl font-semibold text-gray-800 mb-6">{{ $title ?? 'Dashboard' }}</h1>
            @endif

            {{ $slot }}
        </main>
    </div>

    <!-- Mobile Sidebar Overlay -->
    <div class="fixed inset-0 bg-black opacity-50 z-20 hidden" id="sidebar-overlay"></div>

    <!-- Mobile Sidebar -->
    <aside
        class="fixed inset-y-0 left-0 w-64 bg-primary-dark text-white z-30 transform -translate-x-full transition-transform duration-300 md:hidden"
        id="mobile-sidebar">
        <div class="p-4 border-b border-primary-light flex justify-between items-center">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center">
                <img src="{{ asset('assets/img/logo-white.svg') }}" alt="Akstruct Construction" class="h-8">
                <span class="ml-2 font-medium">Admin Panel</span>
            </a>
            <button type="button" class="text-white focus:outline-none" id="close-sidebar">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Same navigation as desktop sidebar -->
        <nav class="p-4">
            <div class="space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                    class="px-3 py-2 rounded-md flex items-center {{ request()->routeIs('admin.dashboard') ? 'bg-primary-light' : 'hover:bg-primary-light' }} transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>

                <!-- Other navigation items (same as desktop sidebar) -->
                <!-- ... -->
            </div>
        </nav>
    </aside>

    <!-- Sidebar Toggle JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const closeSidebar = document.getElementById('close-sidebar');
            const sidebarOverlay = document.getElementById('sidebar-overlay');
            const mobileSidebar = document.getElementById('mobile-sidebar');

            function openSidebar() {
                mobileSidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }

            function closeSidebarFn() {
                mobileSidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }

            sidebarToggle.addEventListener('click', openSidebar);
            closeSidebar.addEventListener('click', closeSidebarFn);
            sidebarOverlay.addEventListener('click', closeSidebarFn);
        });
    </script>

    @livewireScripts
</body>

</html>
