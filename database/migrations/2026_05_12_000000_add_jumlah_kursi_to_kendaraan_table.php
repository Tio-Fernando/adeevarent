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
        if (Schema::hasTable('ms_kendaraan') && !Schema::hasColumn('ms_kendaraan', 'jumlah_kursi')) {
            Schema::table('ms_kendaraan', function (Blueprint $table) {
                $table->integer('jumlah_kursi')->default(4)->after('warna');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('ms_kendaraan') && Schema::hasColumn('ms_kendaraan', 'jumlah_kursi')) {
            Schema::table('ms_kendaraan', function (Blueprint $table) {
                $table->dropColumn('jumlah_kursi');
            });
        }
    }
};
