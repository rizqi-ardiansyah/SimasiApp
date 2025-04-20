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
        Schema::create('kondisi_psikologis', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->time('waktu');
            // $table->string('idPengungsi')->nullable();
            $table->unsignedBigInteger('idPengungsi');
            $table->unsignedBigInteger('jawaban1');
            $table->unsignedBigInteger('jawaban2');
            $table->unsignedBigInteger('jawaban3');
            $table->unsignedBigInteger('jawaban4');
            $table->unsignedBigInteger('jawaban5');
            $table->unsignedBigInteger('jawaban6');
            $table->unsignedBigInteger('skor');
            $table->unsignedBigInteger('status');
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
        Schema::dropIfExists('kondisi_psikologis');
    }
};
