<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class ContactUs extends Component
{

    public function mount() {
        Cart::restore(\Hashids::encode(auth()->id()));
        $this->emit('cartCount', Cart::count());
    }
    
    public function render()
    {
        return view('livewire.contact-us');
    }
}
