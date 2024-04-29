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
                                                    class="form-control bg-light w-100" type="text">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="row pr-3">
                        <div class="col-12 col-lg-12 col-md-12 col-sm-12 d-flex ">
                            <div class="font-weight-bold text-lg padding-head pr-teks-pengajuan text-center">
                                <span class="head-text">Pengaju</span>
                                <span class="detail-text">Pengaju</span>
                            </div>
                            <div class="d-block w-100">
                                <div class="row py-2">
                                    <div class="pr-4 py-2 col-6 column-name-pemohon">
                                        <span class="text-sm font-weight-bold text-form-detail">Nama</span>
                                        <input name="nama_pemohon" class="form-control bg-light" style="width: 427px;"
                                            type="text" required>
                                    </div>
                                    <div class="pr-4 py-2 col-6 column-jabatan">
                                        <span class="text-sm font-weight-bold text-form-detail">Jabatan</span>
                                        <input name="jabatan_pemohon" class="form-control bg-light" style="width: 508px;"
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
                                    style="border-radius: 25px; font-weight:bold; font-size: 14px;">
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
        // JS metode penerimaan
        document.getElementById("metode_penerimaan").addEventListener("change", function() {
            var selectedOption = this.value;
            var nomorRekeningInput = document.getElementById("nomorRekeningInput");
            var containerMethod = document.getElementById("container_method");

            // Menampilkan atau menyembunyikan kolom input nomor rekening berdasarkan opsi yang dipilih
            nomorRekeningInput.style.display = selectedOption === "debit" ? "block" : "none";

            // Menetapkan nilai name="metode_penerimaan" sesuai dengan opsi yang dipilih
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
        // end JS Metode penerimaan

        // Get the current date
        var currentDate = new Date();

        // Get year, month, and day
        var year = currentDate.getFullYear();
        var month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
        var day = ('0' + currentDate.getDate()).slice(-2);

        // Format the date as yyyy-mm-dd
        var formattedDate = year + '-' + month + '-' + day;

        // Set the value of the hidden input field
        document.getElementById('tanggalPengajuan').value = formattedDate;
    </script>
@endsection

@push('scripts')
    <script>
        // document.addEventListener("DOMContentLoaded", function() {
        //     var selectJumlah = document.createElement('select');
        //     selectJumlah.setAttribute('name', 'jumlah');
        //     selectJumlah.setAttribute('id', 'jumlahInput');
        //     selectJumlah.classList.add('form-control', 'bg-light');
        //     selectJumlah.style.width = '97%';
        //     selectJumlah.style.marginLeft = '6%';
        //     selectJumlah.style.textAlign = 'center';

        //     // Set batasan atas jumlah opsi
        //     var maxOptions = 1000;

        //     // Generate options for select
        //     for (var i = 1; i <= maxOptions; i++) {
        //         var option = document.createElement('option');
        //         option.value = i;
        //         option.text = i;
        //         selectJumlah.appendChild(option);
        //     }

        //     // Replace input with select
        //     var inputJumlah = document.querySelector('input[name="jumlah"]');
        //     if (inputJumlah) {
        //         inputJumlah.parentNode.replaceChild(selectJumlah, inputJumlah);
        //     }

        //     // Rest of your existing code
        //     var inputHarga = document.querySelector('input[name="harga"]');
        //     var inputTotal = document.querySelector('input[name="total"]');
        //     var inputSubtotal = document.getElementById('subtotalInput');

        //     // Menambahkan event listener untuk input jumlah dan harga
        //     if (selectJumlah && inputHarga) {
        //         selectJumlah.addEventListener('change', updateTotalAndSubtotal);
        //         inputHarga.addEventListener('input', updateTotalAndSubtotal);
        //     }

        //     // Fungsi untuk mengupdate total dan subtotal serta format nilai menjadi format Rupiah
        //     function updateTotalAndSubtotal() {
        //         var jumlah = parseFloat(selectJumlah.value) || 0;
        //         var harga = parseFloat(inputHarga.value.replace(/[^\d]/g, '')) || 0;
        //         var subtotal = jumlah * harga;
        //         var total = formatRupiah(subtotal);

        //         // Mengupdate nilai input subtotal
        //         inputSubtotal.value = subtotal.toFixed(2);

        //         // Mengupdate nilai input total dan memformatnya sebagai format Rupiah
        //         inputTotal.value = total;
        //     }

        //     // Fungsi untuk memformat nilai menjadi format mata uang Rupiah dengan pemisah ribuan
        //     function formatRupiah(angka) {
        //         return 'Rp. ' + angka.toLocaleString('id-ID');
        //     }

        //     // Menangani input harga
        //     inputHarga.addEventListener('input', function() {
        //         var value = inputHarga.value.replace(/[^\d]/g, '');
        //         if (value.length > 0) {
        //             var number = parseInt(value);
        //             inputHarga.value = formatRupiah(number);
        //         } else {
        //             inputHarga.value = '';
        //         }
        //     });
        // });


        $(document).ready(function() {
            // Menampilkan kolom pertama saat halaman dimuat
            var firstRow = `
        <div class="row py-2" style="margin-left: 105px;">
            <div class="pr-4 py-2 col-1">
                <button class="btn btn-sm btn-danger delete-btn font-weight-bold button-delete" style="font-size: 14px;" disabled>
                    <i class="fa-solid fa-minus"></i>
                </button>
            </div>
            <div class="pr-4 py-2 col-3">
                <span class="text-sm font-weight-bold text-form-detail" style="position:relative; right:8px;">Nama item</span>
                <input name="nama_item" class="form-control bg-light input_name_item" type="text" style="width: 232px;" required>
            </div>
            <div class="pr-4 py-2 col-2">
                <span class="text-sm font-weight-bold text-form-detail" style="padding-left:6%;">Jumlah</span>
                <input name="jumlah" id="jumlahInput" class="form-control bg-light" type="number" style="width: 97%; margin-left:6%; text-align:center;">
            </div>
            <div class="pr-4 py-2 col-3">
                <span class="text-sm font-weight-bold text-form-detail" style="padding-left:3%">Harga</span>
                <input name="harga" id="hargaInput" class="form-control bg-light" type="text" style="width: 98%; margin-left:3%; text-align:right;">
            </div>
            <div class="pr-4 py-2 col-3">
                <span class="text-sm font-weight-bold text-form-detail" style="padding-left: 2px;">Total</span>
                <input name="total" id="totalInput" class="form-control bg-light text-right" type="text" style="width:99%;" disabled>
            </div>
        </div>`;
            $("#itemFields").append(firstRow);

            // Logika untuk menghitung total dan subtotal
            function hitungTotal(row) {
                var jumlah = parseFloat($(row).find('[name="jumlah"]').val()) || 0;
                var harga = parseFloat($(row).find('[name="harga"]').val().replace(/[^\d.]/g, '')) ||
                    0; // Menghapus karakter non-digit
                var total = jumlah * harga;
                $(row).find('[name="total"]').val(total); // Menghapus .toFixed(2)
                return total;
            }

            function hitungSubtotal() {
                var subtotal = 0;
                $(".row.py-2").each(function() {
                    subtotal += parseFloat($(this).find('[name="total"]').val()) || 0;
                });
                $("#subtotalInput").val(subtotal); // Menghapus .toFixed(2)
            }




            // Event listener untuk tombol tambah
            $("#tambahField").click(function() {
                var newRow = `
            <div class="row py-2" style="margin-left: 119px;">
                <div class="pr-4 py-2 col-1 JS-button-delete">
                    <button class="btn btn-sm btn-danger font-weight-bold JS-delete-btn" style="font-size: 14px; margin-top:47%; right:40px;"><i class="fa-solid fa-minus"></i></button>
                </div>
                <div class="pr-4 py-2 col-3">
                    <span class="text-sm font-weight-bold text-form-detail" style="position: relative; right:17px;">Nama item</span>
                    <input name="nama_item" class="form-control bg-light" type="text" style="width: 230px; position: relative; right:20px;" required>
                </div>
                <div class="pr-4 py-2 col-2">
                    <span class="text-sm font-weight-bold text-form-detail" style="position: relative; left:-4px;">Jumlah</span>
                    <input name="jumlah" id="jumlahInput" class="form-control bg-light" type="number" style="width: 97%; margin-left:6%; text-align:center; position: relative; right:13px">
                </div>
                <div class="pr-4 py-2 col-3">
                    <span class="text-sm font-weight-bold text-form-detail" style="position: relative; right:7px;">Harga</span>
                    <input name="harga" id="hargaInput" class="form-control bg-light" type="text" style="width: 99%; margin-left:3%; text-align:right; position: relative; right:13px">
                </div>
                <div class="pr-4 py-2 col-3">
                    <span class="text-sm font-weight-bold text-form-detail" style="position: relative; right:7px;">Total</span>
                    <input name="total" id="totalInput" class="form-control bg-light text-right" type="text" style="width:99%; position: relative; right:9px" disabled>
                </div>
            </div>`;
                $("#itemFields").append(newRow);
            });

            // Event listener untuk menghitung total saat input jumlah/harga berubah
            $(document).on('change', '[name="jumlah"], [name="harga"]', function() {
                var row = $(this).closest('.row.py-2');
                hitungTotal(row);
                hitungSubtotal();
            });

            // Event listener untuk tombol hapus
            $(document).on('click', '.JS-delete-btn', function() {
                $(this).closest('.row').remove();
                hitungSubtotal();
            });
        });
    </script>
@endpush
