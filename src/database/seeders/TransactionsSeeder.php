<?php

namespace Backpack\Transactions\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

use Backpack\Transactions\app\Models\Transaction;

class TransactionsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $OWNER_MODEL = config('backpack.transactions.owner_model', 'Backpack\Profile\app\Models\Profile');
      $TRANSACTIONABLE_MODEL = config('backpack.transactions.transactionable_model', 'Backpack\Store\app\Models\Product');

      $users_list = $OWNER_MODEL::inRandomOrder()->limit(30)->get();
      $transactionable = $TRANSACTIONABLE_MODEL::inRandomOrder()->first();

      foreach($users_list as $user){
        Transaction::factory()
            ->for($user, 'owner')
            ->for($transactionable, 'transactionable')
            ->count(30)
            ->create();
      }
    }
}
