<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('openid')->comment('openid');
            $table->string('unionid')->comment('unionid');
            $table->string('nickname')->comment('昵称');
            $table->string('avatar')->comment('头像');
            $table->date('birthday')->comment('生日');
            $table->integer('sex')->default(0)->comment('1男 2女');
            $table->integer('height')->default(0)->comment('身高cm');
            $table->integer('weight')->default(0)->comment('体重kg');
            $table->integer('attribute')->default(0)->comment('自身属性');
            $table->string('wechat')->comment('微信号');
            $table->string('job')->comment('职业');
            $table->integer('income')->default(0)->comment('年收入');
            $table->string('constellation')->comment('星座');
            $table->string('blood_type')->comment('血型');
            $table->string('dream')->comment('理想型');
            $table->string('family_view')->comment('家庭观');
            $table->string('educational_view')->comment('教育观');
            $table->string('introduction')->comment('简介');
            $table->string('kid')->comment('是否要小孩 1要 2不要');
            $table->string('house')->comment('1有房，2没有房');
            $table->string('car')->comment('1有车，2没有车');
            $table->string('country')->comment('国家');
            $table->string('province')->comment('省');
            $table->string('city')->comment('市');
            $table->integer('status')->default(0)->comment('用户状态 0正常 1冻结');
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
        Schema::dropIfExists('users');
    }
}
