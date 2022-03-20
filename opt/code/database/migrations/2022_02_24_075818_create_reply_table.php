<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_reply', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index();
            $table->integer('target_user_id')->index();
            $table->integer('invitation_id')->index();
            $table->integer('comment_id')->index();
            $table->integer('favorite_num');
            $table->text('content');
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
        Schema::dropIfExists('t_reply');
    }
}
