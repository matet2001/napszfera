@vite(['resources/css/header.css'])
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
            <x-nav-link href="/termekek/eloadasok" :active="request()->is('eloadasok')">ELŐADÁSOK</x-nav-link>
            <x-nav-link href="/termekek/meditaciok" :active="request()->is('meditaciok')">MEDITÁCIÓK</x-nav-link>
            <x-nav-link href="/termekek/hangoskonyvek" :active="request()->is('hangoskonyvek')">HANGOSKÖNYVEK</x-nav-link>
        </div>
        <div class="hidden lg:flex ">
            @guest()
                <x-nav-link href="/login" :active="request()->is('login')">Bejelentkezés</x-nav-link>
                <x-nav-link href="/register" :active="request()->is('register')">Regisztráció</x-nav-link>
            @endguest

            @auth()
                <x-nav-link href="/profile" :active="request()->is('profile')">Profilom</x-nav-link>
                <form method="POST" action="/logout">
                    @csrf
                    <x-primary-button>Kijelentkezés</x-primary-button>
                </form>
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
    <div class="lg:hidden hidden" role="dialog" aria-modal="true" id="sidebar">
        <!-- Background backdrop, show/hide based on slide-over state. -->
        <div class="fixed inset-0 z-10"></div>
        <div class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
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
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
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
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div class="mt-2 space-y-2 hidden" id="disclosure-1">
                                <a href="/eloadasok" class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold leading-7 hover:bg-gray-50">ELŐADÁSOK</a>
                                <a href="/meditaciok" class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold leading-7 hover:bg-gray-50">MEDITÁCIÓK</a>
                                <a href="/hangoskonyvek" class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold leading-7 hover:bg-gray-50">HANGOSKÖNYVEK</a>
                            </div>
                        </div>
                        <a href="/contact" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 hover:bg-gray-50">Kapcsolat</a>
                        <a href="/about" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 hover:bg-gray-50">Rólam</a>
                    </div>
                    <div class="py-6">
                        @guest()
                            <x-nav-link href="/login" :active="request()->is('login')">Bejelentkezés</x-nav-link>
                            <x-nav-link href="/register" :active="request()->is('register')">Regisztráció</x-nav-link>
                        @endguest

                        @auth()
                            <x-nav-link href="/profile" :active="request()->is('profile')">Profilom</x-nav-link>
                            <form method="POST" action="/logout">
                                @csrf
                                <x-primary-button>Kijelentkezés</x-primary-button>
                            </form>
                        @endauth
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
        const sidebar = document.getElementById('sidebar');

        openMenuButton.addEventListener('click', function () {
            sidebar.classList.remove('hidden');
        });

        closeMenuButton.addEventListener('click', function () {
            sidebar.classList.add('hidden');
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
