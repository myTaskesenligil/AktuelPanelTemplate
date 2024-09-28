@extends('panel.layout.login-screen')

@section('content')
    <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
        <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
            <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
                <form action="{{ route('index') }}" method="POST" class="form w-100" novalidate="novalidate" id="kt_sign_in_form">
                    @csrf

                    <div class="text-center mb-11">
                        <h1 class="text-gray-900 fw-bolder mb-3">Giriş Yap</h1>
                    </div>

                    <div class="fv-row mb-8">
                        <input type="text" placeholder="E-Posta" name="email" autocomplete="off" class="form-control bg-transparent" autofocus/>
                    </div>

                    <div class="fv-row mb-3">
                        <div class="position-relative mb-3">
                            <input class="form-control bg-transparent password" type="password" placeholder="Şifre" name="password" autocomplete="off" />
                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2 showHidePass">
                                <i class="bi bi-eye-slash-fill"></i>
                            </span>
                        </div>
                    </div>

                    <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                        <div></div>
                        <a href="{{ route('forgot-password') }}" class="link-primary">Şifremi unuttum</a>
                    </div>

                    <br>
                    <div class="d-grid mb-10">
                        <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                            <span class="indicator-label">Giriş Yap</span>
                            <span class="indicator-progress">Lütfen bekleyiniz...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
            </div>

            <div>
                <img src="{{asset('assets/media/images/kodaktuel-color-logo-transparent.png')}}" alt="" style="width: 150px; display: block; margin: 0 auto;">
            </div>
        </div>
@endsection

