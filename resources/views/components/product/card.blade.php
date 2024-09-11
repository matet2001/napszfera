@props(['product'])

<div class="relative mx-auto flex w-full max-w-sm flex-col overflow-hidden rounded-lg border border-gray-300 bg-white/10 shadow-md p-4">
    <!-- Product Image -->
    <a class="relative mx-auto flex aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-xl" href="/termekek/{{ $product->id }}">
        <x-product.image :$product />
    </a>

    <!-- Product Details -->
    <div class="flex flex-col h-full mt-4">
        <!-- Section 1: Product Name -->
        <div class="flex-grow flex items-center justify-center mb-2">
            <a href="/termekek/{{ $product->id }}" class="w-full text-center">
                <h5 class="text-lg sm:text-xl leading-8 capitalize text-white font-semibold">{{ $product->name }}</h5>
            </a>
        </div>

        <!-- Section 2: Product Type and Price -->
        <div class="flex-grow flex flex-col items-center justify-center mb-2">
            <p class="text-gray-400 text-sm">{{ $product->type }}</p>
            <span class="text-md sm:text-lg font-bold text-white mt-1">{{ $product->price }} FT</span>
        </div>

        <!-- Section 3: Add to Cart Button -->
        <div class="flex-none flex items-center justify-center">
            <x-product.add-to-cart-button :$product />
        </div>
    </div>
</div>
