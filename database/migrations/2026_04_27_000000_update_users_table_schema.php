<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Check if ms_users exists, if yes, drop it first to avoid conflicts
        if (Schema::hasTable('ms_users')) {
            Schema::dropIfExists('ms_users');
        }

        // 2. Rename users table to ms_users
        if (Schema::hasTable('users')) {
            Schema::rename('users', 'ms_users');
        }

        // 3. Rename columns in ms_users to match the database diagram
        Schema::table('ms_users', function (Blueprint $table) {
            // Rename id to id_user if it exists
            if (Schema::hasColumn('ms_users', 'id')) {
                DB::statement('ALTER TABLE ms_users CHANGE id id_user BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY');
            }

            // Rename name to nama if it exists
            if (Schema::hasColumn('ms_users', 'name')) {
                DB::statement('ALTER TABLE ms_users CHANGE name nama VARCHAR(45) NOT NULL');
            }

            // Drop phone column if it exists (no_hp is in ms_pelanggan, not here)
            if (Schema::hasColumn('ms_users', 'phone')) {
                $table->dropColumn('phone');
            }

            // Add google_id if it doesn't exist
            if (!Schema::hasColumn('ms_users', 'google_id')) {
                $table->string('google_id')->nullable()->after('email');
            }
        });

        // 4. Update foreign key in ms_pelanggan
        Schema::table('ms_pelanggan', function (Blueprint $table) {
            // Drop old foreign key if it exists
            try {
                $table->dropForeign(['id_user']);
            } catch (\Exception $e) {
                // Foreign key might not exist or be named differently
            }
        });

        // Re-create foreign key
        Schema::table('ms_pelanggan', function (Blueprint $table) {
            if (!Schema::hasColumn('ms_pelanggan', 'id_user')) {
                // This shouldn't happen but just in case
                return;
            }
            $table->foreign('id_user')->references('id_user')->on('ms_users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('ms_pelanggan', function (Blueprint $table) {
            try {
                $table->dropForeign(['id_user']);
            } catch (\Exception $e) {
                // Ignore if doesn't exist
            }
        });

        Schema::table('ms_users', function (Blueprint $table) {
            if (Schema::hasColumn('ms_users', 'id_user')) {
                DB::statement('ALTER TABLE ms_users CHANGE id_user id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY');
            }

            if (Schema::hasColumn('ms_users', 'nama')) {
                DB::statement('ALTER TABLE ms_users CHANGE nama name VARCHAR(45) NOT NULL');
            }

            if (Schema::hasColumn('ms_users', 'google_id')) {
                $table->dropColumn('google_id');
            }
        });

        if (Schema::hasTable('ms_users')) {
            Schema::rename('ms_users', 'users');
        }

        Schema::table('ms_pelanggan', function (Blueprint $table) {
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }
};

