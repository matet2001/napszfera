@props(['cart', 'relatedProducts'])
<x-app-layout>
    <div class="p-4 sm:p-10">
        <h1 class="text-2xl sm:text-3xl font-bold mb-6 sm:mb-9">Kosár tartalma</h1>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 sm:gap-8 ">
            <div class="lg:col-span-3">
                <div class="flow-root border-gray-600 border-b border-t py-5 ">
                    @if($cart && $cart->items->count() > 0)
                        <ul role="list" class="-my-4 sm:-my-6 divide-y divide-gray-600">
                            @foreach($cart->items as $product)
                                <x-cart.summary-product :$product/>
                            @endforeach
                        </ul>
                    @else
                        <p>A kosarad üres.</p>
                    @endif
                </div>
            </div>

            <!-- Summary Box -->
            <div class="bg-white/10 p-4 sm:p-6 rounded-lg shadow-lg self-start col-span-1 sm:col-span-2 capitalize">
                <h2 class="text-xl sm:text-2xl font-bold mb-4 text-white">Összegzés</h2>
                @php
                    $sum = 0;
                    foreach ($cart->items as $item) {
                        $sum += $item->price;
                    }
                    $sum = round($sum);
                    $orderTotal = $sum;
                @endphp
                <div class="flex flex-col space-y-4">
                    <div class="flex justify-between items-center border-b border-gray-600 pb-2">
                        <span class="text-lg text-gray-400">Részösszeg</span>
                        <span class="text-lg text-gray-400">{{ $sum }} FT</span>
                    </div>
                    <div class="flex justify-between items-center border-b border-gray-600 pb-2">
                        <span class="text-lg font-bold text-white">Összesen</span>
                        <span class="text-lg font-bold text-white">{{ $orderTotal }} FT</span>
                    </div>
                </div>
                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf

                    @if (!$setting->purchase_enabled)
                        <!-- Display a red notification when purchases are disabled -->
                        <div class="w-full mt-4 px-5 py-4 rounded-md bg-red-500 text-white text-center font-medium text-sm">
                            Vásárlások jelenleg le vannak tiltva
                        </div>
                    @else
                        <button type="submit"
                                class="mt-4 sm:mt-6 block w-full rounded-md px-5 py-2.5 text-center text-sm font-medium transition-all duration-500 focus:outline-none focus:ring-4 focus:ring-blue-300
                {{ !$cart || $cart->items->count() === 0 ? 'bg-background cursor-not-allowed text-gray-600' : 'bg-primary hover:bg-accent hover:text-black' }}"
                                @if(!$cart || $cart->items->count() === 0) disabled @endif>
                            Fizetés
                        </button>
                    @endif
                </form>



            </div>
        </div>

        <!-- You May Also Like Section -->
        <x-related-products :$relatedProducts />
    </div>
</x-app-layout>
