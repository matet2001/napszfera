<footer class="py-14 px-16 font-sans tracking-wide relative">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8">
        <div>
            <h4 class="font-semibold text-lg mb-6">Cég</h4>
            <ul class="space-y-5">
                <li>
                    <x-nav-link href="/contact" :active="request()->is('contact')">Kapcsolat</x-nav-link>
                </li>
                <li>
                    <x-nav-link href="/about" :active="request()->is('about')">Rólam</x-nav-link>
                </li>
            </ul>
        </div>
        <div class="col-span-2">
            <h4 class="font-semibold text-lg mb-6">Hírlevél</h4>
            <p class="text-gray-300 mb-4 text-[15px]">
                Iratkozz fel a hírlevelünkre!
            </p>
            <form class="mb-4">
                <ul class="space-y-5">
                    <li>
                        <div class="flex items-center">
                            <input type="email" placeholder="Add meg az email címed"
                                   class="px-4 py-3.5 rounded-l-md w-full text-[15px]" />
                            <button type="button"
                                    class="border border-white hover:bg-primary text-[15px] tracking-wide px-4 py-3.5 rounded-r-md">Feliratkozom!</button>
                        </div>
                    </li>
                </ul>
            </form>
        </div>

        <div class="col-span-2">
            <h4 class="font-semibold text-lg mb-6">Legal</h4>
            <ul class="space-y-5">
                <li><x-nav-link href="/privacy" :active="request()->is('privacy')">Adatkezelési Tájékoztató</x-nav-link></li>
                <li><x-nav-link href="/claim" :active="request()->is('claim')">Jogi Nyilatkozat</x-nav-link></li>
                <li><x-nav-link href="/terms" :active="request()->is('terms')">Általános Szerződési Feltételek</x-nav-link></li>
            </ul>
        </div>

{{--        <div class="flex items-center lg:justify-center">--}}
{{--            <a href="/">--}}
{{--                <x-application-logo class="h-20 w-20"/>--}}
{{--            </a>--}}
{{--        </div>--}}
    </div>

    <hr class="my-8 border-gray-600" />

    <div class="flex sm:justify-between flex-wrap gap-6">
        <div class="inline-flex space-x-3">
            <x-image-link href="https://www.facebook.com/profile.php?id=100002561333513" src="{{ Vite::asset('resources/images/facebook.png') }}"/>
            <x-image-link href="https://www.youtube.com/c/Sz%C3%A1razGy%C3%B6rgyCsatorn%C3%A1ja" src="{{ Vite::asset('resources/images/youtube.png') }}"/>
            <x-image-link href="https://www.instagram.com/szarazgyorgy2024/" src="{{ Vite::asset('resources/images/instagram.png') }}"/>
            <x-image-link href="https://www.tiktok.com/@domaandgyuri?lang=hu-HU" src="{{ Vite::asset('resources/images/tiktok.png') }}"/>
        </div>

        <div class="align-text-bottom">
            <p>&copy; {{ date('Y') }} Száraz György. Minden jog fenntartva.</p>
        </div>
    </div>
</footer>
