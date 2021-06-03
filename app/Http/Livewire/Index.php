<?php

namespace App\Http\Livewire;

use Cart;
use App\Models\Product;
use Livewire\Component;

class Index extends Component
{

    public $cartItems = [], $cartIds = [];

    protected $listeners = ['productUpdated'];

    public function mount() {

        Cart::restore(\Hashids::encode(auth()->id()));
        $this->emit('cartCount', Cart::count());

        $this->getCartItems();
    }

    public function productUpdated() {
        $this->getCartItems();
        $this->emit('cartUpdated', [
            'cartItems' => $this->cartItems, 
            'cartIds' => $this->cartIds
        ]);
    }

    public function getCartItems() {
        $cart = Cart::content();

        $this->cartItems = getCartDetails()['cartItems'];
        $this->cartIds = getCartDetails()['cartIds'];
    }

    public function render()
    {
        $cart = Cart::content();


        $cartItems = getCartDetails()['cartItems'];
        $cartIds = getCartDetails()['cartIds'];

        $products = Product::with('stock', 'brand', 'image')->latest()->limit(10)->get();
        $featuredProducts = Product::inRandomOrder()->with('stock', 'brand', 'image')->limit(6)->get();

        $avatars = [];
        try {
            $avatars = getAvatars();
        } catch (\Throwable $th) {
            session()->flash('error', 'An error has occurred');
        }

        return view('livewire.index', compact('products', 'cartItems', 'cartIds', 'featuredProducts', 'avatars'));
    }
}
