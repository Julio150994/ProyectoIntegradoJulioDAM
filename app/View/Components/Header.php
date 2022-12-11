<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Header extends Component
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
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        if (auth()->user() != null) {
            $clienteId = auth()->user()->id;
            return view('components.header', compact('clienteId'));
        }
        else {
            return view('components.header');
        }
    }
}
