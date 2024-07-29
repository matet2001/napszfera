@props(["product", "relatedProducts"])
<x-app-layout>
    <section class="relative">
        <div class="w-full mx-auto px-4 sm:px-6 lg:px-0">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 mx-auto max-md:px-2 ">
                <div class="img rounded-xl">
                    <div class="img-box h-full max-lg:mx-auto rounded-lg overflow-hidden">
                        <img src="{{ $product->image }}" alt="Yellow Tropical Printed Shirt image"
                             class="max-lg:mx-auto lg:ml-auto h-full w-full object-cover object-center rounded-lg">
                    </div>
                </div>
                <div class="data w-full lg:pr-8 pr-0 xl:justify-start justify-center flex items-center max-lg:pb-10 xl:my-2 lg:my-5 my-0">
                    <div class="data w-full max-w-xl">
                        <nav aria-label="Breadcrumb">
                            <ol role="list" class="mx-auto flex max-w-2xl items-center space-x-2 lg:max-w-7xl mb-5 text-primary">
                                <li>
                                    <div class="flex items-center">
                                        <a href="/termekek" class="mr-2 text-sm font-medium hover:text-gray-600">Termékek</a>
                                        <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" aria-hidden="true" class="h-5 w-4 text-gray-300">
                                            <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                                        </svg>
                                    </div>
                                </li>
                                <li>
                                    <div class="flex items-center">
                                        @php
                                            switch ($product->type) {
                                                case 'meditation':
                                                $translatedType = 'Meditációk';
                                                $translatedPath = 'meditaciok';
                                                break;
                                            case 'audiobook':
                                                $translatedType = 'Hangoskönyvek';
                                                $translatedPath = 'hangoskonyvek';
                                                break;
                                            case 'lecture':
                                                $translatedType = 'Előadások';
                                                $translatedPath = 'eloadasok';
                                                break;
                                            default:
                                                $translatedType = $product->type;
                                                $translatedPath = 'eloadasok';
                                                break;
                                            }
                                        @endphp
                                        <a href="/termekek/{{ $translatedPath }}" class="mr-2 text-sm font-medium hover:text-gray-600">{{ $translatedType }}</a>
                                        <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" aria-hidden="true" class="h-5 w-4 text-gray-300">
                                            <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                                        </svg>
                                    </div>
                                </li>

                                <li class="text-sm">
                                    <p class="font-medium">{{ $product->name }}</p>
                                </li>
                            </ol>
                        </nav>
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

                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex items-center justify-center gap-3">
                            @csrf
                            <button type="submit" class="text-center w-full px-5 py-4 rounded-[100px] bg-primary flex items-center justify-center font-semibold text-lg text-white shadow-sm transition-all duration-500 hover:bg-accent hover:text-black hover:shadow-indigo-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Kosárhoz adom
                            </button>
                        </form>
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
