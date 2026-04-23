@props (['cart'])

<aside>
    <div class="rounded-xl bg-white p-6">
        <h2 class="text-red text-2xl font-bold">{{ __('Your Cart') }} ({{ $cart?->totalItemsCount() ?? 0 }})</h2>
        @if ($cart?->totalItemsCount())
            <x-cart.active :$cart />
        @else
            <x-cart.empty />
        @endif
    </div>
</aside>
