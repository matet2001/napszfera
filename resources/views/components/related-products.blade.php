@props(['relatedProducts'])
<div class="mt-20">
    @if($relatedProducts->count() > 0)
        <h1 class="text-xl sm:text-2xl my-6 sm:my-10 text-white">Kapcsolódó Termékek</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-10">
            @foreach($relatedProducts as $product)
                <x-product.card :product="$product"/>
            @endforeach
        </div>
    @endif
</div>
