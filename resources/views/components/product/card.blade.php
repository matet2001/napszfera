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
    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4 flex items-center justify-center">
        @csrf
        <button type="submit" class="flex items-center justify-center rounded-md bg-primary px-5 py-2.5 text-center text-sm font-medium hover:bg-accent hover:text-black focus:outline-none focus:ring-4 focus:ring-blue-300 transition-all duration-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            Kosárhoz adom
        </button>
    </form>
</div>
