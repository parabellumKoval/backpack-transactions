<?php
namespace Backpack\Transactions\app\Http\Controllers\Api;

use Illuminate\Http\Request;

use Backpack\Transactions\app\Models\Transaction;
use Backpack\Transactions\app\Http\Resources\TransactionLargeResource;

class TransactionController extends \App\Http\Controllers\Controller
{
    public function index(Request $request) {
      $per_page = request('per_page')? request('per_page'): config('backpack.transactions.per_page', 12);
      
      $transactions = Transaction::query()
        ->select('ak_transactions.*')
        ->distinct('ak_transactions.id')
        ->when(request('owner_id'), function($query){
          $query->where('ak_transactions.owner_id', request('owner_id'));
        })
        ->when(request('transactionable_id'), function($query){
          $query->where('ak_transactions.transactionable_id', request('transactionable_id'));
        })
        ->when(request('transactionable_type'), function($query){
          $query->where('ak_transactions.reviewable_type', request('transactionable_type'));
        });
      
        
      $transactions = $transactions->paginate($per_page);
      $transactions = TransactionLargeResource::collection($transactions);

      return $transactions;
    }

    public function create(Request $request) {
      $data = $request->only(['value', 'currency', 'description', 'type', 'transactionable_id', 'transactionable_type']);
      
      $validator = Validator::make($data, [
        'value' => 'required|numeric',
        'currency' => 'nullable|string|min:2|max:3',
        'description' => 'nullable|string|min:2|max:255',
        'type' => 'nullable|string|min:2|max:255',
        'transactionable_id' => 'nullable|integer',
        'transactionable_type' => 'nullable|string|min:2|max:255',
      ]);
  
      if ($validator->fails()) {
        return response()->json($validator->errors(), 400);
      }
      
      $transaction = Transaction::create([
        'value' => round($data['value'], 2),
        'currency' => isset($data['currency'])? $data['currency']: config('backpack.transactions.currency', 'USD'),
        'description' => $data['description'],
        'type' => $data['type']
      ]);

      // $transaction->type = $request->input('transaction_type');
      // $transaction->is_completed = 0;
      // $transaction->change = $transaction->type == 'withdraw'? 0 - $request->input('transaction_change') : $request->input('transaction_change');
      // $transaction->usermeta_id = \Auth::user()->usermeta->id;
      // $transaction->description = 'Withdraw method: ' . $request->input('transaction_method') . "\r\n"
      //                            .'Requisite: ' . $request->input('transaction_requisites');

      return response()->json($transaction);
    }
}
