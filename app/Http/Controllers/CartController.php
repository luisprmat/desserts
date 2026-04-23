<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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
}
