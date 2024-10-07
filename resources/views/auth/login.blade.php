<style>
    .password-toggle-icon {
        cursor: pointer;
    }

</style>

@vite('resources/js/password-eye.js')

<x-layouts.guest>
    <div class="flex min-h-full flex-col justify-center px-6  lg:px-8">
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <a href="/" class="flex items-center justify-center">
                <x-application-logo class="h-20 w-20"/>
            </a>
            <h2 class="mt-10 text-center text-3xl font-bold leading-9 tracking-tight">Jelentkezz be a profilodba</h2>
            <form class="space-y-6" action="/login" method="POST">
                @csrf

                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

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

                <div class="mt-6">
                    <button type="submit" class="flex w-full justify-center rounded-md bg-primary px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Bejelentkezés
                    </button>
                </div>
            </form>

        <p class="mt-10 text-center text-sm">
                Nincs még profilod?
                <a href="/register" class="font-semibold leading-6 hover:text-primary">Regisztrálj!</a>
            </p>
        </div>
    </div>
</x-layouts.guest>
