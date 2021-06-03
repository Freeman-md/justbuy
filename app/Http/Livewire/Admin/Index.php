<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;

class Index extends Component
{

    public function render()
    {

        $data = [
            'users' => User::count(),
            'products' => Product::count(),
            'brands' => Brand::count(),
            'orders' => Order::count()
        ];

        return view('livewire.admin.index', compact('data'));
    }
}
