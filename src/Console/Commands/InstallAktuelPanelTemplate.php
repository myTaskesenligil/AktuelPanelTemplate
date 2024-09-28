<?php

namespace Myusuf\AktuelPanelTemplate\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallAktuelPanelTemplate extends Command
{
    // Komutun ismi ve açıklaması
    protected $signature = 'aktuelpanel:install';
    protected $description = 'Aktuel Panel Template dosyalarını ilgili yerlere kopyalar';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Aktuel Panel Template dosyaları kopyalanıyor...');

        // Assets dosyalarını kopyala
        $this->copyDirectory(__DIR__.'/../../../assets/panel-assets', public_path('/'));

        // .htaccess ve server.php dosyalarını kopyala
        $this->copyFile(__DIR__.'/../../../.htaccess', base_path('.htaccess'));
        $this->copyFile(__DIR__.'/../../../server.php', base_path('server.php'));

        // Database klasörünü kopyala
        $this->copyDirectory(__DIR__ . '/../../../database/migrations', database_path('migrations'));
        $this->copyDirectory(__DIR__ . '/../../../database/seeders', database_path('seeders'));

        // Routes klasöründen web.php ve panel.php dosyalarını kopyala
        $this->copyFile(__DIR__.'/../../../routes/web.php', base_path('routes/web.php'));
        $this->copyFile(__DIR__.'/../../../routes/panel.php', base_path('routes/panel.php'));

        // Controllers, Middleware, Models, Services ve Views klasörlerini kopyala
        $this->copyDirectory(__DIR__.'/../../../src/Http/Controllers', app_path('Http/Controllers'));
        $this->copyDirectory(__DIR__.'/../../../src/Http/Middleware', app_path('Http/Middleware'));
        $this->copyDirectory(__DIR__.'/../../../src/Models', app_path('Models'));
        $this->copyDirectory(__DIR__.'/../../../src/Services', app_path('Services'));
        $this->copyDirectory(__DIR__.'/../../../src/Views', resource_path('views'));
        $this->copyDirectory(__DIR__.'/../../../src/lang', resource_path('lang'));

        $this->info('Aktuel Panel Template başarıyla yüklendi.');
    }

    private function copyDirectory($source, $destination)
    {
        if (File::isDirectory($source)) {
            File::copyDirectory($source, $destination);
            $this->info("Dizin kopyalandı: {$source} -> {$destination}");
        } else {
            $this->error("Dizin bulunamadı: {$source}");
        }
    }

    private function copyFile($source, $destination)
    {
        if (File::exists($source)) {
            File::copy($source, $destination);
            $this->info("Dosya kopyalandı: {$source} -> {$destination}");
        } else {
            $this->error("Dosya bulunamadı: {$source}");
        }
    }
}
