@props(["product", "files"])
@php
    $isMultiple = $files->total() > 1;
    $firstFile = $files->first();
@endphp

<x-app-layout>
    <section class="relative">
        <div class="w-full mx-auto px-4 sm:px-6 lg:px-0">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 mx-auto max-md:px-2">

                {{-- Image Section --}}
                <div class="img rounded-xl">
                    <div class="img-box h-full max-lg:mx-auto rounded-lg overflow-hidden">
                        <x-product.image :$product />
                    </div>
                </div>

                {{-- Content Section --}}
                <div class="data w-full lg:pr-8 pr-0 xl:justify-start justify-center flex flex-col items-start max-lg:pb-10 xl:my-2 lg:my-5 my-0">
                    {{-- Breadcrumb and Title next to image --}}
                    <div class="w-full flex items-start">
                        <x-product.breadcrumb :$product />
                        <h2 class="font-bold text-3xl leading-10 ml-5 capitalize text-white">
                            {{ $product->name }}
                        </h2>
                    </div>

                    {{-- Content below image, centered vertically --}}
                    <div class="w-full max-w-xl flex-1 flex flex-col justify-center mt-4">
                        {{-- File Title and Audio Player --}}
                        <h2 id="fileTitle" class="text-2xl font-bold text-white mb-3">{{ $firstFile->title }}</h2>

                        <audio id="audioPlayer" controls controlsList="nodownload" oncontextmenu="return false;" class="my-3">
                            <source id="audioSource" src="{{ asset($firstFile->file_path ?? $product->file_path) }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>

                        {{-- Pagination at the bottom --}}
                        @if($isMultiple)
                            <div class="pagination mt-5">
                                {{ $files->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var audio = document.getElementById('audioPlayer');
        var audioSource = document.getElementById('audioSource');
        var fileTitle = document.getElementById('fileTitle');

        // Get all files information
        var files = @json($files->items());
        var firstFileId = '{{ $firstFile->id }}';
        var lastListenedKey = 'last_listened_file_' + '{{ $product->id }}';
        var audioPositionKey;

        // Load last listened file if available
        var lastListenedFileId = localStorage.getItem(lastListenedKey) || firstFileId;
        var currentFile = files.find(file => file.id == lastListenedFileId) || files[0]; // Default to first file if not found

        // Update audio source and title
        audioSource.src = '{{ asset('') }}' + currentFile.file_path;
        fileTitle.textContent = currentFile.title;
        audio.load();

        // Set up audio position key based on current file
        audioPositionKey = 'audio_position_' + '{{ $product->id }}' + '_file_' + currentFile.id;

        // Load saved audio position if available
        var savedTime = localStorage.getItem(audioPositionKey);
        if (savedTime !== null) {
            audio.currentTime = savedTime;
        }

        // Save the current time to localStorage on time update
        audio.addEventListener('timeupdate', function() {
            localStorage.setItem(audioPositionKey, audio.currentTime);
        });

        // Save the last listened file and remove position when the file ends
        audio.addEventListener('ended', function() {
            localStorage.removeItem(audioPositionKey);
        });

        // Save the last listened file ID when page unloads
        window.addEventListener('beforeunload', function() {
            localStorage.setItem(lastListenedKey, currentFile.id);
        });
    });
</script>
