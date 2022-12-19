<?php

namespace Backpack\Transactions;

use Illuminate\Support\Facades\View;

use Backpack\Transactions\app\Observers\TransactionObserver;
use Backpack\Transactions\app\Models\Transaction;


class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const CONFIG_PATH = __DIR__ . '/config/transactions.php';

    public function boot()
    {
        //Transaction::observe(TransactionObserver::class);

        $this->publishes([
            self::CONFIG_PATH => config_path('/backpack/transactions.php'),
        ], 'config');

        $this->loadTranslationsFrom(__DIR__.'/resources/lang', 'transactions');
    
	      // Migrations
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        
        // Routes
        $this->loadRoutesFrom(__DIR__.'/routes/backpack/routes.php');
        $this->loadRoutesFrom(__DIR__.'/routes/api/transactions.php');


        $this->publishes([
          self::CONFIG_PATH => config_path('/backpack/transactions.php'),
        ], 'config');
        
        $this->publishes([
            __DIR__.'/resources/views' => resource_path('views'),
        ], 'views');

        $this->publishes([
            __DIR__.'/database/migrations' => resource_path('database/migrations'),
        ], 'migrations');

        $this->publishes([
            __DIR__.'/routes/backpack/routes.php' => resource_path('/routes/backpack/transactions/routes.php'),
            __DIR__.'/routes/api/transactions.php' => resource_path('/routes/backpack/transactions/api.php'),
        ], 'routes');
        
        // View::composer('*', function ($view) {
        //     $user = \Auth::user();
        //     $transaction = $user? $user->transactions()->where('is_completed', 1)->orderBy('created_at', 'desc')->first(): null;
        //     $balance = $transaction? $transaction->balance: 0;
            
        //     $referrer = Usermeta::where('referral_code', request()->get('ref'))->where('referral_code', '!=', null)->first();
        //     $ref_id = $referrer ? $referrer->id : null;
        //     session()->put('ref_id', $ref_id);

        //     $view->with('user', $user)->with('ref_id', $ref_id)->with('balance', $balance);
        // });
    }

    public function register()
    {
        $this->mergeConfigFrom(
            self::CONFIG_PATH,
            'transactions'
        );

        // $this->app->bind('transactions', function () {
        //     return new Transactions();
        // });
    }
}
