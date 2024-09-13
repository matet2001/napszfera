@props(["product"])
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
                    <div class="data w-full max-w-xl">
                        <x-product.breadcrumb :$product />
                        <h2 class="font-bold text-3xl leading-10 mb-2 capitalize text-white">
                            {{ $product->name }}
                        </h2>
                        <p class="text-base font-normal mb-5">
                            {{ $product->description }}
                        </p>

                        <audio id="audioPlayer" controls controlsList="nodownload" oncontextmenu="return false;">
                            <source src="{{ asset($product->file_path) }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>

                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var audio = document.getElementById('audioPlayer');
        var audioKey = 'audio_position_' + '{{ $product->id }}'; // Unique key for each product

        // Load the saved position from localStorage
        var savedTime = localStorage.getItem(audioKey);
        if (savedTime !== null) {
            audio.currentTime = savedTime;
        }

        // Save the current time to localStorage on time update
        audio.addEventListener('timeupdate', function() {
            localStorage.setItem(audioKey, audio.currentTime);
        });

        // Optionally, you can clear the saved position when the audio ends
        audio.addEventListener('ended', function() {
            localStorage.removeItem(audioKey);
        });
    });
</script>
