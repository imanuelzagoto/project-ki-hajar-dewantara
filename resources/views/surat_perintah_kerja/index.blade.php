@extends('layouts.master')

@section('spk')
    Surat Perintah Kerja
@endsection

@section('title')
    Surat Perintah Kerja
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="border-radius: 8.16px;">
                    <div class="card-body">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>Kode Project</th>
                                    <th>Nama Project</th>
                                    <th>User</th>
                                    <th>Main Contractor</th>
                                    <th>Project Manager</th>
                                    <th>Action</th>
                                    {{-- <th>No SPK</th>
                                    <th>Tanggal</th>
                                    <th>Estimasi</th> --}}
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script type="text/javascript">
    $(function() {

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('surat_perintah_kerja.data') }}",
            columns: [{
                    data: 'kode_project',
                    name: 'kode_project'
                },
                {
                    data: 'nama_project',
                    name: 'nama_project'
                },
                {
                    data: 'user',
                    name: 'user'
                },
                {
                    data: 'main_contractor',
                    name: 'main_contractor'
                },

                {
                    data: 'project_manager',
                    name: 'project_manager'
                },

                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

    });
</script>
