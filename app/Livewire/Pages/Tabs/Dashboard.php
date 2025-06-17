<?php

namespace App\Livewire\Pages\Tabs;

use App\Services\TransactionService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    protected TransactionService $transactionService;
    
    public $transactions;
    public $total_info = [
        'total_order' => 0,
        'pending_order' => 0,
        'completed_order' => 0  
    ];

    public function boot(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function loadTransactions()
    {
        $this->transactions = $this->transactionService->getTransactionsByUser(Auth::user()->id, 'COMPLETED');
    }

    public function loadTotalOrder()
    {
        $this->total_info['total_order'] = $this->transactionService->countTransactionByUser(Auth::user()->id);
    }

    public function loadPendingOrder()
    {
        $this->total_info['pending_order'] = $this->transactionService->countTransactionByStatusAndUser('PENDING', Auth::user()->id);
    }

    public function loadCompletedOrder()
    {
        $this->total_info['completed_order'] = $this->transactionService->countTransactionByStatusAndUser('COMPLETED', Auth::user()->id);
    }

    public function mount()
    {
        $this->loadTransactions();
        $this->loadTotalOrder();
        $this->loadPendingOrder();
        $this->loadCompletedOrder();
    }

    public function render()
    {
        return view('livewire.pages.tabs.dashboard');
    }
}
