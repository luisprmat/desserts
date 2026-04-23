<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;

class CartController extends Controller
{
    public function addOne(Product $product): RedirectResponse
    {
        $cart = Cart::ensureExists();

        $cart->incrementItem($product);

        return back();
    }

    public function removeOne(Product $product): RedirectResponse
    {
        Cart::ifExists()?->decrementItem($product);

        return back();
    }

    public function removeAll(CartItem $cartItem): RedirectResponse
    {
        $cartItem->delete();

        return back();
    }
}
