<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBayiPeriksasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bayi_periksas', function (Blueprint $table) {
            $table->integer('periksaID')->primary();
            $table->integer('posyanduID');
            $table->integer('pesertaID');
            $table->integer('umur');
            $table->float('beratBadan');
            $table->float('panjangBadan');
            $table->float('lingkarKepala');
            $table->string('asiEkslusif');
            $table->integer('imunisasiID');
            $table->integer('userID');
            $table->dateTime('tanggal');
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
        Schema::dropIfExists('bayi_periksas');
    }
}
