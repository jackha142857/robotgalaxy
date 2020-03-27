<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSavedListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saved_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('robot_id');
            $table->timestamps();
            
            $table->unique(['user_id', 'robot_id']);
            
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('robot_id')->references('id')->on('robots')
                ->onDelete('cascade')
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
        Schema::table('saved_lists', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['robot_id']);
        });
        Schema::dropIfExists('saved_lists');
    }
}
