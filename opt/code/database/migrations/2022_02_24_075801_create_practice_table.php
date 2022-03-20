<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePracticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_practice', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index();
            $table->integer('total_practice_time')->default(0);
            $table->integer('total_practice_count')->default(0);
            $table->integer('total_practice_num')->default(0);
            $table->integer('total_practice_error_num')->default(0);
            $table->integer('practice_num_1')->default(0);
            $table->integer('practice_error_num_1')->default(0);
            $table->integer('practice_num_2')->default(0);
            $table->integer('practice_error_num_2')->default(0);
            $table->integer('practice_num_3')->default(0);
            $table->integer('practice_error_num_3')->default(0);
            $table->integer('practice_num_4')->default(0);
            $table->integer('practice_error_num_4')->default(0);
            $table->integer('everyday_target_num')->default(0);
            $table->string('everyday_prompt_time')->nullable()->default("");
            $table->integer('today_practice_num')->default(0);
            $table->integer('today_practice_time')->default(0);
            $table->bigInteger('last_practice_time')->default(0);
            $table->integer('last_practice_index')->default(0);
            $table->integer('last_model')->default(0);
            $table->integer('last_note_group_index')->default(0);
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
        Schema::dropIfExists('t_practice');
    }
}
