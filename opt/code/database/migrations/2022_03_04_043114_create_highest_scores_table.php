<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHighestScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_highest_scores', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('note_group_index');
            $table->integer('practice_mode');
            $table->integer('practice_mode_index');
            $table->integer('practice_time')->default(0);
            $table->integer('practice_num')->default(0);
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
        Schema::dropIfExists('t_highest_scores');
    }
}
