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
      Transaction::factory()
          ->count(10)
          ->create();
    }
}
