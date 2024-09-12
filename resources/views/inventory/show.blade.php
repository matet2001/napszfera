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
