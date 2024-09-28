<!DOCTYPE html>
<html lang="tr">
<head>
    <title>{{ env('APP_NAME') }} | Yönetim Paneli</title>
    <meta charset="utf-8" />
    <meta name="description" content="{{ env('APP_NAME') }} | Yönetim Paneli" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="tr_TR" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ env('APP_NAME') }} | Yönetim Paneli" />
    <meta property="og:url" content="{{ env('APP_URL') }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }} | Yönetim Paneli" />
    <link rel="shortcut icon" href="{{ asset('assets/media/images/kodaktuel-icon.png') }}" />
    <link rel="icon" href="{{asset('site-assets')}}/images/favicon.ico">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />

    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
</head>

<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center bgi-no-repeat">

<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>

<div class="d-flex flex-column flex-root" id="kt_app_root">
    <div class="d-flex flex-column flex-column-fluid flex-lg-row">
        <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
            <div class="d-flex flex-center flex-lg-start flex-column">
                <a href="{{ route('index') }}" class="mb-7">
                    <img alt="Logo" src="{{ asset('assets/media/images/kodaktuel-white-logo-transparent.png') }}" style="width: 500px"/>
                </a>
                <h2 class="text-white fw-normal m-0">{{ env('APP_NAME') }} - Yönetim Paneli</h2>
            </div>
        </div>

        @yield('content')
    </div>
</div>

<style>body { background-image: url('{{ asset('assets/media/auth/bg4.jpg') }}'); } [data-bs-theme="dark"] body { background-image: url('{{ asset('assets/media/auth/bg4-dark.jpg') }}'); }</style>

<script>var hostUrl = "assets/";</script>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>

<script>
    $('.showHidePass').on('click', function () {
        $(this).parent('div').find('input').attr('type') == 'password' ? $('.password').attr('type','text') : $('.password').attr('type', 'password');
        $(this).parent('div').find('input').attr('type') == 'text' ? $(this).find('i').removeClass('bi-eye-slash-fill').addClass('bi-eye-fill') : $(this).find('i').removeClass('bi-eye-fill').addClass('bi-eye-slash-fill');
    })
</script>
@yield('custom-js-codes')
</body>
</html>
