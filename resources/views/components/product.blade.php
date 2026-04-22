@props (['product'])

<li>
    <article>
        <img
            class="aspect-square rounded-xl object-cover"
            src="{{ Vite::asset('resources/images/'.$product->image) }}"
            alt="{{ __('Photo of :item', ['item' => $product->name]) }}"
        />
        {{-- TODO --}}
        <form
            style="--button-height: 3rem"
            action=""
            method="POST"
            class="-mt-[calc(var(--button-height)/2)] flex justify-center"
        >
            @csrf
            <button
                class="hover:border-red hover:text-red flex h-(--button-height) items-center gap-2 rounded-full border border-rose-500 bg-white px-8 font-medium"
                type="submit"
            >
                <x-icons.add-to-cart />
                <span>{{ __('Add to Cart') }}</span>
            </button>
        </form>
        <p class="mt-4 text-rose-500">{{ $product->category }}</p>
        <h2 class="text-lg font-medium">{{ $product->name }}</h2>
        <p class="text-red font-medium">{{ $product->formatted_price }}</p>
    </article>
</li>
