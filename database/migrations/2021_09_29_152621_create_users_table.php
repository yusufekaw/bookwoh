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
            $table->string('id_user',32)->primary();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('role',10);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('id_tuanrumah',32);
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('id_tuanrumah')->references('id_tuanrumah')->on('tuanrumahs')->onUpdate('CASCADE')->onDelete('RESTRICT');
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
