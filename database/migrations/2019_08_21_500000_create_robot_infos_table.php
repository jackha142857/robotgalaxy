<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRobotInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('robot_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('robot_id');
            $table->unsignedTinyInteger('property_id');
            $table->string('content', 255)->nullable();
            $table->timestamps();
            
            $table->unique(['robot_id', 'property_id']);
            
            $table->foreign('robot_id')->references('id')->on('robots')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreign('property_id')->references('id')->on('properties')
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
        Schema::table('robot_infos', function (Blueprint $table) {
            $table->dropForeign(['robot_id']);
            $table->dropForeign(['property_id']);
        });
        Schema::dropIfExists('robot_infos');
    }
}
