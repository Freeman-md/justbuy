<?php

namespace App\Http\Livewire\Admin\DataTables;

use App\Models\Order;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class Orders extends LivewireDatatable
{
    public $model = Order::class;

    public function builder() {
        return Order::query()->latest();
    }

    function columns()
    {
    	return [
            Column::checkbox()->excludeFromExport(),
    		Column::name('user.name')->label('Name')->filterable()->searchable(),
            Column::name('user.email')->label('Email Address')->filterable()->searchable(),
            NumberColumn::name('amount')->label('Amount [USD]')->filterable()->searchable()->editable(),
            NumberColumn::name('tax')->label('Tax [USD]')->filterable()->searchable()->editable(),
            NumberColumn::name('total_amount')->label('Total Amount [USD]')->filterable()->searchable()->editable(),
            Column::name('status')->label('Status')->filterable()->searchable(),
    		DateColumn::name('created_at')->label('Created At')->filterable(),
            Column::callback(['id', 'status'], function ($id, $status) {
                return view('livewire.admin.data-tables.actions.orders', compact('id', 'status'));
            })->label('Actions')->excludeFromExport(),
            Column::delete()->label('Delete')->alignRight()
    	];
    }

    public function confirm($id) {
        $orderId = decodeId($id);

        Order::find($orderId)->update([
            'status' => 'Confirmed'
        ]);

        $this->emit('success', 'Order confirmed');
    }

    public function deliver($id) {
        $orderId = decodeId($id);

        Order::find($orderId)->update([
            'status' => 'Delivered'
        ]);

        $this->emit('success', 'Order delivered');
    }

    public function delete($id) {
        Order::destroy($id);

        $this->emit('success', 'Order deleted');
    }
}