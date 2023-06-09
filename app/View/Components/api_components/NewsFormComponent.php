<?php

namespace App\View\Components\api_components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NewsFormComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.api_components.news-form-component');
    }
}
