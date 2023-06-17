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
        Schema::create('pengungsi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('statKel');
            $table->unsignedBigInteger('kpl_id');
            $table->string('telpon');
            $table->unsignedBigInteger('gender');
            $table->unsignedBigInteger('umur');
            $table->unsignedBigInteger('statPos');
            $table->unsignedBigInteger('posko_id');
            $table->unsignedBigInteger('statKon');
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
        Schema::dropIfExists('pengungsi');
    }
};
