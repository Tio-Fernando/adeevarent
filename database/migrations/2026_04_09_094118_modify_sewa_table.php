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
            $table->dateTime('tgl_sewa')->change();
             $table->dateTime('jadwal_kembali')->change();
            $table->dateTime('tgl_kembali')->after('tgl_sewa')->nullable();
            $table->enum('status',['booking','dp','lunas','selesai','batal'])->change();
            $table->dropColumn('biaya_antar');
        });

        Schema::table('ms_kendaraan',function(Blueprint $table){
            $table->integer('denda_terlambat')->default(0); 
        });
    } 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ms_kendaraan', function (Blueprint $table) {
            $table->dropColumn('denda_terlambat');
        });

        Schema::table('tr_sewa', function (Blueprint $table) {
            $table->date('tgl_sewa')->change();
            $table->date('jadwal_kembali')->change();
            $table->integer('biaya_antar');
               $table->enum('status',['booking','lunas','selesai'])->change();
            $table->date('tgl_kembali')->change();
        });
    }
};
