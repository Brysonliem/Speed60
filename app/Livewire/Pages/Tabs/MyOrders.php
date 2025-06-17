<?php

namespace App\Livewire\Pages\Tabs;

use App\Services\TransactionService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MyOrders extends Component
{
    protected TransactionService $transactionService;
    
    public $transactions;

    public $detail_transaction;

    public function boot(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    #should change to repository
    public function showDetail($transactionId)
    {
        $this->detail_transaction = DB::table('transactions as tx')
            ->join('transaction_details as td', 'td.detail_master', '=', 'tx.id')
            ->where('tx.id', $transactionId)
            ->select(
                'tx.id',
                'tx.transaction_number',
                'tx.transaction_status',
                'tx.created_at',
                'tx.grand_total',
                DB::raw('COUNT(td.id) as total_product')
            )
            ->groupBy('tx.id', 'tx.transaction_number', 'tx.transaction_status', 'tx.created_at', 'tx.grand_total')
            ->first();
    }


    public function loadTransactions()
    {
        $this->transactions = $this->transactionService->getTransactionsByUser(Auth::user()->id, 'COMPLETED', true);
    }

    public function mount()
    {
        $this->loadTransactions();
    }

    public function render()
    {
        return view('livewire.pages.tabs.my-orders');
    }
}
