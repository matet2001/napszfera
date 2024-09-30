@props(["product", "files", "progress"])

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

                                <form id="progressForm" action="{{ route('file.progress.update', ['product_id' => $product->id, 'file_id' => $firstFile->id]) }}" method="POST" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="last_position" id="lastPositionInput">
                                </form>

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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const audioPlayer = document.getElementById('audioPlayer');

        audioPlayer.currentTime = {{ $progress ? $progress->last_position : 0 }};
        console.log("Javascript on");

        // Event listener for pause or when the user leaves the page
        audioPlayer.addEventListener('pause', function () {
            const lastPosition = Math.floor(audioPlayer.currentTime); // Get the current time in seconds

            // Send an AJAX request to update the last listened position
            fetch('/file-progress/{{ $product->id }}/{{ $firstFile->id }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ 'last_position': lastPosition })
            }).then(response => response.json())
                .then(data => console.log('Request sent', data))
                .catch(error => console.error('Error:', error));

            console.log("Request Send");
        });

        // You could also update the position when the user leaves the page
        window.addEventListener('beforeunload', function () {
            const lastPosition = Math.floor(audioPlayer.currentTime);

            navigator.sendBeacon('/file-progress/{{ $product->id }}/{{ $firstFile->id }}', JSON.stringify({
                _token: '{{ csrf_token() }}',
                last_position: lastPosition
            }));

            console.log("Request Send");
        });
    });
</script>
