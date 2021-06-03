<?php

namespace App\Http\Livewire\User\Orders;

use Livewire\Component;
use App\Models\Order;

class Index extends Component
{

    public function cancel($id) {
        $orderId = decodeId($id);

        Order::find($orderId)->update([
            'status' => 'Cancelled'
        ]);

        $this->emit('success', 'Order cancelled');
    }

    public function destroy($id) {
        $orderId = decodeId($id);

        Order::destroy($orderId);

        $this->emit('success', 'Order deleted');
    }

    public function render()
    {
        $orders = auth()->user()->orders()->latest()->paginate(5);
        return view('livewire.user.orders.index', compact('orders'));
    }
}
