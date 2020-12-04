<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletCyclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_cycles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wallet_id')->unique();
            $table->decimal('balance', 8,2)->default(0);
            $table->timestamps();
            $table->foreign('wallet_id')
                ->references('id')->on('wallets')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallet_cycles');
    }
}
