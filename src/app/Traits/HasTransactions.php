<?php

namespace Backpack\Transactions\app\Traits;

trait HasTransactions {
  public function transactions() {
    return $this->hasMany('Backpack\Transactions\app\Models\Transaction', 'owner_id');
  }
}