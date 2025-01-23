@php use function PHPUnit\Framework\isEmpty; @endphp
@props(["product", "relatedProducts"])
<x-app-layout>
    <section class="relative">
        <div class="w-full mx-auto px-4 sm:px-6 lg:px-0">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 mx-auto max-md:px-2 ">
                <div class="img rounded-xl flex items-start"> <!-- Flex and align to top -->
                    <div class="img-box w-full max-lg:mx-auto rounded-lg overflow-hidden">
                        <x-product.image :product="$product" :isImageStand="true"/>
                    </div>
                </div>
                <div
                    class="data w-full lg:pr-8 pr-0 xl:justify-start justify-center flex items-center max-lg:pb-10 xl:my-2 lg:my-5 my-0">
                    <div class="data w-full max-w-2xl">
                        <x-product.breadcrumb :$product/>
                        <x-divider />
                        <h2 class="font-bold text-3xl leading-10 mb-2 capitalize text-white">
                            {{ $product->name }}
                        </h2>
                        <x-divider />
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
{{--                            <h6 class="font-manrope font-semibold text-xl leading-9 pr-5 text-gray">--}}
{{--                                --}}{{-- Display formatted duration --}}
{{--                                {{ $formattedDuration }}--}}
{{--                            </h6>--}}
                            <h6 class="font-manrope font-semibold text-2xl leading-9 pr-5 text-white">
                                {{ $product->price }} FT
                            </h6>
                        </div>

                        <x-divider />

                        <!-- Audio Player -->
                        @if($sampleFile = $product->getSampleFile())
                            @php
                                // Set the text based on the product type using a switch case
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
                                <source id="audioSource" src="{{  asset('storage/products/' . $sampleFile->file_path) }}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        @endif

                        <x-divider />

                        <x-product.add-to-cart-button :$product/>


                        {{--Description--}}
                        @if($product->description)
                            <div class="mt-10">
                                <h2>Leírás: </h2>
                                <br>
                                <p class="text-white">
                                    {!! nl2br($product->description) !!}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="mt-10 border-t border-t-gray-600">
                <x-related-products :$relatedProducts/>
            </div>
        </div>
    </section>

</x-app-layout>
