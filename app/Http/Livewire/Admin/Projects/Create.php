<?php

namespace App\Http\Livewire\Admin\Projects;

use App\Models\Project;
use Livewire\Component;

class Create extends Component
{

    public $state = [
        'title' => '',
        'description' => '',
        'github' => '',
        'live' => '',
        'star' => false,
        'stacks' => ''
    ];

    protected $rules = [
        'state.title' => 'required|string|min:2',
        'state.description' => 'string|max:100',
        'state.github' => 'required|url',
        'state.live' => 'url',
        'state.stacks' => 'required|string'
    ];

    protected $validationAttributes = [
        'state.title' => 'title',
        'state.description' => 'description',
        'state.github' => 'github',
        'state.live' => 'live',
        'state.star' => 'star',
        'state.stacks' => 'stacks',
    ];

    public function create() {
        $this->validate();

        Project::create([
            'title' => $this->state['title'],
            'description' => $this->state['description'],
            'github' => $this->state['github'],
            'live' => $this->state['live'],
            'star' => $this->state['star'],
            'stacks' => $this->state['stacks'],
        ]);

        $this->emit('created');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.projects.create');
    }
}
