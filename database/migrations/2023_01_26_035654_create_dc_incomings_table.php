<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dc__incomings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_balance');
            $table->string('logistic',125);
            $table->date('date');
            $table->char('size',3);
            $table->integer('qty',25);
            $table->string('komponen',55);
            $table->string('cell',25);
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
        Schema::dropIfExists('dc__incomings');
    }
};
