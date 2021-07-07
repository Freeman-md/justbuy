<?php

namespace App\Http\Livewire\Admin\DataTables;

use App\Models\Project;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class Projects extends LivewireDatatable
{

    public $model = Project::class;

    public function builder()
    {
        return Project::query()->latest();
    }

    public function columns()
    {
        return [
            Column::checkbox()->excludeFromExport(),
    		Column::name('title')->label('Title')->filterable()->searchable()->editable(),
            Column::name('description')->label('Description')->filterable()->searchable()->editable(),
            Column::name('github')->label('Github URL')->filterable()->searchable()->editable(),
            Column::name('live')->label('Live URL')->filterable()->searchable()->editable(),
            Column::name('stacks')->label('Tech Stacks')->filterable()->searchable()->editable(),
            BooleanColumn::name('star')->label('Starred')->editable(),
    		DateColumn::name('created_at')->label('Created At')->filterable()->editable(),
            Column::callback(['github', 'live'], function ($github, $live) {
                return view('livewire.admin.data-tables.actions.projects', compact('github', 'live'));
            })->label('Actions')->excludeFromExport(),
            Column::delete()->label('Delete')->alignRight()
        ];
    }

    public function delete($id) {
        Project::destroy($id);

        $this->emit('success', 'Project deleted');
    }
}