<p align="center"><a href="https://kodaktuel.com" target="_blank"><img src="https://kodaktuel.com/assets/images/logo/color-logo-transparent.png" width="400" alt="Laravel Logo"></a></p>

<p align="center">
Aktüel Panel Template (v.1.0.0)
</p>

## Paket Hakkında

**Aktüel Panel Template** projelerimizde kullandığımız yönetim panelinin hazır halini sunmaktadır. Paket içerisinde aşağıdaki yapı ve modüller otomatik olarak projenize yüklenmektedir.

- Kullanıcı girişi ve şifremi unuttum sayfası,
- Dinamik menü yapısı ve yönetimi,
- Sayfa yetkilendirme ve erişim kontrol yapısı
- Projenin URL yapısında public dizininin kaldırılması,
- Loglama yapısı  ve log kayıtlarının görüntülenme sayfası,
- ve ilgili sayfaların rota ve migration dosyaları.

## Paket Kurulumu

1. Projenizde ```composer.json``` dosyasına aşağıdaki iki kod bloğunu ekleyin.

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/myTaskesenligil/AktuelPanelTemplate"
    }
],
```

```json
"require": {
    "myusuft/aktuelpaneltemplate": "dev-main"
    ...    
},
```
Aşağıdaki komutu projenizin kök dizininde terminal içerisinde çalıştırın
```bash
composer require myusuft/aktuelpaneltemplate
```
Paket yüklendikten sonra aşağıki komut ile paket içerisindeki dosya ve klasörleri projenize kopyalayın
```bash
php artisan aktuelpanel:install
```

## Geliştirici

Paket geliştiricisi **[Kod Aktüel Teknoloji Ltd. Şti.](https://kodaktuel.com)**'dir
