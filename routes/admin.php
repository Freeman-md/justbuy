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

// Admin Management - Orders
Route::group(['namespace' => '\App\Http\Livewire\Admin\Orders'], function () {
  Route::get('/admin/orders', Index::class)->name('admin-orders');
});

// Admin Management - Projects
Route::group(['namespace' => '\App\Http\Livewire\Admin\Projects'], function () {
  Route::get('/admin/projects', Index::class)->name('admin-projects');
  Route::get('/admin/projects/create', Create::class)->name('admin-projects.create');
});