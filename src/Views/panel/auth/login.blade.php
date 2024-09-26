@extends('panel.layout.login-screen')

@section('content')
    <!--begin::Body-->
    <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
        <!--begin::Card-->
        <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
            <!--begin::Wrapper-->
            <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                <!--begin::Form-->
                <form action="{{route('index')}}" method="POST" class="form w-100" novalidate="novalidate" id="kt_sign_in_form">
                    @csrf
                    <!--begin::Heading-->
                    <div class="text-center mb-11">
                        <!--begin::Title-->
                        <h1 class="text-gray-900 fw-bolder mb-3">Giriş Yap</h1>
                        <!--end::Title-->
                        <!--begin::Subtitle-->
                        <!--end::Subtitle=-->
                    </div>
                    <!--begin::Heading-->
                    <!--begin::Input group=-->
                    <div class="fv-row mb-8">
                        <!--begin::Email-->
                        <input type="text" placeholder="E-Posta" name="email" autocomplete="off" class="form-control bg-transparent" autofocus/>
                        <!--end::Email-->
                    </div>
                    <!--end::Input group=-->
                    <div class="fv-row mb-3">
                        <!--begin::Password-->
{{--                        <input type="password" placeholder="Şifre" name="password" autocomplete="off" class="form-control bg-transparent password" />--}}
{{--                        <!--end::Password-->--}}
{{--                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2 showHidePass">--}}
{{--                            <i class="bi bi-eye-slash-fill"></i>--}}
{{--                        </span>--}}
                        <div class="position-relative mb-3">
                            <input class="form-control bg-transparent password" type="password" placeholder="Şifre" name="password" autocomplete="off" />
                            <!--begin::Visibility toggle-->
                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2 showHidePass">
                                <i class="bi bi-eye-slash-fill"></i>
                            </span>
                            <!--end::Visibility toggle-->
                        </div>
                    </div>
                    <!--end::Input group=-->
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                        <div></div>
                        <!--begin::Link-->
                        <a href="{{ route('forgot-password') }}" class="link-primary">Şifremi unuttum</a>
                        <!--end::Link-->
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::Submit button-->
                    <br>
                    <div class="d-grid mb-10">
                        <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                            <!--begin::Indicator label-->
                            <span class="indicator-label">Giriş Yap</span>
                            <!--end::Indicator label-->
                            <!--begin::Indicator progress-->
                            <span class="indicator-progress">Lütfen bekleyiniz...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            <!--end::Indicator progress-->
                        </button>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->
            <!--begin::Footer-->
            <div class="d-flex flex-stack px-lg-20">
                <!--begin::Links-->
                <div class="d-flex fw-semibold text-primary fs-base gap-5 text-center">
                    <div class="text-gray-500 text-center fw-semibold fs-6">AHBV - Bilgi İşlem Daire Başkanlığı | © {{ date('Y') }}
                    </div>
                    <!--end::Links-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Body-->
@endsection

