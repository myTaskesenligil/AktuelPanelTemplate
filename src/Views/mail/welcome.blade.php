
<!DOCTYPE html>
<html lang="tr">
	<!--begin::Head-->
	<head>
        <base href="../../../public/panel-assets/" />
		<title>{{ env('APP_NAME') }}</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<link href="{{ env('APP_URL') }}/public/panel-assets/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="{{ env('APP_URL') }}/public/panel-assets/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="app-blank">
		<!--begin::Theme mode setup on page load-->
		<!--end::Theme mode setup on page load-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<!--begin::Wrapper-->
			<div class="d-flex flex-column flex-column-fluid">
				<!--begin::Body-->
				<div class="scroll-y flex-column-fluid px-10 py-10" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_header_nav" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true" style="background-color:#D5D9E2; --kt-scrollbar-color: #d9d0cc; --kt-scrollbar-hover-color: #d9d0cc">
					<!--begin::Email template-->
					<style>html,body { padding:0; margin:0; font-family: Inter, Helvetica, "sans-serif"; } a:hover { color: #009ef7; }</style>
					<div id="#kt_app_body_content" style="background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;">
						<div style="background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 24px; margin:40px auto; max-width: 600px;">
							<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" height="auto" style="border-collapse:collapse">
								<tbody>
									<tr>
										<td align="center" valign="center" style="text-align:center; padding-bottom: 10px">
											<!--begin:Email content-->
											<div style="text-align:center; margin:0 15px 34px 15px">
                                                @php
                                                    $logo = env('APP_URL').'/public/panel-assets/assets/media/images/ahbv-logo-kirmizi.png';
                                                    $image = env('APP_URL').'/public/panel-assets/assets/media/email/icon-positive-vote-1.svg';
                                                    $logoFile = file_get_contents($logo);
                                                    $imageFile = file_get_contents($image);
                                                    $logoBase64 = base64_encode($logoFile);
                                                    $imageBase64 = base64_encode($imageFile);
                                                @endphp
												<!--begin:Logo-->
												<div style="margin-bottom: 10px">
													<a href="{{ env('APP_URL') }}" rel="noopener" target="_blank">
														<img alt="Logo" src="data:image/png;base64,{{ $logoBase64 }}" style="height: 50px" />
													</a>
												</div>
												<!--end:Logo-->
												<!--begin:Media-->
												<div style="margin-bottom: 15px">
													<img alt="Logo" src="data:image/svg+xml;base64,{{ $imageBase64 }}" />
												</div>
												<!--end:Media-->
												<!--begin:Text-->
												<div style="font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;">
													<p style="margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700">Sayın {{ $user->name }} {{ $user->surname }}</p>
													<p style="color:#7E8299; margin: 20px 50px 20px 50px">{{ $text }}</p>
												</div>
												<!--end:Text-->
												<!--begin:Action-->
												<a href="{{ url('/panel/create-password/'.urlencode($url)) }}" style="background-color:#50cd89; border-radius:6px;display:inline-block; padding:11px 19px; color: #FFFFFF; font-size: 14px; font-weight:500; text-decoration: none">Şifre oluşturma bağlantısı</a>
												<!--begin:Action-->
											</div>
											<!--end:Email content-->
										</td>
									</tr>

									<tr>
										<td align="center" valign="center" style="font-size: 13px; text-align:center; padding: 0 10px 10px 10px; font-weight: 500; color: #A1A5B7; font-family:Arial,Helvetica,sans-serif">
											<p style="color:#181C32; font-size: 16px; font-weight: 600; margin-bottom:9px">İletişim</p>
											<p style="margin-bottom:2px">0(312) 546 0100 | bilgi@hbv.edu.tr</p>
										</td>
									</tr>
									<tr style="border-top: 1px solid #D5D9E2; margin-top:10px">
										<td align="center" valign="center" style="font-size: 13px; padding:20px 15px 0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif">
											<p>&copy; Tüm hakları saklıdır | Ankara Hacı Bayram Veli Üniversitesi - BİDB
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<!--end::Email template-->
				</div>
				<!--end::Body-->
			</div>
			<!--end::Wrapper-->
		</div>
		<!--end::Root-->
		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="{{ env('APP_URL') }}/public/panel-assets/assets/plugins/global/plugins.bundle.js"></script>
		<script src="{{ env('APP_URL') }}/public/panel-assets/assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>
