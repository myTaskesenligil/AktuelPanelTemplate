<?php

namespace MyVendor\MyPackage;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AktuelPanelTemplateServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Paketin kayıt işlemleri
        // Middleware'i kaydet
        $this->app['router']->aliasMiddleware('check.module.permission', \MyVendor\MyPackage\Http\Middleware\CheckModulePermission::class);
    }


    public function boot()
    {
        // View'leri alt klasörlerle kaydet
        $this->loadViewsFrom(__DIR__.'/Views', 'my-package');

        // Assets'leri yayınla
        $this->publishes([
            __DIR__.'/../assets' => public_path('vendor/my-package'),
        ]);

        // .htaccess ve server.php dosyalarını yayınla
        $this->publishes([
            __DIR__.'/../.htaccess' => base_path('.htaccess'),
            __DIR__.'/../server.php' => base_path('server.php'),
        ]);

        // Migrations yükle
        $this->loadMigrationsFrom(__DIR__.'/../migrations');

        // Web rotalarını yükle
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        // Panel rotalarını belirli bir prefix ile yükle
        Route::prefix('panel')->middleware('web')->group(function () {
            Route::middleware(['auth', 'check.module.permission'])->group(__DIR__.'/../routes/panel.php');
        });
    }
}

