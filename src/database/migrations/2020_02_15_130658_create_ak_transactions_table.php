<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ak_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('owner_id');
            $table->float('value');
            $table->float('balance')->nullable();
            $table->string('currency', 3)->default('USD');
            $table->string('status', 80)->default('complited');
            $table->string('type', 80)->default('bonus');
            $table->text('description')->nullable();
            $table->json('extras')->nullable();
            $table->morphs('transactionable');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ak_transactions');
    }
}
