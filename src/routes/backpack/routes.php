<?php

Route::group([
    'namespace'  => 'Backpack\Transactions\app\Http\Controllers\Admin',
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
], function () { 
    Route::crud('transaction', 'TransactionCrudController');
}); 

