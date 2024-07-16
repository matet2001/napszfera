{{--<footer>--}}
{{--    <div class="container mx-auto px-6 text-center border-t border-white/10 text-xs">--}}
{{--        <div class="flex justify-around">--}}
{{--            <div class="flex flex-wrap text-left border-x border-white/10 w-full max-w-screen-md">--}}
{{--                <h2 class="w-full p-2 text-white">Cég</h2>--}}
{{--                <div class="w-full"></div>--}}
{{--                <div class="w-full"></div>--}}
{{--            </div>--}}
{{--            <div class="flex flex-wrap text-left border-x border-white/10 container w-full max-w-screen-md">--}}
{{--                <h2 class="w-full p-4">Iratkozz fel a hírlevelünkre!</h2>--}}
{{--                <div class="w-full py-3">A bizalmadért cserébe küldünk egy letölthető, ingyenes meditációt!</div>--}}
{{--                <div class="w-full py-3">--}}
{{--                    <x-input-label for="email" :value="__('Email')" />--}}
{{--                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />--}}
{{--                    <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--                    <x-primary-button>Feliratkozom!</x-primary-button>--}}
{{--                </div>--}}
{{--                <div class="w-full py-3"></div>--}}
{{--            </div>--}}
{{--            <div class="flex flex-wrap text-left border-x border-white/10 w-full max-w-screen-md">--}}
{{--                <h2 class="w-full p-2">Legal</h2>--}}
{{--                <div class="w-full"></div>--}}
{{--                <div class="w-full"></div>--}}
{{--                <div class="w-full"></div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="flex justify-between shadow-md py-4 border-t border-white/10">--}}
{{--            <div class="align-text-bottom">--}}
{{--                <p>&copy; {{ date('Y') }} Száraz György. Minden jog fenntartva.</p>--}}
{{--            </div>--}}
{{--            <div class="inline-flex space-x-3">--}}
{{--                <x-image-link href="https://www.facebook.com/profile.php?id=100002561333513" src="{{ Vite::asset('resources/images/facebook.png') }}"/>--}}
{{--                <x-image-link href="https://www.youtube.com/c/Sz%C3%A1razGy%C3%B6rgyCsatorn%C3%A1ja" src="{{ Vite::asset('resources/images/youtube.png') }}"/>--}}
{{--                <x-image-link href="https://www.instagram.com/szarazgyorgy2024/" src="{{ Vite::asset('resources/images/instagram.png') }}"/>--}}
{{--                <x-image-link href="https://www.tiktok.com/@domaandgyuri?lang=hu-HU" src="{{ Vite::asset('resources/images/tiktok.png') }}"/>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</footer>--}}

{{--<footer class="tracking-wide py-10 px-10">--}}
{{--    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">--}}
{{--        <div>--}}
{{--            <h4 class="font-semibold text-lg mb-6">Cég</h4>--}}
{{--            <ul class="space-y-5">--}}
{{--                <li>--}}
{{--                    <x-nav-link href="/contact" :active="request()->is('contact')">Kapcsolat</x-nav-link>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <x-nav-link href="/about" :active="request()->is('about')">Rólam</x-nav-link>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}

{{--        <div>--}}
{{--            <h4 class="font-semibold text-lg mb-6">Cég</h4>--}}
{{--            <ul class="space-y-5">--}}
{{--                <li>--}}
{{--                    <x-nav-link href="/contact" :active="request()->is('contact')">Kapcsolat</x-nav-link>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <x-nav-link href="/about" :active="request()->is('about')">Rólam</x-nav-link>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}

{{--        <div>--}}
{{--            <h4 class="font-semibold text-lg mb-6">Cég</h4>--}}
{{--            <ul class="space-y-5">--}}
{{--                <li>--}}
{{--                    <x-nav-link href="/contact" :active="request()->is('contact')">Kapcsolat</x-nav-link>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <x-nav-link href="/about" :active="request()->is('about')">Rólam</x-nav-link>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}



{{--    <div class="border-t text-center border-[#6b5f5f] pt-8 mt-8">--}}
{{--        <p class="text-gray-300 text-[15px]">--}}
{{--            Copyright © 2023--}}
{{--            <a href="https://readymadeui.com/" target="_blank" class="hover:underline mx-1">ReadymadeUI</a>--}}
{{--            All Rights Reserved.--}}
{{--        </p>--}}
{{--    </div>--}}
{{--</footer>--}}


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

{{--        <div class="flex flex-wrap text-left border-x border-white/10 container w-full max-w-screen-md">--}}
{{--            <h2 class="w-full p-4">Iratkozz fel a hírlevelünkre!</h2>--}}
{{--            <div class="w-full py-3">A bizalmadért cserébe küldünk egy letölthető, ingyenes meditációt!</div>--}}
{{--            <div class="w-full py-3">--}}
{{--                <x-input-label for="email" :value="__('Email')" />--}}
{{--                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />--}}
{{--                <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--                <x-primary-button>Feliratkozom!</x-primary-button>--}}
{{--            </div>--}}
{{--            <div class="w-full py-3"></div>--}}
{{--        </div>--}}
        <div class="col-span-2">
            <h4 class="font-semibold text-lg mb-6">Hírlevél</h4>
            <p class="text-gray-300 mb-4 text-[15px]">
                Iratkozz fel a hírlevelünkre!
            </p>

{{--            <form class="mb-4">--}}
{{--                <div class="flex items-center">--}}

{{--                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />--}}
{{--                    <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--                    <x-primary-button>Feliratkozom!</x-primary-button>--}}
{{--                </div>--}}
{{--            </form>--}}

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

        <div>
            <h4 class="font-semibold text-lg mb-6">Legal</h4>
            <ul class="space-y-5">
                <li><x-nav-link href="/privacy" :active="request()->is('privacy')">Adatkezelési Tájékoztató</x-nav-link></li>
                <li><x-nav-link href="/claim" :active="request()->is('claim')">Jogi Nyilatkozat</x-nav-link></li>
                <li><x-nav-link href="/terms" :active="request()->is('terms')">Általános Szerződési Feltételek</x-nav-link></li>
            </ul>
        </div>

        <div class="flex items-center lg:justify-center">
            <a href="/">
                <x-application-logo class="h-20 w-20"/>
            </a>
        </div>
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
