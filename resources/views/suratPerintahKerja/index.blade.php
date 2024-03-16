@extends('layouts.master')

@section('spk')
    Surat Perintah Kerja
@endsection

@section('pages_spk')
    Pages
@endsection

@section('titleSPK')
    Surat Perintah Kerja (SPK)
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row" style="margin-top: 13.5px;">
            <div class="col-md-6 mb-3 mb-md-0 d-flex align-items-center" style="margin-top: -15.5px;">
                <form id="dataTableSearchForm" action="#" method="get" style="height: 44px; width: 255px;" class="mr-2">
                    <div class="col mr-1 border-container">
                        <i class="fas fa-search"></i>
                        <input type="text" id="dataTableSearchInput" name="search"
                            class="form-control form-control-sm pl-0 rounded-right" placeholder="Type here...."
                            aria-controls="dataTable">
                    </div>
                </form>
                <button type="button" id="filtersButton" class="btn btn-sm btn-outline-info ml-2 filtersbutton"
                    style="border-radius: 17px; height:42px; font-size:17.18px; font-family: Helvetica, sans-serif; color:#2D3748;border-color:#d4d6d8;background-color: #FFFFFF">
                    <i class="fas fa-sliders-h"></i> Filters
                </button>
            </div>

            <div class="col-md-6 mb-3 mb-md-0 justify-content-md-end d-md-flex add-button">
                <button class="btn btn-perintah mb-4" style="border-radius: 7px;"
                    onclick="window.location.href='{{ route('suratPerintahKerja.create') }}'">
                    <span class="btn-label">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="tambah-perintah">Tambah Perintah</span>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="d-flex align-items-center mb-3 d-flex-center">
                                <select id="entriesPerPage" class="form-control form-control-sm mr-2" style="width: 70px;">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                <span class="labelentris" style="color: #A0AEC0;">entries per page:</span>
                            </div>
                            <table class="table mb-6" style="width:100%">
                                <thead>
                                    <tr style="color: #718EBF; font-family: 'Inter', sans-serif; line-height:19.36px;">
                                        <th class="text-center" nowrap>No</th>
                                        <th class="text-center" nowrap>Nama Project</th>
                                        <th class="text-center" nowrap>Pemohon</th>
                                        <th class="text-center" nowrap>User</th>
                                        <th class="text-center" nowrap>Main Contractor</th>
                                        <th class="text-center" nowrap>Project Manager</th>
                                        <th class="text-center" style="width:19%;" nowrap>PIC</th>
                                        <th class="text-center" style="width:25%;" nowrap>No SPK</th>
                                        <th class="text-center" style="width:23%;" nowrap>Tanggal</th>
                                        <th class="text-center" nowrap>Tanggal selesai</th>
                                        <th class="text-center" nowrap>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            // Inisialisasi DataTables
            var table = $('.table').DataTable({
                responsive: true,
                serverside: true,
                autoWidth: false,
                bLengthChange: true,
                lengthMenu: [10, 25, 50, 100], // Menambahkan opsi entri per halaman
                ajax: {
                    url: '{{ route('surat_perintah_kerja.data') }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'nama_project',
                        className: 'data-table-cell text-left nowrap'
                    },
                    {
                        data: 'pemohon',
                        className: 'data-table-cell nowrap'
                    },
                    {
                        data: 'user',
                        className: 'data-table-cell nowrap'
                    },
                    {
                        data: 'main_contractor',
                        className: 'data-table-cell nowrap'
                    },
                    {
                        data: 'project_manager',
                        className: 'data-table-cell nowrap'
                    },
                    {
                        data: 'pic',
                        className: 'data-table-cell nowrap'
                    },
                    {
                        data: 'no_spk',
                        className: 'data-table-cell nowrap'
                    },
                    {
                        data: 'tanggal',
                        className: 'data-table-cell nowrap',
                        render: function(data) {
                            // Mengubah format tanggal
                            return moment(data, 'DD/MM/YYYY').format('DD-MM-YYYY');
                        }
                    },
                    {
                        data: 'waktu_penyelesaian',
                        className: 'data-table-cell nowrap',
                        render: function(data) {
                            // Mengubah format waktu penyelesaian
                            return moment(data, 'DD/MM/YYYY').format('DD-MM-YYYY');
                        }
                    },
                    {
                        data: 'action',
                        className: 'text-center',
                        orderable: false,
                        searchable: false
                    }
                ],
                createdRow: function(row, data, dataIndex) {
                    // Menerapkan warna teks pada kolom dari id hingga waktu_penyelesaian
                    $(row).find(
                        'td:eq(0), td:eq(1), td:eq(2), td:eq(3), td:eq(4), td:eq(5), td:eq(6), td:eq(7), td:eq(8), td:eq(9), td:eq(10)'
                    ).css('color', '#232323');
                }
            });

            // Pencarian langsung saat pengguna mengetikkan input
            $('#dataTableSearchInput').on('input', function() {
                table.search(this.value).draw();
            });

            // Mengatur jumlah entri per halaman
            $('#entriesPerPage').on('change', function() {
                table.page.len($(this).val()).draw();
            });
        });
    </script>
@endpush
