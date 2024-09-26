<!DOCTYPE html>
<html lang="tr">
<!--begin::Head-->
<head>
    <title>{{ env('APP_NAME') }} | Yönetim Paneli</title>
    <meta name="robots" content="noindex">
    <meta name=”googlebot” content=”noindex”>
    <meta charset="utf-8" />
    <meta name="description" content="{{ env('APP_NAME') }} | Yönetim Paneli" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="tr_TR" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ env('APP_NAME') }} | Yönetim Paneli" />
    <meta property="og:url" content="{{ env('APP_URL') }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }} | Yönetim Paneli" />
{{--    <link rel="shortcut icon" href="{{asset('panel-assets')}}/assets/media/images/ahbv-icon.png" />--}}
    <link rel="icon" href="{{asset('site-assets')}}/images/favicon.ico">
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{asset('panel-assets')}}/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('panel-assets')}}/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{asset('panel-assets')}}/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('panel-assets')}}/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center bgi-no-repeat">
<!--begin::Theme mode setup on page load-->
<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
<!--end::Theme mode setup on page load-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <!--begin::Page bg image-->
    <div class="d-flex flex-column flex-column-fluid flex-lg-row">
        <!--begin::Aside-->
        <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
            <!--begin::Aside-->
            <div class="d-flex flex-center flex-lg-start flex-column">
                <!--begin::Logo-->
                <a href="{{route('index')}}" class="mb-7">
                    <img alt="Logo" src="{{asset('panel-assets')}}/assets/media/images/ahbv-logo-beyaz.png" />
                </a>
                <!--end::Logo-->
                <!--begin::Title-->
                <h2 class="text-white fw-normal m-0">{{ env('APP_NAME') }} - Yönetim Paneli</h2>
                <!--end::Title-->
            </div>
            <!--begin::Aside-->
        </div>
        <!--begin::Aside-->

        @yield('content')
    </div>
    <!--end::Authentication - Sign-in-->
</div>
<!--end::Page bg image-->
<!--begin::Authentication - Sign-in -->
<style>body { background-image: url('{{asset('panel-assets')}}/assets/media/auth/bg4.jpg'); } [data-bs-theme="dark"] body { background-image: url('{{asset('panel-assets')}}/assets/media/auth/bg4-dark.jpg'); }</style>
<!--end::Root-->
<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="{{asset('panel-assets')}}/assets/plugins/global/plugins.bundle.js"></script>
<script src="{{asset('panel-assets')}}/assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Custom Javascript(used for this page only)-->
<!--end::Custom Javascript-->
<!--end::Javascript-->
<script>
    $('.showHidePass').on('click', function () {
        // $('.password').attr('type') == 'password' ? $('.password').attr('type','text') : $('.password').attr('type', 'password');
        $(this).parent('div').find('input').attr('type') == 'password' ? $('.password').attr('type','text') : $('.password').attr('type', 'password');
        $(this).parent('div').find('input').attr('type') == 'text' ? $(this).find('i').removeClass('bi-eye-slash-fill').addClass('bi-eye-fill') : $(this).find('i').removeClass('bi-eye-fill').addClass('bi-eye-slash-fill');
        // $(this).is(':checked') ? $('.password').attr('type', 'text') : $('.password').attr('type', 'password');
    })
</script>
@yield('custom-js-codes')
</body>
<!--end::Body-->
</html>
