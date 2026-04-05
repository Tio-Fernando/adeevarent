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
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->string('order_id',25);
            $table->string('snap_token',255);
            $table->foreignId('sewa_id')->constrained('sewa')->onDelete('cascade');
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
        Schema::dropIfExists('payment');
    }
};
