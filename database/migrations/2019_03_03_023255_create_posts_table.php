<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique()->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('comments_count')->default(0);
            $table->string('title');
            $table->text('body');
            $table->unsignedInteger('best_comment_id')->nullable();
            $table->boolean('locked')->default(false);
            $table->timestamps();

            $table->foreign('best_comment_id')
                ->references('id')
                ->on('comments')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
