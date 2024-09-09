@props(['product'])
<div class="relative mx-auto flex w-full max-w-xs flex-col overflow-hidden rounded-lg border border-gray-300 bg-white/10 shadow-md p-4">
    <a class="relative mx-auto flex aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-xl" href="/termekek/{{ $product->id }}">
        <img src="{{ $product->image }}" alt="{{ $product->name }} image" class="h-full w-full object-cover object-center rounded-xl">
    </a>
    <div class="mt-4 flex flex-col sm:flex-row justify-between items-start sm:items-center">
        <div class="flex flex-col text-left">
            <a href="/termekek/{{ $product->id }}">
                <h5 class=" text-lg sm:text-xl leading-8 capitalize text-white">{{ $product->name }}</h5>
            </a>
            <p class="text-gray-400 text-sm">{{ $product->type }}</p>
        </div>
        <div class="flex flex-col items-start sm:items-end">
            <span class="text-md sm:text-lg font-bold text-white">{{ $product->price }} FT</span>
        </div>
    </div>
    <x-product.addToCardButton :$product />
</div>
