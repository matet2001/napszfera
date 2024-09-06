<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold">Your Inventory</h1>

        @if ($inventory && $inventory->items->count())
            <ul>
                @foreach ($inventory->items as $item)
                    <li class="flex items-center justify-between py-2">
                        <span>{{ $item->product->name }}</span>
                        <span>{{ $item->product->price }} HUF</span>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No items in your inventory.</p>
        @endif
    </div>
</x-app-layout>

