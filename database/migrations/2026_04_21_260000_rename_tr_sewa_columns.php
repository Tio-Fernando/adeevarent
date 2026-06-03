<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('tr_sewa', 'id_sewa')) {
            return;
        }

        // rename kolom
        Schema::table('tr_sewa', function (Blueprint $table) {

            $columns = DB::select("
                SELECT COLUMN_NAME 
                FROM INFORMATION_SCHEMA.COLUMNS 
                WHERE TABLE_NAME = 'tr_sewa' 
                AND TABLE_SCHEMA = DATABASE()
            ");

            $columnNames = array_map(fn($col) => $col->COLUMN_NAME, $columns);

            if (in_array('tgl_sewa', $columnNames) && !in_array('tanggal_sewa', $columnNames)) {
                $table->renameColumn('tgl_sewa', 'tanggal_sewa');
            }

            if (in_array('jadwal_kembali', $columnNames) && !in_array('tanggal_kembali', $columnNames)) {
                $table->renameColumn('jadwal_kembali', 'tanggal_kembali');
            }
        });

        // rename PK
        DB::statement("
            ALTER TABLE tr_sewa 
            CHANGE COLUMN id_sewa id_tr_sewa BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
        ");

        // update FK
        Schema::table('tr_pembayaran', function (Blueprint $table) {

            if (Schema::hasColumn('tr_pembayaran', 'id_sewa')) {
                $table->dropForeign(['id_sewa']);
            }

            $table->foreign('id_sewa')
                ->references('id_tr_sewa')
                ->on('tr_sewa')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('tr_sewa')) {
            return;
        }

        Schema::table('tr_pembayaran', function (Blueprint $table) {
            if (Schema::hasColumn('tr_pembayaran', 'id_sewa')) {
                $table->dropForeign(['id_sewa']);
            }
        });

        Schema::table('tr_sewa', function (Blueprint $table) {

            $columns = DB::select("
                SELECT COLUMN_NAME 
                FROM INFORMATION_SCHEMA.COLUMNS 
                WHERE TABLE_NAME = 'tr_sewa' 
                AND TABLE_SCHEMA = DATABASE()
            ");

            $columnNames = array_map(fn($col) => $col->COLUMN_NAME, $columns);

            if (in_array('tanggal_sewa', $columnNames) && !in_array('tgl_sewa', $columnNames)) {
                $table->renameColumn('tanggal_sewa', 'tgl_sewa');
            }

            if (in_array('tanggal_kembali', $columnNames) && !in_array('jadwal_kembali', $columnNames)) {
                $table->renameColumn('tanggal_kembali', 'jadwal_kembali');
            }
        });

        DB::statement("
            ALTER TABLE tr_sewa 
            CHANGE COLUMN id_tr_sewa id_sewa BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
        ");

        Schema::table('tr_pembayaran', function (Blueprint $table) {
            $table->foreign('id_sewa')
                ->references('id_sewa')
                ->on('tr_sewa')
                ->onDelete('cascade');
        });
    }
};
