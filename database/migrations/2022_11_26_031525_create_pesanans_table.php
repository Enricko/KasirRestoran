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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id('id_pesanan');
            $table->date('tgl_pesanan');
            $table->unsignedBigInteger('id');
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('no_meja');
            $table->foreign('no_meja')->references('no_meja')->on('mejas')->onDelete('cascade');
            $table->bigInteger('total_harga');
            $table->bigInteger('bayar')->nullable();
            $table->bigInteger('kembalian')->nullable();
            $table->enum('status_pesanan',['belum_bayar','sudah_bayar']);
            $table->enum('status_makanan_pesanan',['sedang_diproses','siap_antar','telah_tersaji']);
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
        Schema::dropIfExists('pesanans');
    }
};
