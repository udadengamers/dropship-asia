<?php

namespace App\View\Components\general;

use Illuminate\View\Component;

class Breadcrumb extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $paths;

    public function __construct($paths)
    {
        $this->paths = $paths;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.general.breadcrumb');
    }
}
