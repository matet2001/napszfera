@props(["product", "files"])

@php
    $firstFile = $files->first();  // Get the first file from the paginated files
@endphp

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
                @if($firstFile)
                    <div class="data w-full lg:pr-8 pr-0 xl:justify-start justify-center flex flex-col items-start max-lg:pb-10 xl:my-2 lg:my-5 my-0">

                        <x-product.breadcrumb :product="$product" />
                        <h2 class="font-bold text-3xl leading-10 capitalize text-white">
                            {{ $product->name }}
                        </h2>


                        <div class="w-full max-w-lg flex flex-col justify-center mt-20">
                            <div class="border border-transparent bg-accent rounded-3xl flex flex-col items-center justify-center p-5">
{{--                                @if($product->isMultiple)--}}
                                    <h2 id="fileTitle" class="text-2xl font-bold mb-2 text-black text-center">{{ $firstFile->title }}</h2>
{{--                                @endif--}}

                                <audio id="audioPlayer" controls controlsList="nodownload" oncontextmenu="return false;" class="mt-4">
                                    <source id="audioSource" src="{{ asset($firstFile->file_path) }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            </div>

                            <div class="pagination mt-5">
                                {{ $files->links() }}
                            </div>
                        </div>
                    </div>
                @else
                    <p>Nincs elérthető hang fájl ehez a termékhez.</p>
                @endif
            </div>
        </div>
    </section>
</x-app-layout>
