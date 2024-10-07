@props(["product"])

<x-app-layout>
    <section class="relative">
        <div class="w-full mx-auto px-4 sm:px-6 lg:px-0">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 mx-auto max-md:px-2">

                {{-- Image Section --}}
                <div class="img rounded-xl flex items-start"> <!-- Flex and align to top -->
                    <div class="img-box w-full max-lg:mx-auto rounded-lg overflow-hidden">
                        <x-product.image :product="$product" :isImageStand="$product->getIsImageStand()"/>
                    </div>
                </div>

                {{-- Content Section --}}
                <div class="data w-full lg:pr-8 pr-0 xl:justify-start justify-center flex items-center max-lg:pb-10 xl:my-2 lg:my-5 my-0">
                    <div class="data w-full max-w-2xl">
                        {{-- Breadcrumb --}}
                        <x-product.breadcrumb :$product/>
                        <x-divider />

                        {{-- Product Name --}}
                        <h2 class="font-bold text-3xl leading-10 mb-2 capitalize text-white">
                            {{ $product->name }}
                        </h2>
                        <x-divider />

                        {{-- Duration and Price --}}
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
                        </div>

                        <x-divider />

                        {{-- Audio Player --}}
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
                                <source id="audioSource" src="{{ asset('storage/products/' . $sampleFile->file_path) }}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        @endif

                        <x-divider />

                        {{-- Download Button --}}
                        <div class="mt-4">
                            <a href="{{ route('product.download', $product->id) }}"  class="text-center w-full px-5 py-4 rounded-[100px] bg-primary flex items-center justify-center font-semibold text-lg text-white shadow-sm transition-all duration-500 hover:bg-accent hover:text-black hover:shadow-indigo-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v12m0 0l-3-3m3 3l3-3m-3 3V4m-6 16h12" />
                                </svg>
                                Letöltés
                            </a>

                        </div>

                        {{-- Description --}}
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
        </div>
    </section>
</x-app-layout>
