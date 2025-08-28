<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PageHeader extends Component
{
    public $title;
    public $subtitle;
    public $button;
    public $search;

    public function __construct($title, $subtitle = null, $button = null, $search = null)
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->button = $button;
        $this->search = $search;
    }

    public function render()
    {
        return view('components.page-header');
    }
}
