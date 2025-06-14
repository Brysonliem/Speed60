<?php

namespace App\Livewire\Pages;

use App\Services\TransactionService;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class IndexTransactions extends Component
{
    protected TransactionService $transactionService;

    public string $selectedStatusFilter = '';

    public array $transactions = [];

    protected $queryString = [
        'selectedStatusFilter' => [
            'except' => '',
            'as' => 'status'
        ]
    ];

    public function boot(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function loadTransactions()
    {
        if($this->selectedStatusFilter) {
            $this->transactions = $this->transactionService->getDetailTransactions($this->selectedStatusFilter);
        } else {
            $this->transactions = $this->transactionService->getDetailTransactions(null);
        }
    }

    public function updatedSelectedStatusFilter()
    {
        $this->loadTransactions();
    }


    public function mount()
    {   
        $this->loadTransactions();
    }

    public function render()
    {
        return view('livewire.pages.index-transactions');
    }
}
