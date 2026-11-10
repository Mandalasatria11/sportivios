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
        // 1. Tambah kolom sizes ke tabel products jika belum ada
        if (Schema::hasTable('products') && !Schema::hasColumn('products', 'sizes')) {
            Schema::table('products', function (Blueprint $table) {
                $table->text('sizes')->nullable()->after('badge_type');
            });
        }

        // 2. Tambah kolom size ke tabel transactions jika belum ada
        if (Schema::hasTable('transactions') && !Schema::hasColumn('transactions', 'size')) {
            Schema::table('transactions', function (Blueprint $table) {
                $table->string('size')->nullable()->after('quantity');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('products') && Schema::hasColumn('products', 'sizes')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('sizes');
            });
        }

        if (Schema::hasTable('transactions') && Schema::hasColumn('transactions', 'size')) {
            Schema::table('transactions', function (Blueprint $table) {
                $table->dropColumn('size');
            });
        }
    }
};
