@props(['product'])
<li class="flex flex-col sm:flex-row py-4">
    <section class="relative w-full">
        <!-- "X" Icon for Deleting the Item -->
        <div class="w-full mx-auto px-2 sm:px-6 lg:px-0">
            <form action="{{ route('cart.remove', $product->id) }}" method="POST"
                  class="absolute right-1 top-1 flex justify-center items-center">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-gray-500 hover:text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </form>
            <div class="grid grid-cols-3 gap-4 sm:gap-8 mx-auto max-md:px-2">
                <div class="img rounded-xl">
                    <div class="img-box aspect-w-1 aspect-h-1 max-lg:mx-auto w-full">
                        <x-product.image :product="$product" :isImageStand="$product->isImageStand"/>
                    </div>
                </div>
                <div
                    class="col-span-2 data w-full sm:pr-4 pr-0 justify-start flex flex-col sm:items-start items-center max-lg:pb-2">
                    <div class="data w-full max-w-xl text-left ml-3">
                        <a href="{{ route('product.show', ['product' => $product->id]) }}">
                            <h2 class="text-lg sm:text-xl leading-8 capitalize text-white">
                                {{ $product->name }}
                            </h2>
                        </a>
                        <x-product.type-paragraph :$product />
                        <div class="flex flex-col sm:flex-row sm:items-center mb-4">
                            <h6 class="text-md sm:text-lg leading-7 pr-5 text-white">
                                {{ $product->price }} FT
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</li>
