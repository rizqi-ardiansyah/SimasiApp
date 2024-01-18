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
        Schema::create('integrasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kpl_id');
            $table->unsignedBigInteger('png_id');
            $table->unsignedBigInteger('posko_id');
            $table->unsignedBigInteger('bencana_id');
            $table->unsignedBigInteger('user_id');
   
            $table->foreign('kpl_id')->references('id')->on('kepala_keluarga');
            $table->foreign('png_id')->references('id')->on('pengungsi');
            $table->foreign('posko_id')->references('id')->on('posko');
            $table->foreign('bencana_id')->references('id')->on('bencana');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('tables_integration');
    }
};
