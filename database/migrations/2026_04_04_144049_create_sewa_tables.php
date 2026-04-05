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
        Schema::create('sewa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->constrained('pelanggan')->onDelete('restrict');
            $table->string('nopol', 9);
            $table->foreign('nopol')
                ->references('nopol')
                ->on('kendaraan')
                ->onDelete('restrict');
            $table->enum('jenis_sewa',['sopir','lepas kunci']);
            $table->date('tgl_sewa');
            $table->date('jadwal_kembali');
            $table->tinyInteger('durasi');
            $table->integer('harga_sewa');
            $table->integer('sub_total');
            $table->integer('denda');
            $table->integer('harga_total');
            $table->enum('status',['Booking','lunas','selesai']);
            $table->integer('biaya_supir');
            $table->integer('biaya_antar');
            $table->string('lokasi_jemput',10);
            $table->string('lokasi_kembali',10);
            $table->integer('dp');
            $table->enum('opsi_pengantaran',['diantar','tidak']);
            $table->integer('sisa_tagihan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sewa_tables');
    }
};
