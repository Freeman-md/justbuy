<?php

namespace App\Http\Livewire\User\Includes;

use Livewire\Component;
use Cart;

class Navigation extends Component
{
    public function mount() {
        Cart::restore(\Hashids::encode(auth()->id()));
        $this->emit('cartCount', Cart::count());
    }
    
    public function render()
    {
        return view('livewire.user.includes.navigation');
    }
}
