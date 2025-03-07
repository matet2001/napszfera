@vite('resources/js/password-eye.js')
<x-layouts.guest>
    <div class="flex min-h-full flex-col justify-center px-6 lg:px-8">
        <a href="/" class="flex items-center justify-center">
            <x-application-logo class="h-20 w-20"/>
        </a>
        <h2 class="mt-10 text-center text-3xl font-bold leading-9 tracking-tight">Regisztrálj egy új profilt</h2>
        <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-sm"> <!-- Reduced margin-top from mt-10 to mt-6 -->
            <form class="space-y-6" method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Név')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Phone Number -->
                <div>
                    <x-input-label for="phone" :value="__('Telefonszám')" />
                    <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" required autofocus autocomplete="tel" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4 max-w-sm">
                    <x-input-label for="password" :value="__('Jelszó')" />
                    <div class="relative">
                        <x-text-input
                            id="password"
                            class="block w-full rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password" />

                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer password-toggle-icon">
                            <i class="fas fa-eye text-black"></i> <!-- Initial icon -->
                        </span>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

{{--                <!-- Confirm Password -->--}}
{{--                <div class="mt-4">--}}
{{--                    <x-input-label for="password_confirmation" :value="__('Jelszó Megerősítése')" />--}}
{{--                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />--}}
{{--                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />--}}
{{--                </div>--}}

                <!-- Terms and Conditions Checkbox -->
                <div class="flex items-center space-x-2">
                    <input id="checkbox" type="checkbox" class="w-4 h-4 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" required>
                    <label for="checkbox" class="text-sm font-medium">
                        Elolvastam és elfogadom az <a class="text-white" href="/terms">Általános Szerződési Feltételeket</a>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end mt-14" style="margin-top: 3rem;">
                    <button type="submit" class="flex w-full justify-center rounded-md bg-primary px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Regisztráció
                    </button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm">
                Van már profilod?
                <a href="{{ route('login') }}" class="font-semibold leading-6 hover:text-primary">Jelentkezz be!</a>
            </p>
        </div>
    </div>
</x-layouts.guest>
