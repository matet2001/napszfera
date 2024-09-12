@props(['product'])
<div class="relative mx-auto flex w-full max-w-xs flex-col overflow-hidden rounded-lg border border-gray-300 bg-white/10 shadow-md p-4">
    <a class="relative mx-auto flex aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-xl" href="/termekeim/{{ $product->id }}">
        <x-product.image :$product />
    </a>

    <!-- Product Details -->
    <div class="flex flex-col h-full mt-4">
        <!-- Section 1: Product Name -->
        <div class="flex-grow flex items-center justify-center mb-2">
            <a href="/termekeim/{{ $product->id }}" class="w-full text-center">
                <h5 class="text-lg sm:text-xl leading-8 capitalize text-white font-semibold">{{ $product->name }}</h5>
            </a>
        </div>

        <x-product.type-paragraph :$product/>

        <!-- Section 3: Add to Cart Button -->
        <div class="flex-none flex items-center justify-center mt-6">
            <a href="{{ route('inventory.show', $product->id) }}" class="text-center w-full px-5 py-4 rounded-[100px] bg-primary flex items-center justify-center font-semibold text-lg text-white shadow-sm transition-all duration-500 hover:bg-accent hover:text-black hover:shadow-indigo-400">
                <span>Megtekintés</span>
            </a>
        </div>
    </div>
</div>
