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
        // 1. Tambah kolom ke tabel users
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('customer')->after('password');
            }
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable()->after('role');
            }
            if (!Schema::hasColumn('users', 'address')) {
                $table->text('address')->nullable()->after('phone');
            }
            if (!Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar')->nullable()->after('address');
            }
        });

        // 2. Tambah kolom ke tabel products
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'category')) {
                $table->string('category')->default('shoes')->after('name');
            }
            if (!Schema::hasColumn('products', 'sub_category')) {
                $table->string('sub_category')->nullable()->after('category');
            }
            if (!Schema::hasColumn('products', 'stock')) {
                $table->integer('stock')->default(15)->after('price');
            }
            if (!Schema::hasColumn('products', 'badge')) {
                $table->string('badge')->nullable()->after('stock');
            }
            if (!Schema::hasColumn('products', 'badge_type')) {
                $table->string('badge_type')->nullable()->default('cyan')->after('badge');
            }
            if (!Schema::hasColumn('products', 'sizes')) {
                $table->text('sizes')->nullable()->after('badge_type');
            }
        });

        // 3. Tambah kolom ke tabel transactions
        Schema::table('transactions', function (Blueprint $table) {
            if (!Schema::hasColumn('transactions', 'user_id')) {
                $table->foreignId('user_id')->nullable()->after('invoice_code')->constrained('users')->nullOnDelete();
            }
            if (!Schema::hasColumn('transactions', 'size')) {
                $table->string('size')->nullable()->after('quantity');
            }
            if (!Schema::hasColumn('transactions', 'status')) {
                $table->string('status')->default('diproses')->after('total_price');
            }
            if (!Schema::hasColumn('transactions', 'resi')) {
                $table->string('resi')->nullable()->after('status');
            }
            if (!Schema::hasColumn('transactions', 'payment_method')) {
                $table->string('payment_method')->default('QRIS Instant')->after('resi');
            }
            if (!Schema::hasColumn('transactions', 'notes')) {
                $table->text('notes')->nullable()->after('payment_method');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'phone', 'address', 'avatar']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['category', 'sub_category', 'stock', 'badge', 'badge_type']);
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'status', 'resi', 'payment_method', 'notes']);
        });
    }
};
