@props(['cart'])
<x-app-layout>
    <div class="p-4 sm:p-10">
        <h1 class="text-2xl sm:text-3xl font-bold mb-6 sm:mb-9">Fizetés</h1>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 sm:gap-8 ">
            <div class="lg:col-span-3">
                <div class="border-white">

                </div>
            </div>

            <!-- Summary Box -->
            <div class="bg-white/10 p-4 sm:p-6 rounded-lg shadow-lg self-start col-span-1 sm:col-span-2 capitalize">
                <h2 class="text-xl sm:text-2xl font-bold mb-4 text-white">Összegzés</h2>
                @php
                    $sum = 0;
                    foreach ($cart->items as $item) {
                        $sum += $item->price;
                    }
                    $sum = round($sum);
                    $taxEstimate = round($sum * 0.27); // 27% tax rate
                    $orderTotal = $sum + $taxEstimate;
                @endphp
                <div class="flex flex-col space-y-4">
                    <div class="flex justify-between items-center border-b border-gray-600 pb-2">
                        <span class="text-lg text-gray-400">Részösszeg</span>
                        <span class="text-lg text-gray-400">{{ $sum }} FT</span>
                    </div>
                    <div class="flex justify-between items-center border-b border-gray-600 pb-2">
                        <span class="text-lg text-gray-400">Adó becslés</span>
                        <span class="text-lg text-gray-400">{{ $taxEstimate }} FT</span>
                    </div>
                    <div class="flex justify-between items-center border-b border-gray-600 pb-2">
                        <span class="text-lg font-bold text-white">Összesen</span>
                        <span class="text-lg font-bold text-white">{{ $orderTotal }} FT</span>
                    </div>
                </div>
                <a href="{{ route('cart.checkout') }}" class="mt-4 sm:mt-6 block w-full rounded-md bg-primary px-5 py-2.5 text-center text-sm font-medium hover:bg-accent hover:text-black focus:outline-none focus:ring-4 focus:ring-blue-300 transition-all duration-500">
                    Fizetés
                </a>
            </div>


            <form action="/create-checkout-session" method="POST">
                <button type="submit">Checkout</button>
            </form>

            <form action="{{ route('stripe.payment') }}" method="post" id="payment-form">
                @csrf
                <div id="card-element">
                    <!-- Stripe Elements will be inserted here -->
                </div>
                <button type="submit" id="submit">Pay</button>
            </form>

            <script src="https://js.stripe.com/v3/"></script>

        </div>
    </div>
</x-app-layout>

<script>
    const stripe = Stripe('{{ env('STRIPE_KEY') }}');
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');

    const form = document.getElementById('payment-form');
    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const {paymentMethod, error} = await stripe.createPaymentMethod('card', cardElement);

        if (error) {
            console.error(error);
        } else {
            // Submit the form with the payment method ID
            const hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'paymentMethod');
            hiddenInput.setAttribute('value', paymentMethod.id);
            form.appendChild(hiddenInput);
            form.submit();
        }
    });
</script>
