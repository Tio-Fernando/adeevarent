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
        Schema::table('tr_sewa', function (Blueprint $table) {
            // Tambah kolom tanggal_kembali
            $table->string('lokasi_antar')->nullable()->after('biaya_supir');
            $table->dropColumn(['lokasi_jemput','lokasi_kembali']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tr_sewa', function (Blueprint $table) {
            $table->dropColumn('lokasi_antar');
        });
    }
};
