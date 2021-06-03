<?php

use Illuminate\Support\Facades\Route;

// Web based routes for user

// User Dashboard
Route::get('/user', App\Http\Livewire\User\Index::class)->name('user');

// User Orders
Route::group(['namespace' => '\App\Http\Livewire\User\Orders'], function () {
  Route::get('/user/orders', Index::class)->name('user-orders');
  // Route::get('/user/orders/{id}', Show::class)->name('user-orders.show');
});