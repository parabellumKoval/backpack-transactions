<?php

namespace Backpack\Transactions\app\Traits;

trait HasTransactions {

  public function transactions() {
    return $this->hasMany('Backpack\Transactions\app\Models\Transaction', 'owner_id');
  }

  public function getBalanceByType($type) {
    $sum = $this->transactions()->where('type', $type)->orderBy('id', 'DESC')->sum('value');
    return $sum? $sum: 0;
  }

  public function getBalance() {
    $last_transaction = $this->transactions()->orderBy('id', 'DESC')->first();
    return $last_transaction->balance?  $last_transaction->balance: 0;
  }

  public function getDebit() {
    $sum = $this->transactions()->where('value', '>', 0)->sum('value');
    return $sum? $sum: 0;
  }

  public function getCredit() {
    $sum = $this->transactions()->where('value', '<', 0)->sum('value');
    return $sum? $sum: 0;
  }

  public function createTransaction($data, $target_model) {
    $validator = Validator::make($data, [
      'value' => 'required|numeric',
      'currency' => 'nullable|string|min:2|max:3',
      'description' => 'nullable|string|min:2|max:255',
      'type' => 'nullable|string|min:2|max:255',
    ]);
  
    if($validator->fails()) {
      return response()->json($validator->errors(), 400);
    }

    $transaction = Transaction::create([
      'owner_id' => $this->id,
      'value' => round($data['value'], 2),
      'currency' => isset($data['currency'])? $data['currency']: config('backpack.transactions.currency', 'USD'),
      'description' => $data['description'],
      'type' => $data['type']
    ]);

    $target_model->transactions()->save($transaction);

    return response()->json($transaction);
  }
}