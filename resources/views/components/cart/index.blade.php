@props (['cart'])

<aside>
    <div class="rounded-xl bg-white p-6">
        <h2 class="text-red text-2xl font-bold">{{ __('Your Cart') }} ({{ $cart->totalQuantity() }})</h2>
        @if ($cart->totalQuantity())
            <x-cart.active />
        @else
            <x-cart.empty />
        @endif
    </div>
</aside>
