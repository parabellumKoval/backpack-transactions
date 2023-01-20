<?php

namespace Backpack\Transactions\app\Observers;

use Backpack\Transactions\app\Models\Transaction;
use Backpack\Transactions\app\Notifications\WithdrawCompleted;

class TransactionObserver
{ 
  public function creating(Transaction $transaction) {
    $last_transaction = Transaction::where('owner_id', $transaction->owner_id)->orderBy('id', 'asc')->first();
    $old_balance = $last_transaction && $last_transaction->balance? $last_transaction->balance: 0;
    $new_balance = $old_balance + $bonus;

    $transaction->balance = $new_balance;
  }


    // public function updated(Transaction $transaction) {
    //   if(!$transaction->is_completed || $transaction->balance !== null)
    //     return;
        
    //   $currentBalance = $transaction->usermeta->bonusBalance;
      
    //   $transaction->balance = $currentBalance + $transaction->change;
    //   $transaction->created_at = now();
      
    //   $transaction->save();
      
    //   if($transaction->type == 'withdraw')
    //     $transaction->usermeta->notify(new WithdrawCompleted($transaction));
    // }
}
