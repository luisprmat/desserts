@props (['cart'])

<div class="flex flex-col gap-8">
    <ul class="mt-2">
        @foreach ($cart->items as $item)
            <li class="flex items-center justify-between gap-4 border-b border-rose-100 py-4">
                <div>
                    <h2 class="font-medium">{{ $item->product->name }}</h2>
                    <div class="mt-1 flex gap-2">
                        <span class="text-red mr-2 font-medium">{{ $item->quantity }}x</span>
                        <span class="text-rose-500">{{ $item->product->formatted_price }}</span>
                        <span class="font-medium text-rose-500">{{ $item->formatted_total }}</span>
                    </div>
                </div>
                <button class="rounded-full border border-rose-400 p-[3px]">
                    <x-icons.delete class="size-3 rounded-full text-rose-400" />
                </button>
            </li>
        @endforeach
    </ul>

    <div class="flex items-center justify-between gap-4">
        <p>{{ __('Order Total') }}</p>
        <p class="text-2xl font-bold">{{ $cart->formattedTotal() }}</p>
    </div>

    <div class="flex items-center justify-center gap-2 rounded-lg bg-rose-50 p-4">
        <x-icons.tree class="text-green size-6" />
        <p>{!! __('This is a :item delivery', [
            'item' => str('<span class="font-bold">'.__('carbon-neutral').'</span>')->toHtmlString()
        ]) !!}</p>
    </div>

    <button class="bg-red rounded-full px-6 py-4 font-medium text-white">{{ __('Confirm Order') }}</button>
</div>
