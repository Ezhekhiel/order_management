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
        Schema::create('dc__balance_order', function (Blueprint $table) {
            $table->id();
            $table->string('buymonth',55);
            $table->string('acc',55);
            $table->string('cell',5);
            $table->string('style',25);
            $table->string('g',5);
            $table->string('wide',5);
            $table->string('po',15);
            $table->date('xfd');
            $table->integer('qty');
            $table->integer('size_1')->default(0);
            $table->integer('size_2')->default(0);
            $table->integer('size_3')->default(0);
            $table->integer('size_4')->default(0);
            $table->integer('size_5')->default(0);
            $table->integer('size_6')->default(0);
            $table->integer('size_7')->default(0);
            $table->integer('size_8')->default(0);
            $table->integer('size_9')->default(0);
            $table->integer('size_10')->default(0);
            $table->integer('size_11')->default(0);
            $table->integer('size_12')->default(0);
            $table->integer('size_13')->default(0);
            $table->integer('size_14')->default(0);
            $table->integer('size_15')->default(0);
            $table->integer('size_16')->default(0);
            $table->integer('size_17')->default(0);
            $table->integer('size_18')->default(0);
            $table->integer('size_19')->default(0);
            $table->integer('size_20')->default(0);
            $table->integer('size_21')->default(0);
            $table->integer('size_22')->default(0);
            $table->integer('size_23')->default(0);
            $table->integer('size_24')->default(0);
            $table->integer('size_25')->default(0);
            $table->integer('size_26')->default(0);
            $table->integer('size_27')->default(0);
            $table->integer('size_28')->default(0);
            $table->integer('size_29')->default(0);
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
        Schema::dropIfExists('dc__balance_order');
    }
};
