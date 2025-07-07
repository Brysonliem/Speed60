<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class TransactionAddressForm extends Form
{
    #[Validate('required|string')]
    public string $first_name = '';

    #[Validate('nullable|string')]
    public ?string $last_name = '';

    #[Validate('required|string')]
    public ?string $address = '';

    #[Validate('required|string')]
    public ?string $province = '';

    #[Validate('required|string')]
    public ?string $city = '';

    #[Validate('required|string')]
    public ?string $postal_code = '';

    #[Validate('required|string')]
    public ?string $email = '';

    #[Validate('required|string')]
    public ?string $phone = '';

    #[Validate('nullable|string')]
    public ?string $description = '';

    #[Validate('numeric')]
    public ?string $transaction_id = '';
}
