<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTamusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tamus', function (Blueprint $table) {
            $table->string('id_tamu',32)->primary();
            $table->string('nama');
            $table->string('alamat');
            $table->enum('gender',['l', 'p']);
            $table->string('id_tuanrumah',32);
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
        Schema::dropIfExists('tamus');
    }
}
