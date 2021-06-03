<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use Cart;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Gallery extends Component
{
    use WithPagination;

    public $sortBy, $pageSize, $brands, $brand, $activeBrand, $cartItems = [], $cartIds = [];

    protected $listeners = ['productUpdated'];

    public function mount() {
        $this->sortBy = 'default';
        $this->pageSize = 20;
        $this->brands = Brand::all();
        $this->brand = null;

        Cart::restore(\Hashids::encode(auth()->id()));
        $this->emit('cartCount', Cart::count());

        $this->getCartItems();
    }

    public function updatedBrand() {
        $this->activeBrand = $this->brand;
    }

    public function productUpdated() {
        $this->getCartItems();
        $this->emit('cartUpdated', ['cartItems' => $this->cartItems, 'cartIds' => $this->cartIds]);
    }

    public function getCartItems() {
        $cart = Cart::content();

        $this->cartItems = getCartDetails()['cartItems'];
        $this->cartIds = getCartDetails()['cartIds'];
    }

    public function getProducts() {
        return Product::with('stock', 'brand', 'image')->whereHas('brand', function($query) {
            is_null($this->brand) ?: $query->where('id', Brand::where('slug', $this->brand)->first()->id);
        });
    }

    public function render()
    {
        if ($this->sortBy === 'priceDesc') {
            $products = $this->getProducts()->orderByRaw('((1-discount/100) * price) desc')->paginate($this->pageSize);
        } else if ($this->sortBy === 'price') {
            $products = $this->getProducts()->orderByRaw('(1-discount/100) * price')->paginate($this->pageSize);
        } else if ($this->sortBy === 'inStock') {
            $products = $this->getProducts()->whereHas('stock', function ($query) {
                $query->where('availability', 'In Stock');
            })->paginate($this->pageSize);
        } else if ($this->sortBy === 'outOfStock') {
            $products = $this->getProducts()->whereHas('stock', function ($query) {
                $query->where('availability', 'Out Of Stock');
            })->paginate($this->pageSize);
        } else {
            $products = $this->getProducts()->latest()->paginate($this->pageSize);
        }
        return view('livewire.gallery', compact('products'));
    }
}
