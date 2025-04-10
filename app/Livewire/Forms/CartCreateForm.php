<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CartCreateForm extends Form
{
    public int $quantity;
    public int $product_id;
}
