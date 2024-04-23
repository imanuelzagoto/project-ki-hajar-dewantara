@extends('layouts.master')

@section('content')
    <div class="main-dashboard mt--3">
        <nav aria-label="breadcrumb">
            <div class="breadcrumb mt-1 d-flex justify-content-between">
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
                            <a href="{{ route('surat_perintah_kerja.index') }}" class="breadcrumbs__link"
                                style="color: #A0AEC0;font-size: 14px; font-weight: 500;">
                                Pages
                            </a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a href="{{ route('surat_perintah_kerja.index') }}" class="breadcrumbs__link"
                                style="color: #17a2b8;font-size: 14px; font-weight: 500;">
                                Surat Perintah Kerja
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
            <div class="row">
                <div class="col-md-6">
                    <h2 class="text-mp font-weight-bold display-6">
                        Surat Perintah Kerja (SPK)
                    </h2>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <h2 class="fiturjam font-weight-bold display-6">
                        <ul class="list-unstyled mb-0">
                            <li id="datetime" style="color: #718EBF; font-weight: bold; font-size: 13px">
                                <i class="fas fa-calendar"></i>&nbsp;
                                <i class="far fa-clock"></i>&nbsp;
                            </li>
                        </ul>
                    </h2>
                </div>
            </div>
        </nav>
    </div>
    <form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none;">
        @csrf
    </form>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mb-3 mb-md-0 d-flex align-items-center" style="margin-top: 23px;">
                <form id="dataTableSearchForm" action="#" method="get" style="height: 44px; width: 255px;"
                    class="mr-2">
                    <div class="col mr-1 border-container">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchSPK" name="search"
                            class="form-control form-control-sm pl-0 rounded-right" placeholder="Type here...."
                            aria-controls="dataTable">
                    </div>
                </form>
                <button type="button" id="filtersButtonSPK" class="btn btn-sm btn-outline-info ml-2 btn-filters"
                    style="font-size: 17.18px;">
                    <i class="fas fa-sliders-h"></i> Filters
                </button>
            </div>
            <div class="col-md-6 mb-3 mb-md-0 justify-content-md-end d-md-flex add-button">
                <button class="btn btn-perintah mb-1" style="border-radius: 19px;"
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
                <div class="card" style="margin-top: 14px;">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="d-flex align-items-center mb-3 d-flex-center">
                                <select id="showEntriesSPK" class="form-control form-control-sm mr-2"
                                    style="width: 70px; border-color:#E2E8F0;">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                <span class="labelentris" style="color: #A0AEC0;">entries per
                                    page</span>
                            </div>
                            <table class="table display-6 mb-6 table-responsive" style="width:100%;" id="tablespk">
                                <thead>
                                    <tr style="color: #718EBF; font-family: 'Inter', sans-serif; line-height:19.36px;">
                                        <th class="text-center" nowrap>No</th>
                                        <th class="text-center" style="width:25%;" nowrap>No SPK</th>
                                        <th class="text-center" nowrap>Nama Project</th>
                                        <th class="text-center" nowrap>Pemohon</th>
                                        <th class="text-left" nowrap>User</th>
                                        <th class="text-center" nowrap>Main Contractor</th>
                                        <th class="text-center" nowrap>Project Manager</th>
                                        <th class="text-left" style="width:19%;" nowrap>PIC</th>
                                        <th class="text-center" style="width:23%;" nowrap>Tanggal</th>
                                        <th class="text-center" nowrap>Tanggal selesai</th>
                                        <th class="text-center" nowrap>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($suratPerintahKerjas as $spk)
                                        @php
                                            $i += 1;
                                        @endphp
                                        <tr class="kolom-td">
                                            <td class="text-center" style="font-weight:400;"nowrap>
                                                {{ $i }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;" nowrap>
                                                {{ $spk->no_spk }}
                                            </td>
                                            <td class="text-left" style="font-weight:400;" nowrap>
                                                {{ $spk->nama_project }}
                                            </td>
                                            <td class="text-left" style="font-weight:400;" nowrap>
                                                {{ $spk->pemohon }}
                                            </td>
                                            <td class="text-left" style="font-weight:400;" nowrap>
                                                {{ $spk->user }}
                                            </td>
                                            <td class="text-left" style="font-weight:400;" nowrap>
                                                {{ $spk->main_contractor }}
                                            </td>
                                            <td class="text-left" style="font-weight:400;" nowrap>
                                                {{ $spk->project_manager }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;" nowrap>
                                                {{ $spk->pic }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;" nowrap>
                                                {{ \Carbon\Carbon::createFromFormat('d/m/y', $spk->tanggal)->format('d-m-Y') }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;" nowrap>
                                                {{ \Carbon\Carbon::createFromFormat('d/m/y', $spk->waktu_penyelesaian)->format('d-m-Y') }}
                                            </td>

                                            <td class="text-center" style="font-weight:400;" nowrap>
                                                <a href="/surat-perintah-kerja/edit/{{ $spk->id }}" type="button"
                                                    class="fas fa-pen btn btn-sm tooltip-container"
                                                    style="color:#4FD1C5; font-size:20px;">
                                                    <span class="tooltip-edit">Edit</span>
                                                </a>
                                                <a href="/surat-perintah-kerja/show/{{ $spk->id }}" target="_blank"
                                                    type="button" class="fas fa-eye btn btn-sm tooltip-container"
                                                    style="color:#1814F3; font-size:20px; border: none; margin-left:2px;">
                                                    <span class="tooltip-show">View</span>
                                                </a>
                                                <a href="/surat-perintah-kerja/delete/{{ $spk->id }}"
                                                    class="fas fa-trash-alt btn btn-sm tooltip-container" type="button"
                                                    style="color:#F31414; font-size:20px;"
                                                    onclick="submitDelete({{ $spk->id }})">
                                                    <span class="tooltip-delete">Delete</span>
                                                </a>
                                                <form id="delete-form-{{ $spk->id }}"
                                                    action="/surat-perintah-kerja/delete/{{ $spk->id }}"
                                                    method="get" style="display: none;">
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JS DELETE
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
                        title: "<span style='color: #22B37C; font-size:25px; border-radius: 19px; font-weight: 700; font-family: Helvetica;'>SUCCESS</span>",
                        icon: "success",
                        showConfirmButton: false,
                        confirmButtonColor: "#22B37C",
                    });
                    setTimeout(() => {
                        document.getElementById('delete-form-' + id).submit();
                    }, 2000);
                }
            });
        }
    </script>
@endsection

@push('scripts')
    <script>
        // JS DATATABLE
        $(document).ready(function() {
            // Function to get page length from localStorage
            function getPageLengthFromLocalStorage(tableId) {
                var storedLength = localStorage.getItem(tableId + '_pageLength');
                if (storedLength) {
                    return parseInt(storedLength);
                } else {
                    return 10; // Default page length
                }
            }

            // table spk
            var tablespk = $('#tablespk').DataTable({
                "pageLength": getPageLengthFromLocalStorage('tablespk'),
                // "info": false, // Menonaktifkan pesan info
                // "paging": false,
                initComplete: function() {
                    this.api().columns().every(function() {
                        var column = this;
                        var select = $(
                                '<select class="form-control"><option value=""></option></select>'
                            )
                            .appendTo($(column.footer()).empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d +
                                '</option>');
                        });
                    });
                }
            });

            // Set value for show entries dropdown on page load
            $('#showEntriesSPK').val(getPageLengthFromLocalStorage('tablespk'));

            // fitur show entri
            $('#showEntriesSPK').change(function() {
                var val = $(this).val();
                tablespk.page.len(val).draw();
                localStorage.setItem('tablespk_pageLength', val);
            });


            // fitur search
            $('#filtersButtonSPK').click(function() {
                var searchText = $('#searchSPK').val();
                tablespk.search(searchText).draw();
            });

            // Memantau perubahan pada input pencarian
            $('#searchSPK').on('input', function() {
                var searchText = $(this).val();
                if (!searchText.trim()) {
                    tablespk.search('').draw();
                }
            });
        });
        // End JS Table
    </script>
@endpush
