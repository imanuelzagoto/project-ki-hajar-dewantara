@extends('layouts.master')

@section('content')
    <div class="main-dashboard mt--3">
        <nav aria-label="breadcrumb">
            <div class="breadcrumb mt-2 d-flex justify-content-between">
                <div class="d-lg-none">
                    <button class=" navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                        data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon">
                            <i class="icon-menu"></i>
                        </span>
                    </button>
                </div>
                <div class="d-none d-lg-block d-sm-none breadcrumb-item">
                    <ul class="breadcrumbs">
                        <li class="breadcrumbs__item">
                            <a href="{{ route('pengajuanDana.index') }}" class="breadcrumbs__link"
                                style="color: #A0AEC0;font-size: 15px; font-weight: 500;">
                                Pages
                            </a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a href="{{ route('pengajuanDana.index') }}" class="breadcrumbs__link"
                                style="color: #17a2b8   ;font-size: 15px; font-weight: 500;">
                                Master Projek
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="btn btn-sm mt--2 rounded tooltip-container" type="button"
                    style="float: left; margin-right:3px; background-color:#F1F4FA;">
                    <a class="button-logout" onclick="$('#logout-form').submit()" style="color: #D41B14;">
                        Logout
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                    <span class="tooltip-text">Logout</span>
                </button>
            </div>
        </nav>
        <div class="col-md-12">
            <h2 class="text-mp font-weight-bold display-6">
                Master Projek
            </h2>
        </div>
    </div>
    <form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none;">
        @csrf
    </form>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mb-3 mb-md-0 d-flex align-items-center" style="margin-top: 31px;">
                <form id="dataTableSearchForm" style="height: 44px; width: 255px;" class="mr-2">
                    <div class="col mr-1 border-container">
                        <i class="fas fa-search"></i>
                        <input type="text" id="dataTableSearchInput"
                            class="form-control form-control-sm pl-0 rounded-right" placeholder="Type here...."
                            aria-controls="dataTable">
                    </div>
                </form>
                <button type="button" id="filtersButton" class="btn btn-sm btn-outline-info ml-2 btn-filters"
                    style="font-size: 17.18px;">
                    <i class="fas fa-sliders-h"></i> Filters
                </button>
            </div>

            <div class="col-md-6 mb-3 mb-md-0 justify-content-md-end d-md-flex add-button">
                <button class="btn btn-perintah mb-1" style="border-radius: 7px;"
                    onclick="window.location.href='{{ route('master-projek.create') }}'">
                    <span class="btn-label">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="tambah-perintah">Tambah Perintah</span>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="margin-top: 10px;">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="d-flex align-items-center mb-3 d-flex-center">
                                <select id="entriesPerPage" class="form-control form-control-sm mr-2"
                                    style="width: 70px; border-color:#4FD1C5;">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                <span class="labelentris" style="color: #A0AEC0;">entries per
                                    page</span>
                            </div>
                            <table class="table display-6 mb-6 table-responsive tablePD" style="width: 100%;">
                                <thead>
                                    <tr style="color: #718EBF; font-family: 'Inter', sans-serif; line-height: 19.36px;">
                                        <th class="text-center" style="width: 5%;" nowrap>No</th>
                                        <th class="text-center" style="width: 20%;" nowrap>Nama Projek</th>
                                        <th class="text-center" style="width: 15%;" nowrap>Kode Projek</th>
                                        <th class="text-center" style="width: 20%;" nowrap>Tenggat</th>
                                        <th class="text-center" style="width: 20%;" nowrap>Mulai</th>
                                        <th class="text-center" style="width: 20%;" nowrap>Akhir</th>
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
            var table = $('.tablePD').DataTable({
                responsive: true,
                serverSide: true,
                autoWidth: false,
                lengthMenu: [10, 25, 50, 100],
                pageLength: storedPageLength,
                ajax: {
                    url: '{{ route('master-projek.data') }}',
                    type: 'GET',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_project',
                        className: 'text-left nowrap'
                    },
                    {
                        data: 'kode_project',
                        className: 'text-left nowrap'
                    },
                    {
                        data: 'tenggat',
                        className: 'text-center nowrap'
                    },
                    {
                        data: 'mulai',
                        className: 'text-center nowrap'
                    },
                    {
                        data: 'akhir',
                        className: 'text-center nowrap'
                    },
                    {
                        data: 'action',
                        className: 'text-center nowrap',
                        orderable: false,
                        searchable: false
                    }
                ],
                createdRow: function(row, data, dataIndex) {
                    $(row).find('td:eq(0), td:eq(1), td:eq(2), td:eq(3), td:eq(4), td:eq(5), td:eq(6)')
                        .css('color', '#232323');
                }
            });

            // Mengatur jumlah entri per halaman
            var storedPageLength = getPageLengthFromLocalStorage('tablePD');
            $('#entriesPerPage').val(storedPageLength);
            $('#entriesPerPage').on('change', function() {
                var selectedValue = $(this).val();
                // Simpan nilai yang dipilih ke dalam localStorage
                localStorage.setItem('tablePD_pageLength', selectedValue);
                // Terapkan perubahan jumlah entri per halaman ke DataTable
                table.page.len(selectedValue).draw();
            });

            // Tambahkan event listener untuk tombol filter
            $('#filtersButton').on('click', function() {
                var searchValue = $('#dataTableSearchInput').val().trim();
                table.search(searchValue).draw();
            });

            // Event listener untuk input di kolom pencarian
            $('#dataTableSearchInput').on('input', function() {
                var searchValue = $(this).val().trim();
                if (searchValue === '') {
                    table.search('').draw();
                }
            });
        });

        function submitDelete(id) {
            event.preventDefault();
            Swal.fire({
                title: "<span style='color: #F31414; font-weight: 700;'>HAPUS?</span>",
                html: "<span style='color: #2D3748; font-weight: 700;'>Apakah Anda yakin ingin menghapus item ini?</span>",
                iconHtml: "<i class='fas fa-trash-alt' style='color: #FFFFFF; background-color: #F31414; border-radius: 50%; padding: 23.5px; font-size: 47px; width:90px; height:90px;'></i>",
                showCancelButton: true,
                confirmButtonColor: "#22B37C",
                cancelButtonColor: "#d33",
                confirmButtonText: "Lanjutkan",
                customClass: {
                    title: 'swal2-title-custom',
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "<span style='color: ##22B37C; font-size:25px; font-weight: 700; font-family: Helvetica;'>HAPUS ITEM INI!</span>",
                        icon: "success",
                        showConfirmButton: true,
                        confirmButtonColor: "#22B37C",
                    }).then((success) => {
                        if (success.isConfirmed) {
                            // Submit the form for deletion
                            document.getElementById('delete-form-' + id).submit();
                        }
                    });
                }
            });
        }

        // Function to get page length from localStorage
        function getPageLengthFromLocalStorage(tableId) {
            var storedLength = localStorage.getItem(tableId + '_pageLength');
            return storedLength ? parseInt(storedLength) : 10; // Default page length
        }
    </script>
@endpush
