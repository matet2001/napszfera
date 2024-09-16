@vite('resources/js/mobile-sidemenu.js')

<style>
    .profile-menu {
        opacity: 0;
        max-height: 0;
        overflow: hidden;
        transition: opacity 0.3s ease, max-height 0.3s ease;
    }
    .profile-menu.open {
        opacity: 1;
        max-height: 500px; /* Adjust this value based on your menu's height */
    }
</style>


<div id="mobile-sidebar-panel" class="lg:hidden hidden fixed inset-0 z-50 overflow-hidden text-black " role="dialog" aria-modal="true">
    <!-- Overlay Background -->
    <div id="mobile-background-overlay" class="fixed inset-0 bg-black opacity-0 transition-opacity duration-500 ease-in-out"></div>

    <!-- Sidebar Content -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
            <div id="mobile-sidebar-content" class="pointer-events-auto w-screen max-w-sm transform transition-transform duration-500 ease-in-out translate-x-full bg-accent px-6 py-6">

                <!-- Top Section: Logo, Brand Name, and Close Button -->
                <div class="flex items-center justify-between mb-6">
                    <a href="/" class="flex items-center space-x-2">
                        <x-application-logo class="h-10 w-10" />
                        <span class="font-semibold text-lg text-black">NAPSZFÉRA</span>
                    </a>
                    <button type="button" id="close-mobile-menu" class="-m-2.5 p-2.5 rounded-md">
                        <span class="sr-only">Close menu</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="border-b border-black my-5"></div>

                <!-- Conditional Profile Menu -->
                @auth
                    <button type="button" class="flex w-full items-center justify-between rounded-lg py-2 pl-3 pr-3.5 text-base font-semibold leading-7 hover:bg-gray-50" aria-controls="mobile-profile-menu" aria-expanded="false">
                        Profilom
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                    <div id="mobile-profile-menu" class="profile-menu mt-2 text-gray-700">
                        <a href="{{ route('inventory.index') }}" class="block px-4 py-2 text-base hover:bg-gray-50" role="menuitem" tabindex="-1" id="user-menu-item-0">Termékeim</a>
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-base hover:bg-gray-50" role="menuitem" tabindex="-1" id="user-menu-item-1">Profilom</a>
                        <a href="#" id="mobile-logout-link" class="block px-4 py-2 text-base hover:bg-gray-50" role="menuitem" tabindex="-1">Kijelentkezés</a>

                        <!-- Hidden logout form -->
                        <form id="mobile-logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
                            @csrf
                        </form>
                    </div>
                @endauth

                @guest()
                    <a href="{{ route('login') }}" class="block rounded-lg px-3 py-2 text-base font-semibold leading-7 hover:bg-gray-50">Bejelentkezés</a>
                @endguest

                <!-- Mobile Navigation Links -->
                <div class="space-y-4 my-8">
                    <a href="{{ route('products.lecture') }}" class="block rounded-lg py-2 px-3 text-base font-semibold leading-7 hover:bg-gray-50">ELŐADÁSOK</a>
                    <a href="{{ route('products.meditation') }}" class="block rounded-lg py-2 px-3 text-base font-semibold leading-7 hover:bg-gray-50">MEDITÁCIÓK</a>
                    <a href="{{ route('products.audiobook') }}" class="block rounded-lg py-2 px-3 text-base font-semibold leading-7 hover:bg-gray-50">HANGOSKÖNYVEK</a>
                </div>

                <!-- Bottom Links -->
                <div class="space-y-2">
                    <a href="{{ route('contact') }}" class="block rounded-lg px-3 py-2 text-base font-semibold leading-7 hover:bg-gray-50">Kapcsolat</a>
                    <a href="{{ route('about') }}" class="block rounded-lg px-3 py-2 text-base font-semibold leading-7 hover:bg-gray-50">Bemutatkozás</a>
                </div>
            </div>
        </div>
    </div>
</div>
