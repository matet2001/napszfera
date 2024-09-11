@props(["product"])

<form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex items-center justify-center gap-3 mt-4">
    @csrf

    @auth
        @if (auth()->user()->ownsProduct($product->id))
            <!-- If the user owns the product, show the checkmark -->
            <a href="{{ route('inventory.show', $product->id) }}" class="w-full px-5 py-4 rounded-[100px] bg-green-500 flex items-center justify-center font-semibold text-lg text-white shadow-sm transition-all duration-500 hover:bg-green-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                <span>Már Megvan</span>
            </a>
        @else
            <!-- If the user is authenticated but doesn't own the product, show the Add to Cart button -->
            <button type="submit" class="text-center w-full px-5 py-4 rounded-[100px] bg-primary flex items-center justify-center font-semibold text-lg text-white shadow-sm transition-all duration-500 hover:bg-accent hover:text-black hover:shadow-indigo-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Kosárhoz adom
            </button>
        @endif
    @else
        <!-- If the user is not authenticated, redirect them to the login page -->
        <a href="{{ route('login') }}" class="text-center w-full px-5 py-4 rounded-[100px] bg-primary flex items-center justify-center font-semibold text-lg text-white shadow-sm transition-all duration-500 hover:bg-accent hover:text-black hover:shadow-indigo-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            Jelentkezz be a vásárláshoz
        </a>
    @endauth
</form>
