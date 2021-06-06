<?php

use App\Models\Product;
use App\Http\Livewire\Cart;
use App\Http\Livewire\Index;
use App\Http\Livewire\AboutUs;
use App\Http\Livewire\Gallery;
use App\Http\Livewire\Checkout;
use App\Http\Livewire\ContactUs;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', Index::class)->name('index');
Route::get('/gallery', Gallery::class)->name('gallery');
Route::get('/about-us', AboutUs::class)->name('about-us');
Route::get('/contact-us', ContactUs::class)->name('contact-us');
Route::get('/cart', Cart::class)->name('cart');
Route::get('/checkout', Checkout::class)->name('checkout')->middleware(['auth', 'hasAddress']);

// Paystack Payment
Route::post('/pay', [PaymentController::class, 'redirectToGateway'])->name('pay');
Route::get('/payment/callback', [PaymentController::class, 'handleGatewayCallback'])->name('confirm-payment');
