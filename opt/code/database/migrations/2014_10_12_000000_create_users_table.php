<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_users', function (Blueprint $table) {
            $table->id("user_id");
            $table->string('openid')->nullable();
            $table->string('login_key')->nullable();
            $table->bigInteger('birthday')->nullable();
            $table->string('nickname')->nullable();
            $table->string('education')->nullable();
            $table->integer('gender')->default(0);
            $table->string('account');
            $table->string('password');
            $table->string('email');
            $table->string('avatar_url')->nullable();
            $table->string('collect_list')->default("");
            $table->string('favorite_invitation_list')->default("");
            $table->string('favorite_comment_list')->default("");
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
        Schema::dropIfExists('t_users');
    }
}
