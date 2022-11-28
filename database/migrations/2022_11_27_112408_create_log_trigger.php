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
        Schema::create('log_trigger', function (Blueprint $table) {
            $table->id('id_log');
            $table->text('deskripsi');
            $table->timestamps();
        });
        DB::unprepared("
        CREATE TRIGGER log_insert_detail_masakan AFTER INSERT ON detail_masakans FOR EACH ROW
            BEGIN
                DECLARE name_, id_, masakan_ varchar(255);
                DECLARE text_ varchar(255);
                SELECT users.name, users.id INTO name_, id_ FROM pesanans INNER JOIN users ON pesanans.id = users.id WHERE id_pesanan = new.id_pesanan;
                SELECT nama_masakan INTO masakan_ FROM masakans WHERE id_masakan = new.id_masakan;
                SET text_ = CONCAT(name_, '_', id_, ' | Insert detail_masakans Name : ' ,masakan_,'.Ke No Pesanan : ',new.id_pesanan);
                INSERT INTO log_trigger VALUES (NULL,text_,now(),NULL);
            END
        ");
        DB::unprepared("
        CREATE TRIGGER log_update_detail_masakan AFTER UPDATE ON detail_masakans FOR EACH ROW
            BEGIN
                DECLARE name_, id_, masakan_ varchar(255);
                DECLARE text_ varchar(255);
                SELECT users.name, users.id INTO name_, id_ FROM pesanans INNER JOIN users ON pesanans.id = users.id WHERE id_pesanan = new.id_pesanan;
                SELECT nama_masakan INTO masakan_ FROM masakans WHERE id_masakan = new.id_masakan;
                SET text_ = CONCAT(name_, '_', id_, ' | Update detail_masakans Name : ' ,masakan_,'.Ke No Pesanan : ',new.id_pesanan);
                INSERT INTO log_trigger VALUES (NULL,text_,now(),NULL);
            END
        ");
        DB::unprepared("
        CREATE TRIGGER log_delete_detail_masakan AFTER DELETE ON detail_masakans FOR EACH ROW
            BEGIN
                DECLARE name_, id_, masakan_ varchar(255);
                DECLARE text_ varchar(255);
                SELECT users.name, users.id INTO name_, id_ FROM pesanans INNER JOIN users ON pesanans.id = users.id WHERE id_pesanan = old.id_pesanan;
                SELECT nama_masakan INTO masakan_ FROM masakans WHERE id_masakan = old.id_masakan;
                SET text_ = CONCAT(name_, '_', id_, ' | Delete detail_masakans Name : ' ,masakan_,'.Ke No Pesanan : ',old.id_pesanan);
                INSERT INTO log_trigger VALUES (NULL,text_,now(),NULL);
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
        Schema::dropIfExists('log_trigger');
    }
};
