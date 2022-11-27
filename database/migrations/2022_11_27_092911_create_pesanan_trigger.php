<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        DB::unprepared("
        CREATE TRIGGER pesanan_total_insert AFTER INSERT ON detail_masakans FOR EACH ROW
            BEGIN
                UPDATE pesanans SET total_harga = total_harga + new.sub_total
                WHERE id_pesanan = new.id_pesanan;
            END
        ");
        DB::unprepared("
        CREATE TRIGGER pesanan_total_update AFTER UPDATE ON detail_masakans FOR EACH ROW
            BEGIN
                UPDATE pesanans SET total_harga = total_harga + (new.sub_total - old.sub_total)
                WHERE id_pesanan = new.id_pesanan;
            END
        ");
        DB::unprepared("
        CREATE TRIGGER pesanan_total_delete AFTER DELETE ON detail_masakans FOR EACH ROW
            BEGIN
                UPDATE pesanans SET total_harga = total_harga - old.sub_total
                WHERE id_pesanan = old.id_pesanan;
            END
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanan_trigger');
    }
};
