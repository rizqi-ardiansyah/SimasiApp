<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kondisi_medis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idPengungsi');
            $table->date('tanggal');
            $table->time('waktu');
            $table->string('keluhan')->nullable();
            $table->string('riwayat_penyakit')->nullable();
            $table->string('konfis');
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
        Schema::dropIfExists('kondisi_medis');
    }
};
