@extends('panel.layout.app')

@section('content')
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Dashboard</h1>
                <!--end::Title-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Secondary button-->
                {{-- <a href="#" class="btn btn-sm fw-bold btn-secondary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Rollover</a> --}}
                <!--end::Secondary button-->
                <!--begin::Primary button-->
                {{-- <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_new_target">Add Target</a> --}}
                <!--end::Primary button-->
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Row-->
            <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
                <!--begin::Alert-->
                <div class="alert alert-dismissible bg-light-primary d-flex flex-center flex-column py-10 px-10 px-lg-20 mb-10">

                    <!--begin::Icon-->
                    <i class="ki-duotone ki-information-5 fs-5tx text-primary mb-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                    <!--end::Icon-->

                    <!--begin::Wrapper-->
                    <div class="text-center">
                        <!--begin::Title-->
                        <h1 class="fw-bold mb-5">Hoşgeldiniz, Sayın {{ session('name').' '.session('surname') }}</h1>
                        <!--end::Title-->

                        <!--begin::Separator-->
                        <div class="separator separator-dashed border-danger opacity-25 mb-5"></div>
                        <!--end::Separator-->

                        <!--begin::Content-->
                        <div class="mb-9 text-gray-900">
                            {{ env('APP_NAME') }} platformu yönetim paneline hoş geldiniz. Bu panel üzerinden alan adlarına ait bilgileri yönetebilirsiniz.
                            <br>
                            Sistem ile alakalı her türlü soru ve sorununuzda bizlerle iletişime geçebilirsiniz.
                        </div>

                        <!--begin::Buttons-->
                        {{--                    <div class="d-flex flex-center flex-wrap">--}}
                        {{--                        <a href="#" class="btn btn-outline btn-outline-danger btn-active-danger m-2">Cancel</a>--}}
                        {{--                        <a href="#" class="btn btn-danger m-2">Ok, I got it</a>--}}
                        {{--                    </div>--}}
                        <!--end::Buttons-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Alert-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->

@endsection
