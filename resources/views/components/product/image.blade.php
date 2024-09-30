@props(['product'])

<img src="{{ asset($product->image) }}" alt="{{ $product->name }} image"
     class="max-lg:mx-auto lg:ml-auto h-full w-full {{ $product->isImageStand ? 'object-contain' : 'object-cover' }} object-center rounded-lg">
