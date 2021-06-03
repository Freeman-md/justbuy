<?php

namespace App\Http\Livewire\Admin\DataTables;

use App\Models\Brand;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class Brands extends LivewireDatatable
{
    public $model = Brand::class;

    public function builder() {
        return Brand::query()->latest();
    }

    function columns()
    {
    	return [
            Column::checkbox()->excludeFromExport(),
    		Column::name('name')->label('Name')->filterable()->searchable()->editable(),
    		DateColumn::name('created_at')->label('Created At')->filterable(),
            Column::delete()->label('Delete')->alignRight()
    	];
    }
    public function delete($id) {
        Brand::destroy($id);

        $this->emit('success', 'Brand deleted');
    }
}