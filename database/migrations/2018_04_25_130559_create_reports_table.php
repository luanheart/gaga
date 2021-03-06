<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('用户id');
            $table->integer('target_user_id')->comment('目标用户id');
            $table->text('img')->comment('截图');
            $table->string('reason')->comment('原因');
            $table->integer('status')->comment('状态 0正常 1已处理 2忽略');
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
        Schema::dropIfExists('reports');
    }
}
