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
        Schema::table('ms_kendaraan', function (Blueprint $table) {
            if (!Schema::hasColumn('ms_kendaraan', 'denda_terlambat')) {
                $table->integer('denda_terlambat')->default(0)->after('dir');
            }
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
    }
};
