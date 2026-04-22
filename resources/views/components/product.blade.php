@props(['product'])

<li>
    <article>
        <img src="{{ Vite::asset('resources/images/'.$product->image) }}" alt="{{ __('Photo of :item', ['item' => $product->name]) }}">
        {{-- TODO --}}
        <form action="" method="POST">
            @csrf
            <button type="submit">{{ __('Add to Cart') }}</button>
        </form>
        <p>{{ $product->category }}</p>
        <h2>{{ $product->name }}</h2>
        <p>{{ $product->formatted_price }}</p>
    </article>
</li>
