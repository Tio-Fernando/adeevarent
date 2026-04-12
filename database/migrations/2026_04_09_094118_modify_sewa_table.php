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
         Schema::table('sewa', function (Blueprint $table) {
           
            $table->dateTime('tgl_sewa')->change();
            $table->dateTime('jadwal_kembali')->change();
            $table->dateTime('tgl_kembali')->after('tgl_sewa')->nullable();
            $table->dropColumn('biaya_antar');
        });

        Schema::table('kendaraan',function(Blueprint $table){
            $table->integer('denda_terlambat')->default(0); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kendaraan', function (Blueprint $table) {
            $table->dropColumn('denda_terlambat');
        });

        // Kembalikan tipe data ke DATE (Jika sebelumnya DATE)
        Schema::table('sewa', function (Blueprint $table) {
            $table->date('tgl_sewa')->change();
            $table->date('jadwal_kembali')->change();
            $table->integer('biaya_antar');
            $table->date('tgl_kembali')->change();
        });
    }
};
