<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputManyToManyCheckbox extends Component
{
    /**
     * Create a new component instance.
     */
    public $things;
    public $myThingIds;

    public function __construct($things, $myThingIds)
    {
        $this->things = $things;
        $this->myThingIds = $myThingIds;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.input-many-to-many-checkbox');
    }
}
