<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('post_url', 100)->comment('文章url');
            $table->integer('parent_id')->default(0)->comment('上级评论id,若是一级评论则为0');
            $table->string('nickname', 50)->comment('昵称');
            $table->integer('email')->nullable()->comment('邮箱');
            $table->string('content',255)->comment('内容');
            $table->string('create_time',64)->comment('创建时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
