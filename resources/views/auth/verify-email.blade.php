<x-app-layout>
    <div class="h-full w-full flex-grow flex items-center justify-center">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 border border-text bg-white/10 shadow-md overflow-hidden sm:rounded-lg items-center justify-center">

            <div class="mb-4 text-sm text-white">
                {{ __('Köszönjük a regisztrációt! Mielőtt elkezdené, kérjük, erősítse meg e-mail címét az e-mailben található linkre kattintva, amelyet épp most küldtünk Önnek! Ha nem kapta meg az e-mailt, szívesen elküldjük újra.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ __('Új megerősítő linket küldtünk a regisztráció során megadott e-mail címére.') }}
                </div>
            @endif

            <div class="mt-4 flex items-center justify-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <div>
                        <x-primary-button>
                            {{ __('Megerősítő e-mail újraküldése') }}
                        </x-primary-button>
                    </div>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Kijelentkezés') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
