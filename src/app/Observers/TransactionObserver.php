<?php

namespace Backpack\Transactions\app\Observers;

use Backpack\Transactions\app\Models\Transaction;
use Backpack\Transactions\app\Notifications\WithdrawCompleted;

class TransactionObserver
{
    public function updated(Transaction $transaction) {
      if(!$transaction->is_completed || $transaction->balance !== null)
        return;
        
      $currentBalance = $transaction->usermeta->bonusBalance;
      
      $transaction->balance = $currentBalance + $transaction->change;
      $transaction->created_at = now();
      
      $transaction->save();
      
      if($transaction->type == 'withdraw')
        $transaction->usermeta->notify(new WithdrawCompleted($transaction));
    }
}
