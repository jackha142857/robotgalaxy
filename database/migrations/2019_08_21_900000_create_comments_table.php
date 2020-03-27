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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('robot_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('comment_id')->nullable();
            $table->text('comment', 255);
            $table->timestamps();
            
            $table->foreign('comment_id')->references('id')->on('comments')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->foreign('robot_id')->references('id')->on('robots')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['comment_id']);
            $table->dropForeign(['robot_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('comments');
    }
}
