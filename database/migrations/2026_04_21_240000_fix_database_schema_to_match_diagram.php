<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. DROP FK dulu (aman)
        Schema::table('tr_pembayaran', function (Blueprint $table) {
            if (Schema::hasColumn('tr_pembayaran', 'id_sewa')) {
                $table->dropForeign(['id_sewa']);
            }
        });

        // 2. Tambah kolom baru dulu
        if (Schema::hasColumn('tr_sewa', 'id_sewa')) {

            Schema::table('tr_sewa', function (Blueprint $table) {
                $table->unsignedBigInteger('id_tr_sewa')->nullable()->first();
            });

            // copy data
            DB::statement("UPDATE tr_sewa SET id_tr_sewa = id_sewa");

            // 3. HAPUS AUTO_INCREMENT dulu (INI KUNCI FIX ERROR KAMU)
            DB::statement("ALTER TABLE tr_sewa MODIFY id_sewa BIGINT UNSIGNED");

            // 4. baru drop primary key (SUDAH AMAN)
            DB::statement("ALTER TABLE tr_sewa DROP PRIMARY KEY");

            // 5. drop column lama
            Schema::table('tr_sewa', function (Blueprint $table) {
                $table->dropColumn('id_sewa');
            });

            // 6. set PK baru + auto increment
            DB::statement("
                ALTER TABLE tr_sewa 
                MODIFY id_tr_sewa BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
                ADD PRIMARY KEY (id_tr_sewa)
            ");
        }

        // 7. rename kolom tanggal
        Schema::table('tr_sewa', function (Blueprint $table) {
            if (Schema::hasColumn('tr_sewa', 'tgl_sewa')) {
                $table->renameColumn('tgl_sewa', 'tanggal_sewa');
            }

            if (Schema::hasColumn('tr_sewa', 'jadwal_kembali')) {
                $table->renameColumn('jadwal_kembali', 'tanggal_kembali');
            }
        });

        // 8. recreate FK
        Schema::table('tr_pembayaran', function (Blueprint $table) {
            if (Schema::hasColumn('tr_pembayaran', 'id_sewa')) {
                $table->foreign('id_sewa')
                    ->references('id_tr_sewa')
                    ->on('tr_sewa')
                    ->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        // DROP FK
        Schema::table('tr_pembayaran', function (Blueprint $table) {
            if (Schema::hasColumn('tr_pembayaran', 'id_sewa')) {
                $table->dropForeign(['id_sewa']);
            }
        });

        // revert tanggal
        Schema::table('tr_sewa', function (Blueprint $table) {
            if (Schema::hasColumn('tr_sewa', 'tanggal_sewa')) {
                $table->renameColumn('tanggal_sewa', 'tgl_sewa');
            }

            if (Schema::hasColumn('tr_sewa', 'tanggal_kembali')) {
                $table->renameColumn('tanggal_kembali', 'jadwal_kembali');
            }
        });

        // revert PK
        if (Schema::hasColumn('tr_sewa', 'id_tr_sewa')) {

            Schema::table('tr_sewa', function (Blueprint $table) {
                $table->unsignedBigInteger('id_sewa')->nullable()->first();
            });

            DB::statement("UPDATE tr_sewa SET id_sewa = id_tr_sewa");

            DB::statement("ALTER TABLE tr_sewa MODIFY id_tr_sewa BIGINT UNSIGNED");

            DB::statement("ALTER TABLE tr_sewa DROP PRIMARY KEY");

            Schema::table('tr_sewa', function (Blueprint $table) {
                $table->dropColumn('id_tr_sewa');
            });

            DB::statement("
                ALTER TABLE tr_sewa 
                MODIFY id_sewa BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
                ADD PRIMARY KEY (id_sewa)
            ");
        }

        // restore FK
        Schema::table('tr_pembayaran', function (Blueprint $table) {
            $table->foreign('id_sewa')
                ->references('id_sewa')
                ->on('tr_sewa')
                ->onDelete('cascade');
        });
    }
};
