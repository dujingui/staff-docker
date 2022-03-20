<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_invitation', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index();
            $table->string('title');
            $table->text('content_text');
            $table->string('content_img')->nullable();
            $table->integer('favorite_num')->default(0);
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
        Schema::dropIfExists('t_invitation');
    }
}
