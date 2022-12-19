<?php

namespace Backpack\Transactions\app\Traits;

use Backpack\Transactions\app\Models\Transaction;

trait Transactionable {
  public function transactions(){
    return $this->morphMany('Backpack\Transactions\app\Models\Transaction', 'transactionable');
  }

  public function createTransaction($data) {
    $validator = Validator::make($data, [
      'owner_id' => 'required|integer',
      'value' => 'required|numeric',
      'currency' => 'nullable|string|min:2|max:3',
      'description' => 'nullable|string|min:2|max:255',
      'type' => 'nullable|string|min:2|max:255',
    ]);
  
    if($validator->fails()) {
      return response()->json($validator->errors(), 400);
    }


    $transaction = Transaction::create([
      'owner_id' => $data['owner_id'],
      'value' => round($data['value'], 2),
      'currency' => isset($data['currency'])? $data['currency']: config('backpack.transactions.currency', 'USD'),
      'description' => $data['description'],
      'type' => $data['type']
    ]);

    $this->transactions()->save($transaction);

    return response()->json($transaction);
  }
}