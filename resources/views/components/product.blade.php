@props(['product'])

<li>
    <article>
        <img class="aspect-square object-cover rounded-xl" src="{{ Vite::asset('resources/images/'.$product->image) }}" alt="{{ __('Photo of :item', ['item' => $product->name]) }}">
        {{-- TODO --}}
        <form style="--button-height: 3rem" action="" method="POST" class="flex justify-center -mt-[calc(var(--button-height)/2)]">
            @csrf
            <button class="bg-white flex gap-2 items-center hover:border-red hover:text-red border font-medium border-rose-500 rounded-full px-8 h-(--button-height)" type="submit">
                <x-icons.add-to-cart />
                <span>{{ __('Add to Cart') }}</span>
            </button>
        </form>
        <p class="mt-4 text-rose-500">{{ $product->category }}</p>
        <h2 class=" text-lg font-medium">{{ $product->name }}</h2>
        <p class="font-medium text-red">{{ $product->formatted_price }}</p>
    </article>
</li>
