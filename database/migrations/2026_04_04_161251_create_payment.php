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
        Schema::create('tr_pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->string('order_id',25);
            $table->string('snap_token',255);
            $table->foreignId('id_sewa')->constrained('tr_sewa', 'id_sewa')->onDelete('cascade');
            $table->string('payment_type',50);
            $table->enum('transaction_status',['pending','settlement','expire','cancel']);
            $table->integer('jumlah_bayar');
            $table->enum('status_pembayaran',['dp','lunas','gagal']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tr_pembayaran');
    }
};

