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

    public array $transaction_status = [
        ['code' => 'ALL'],
        ['code' => 'PENDING'],
        ['code' => 'PAID'],
        ['code' => 'CANCELLED'],
        ['code' => 'REFUND'],
    ];

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
        if($this->selectedStatusFilter !== 'ALL') {
            $this->transactions = $this->transactionService->getTransactionDetails($this->selectedStatusFilter);
        } else {
            $this->transactions = $this->transactionService->getTransactionDetails(null);
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
