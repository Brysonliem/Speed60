<?php

namespace App\Livewire\Components;

use Livewire\Component;

class DynamicTable extends Component
{

    public $columns;
    public $data;

    public function mount($columns = [], $data = [])
    {
        $this->columns = $columns;
        $this->data = $data;
    }

    public function render()
    {
        return view('livewire.components.dynamic-table');
    }
}
