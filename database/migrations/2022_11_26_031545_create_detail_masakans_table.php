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
        Schema::create('detail_masakans', function (Blueprint $table) {
            $table->id('id_detail');
            $table->unsignedBigInteger('id_pesanan');
            $table->foreign('id_pesanan')->references('id_pesanan')->on('pesanans')->onDelete('cascade');
            $table->unsignedBigInteger('id_masakan');
            $table->foreign('id_masakan')->references('id_masakan')->on('masakans')->onDelete('cascade');
            $table->integer('qty');
            $table->bigInteger('sub_total');
            $table->text('keterangan_pesanan');
            $table->enum('status',['dimasak','sudah_siap']);
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
        Schema::dropIfExists('detail_masakans');
    }
};
