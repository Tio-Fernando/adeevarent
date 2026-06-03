<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('tr_sewa', function (Blueprint $table) {
            $table->string('invoice', 30)->nullable()->unique()->after('id_tr_sewa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tr_sewa', function (Blueprint $table) {
            //
        });
    }
};
