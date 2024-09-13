@props(["product", "relatedProducts"])
<x-app-layout>
    <section class="relative">
        <div class="w-full mx-auto px-4 sm:px-6 lg:px-0">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 mx-auto max-md:px-2 ">
                <div class="img rounded-xl">
                    <div class="img-box h-full max-lg:mx-auto rounded-lg overflow-hidden">
                        <x-product.image :$product />
                    </div>
                </div>
                <div class="data w-full lg:pr-8 pr-0 xl:justify-start justify-center flex items-center max-lg:pb-10 xl:my-2 lg:my-5 my-0">
                    <div class="data w-full max-w-2xl">
                        <x-product.breadcrumb :$product />
                        <h2 class="font-bold text-3xl leading-10 mb-2 capitalize text-white">
                            {{ $product->name }}
                        </h2>
                        <div class="flex flex-col sm:flex-row sm:items-center mb-6">
                            <h6
                                class="font-manrope font-semibold text-2xl leading-9  pr-5 text-white">
                                {{ $product->price }} FT</h6>
                        </div>
                        <p class="text-base font-normal mb-5">
                            {{ $product->description }}
                        </p>

                        <x-product.add-to-cart-button :$product />
                    </div>
                </div>
            </div>
            <div class="mt-20 border-t border-t-gray-600">
                <h1 class="text-2xl my-10 text-white">Kapcsolodó Termékek</h1>
                <div class="grid grid-cols-1 lg:grid-cols-4 mx-auto gap-10">
                    @foreach($relatedProducts as $currentProduct)
                        <x-product.card :product="$currentProduct" />
                    @endforeach
                </div>
            </div>
        </div>
    </section>

</x-app-layout>
