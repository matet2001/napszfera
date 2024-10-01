<x-app-layout>
    <div class="flex flex-col items-center justify-center" style="height: 50vh;">
        <div class="max-w-md w-full p-8 rounded-lg shadow-md border border-white mt-6 flex flex-col space-y-15">
            <h1 class="text-3xl font-semibold text-red-600 text-center">Fizetés megszakítva</h1>
            <p class="text-center mt-4">
                Úgy tűnik, hogy a fizetés nem fejeződött be. <strong>Nem történt terhelés.</strong>
            </p>

            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <button type="submit" class="sm:mt-6 block w-full rounded-md text-white bg-primary px-5 py-2.5 text-center text-sm font-medium hover:bg-accent hover:text-black focus:outline-none focus:ring-4 focus:ring-blue-300 transition-all duration-500" >
                    Fizetés Újrapróbálása
                </button>
            </form>
            <!-- Continue Shopping Button -->
{{--            <a href="{{ route('product.index') }}" >--}}
{{--                Vásárlás folytatása--}}
{{--            </a>--}}

            <!-- Contact Support Button -->
            <a href="{{ route('contact') }}" class="sm:mt-6 block w-full rounded-md text-white bg-blue-500 px-5 py-2.5 text-center text-sm font-medium hover:bg-blue-200 hover:text-black focus:outline-none focus:ring-4 focus:ring-blue-300 transition-all duration-500">
                Kapcsolatfelvétel
            </a>
        </div>
    </div>
</x-app-layout>
