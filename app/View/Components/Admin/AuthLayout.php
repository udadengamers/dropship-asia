<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;
use App\Models\Service;

class AuthLayout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $services = Service::where('state', null)->where('owner', 'user')->count();
        return view('components.admin.auth-layout', [
            'count' => $services > 8 ? 9 : $services
        ]);
    }
}
