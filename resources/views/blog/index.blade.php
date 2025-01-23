@props(['latestPost'])
<x-app-layout>
    <div class="mx-auto border border-white text-center leading-5 px-6 py-6 rounded-xl m-10 container">

        <h2 class="text-xl font-semibold mb-4">Legújabb Bejegyzés</h2>
        <div class="text-left">

            @if ($latestPost)
                <!-- Post Title -->
                <h1 class="text-3xl text-white text-center text-bold">{{ $latestPost->title }}</h1>
                <br>

                <!-- Blog Content Display -->
                <p class="text-base mb-4">
                    {!! nl2br($latestPost->content) !!}
                </p>
            @else
                <p class="text-center">Nincs elérhető poszt</p>
            @endif
        </div>
    </div>
</x-app-layout>
