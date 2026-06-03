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
        Schema::create('ms_pelanggan', function (Blueprint $table) {
            $table->id('id_pelanggan');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->string('nama_pelanggan',40);
            $table->boolean('status')->default(true);
            $table->string('alamat',255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ms_pelanggan');
    }
};



