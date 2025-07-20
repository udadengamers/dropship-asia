<?php

namespace App\View\Components\Seller;

use Illuminate\View\Component;
use App\Models\Category;

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
        $data ['categories'] = Category::limit(10)->get();

        return view('components.seller.auth-layout', $data);
    }
}
