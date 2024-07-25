<!-- resources/views/cart/index.blade.php -->

<x-app-layout>
    <div class="container">
        <h1>Your Cart</h1>

        @if(!$cart)
            <p>Your cart does not exist. Please add items to your cart.</p>
        @elseif($cart->items->isEmpty())
            <p>Your cart is empty.</p>
        @else
            <table>
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($cart->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ $item->product->price }}</td>
                        <td>${{ $item->quantity * $item->product->price }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div>
                <h2>Total: ${{ $cart->items->sum(fn($item) => $item->quantity * $item->product->price) }}</h2>
            </div>
        @endif
    </div>
</x-app-layout>
