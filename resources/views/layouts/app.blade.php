<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
         <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles

       <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">


    <!-- Custom styles -->
    <style>
        @keyframes blob {
    0% {
        transform: translate(0px, 0px) scale(1);
    }
    33% {
        transform: translate(30px, -50px) scale(1.1);
    }
    66% {
        transform: translate(-20px, 20px) scale(0.9);
    }
    100% {
        transform: translate(0px, 0px) scale(1);
    }
}

@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
    100% { transform: translateY(0px); }
}

.animate-blob {
    animation: blob 7s infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}

.nav-shadow {
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
}

.menu-item {
    position: relative;
    transition: all 0.3s ease;
}

.menu-item::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 2px;
    background: currentColor;
    transition: width 0.3s ease;
}

.menu-item:hover::after {
    width: 100%;
}

.avatar-ring {
    transition: all 0.3s ease;
    box-shadow: 0 0 0 2px transparent;
}

.avatar-ring:hover {
    box-shadow: 0 0 0 2px currentColor;
    transform: translateY(-2px);
}

.mobile-menu {
    transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

.card-hover {
    transition: all 0.3s ease;
}

.card-hover:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
}

.stat-icon {
    transition: all 0.3s ease;
}

.card-hover:hover .stat-icon {
    transform: scale(1.1);
}

.quick-link {
    transition: all 0.2s ease;
}

.quick-link:hover {
    background-color: rgba(79, 70, 229, 0.05);
    transform: translateX(3px);
}

.gradient-bg {
    background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
}

.row-hover {
    transition: all 0.2s ease;
}

.row-hover:hover {
    background-color: rgba(79, 70, 229, 0.03);
    transform: translateX(2px);
}

.action-btn {
    transition: all 0.2s ease;
}

.action-btn:hover {
    transform: translateY(-1px);
}

.sort-arrow {
    transition: transform 0.2s ease;
}

.sort-header:hover .sort-arrow {
    opacity: 1;
}

.badge {
    transition: all 0.2s ease;
}

.badge:hover {
    transform: scale(1.05);
}

.info-card {
    transition: all 0.2s ease;
}

.info-card:hover {
    background-color: rgba(249, 250, 251, 0.8);
}

.back-btn {
    transition: all 0.2s ease;
}

.back-btn:hover {
    transform: translateX(-3px);
}

.problem-description {
    transition: all 0.3s ease;
}

.problem-description:hover {
    background-color: rgba(236, 253, 245, 0.5);
    border-color: rgba(16, 185, 129, 0.2);
}

.status-badge {
    transition: all 0.2s ease;
}

.status-badge:hover {
    transform: scale(1.05);
}

.animate-float {
    animation: float 6s ease-in-out infinite;
}

.transition-slow {
    transition: all 0.5s ease;
}

 .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .transition-slow {
            transition: all 0.5s ease;
        }
        .input-highlight {
            transition: all 0.3s ease;
            box-shadow: 0 0 0 1px rgba(59, 130, 246, 0);
        }
        .input-highlight:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

     .max-h-60 {
       max-height: 15rem;
     }

     /* Autocomplete dropdown styling */
.autocomplete-dropdown {
    position: absolute;
    z-index: 1000;
    width: 100%;
    max-height: 200px;
    overflow-y: auto;
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 0.375rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

.autocomplete-item {
    padding: 0.5rem 1rem;
    cursor: pointer;
}

.autocomplete-item:hover {
    background-color: #f7fafc;
}

/* Selected items styling */
.selected-items {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-top: 0.5rem;
}

.selected-item {
    display: inline-flex;
    align-items: center;
    background-color: #ebf8ff;
    color: #3182ce;
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.875rem;
    font-weight: 500;
}

.selected-item button {
    margin-left: 0.25rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #3182ce;
}

.selected-item button:hover {
    color: #2c5282;
}

button:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

          /* Modal styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .modal-overlay.show {
            opacity: 1;
            pointer-events: auto;
        }

        .modal-content {
            background: white;
            padding: 2rem;
            border-radius: 0.5rem;
            width: 90%;
            max-width: 500px;
            transform: translateY(20px);
            transition: transform 0.3s ease;
        }

        .modal-overlay.show .modal-content {
            transform: translateY(0);
        }

        /* Ensure modal appears above everything */
    [x-cloak] { display: none !important; }

    /* Prevent background scrolling when modal is open */
    body.modal-open {
        overflow: hidden;
    }

    /* Fix for Livewire morphdom issues */
    [wire\:id] {
        display: contents;
    }

    .fixed.z-\[9999\] {
    z-index: 9999 !important;
}
    </style>

    </head>
    <body class="font-sans antialiased">
        @auth
        <div class="min-h-screen bg-gray-100 flex">
            <!-- Sidebar -->
            <div class="hidden md:flex md:flex-shrink-0">
                <div class="flex flex-col w-64 bg-white border-r border-gray-200">
                    <div class="h-0 flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center px-4">
                            <a href="{{ route('dashboard') }}">
                                <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                            </a>
                        </div>

                         <nav class="mt-5 flex-1 px-2 space-y-1">
    <!-- Dashboard - Always visible for authenticated users -->
    <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
    </x-sidebar-link>

    <!-- Consultations -->
    @if(auth()->user()->isAdmin() || auth()->user()->hasPermission('view-consultations'))
    <x-sidebar-link :href="route('consultations.index')" :active="request()->routeIs('consultations.*')">
        {{ __('Consultations') }}
    </x-sidebar-link>
    @endif

    <!-- Hospitals -->
    @if(auth()->user()->isAdmin() || auth()->user()->hasPermission('manage-hospitals'))
    <x-sidebar-link :href="route('hospitals.index')" :active="request()->routeIs('hospitals.*')">
        {{ __('Hospitals') }}
    </x-sidebar-link>
    @endif

    <!-- Specialties -->
    @if(auth()->user()->isAdmin() || auth()->user()->hasPermission('manage-specialties'))
    <x-sidebar-link :href="route('specialties.index')" :active="request()->routeIs('specialties.*')">
        {{ __('Specialties') }}
    </x-sidebar-link>
    @endif

    <!-- Doctors -->
    @if(auth()->user()->isAdmin() || auth()->user()->hasPermission('manage-doctors'))
    <x-sidebar-link :href="route('doctors.index')" :active="request()->routeIs('doctors.*')">
        {{ __('Doctors') }}
    </x-sidebar-link>
    @endif
    
     <x-sidebar-link :href="route('doctors.list')" :active="request()->routeIs('doctors.list')">
    {{ __('Doctors Availability List') }}
</x-sidebar-link>

    <!-- Enquiries -->
    @if(auth()->user()->isAdmin() || auth()->user()->hasPermission('manage-enquiries'))
    <x-sidebar-link :href="route('business-enquiries.index')" :active="request()->routeIs('business-enquiries.*')">
        {{ __('Enquiries') }}
    </x-sidebar-link>
    @endif

    <!-- Blogs -->
    @if(auth()->user()->isAdmin() || auth()->user()->hasPermission('manage-blogs'))
    <x-sidebar-link :href="route('blogs.index')" :active="request()->routeIs('blogs.*')">
        {{ __('Blogs') }}
    </x-sidebar-link>
    @endif

   

    <!-- Users -->
    @if(auth()->user()->isAdmin() || auth()->user()->hasPermission('manage-users'))
    <x-sidebar-link :href="route('users.index')" :active="request()->routeIs('users.*')">
        {{ __('Users') }}
    </x-sidebar-link>
    @endif
</nav>
                    </div>

                    <!-- User Profile Section -->
                    <div class="flex-shrink-0 flex border-t border-gray-200 p-4">
                        <div class="flex items-center">
                            <div class="ml-3">
                                <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                                <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col overflow-hidden">
                @include('layouts.navigation')

                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                <main class="flex-1 overflow-y-auto p-4">
                    {{ $slot }}
                </main>
            </div>
        </div>
        @else
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        @endauth
        <!-- AOS JS -->



  <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Livewire Scripts - Alpine is automatically included with Livewire v3 -->
    @livewireScripts

    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            mirror: false
        });

        // Livewire event listeners
        document.addEventListener('livewire:init', () => {
            Livewire.on('notify', (message) => {
                alert(message);
            });
        });
    </script>

    <script>
    document.addEventListener('livewire:init', () => {
        // Force Alpine to re-evaluate modal state when Livewire updates
        Livewire.hook('commit', ({ component, commit, respond, succeed, fail }) => {
            succeed(() => {
                if (component.name === 'doctors.availability') {
                    // Trigger Alpine re-evaluation
                    Alpine.store('forceModalUpdate', Math.random());
                }
            });
        });
    });
</script>

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('slot-selected', (slotId) => {
            console.log('Slot selected:', slotId);
            lastAction = 'slot-selected: ' + slotId;
        });
    });

    let lastAction = 'none';
</script>
</body>
</html>
