@props(["title", "productList"])
<x-app-layout>
    <x-search-field></x-search-field>
    <div>
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8 text-center">
            <h1 class="text-xl mb-10">{{ $title }}</h1>

            <div class="grid grid-cols-1 gap-x-8 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8">
                @foreach($productList as $product)
                    <x-product-card :$product />
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>
