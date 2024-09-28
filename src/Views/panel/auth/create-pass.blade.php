@extends('panel.layout.login-screen')

@section('content')
    <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
        <div class="bg-body d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
            <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">

                <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" id="kt_new_password_form">
                    <input type="hidden" name="id" value="{{ $id }}">
                    <div class="text-center mb-10">
                        <h1 class="text-gray-900 fw-bolder mb-3">
                            Yeni Şifre Oluştur
                        </h1>
                        <h4 class="text-muted">{{ $adSoyad }}</h4>
                    </div>

                    <div class="fv-row mb-8 fv-plugins-icon-container" data-kt-password-meter="true">
                        <div class="mb-1">
                            <div class="position-relative mb-3">
                                <input class="form-control bg-transparent password" type="password" placeholder="Şifre" name="password" autocomplete="off">

                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                    <i class="ki-duotone ki-eye-slash fs-2"></i>
                                    <i class="ki-duotone ki-eye fs-2 d-none"></i>
                                </span>

                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2 showHidePass">
                                    <i class="bi bi-eye-slash-fill"></i>
                                </span>
                            </div>

                            <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                            </div>
                        </div>

                        <div class="text-muted">
                            Şifreniz en az 8 karakter uzunluğunda ve en az bir büyük harf, bir küçük harf ve bir rakam içermelidir.
                        </div>
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    </div>

                    <div class="fv-row mb-8 fv-plugins-icon-container">
                        <input type="password" placeholder="Şifre (Tekrar)" name="password_confirmation" autocomplete="off" class="form-control bg-transparent password">
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>

                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2 showHidePass">
                            <i class="bi bi-eye-slash-fill"></i>
                        </span>
                    </div>

                    <div class="d-grid mb-10">
                        <button type="submit" id="kt_new_password_submit" class="btn btn-primary">

                            <span class="indicator-label">Kaydet</span>

                            <span class="indicator-progress">
                                Kaydediliyor...    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
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
        $('#kt_new_password_form').on('submit', function (e) {
            e.preventDefault();

            $('#indicatorLoader').css('display','block');
            $.ajax({
                type: "POST",
                url: "{{ route('save-password') }}",
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
