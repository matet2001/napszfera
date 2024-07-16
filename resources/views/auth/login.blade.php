<x-app-layout>
   <x-user-form>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4 bg-accent" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" >
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Jelszó')" />

                <x-text-input id="password" class="block mt-1 w-full"
                              type="password"
                              name="password"
                              required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm">{{ __('Emlékezz Rám') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <x-underline-link href="{{ route('password.request') }}">
                        {{ __('Elfelejtetted a jelszavad?') }}
                    </x-underline-link>
                @endif

                <x-primary-button class="ms-3" href="{{ route('login') }}">
                    {{ __('Bejelentkezés') }}
                </x-primary-button>
            </div>
        </form>
   </x-user-form>

</x-app-layout>
