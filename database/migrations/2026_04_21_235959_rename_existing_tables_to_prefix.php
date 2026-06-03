<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Rename category to ms_kategori if it exists
        if (Schema::hasTable('category')) {
            Schema::rename('category', 'ms_kategori');
        }

        // Rename ms_category to ms_kategori if it exists
        if (Schema::hasTable('ms_category')) {
            Schema::rename('ms_category', 'ms_kategori');
        }

        // Rename cabang to ms_cabang if it exists
        if (Schema::hasTable('cabang')) {
            Schema::rename('cabang', 'ms_cabang');
        }

        // Rename kendaraan to ms_kendaraan if it exists
        if (Schema::hasTable('kendaraan')) {
            Schema::rename('kendaraan', 'ms_kendaraan');
        }

        // Rename pelanggan to ms_pelanggan if it exists
        if (Schema::hasTable('pelanggan')) {
            Schema::rename('pelanggan', 'ms_pelanggan');
        }

        // Rename sewa to tr_sewa if it exists
        if (Schema::hasTable('sewa')) {
            Schema::rename('sewa', 'tr_sewa');
        }

        // Rename payment to tr_pembayaran if it exists
        if (Schema::hasTable('payment')) {
            Schema::rename('payment', 'tr_pembayaran');
        }

        // Rename columns in ms_kendaraan
        if (Schema::hasTable('ms_kendaraan')) {
            Schema::table('ms_kendaraan', function (Blueprint $table) {
                if (Schema::hasColumn('ms_kendaraan', 'category_id')) {
                    $table->renameColumn('category_id', 'id_kategori');
                }
                if (Schema::hasColumn('ms_kendaraan', 'cabang_id')) {
                    $table->renameColumn('cabang_id', 'id_cabang');
                }
            });
        }

        // Rename columns in tr_sewa
        if (Schema::hasTable('tr_sewa')) {
            Schema::table('tr_sewa', function (Blueprint $table) {
                if (Schema::hasColumn('tr_sewa', 'pelanggan_id')) {
                    $table->renameColumn('pelanggan_id', 'id_pelanggan');
                }
            });
        }

        // Rename columns in tr_pembayaran
        if (Schema::hasTable('tr_pembayaran')) {
            Schema::table('tr_pembayaran', function (Blueprint $table) {
                if (Schema::hasColumn('tr_pembayaran', 'sewa_id')) {
                    $table->renameColumn('sewa_id', 'id_sewa');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse: rename tr_pembayaran back to payment if it exists
        if (Schema::hasTable('tr_pembayaran')) {
            Schema::rename('tr_pembayaran', 'payment');
        }

        // Reverse: rename tr_sewa back to sewa if it exists
        if (Schema::hasTable('tr_sewa')) {
            Schema::rename('tr_sewa', 'sewa');
        }

        // Reverse: rename ms_pelanggan back to pelanggan if it exists
        if (Schema::hasTable('ms_pelanggan')) {
            Schema::rename('ms_pelanggan', 'pelanggan');
        }

        // Reverse: rename ms_kendaraan back to kendaraan if it exists
        if (Schema::hasTable('ms_kendaraan')) {
            Schema::rename('ms_kendaraan', 'kendaraan');
        }

        // Reverse: rename ms_cabang back to cabang if it exists
        if (Schema::hasTable('ms_cabang')) {
            Schema::rename('ms_cabang', 'cabang');
        }

        // Reverse: rename ms_kategori back to category if it exists
        if (Schema::hasTable('ms_kategori')) {
            Schema::rename('ms_kategori', 'category');
        }

        // Reverse column renames in tables if they still exist
        if (Schema::hasTable('ms_kendaraan')) {
            Schema::table('ms_kendaraan', function (Blueprint $table) {
                if (Schema::hasColumn('ms_kendaraan', 'id_kategori')) {
                    $table->renameColumn('id_kategori', 'category_id');
                }
                if (Schema::hasColumn('ms_kendaraan', 'id_cabang')) {
                    $table->renameColumn('id_cabang', 'cabang_id');
                }
            });
        }

        if (Schema::hasTable('tr_sewa')) {
            Schema::table('tr_sewa', function (Blueprint $table) {
                if (Schema::hasColumn('tr_sewa', 'id_pelanggan')) {
                    $table->renameColumn('id_pelanggan', 'pelanggan_id');
                }
            });
        }

        if (Schema::hasTable('tr_pembayaran')) {
            Schema::table('tr_pembayaran', function (Blueprint $table) {
                if (Schema::hasColumn('tr_pembayaran', 'id_sewa')) {
                    $table->renameColumn('id_sewa', 'sewa_id');
                }
            });
        }
    }
};
