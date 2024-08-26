<x-layouts.guest>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <a href="/" class="flex items-center justify-center">
                <x-application-logo class="h-20 w-20"/>
            </a>
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight">Jelentkezz be a profilodba</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="/login" method="POST">
                <div>
                    <label for="email" class="block text-sm font-medium leading-6">Email cím</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6">Jelszó</label>
                        <div class="text-sm">
                            <a href="/forgot-password" class="font-semibold hover:text-primary">Elfelejtetted a jelszavad?</a>
                        </div>
                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div class="mt-6"> <!-- Added margin-top here -->
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
