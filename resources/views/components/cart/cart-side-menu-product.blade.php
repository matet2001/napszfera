@props('product')
<li class="flex py-6">
    <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
        <img class="object-cover" src="{{ $product->image }}" alt="product image" />
    </div>
    <div class="ml-4 flex flex-1 flex-col">
        <div>
            <div class="flex justify-between text-base font-medium text-gray-900">
                <h3>
                    <a href="/termekek/{{ $product->id }}">
                        {{ $product->name }}
                    </a>
                </h3>
                <p class="ml-4">{{ $product->price }} FT</p>
            </div>
            <p class="mt-1 text-sm text-gray-500">Salmon</p>
        </div>
        <div class="flex flex-1 items-end justify-between text-sm">
            <div class="flex">
                <button type="button" class="font-medium text-indigo-600 hover:text-indigo-500">Törlés</button>
            </div>
        </div>
    </div>
</li>
