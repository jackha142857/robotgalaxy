<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('title', 255);
            $table->string('content', 255);
            $table->unsignedBigInteger('sender_user_id')->nullable();
            $table->boolean('state');
                // 0: read
                // 1: unread
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->foreign('sender_user_id')->references('id')->on('users')
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
        Schema::table('mails', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['sender_user_id']);
        });
        Schema::dropIfExists('mails');
    }
}
