<?php

namespace App\Http\Livewire\User\Orders;

use Livewire\Component;

class Show extends Component
{

    public $order, $modal;

    protected $listeners = ['viewOrder'];

    public function viewOrder($order) {
        $this->order = $order;

        $this->modal = true;
    }

    public function render()
    {
        return view('livewire.user.orders.show');
    }
}
