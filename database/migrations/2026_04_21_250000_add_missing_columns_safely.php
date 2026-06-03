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
        // Add nama_cabang to ms_cabang if not exists
        Schema::table('ms_cabang', function (Blueprint $table) {
            if (!Schema::hasColumn('ms_cabang', 'nama_cabang')) {
                $table->string('nama_cabang', 40)->after('id')->nullable();
            }
        });

        // Add missing columns to ms_pelanggan
        Schema::table('ms_pelanggan', function (Blueprint $table) {
            if (!Schema::hasColumn('ms_pelanggan', 'no_identitas')) {
                $table->string('no_identitas', 25)->after('nama_pelanggan')->nullable();
            }
            if (!Schema::hasColumn('ms_pelanggan', 'no_hp')) {
                $table->string('no_hp', 15)->after('no_identitas')->nullable();
            }
            if (!Schema::hasColumn('ms_pelanggan', 'tanggal_lahir')) {
                $table->date('tanggal_lahir')->after('no_hp')->nullable();
            }
        });

        // Add missing columns to tr_pembayaran
        Schema::table('tr_pembayaran', function (Blueprint $table) {
            if (!Schema::hasColumn('tr_pembayaran', 'no_pembayaran')) {
                $table->bigInteger('no_pembayaran')->after('id_pembayaran')->nullable();
            }
            if (!Schema::hasColumn('tr_pembayaran', 'total_bayar')) {
                $table->integer('total_bayar')->after('jumlah_bayar')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ms_cabang', function (Blueprint $table) {
            if (Schema::hasColumn('ms_cabang', 'nama_cabang')) {
                $table->dropColumn('nama_cabang');
            }
        });

        Schema::table('ms_pelanggan', function (Blueprint $table) {
            if (Schema::hasColumn('ms_pelanggan', 'no_identitas')) {
                $table->dropColumn('no_identitas');
            }
            if (Schema::hasColumn('ms_pelanggan', 'no_hp')) {
                $table->dropColumn('no_hp');
            }
            if (Schema::hasColumn('ms_pelanggan', 'tanggal_lahir')) {
                $table->dropColumn('tanggal_lahir');
            }
        });

        Schema::table('tr_pembayaran', function (Blueprint $table) {
            if (Schema::hasColumn('tr_pembayaran', 'no_pembayaran')) {
                $table->dropColumn('no_pembayaran');
            }
            if (Schema::hasColumn('tr_pembayaran', 'total_bayar')) {
                $table->dropColumn('total_bayar');
            }
        });
    }
};
