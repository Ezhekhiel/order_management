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
        Schema::create('dc__spk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_balance',55);
            $table->char('size',3);
            $table->char('cell',3);
            $table->integer('qty_set');
            $table->char('jam',3);
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
        Schema::dropIfExists('dc__spk');
    }
};
