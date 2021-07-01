<?php

namespace App\View\Components\Admin\Form;

use Illuminate\View\Component;

class Input extends Component
{
    public $name;
    public $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $type = 'text')
    {
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.form.input');
    }
}
