@auth


    <nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-md border-b border-gray-100 nav-shadow sticky top-0 z-50">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">

                <!-- Right side (settings dropdown) -->
                <div class="flex items-center ml-auto" data-aos="fade-down" data-aos-delay="250">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center space-x-2 focus:outline-none group">
                                <div class="text-right hidden sm:block">
                                    <div class="text-sm font-medium text-gray-900 group-hover:text-indigo-600 transition">{{ Auth::user()->name }}</div>
                                    <div class="text-xs text-gray-500 group-hover:text-indigo-400 transition">{{ Auth::user()->email }}</div>
                                </div>
                                <div class="avatar-ring rounded-full bg-indigo-100 text-indigo-600 w-10 h-10 flex items-center justify-center overflow-hidden">
                                    @if(Auth::user()->profile_photo_path)
                                        <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-lg font-medium">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                    @endif
                                </div>
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-indigo-500 transition" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile')" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition">
                                <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition">
                                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                                    </svg>
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Mobile menu button -->
                <div class="flex items-center md:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-indigo-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div x-show="open" x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="md:hidden mobile-menu origin-top-right">
            <div class="pt-2 pb-3 space-y-1 px-4">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="block pl-3 pr-4 py-2 border-l-4 border-transparent hover:border-indigo-500 hover:bg-indigo-50 text-base font-medium text-gray-600 hover:text-gray-900 transition">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>

                @can('admin')
                <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')" class="block pl-3 pr-4 py-2 border-l-4 border-transparent hover:border-indigo-500 hover:bg-indigo-50 text-base font-medium text-gray-600 hover:text-gray-900 transition">
                    {{ __('Users') }}
                </x-responsive-nav-link>
                @endcan

                <x-responsive-nav-link :href="route('consultations.index')" :active="request()->routeIs('consultations.*')" class="block pl-3 pr-4 py-2 border-l-4 border-transparent hover:border-indigo-500 hover:bg-indigo-50 text-base font-medium text-gray-600 hover:text-gray-900 transition">
                    {{ __('Consultations') }}
                </x-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-3 border-t border-gray-200 px-4">
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0">
                        @if(Auth::user()->profile_photo_path)
                            <img class="h-10 w-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                        @else
                            <div class="bg-indigo-100 text-indigo-600 rounded-full w-10 h-10 flex items-center justify-center">
                                <span class="text-lg font-medium">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>
                    <div>
                        <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile')" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100 transition">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100 transition">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </nav>


@endauth
