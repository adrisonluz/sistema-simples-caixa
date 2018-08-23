<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaixaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caixa', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('caixa_id')->nullable();
            $table->string('date', 45);
            $table->string('start_hour', 45);
            $table->string('end_hour', 45)->nullable();
            $table->string('opening_balance', 45)->nullable();
            $table->string('end_balance', 45)->nullable();
            $table->string('total_entries', 45)->nullable();
            $table->string('total_outputs', 45)->nullable();
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
        Schema::dropIfExists('caixa');
    }
}
