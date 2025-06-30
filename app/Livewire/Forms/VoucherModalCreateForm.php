<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class VoucherModalCreateForm extends Form
{
    #[Validate('string|required|email')]
    public string $email = '';

    #[Validate('string|required')]
    public string $first_name = '';

    #[Validate('string|nullable')]
    public string $last_name = '';
    
    #[Validate('string|required')]
    public string $phone = '';
}
