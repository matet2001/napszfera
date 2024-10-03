@props(['product', 'isImageStand'])

<img src="{{ asset('storage/products/' . $product->getImage()) }}" alt="{{ $product->name }} image"
     class="max-lg:mx-auto lg:ml-auto h-full w-full {{ $isImageStand ? 'object-contain' : 'object-cover' }} object-center rounded-lg">
