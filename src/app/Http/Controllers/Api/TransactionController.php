<?php
namespace Backpack\Transactions\app\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Backpack\Transactions\app\Models\Transaction;
use Backpack\Transactions\app\Http\Resources\TransactionLargeResource;

class TransactionController extends \App\Http\Controllers\Controller
{
    public function index(Request $request) {
      $per_page = request('per_page')? request('per_page'): config('backpack.transactions.per_page', 12);
      
      if(!Auth::guard(config('backpack.transactions.auth_guard', 'profile'))->check()){
        return response()->json('User not authenticated', 401);
      }

      $profile = Auth::guard(config('backpack.transactions.auth_guard', 'profile'))->user();

      $transactions = Transaction::query()
        ->select('ak_transactions.*')
        ->distinct('ak_transactions.id')
        ->where('owner_id', $profile->id)
        ->when(request('transactionable_id'), function($query){
          $query->where('ak_transactions.transactionable_id', request('transactionable_id'));
        })
        ->when(request('transactionable_type'), function($query){
          $query->where('ak_transactions.reviewable_type', request('transactionable_type'));
        })
        ->orderBy('id', 'desc');
      
        
      $transactions = $transactions->paginate($per_page);
      $transactions = TransactionLargeResource::collection($transactions);

      return $transactions;
    }

    public function create(Request $request) {
      if(!Auth::guard(config('backpack.transactions.auth_guard', 'profile'))->check()){
        return response()->json('User not authenticated', 401);
      }

      $data = $request->only(['value', 'currency', 'description', 'type', 'extras', 'transactionable_id', 'transactionable_type']);
      
      //rules
      $validator = Validator::make($data, config('backpack.transactions.rules', [
        'value' => 'required|numeric',
        'currency' => 'nullable|string|min:2|max:3',
        'description' => 'nullable|string|min:2|max:255',
        'type' => 'nullable|string|min:2|max:255',
        'transactionable_id' => 'nullable|integer',
        'transactionable_type' => 'nullable|string|min:2|max:255',
      ]));
  
      if ($validator->fails()) {
        return response()->json($validator->errors(), 400);
      }

      $profile = Auth::guard(config('backpack.transactions.auth_guard', 'profile'))->user();
      
      $transaction = Transaction::create([
        'owner_id' => $profile->id,
        'value' => round($data['value'], 2),
        'currency' => isset($data['currency'])? $data['currency']: config('backpack.transactions.currency', 'USD'),
        'description' => $data['description'],
        'type' => $data['type'],
        'extras' => $data['extras'] ?? ''
      ]);

      return response()->json($transaction);
    }
}
