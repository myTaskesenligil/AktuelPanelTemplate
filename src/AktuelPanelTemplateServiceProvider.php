<?php

namespace Myusuf\AktuelPanelTemplate;

use Illuminate\Support\ServiceProvider;
use Myusuf\AktuelPanelTemplate\Console\Commands\InstallAktuelPanelTemplate;

class AktuelPanelTemplateServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Komutları kaydedelim
        $this->commands([
            InstallAktuelPanelTemplate::class,
        ]);
    }

    public function boot()
    {
        // Diğer boot işlemleri burada olabilir
    }
}
