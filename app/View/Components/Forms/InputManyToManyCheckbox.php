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
    public string $inputName;

    public function __construct($things, $myThingIds, $inputName)
    {
        $this->things = $things;
        $this->myThingIds = $myThingIds;
        $this->inputName = $inputName;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.input-many-to-many-checkbox');
    }
}
