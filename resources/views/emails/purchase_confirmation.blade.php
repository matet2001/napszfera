<div style="text-align: center; background-color: #2D033B; color: #E5B8F4; font-family: 'Roboto Mono', monospace; padding: 20px; border-radius: 5px;">
    {{--    TODO: Add logo when we will have own domain--}}
    <h1 style="color: white; font-size: 24px; margin-bottom: 16px;">Köszönjük a vásárlását!</h1>

    <p style="font-size: 16px; margin-bottom: 8px;">Rendelési szám: {{ $order->id }}</p>
    <p style="font-size: 16px; margin-bottom: 16px;">Teljes összeg: {{ $order->total }} FT</p>

    <h3 style="color: white; font-size: 20px; margin-bottom: 8px;">Megvásárolt termékek:</h3>
    <ul style="list-style: none; padding: 0; margin: 0;">
        @foreach ($order->orderItems as $item)
            <li style="font-size: 16px; margin-bottom: 4px;">{{ $item->product->name }} ({{ $item->price }} FT)</li>
        @endforeach
    </ul>

    <p style="font-size: 16px; margin-top: 20px;">A termékek hozzá lettek adva a felhasználóhoz.</p>

{{--    TODO: Change this to actual url--}}
    <a href="http://napszfera.test/inventory" style="display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px; font-size: 16px;">
        Termékeim
    </a>
</div>
