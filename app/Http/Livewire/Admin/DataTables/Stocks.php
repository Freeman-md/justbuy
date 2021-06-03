<?php

namespace App\Http\Livewire\Admin\DataTables;

use App\Models\Stock;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class Stocks extends LivewireDatatable
{
    public $model = Stock::class;

    public function builder() {
        return Stock::query()->latest();
    }

    function columns()
    {
    	return [
            Column::checkbox()->excludeFromExport(),
    		Column::name('product.name')->label('Product Name')->filterable()->searchable(),
            NumberColumn::name('quantity')->label('Product Quantity')->filterable()->searchable()->editable(),
            NumberColumn::name('availability')->label('Product Availability')->filterable()->searchable(),
    		DateColumn::name('created_at')->label('Created At')->filterable(),
    	];
    }
}