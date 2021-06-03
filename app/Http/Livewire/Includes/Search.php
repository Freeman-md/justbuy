<?php

namespace App\Http\Livewire\Includes;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;

class Search extends Component
{
    public $search = '';

    public function updatedSearch($value) {
        $this->search = trim(Str::lower($value));
    }

    public function render()
    {
        $searchResults = [];

        if (strlen($this->search) > 0) {
            $searchResults = Product::where('name', 'like', '%'.$this->search.'%')->with('stock', 'brand', 'image')->limit(6)->get();
        }

        return view('livewire.includes.search', compact('searchResults'));
    }
}
