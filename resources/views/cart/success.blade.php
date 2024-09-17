<x-app-layout>
    <div class="flex flex-col items-center justify-center" style="height: 50vh;">
        <div class="max-w-md w-full p-8 rounded-lg shadow-md bg-white">
            <h1 class="text-3xl font-semibold text-green-600 text-center">Fizetés Sikeres</h1>
            <p class="text-gray-600 text-center mt-4">
                Köszönjük a vásárlást! A tranzakció sikeresen lezajlott, és a kosarad kiürült.
            </p>
            <a href="{{ route('inventory.index') }}" class="mt-6 block w-full text-center bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition">
                Termékeim
            </a>
            <a href="{{ route('product.index') }}" class="mt-6 block w-full text-center bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition">
                Vásárlás folytatása
            </a>
        </div>
    </div>
</x-app-layout>
