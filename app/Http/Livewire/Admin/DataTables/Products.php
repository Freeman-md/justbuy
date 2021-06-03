<?php

namespace App\Http\Livewire\Admin\DataTables;

use App\Models\Product;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class Products extends LivewireDatatable
{
    public $model = Product::class;

    public function builder() {
        return Product::query()->latest();
    }

    function columns()
    {
    	return [
            Column::checkbox()->excludeFromExport(),
            Column::name('brand.name')->label('Brand')->filterable()->searchable()->editable(),
    		Column::name('name')->label('Name')->filterable()->searchable()->editable(),
            Column::callback(['name', 'image.small'], function($name, $image) {
                return view('livewire.admin.data-tables.includes.image', compact('name', 'image'));
            })->label('Image'),
            Column::name('description')->label('Description')->filterable()->searchable()->editable(),
            NumberColumn::name('price')->label('Price [USD]')->filterable()->searchable()->editable(),
            NumberColumn::name('discount')->label('Discount [%]')->filterable()->searchable()->editable(),
            NumberColumn::name('stock.quantity')->label('Quantity')->filterable()->searchable(),
            NumberColumn::name('stock.availability')->label('Availability')->filterable(['In Stock', 'Out of Stock']),
    		DateColumn::name('created_at')->label('Created At')->filterable(),
            Column::delete()->label('Delete')->alignRight()
    	];
    }
    public function delete($id) {
        Product::destroy($id);

        $this->emit('success', 'Product deleted');
    }
}