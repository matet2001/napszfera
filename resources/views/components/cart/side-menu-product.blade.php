@php use Illuminate\Support\Facades\Log; @endphp
@props(['item'])
<li class="flex py-6">
    <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
        <img src="{{ $item->image }}" alt="{{ $item->name }}" class="h-full w-full object-cover object-center">
    </div>

    <div class="ml-4 flex flex-1 flex-col">
        <div>
            <div class="flex justify-between text-base font-medium text-gray-900">
                <h3>
                    <a href="/termekek/{{ $item->product_id }}">{{ $item->name }}</a>
                </h3>
                <p class="ml-4">{{ $item->price }} FT</p>
            </div>
            <p class="mt-1 text-sm text-gray-500">{{ $item->description ?? '' }}</p>
        </div>
        <div class="flex flex-1 items-end justify-between text-sm">
            <div class="flex">
                <form action="{{ route('cart.remove', $item->product_id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="font-medium text-indigo-600 hover:text-indigo-500">Törlés</button>
                </form>
            </div>
        </div>
    </div>
</li>
