@props(["product", "relatedProducts"])
<x-app-layout>
    <section class="relative">
        <div class="w-full mx-auto px-4 sm:px-6 lg:px-0">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 mx-auto max-md:px-2 ">
                <div class="img">
                    <div class="img-box h-full max-lg:mx-auto ">
                        <img src="{{ $product->image }}" alt="Yellow Tropical Printed Shirt image"
                             class="max-lg:mx-auto lg:ml-auto h-full">
                    </div>
                </div>
                <div class="data w-full lg:pr-8 pr-0 xl:justify-start justify-center flex items-center max-lg:pb-10 xl:my-2 lg:my-5 my-0">
                    <div class="data w-full max-w-xl">
                        <nav aria-label="Breadcrumb">
                            <ol role="list" class="mx-auto flex max-w-2xl items-center space-x-2 lg:max-w-7xl mb-5">
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
                        <h2 class="font-bold text-3xl leading-10 mb-2 capitalize">{{ $product->name }}</h2>
                        <div class="flex flex-col sm:flex-row sm:items-center mb-6">
                            <h6
                                class="font-manrope font-semibold text-2xl leading-9  pr-5">
                                {{ $product->price }} FT</h6>
                        </div>
                        <p class="text-base font-normal mb-5">
                            {{ $product->description }}
                        </p>


                        <div class="flex items-center gap-3">
                            <button
                                class="text-center w-full px-5 py-4 rounded-[100px] bg-indigo-600 flex items-center justify-center font-semibold text-lg text-white shadow-sm transition-all duration-500 hover:bg-indigo-700 hover:shadow-indigo-400">
                                Kosárba
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-20 border-t border-t-gray-600">
                <h1 class="text-2xl my-10">Kapcsolodó Termékek</h1>
                <div class="grid grid-cols-1 lg:grid-cols-4 mx-auto gap-10">
                    @foreach($relatedProducts as $currentProduct)
                        <x-product-card :product="$currentProduct" />
                    @endforeach
                </div>
            </div>
        </div>
    </section>

</x-app-layout>
