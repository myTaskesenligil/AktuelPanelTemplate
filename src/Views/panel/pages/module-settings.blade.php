@extends('panel.layout.app')

@section('content')
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Modül Yönetimi</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <a class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#mdlAddData"> <i class="bi bi-plus"></i> Modül Ekle</a>
            <a class="btn btn-sm fw-bold btn-info" data-bs-toggle="modal" data-bs-target="#mdlAddGroup"> <i class="bi bi-people-fill"></i> Grup Ekle</a>
        </div>
    </div>
</div>

<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-bordered gy-5" style="vertical-align: middle;">
                        <thead>
                            <tr>
                                <th>Ana Modül</th>
                                <th>Alt Modül</th>
                                <th>Durum <button class="btn btn-custom btn-sm btn-round" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-inverse" data-bs-title="Modülün aktif/pasif olma durumu">?</button></th>
                                <th>Gösterim <button class="btn btn-custom btn-sm btn-round" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-inverse" data-bs-title="Modülün menü içerisinde gösterilip/gösterilmeyeceği">?</button></th>
                                @foreach($groups as $group)
                                    <th>{{ $group->agName }} <button class="btn btn-custom btn-sm btn-round" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-inverse" data-bs-title="{{ $group->agDesc }}">?</button></th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($modules as $module)
                                <tr>
                                    <td rowspan="{{ $module->childModules->count() + 1 }}">
                                        <div style="display: inline-flex">
                                            <b>{{ $module->amName }}</b>

                                            @if ($module->childModules->count() == 0)
                                                <button onclick="deleteModule('{{ encrypt($module->id) }}')" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-inverse" data-bs-title="Sil"><span class="badge badge-danger"><i class="bi bi-trash3-fill" style="color:white"></i></span></button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @foreach($module->childModules as $childModule)
                                    <tr>
                                        <td>
                                            {{ $childModule->amName }} <i>( <a href="{{ route($childModule->amSlug) }}" target="_blank">{{ $childModule->amSlug }}</a> )</i>

                                            <button onclick="deleteModule('{{ encrypt($childModule->id) }}')" class="btn btn-sm" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-inverse" data-bs-title="Sil"><span class="badge badge-danger"><i class="bi bi-trash3-fill" style="color:white"></i></span></button>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch form-check-custom form-check-solid me-10">
                                                <input class="form-check-input h-20px w-30px" name="chkStatus" onclick="change('status', '{{ encrypt($childModule->id) }}', '', this)" type="checkbox" value="" {{ $childModule->amStatus == 1 ? "checked" : null }}/>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-switch form-check-custom form-check-solid me-10">
                                                <input class="form-check-input h-20px w-30px" name="chkStatus" onclick="change('show', '{{ encrypt($childModule->id) }}', '', this)" type="checkbox" value="" {{ $childModule->amShowMenu ? "checked" : null }}/>
                                            </div>
                                        </td>
                                        @foreach($groups as $group)
                                            <td>
                                                {{-- <i class="bi bi-check-circle-fill" style="color: green" data-toggle="tooltip" data-placement="top" title="Yetkisi Var"></i>
                                                <i class="bi bi-ban-fill" style="color: red" data-toggle="tooltip" data-placement="top" title="Yetkisi Yok"></i> --}}
                                                {{-- @if(checkModulePermission($childModule->id, $group->id))
                                                    <i class="bi bi-check-circle-fill" style="color: green"></i>
                                                @else
                                                    <i class="bi bi-x-circle-fill" style="color: red"></i>
                                                @endif --}}
                                                <div class="form-check form-switch form-check-success form-check-solid me-10">
                                                    <input class="form-check-input h-20px w-30px" onclick="change('group', '{{ encrypt($childModule->id) }}', '{{ encrypt($group->id) }}', this)" type="checkbox" value="1" {{ checkModulePermission($childModule->id, $group->id) ? "checked" : null }} />
                                                </div>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mdlAddData" data-bs-backdrop="static" tabindex-="1" aria-hidden="true" data-bs-focus="false">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold" data-kt-calendar="title">Modül Ekle</h2>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <div class="modal-body py-10 px-lg-17">
                <ul class="nav nav-pills nav-pills-custom mb-3" role="tablist" style="justify-content: space-between">
                    <!--begin::Item-->
                    <li class="nav-item mb-3" role="presentation" style="width:45%">
                        <a style="width: 100%" class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden h-85px pt-5 pb-2 active" id="kt_stats_widget_16_tab_link_1" data-bs-toggle="pill" href="#kt_stats_widget_16_tab_1" aria-selected="true" role="tab">
                            <div class="nav-icon mb-3">
                                <i class="bi bi-square-fill"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                            </div>
                            <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">Ana Modül Ekle</span>
                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                        </a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="nav-item mb-3" role="presentation" style="width:45%">
                        <a style="width: 100%" class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden h-85px pt-5 pb-2" id="kt_stats_widget_16_tab_link_2" data-bs-toggle="pill" href="#kt_stats_widget_16_tab_2" aria-selected="false" role="tab" tabindex="-1">
                            <div class="nav-icon mb-3">
                                <i class="bi bi-subtract"><span class="path1"></span><span class="path2"></span></i>
                            </div>
                            <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">Bağlı Modül Ekle</span>
                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                        </a>
                    </li>
                    <!--end::Item-->
                </ul>

                <div class="tab-content">
                    <!--begin::Tap pane-->
                    <div class="tab-pane fade active show" id="kt_stats_widget_16_tab_1" role="tabpanel" aria-labelledby="kt_stats_widget_16_tab_link_1">
                        <form id="frmAddParentModule" method="POST">
                            <input type="hidden" name="id">
                            @csrf
                            <div class="fv-row mb-9">
                                <label class="fs-6 fw-semibold mb-2 required">Modül Adı</label>
                                <input type="text" class="form-control form-control-solid" placeholder="" name="amName" required/>
                            </div>
                            <div class="fv-row mb-9">
                                <label class="fs-6 fw-semibold mb-2 required">İkon</label>
                                <div class="input-group mb-5">
                                    <span class="input-group-text" id="basic-addon3">bi bi-</span>
                                    <input type="text" class="form-control" name="amIcon" required/>
                                </div>
                                <small>Bootstrap ikonları için uygundur. (<a href="https://icons.getbootstrap.com/" target="_blank">Tüm ikonlar</a>)</small>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" name="amStatus" value="1" id="flexSwitchDefault" checked="checked" />
                                        <label class="form-check-label" for="flexSwitchDefault" style="color:black">
                                            Durum
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" name="amShowMenu" value="1" id="flexSwitchDefault" checked="checked" />
                                        <label class="form-check-label" for="flexSwitchDefault" style="color:black">
                                            Menüde Görünsün
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="separator separator-content my-14">
                                <span class="w-125px text-gray-500 fw-semibold fs-7"></span>
                            </div>
                            <button type="submit" class="btn btn-sm btn-success float-right" style="float: right"> <i class="bi bi-check"></i> Kaydet</button>
                        </form>
                    </div>
                    <!--end::Tap pane-->

                    <!--begin::Tap pane-->
                    <div class="tab-pane fade" id="kt_stats_widget_16_tab_2" role="tabpanel" aria-labelledby="kt_stats_widget_16_tab_link_2">
                        <form id="frmAddChildModule" method="POST">
                            <input type="hidden" name="id">
                            @csrf
                            <div class="fv-row mb-9">
                                <label class="fs-6 fw-semibold mb-2 required">Ana Modül</label>
                                <select name="amParentMenuId" id="" class="form-select form-select-solid" data-control="select2" required>
                                    <option value="">Seçim Yapınız</option>
                                    @foreach ($modules as $module)
                                        <option value="{{$module->id}}">{{$module->amName}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="fv-row mb-9">
                                <label class="fs-6 fw-semibold mb-2 required">Bağlı Modül Adı</label>
                                <input type="text" class="form-control form-control-solid" placeholder="" name="amName" required/>
                            </div>
                            <div class="fv-row mb-9">
                                <label class="fs-6 fw-semibold mb-2 required">URL</label>
                                <input type="text" class="form-control form-control-solid" placeholder="" name="amSlug" required/>
                                <small>Sadece path değerini giriniz. (Ör: <b>kullanicilar</b> )</small>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" name="amStatus" value="1" id="flexSwitchDefault" checked="checked" />
                                        <label class="form-check-label" for="flexSwitchDefault" style="color:black">
                                            Durum
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" name="amShowMenu" value="1" id="flexSwitchDefault" checked="checked" />
                                        <label class="form-check-label" for="flexSwitchDefault" style="color:black">
                                            Menüde Görünsün
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="separator separator-content my-14">
                                <span class="w-125px text-gray-500 fw-semibold fs-7"></span>
                            </div>
                            <button type="submit" class="btn btn-sm btn-success float-right" style="float: right"> <i class="bi bi-check"></i> Kaydet</button>
                        </form>
                    </div>
                    <!--end::Tap pane-->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mdlAddGroup" data-bs-backdrop="static" tabindex-="1" aria-hidden="true" data-bs-focus="false">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold" data-kt-calendar="title">Grup Ekle</h2>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <div class="modal-body py-10 px-lg-17">

                <form id="frmAddGroup" method="POST">
                    <input type="hidden" name="id">
                    @csrf
                    <div class="fv-row mb-9">
                        <label class="fs-6 fw-semibold mb-2 required">Grup Adı</label>
                        <input type="text" class="form-control form-control-solid" placeholder="" name="agName" required/>
                    </div>
                    <div class="fv-row mb-9">
                        <label class="fs-6 fw-semibold mb-2 required">Grup Açıklaması</label>
                        <input type="text" class="form-control form-control-solid" placeholder="" name="agDesc" required/>
                    </div>
                    <div class="separator separator-content my-14">
                        <span class="w-125px text-gray-500 fw-semibold fs-7"></span>
                    </div>
                    <button type="submit" class="btn btn-sm btn-success float-right" style="float: right"> <i class="bi bi-check"></i> Kaydet</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-js-codes')
<script>

    function change(name, id, group_id, elem) {
        var csrfToken = "{{ csrf_token() }}";
        $.ajax({
            type: "POST",
            headers: { 'X-CSRF-TOKEN': csrfToken },
            url: "{{ route('module.switch') }}",
            data: { 'inputName' : name, 'id' : id, 'group_id' : group_id, 'val' : $(elem).is(':checked') },
            success: function(data)
            {
                toastr[data.type](data.title)

                toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
                }
            },
            error: function (data) {
                Swal.fire({
                    title: "Ölümcül Hata",
                    icon: "error",
                });
            }
        })
    }

    function deleteModule(id){
        var csrfToken = "{{ csrf_token() }}";

        Swal.fire({
            title: "Dikkat",
            text: "Silmek istediğinize emin misiniz?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Evet, Sil!",
            cancelButtonText: "Vazgeç"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('module.delete') }}",
                    headers: { 'X-CSRF-TOKEN': csrfToken },
                    data: { 'id' : id },
                    success: function(data)
                    {
                        Swal.fire({
                            title: data.title,
                            text: data.desc,
                            icon: data.type,
                        });
                        if(data.type == "success"){
                            setTimeout(() => {
                                window.location = window.location.href;
                            }, 1500);
                        }
                    },
                    error: function (data) {
                        Swal.fire({
                            title: "Ölümcül Hata",
                            icon: "error",
                        });
                    }
                })
            }
        });
    }

    $('#frmAddParentModule').on('submit',function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "{{ route('module.add.parent') }}",
            data: $(this).serialize(),
            success: function(data)
            {
                Swal.fire({
                    title: data.title,
                    text: data.desc,
                    icon: data.type,
                });
                if(data.type == "success"){
                    setTimeout(() => {
                        window.location = window.location.href;
                    }, 1500);
                }
            },
            error: function (data) {
                Swal.fire({
                    title: "Ölümcül Hata",
                    icon: "error",
                });
            }
        })
    })

    $('#frmAddChildModule').on('submit',function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "{{ route('module.add.child') }}",
            data: $(this).serialize(),
            success: function(data)
            {
                Swal.fire({
                    title: data.title,
                    text: data.desc,
                    icon: data.type,
                });
                if(data.type == "success"){
                    setTimeout(() => {
                        window.location = window.location.href;
                    }, 1500);
                }
            },
            error: function (data) {
                Swal.fire({
                    title: "Ölümcül Hata",
                    icon: "error",
                });
            }
        })
    })

    $('#frmAddGroup').on('submit',function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "{{ route('module.add.group') }}",
            data: $(this).serialize(),
            success: function(data)
            {
                Swal.fire({
                    title: data.title,
                    text: data.desc,
                    icon: data.type,
                });
                if(data.type == "success"){
                    setTimeout(() => {
                        window.location = window.location.href;
                    }, 1500);
                }
            },
            error: function (data) {
                Swal.fire({
                    title: "Ölümcül Hata",
                    icon: "error",
                });
            }
        })
    })
</script>
@endsection
