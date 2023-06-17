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
        Schema::create('bencana', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->date('tanggal');
            $table->time('waktu');
            $table->string('lokasi');
            // $table->unsignedBigInteger('posko_id')->nullable();
            $table->unsignedBigInteger('pengungsi_id')->nullable();
            // $table->string('korban')->nullable();
            $table->unsignedBigInteger('status')->nullable();
            // $table->unsignedBigInteger('posko_id')->nullable();
            // $table->foreign('posko_id')->references('id')->on('posko');
            // $table->foreign('pengungsi_id')->references('id')->on('pengungsi');
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
        Schema::dropIfExists('bencana');
    }
};
