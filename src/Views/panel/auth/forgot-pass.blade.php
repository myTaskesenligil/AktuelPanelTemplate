@extends('panel.layout.login-screen')

@section('content')
    <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
        <!--begin::Card-->
        <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
            <!--begin::Wrapper-->
            <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">

                <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" id="kt_password_reset_form">
                    <!--begin::Heading-->
                    <div class="text-center mb-10">
                        <!--begin::Title-->
                        <h1 class="text-gray-900 fw-bolder mb-3">
                            Şifremi Unuttum
                        </h1>
                        <!--end::Title-->

                        <!--begin::Link-->
                        <div class="text-gray-500 fw-semibold fs-6">
                            Sisteme kayıtlı olan e-posta adresinizi giriniz.
                        </div>
                        <!--end::Link-->
                    </div>
                    <!--begin::Heading-->

                    <!--begin::Input group--->
                    <div class="fv-row mb-8 fv-plugins-icon-container">
                        <!--begin::Email-->
                        <input type="text" placeholder="E-Posta" name="email" autocomplete="off" class="form-control bg-transparent">
                        <!--end::Email-->
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>

                    <!--begin::Actions-->
                    <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                        <a href="{{ route('index') }}" class="btn btn-light">Geri Dön</a>

                        <button type="submit" id="kt_password_reset_submit" class="btn btn-primary me-4">
                            <span class="indicator-label">Gönder</span>

                            <span class="indicator-progress">
                                Please wait...    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
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
        </div>
        <!--end::Card-->
    </div>
@endsection

@section('custom-js-codes')
    <script>
        $('#kt_password_reset_form').on('submit', function (e) {
            e.preventDefault();

            $('#indicatorLoader').css('display','block');
            $.ajax({
                type: "POST",
                url: "{{ route('forgot-password') }}",
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                data: $(this).serialize(),
                success: function(data)
                {
                    $('#indicatorLoader').css('display','none');
                    Swal.fire({
                        title: data.title,
                        text: data.desc,
                        icon: data.type,
                    });
                    if(data.type == "success"){
                        setTimeout(() => {
                            window.location = "{{ route('index') }}"
                        }, 1000);
                    }
                },
                error: function (data) {
                    $('#indicatorLoader').css('display','none');
                    Swal.fire({
                        title: "Ölümcül Hata",
                        icon: "error",
                    });
                }
            })
        })
    </script>
@endsection
