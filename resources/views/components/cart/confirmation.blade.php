@props (['cart'])

<div
    class="m-auto max-h-dvh w-120 max-w-full translate-y-1 rounded-lg bg-white p-8 opacity-0 transition-discrete duration-200 backdrop:bg-black/50 backdrop:opacity-0 backdrop:backdrop-blur-sm backdrop:transition-[opacity,display] open:flex open:translate-y-0 open:flex-col open:gap-6 open:opacity-100 open:backdrop:opacity-100 starting:scale-95 starting:open:opacity-0 starting:open:backdrop:opacity-0"
    popover
    id="order-confirmation"
>
    <x-icons.confirmation class="text-green size-12" />
    <div>
        <h2 class="text-4xl font-bold">{{ __('Order Confirmed!') }}</h2>
        <p class="text-rose-500">{{ __('We hope you enjoy your food!') }}</p>
    </div>
    <div class="rounded-lg bg-rose-50 px-4">
        <ul>
            @foreach ($cart->items as $item)
                <li class="flex items-center justify-between gap-4 border-b border-rose-100 py-4">
                    <div class="flex items-center gap-2">
                        <img
                            src="{{ Vite::asset('resources/images/' . $item->product->image) }}"
                            alt="{{ __('Photo of :item', ['item' => $item->product->name]) }}"
                            class="size-12 rounded-md object-cover"
                        />
                        <div>
                            <h2 class="font-medium">{{ $item->product->name }}</h2>
                            <div class="mt-1 flex gap-2">
                                <span class="text-red mr-2 font-medium">{{ $item->quantity }}x</span>
                                <span class="text-rose-500">{{ $item->product->formatted_price }}</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <span class="text-lg font-medium text-rose-500">{{ $item->formatted_total }}</span>
                    </div>
                </li>
            @endforeach
        </ul>

        <div class="flex items-center justify-between gap-4 py-6">
            <p>{{ __('Order Total') }}</p>
            <p class="text-2xl font-bold">{{ $cart->formattedTotal() }}</p>
        </div>
    </div>

    <form action="{{ route('cart.emptyCart') }}" method="POST">
        @csrf
        <button class="bg-red w-full rounded-full px-6 py-4 font-medium text-white" type="submit">
            {{ __('Start New Order') }}
        </button>
    </form>
</div>
