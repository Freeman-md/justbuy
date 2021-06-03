<?php

use Illuminate\Support\Facades\Route;

// Web based routes for user
Route::get('/admin', App\Http\Livewire\Admin\Index::class)->name('admin');

// Admin Management - Users
Route::group(['namespace' => '\App\Http\Livewire\Admin\Users'], function () {
  Route::get('/admin/users', Index::class)->name('admin-users');
});

// Admin Management - Brands
Route::group(['namespace' => '\App\Http\Livewire\Admin\Brands'], function () {
  Route::get('/admin/brands', Index::class)->name('admin-brands');
});

// Admin Management - Products
Route::group(['namespace' => '\App\Http\Livewire\Admin\Products'], function () {
  Route::get('/admin/products', Index::class)->name('admin-products');
});

// Admin Management - Stocks
Route::group(['namespace' => '\App\Http\Livewire\Admin\Stocks'], function () {
  Route::get('/admin/stocks', Index::class)->name('admin-stocks');
});

// Admin Management - Stocks
Route::group(['namespace' => '\App\Http\Livewire\Admin\Orders'], function () {
  Route::get('/admin/orders', Index::class)->name('admin-orders');
});