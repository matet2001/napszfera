@props(['product'])
<a href="/termekek/{{ $product->id }}" class="group text-center border border-white rounded-lg">
    <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
{{--        <img src="{{ ($product->image) ? $product->image : Vite::asset('resources/images/placeholder.jpg') }}" class="h-full w-full object-cover object-center group-hover:opacity-75" alt="{{ $product->name }}">--}}
        <img src="{{ Vite::asset('resources/images/placeholder.jpg') }}" class="h-full w-full object-cover object-center group-hover:opacity-75" alt="{{ $product->name }}">
    </div>
    <h3 class="mt-4 text-lg text-white">{{ $product->name }}</h3>
    <p class="mt-1 text-md font-medium">{{ $product->price }} FT</p>
</a>
