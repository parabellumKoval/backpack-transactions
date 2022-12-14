<?php

namespace Backpack\Transactions\app\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;

use Illuminate\Http\Request;
use App\Rules\EquallyPassword;
use Backpack\Transactions\app\Models\Transaction;

class TransactionController extends BaseController
{
    public function index(Request $request) {
      $per_page = config('backpack.transactions.per_page', 12);

      $transaction = Transaction::pagination($per_page);

      return response()->json($transaction);
    }

    public function createTransaction(Request $request) {
      $transaction = new Transaction;

      $transaction->type = $request->input('transaction_type');
      $transaction->is_completed = 0;
      $transaction->change = $transaction->type == 'withdraw'? 0 - $request->input('transaction_change') : $request->input('transaction_change');
      $transaction->usermeta_id = \Auth::user()->usermeta->id;
      $transaction->description = 'Withdraw method: ' . $request->input('transaction_method') . "\r\n"
                                 .'Requisite: ' . $request->input('transaction_requisites');

      $transaction->save();

      return back()->with('type', 'success')->with('message', 'Your withdrawal request successfully sent!');
    }
}
