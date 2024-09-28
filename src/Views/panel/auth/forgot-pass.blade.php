@extends('panel.layout.login-screen')

@section('content')
    <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
        <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
            <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">

                <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" id="kt_password_reset_form">
                    <div class="text-center mb-10">
                        <h1 class="text-gray-900 fw-bolder mb-3">
                            Şifremi Unuttum
                        </h1>

                        <div class="text-gray-500 fw-semibold fs-6">
                            Sisteme kayıtlı olan e-posta adresinizi giriniz.
                        </div>
                    </div>

                    <div class="fv-row mb-8 fv-plugins-icon-container">
                        <input type="text" placeholder="E-Posta" name="email" autocomplete="off" class="form-control bg-transparent">
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>

                    <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                        <a href="{{ route('index') }}" class="btn btn-light">Geri Dön</a>

                        <button type="submit" id="kt_password_reset_submit" class="btn btn-primary me-4">
                            <span class="indicator-label">Gönder</span>

                            <span class="indicator-progress">
                                Please wait...    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>

            <div>
                <img src="{{asset('assets/media/images/kodaktuel-color-logo-transparent.png')}}" alt="" style="width: 150px; display: block; margin: 0 auto;">
            </div>
        </div>
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
