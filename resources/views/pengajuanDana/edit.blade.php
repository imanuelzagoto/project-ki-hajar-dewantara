@extends('layouts.master')

@section('content')
    <div class="main-dashboard mt--3">
        <nav aria-label="breadcrumb">
            <div class="breadcrumb mt-2 d-flex justify-content-between">
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
                                style="color: #A0AEC0;font-size: 14px; font-weight: 500;">
                                Pages
                            </a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a href="{{ route('pengajuanDana.index') }}" class="breadcrumbs__link"
                                style="color: #A0AEC0;font-size: 14px; font-weight: 500;">
                                Pengajuan Dana
                            </a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a href="" class="breadcrumbs__link"
                                style="color: #17a2b8;font-size: 14px; font-weight: 500;">
                                Edit Form Pengajuan Dana
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
                        Edit Form Pengajuan Dana <span style="font-size: 22px; padding-left:8px;">&rArr;</span>
                        <span style="color: #a43b19; font-size: 17px; padding-left:8px;">
                            {{ $pengajuanDanas->no_doc }}
                        </span>
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
    </div>
    <form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none;">
        @csrf
    </form>
    <div class="container-fluid">
        <div class="" style="margin-top: 36px;">
            <div class="">
                <div class="card card-with-scrollbar">
                    <div class="card-body">
                        <form action="/pengajuan-dana/update/{{ $pengajuanDanas->id }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row pr-3 pt-3">
                                <div class="col-12 col-lg-12 col-md-12 col-sm-12 d-flex ">
                                    <div class="font-weight-bold text-lg padding-head pr-teks-pengajuan text-center">
                                        <span class="head-title">Head</span>
                                        <span class="detail-text">Pengaju</span>
                                    </div>
                                    <div class="d-block w-100">
                                        <div class="row py-2">
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Subjek</span>
                                                <input name="subject" value="{{ $pengajuanDanas->subject }}"
                                                    class="form-control bg-light w-100" type="text" required>
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Revisi</span>
                                                <input name="revisi" value="{{ $pengajuanDanas->revisi }}"
                                                    class="form-control bg-light w-100" type="text" required>
                                            </div>
                                            <div class="row pr-3 pt-3">
                                                <div class="pr-4 py-2 col-6" style="display: none;">
                                                    <input name="tanggal_pengajuan"
                                                        value="{{ $pengajuanDanas->tanggal_pengajuan }}"
                                                        id="tanggalPengajuan" type="date"
                                                        class="form-control bg-light w-100" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row pr-3">
                                <div class="col-12 col-lg-12 col-md-12 col-sm-12 d-flex">
                                    <div class="font-weight-bold text-lg padding-head pr-teks-pengajuan text-center">
                                        <span class="head-detail">Detail</span>
                                        <span class="detail-text">Pengaju</span>
                                    </div>
                                    <div class="d-block w-100">
                                        <div class="row py-2">
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Tujuan</span>
                                                <input name="tujuan" value="{{ $pengajuanDanas->tujuan }}"
                                                    class="form-control bg-light w-100" type="text" required>
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Lokasi</span>
                                                <input name="lokasi" value="{{ $pengajuanDanas->lokasi }}"
                                                    class="form-control bg-light w-100" type="text" required>
                                            </div>
                                            <div class="pr-4 py-2 col-2">
                                                <span class="text-sm font-weight-bold text-form-detail">Batas Waktu</span>
                                                <input name="batas_waktu" value="{{ $pengajuanDanas->batas_waktu }}"
                                                    class="form-control bg-light w-100" type="date" required>
                                            </div>
                                            <div class="pr-4 py-2 col-3">
                                                <span class="text-sm font-weight-bold text-form-detail">Nominal</span>
                                                <input name="subtotal"
                                                    value="{{ 'Rp. ' . number_format(floatval(str_replace(['Rp.', '.', ','], '', $pengajuanDanas->subtotal)), 0, ',', '.') }}"
                                                    id="subtotalInput" style="text-align: right;"
                                                    class="form-control bg-light w-100" type="text" required readonly>
                                            </div>
                                            <div class="pr-4 py-2 col-3">
                                                <span class="text-sm font-weight-bold text-form-detail">Terbilang</span>
                                                <input name="terbilang" value="{{ $pengajuanDanas->terbilang }}"
                                                    class="form-control bg-light w-100" type="text" required readonly>
                                            </div>

                                            <div class="pr-4 py-2 col-2" id="container_method">
                                                <span class="text-sm font-weight-bold text-form-detail">Metode
                                                    Penerimaan</span>
                                                <select id="metode_penerimaan" class="form-control bg-light w-100"
                                                    onchange="toggleRekeningInput()">
                                                    <option value="debit" name="non_tunai">Debit</option>
                                                    <option value="Cash" name="tunai">Cash</option>
                                                </select>
                                            </div>

                                            <div id="nomorRekeningInput" class="pr-4 col-2"
                                                style="margin-top: 8px; display: none;">
                                                <span class="text-sm font-weight-bold text-form-detail">Nomor
                                                    Rekening</span>
                                                <input id="nomor_rekening" name="non_tunai"
                                                    class="form-control bg-light w-100" type="text"
                                                    placeholder="Masukan nomor rekening"
                                                    value="{{ $pengajuanDanas->non_tunai }}"
                                                    style="font-size: 10px; font-weight: bold; color: #92A1BB;">
                                            </div>

                                            <div class="pr-4 py-2 col-12">
                                                <span class="text-sm font-weight-bold text-form-detail">Catatan</span>
                                                <textarea name="catatan" class="form-control bg-light w-100" rows="3" style="resize: none;">{{ $pengajuanDanas->catatan }}</textarea>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row pr-3 pt-3" id="itemFields">
                                <div class="col-12 col-lg-12 col-md-12 col-sm-12 d-flex ">
                                    <div class="font-weight-bold text-lg padding-head pr-teks-pengajuan text-center">
                                        <span class="head-item">Item</span>
                                        <span class="detail-text">Pengaju</span>
                                    </div>
                                    <div class="d-block w-100">
                                        <div class="row py-2">
                                            <div class="pr-4 py-2 col-6">
                                                <button id="tambahField" type="button"
                                                    class="btn btn-sm button-tambah font-weight-bold">
                                                    <span class="btn-label">
                                                        <i class="fa-solid fa-plus"></i>
                                                        Tambah
                                                    </span>
                                                </button>
                                            </div>
                                            <div id="input_tunai_container" class="col-2">
                                                <input id="inputTunai" name="tunai" class="form-control bg-light"
                                                    type="text" value="{{ $pengajuanDanas->tunai }}"
                                                    style="font-size: 10px; font-weight: bold; color: #92A1BB; height:10px; width:11px; display:none; visibility:hidden;">
                                            </div>
                                            @foreach ($items as $item)
                                                <div class="row py-2" style="margin-left: 1px; width:100%;">
                                                    <div class="py-2 col-3">
                                                        <span class="text-sm font-weight-bold text-form-detail">Nama
                                                            item</span>
                                                        <input name="nama_item[]" class="form-control bg-light w-100"
                                                            value="{{ $item->nama_item }}" type="text" required>
                                                    </div>
                                                    <div class="py-2 col-2">
                                                        <span
                                                            class="text-sm font-weight-bold text-form-detail">Jumlah</span>
                                                        <input name="jumlah[]" class="form-control bg-light jumlah w-100"
                                                            value="{{ $item->jumlah }}" type="number"
                                                            style=" left:-11px; text-align:center;" required>
                                                    </div>
                                                    <div class="py-2 col-2">
                                                        <span
                                                            class="text-sm font-weight-bold text-form-detail">Satuan</span>
                                                        <input name="satuan[]" class="form-control bg-light w-100"
                                                            value="{{ $item->satuan }}" type="text"
                                                            style=" text-align:center;" required>
                                                    </div>
                                                    <div class="py-2 col-2">
                                                        <span class="text-sm font-weight-bold text-form-detail"
                                                            style="">Harga</span>
                                                        <input name="harga[]" class="form-control bg-light harga"
                                                            type="text" style="text-align:right;"
                                                            value="{{ 'Rp. ' . number_format($item->harga, 0, ',', '.') }}"
                                                            required>
                                                    </div>
                                                    <div class="py-2 col-2">
                                                        <span class="text-sm font-weight-bold text-form-detail"
                                                            style="">Total</span>
                                                        <input name="total"
                                                            class="form-control bg-light text-right total" type="text"
                                                            value="{{ 'Rp. ' . number_format($item->total, 0, ',', '.') }}"
                                                            required readonly>
                                                    </div>
                                                    <div class=" py-2 col-1 JS-button-delete">
                                                        <button
                                                            class="btn btn-sm btn-danger font-weight-bold JS-delete-btn"
                                                            style="font-size: 14px; margin-top:21px;position: absolute;right: 36px;"
                                                            disabled><i class="fa-solid fa-minus"></i></button>
                                                    </div>


                                                    {{-- <div class="pr-4 py-2 col-2">
                                                        <span class="text-sm font-weight-bold text-form-detail"
                                                            style="position: relative; right:118px;">Nama item</span>
                                                        <input name="nama_item[]" value="{{ $item->nama_item }}"
                                                            class="form-control bg-light w-220" type="text"
                                                            style="position: relative; right: 119.5px; width:149px;"
                                                            required>
                                                    </div>
                                                    <div class="pr-4 py-2 col-2">
                                                        <span class="text-sm font-weight-bold text-form-detail"
                                                            style="position:relative; right:84px;">Jumlah</span>
                                                        <input name="jumlah[]" value="{{ $item->jumlah }}"
                                                            class="form-control bg-light jumlah" type="number"
                                                            style="position:relative; right:84px; width:134px; text-align:center;"
                                                            required>
                                                    </div>
                                                    <div class="pr-4 py-2 col-2">
                                                        <span class="text-sm font-weight-bold text-form-detail"
                                                            style="position: relative; right:64px;">Satuan</span>
                                                        <input name="satuan[]" value="{{ $item->satuan }}"
                                                            class="form-control bg-light w-220" type="text"
                                                            style="position: relative; right: 64px; width:132px; text-align:center;"
                                                            required>
                                                    </div>
                                                    <div class="pr-4 py-2 col-2">
                                                        <span class="text-sm font-weight-bold text-form-detail"
                                                            style="position:relative; right:47px;">Harga</span>
                                                        <input name="harga[]"
                                                            value="{{ 'Rp. ' . number_format($item->harga, 0, ',', '.') }}"
                                                            class="form-control bg-light harga w-220" type="text"
                                                            style="text-align:right; position:relative; right: 48px; width:147px;"
                                                            required>
                                                    </div>
                                                    <div class="pr-4 py-2 col-2">
                                                        <span class="text-sm font-weight-bold text-form-detail"
                                                            style="position:relative; right:14px;">Total</span>
                                                        <input name="total"
                                                            value="{{ 'Rp. ' . number_format($item->total, 0, ',', '.') }}"
                                                            class="form-control bg-light text-right total w-220"
                                                            type="text"
                                                            style="position:relative; right:14px; width:180px;" required
                                                            readonly>
                                                    </div>
                                                    <div class="pr-4 py-2 col-1 JS-button-delete">
                                                        <button
                                                            class="btn btn-sm btn-danger font-weight-bold JS-delete-btn w-220"
                                                            style="font-size: 14px; margin-top:20px; margin-left: 53px;"><i
                                                                class="fa-solid fa-minus"></i></button>
                                                    </div> --}}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pr-3 pt-3" style="position: relative; bottom:18px;">
                                <div class="col-12 col-lg-12 col-md-12 col-sm-12 d-flex">
                                    <div class="font-weight-bold text-lg padding-head pr-teks-pengajuan text-center">
                                        <span class="head-pengaju">Pengaju</span>
                                        <span class="detail-text">Pengaju</span>
                                    </div>
                                    <div class="d-block w-100">
                                        <div class="row py-2">
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Pemohon</span>
                                                <input name="nama_pemohon" class="form-control bg-light w-100"
                                                    type="text" value="{{ $pengajuanDanas->nama_pemohon }}" required>
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Jabatan</span>
                                                <input name="jabatan_pemohon"
                                                    value="{{ $pengajuanDanas->jabatan_pemohon }}"
                                                    class="form-control bg-light w-100" type="text" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-center p-4 rounded-pill">
                                        <button class="btn btn-save" type="submit"
                                            style="border-radius: 25px; font-weight:bold; font-size: 14px; position: relative; bottom:8px;">
                                            SAVE
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            window.onload = function() {
                var debitInput = document.getElementById('nomor_rekening');
                var cashInput = document.getElementById('inputTunai');
                var selectElement = document.getElementById('metode_penerimaan');
                if (cashInput.value.trim() !== '') {
                    selectElement.value = 'Cash';
                    document.getElementById('input_tunai_container').style.visibility = 'visible';
                    document.getElementById('nomorRekeningInput').style.display = 'none';
                    document.getElementById('container_method').classList.add('col-4');
                } else {
                    if (debitInput.value.trim() !== '') {
                        selectElement.value = 'debit';
                        document.getElementById('nomorRekeningInput').style.display = 'block';
                        document.getElementById('input_tunai_container').style.visibility = 'hidden';
                        document.getElementById('container_method').classList.remove('col-4');
                    } else {
                        selectElement.value = 'debit';
                        document.getElementById('input_tunai_container').style.visibility = 'hidden';
                        document.getElementById('nomorRekeningInput').style.display = 'block';
                        document.getElementById('container_method').classList.remove('col-4');
                    }
                }
            };

            function toggleRekeningInput() {
                var selectedValue = document.getElementById('metode_penerimaan').value;
                if (selectedValue === 'debit') {
                    document.getElementById('nomorRekeningInput').style.display = 'block';
                    document.getElementById('input_tunai_container').style.visibility = 'hidden';
                    document.getElementById('container_method').classList.remove('col-4');
                    document.getElementById('nomor_rekening').value = '';
                    document.getElementById('inputTunai').value = '';
                } else if (selectedValue === 'Cash') {
                    document.getElementById('nomorRekeningInput').style.display = 'none';
                    document.getElementById('input_tunai_container').style.visibility = 'visible';
                    document.getElementById('container_method').classList.add('col-4');
                    document.getElementById('inputTunai').value = 'Cash';
                } else {
                    document.getElementById('inputTunai').value = '';
                }
            }
        </script>

        <script>
            var currentDate = new Date();
            var year = currentDate.getFullYear();
            var month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
            var day = ('0' + currentDate.getDate()).slice(-2);
            var formattedDate = year + '-' + month + '-' + day;
            document.getElementById('tanggalPengajuan').value = formattedDate;

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

                // Set timezone to Asia/Jakarta
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
                    // Perbarui innerHTML elemen 'datetime' jika ditemukan
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
            $(document).ready(function() {
                $("#tambahField").click(function(e) {
                    e.preventDefault();
                    addNewRow();
                });

                $(document).on('click', '.JS-delete-btn', function() {
                    $(this).closest('.row').remove();
                    hitungSubtotal();
                    activateDeleteButtons();
                });

                // Fungsi untuk menambahkan baris baru
                function addNewRow() {
                    var newRow = `
                    <div class="row py-2" style="margin-left: 105px; width:100%;">
                            <div class="py-2 col-3">
                                <span class="text-sm font-weight-bold text-form-detail" >Nama item</span>
                                <input name="nama_item[]" class="form-control bg-light w-100" type="text" required>
                            </div>
                            <div class="py-2 col-2">
                                <span class="text-sm font-weight-bold text-form-detail" >Jumlah</span>
                                <input name="jumlah[]" class="form-control bg-light jumlah w-100" type="number" style=" left:-11px; text-align:center;" required>
                            </div>
                            <div class="py-2 col-2">
                                <span class="text-sm font-weight-bold text-form-detail" >Satuan</span>
                                <input name="satuan[]" class="form-control bg-light w-100" type="text" style=" text-align:center;" required>
                            </div>
                            <div class="py-2 col-2">
                                <span class="text-sm font-weight-bold text-form-detail" style="">Harga</span>
                                <input name="harga[]" class="form-control bg-light harga" type="text" style="text-align:right; " required>
                            </div>
                            <div class="py-2 col-2">
                                <span class="text-sm font-weight-bold text-form-detail" style="">Total</span>
                                <input name="total" class="form-control bg-light text-right total" type="text"  required readonly>
                            </div>
                            <div class=" py-2 col-1 JS-button-delete">
                                <button class="btn btn-sm btn-danger font-weight-bold JS-delete-btn" style="font-size: 14px; margin-top:21px;position: absolute;right: 36px;" disabled><i class="fa-solid fa-minus"></i></button>
                            </div>
                    </div>`;
                    $("#itemFields").append(newRow);
                    activateDeleteButtons();
                }

                $(document).on('input', '.harga', function() {
                    // Panggil fungsi formatRupiah untuk memformat nilai input
                    $(this).val(formatRupiah($(this).val(), "Rp. "));
                });


                // Event listener untuk input jumlah dan harga
                $(document).on('input', '.jumlah, .harga', function() {
                    var row = $(this).closest('.row');
                    hitungTotal(row);
                    hitungSubtotal();
                });

                // Fungsi untuk menghitung total
                function hitungTotal(row) {
                    var jumlah = parseFloat($(row).find('.jumlah').val()) || 0;
                    var harga = parseFloat($(row).find('.harga').val().replace(/[^\d]/g, '')) || 0;
                    var total = jumlah * harga;
                    $(row).find('.total').val(formatRupiah(total.toString(), "Rp. "));
                }

                // Fungsi untuk menghitung subtotal
                function hitungSubtotal() {
                    var subtotal = 0;
                    $('.total').each(function() {
                        subtotal += parseFloat($(this).val().replace(/[^\d]/g, '')) || 0;
                    });
                    // Format nilai subtotal sebagai rupiah
                    var formattedSubtotal = formatRupiah(subtotal.toString(), "Rp. ");
                    $('#subtotalInput').val(formattedSubtotal);
                }

                // Fungsi untuk mengaktifkan atau menonaktifkan tombol delete
                function activateDeleteButtons() {
                    $('.JS-button-delete').first().find('.JS-delete-btn').prop('disabled', true);
                    $('.JS-button-delete').not(':first').find('.JS-delete-btn').prop('disabled', false);
                }

                /* Fungsi formatRupiah */
                function formatRupiah(angka, prefix) {
                    var number_string = angka.toString().replace(/[^,\d]/g, "").toString(),
                        split = number_string.split(","),
                        sisa = split[0].length % 3,
                        rupiah = split[0].substr(0, sisa),
                        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                    // tambahkan titik jika yang di input sudah menjadi angka ribuan
                    if (ribuan) {
                        separator = sisa ? "." : "";
                        rupiah += separator + ribuan.join(".");
                    }

                    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                    return prefix == undefined ? rupiah : rupiah ? prefix + rupiah : "";
                }
            });
        </script>
    @endpush
