<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToReplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_reply', function (Blueprint $table) {
            $table->integer('status')->default(0)->comment("0:正常 1:审核 2:审核失败 3:删除");
            $table->string('extra')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_reply', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('extra');
        });
    }
}
