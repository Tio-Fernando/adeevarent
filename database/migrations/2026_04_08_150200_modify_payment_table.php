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
        Schema::table('payment', function (Blueprint $table) {
          
            $table->dropColumn('payment_type');
            $table->enum('payment_type', ['qris', 'va', 'cash'])->after('transaction_status');
            $table->integer('dp')->default(0)->after('jumlah_bayar');
            // Tambah kolom sisa_bayar
            $table->integer('sisa_bayar')->default(0)->after('dp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment', function (Blueprint $table) {
            $table->dropColumn(['payment_type', 'dp', 'sisa_bayar']);
            $table->string('payment_type', 50)->after('transaction_status');
        });
    }
};
