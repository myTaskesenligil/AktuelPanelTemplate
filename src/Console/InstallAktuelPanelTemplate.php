<?php

namespace Myusuf\AktuelPanelTemplate\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class InstallAktuelPanelTemplate extends Command
{
    protected $signature = 'aktuel:install';
    protected $description = 'Aktuel Panel Template dosyalarını projeye kopyalar.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $filesystem = new Filesystem();

        // Klasörlerin kopyalanacağı yerler
        $this->copyDirectory('assets', public_path('assets'));
        $this->copyDirectory('migrations', database_path('migrations'));
        $this->copyDirectory('routes', base_path('routes'));
        $this->copyDirectory('src/Http/Controllers', app_path('Http/Controllers'));
        $this->copyDirectory('src/Http/Middleware', app_path('Http/Middleware'));
        $this->copyDirectory('src/Models', app_path('Models'));
        $this->copyDirectory('src/Services', app_path('Services'));
        $this->copyDirectory('src/Views', resource_path('views'));

        // Kök dizine taşınacak dosyalar
        $this->copyFile('.htaccess', base_path('.htaccess'));
        $this->copyFile('server.php', base_path('server.php'));

        $this->info('Aktuel Panel Template başarıyla yüklendi.');
    }

    private function copyDirectory($src, $dest)
    {
        $filesystem = new Filesystem();
        if ($filesystem->isDirectory(__DIR__ . '/../../../' . $src)) {
            $filesystem->copyDirectory(__DIR__ . '/../../../' . $src, $dest);
            $this->info($src . ' klasörü kopyalandı.');
        }
    }

    private function copyFile($src, $dest)
    {
        $filesystem = new Filesystem();
        if ($filesystem->exists(__DIR__ . '/../../../' . $src)) {
            $filesystem->copy(__DIR__ . '/../../../' . $src, $dest);
            $this->info($src . ' dosyası kopyalandı.');
        }
    }
}
