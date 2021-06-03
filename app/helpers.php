<?php

use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;

// Notify Admin
if (!function_exists('notifyAdmin')) {
  function notifyAdmin($notification) {
      $admins = User::where('role', 'Admin')->get();
      Notification::send($admins, $notification);
  }
}

// Decode the unique secured hashed id of the particular id
if (!function_exists('decodeId')) {
  function decodeId($hashedId) {
    return \Hashids::decode($hashedId)[0];
  }
}

// Check if product is in stock
if (!function_exists('isProductInStock')) {
  function isProductInStock($productId) {
      Product::where('id', $productId)->first()->stock->availability == 'In Stock' ?: abort(403, 'Product is out of stock.');
  }
}

// Get cart item
if (!function_exists('getCartItem')) {
  function getCartItem($productId) {
      return Cart::search(function ($cartItem) use ($productId) {
          return $cartItem->model->id == $productId;
      });
  }
}

// Ensure product has enough quantity for sale
if (!function_exists('hasEnoughQuantity')) {
  function hasEnoughQuantity($productId, $item) {
      $qty = Product::where('id', $productId)->first()->stock_quantity;
      // Check if quantity is available
      if ($item->values()[0]->qty >= $qty) {
          abort(403, 'Not enough quantity for sale.');
      }
  }
}

// Ensure product is available
if (!function_exists('ensureProductAvailability')) {
  function ensureProductAvailability($productId) {
      // Check If Product Is In Stock
      isProductInStock($productId);

      // Get Item In Cart
      $item = getCartItem($productId);

      // Compare Quantity To Ensure Availability
      if (count($item) > 0) {
          hasEnoughQuantity($productId, $item);
      }

      // Make sure quantity in stock is more than 0
      if (Product::where('id', $productId)->first()->stock_quantity <= 0) {
          abort(403, 'Not enough quantity for sale.');
      }

      // if (is_null($item)) {
      //   // Make sure item quantity is less than max quantity - 10
      //   if (maxQuantity($item->values()[0]->rowId)) {
      //       abort(403, 'Maximum quantity is 10.');
      //   }
      // }

      return $item;
  }
}

// Get specific cart details
if (!function_exists('getCartDetails')) {
  function getCartDetails() {
      $cartItems = [];
      $cartIds = [];
      $cart = Cart::content();
      foreach ($cart->values() as $item) {
          array_push($cartItems, [
              'id' => $item->id,
              'qty' => $item->qty,
              'rowId' => $item->rowId
          ]);
          array_push($cartIds, $item->id);
      }
      return [
          'cartItems' => $cartItems,
          'cartIds' => $cartIds
      ];
  }
}

// Check if cart item has reached max quantity - 10
if (!function_exists('maxQuantity')) {
  function maxQuantity($rowId) {
      return Cart::get($rowId)->qty >= 10;
  }
}

// Get images from pexels API
if (!function_exists('getImages')) {
  function getImages() {
    $response = Http::withHeaders([
      'Authorization' => env('PEXELS_API_KEY')
    ])->get('https://api.pexels.com/v1/search?query='.urlencode('fashion').'&per_page=50');

    return $response->json();
  }
}

// Get avatars from pexels API
if (!function_exists('getAvatars')) {
  function getAvatars() {
    $response = Http::withHeaders([
      'Authorization' => env('PEXELS_API_KEY')
    ])->get('https://api.pexels.com/v1/search?query='.urlencode('face').'&per_page=4');

    return $response->json();
  }
}

if (!function_exists('reverseNumberFormat')) {
  function reverseNumberFormat($number) {
    return round(floatval(str_replace(',', '', $number)), 2);
  }
}