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
<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
	<div class="app-page flex-column flex-column-fluid" id="kt_app_page">

		@include('panel.inc.header')

		<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
			@include('panel.inc.sidebar')

			<div class="app-main flex-column flex-row-fluid" id="kt_app_main">

				<div class="d-flex flex-column flex-column-fluid">
					@yield('content')
				</div>

				@include('panel.inc.footer')

			</div>
		</div>
	</div>
</div>

<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
	<i class="ki-duotone ki-arrow-up">
		<span class="path1"></span>
		<span class="path2"></span>
	</i>
</div>

<script>var hostUrl = "assets/";</script>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>

<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}/"></script>

<script src="{{ asset('assets/js/loader.js') }}"></script>
<script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
<script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/create-app.js') }}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/new-target.js') }}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>

<script>
	$("#custom-datatable").DataTable({
		"dom":
				"<'row mb-2'" +
				"<'col-sm-6 d-flex align-items-center justify-conten-start dt-toolbar'l>" +
				"<'col-sm-6 d-flex align-items-center justify-content-end dt-toolbar'f>" +
				">" +

				"<'table-responsive'tr>" +

				"<'row'" +
				"<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
				"<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
				">",
		"language": {
			"url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Turkish.json"
		}
	});
</script>
@yield('custom-js-codes')
</body>
</html>
