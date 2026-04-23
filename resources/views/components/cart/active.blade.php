@props (['cart'])

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
            <button class="rounded-full border border-rose-500 p-0.5">
                <x-icons.delete class="size-2.5 rounded-full text-rose-500" />
            </button>
        </li>
    @endforeach
</ul>
