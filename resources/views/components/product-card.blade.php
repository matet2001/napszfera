@props(['product'])
<div class="relative mx-auto flex w-full max-w-xs flex-col overflow-hidden rounded-lg border border-gray-100 bg-white/10 shadow-md">
    <a class="relative mx-3 mt-3 flex h-60 overflow-hidden rounded-xl" href="/termekek/{{ $product->id }}">
{{--        <img class="object-cover" src="{{ Vite::asset('resources/images/placeholder.jpg') }}" alt="product image" />--}}
        <img class="object-cover" src="{{ $product->image }}" alt="product image" />
    </a>
    <div class="mt-4 px-5 pb-5">
        <a href="/termekek/{{ $product->id }}">
            <h5 class="text-2xl tracking-tight text-center text-white">{{ $product->name }}</h5>
        </a>
        <div class="mt-2 mb-5 items-center text-center">
            <p>
                <span class="text-xl font-bold">{{ $product->price }} FT</span>
            </p>
        </div>
        <a href="#" class="flex items-center justify-center rounded-md bg-primary px-5 py-2.5 text-center text-sm font-medium hover:bg-accent hover:text-black focus:outline-none focus:ring-4 focus:ring-blue-300 transition-all duration-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            Kosárhoz adom</a
        >
    </div>
</div>
