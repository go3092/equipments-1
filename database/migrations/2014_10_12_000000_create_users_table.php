<?php

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
            $table->string('idusers');
            $table->string('nik');
            $table->string('name');
            $table->string('email')->unique();
            $table->enum('role',['a','s','l','m']);//admin,security,leader(supervisor),manager
            $table->string('photos')->nullable();
            $table->dateTime('last_login')->nullable();
            $table->string('password');
            $table->boolean('active');
            $table->rememberToken();
            $table->timestamps();
        });
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
