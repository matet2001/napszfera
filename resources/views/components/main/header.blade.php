<header>
    <nav class="mx-auto flex items-center justify-between p-6 lg:px-8" aria-label="Global">
        <div class="flex items-center space-x-4">
            <a href="/">
                <x-application-logo class="h-10 w-10"/>
            </a>
            <a href="/">
                <span class="font-semibold text-lg text-white">NAPSZFÉRA</span>
            </a>
        </div>
        <div class="hidden lg:flex items-center space-x-6">
            <x-nav-link href="{{ route('products.lecture') }}" :active="request()->routeIs('products.lecture')">ELŐADÁSOK</x-nav-link>
            <x-nav-link href="{{ route('products.meditation') }}" :active="request()->routeIs('products.meditation')">MEDITÁCIÓK</x-nav-link>
            <x-nav-link href="{{ route('products.audiobook') }}" :active="request()->routeIs('products.audiobook')">HANGOSKÖNYVEK</x-nav-link>

        </div>
        <div class="hidden lg:flex ">
            @guest()
                <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">Bejelentkezés</x-nav-link>
                <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">Regisztráció</x-nav-link>
            @endguest

            @auth()
                <x-nav-link href="{{ route('profile.edit') }}" :active="request()->routeIs('profile.edit')">Profilom</x-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-primary-button>Kijelentkezés</x-primary-button>
                </form>
            @endauth

            <!-- Button to trigger the slide-over panel -->
            @auth()
            <button id="open-panel" class="bg-blue-500 px-4 py-2 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </button>
            @endauth
        </div>
        <div class="flex lg:hidden">
            <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700" id="open-menu">
                <span class="sr-only">Open main menu</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>
    </nav>
    <!-- Mobile menu, show/hide based on menu open state. -->
    <div class="lg:hidden hidden fixed inset-0 overflow-hidden z-50" role="dialog" aria-modal="true" id="sidebar-panel">
        <div class="fixed inset-0 bg-black opacity-0 transition-opacity duration-500 ease-in-out" id="background-overlay"></div>
        <!-- Background backdrop, show/hide based on slide-over state. -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                <div id="sidebar-content"
                     class="pointer-events-auto w-screen max-w-sm transform transition-transform duration-500 ease-in-out translate-x-full bg-white px-6 py-6 sm:ring-1 sm:ring-gray-900/10">
                    <div class="flex items-center justify-between">
                        <a href="/">
                            <x-application-logo class="h-10 w-10"/>
                        </a>
                        <a href="/">
                            <span class="font-semibold text-lg text-white">NAPSZFÉRA</span>
                        </a>
                        <button type="button" class="-m-2.5 rounded-md p-2.5" id="close-menu">
                            <span class="sr-only">Close menu</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    <div class="mt-6 flow-root">
                        <div class="-my-6 divide-y divide-gray-500/10">
                            <div class="space-y-2 py-6">
                                <div class="-mx-3">
                                    <button type="button" class="flex w-full items-center justify-between rounded-lg py-2 pl-3 pr-3.5 text-base font-semibold leading-7 hover:bg-gray-50" aria-controls="disclosure-1" aria-expanded="false">
                                        Termékek
                                        <svg class="h-5 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                    <div class="mt-2 space-y-2 hidden" id="disclosure-1">
                                        <a href="{{ route('products.lecture') }}" class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold leading-7 hover:bg-gray-50">ELŐADÁSOK</a>
                                        <a href="{{ route('products.meditation') }}" class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold leading-7 hover:bg-gray-50">MEDITÁCIÓK</a>
                                        <a href="{{ route('products.audiobook') }}" class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold leading-7 hover:bg-gray-50">HANGOSKÖNYVEK</a>
                                    </div>
                                    <a href="{{ route('contact') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 hover:bg-gray-50">Kapcsolat</a>
                                    <a href="{{ route('about') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 hover:bg-gray-50">Rólam</a>
                                </div>
                            <div class="py-6">
                                @guest()
                                    <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">Bejelentkezés</x-nav-link>
                                    <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">Regisztráció</x-nav-link>
                                @endguest

                                @auth()
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const openMenuButton = document.getElementById('open-menu');
        const closeMenuButton = document.getElementById('close-menu');
        const sidebarPanel = document.getElementById('sidebar-panel');
        const sidebarContent = document.getElementById('sidebar-content');
        const backgroundOverlay = document.getElementById('background-overlay');

        openMenuButton.addEventListener('click', function () {
            sidebarPanel.classList.remove('hidden');
            setTimeout(function () {
                sidebarContent.classList.remove('translate-x-full');
                sidebarContent.classList.add('translate-x-0');
                backgroundOverlay.classList.remove('opacity-0');
                backgroundOverlay.classList.add('opacity-75');
            }, 10);
        });

        closeMenuButton.addEventListener('click', function () {
            sidebarContent.classList.remove('translate-x-0');
            sidebarContent.classList.add('translate-x-full');
            backgroundOverlay.classList.remove('opacity-75');
            backgroundOverlay.classList.add('opacity-0');
            setTimeout(function () {
                sidebarPanel.classList.add('hidden');
            }, 500);
        });

        // Product sub-menu toggle
        const productButton = document.querySelector('[aria-controls="disclosure-1"]');
        const productSubMenu = document.getElementById('disclosure-1');

        productButton.addEventListener('click', function() {
            const expanded = productButton.getAttribute('aria-expanded') === 'true';
            productButton.setAttribute('aria-expanded', !expanded);
            productSubMenu.classList.toggle('hidden');
        });
    });
</script>

