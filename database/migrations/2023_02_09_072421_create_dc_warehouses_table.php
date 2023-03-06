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
        Schema::create('dc__warehouse', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_balance',55);
            $table->string('size');
            $table->integer('qty');
            $table->string('cell');
            $table->string('komponen');
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
        Schema::dropIfExists('dc__warehouse');
    }
};
