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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('robot_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('comment', 255);
            $table->boolean('state');
                // 0: inactive
                // 1: active
            $table->timestamps();
            
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
        Schema::table('reports', function (Blueprint $table) {
            $table->dropForeign(['robot_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('reports');
    }
}
