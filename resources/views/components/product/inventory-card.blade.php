@props(['product'])
<div class="relative mx-auto flex w-full max-w-xs flex-col overflow-hidden rounded-lg border border-gray-300 bg-white/10 shadow-md p-4">
    <a class="relative mx-auto flex aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-xl" href="/termekeim/{{ $product->id }}">
        <x-product.image :$product />
    </a>
    <div class="mt-4 flex flex-col sm:flex-row justify-between items-start sm:items-center">
        <div class="flex flex-col text-left">
            <a href="/termekeim/{{ $product->id }}">
                <h5 class=" text-lg sm:text-xl leading-8 capitalize text-white">{{ $product->name }}</h5>
            </a>
            <p class="text-gray-400 text-sm">{{ $product->type }}</p>
        </div>
    </div>
    {{--        TODO: Lesson/View button--}}
</div>
