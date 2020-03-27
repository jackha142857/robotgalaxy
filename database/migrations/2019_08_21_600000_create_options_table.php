<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->unsignedTinyInteger('property_id');
            $table->string('option', 255);
            $table->string('description', 255)->nullable();
            $table->timestamps();            
            
            $table->unique(['property_id', 'option']);
            
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
        Schema::table('options', function (Blueprint $table) {
            $table->dropForeign(['property_id']);
        });
        Schema::dropIfExists('options');
    }
}
