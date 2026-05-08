<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Str;
use Dedoc\Scramble\Scramble;
use Illuminate\Routing\Route;

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
        // Gate untuk Hak Akses Tampilan Web (Tugas Sebelumnya)
        Gate::define('export-product', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('access-category', function (User $user) {
            return $user->role === 'admin';
        });

        // ---------------------------------------------------
        // Konfigurasi Scramble API Documentation
        // ---------------------------------------------------
        
        // Memfilter agar Scramble hanya membaca rute yang berawalan 'api/'
        Scramble::configure()
            ->routes(function (Route $route) {
                return Str::startsWith($route->uri, 'api/');
            });

        // Mengizinkan siapa saja untuk melihat halaman dokumentasi API
        Gate::define('viewApiDocs', function (?User $user) {
            return true;
        });
    }
}