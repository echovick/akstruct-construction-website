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

    <!-- Trix Editor -->
    <link rel="stylesheet" href="https://unpkg.com/trix@2.0.8/dist/trix.css">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <style>
        /* Dropdown transition classes */
        .dropdown-menu-enter-active,
        .dropdown-menu-leave-active {
            transition: all 0.3s ease;
            max-height: 400px;
            /* Adjust based on your content */
        }

        .dropdown-menu-enter-from,
        .dropdown-menu-leave-to {
            opacity: 0;
            max-height: 0;
            overflow: hidden;
        }

        /* Ensure submenus don't overflow during animation */
        .submenu-wrapper {
            overflow: hidden;
        }
    </style>

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

                <!-- Projects -->
                <div x-data="{ open: false }" class="space-y-1">
                    <button @click="open = !open"
                        class="w-full px-3 py-2 rounded-md flex items-center justify-between {{ request()->routeIs('admin.projects*') ? 'bg-primary-light' : 'hover:bg-primary-light' }} transition-colors">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            Projects
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform"
                            :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-transition:enter="dropdown-menu-enter-active"
                        x-transition:enter-start="dropdown-menu-enter-from"
                        x-transition:leave="dropdown-menu-leave-active" x-transition:leave-end="dropdown-menu-leave-to"
                        class="submenu-wrapper pl-10 space-y-1">
                        <a href="{{ route('admin.projects.overview') }}"
                            class="block px-3 py-2 rounded-md hover:bg-primary-light transition-colors">All Projects</a>
                        <a href="{{ route('admin.projects.create') }}"
                            class="block px-3 py-2 rounded-md hover:bg-primary-light transition-colors">Add New</a>
                        <a href="{{ route('admin.projects.categories') }}"
                            class="block px-3 py-2 rounded-md hover:bg-primary-light transition-colors">Categories</a>
                    </div>
                </div>
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

                <form method="POST" action="#">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-3 py-2 rounded-md flex items-center hover:bg-primary-light transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
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
    <div class="flex-1 flex flex-col min-w-0">
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
                    <span class="text-sm text-gray-500 mr-4">Admin</span>
                    <img src="https://ui-avatars.com/api/?name={{ urlencode('Admin') }}&background=132D3A&color=fff"
                        alt="Admin" class="h-8 w-8 rounded-full">
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto overflow-x-hidden w-full">
            <div class="w-full px-4 py-4 md:px-8 md:py-8">
                @if (isset($header))
                    <div class="mb-6">
                        {{ $header }}
                    </div>
                @else
                    <h1 class="text-2xl font-semibold text-gray-800 mb-6">{{ $title ?? 'Dashboard' }}</h1>
                @endif

                {{ $slot }}
            </div>
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

                <!-- Projects -->
                <div x-data="{ open: false }" class="space-y-1">
                    <button @click="open = !open"
                        class="w-full px-3 py-2 rounded-md flex items-center justify-between {{ request()->routeIs('admin.projects*') ? 'bg-primary-light' : 'hover:bg-primary-light' }} transition-colors">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            Projects
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform"
                            :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-transition:enter="dropdown-menu-enter-active"
                        x-transition:enter-start="dropdown-menu-enter-from"
                        x-transition:leave="dropdown-menu-leave-active"
                        x-transition:leave-end="dropdown-menu-leave-to" class="submenu-wrapper pl-10 space-y-1">
                        <a href="{{ route('admin.projects.overview') }}"
                            class="block px-3 py-2 rounded-md hover:bg-primary-light transition-colors">All
                            Projects</a>
                        <a href="{{ route('admin.projects.create') }}"
                            class="block px-3 py-2 rounded-md hover:bg-primary-light transition-colors">Add New</a>
                        <a href="{{ route('admin.projects.categories') }}"
                            class="block px-3 py-2 rounded-md hover:bg-primary-light transition-colors">Categories</a>
                    </div>
                </div>
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

    <!-- Trix Editor -->
    <script src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

    <script>
        // Configure Trix editor for Livewire
        document.addEventListener('DOMContentLoaded', function() {
            // Listen for Trix changes and sync with Livewire
            document.addEventListener('trix-change', function(event) {
                const editor = event.target;
                const inputElement = document.getElementById(editor.getAttribute('input'));

                if (inputElement) {
                    // Update the hidden input value
                    inputElement.value = editor.value;

                    // Dispatch input event to notify Livewire
                    inputElement.dispatchEvent(new Event('input', {
                        bubbles: true
                    }));
                }
            });

            // Prevent file attachments in Trix (optional)
            document.addEventListener('trix-file-accept', function(event) {
                event.preventDefault();
                alert('File uploads are not supported in this editor.');
            });
        });
    </script>

    @livewireScripts
</body>

</html>
