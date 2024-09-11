<x-app-layout>
    <h1 class="text-3xl mb-10 text-center">Termékeim</h1>
{{--    <x-search-field />--}}
    <div>
        <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:max-w-7xl lg:px-8 text-center">
            @if ($inventory && $inventory->items->count())
            <div class="border-t border-gray-600 w-4/5 my-16 mx-auto"> </div>
            <div class="grid grid-cols-1 gap-x-8 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8">
                @foreach ($inventory->items as $inventoryItem)
                    @php
                        $product = $inventoryItem->product
                    @endphp
                    <x-product.inventory-card :$product />
                @endforeach
            </div>
            @else
                <p>No items in your inventory.</p>
            @endif

        </div>
    </div>
</x-app-layout>

