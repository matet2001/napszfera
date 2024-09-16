@vite('resources/js/header.js')
@vite('resources/css/header.css')

<header>
    <nav class="mx-auto flex items-center justify-between p-6 lg:px-8" aria-label="Global">
        <!-- Logo and Brand Name -->
        <div class="flex items-center space-x-4">
            <a href="{{ route('home') }}">
                <x-application-logo class="h-10 w-10" />
            </a>
            <a href="{{ route('home') }}">
                <span class="font-semibold text-lg text-white">NAPSZFÉRA</span>
            </a>
        </div>

        <div class="hidden lg:flex space-x-8 items-center">
            <x-nav-link href="{{ route('products.lecture') }}" :active="request()->routeIs('products.lecture')">ELŐADÁSOK</x-nav-link>
            <x-nav-link href="{{ route('products.meditation') }}" :active="request()->routeIs('products.meditation')">MEDITÁCIÓK</x-nav-link>
            <x-nav-link href="{{ route('products.audiobook') }}" :active="request()->routeIs('products.audiobook')">HANGOSKÖNYVEK</x-nav-link>

        </div>

        <!-- Desktop Navigation Links and Actions -->
        <div class="hidden lg:flex items-center space-x-6">

            @auth
                <!-- Cart Icon -->
                <x-cart.icon id="open-panel"/>

                <!-- Profile dropdown -->
                <div class="relative">
                    <button type="button" class="relative flex items-center justify-center rounded-full bg-gray-800 text-white h-10 w-10 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                        <span class="sr-only">Open user menu</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A3.25 3.25 0 018.14 16h7.72a3.25 3.25 0 013.019 1.804M16 10a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="user-menu-dropdown" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 transition-transform transition-opacity duration-300 ease-in-out transform opacity-0 scale-95 hidden" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                        <a href="{{ route('inventory.index') }}" class="block px-4 py-2 text-base text-black hover:bg-gray-500" role="menuitem" tabindex="-1" id="user-menu-item-0">Termékeim</a>
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-base text-black hover:bg-gray-500" role="menuitem" tabindex="-1" id="user-menu-item-1">Profilom</a>
                        <a href="#" id="logout-link" class="block px-4 py-2 text-base text-black hover:bg-gray-500" role="menuitem" tabindex="-1">Kijelentkezés</a>

                        <!-- Hidden logout form -->
                        <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
                            @csrf
                        </form>
                    </div>
                </div>
            @endauth
        </div>

        <!-- Mobile Menu Toggle Button -->
        <div class="lg:hidden flex items-center space-x-6">
            @auth
                <!-- Cart Icon for Mobile -->
                <x-cart.icon id="open-panel-mobile"/>
            @endauth

            <!-- Mobile Menu Button -->
            <button type="button" id="open-mobile-menu" class="-m-2.5 p-2.5 rounded-md text-gray-700">
                <span class="sr-only">Open main menu</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>
    </nav>



    <!-- Mobile Sidebar Menu -->
    <div id="mobile-sidebar-panel" class="lg:hidden hidden fixed inset-0 z-50 overflow-hidden" role="dialog" aria-modal="true">
        <!-- Overlay Background -->
        <div id="mobile-background-overlay" class="fixed inset-0 bg-black opacity-0 transition-opacity duration-500 ease-in-out"></div>

        <!-- Sidebar Content -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                <div id="mobile-sidebar-content" class="pointer-events-auto w-screen max-w-sm transform transition-transform duration-500 ease-in-out translate-x-full bg-white px-6 py-6">
                    <div class="flex items-center justify-between">
                        <a href="/">
                            <x-application-logo class="h-10 w-10" />
                        </a>
                        <a href="/">
                            <span class="font-semibold text-lg text-white">NAPSZFÉRA</span>
                        </a>
                        <button type="button" id="close-mobile-menu" class="-m-2.5 p-2.5 rounded-md">
                            <span class="sr-only">Close menu</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Mobile Navigation Links -->
                    <div class="mt-6 flow-root">
                        <div class="-my-6 divide-y divide-gray-500/10">
                            <div class="space-y-2 py-6">
                                <div class="-mx-3">
                                    <button type="button" class="flex w-full items-center justify-between rounded-lg py-2 pl-3 pr-3.5 text-base font-semibold leading-7 hover:bg-gray-50" aria-controls="mobile-disclosure-1" aria-expanded="false">
                                        Termékek
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                    <div id="mobile-disclosure-1" class="mt-2 space-y-2 hidden">
                                        <a href="{{ route('products.lecture') }}" class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold leading-7 hover:bg-gray-50">ELŐADÁSOK</a>
                                        <a href="{{ route('products.meditation') }}" class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold leading-7 hover:bg-gray-50">MEDITÁCIÓK</a>
                                        <a href="{{ route('products.audiobook') }}" class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold leading-7 hover:bg-gray-50">HANGOSKÖNYVEK</a>
                                    </div>
                                    <a href="{{ route('contact') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 hover:bg-gray-50">Kapcsolat</a>
                                    <a href="{{ route('about') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 hover:bg-gray-50">Rólam</a>
                                </div>
                            </div>

                            <!-- Mobile Authentication Links -->
                            <div class="py-6">
                                @guest
                                    <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">Bejelentkezés</x-nav-link>
                                    <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">Regisztráció</x-nav-link>
                                @endguest

                                @auth
                                    <x-nav-link href="{{ route('profile.edit') }}" :active="request()->routeIs('profile.edit')">Profilom</x-nav-link>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-primary-button>Kijelentkezés</x-primary-button>
                                    </form>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
