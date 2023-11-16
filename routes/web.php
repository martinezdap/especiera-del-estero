<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\WelcomeController;
use App\Livewire\AddCartItem;
use App\Livewire\ShoppingCart;
use Illuminate\Support\Facades\Route;


Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/shopping-cart', ShoppingCart::class)->name('shopping-cart');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::resource('/product', ProductController::class);
});