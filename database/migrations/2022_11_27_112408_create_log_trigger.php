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
        Schema::create('log_triggers', function (Blueprint $table) {
            $table->id('id_log');
            $table->text('deskripsi');
            $table->timestamps();
        });
        // === User ===
        DB::unprepared("
        CREATE TRIGGER log_insert_user AFTER INSERT ON users FOR EACH ROW
        BEGIN
            DECLARE text_ text(500);
            SET text_ = CONCAT(new.name,'_',new.level,' telah di tambahkan data user',' | ',now());
            INSERT INTO log_triggers VALUES (NULL,text_,now(),NULL);
        END
        ");
        DB::unprepared("
        CREATE TRIGGER log_update_user AFTER UPDATE ON users FOR EACH ROW
        BEGIN
            DECLARE text_ text(500);
            SET text_ = CONCAT(old.name,'_',old.level,' telah di ubah dari data user',' | ',now());
            INSERT INTO log_triggers VALUES (NULL,text_,now(),NULL);
        END
        ");
        DB::unprepared("
        CREATE TRIGGER log_delete_user AFTER DELETE ON users FOR EACH ROW
        BEGIN
            DECLARE text_ text(500);
            SET text_ = CONCAT(old.name,' telah di hapus dari data user',' | ',now());
            INSERT INTO log_triggers VALUES (NULL,text_,now(),NULL);
        END
        ");
        // === Masakan ===

        // === Detail Masakan ===
        DB::unprepared("
        CREATE TRIGGER log_insert_detail_masakan AFTER INSERT ON detail_masakans FOR EACH ROW
            BEGIN
                DECLARE name_, id_, masakan_ varchar(255);
                DECLARE text_ varchar(255);
                SELECT users.name, users.id INTO name_, id_ FROM pesanans INNER JOIN users ON pesanans.id = users.id WHERE id_pesanan = new.id_pesanan;
                SELECT nama_masakan INTO masakan_ FROM masakans WHERE id_masakan = new.id_masakan;
                SET text_ = CONCAT(name_, '_', id_, ' | Insert detail_masakans Name : ' ,masakan_,'.Ke No Pesanan : ',new.id_pesanan,' dari data detail',' | ',now());
                INSERT INTO log_triggers VALUES (NULL,text_,now(),NULL);
                END
        ");
        DB::unprepared("
        CREATE TRIGGER log_update_detail_masakan AFTER UPDATE ON detail_masakans FOR EACH ROW
            BEGIN
            DECLARE name_, id_, masakan_ varchar(255);
            DECLARE text_ varchar(255);
                SELECT users.name, users.id INTO name_, id_ FROM pesanans INNER JOIN users ON pesanans.id = users.id WHERE id_pesanan = new.id_pesanan;
                SELECT nama_masakan INTO masakan_ FROM masakans WHERE id_masakan = new.id_masakan;
                SET text_ = CONCAT(name_, '_', id_, ' | Update detail_masakans Name : ' ,masakan_,'.Ke No Pesanan : ',new.id_pesanan,' dari data detail',' | ',now());
                INSERT INTO log_triggers VALUES (NULL,text_,now(),NULL);
            END
        ");
        DB::unprepared("
        CREATE TRIGGER log_delete_detail_masakan AFTER DELETE ON detail_masakans FOR EACH ROW
        BEGIN
                DECLARE name_, id_, masakan_ varchar(255);
                DECLARE text_ varchar(255);
                SELECT users.name, users.id INTO name_, id_ FROM pesanans INNER JOIN users ON pesanans.id = users.id WHERE id_pesanan = old.id_pesanan;
                SELECT nama_masakan INTO masakan_ FROM masakans WHERE id_masakan = old.id_masakan;
                SET text_ = CONCAT(name_, '_', id_, ' | Delete detail_masakans Name : ' ,masakan_,'.Ke No Pesanan : ',old.id_pesanan,' dari data detail',' | ',now());
                INSERT INTO log_triggers VALUES (NULL,text_,now(),NULL);
            END
        ");
        // === Detail Masakan ===

        // === Meja ===
        DB::unprepared("
        CREATE TRIGGER log_insert_meja AFTER INSERT ON mejas FOR EACH ROW
        BEGIN
            DECLARE text_ text(500);
            SET text_ = CONCAT('Meja telah di tambah dari data meja',' | ',now());
            INSERT INTO log_triggers VALUES (NULL,text_,now(),NULL);
        END
        ");
        DB::unprepared("
        CREATE TRIGGER log_update_meja AFTER UPDATE ON mejas FOR EACH ROW
        BEGIN
            DECLARE text_ text(500);
            SET text_ = CONCAT('Meja telah di update dari data meja',' | ',now());
            INSERT INTO log_triggers VALUES (NULL,text_,now(),NULL);
        END
        ");
        DB::unprepared("
        CREATE TRIGGER log_delete_meja AFTER DELETE ON mejas FOR EACH ROW
        BEGIN
            DECLARE text_ text(500);
            SET text_ = CONCAT('Meja telah di hapus dari data meja',' | ',now());
            INSERT INTO log_triggers VALUES (NULL,text_,now(),NULL);
        END
        ");
        // === Meja ===

        // === Masakan ===
        DB::unprepared("
        CREATE TRIGGER log_insert_masakan AFTER INSERT ON masakans FOR EACH ROW
        BEGIN
            DECLARE text_ text(500);
            SET text_ = CONCAT('Masakan ',new.nama_masakan,' telah di tambah dari data masakan',' | ',now());
            INSERT INTO log_triggers VALUES (NULL,text_,now(),NULL);
        END
        ");
        DB::unprepared("
        CREATE TRIGGER log_update_masakan AFTER UPDATE ON masakans FOR EACH ROW
        BEGIN
            DECLARE text_ text(500);
            SET text_ = CONCAT('Masakan ~', old.nama_masakan,'_',old.type,'_Rp.',old.harga,'~ telah di update ', new.nama_masakan,'_',new.type,'_Rp.',new.harga,' dari data masakan',' | ',now());
            INSERT INTO log_triggers VALUES (NULL,text_,now(),NULL);
        END
        ");
        DB::unprepared("
        CREATE TRIGGER log_delete_masakan AFTER DELETE ON masakans FOR EACH ROW
        BEGIN
            DECLARE text_ text(500);
            SET text_ = CONCAT('Masakan ',old.nama_masakan,' telah di hapus dari data masakan',' | ',now());
            INSERT INTO log_triggers VALUES (NULL,text_,now(),NULL);
        END
        ");
        // === Masakan ===

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_triggers');

        // === User ===
        DB::unprepared('DROP TRIGGER `log_insert_user`');
        DB::unprepared('DROP TRIGGER `log_update_user`');
        DB::unprepared('DROP TRIGGER `log_delete_user`');
        // === User ===

        // === Detail Masakan ===
        DB::unprepared('DROP TRIGGER `log_insert_detail_masakan`');
        DB::unprepared('DROP TRIGGER `log_update_detail_masakan`');
        DB::unprepared('DROP TRIGGER `log_delete_detail_masakan`');
        // === Detail Masakan ===

        // === Masakan ===
        DB::unprepared('DROP TRIGGER `log_insert_masakan`');
        DB::unprepared('DROP TRIGGER `log_update_masakan`');
        DB::unprepared('DROP TRIGGER `log_delete_masakan`');
        // === Masakan ===

        // === Meja ===
        DB::unprepared('DROP TRIGGER `log_insert_meja`');
        DB::unprepared('DROP TRIGGER `log_update_meja`');
        DB::unprepared('DROP TRIGGER `log_delete_meja`');
        // === Meja ===
    }
};
