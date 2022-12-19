<?php

namespace Backpack\Transactions\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Backpack\Transactions\app\Models\Transaction;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      return [
        'owner_id' => 1,
        'value' => $this->faker->randomNumber(2, false),
        'balance' => $this->faker->randomNumber(3, false),
        'status' => $this->faker->randomElement(['complited', 'failed']),
        'type' => $this->faker->randomElement(['bonus', 'withdrawal']),
        'description' => $this->faker->paragraph(),
        'transactionable_type' => 'Model',
        'transactionable_id' => 1
      ];
    }

}
