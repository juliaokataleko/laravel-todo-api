<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->string('username')->unique();
            $table->string('phone', 20)->nullable();
            $table->string('avatar', 200)->nullable();
            $table->string('gender', 1)->nullable();
            $table->string('civil', 200)->nullable();
            $table->string('celular', 20)->nullable();
            $table->string('pai', 200)->nullable();
            $table->string('mae', 200)->nullable();
            $table->unsignedBigInteger("state_id")->nullable();
            $table->unsignedBigInteger("city_id")->nullable();
            $table->string("bairro")->nullable();
            $table->timestamp('birth_day')->nullable();
            $table->integer('role')->default(3);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
