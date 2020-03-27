<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->date('dob')->nullable();
            $table->string('avatar', 255)->nullable();
            $table->unsignedTinyInteger('privilege');
                // 0: inactive
                // 1: user
                // 100: admin
            $table->rememberToken();
            $table->timestamps();
        });
        
        DB::table('users')->insert(
            array(
                'name' => 'Admin',
                'email' => 'admin@robotgalaxy.online',
                'password' => Hash::make('admin123'),
                'privilege' => 100,
            )
        );
        DB::table('users')->insert(
            array(
                'name' => 'Guest',
                'email' => 'guest@robotgalaxy.online',
                'password' => Hash::make('guest123'),
                'privilege' => 1,
            )
        );
        DB::table('users')->insert(
            array(
                'name' => 'tester',
                'email' => 'tester@robotgalaxy.online',
                'password' => Hash::make('tester123'),
                'privilege' => 1,
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
        Schema::dropIfExists('users');
    }
}
