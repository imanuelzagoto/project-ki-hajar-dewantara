

{{-- @php
    $userData = Session::get('user');
    $userrole = $userData['modules']['name'];
    $email = $userData['email'];
    $division_id = $userData['division_id'];
@endphp --}}

@extends('layouts.master')
@section('title')
    Pengajuan Dana
@endsection

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="main-dashboard mt--3">
        <nav aria-label="breadcrumb">
            <div class="breadcrumb mt-1 d-flex justify-content-between">
                <div class="d-lg-none">
                    <button class=" navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                        data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon">
                            <i class="fas fa-bars"></i>
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
                                style="color: #17a2b8;font-size: 15px; font-weight: 500;">
                                Pengajuan Dana
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="btn btn-sm mt--2 rounded tooltip-container" type="button"
                    style="float: left; margin-right:3px; background-color:#F1F4FA; margin-bottom:8px;">
                    <a class="button-logout" onclick="$('#logout-form').submit()" style="color: #D41B14; margin-left:15px;">
                        Logout
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                    <span class="tooltip-text">Logout</span>
                </button>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h2 class="text-dashboard font-weight-bold display-6">
                        Pengajuan Dana
                    </h2>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <h2 class="fiturjam font-weight-bold display-6">
                        <ul class="list-unstyled mb-0">
                            <li id="datetime" class="datetime_home">
                                <i class="fas fa-calendar"></i>&nbsp;
                                <i class="far fa-clock"></i>&nbsp;
                            </li>
                        </ul>
                    </h2>
                </div>
            </div>
        </nav>
        <form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none;">
            @csrf
        </form>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mb-3 mb-md-0 d-flex align-items-center" style="margin-top: 23px;">
                <form id="dataTableSearchForm" action="#" method="get" style="height: 44px; width: 255px;"
                    class="mr-2">
                    <div class="col mr-1 border-container">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchPD" name="search"
                            class="form-control form-control-sm pl-0 rounded-right" placeholder="Type here...."
                            aria-controls="dataTable">
                    </div>
                </form>
                <button type="button" id="filtersButtonPD" class="btn btn-sm btn-outline-info ml-2 btn-filters"
                    style="font-size: 17.18px;">
                    <i class="fas fa-sliders-h"></i> Search
                </button>
            </div>

            <div class="col-md-6 mb-3 mb-md-0 justify-content-md-end d-md-flex add-button">
                <button class="btn btn-perintah mb-1" style="border-radius: 19px;"
                    onclick="window.location.href='{{ route('pengajuanDana.create') }}'">
                    <span class="btn-label">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="tambah-perintah">Tambah Pengajuan</span>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="margin-top: 10px;">
                    <div class="card-body">
                        <div class="align-items-center d-flex-center">
                            <select id="showEntriesProject" class="form-control form-control-sm mr-2 select_entries"
                                style="width: 70px; border-color:#ECEDF2; position: relative; left:10px;">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <span class="labelentris">entries per page</span>
                        </div>
                        <table class="element-scrollbar table-responsive-goto table display-6 table-hover w-100"
                            id='tablePengajuanDana'>
                            <thead>
                                <tr style="color: #718EBF; font-family: 'Inter', sans-serif; line-height:19.36px;">
                                    <th class="text-center" style="xfont-weight: 700;" nowrap>No</th>
                                    <th class="text-center" style="font-weight: 700;" nowrap>No.Doc</th>
                                    <th class="text-center" style="font-weight: 700;" nowrap>Revisi</th>
                                    <th class="text-left" style="font-weight: 700;" nowrap>Pemohon</th>
                                    <th class="text-center" style="font-weight: 700;" nowrap>Tujuan</th>
                                    <th class="text-center" style="font-weight: 700;" nowrap>Lokasi <br>
                                        Pengajuan
                                    </th>
                                    <th class="text-center" style="font-weight:700;" nowrap>Tanggal <br>
                                        Pengajuan</th>
                                    <th class="text-center" style="font-weight:700;" nowrap>Batas Waktu
                                    </th>
                                    <th class="text-center" style="font-weight:700;" nowrap>Total Dana
                                    </th>
                                    <th class="text-center" style="font-weight: 700;" nowrap>Metode <br>
                                        Penerimaan
                                    </th>
                                    <th class="text-center" style="font-weight: 700;" nowrap>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($pengajuanDanas as $pdts)
                                    @foreach ($pdts->details as $detail)
                                        @php
                                            $i += 1;
                                        @endphp
                                        <tr class="Column_td">
                                            <td class="text-center" style="font-weight:500;"nowrap>
                                                {{ $i }}
                                            </td>
                                            <td class="text-left" style="font-weight:500;" nowrap>
                                                <a href="javascript:void(0)" class="clickable" data-id="{{ $pdts->id }}" style="color: #000000; text-decoration: none;">
                                                    {{ $pdts->no_doc }}
                                                </a>
                                            </td>
                                            <td class="text-left" style="font-weight:500;" nowrap>
                                                {{ $pdts->revisi }}
                                            </td>
                                            <td class="text-left" style="font-weight:500;" nowrap>
                                                {{ $pdts->nama_pemohon }}
                                            </td>
                                            <td class="text-center" style="font-weight:500;" nowrap>
                                                {{ $detail->tujuan }}
                                            </td>
                                            <td class="text-center" style="font-weight:500;" nowrap>
                                                {{ $detail->lokasi }}
                                            </td>
                                            <td class="text-center" style="font-weight:500;" nowrap>
                                                {{ Carbon\Carbon::parse($pdts->updated_at)->format('H:i d-m-Y') }}
                                            </td>
                                            <td class="text-center" style="font-weight:500;" nowrap>
                                                {{ Carbon\Carbon::parse($detail->batas_waktu)->format('d-m-Y') }}
                                            </td>
                                            <td class="text-right" style="font-weight:500;" nowrap>
                                                {{ 'Rp. ' . number_format(floatval(str_replace(['Rp.', '.', ','], '', $detail->subtotal)), 0, ',', '.') }}
                                            </td>
                                            <td class="text-center" style="font-weight:500;" nowrap>
                                                @if ($detail->tunai)
                                                    {{ $detail->tunai }}
                                                @elseif ($detail->non_tunai)
                                                    Transfer
                                                @endif
                                            </td>
                                            <td class="text-center" style="font-weight:500;" nowrap>

                                                <a href="/pengajuan-dana/edit/{{ $pdts->id }}"
                                                    class="fa fa-pencil btn btn-sm tooltip-container"
                                                    style="color:#4FD1C5; font-size:20px;">
                                                    <span class="tooltip-edit">Edit</span>
                                                </a>
                                                <a href="/pengajuan-dana/show/{{ $pdts->id }}"
                                                    class="fas fa-eye btn btn-sm tooltip-container" target="_blank"
                                                    style="color:#1814F3; font-size:20px; border: none; margin-left:2px;">
                                                    <span class="tooltip-show">View</span>
                                                </a>
                                                <a href="/pengajuan-dana/delete/{{ $pdts->id }}"
                                                    class="fas fa-trash-alt btn btn-sm tooltip-container"
                                                    style="color:#F31414; font-size:20px;"
                                                    onclick="submitDelete({{ $pdts->id }})">
                                                    <span class="tooltip-delete">Delete</span>
                                                </a>
                                                <form id="delete-form-{{ $pdts->id }}"
                                                    action="/pengajuan-dana/delete/{{ $pdts->id }}" method="get"
                                                    style="display: none;">
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                        <div class="modalss" id="itemsModal" tabindex="-1" role="dialog" aria-labelledby="itemsModalLabel" aria-hidden="true">
                            <div class="card-modals">
                                <span id="close" style="float:right; cursor:pointer;">&times;</span>
                                <p id="modal-content"></p>
                                <table class="table-bordered" style="width: 100%; overflow: auto;">
                                    <thead>
                                        <tr>
                                            <th class="fw-bold text-center">Nama Item</th>
                                            <th class="fw-bold text-center">Nama Alias</th>
                                            <th class="fw-bold text-center">Jumlah</th>
                                            <th class="fw-bold text-center">harga</th>
                                            <th class="fw-bold text-center">total</th>
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
    </div>
    
    <script>
        $(document).ready(function() {
            $('.clickable').on('click', function() {
                var id = $(this).data('id');
                $('#modal-content').html('<span class="bold-text">No.Doc :</span> <span class="text-document">' + $(this).text() + '</span>');

                $.ajax({
                    url: '/pengajuan-dana/' + id,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var tableBody = '';
                        if (data.length > 0) {
                            data.forEach(function(item, index) {
                                tableBody += '<tr>';
                                tableBody += '<td class="text-center">' + item.nama_item + '</td>';
                                tableBody += '<td class="text-center">' + (item.alias ? item.alias : '') + '</td>';
                                tableBody += '<td class="text-center">' + item.jumlah + '</td>';
                                tableBody += '<td class="text-right">' + formatRupiah(item.harga) + '</td>';
                                tableBody += '<td class="text-right">' + formatRupiah(item.total) + '</td>';
                                tableBody += '</tr>';
                            });
                            $('#itemsModal tbody').html(tableBody);
                        } else {
                            $('#itemsModal tbody').html('<tr><td colspan="5" class="text-center">No items found</td></tr>');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX Error:', textStatus, errorThrown);
                        $('#itemsModal tbody').html('<tr><td colspan="5" class="text-center">Error retrieving data.</td></tr>');
                    }
                });

                $('#itemsModal').css('display', 'flex');
            });

            $('#close').on('click', function() {
                $('#itemsModal').css('display', 'none');
            });

            $(window).on('click', function(event) {
                if ($(event.target).is('#itemsModal')) {
                    $('#itemsModal').hide();
                }
            });

            function formatRupiah(angka) {
                var number_string = angka.toString().replace(/[^,\d]/g, ''),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    var separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
                return 'Rp.' + rupiah;
            }
        });
    </script>

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

        document.addEventListener('DOMContentLoaded', function() {
            setInterval(updateClock, 1000);
            updateClock();
        });

        function updateClock() {
            var now = new Date();
            var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
                'November', 'Desember'
            ];

            var options = {
                timeZone: 'Asia/Jakarta',
                weekday: 'long'
            };
            var dayName = new Intl.DateTimeFormat('id-ID', options).format(now);

            var dateTimeString = '<i class="fas fa-calendar"></i>&nbsp;' + dayName + ', ' + now.getDate() + ' ' +
                months[now.getMonth()] + ' ' + now.getFullYear() + '&nbsp;&nbsp;<i class="far fa-clock"></i>&nbsp;' +
                formatTime(now);

            var datetimeElement = document.getElementById('datetime');
            if (datetimeElement) {
                datetimeElement.innerHTML = dateTimeString;
            } else {
                console.error("Datetime element not found.");
            }
        }

        function formatTime(date) {
            var hours = date.getHours();
            var minutes = date.getMinutes();
            var seconds = date.getSeconds();
            hours = hours < 10 ? '0' + hours : hours;
            minutes = minutes < 10 ? '0' + minutes : minutes;
            seconds = seconds < 10 ? '0' + seconds : seconds;
            var strTime = hours + ':' + minutes + ':' + seconds;
            return strTime;
        }
    </script>
@endsection

@push('scripts')
    <script>
        // JS DATATABLE
        $(document).ready(function() {
            function getPageLengthFromLocalStorage(tableId) {
                var storedLength = localStorage.getItem(tableId + '_pageLength');
                if (storedLength) {
                    return parseInt(storedLength);
                } else {
                    return 10;
                }
            }

            var tablePengajuanDana = $('#tablePengajuanDana').DataTable({
                "pageLength": getPageLengthFromLocalStorage('tablePengajuanDana'),
                // "info": false, // Menonaktifkan pesan info
                // "paging": true,
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

            $('#showEntriesProject').val(getPageLengthFromLocalStorage('tablePengajuanDana'));

            $('#showEntriesProject').change(function() {
                var val = $(this).val();
                tablePengajuanDana.page.len(val).draw();
                localStorage.setItem('tablePengajuanDana_pageLength', val);
            });

            $('#filtersButtonPD').click(function() {
                var searchText = $('#searchPD').val();
                tablePengajuanDana.search(searchText).draw();
            });

            $('#searchPD').on('input', function() {
                var searchText = $(this).val();
                if (!searchText.trim()) {
                    tablePengajuanDana.search('').draw();
                }
            });

            $('#searchPD').keypress(function(event) {
                if (event.keyCode === 13) {
                    var searchText = $(this).val();
                    tablePengajuanDana.search(searchText).draw();
                    event.preventDefault();
                }
            });
        });
        // End JS Table
    </script>
@endpush

