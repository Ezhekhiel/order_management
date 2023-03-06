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
        Schema::create('dc__mutasi_spk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_balance',55);
            $table->string('old_cell');
            $table->string('new_cell');
            $table->string('status_approval');
            $table->string('description');
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
        Schema::dropIfExists('dc__mutasi_spk');
    }
};
