<x-app-layout>
    <div class="h-full w-full flex-grow flex items-center justify-center">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 border border-text bg-white/10 shadow-md overflow-hidden sm:rounded-lg items-center justify-center">

            <div class="mb-4 text-sm">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </div>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Jelszó')" />

                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex justify-end mt-4">
                    <x-primary-button>
                        {{ __('Megerősítés') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
