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
            <x-nav-link href="{{ route('product.lecture') }}" :active="request()->routeIs('product.lecture')">ELŐADÁSOK</x-nav-link>
            <x-nav-link href="{{ route('product.meditation') }}" :active="request()->routeIs('product.meditation')">MEDITÁCIÓK</x-nav-link>
            <x-nav-link href="{{ route('product.audiobook') }}" :active="request()->routeIs('product.audiobook')">HANGOSKÖNYVEK</x-nav-link>

        </div>

        <!-- Desktop Navigation Links and Actions -->
        <div class="hidden lg:flex items-center space-x-5">

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

            @guest()
                <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">Bejelentkezés</x-nav-link>
            @endguest
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
    <x-mobile.side-panel />



</header>
