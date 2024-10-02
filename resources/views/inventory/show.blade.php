@props(["product"])

<x-app-layout>
    <section class="relative">
        <div class="w-full mx-auto px-4 sm:px-6 lg:px-0">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 mx-auto max-md:px-2">

                {{-- Image Section --}}
                <div class="img rounded-xl">
                    <div class="img-box h-full max-lg:mx-auto rounded-lg overflow-hidden">
                        <x-product.image :product="$product" />
                    </div>
                </div>

                {{-- Content Section --}}
                <div class="data w-full lg:pr-8 pr-0 xl:justify-start justify-center flex flex-col items-start max-lg:pb-10 xl:my-2 lg:my-5 my-0">
                    <x-product.breadcrumb :product="$product" />
                    <h2 class="font-bold text-3xl leading-10 capitalize text-white">
                        {{ $product->name }}
                    </h2>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
