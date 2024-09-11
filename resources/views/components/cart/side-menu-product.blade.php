@php use Illuminate\Support\Facades\Log; @endphp
@props(['product'])

<li class="flex py-6">
    <!-- Product image container -->
    <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
        <x-product.image :$product />
    </div>

    <div class="ml-4 flex flex-1 flex-col">
        <div class="flex justify-between items-start">
            <!-- Product name and price -->
            <div class="flex flex-col">
                <h3 class="text-black text-base font-medium">
                    <!-- Link to product detail page -->
                    <a href="/termekek/{{ $product->product_id }}">{{ $product->name }}</a>
                </h3>
                <!-- Product description -->
                <p class="mt-1 text-sm text-gray-500">{{ $product->description ?? '' }}</p>
            </div>
        </div>
        <div class="flex items-end justify-between text-sm mt-2">
            <div class="flex">
                <!-- Form to remove product from cart -->
                <form action="{{ route('cart.remove', $product->product_id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <!-- Remove button -->
                    <button type="submit" class="font-medium text-indigo-600 hover:text-indigo-500">Törlés</button>
                </form>
            </div>
            <p class="text-base font-medium text-black">{{ $product->price }} FT</p>
        </div>
    </div>
</li>
