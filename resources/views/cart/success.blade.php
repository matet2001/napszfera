<x-app-layout>
    <div class="flex flex-col items-center justify-center" style="height: 50vh;">
        <div class="max-w-md w-full p-8 rounded-lg shadow-md border border-white">
            <h1 class="text-3xl font-semibold text-green-600 text-center">Fizetés Sikeres</h1>
            <p class="text-center mt-4">
                <strong>Köszönjük a vásárlást!</strong> A tranzakció sikeresen lezajlott, és a kosarad kiürült.
                <br>
                <br>
                Visszaigazoló emailt, és számlát küldtünk ki az email címedre.
            </p>
            <a href="{{ route('inventory.index') }}" class="sm:mt-6 block w-full rounded-md text-white bg-primary px-5 py-2.5 text-center text-sm font-medium hover:bg-accent hover:text-black focus:outline-none focus:ring-4 focus:ring-blue-300 transition-all duration-500">
                Termékeim
            </a>

            <a href="{{ route('product.index') }}" class="sm:mt-6 block w-full rounded-md text-white bg-primary px-5 py-2.5 text-center text-sm font-medium hover:bg-accent hover:text-black focus:outline-none focus:ring-4 focus:ring-blue-300 transition-all duration-500">
                Vásárlás folytatása
            </a>
        </div>
    </div>
</x-app-layout>
