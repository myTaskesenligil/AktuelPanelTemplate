@extends('panel.layout.app')

@section('content')

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container">
            <div class="card pt-4 ">
                <div class="card-header border-0">
                    <div class="card-title">
                        <h2>Sistem Logları</h2>
                    </div>

                    <div class="card-toolbar">
                        <button type="button" class="btn btn-sm btn-light-primary">
                            <i class="ki-duotone ki-cloud-download fs-3"><span class="path1"></span><span class="path2"></span></i>
                            Excel'e Aktar
                        </button>
                    </div>
                </div>

                <div class="card-body py-0">
                    <div class="table-responsive">
                        <table id="custom-datatable" class="table table-row-bordered gy-5">
                            <thead>
                            <tr class="fw-semibold fs-6 text-muted">
                                <th>Log Id</th>
                                <th>Tip</th>
                                <th>Kullanıcı</th>
                                <th>IP Adresi</th>
                                <th>Tarih</th>
                                <th>İşlem</th>
                                <th>Model</th>
                                <th>Data Id</th>
                                <th>Veri</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (!empty($data) && $data->count() > 0)
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>
                                            @php
                                                if (strpos($item->action, 'created') !== false) {
                                                    echo '<span class="badge badge-success">CREATE</span>';
                                                }
                                                elseif (strpos($item->action, 'deleted') !== false) {
                                                    echo '<span class="badge badge-danger">DELETE</span>';
                                                }
                                                elseif (strpos($item->action, 'updated') !== false) {
                                                    echo '<span class="badge badge-warning">UPDATE</span>';
                                                }
                                                elseif (strpos($item->action, 'viewed') !== false) {
                                                    echo '<span class="badge badge-primary">PAGE VIEWED</span>';
                                                }
                                                elseif (strpos($item->action, 'login') !== false) {
                                                    echo '<span class="badge badge-secondary">LOGIN</span>';
                                                }
                                                elseif (strpos($item->action, 'logout') !== false) {
                                                    echo '<span class="badge badge-dark">LOGOUT</span>';
                                                }
                                                else {
                                                    echo '<span class="badge badge-info">OTHER</span>';
                                                }
                                            @endphp
                                        </td>
                                        <td>{{ $item->user ? $item->user->name.' '.$item->user->surname : 'Deleted User (id: '.$item->userId.') ' }}</td>
                                        <td>{{ $item->userIP }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d.m.Y H:i:s') }}</td>
                                        <td>{{ $item->action }}</td>
                                        <td>{{ $item->modelType }}</td>
                                        <td>{{ $item->modelId }}</td>
                                        <td><button class="btn btn-primary btn-show-json btn-sm" data-json="{{ $item->data }}">Veriyi Göster</button></td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="jsonModal" tabindex-="1" aria-hidden="true" data-bs-focus="false">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="fw-bold" data-kt-calendar="title">İşlenen Veri</h2>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <div class="modal-body py-10 px-lg-17">
                    <pre id="jsonContent"></pre>
                </div>
                <div class="modal-footer flex-center">
                    <button type="button" data-bs-dismiss="modal"  id="kt_modal_add_event_cancel" class="btn btn-light me-3">
                        Kapat
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js-codes')
    <script>
        // Butona tıklanınca JSON'u göstermek için bir işlev oluşturun
        $(document).on('click', '.btn-show-json', function() {
            var jsonData = $(this).data('json'); // Butona eklenen data-json özelliğini al

            // JSON verisini modal içindeki pre etiketine yerleştir
            $('#jsonContent').text(JSON.stringify(jsonData, null, 2));

            // Modalı aç
            $('#jsonModal').modal('show');
        });
    </script>
@endsection
