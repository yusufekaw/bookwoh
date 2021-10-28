<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kados', function (Blueprint $table) {
            $table->string('id_kado',32)->primary();
            $table->string('barang');
            $table->double('qty');
            $table->string('satuan');
            $table->string('id_tamu',32);
            $table->timestamps();
            $table->foreign('id_tamu')->references('id_tamu')->on('tamus')->onUpdate('CASCADE')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kados');
    }
}
