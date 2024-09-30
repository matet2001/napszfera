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
                        @php
                            $totalDurationSeconds = $product->totalDuration();

                            // Convert seconds to hours and minutes
                            $hours = floor($totalDurationSeconds / 3600);
                            $minutes = floor(($totalDurationSeconds % 3600) / 60);

                            // Format the duration string
                            $formattedDuration = '';
                            if ($hours > 0) {
                                $formattedDuration .= $hours . ' óra ';
                            }
                            $formattedDuration .= $minutes . ' perc';
                        @endphp

                        <div class="flex flex-col sm:flex-row sm:items-center mb-6">
                            <h6 class="font-manrope font-semibold text-xl leading-9 pr-5 text-gray">
                                {{-- Display formatted duration --}}
                                {{ $formattedDuration }}
                            </h6>
                            <h6 class="font-manrope font-semibold text-2xl leading-9 pr-5 text-white">
                                {{ $product->price }} FT
                            </h6>
                        </div>

                        <p class="text-base font-normal mb-5">
                            {{ $product->description }}
                        </p>

                        @if($product->files()->where('isSample', true)->exists())
                            @php
                                // Retrieve the first file with isSample = true
                                $firstSampleFile = $product->files()->where('isSample', true)->first();
                            @endphp

                                <!-- Audio Player -->
                            @if($firstSampleFile)
                                @php
                                $partText = "";

                                switch ($product->type) {
                                      case "meditation":
                                        $partText = "Részlet a meditációból";
                                        break;
                                      case "lecture":
                                        $partText = "Részlet az előadásból";
                                        break;
                                      case "audiobook":
                                        $partText = "Részlet a hangoskönyvből";
                                        break;
                                      default:
                                        $partText = "Részlet az előadásból";
                                    }
                                @endphp
                                <h2>{{ $partText }}</h2>
                                <audio id="audioPlayer" controls controlsList="nodownload" oncontextmenu="return false;" class="mt-4">
                                    <source id="audioSource" src="{{ asset($firstSampleFile->file_path) }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            @endif
                        @endif

                        <x-product.add-to-cart-button :$product />
                    </div>
                </div>
            </div>
            <div class="mt-10 border-t border-t-gray-600">
                <x-related-products :$relatedProducts />
            </div>
        </div>
    </section>

</x-app-layout>
