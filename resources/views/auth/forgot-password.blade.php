<x-layouts.guest>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <a href="/" class="flex items-center justify-center">
                <x-application-logo class="h-20 w-20"/>
            </a>
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight">Elfelejtett Jelszó</h2>
            <p class="my-3 text-gray-400 text-md text-center">
                Add meg e-mail címed, és mi küldünk egy linket a jelszó visszaállításához.
            </p>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-3 w-full" type="email" name="email" :value="old('email')" placeholder="pelda@gmail.com" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-6"> <!-- Added margin-top here -->
                    <button type="submit" class="flex w-full justify-center rounded-md bg-primary px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Jelszó helyreállító link küldése
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.guest>

