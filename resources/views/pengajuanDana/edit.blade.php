@extends('layouts.master')
@section('title')
    Edit Pengajuan
@endsection
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
                            {{ $pengajuanDana->no_doc }}
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
                        <form action="/pengajuan-dana/update/{{ $pengajuanDana->id }}" method="POST">
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
                                                <input name="subject" value="{{ $pengajuanDana->subject }}"
                                                    class="form-control bg-light w-100" type="text" required>
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Revisi</span>
                                                <input name="revisi" value="{{ $pengajuanDana->revisi }}"
                                                    class="form-control bg-light w-100" type="text" required>
                                            </div>
                                            <div class="row pr-3 pt-3">
                                                <div class="pr-4 py-2 col-6" style="display: none;">
                                                    <input name="tanggal_pengajuan"
                                                        value="{{ $pengajuanDana->tanggal_pengajuan }}"
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
                                        @php
                                            $detail = $pengajuanDana->details->first();
                                        @endphp
                                        @if ($detail)
                                            <div class="row py-2">
                                                <div class="pr-4 py-2 col-5" id="tujuan_container">
                                                    <span class="text-sm font-weight-bold text-form-detail">
                                                        Tujuan
                                                    </span>
                                                    <input name="tujuan" class="form-control bg-light w-100 disabled-input"
                                                        type="text" value="{{ $detail->tujuan }}"
                                                        style="background-color: #D9D9D9 !important; color:black; font-weight:500;"
                                                        required>
                                                </div>

                                                <div class="pr-4 py-2 col-4" id="lokasi_container">
                                                    <span class="text-sm font-weight-bold text-form-detail">Lokasi</span>
                                                    <select name="lokasi" class="form-control bg-light w-100" required>
                                                        <option value="" disabled selected
                                                            {{ $detail->lokasi == '' ? 'selected' : '' }}></option>
                                                        <option value="Tebet"
                                                            {{ $detail->lokasi == 'Tebet' ? 'selected' : '' }}>
                                                            Tebet
                                                        </option>
                                                        <option value="Cikunir"
                                                            {{ $detail->lokasi == 'Cikunir' ? 'selected' : '' }}>
                                                            Cikunir</option>
                                                    </select>
                                                </div>

                                                <div class="pr-4 py-2 col-3" id="deadline_container">
                                                    <span class="text-sm font-weight-bold text-form-detail">Batas
                                                        Waktu</span>
                                                    <?php
                                                    if ($detail->batas_waktu) {
                                                        $batas_waktu = date('Y-m-d', strtotime(str_replace('/', '-', $detail->batas_waktu)));
                                                    } else {
                                                        $batas_waktu = '';
                                                    }
                                                    ?>
                                                    <input name="batas_waktu" value="{{ $detail->batas_waktu }}"
                                                        class="form-control bg-light w-100" type="date" required>
                                                </div>

                                                <div class="pr-4 py-2 col-3">
                                                    <span class="text-sm font-weight-bold text-form-detail">Nominal</span>
                                                    <input name="subtotal"
                                                        value="{{ 'Rp. ' . number_format(floatval(str_replace(['Rp.', '.', ','], '', $detail->subtotal)), 0, ',', '.') }}"
                                                        id="subtotalInput"
                                                        style="text-align: right; color:black; font-weight:600;"
                                                        class="form-control bg-light w-100" type="text" required
                                                        readonly>
                                                </div>
                                                <div class="pr-4 py-2 col-3">
                                                    <span
                                                        class="text-sm font-weight-bold text-form-detail">Terbilang</span>
                                                    <input name="terbilang" value="{{ $detail->terbilang }}"
                                                        style="color:black; font-weight:500;"
                                                        class="form-control bg-light w-100" type="text" required
                                                        readonly>
                                                </div>

                                                <div class="pr-4 py-2 col-2" id="container_method">
                                                    <span class="text-sm font-weight-bold text-form-detail">Metode
                                                        Penerimaan</span>
                                                    <select id="metode_penerimaan" class="form-control bg-light w-100"
                                                        onchange="toggleRekeningInput()">
                                                        <option value="transfer" name="non_tunai">Transfer</option>
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
                                                        value="{{ $detail->non_tunai }}"
                                                        style="font-size: 10px; font-weight: bold; color: #92A1BB;">
                                                </div>

                                                <div id="namaBankInput" class="pr-4 col-2"
                                                    style="margin-top: 8px; display: none;">
                                                    <span class="text-sm font-weight-bold text-form-detail">Nama
                                                        Bank</span>
                                                    <input id="namabank" name="nama_bank"
                                                        class="form-control bg-light w-100" type="text"
                                                        placeholder="Bank tujuan" value="{{ $detail->nama_bank }}"
                                                        style="font-size: 10px; font-weight: bold; color: #92A1BB;">
                                                </div>

                                                <div class="pr-4 py-2 col-12">
                                                    <span class="text-sm font-weight-bold text-form-detail">Catatan</span>
                                                    <textarea name="catatan" class="form-control bg-light w-100" rows="3" style="resize: none;">{{ $detail->catatan }}</textarea>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class=" pr-3 pt-3" id="itemFields">
                                <div class=" d-flex ">
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
                                                    type="text" value="{{ $detail->tunai }}"
                                                    style="font-size: 10px; font-weight: bold; color: #92A1BB; height:10px; width:11px; display:none; visibility:hidden;">
                                            </div>

                                            @foreach ($pengajuanDana->items as $item)
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
                                                            style="font-size: 14px; margin-top:21px;position: absolute;right: 29px;"><i
                                                                class="fa-solid fa-minus"></i></button>
                                                    </div>
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
                                                    type="text" value="{{ $pengajuanDana->nama_pemohon }}" required>
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Jabatan</span>
                                                <input name="jabatan_pemohon"
                                                    value="{{ $pengajuanDana->jabatan_pemohon }}"
                                                    class="form-control bg-light w-100" type="text" required>
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail"
                                                    style="position: relative; left:2px;">Pemeriksa</span>
                                                <input name="nama_pemeriksa" value="{{ $pengajuanDana->nama_pemeriksa }}"
                                                    class="form-control bg-light w-100" type="text"
                                                    style="position: relative; left:1px;" required>
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail"
                                                    style="position: relative; right:2px;">Jabatan</span>
                                                <input name="jabatan_pemeriksa"
                                                    value="{{ $pengajuanDana->jabatan_pemeriksa }}"
                                                    class="form-control bg-light w-100"
                                                    style="position: relative; right:3px;" type="text" required>
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
    </div>
    <script>
        window.onload = function() {
            setDefaultMetodePenerimaan();
            toggleRekeningInput();
        };

        function setDefaultMetodePenerimaan() {
            var inputTunai = document.getElementById("inputTunai").value;
            var metodePenerimaan = document.getElementById("metode_penerimaan");

            if (inputTunai) {
                metodePenerimaan.value = "Cash";
            } else {
                metodePenerimaan.value = "transfer";
            }
        }

        function toggleRekeningInput() {
            var metodePenerimaan = document.getElementById("metode_penerimaan").value;
            var nomorRekeningInput = document.getElementById("nomorRekeningInput");
            var namaBankInput = document.getElementById("namaBankInput");
            var nomorRekeningField = document.getElementById("nomor_rekening");
            var namaBankField = document.getElementById("namabank");
            var inputTunaiContainer = document.getElementById("input_tunai_container");
            var inputTunai = document.getElementById("inputTunai");
            var containerMethod = document.getElementById("container_method");
            var tujuanContainer = document.getElementById("tujuan_container");
            var lokasiContainer = document.getElementById("lokasi_container");
            var deadlineContainer = document.getElementById("deadline_container");

            if (metodePenerimaan === "transfer") {
                nomorRekeningInput.style.display = "block";
                namaBankInput.style.display = "block";
                inputTunaiContainer.style.display = "none";
                inputTunai.value = "";
                containerMethod.classList.remove('col-4');

                tujuanContainer.classList.remove('col-6');
                tujuanContainer.classList.add('col-5');
                lokasiContainer.classList.remove('col-6');
                lokasiContainer.classList.add('col-4');
                deadlineContainer.classList.remove('col-2');
                deadlineContainer.classList.add('col-3');
            } else if (metodePenerimaan === "Cash") {
                nomorRekeningInput.style.display = "none";
                namaBankInput.style.display = "none";
                inputTunaiContainer.style.display = "block";
                inputTunai.value = "Cash";
                containerMethod.classList.add('col-4');

                tujuanContainer.classList.remove('col-5');
                tujuanContainer.classList.add('col-6');
                lokasiContainer.classList.remove('col-4');
                lokasiContainer.classList.add('col-6');
                deadlineContainer.classList.remove('col-3');
                deadlineContainer.classList.add('col-2');

                // handle untuk menghapus value jika memilih select option Cash
                nomorRekeningField.value = null;
                namaBankField.value = null;
            }
        }

        // Functio  Datetime
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
                    <div class="row py-2" style="margin-left: 91px;">
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
                                <button class="btn btn-sm btn-danger font-weight-bold JS-delete-btn" style="font-size: 14px; margin-top:21px;position: absolute;right: 28px;" disabled><i class="fa-solid fa-minus"></i></button>
                            </div>
                        </div>`;
                $("#itemFields").append(newRow);
                activateDeleteButtons();
            }

            function updateTerbilang() {
                // Mendefinisikan array kata terbilang
                var terbilang = [
                    '', 'satu ', 'dua ', 'tiga ', 'empat ', 'lima ', 'enam ', 'tujuh ', 'delapan ', 'sembilan ',
                    'sepuluh ',
                    'sebelas ', 'dua belas ', 'tiga belas ', 'empat belas ', 'lima belas ', 'enam belas ',
                    'tujuh belas ',
                    'delapan belas ', 'sembilan belas '
                ];

                // Fungsi untuk mengonversi angka menjadi terbilang
                function bilang(n) {
                    if (n < 20) {
                        return terbilang[n];
                    } else if (n < 100) {
                        return terbilang[Math.floor(n / 10)] + 'puluh ' + terbilang[n % 10];
                    } else if (n < 200) {
                        return 'seratus ' + bilang(n - 100);
                    } else if (n < 1000) {
                        return terbilang[Math.floor(n / 100)] + 'ratus ' + bilang(n % 100);
                    } else if (n < 2000) {
                        return 'seribu ' + bilang(n - 1000);
                    } else if (n < 1000000) {
                        return bilang(Math.floor(n / 1000)) + 'ribu ' + bilang(n % 1000);
                    } else if (n < 1000000000) {
                        return bilang(Math.floor(n / 1000000)) + 'juta ' + bilang(n % 1000000);
                    } else if (n < 1000000000000) {
                        return bilang(Math.floor(n / 1000000000)) + 'miliar ' + bilang(n % 1000000000);
                    } else if (n < 1000000000000000) {
                        return bilang(Math.floor(n / 1000000000000)) + 'triliun ' + bilang(n % 1000000000000);
                    }
                }

                // Mengambil nilai subtotal dari input
                var subtotal = parseFloat($('#subtotalInput').val().replace(/[^\d]/g, '')) || 0;

                // Mengonversi subtotal menjadi terbilang
                var terbilangText = bilang(subtotal);

                // Menambahkan kata "rupiah" di akhir teks terbilang
                terbilangText += 'rupiah';

                // Mengisi kolom terbilang dengan nilai terbilang
                $('input[name="terbilang"]').val(terbilangText);
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
                updateTerbilang();
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
