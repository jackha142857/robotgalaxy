<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name', 255)->unique();
            $table->unsignedTinyInteger('input_type_id');
                // 0: text
                // 1: radio
                // 2: checkbox
                // 3: is a link, upload
            $table->string('description', 255)->nullable();
            $table->unsignedTinyInteger('order');
                // 0: inactive
                // >1 : display orders
            $table->unsignedTinyInteger('filter');
                // 0: inactive
                // >1 : display orders
            $table->timestamps();
            
            $table->foreign('input_type_id')->references('id')->on('input_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        
        DB::table('properties')->insert(
            array(
                'name' => 'Image',
                'input_type_id' => 1,
                'description' => 'Link of the image',
                'order' => 1,
                'filter' => 1,
            )
        );
        DB::table('properties')->insert(
            array(
                'name' => 'Name',
                'input_type_id' => 1,
                'description' => 'Name of the robot',
                'order' => 2,
                'filter' => 1,
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropForeign(['input_type_id']);
        });
        Schema::dropIfExists('properties');
    }
}
