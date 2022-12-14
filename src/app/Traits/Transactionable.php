<?php

namespace Backpack\Transactions\app\Traits;

trait Transactionable {
  public function transactions(){
    return $this->morphOne('Backpack\Transactions\app\Models\Transaction', 'transactionable');
  }
}