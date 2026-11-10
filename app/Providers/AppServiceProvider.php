<?php

namespace App\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::component('components.layouts.admin', 'layouts.admin');

        // Otomatis pastikan kolom `sizes` dan `size` tersedia di database MySQL
        try {
            if (Schema::hasTable('products') && !Schema::hasColumn('products', 'sizes')) {
                Schema::table('products', function (Blueprint $table) {
                    $table->text('sizes')->nullable()->after('badge_type');
                });
            }

            if (Schema::hasTable('transactions') && !Schema::hasColumn('transactions', 'size')) {
                Schema::table('transactions', function (Blueprint $table) {
                    $table->string('size')->nullable()->after('quantity');
                });
            }
        } catch (\Throwable $e) {
            // Abaikan jika koneksi db belum aktif saat build
        }
    }
}
