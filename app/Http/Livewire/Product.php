<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Product as ProductModel;
use Cart;

class Product extends Component
{

    public $modal, $product, $cartItems = [], $cartIds = [];

    protected $listeners = ['viewProduct', 'cartUpdated'];

    public function hydrated() {
        Cart::store(\Hashids::encode(auth()->id()));
    }

    public function cartUpdated($payload) {
        $this->cartItems = $payload['cartItems'];
        $this->cartIds = $payload['cartIds'];
    }

    public function viewProduct($product) {
        try {
            $this->product = $product;

            $this->product['name'] = ucwords($this->product['name']);

            $this->modal = true;
        } catch (\Throwable $th) {
            $this->emit('error', 'An error has occurred.');
        }
    }

    // Add item to cart
    public function addToCart($productId, $productName, $productPrice) {
        // Decode encoded id to get the correct primary/unique id
        $productId = decodeId($productId);

        $item = ensureProductAvailability($productId);

        if (count($item) > 0) {
            abort(403, 'Product already in cart');
        }

        // Add Item To Cart
        Cart::add($productId, $productName, 1, $productPrice)->associate(ProductModel::class);

        // Store Cart
        Cart::store(\Hashids::encode(auth()->id()));

        // Message
        $this->emit('success', ucwords($productName) . ' added to cart');

        $this->emit('productUpdated');
        $this->emit('cartCount', Cart::count());
    }

    // Update item in cart
    public function updateItem($productId, $action)
    {
        // Decode encoded id to get the correct primary/unique id
        $productId = decodeId($productId);

        if ($action == 'increase') {
            $item = ensureProductAvailability($productId);
        } else if ($action == 'decrease') {
            $item = getCartItem($productId);
        }

        $rowId = $item->values()[0]->rowId;
        $qtyStatus = $qty = $item->values()[0]->qty;

        if (Str::lower($action) == 'increase') {
            Cart::update($rowId, ++$qty);
        } else if (Str::lower($action) == 'decrease') {
            Cart::update($rowId, --$qty);
        } else {
            abort(403, 'Invalid Action');
        }

        // Store Cart
        Cart::store(\Hashids::encode(auth()->id()));

        // Message
        if ($qtyStatus <= 1 && $action == 'decrease') {
            $this->emit('success', 'Product removed from cart');
        } else {
            $this->emit('success', 'Product updated');
        }

        $this->emit('productUpdated');
        $this->emit('cartCount', Cart::count());
    }

    public function render()
    {
        $cart = Cart::content();


        $this->cartItems = getCartDetails()['cartItems'];
        $this->cartIds = getCartDetails()['cartIds'];

        return view('livewire.product');
    }
}
 