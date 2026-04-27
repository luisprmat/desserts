<?php

use App\Http\Controllers\CartController;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('App', [
        'products' => Product::all(),
        'cart' => Cart::ifExists(),
    ]);
});

Route::post('cart/clear', [CartController::class, 'emptyCart'])->name('cart.emptyCart');
Route::post('cart/{product}', [CartController::class, 'addOne'])->name('cart.addOne');
Route::patch('cart/{product}', [CartController::class, 'removeOne'])->name('cart.removeOne');
Route::delete('cart/{cartItem}', [CartController::class, 'removeAll'])->name('cart.removeAll');
