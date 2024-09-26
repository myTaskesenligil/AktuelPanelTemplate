<?php

namespace Myusuf\AktuelPanelTemplate;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AktuelPanelTemplateServiceProvider extends ServiceProvider
{
    public function register()
    {

    }


    public function boot()
    {
        // Paketinizin asset ve konfigürasyon dosyalarını kopyalayan artisan komutunu burada tanımlarız.
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\InstallAktuelPanelTemplate::class,
            ]);
        }
    }
}

