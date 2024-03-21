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
                <div class="d-none d-lg-block d-sm-none breadcrumb-pengajuan-dana ml-4">
                    <span class="span_pd mr-2 fs-f5">
                        Pages
                    </span>
                    <span class="slashPD mr-2">
                        /
                    </span>
                    <span class="breadcum-pd">
                        Pengajuan Dana
                    </span>
                </div>
                <button class="btn btn-sm mt--2 rounded tooltip-container" type="button"
                    style="float: left; margin-right:3px; background-color:#F1F4FA;">
                    <a class="button-logout" onclick="$('#logout-form').submit()" style="color: #718096;">
                        Logout
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                    <span class="tooltip-text">Logout</span>
                </button>
            </div>
        </nav>
        <div class="col-md-12">
            <h2 class="text-pd font-weight-bold display-6">
                Pengajuan Dana
            </h2>
        </div>
    </div>
    <!-- End Navbar -->
    <form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none;">
        @csrf
    </form>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mb-3 mb-md-0 d-flex align-items-center" style="margin-top: 31px;">
                <form id="dataTableSearchForm" action="#" method="get" style="height: 44px; width: 255px;"
                    class="mr-2">
                    <div class="col mr-1 border-container">
                        <i class="fas fa-search"></i>
                        <input type="text" id="dataTableSearchInput" name="search"
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
                    onclick="window.location.href='{{ route('pengajuanDana.create') }}'">
                    <span class="btn-label">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="tambah-perintah">Tambah Pengajuan</span>
                </button>
            </div>
        </div>
        <div class="row" style="margin-top: 3px;">
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
                            <table class="element-scrollbar table display-6 mb-6 table-responsive tablePD"
                                style="width:100%;">
                                <thead>
                                    <tr style="color: #718EBF; font-family: 'Inter', sans-serif; line-height:19.36px;">
                                        <th class="text-center" nowrap>No</th>
                                        <th class="text-center" nowrap>No.Doc</th>
                                        <th class="text-center" nowrap>Revisi</th>
                                        <th class="text-center" nowrap>Pemohon</th>
                                        <th class="text-center" nowrap>Tujuan</th>
                                        <th class="text-center" nowrap>Lokasi<br>
                                            <span style="display:block; text-align:center;">Pengajuan</span>
                                        </th>
                                        <th class="text-center" style="width:19%;" nowrap>Tanggal<br>
                                            <span style="display:block; text-align:center;">Pengajuan</span>
                                        </th>
                                        <th class="text-center" style="width:25%;" nowrap>Batas Waktu
                                        </th>
                                        <th class="text-center" style="width:23%;" nowrap>Total Dana
                                        </th>
                                        <th class="text-center" nowrap>Metode<br>
                                            <span style="display:block; text-align:center;">Penerimaan</span>
                                        </th>
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
        function submitDelete(id) {
            event.preventDefault();
            Swal.fire({
                title: "<span style='color: #F31414; font-weight: 700;'>HAPUS?</span>",
                html: "<span style='color: #2D3748; font-weight: 700;'>Apakah Anda yakin ingin menghapus item ini?</span>",
                // icon: "warning",
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

        $(function() {
            // Inisialisasi nilai pilihan entri per halaman dari localStorage
            var storedPageLength = getPageLengthFromLocalStorage('tableDataPD');
            $('#entriesPerPage').val(storedPageLength);

            // Inisialisasi DataTables
            var table = $('.tablePD').DataTable({
                responsive: true,
                serverside: true,
                autoWidth: false,
                bLengthChange: true,
                lengthMenu: [10, 25, 50, 100],
                pageLength: storedPageLength,
                ajax: {
                    url: '{{ route('pengajuanDana.data') }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },

                    {
                        data: 'no_doc',
                        className: 'data-table-cell text-left nowrap',
                        createdCell: function(td, cellData, rowData, row, col) {
                            $(td).css('text-align', 'left');
                        }
                    },

                    {
                        data: 'revisi',
                        className: 'data-table-cell text-left nowrap'
                    },

                    {
                        data: 'nama_pemohon',
                        className: 'data-table-cell text-left nowrap'
                    },

                    {
                        data: 'tujuan',
                        className: 'data-table-cell text-center nowrap',
                        createdCell: function(td, cellData, rowData, row, col) {
                            $(td).css('text-align', 'center');
                        }
                    },

                    {
                        data: 'lokasi',
                        className: 'data-table-cell text-center nowrap',
                        createdCell: function(td, cellData, rowData, row, col) {
                            $(td).css('text-align', 'center');
                        }
                    },

                    {
                        data: 'updated_at',
                        className: 'data-table-cell nowrap',
                        render: function(data) {
                            // Mengubah format tanggal
                            return moment(data, 'YYYY-MM-DD HH:mm:ss').format('HH:mm DD-MM-YYYY');
                        },
                        createdCell: function(td, cellData, rowData, row, col) {
                            $(td).css('text-align', 'center');
                        }
                    },

                    {
                        data: 'jangka_waktu',
                        className: 'data-table-cell text-center nowrap',
                        render: function(data) {
                            // Mengubah format waktu penyelesaian
                            return moment(data, 'DYYYY-MM-DD').format('DD-MM-YYYY');
                        }
                    },

                    {
                        data: 'dana_yang_dibutuhkan',
                        className: 'data-table-cell text-right nowrap',
                        render: function(data) {
                            // Mengubah format uang ke format yang diinginkan
                            var formattedMoney = 'Rp. ' + parseFloat(data).toLocaleString('id-ID', {
                                minimumFractionDigits: 0
                            });

                            return formattedMoney;
                        }
                    },

                    {
                        data: 'no_rekening',
                        className: 'data-table-cell text-center nowrap'
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

            // Mengatur jumlah entri per halaman
            $('#entriesPerPage').on('change', function() {
                var selectedValue = $(this).val();
                // Simpan nilai yang dipilih ke dalam localStorage
                localStorage.setItem('tableDataPD_pageLength', selectedValue);
                // Terapkan perubahan jumlah entri per halaman ke DataTable
                table.page.len(selectedValue).draw();
            });

            // Tambahkan event listener untuk tombol submit
            $('#filtersButton').on('click', function() {
                // Dapatkan nilai input pencarian
                var searchValue = $('#dataTableSearchInput').val().trim();

                // Kirim nilai pencarian ke server menggunakan AJAX
                table.search(searchValue).draw();
            });

            // Event listener untuk input di kolom pencarian
            $('#dataTableSearchInput').on('input', function() {
                var searchValue = $(this).val().trim();

                if (searchValue === '') {
                    // menghapus input kolom pencarian dan mengembalikan entri semua entri
                    table.search('').draw();
                }
            });
        });
    </script>
@endpush
