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
        CREATE TRIGGER pesan_meja_trigger AFTER INSERT ON pesanans FOR EACH ROW
            BEGIN
                UPDATE mejas SET status_meja = 'penuh'
                WHERE no_meja=new.no_meja;
            END
        ");
        DB::unprepared("
        CREATE TRIGGER bayar_makanan_trigger AFTER UPDATE ON pesanans FOR EACH ROW
            BEGIN
                IF (new.status_pesanan = 'sudah_bayar') THEN
                    UPDATE mejas SET status_meja = 'kosong' WHERE no_meja=new.no_meja;
                END IF;
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
        DB::unprepared('DROP TRIGGER `pesan_meja_trigger`');
        DB::unprepared('DROP TRIGGER `bayar_makanan_trigger`');
    }
};
