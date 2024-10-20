<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpjTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spj', function (Blueprint $table) {
            $table->id('id_spj');
            $table->string('no_kwitansi')->unique();
            $table->unsignedBigInteger('id_sppd');
            $table->string('file_spt');
            $table->string('file_spd');
            $table->string('file_visum');
            $table->string('file_laporan');
            $table->string('file_kwitansi');
            $table->string('file_poto');
            $table->string('file_notabensin');
            $table->timestamps();

            // Foreign key untuk id_sppd jika ada tabel SPPD
            $table->foreign('id_sppd')->references('id_sppd')->on('tr_sppd')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spj');
    }
}
