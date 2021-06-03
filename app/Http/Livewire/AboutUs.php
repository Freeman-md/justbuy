<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class AboutUs extends Component
{

    public function mount() {
        Cart::restore(\Hashids::encode(auth()->id()));
        $this->emit('cartCount', Cart::count());
    }

    public function render()
    {
        return view('livewire.about-us');
    }
}
