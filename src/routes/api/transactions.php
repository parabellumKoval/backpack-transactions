<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Backpack\Transactions\app\Http\Controllers\Api\TransactionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$guard = config('backpack.transactions.auth_guard', 'profile');

Route::prefix('api/transactions')->controller(TransactionController::class)->group(function () use($guard) {
  
  Route::get('', 'index')->middleware(['api', "auth:${guard}"]);

  Route::post('', 'create');

});