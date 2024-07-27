@php use Barryvdh\Debugbar\Twig\Extension\Debug;use Illuminate\Support\Facades\Log; @endphp
@props(['cart'])
<!-- Slide-over panel container -->
<div id="slide-over-panel" class="relative z-10 hidden" aria-labelledby="slide-over-title" role="dialog"
     aria-modal="true">
    <!-- Background backdrop -->
    <div id="background-overlay" class="fixed inset-0 bg-gray-500 transition-opacity duration-500 ease-in-out opacity-0"
         aria-hidden="true"></div>

    <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                <div id="slide-over-content"
                     class="pointer-events-auto w-screen max-w-md transform transition-transform duration-500 ease-in-out translate-x-full">
                    <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                        <div class="flex-1 overflow-y-auto px-4 py-6 sm:px-6">
                            <div class="flex items-start justify-between">
                                <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Bevásárló Kosár</h2>
                                <div class="ml-3 flex h-7 items-center">
                                    <button id="close-panel" type="button"
                                            class="relative -m-2 p-2 text-gray-400 hover:text-gray-500">
                                        <span class="absolute -inset-0.5"></span>
                                        <span class="sr-only">Close panel</span>
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                             stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <!-- Shopping cart content -->
                            <div class="mt-8">
                                <div class="flow-root">
                                    @if($cart && $cart->items->count() > 0)
                                        <ul role="list" class="-my-6 divide-y divide-gray-200">
                                            @foreach($cart->items as $item)
                                                <x-cart.cart-side-menu-product :item="$item"/>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>A kosarad üres.</p>
                                    @endif
                                </div>
                            </div>


                        </div>
                        <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
                            <div class="flex justify-between text-base font-medium text-gray-900">
                                @php
                                    $sum = 0;
                                    foreach ($cart->items as $item) {
                                        $sum += $item->price;
                                    }
                                @endphp
                                <p>Összeg: </p>
                                <p>{{ $sum }} FT</p>
                            </div>
                            <p class="mt-0.5 text-sm text-gray-500">Kedvezmények és adók számítása a fizetésnél</p>
                            <div class="mt-6">
                                <a href="#"
                                   class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Fizetés</a>
                            </div>
                            <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
                                <p>
                                    vagy
                                    <button type="button" class="font-medium text-indigo-600 hover:text-indigo-500">
                                        Folytatom a vásárlást
                                        <span aria-hidden="true"> &rarr;</span>
                                    </button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for toggling the panel -->
    <script>
        document.getElementById('open-panel').addEventListener('click', function () {
            const panel = document.getElementById('slide-over-panel');
            const content = document.getElementById('slide-over-content');
            const overlay = document.getElementById('background-overlay');

            panel.classList.remove('hidden');
            setTimeout(function () {
                content.classList.remove('translate-x-full');
                content.classList.add('translate-x-0');
                overlay.classList.remove('opacity-0');
                overlay.classList.add('opacity-75');
            }, 10); // Slight delay to ensure the class removal is recognized
        });

        document.getElementById('close-panel').addEventListener('click', function () {
            const content = document.getElementById('slide-over-content');
            const overlay = document.getElementById('background-overlay');

            content.classList.remove('translate-x-0');
            content.classList.add('translate-x-full');
            overlay.classList.remove('opacity-75');
            overlay.classList.add('opacity-0');
            setTimeout(function () {
                document.getElementById('slide-over-panel').classList.add('hidden');
            }, 500); // Match the duration of the transition
        });
    </script>
</div>
