<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Badge extends Component
{

    public $text, $color;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($color, $text)
    {
        $this->color = $color;
        $this->text = ucfirst($text);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.badge');
    }
}
