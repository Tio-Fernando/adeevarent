<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tr_sewa', function (Blueprint $table) {
            $table->string('lokasi_jemput', 255)->nullable()->change();
            $table->string('lokasi_kembali', 255)->nullable()->change();
            
            if (!Schema::hasColumn('tr_sewa', 'denda')) {
                $table->integer('denda')->default(0)->after('harga_total');
            }
        });
    }

    public function down(): void
    {
        Schema::table('tr_sewa', function (Blueprint $table) {
            $table->string('lokasi_jemput', 10)->nullable(false)->change();
            $table->string('lokasi_kembali', 10)->nullable(false)->change();

            if (Schema::hasColumn('sewa', 'denda')) {
                $table->dropColumn('denda');
            }
        });
    }
};
