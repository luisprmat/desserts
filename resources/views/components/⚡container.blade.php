<?php

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

new class extends Component
{
    public Collection $products;

    public ?Cart $cart = null;

    public function mount(): void
    {
        $this->products = Product::all();
        $this->cart = Cart::ifExists();
    }

    public function quantity(Product $product): int
    {
        return $this->cart?->quantityOf($product) ?? 0;
    }

    public function addOne(Product $product): void
    {
        $cart = Cart::ensureExists();

        $cart->incrementItem($product);
    }

    public function removeOne(Product $product): void
    {
        Cart::ifExists()?->decrementItem($product);
    }

    public function removeAll(CartItem $cartItem): void
    {
        $cartItem->delete();
    }

    public function emptyCart(): void
    {
        Cart::ifExists()?->items()->delete();
    }
};
?>

<div class="max-w-8xl mx-auto grid gap-8 bg-rose-50 px-4 py-16 sm:px-6 md:grid-cols-[1fr_400px] lg:px-8">
    <main>
        <h1 class="text-5xl font-bold">{{ __('Desserts') }}</h1>
        <ul class="mt-10 grid gap-6 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
            @foreach ($products as $product)
                <li>
                    <article>
                        <img
                            @class ([
                                'aspect-square rounded-xl object-cover',
                                'border-2 border-red' => $this->quantity($product),
                            ])
                            src="{{ Vite::asset('resources/images/' . $product->image) }}"
                            alt="{{ __('Photo of :item', ['item' => $product->name]) }}"
                        />

                        @if ($this->quantity($product))
                            <div
                                class="bg-red mx-auto flex w-48 -translate-y-1/2 items-center justify-center gap-4 rounded-full px-3 py-3 text-white"
                            >
                                <form wire:submit="removeOne({{ $product->id }})">
                                    <button
                                        class="group rounded-full border-2 border-white p-1 hover:bg-white"
                                        type="submit"
                                    >
                                        <svg
                                            class="group-hover:text-red size-2.5 text-white"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 10 2"
                                        >
                                            <path fill="currentColor" d="M0 .375h10v1.25H0V.375Z" />
                                        </svg>
                                    </button>
                                </form>
                                <span class="flex-1 text-center">{{ $this->quantity($product) }}</span>
                                <form wire:submit="addOne({{ $product->id }})">
                                    <button
                                        class="group rounded-full border-2 border-white p-1 hover:bg-white"
                                        type="submit"
                                    >
                                        <svg
                                            class="group-hover:text-red size-2.5 text-white"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 10 10"
                                        >
                                            <path
                                                fill="currentColor"
                                                d="M10 4.375H5.625V0h-1.25v4.375H0v1.25h4.375V10h1.25V5.625H10v-1.25Z"
                                            />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @else
                            <form wire:submit="addOne({{ $product->id }})" class="flex -translate-y-1/2 justify-center">
                                <button
                                    class="hover:border-red hover:text-red flex items-center gap-2 rounded-full border border-rose-500 bg-white px-8 py-3 font-medium"
                                    type="submit"
                                >
                                    <x-icons.add-to-cart />
                                    <span>{{ __('Add to Cart') }}</span>
                                </button>
                            </form>
                        @endif
                        <p class="mt-4 text-rose-500">{{ $product->category }}</p>
                        <h2 class="text-lg font-medium">{{ $product->name }}</h2>
                        <p class="text-red font-medium">{{ $product->formatted_price }}</p>
                    </article>
                </li>
            @endforeach
        </ul>
    </main>
    <aside>
        <div class="rounded-xl bg-white p-6">
            <h2 class="text-red text-2xl font-bold">{{ __('Your Cart') }} ({{ $cart?->totalItemsCount() ?? 0 }})</h2>
            @if ($cart?->totalItemsCount())
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
                                <form wire:submit="removeAll({{ $item->id }})">
                                    <button class="rounded-full border border-rose-400 p-[3px]" type="submit">
                                        <x-icons.delete class="size-3 rounded-full text-rose-400" />
                                    </button>
                                </form>
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

                    <button
                        popovertarget="order-confirmation"
                        class="bg-red hover:bg-red-dark rounded-full px-6 py-4 font-medium text-white transition"
                    >
                        {{ __('Confirm Order') }}
                    </button>

                    <div
                        class="m-auto max-h-[calc(100dvh-2rem)] w-120 max-w-full translate-y-1 rounded-lg bg-white p-8 opacity-0 transition-discrete duration-200 backdrop:bg-black/50 backdrop:opacity-0 backdrop:backdrop-blur-sm backdrop:transition-[opacity,display] open:flex open:translate-y-0 open:flex-col open:gap-6 open:opacity-100 open:backdrop:opacity-100 starting:scale-95 starting:open:opacity-0 starting:open:backdrop:opacity-0"
                        popover
                        id="order-confirmation"
                    >
                        <x-icons.confirmation class="text-green size-12 shrink-0" />
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
                                                    <span class="text-red mr-2 font-medium"
                                                        >{{ $item->quantity }}x</span
                                                    >
                                                    <span
                                                        class="text-rose-500"
                                                        >{{ $item->product->formatted_price }}</span
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <span
                                                class="text-lg font-medium text-rose-500"
                                                >{{ $item->formatted_total }}</span
                                            >
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="flex items-center justify-between gap-4 py-6">
                                <p>{{ __('Order Total') }}</p>
                                <p class="text-2xl font-bold">{{ $cart->formattedTotal() }}</p>
                            </div>
                        </div>

                        <form wire:submit="emptyCart">
                            <button
                                class="bg-red hover:bg-red-dark w-full rounded-full px-6 py-4 font-medium text-white transition"
                                type="submit"
                            >
                                {{ __('Start New Order') }}
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <x-cart.empty />
            @endif
        </div>
    </aside>
</div>
