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
        Schema::create('dc__transfer', function (Blueprint $table) {
            $table->id();
            $table->string('cell',10);
            $table->string('po',15);
            $table->char('wide',3);
            $table->smallInteger('jam');
            $table->string('status',25);
            $table->string('serah_terima');
            $table->string('image');
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
        Schema::dropIfExists('dc__transfer');
    }
};
