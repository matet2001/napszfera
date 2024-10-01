<h1>Thank you for your purchase!</h1>

<p>Order Number: {{ $order->id }}</p>
<p>Total Amount: ${{ $order->total }}</p>

<h3>Items Purchased:</h3>
<ul>
    @foreach ($order->orderItems as $item)
        <li>{{ $item->product->name }} ({{ $item->quantity }} x ${{ $item->price }})</li>
    @endforeach
</ul>
