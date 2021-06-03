<?php

namespace App\Http\Livewire;

use Cart as CartAlias;
use Livewire\Component;
use Illuminate\Support\Str;


class Cart extends Component
{

    public function mount() {
        CartAlias::restore(\Hashids::encode(auth()->id()));
        $this->emit('cartCount', CartAlias::count());
    }

    public function hydrated() {
        CartAlias::store(\Hashids::encode(auth()->id()));
        $this->emit('cartCount', CartAlias::count());
    }

    public function updateItem($rowId, $action) {

        if ($action == 'increase') {
            ensureProductAvailability(CartAlias::get($rowId)->model->id);
        }

        $qty = CartAlias::get($rowId)->qty;
        if (Str::lower($action) == 'increase') {
            CartAlias::update($rowId, ++$qty);
        } else if (Str::lower($action) == 'decrease') {
            CartAlias::update($rowId, --$qty);
        } else {
            abort(403, 'Invalid Action');
        }

        CartAlias::store(\Hashids::encode(auth()->id()));
        $this->emit('cartCount', CartAlias::count());
        $this->emit('success', 'Product updated');
    }

    public function destroy($rowId) {
        $productName = CartAlias::get($rowId)->model->name;
        CartAlias::remove($rowId);

        CartAlias::store(\Hashids::encode(auth()->id()));
        $this->emit('cartCount', CartAlias::count());

        $this->emit('success', 'Product removed from cart');
    }

    public function destroyAll() {
        CartAlias::destroy();

        CartAlias::store(\Hashids::encode(auth()->id()));
        $this->emit('cartCount', CartAlias::count());

        $this->emit('success', 'Cart cleared successfully');
    }

    public function checkout() {
        if (!auth()->check()) {
            return $this->redirect(route('login'));
        }

        // Check if cart is empty
        if (CartAlias::count() <= 0) {
            $this->emit('warning', 'Cart is empty');
            goto end;
        }

        // Ensure all products are available and has enough quantity
        foreach (CartAlias::content() as $item) {
            $product = $item->model;

            // Ensure product is available .i.e. In Stock
            if (!$product->is_in_stock) {
                $this->emit('warning', ucwords($item->name).' is out of stock');
                $this->emit('info', 'Remove product to continue');
                goto end;
            }

            // Ensure cart item quantity is less than or equal to product quantity
            if($item->qty > $product->stock->quantity) {
                $this->emit('warning', 'Insufficient quantity for item: '.ucwords($item->name));                
                goto end;
            }
        }

        // Create Order
        auth()->user()->orders()->create([
            'details' => CartAlias::content(),
            'amount' => reverseNumberFormat(CartAlias::subtotal()),
            'tax' => reverseNumberFormat(CartAlias::tax()),
            'total_amount' => reverseNumberFormat(CartAlias::total()),
        ]);

        return $this->redirect(route('checkout'));

        end: ;
    }

    public function render()
    {
        return view('livewire.cart');
    }
}

// Before Increasing Cart Item - Check if qty is 10 already
// Before Descreasing Cart Item - Check if qty is 0 already
// Before Checking out - Check if qty in cart is less than or equal to qty in stock for every product
