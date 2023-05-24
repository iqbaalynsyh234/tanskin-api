<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEwalletTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ewallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 8, 2);
            $table->string('description');
            $table->string('status');
            $table->string('ewallet_  type');
            $table->string('xendit_charge_id')->nullable();
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
        Schema::dropIfExists('ewallet_transactions');
    }
}
