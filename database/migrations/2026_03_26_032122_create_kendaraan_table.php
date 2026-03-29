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
        Schema::create('kendaraan', function (Blueprint $table) {
            
            $table->string('nopol', 20)->primary();
            $table->foreignId('category_id')->constrained('category')->onDelete('restrict');
            $table->foreignId('cabang_id')->constrained('cabang')->onDelete('restrict');
            $table->string('nama_kendaraan',20);
            $table->enum('transmisi',['Matic','Manual']);
            $table->integer('harga');
            $table->text('deskripsi');
            $table->enum('warna',['Merah','Hitam','Putih']);
            $table->enum('kondisi',['rusak','free']);
            $table->enum('bbm',['solar','pertalite','pertamax']);
            $table->integer('tahun');
            $table->string('dir',255);
            $table->enum('status',['booking','free']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraan');
    }
};
