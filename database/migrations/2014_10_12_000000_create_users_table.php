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
     * 0 - admin, 1 - user, 2 - support, 3 - vip
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 60)->unique();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->tinyInteger('level')->default(1);
            $table->string('fullname')->nullable();
            $table->string('address')->nullable();
            $table->string('city',100)->nullable();
            $table->string('district',100)->nullable();
            $table->string('phone', 16)->nullable();
            $table->date('dob')->nullable();
            $table->string('avatar')->nullable();
            $table->tinyInteger('activated')->default(0);
            $table->tinyInteger('status')->default(1);
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
