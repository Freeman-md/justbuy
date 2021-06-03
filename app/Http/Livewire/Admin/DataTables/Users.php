<?php

namespace App\Http\Livewire\Admin\DataTables;

use App\Models\User;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class Users extends LivewireDatatable
{
    public $model = User::class;

    public function builder() {
        return User::query()->latest();
    }

    function columns()
    {
    	return [
            Column::checkbox()->excludeFromExport(),
    		Column::name('name')->label('Name')->filterable()->searchable()->editable(),
    		Column::name('email')->label('Email Address')->truncate()->editable()->filterable()->searchable(),
            Column::name('role')->label('Role')->filterable(['User', 'Admin']),
            BooleanColumn::name('email_verified_at')->label('Verified'),
    		DateColumn::name('created_at')->label('Registration Date')->filterable(),
            Column::callback(['id', 'name', 'role', 'email_verified_at'], function ($id, $name, $role, $verified) {
                return view('livewire.admin.data-tables.actions.users', compact('id', 'name', 'role', 'verified'));
            })->label('Actions')->excludeFromExport(),
            Column::delete()->label('Delete')->alignRight()
    	];
    }

    public function admin($id) {
        $userId = decodeId($id);
        User::find($userId)->update(['role' => 'Admin']);

        $this->emit('success', 'Role changed to admin');
    }

    public function user($id) {
        $userId = decodeId($id);
        User::find($userId)->update(['role' => 'User']);

        $this->emit('success', 'Role changed to user');
    }

    public function verify($id) {
        $userId = decodeId($id);
        User::find($userId)->update(['email_verified_at' => now()]);

        $this->emit('success', 'Email address verified');
    }

    public function disable($id) {
        $userId = decodeId($id);
        User::find($userId)->update(['email_verified_at' => null]);

        $this->emit('success', 'Email address disabled');
    }

    public function delete($id) {
        User::destroy($id);

        $this->emit('success', 'User records deleted');
    }
}