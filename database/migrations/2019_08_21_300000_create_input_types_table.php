<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInputTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('input_types', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->unsignedTinyInteger('type')->unique();
                // 0: text
                // 1: radio
                // 2: checkbox
                // 3: link, upload
            $table->string('name', 255)->unique();
            $table->timestamps();
        });
        
            // Insert some stuff
        DB::table('input_types')->insert(array(
            array(
                'type' => 0,
                'name' => 'Text'
            ),
            array(
                'type' => 1,
                'name' => 'Radio button'
            ),
            array(
                'type' => 2,
                'name' => 'Checkbox'
            ),
            array(
                'type' => 3,
                'name' => 'Combobox'
            ),
            array(
                'type' => 10,
                'name' => 'Upload'
            )
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
        Schema::dropIfExists('input_types');
    }
}
