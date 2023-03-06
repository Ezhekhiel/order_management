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
        Schema::create('daily_balance_percobaans', function (Blueprint $table) {
            $table->id();
            $table->string('cell');
            $table->string('week');
            $table->string('bm');
            $table->string('style');
            $table->string('po');
            $table->string('reg_or_wide');
            $table->string('clr_width');
            $table->string('market');
            $table->string('rta_mat_req');
            $table->string('plan_set_mat');
            $table->string('act_set_mat');
            $table->string('prod_start_assm');
            $table->string('plan_finish');
            $table->string('g');
            $table->string('orig_req_xfd');
            $table->string('orig_cfm_xfd');
            $table->string('qty');
            $table->integer('size_1');
            $table->integer('size_2');
            $table->integer('size_3');
            $table->integer('size_4');
            $table->integer('size_5');
            $table->integer('size_6');
            $table->integer('size_7');
            $table->integer('size_8');
            $table->integer('size_9');
            $table->integer('size_10');
            $table->integer('size_11');
            $table->integer('size_12');
            $table->integer('size_13');
            $table->integer('size_14');
            $table->integer('size_15');
            $table->integer('size_16');
            $table->integer('size_17');
            $table->integer('size_18');
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
        Schema::dropIfExists('daily_balance_percobaans');
    }
};
