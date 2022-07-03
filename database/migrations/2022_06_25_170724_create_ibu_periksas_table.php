<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIbuPeriksasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ibu_periksas', function (Blueprint $table) {
            $table->integer('pesertaID')->primary();
            $table->integer('umur');
            $table->float('lingkarPinggang');
            $table->float('lingkarBokong');
            $table->float('lingkarLengan');
            $table->float('tinggiBadan');
            $table->float('beratBadan');
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
        Schema::dropIfExists('ibu_periksas');
    }
}
