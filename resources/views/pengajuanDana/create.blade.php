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
                            <a href="{{ route('pengajuanDana.create') }}" class="breadcrumbs__link"
                                style="color: #17a2b8;font-size: 14px; font-weight: 500;">
                                Form Pengisian Pengajuan Dana
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
                        Form Pengisian Pengajuan Dana
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
        <div class="" style="margin-top: 36px;">
            <div class="">
                <div class="card card-with-scrollbar">
                    <div class="card-body">
                        <form action="{{ url('/pengajuan-dana/store') }}" method="POST">
                            @csrf
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
                                                <input name="subject" class="form-control bg-light w-100" type="text"
                                                    required>
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Revisi</span>
                                                <input name="revisi" class="form-control bg-light w-100" type="text"
                                                    required>
                                            </div>
                                            <div class="row pr-3 pt-3">
                                                <div class="pr-4 py-2 col-6" style="display: none;">
                                                    <input name="tanggal_pengajuan" id="tanggalPengajuan" type="date"
                                                        class="form-control bg-light w-100" required>
                                                </div>
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail"></span>
                                                <input name="no_doc" id="noDoc" type="hidden"
                                                    class="form-control bg-light w-100" required>
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
                                                <input name="tujuan" class="form-control bg-light w-100" type="text"
                                                    required>
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Lokasi</span>
                                                <input name="lokasi" class="form-control bg-light w-100" type="text"
                                                    required>
                                            </div>
                                            <div class="pr-4 py-2 col-2">
                                                <span class="text-sm font-weight-bold text-form-detail">Batas Waktu</span>
                                                <input name="batas_waktu" class="form-control bg-light w-100"
                                                    type="date" required>
                                            </div>

                                            <div class="pr-4 py-2 col-3">
                                                <span class="text-sm font-weight-bold text-form-detail">Nominal</span>
                                                <input name="subtotal" id="subtotalInput" style="text-align: right;"
                                                    class="form-control bg-light w-100" type="text" required readonly>
                                            </div>

                                            <div class="pr-4 py-2 col-3">
                                                <span class="text-sm font-weight-bold text-form-detail">Terbilang</span>
                                                <input name="terbilang" class="form-control bg-light w-100"
                                                    type="text" required>
                                            </div>
                                            <div class="pr-4 py-2 col-2" id="container_method">
                                                <span class="text-sm font-weight-bold text-form-detail">Metode
                                                    Penerimaan</span>
                                                <select id="metode_penerimaan" name="metode_penerimaan"
                                                    class="form-control bg-light w-100">
                                                    <option value="debit">Debit</option>
                                                    <option value="cash">Cash</option>
                                                </select>
                                            </div>

                                            <div id="nomorRekeningInput" class="pr-4 col-2" style="margin-top: 8px;">
                                                <span class="text-sm font-weight-bold text-form-detail">Nomor
                                                    Rekening</span>
                                                <input id="nomor_rekening" name="metode_penerimaan"
                                                    class="form-control bg-light w-100" type="text"
                                                    placeholder="Masukan nomor rekening"
                                                    style="font-size: 10px; font-weight: bold; color: #92A1BB;">
                                            </div>

                                            <div class="pr-4 py-2 col-12">
                                                <span class="text-sm font-weight-bold text-form-detail">Catatan</span>
                                                <textarea name="catatan" class="form-control bg-light w-100" rows="3" style="resize: none;"></textarea>
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
                                            <div class="pr-4 py-2 col-12">
                                                <button id="tambahField"
                                                    class="btn btn-sm button-tambah font-weight-bold">
                                                    <span class="btn-label">
                                                        <i class="fa-solid fa-plus"></i>
                                                        Tambah
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            {{-- Script JS ITEM --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pr-3">
                                <div class="col-12 col-lg-12 col-md-12 col-sm-12 d-flex ">
                                    <div class="font-weight-bold text-lg padding-head pr-teks-pengajuan text-center">
                                        <span class="head-text"
                                            style="position: relative; bottom:2px; right:45px;">Pengaju</span>
                                        <span class="detail-text">Pengaju</span>
                                    </div>
                                    <div class="d-block w-100">
                                        <div class="row py-2">
                                            <div class="pr-4 py-2 col-6 column-name-pemohon">
                                                <span class="text-sm font-weight-bold text-form-detail"
                                                    style="position: relative; bottom:5px; right:88px;">Nama</span>
                                                <input name="nama_pemohon" class="form-control bg-light"
                                                    style="width: 433px; position:relative; bottom:5px; right:90.2px;"
                                                    type="text" required>
                                            </div>
                                            <div class="pr-4 py-2 col-6 column-jabatan">
                                                <span class="text-sm font-weight-bold text-form-detail"
                                                    style="position: relative; bottom:5px; right:47px;">Jabatan</span>
                                                <input name="jabatan_pemohon" class="form-control bg-light"
                                                    style="width: 516px; position:relative; bottom:5px; right:48px;"
                                                    type="text" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-center p-4 rounded-pill">
                                        <button class="btn btn-save"
                                            style="border-radius: 25px; font-weight:bold; font-size: 14px; position: relative; bottom:5px;">
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
            document.getElementById("metode_penerimaan").addEventListener("change", function() {
                var selectedOption = this.value;
                var nomorRekeningInput = document.getElementById("nomorRekeningInput");
                var containerMethod = document.getElementById("container_method");
                nomorRekeningInput.style.display = selectedOption === "debit" ? "block" : "none";

                if (selectedOption === 'debit') {
                    containerMethod.classList.remove('col-4');
                    containerMethod.classList.add('col-2');
                    document.getElementById("nomor_rekening").value = "";
                } else if (selectedOption === 'cash') {
                    containerMethod.classList.remove('col-2');
                    containerMethod.classList.add('col-4');
                    document.getElementById("nomor_rekening").value = "Cash";
                }
            });
            var currentDate = new Date();

            var year = currentDate.getFullYear();
            var month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
            var day = ('0' + currentDate.getDate()).slice(-2);
            var formattedDate = year + '-' + month + '-' + day;
            document.getElementById('tanggalPengajuan').value = formattedDate;



            // Pastikan kode ini berada setelah elemen-elemen HTML yang diperlukan dimuat
            document.addEventListener('DOMContentLoaded', function() {
                // Panggil updateClock secara berkala setiap detik
                setInterval(updateClock, 1000);
                // Panggil updateClock untuk memastikan waktu ditampilkan saat halaman dimuat
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
                // Menampilkan kolom pertama saat halaman dimuat
                addNewRow();
                // Event listener untuk tombol tambah
                $("#tambahField").click(function() {
                    addNewRow();
                });
                // Event listener untuk tombol hapus
                $(document).on('click', '.JS-delete-btn', function() {
                    $(this).closest('.row').remove();
                    hitungSubtotal();
                    activateDeleteButtons
                        (); // Memastikan status tombol delete yang sesuai setelah menghapus baris
                });
                // Fungsi untuk menambahkan baris baru
                function addNewRow() {
                    var newRow = `
                <div class="row py-2" style="margin-left: 119px;">
                    <div class="pr-4 py-2 col-2">
                        <span class="text-sm font-weight-bold text-form-detail" style="position: relative; right:9px;">Nama item</span>
                        <input name="nama_item[]" class="form-control bg-light" type="text" style="width: 156.1px; position: relative; right: 10.5px;" required>
                    </div>
                    <div class="pr-4 py-2 col-2">
                        <span class="text-sm font-weight-bold text-form-detail" style="position:relative; left:6px;">Jumlah</span>
                        <input name="jumlah[]" class="form-control bg-light jumlah" type="number" style="width: 99.1%; position:relative; left:5px; text-align:center;" required>
                    </div>
                    <div class="pr-4 py-2 col-2">
                        <span class="text-sm font-weight-bold text-form-detail" style="position: relative; right:4px;">Satuan</span>
                        <input name="satuan[]" class="form-control bg-light" type="text" style="width: 164.1px; position: relative; right: 5px; text-align:center;" required>
                    </div>
                    <div class="pr-4 py-2 col-2">
                        <span class="text-sm font-weight-bold text-form-detail" style="position:relative; left:20px;">Harga</span>
                        <input name="harga[]" class="form-control bg-light harga" type="text" style="width: 105%; text-align:right; position:relative; left:18px;" required>
                    </div>
                    <div class="pr-4 py-2 col-2">
                        <span class="text-sm font-weight-bold text-form-detail" style="position:relative; left:13px;">Total</span>
                        <input name="total" class="form-control bg-light text-right total" type="text" style="width:205.2px; position:relative; left:12px;" required readonly>
                    </div>
                    <div class="pr-4 py-2 col-1 JS-button-delete">
                        <button class="btn btn-sm btn-danger font-weight-bold JS-delete-btn" style="font-size: 14px; margin-top:47%; margin-left: 70px;" disabled><i class="fa-solid fa-minus"></i></button>
                    </div>
                </div>`;
                    $("#itemFields").append(newRow);

                    // Mengaktifkan tombol delete di kolom kedua
                    activateDeleteButtons();
                }

                // Event listener untuk input jumlah dan harga
                $(document).on('input', '.jumlah, .harga', function() {
                    var row = $(this).closest('.row');
                    hitungTotal(row);
                    hitungSubtotal();
                });

                // Fungsi untuk menghitung total
                function hitungTotal(row) {
                    var jumlah = $(row).find('.jumlah').val();
                    var harga = $(row).find('.harga').val();
                    var total = jumlah * harga;
                    $(row).find('.total').val(total);
                }

                // Fungsi untuk menghitung subtotal
                function hitungSubtotal() {
                    var subtotal = 0;
                    $('.total').each(function() {
                        subtotal += parseInt($(this).val()) || 0;
                    });
                    // Tampilkan subtotal
                    $('#subtotalInput').val(subtotal);
                }

                // Fungsi untuk mengaktifkan atau menonaktifkan tombol delete
                function activateDeleteButtons() {
                    // Menonaktifkan tombol delete di kolom pertama
                    $('.JS-button-delete').first().find('.JS-delete-btn').prop('disabled', true);
                    // Mengaktifkan tombol delete di kolom kedua
                    $('.JS-button-delete').not(':first').find('.JS-delete-btn').prop('disabled', false);
                }
            });
        </script>
    @endpush
