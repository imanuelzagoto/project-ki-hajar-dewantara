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
                        Edit Form Pengajuan Dana
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
                <div class="card">
                    <div class="card-body">
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
                                            <input class="form-control bg-light w-100" type="text">
                                        </div>
                                        <div class="pr-4 py-2 col-6">
                                            <span class="text-sm font-weight-bold text-form-detail">Revisi</span>
                                            <input class="form-control bg-light w-100" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pr-3 pt-3">
                            <div class="col-12 col-lg-12 col-md-12 col-sm-12 d-flex">
                                <div class="font-weight-bold text-lg padding-head pr-teks-pengajuan text-center">
                                    <span class="head-detail">Detail</span>
                                    <span class="detail-text">Pengaju</span>
                                </div>
                                <div class="d-block w-100">
                                    <div class="row py-2">
                                        <div class="pr-4 py-2 col-6">
                                            <span class="text-sm font-weight-bold text-form-detail">Tujuan</span>
                                            <input class="form-control bg-light w-100" type="text">
                                        </div>
                                        <div class="pr-4 py-2 col-6">
                                            <span class="text-sm font-weight-bold text-form-detail">Lokasi</span>
                                            <input class="form-control bg-light w-100" type="text">
                                        </div>
                                        <div class="pr-4 py-2 col-2">
                                            <span class="text-sm font-weight-bold text-form-detail">Batas Waktu</span>
                                            <input class="form-control bg-light w-100" type="date">
                                        </div>
                                        <div class="pr-4 py-2 col-3">
                                            <span class="text-sm font-weight-bold text-form-detail">Nominal</span>
                                            <input class="form-control bg-light w-100" type="text">
                                        </div>
                                        <div class="pr-4 py-2 col-3">
                                            <span class="text-sm font-weight-bold text-form-detail">Terbilang</span>
                                            <input class="form-control bg-light w-100" type="text">
                                        </div>
                                        <div class="pr-4 py-2 col-2" id="container_method">
                                            <span class="text-sm font-weight-bold text-form-detail">Metode
                                                Penerimaan</span>
                                            <select id="metodePenerimaan" class="form-control bg-light w-100">
                                                <option value="debit">Debit</option>
                                                <option value="cash">Cash</option>
                                            </select>
                                        </div>
                                        <div id="nomorRekeningInput" class="pr-4 col-2" style="margin-top: 28px;">
                                            <span class="text-sm font-weight-bold text-form-detail"></span>
                                            <input class="form-control bg-light w-100" type="text"
                                                placeholder="Masukan nomor rekening"
                                                style="font-size: 10px; font-weight: bold; color: #92A1BB;">
                                        </div>
                                        <div class="pr-4 py-2 col-12">
                                            <span class="text-sm font-weight-bold text-form-detail">Catatan</span>
                                            <textarea class="form-control bg-light w-100" rows="3" style="resize: none;"></textarea>
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
                                            <button id="tambahField" class="btn btn-sm button-tambah font-weight-bold">
                                                <span class="btn-label">
                                                    <i class="icon-plus"></i>
                                                    Tambah
                                                </span>
                                            </button>
                                        </div>
                                        <div class="pr-4 py-2 col-3">
                                            <span class="text-sm font-weight-bold text-form-detail">Nama item</span>
                                            <input class="form-control bg-light w-100" type="text">
                                        </div>
                                        <div class="pr-4 py-2 col-3">
                                            <span class="text-sm font-weight-bold text-form-detail">Jumlah</span>
                                            <select class="form-control bg-light w-100">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                                        </div>
                                        <div class="pr-4 py-2 col-3">
                                            <span class="text-sm font-weight-bold text-form-detail">Harga</span>
                                            <input class="form-control bg-light w-100" type="text">
                                        </div>
                                        <div class="pr-4 py-2 col-3">
                                            <span class="text-sm font-weight-bold text-form-detail">Total</span>
                                            <input class="form-control bg-light w-100" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pr-3 pt-3">
                            <div class="col-12 col-lg-12 col-md-12 col-sm-12 d-flex ">
                                <div class="font-weight-bold text-lg padding-head pr-teks-pengajuan text-center">
                                    <span class="head-text">Pengaju</span>
                                    <span class="detail-text">Pengaju</span>
                                </div>
                                <div class="d-block w-100">
                                    <div class="row py-2">
                                        <div class="pr-4 py-2 col-6">
                                            <span class="text-sm font-weight-bold text-form-detail">Nama</span>
                                            <input class="form-control bg-light w-100" type="text">
                                        </div>
                                        <div class="pr-4 py-2 col-6">
                                            <span class="text-sm font-weight-bold text-form-detail">Jabatan</span>
                                            <input class="form-control bg-light w-100" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="d-flex justify-content-center p-4 rounded-pill">
                                    <button class="btn btn-save"
                                        style="border-radius: 25px; font-weight:700; font-size: 14px;">
                                        SAVE
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JS metode penerimaan
        document.getElementById('metodePenerimaan').addEventListener('change', function() {
            var selectedValue = this.value;
            var nomorRekeningInput = document.getElementById('nomorRekeningInput');
            if (selectedValue === 'debit') {
                nomorRekeningInput.style.display = 'block';
                document.getElementById('container_method').classList.remove('col-4');
                document.getElementById('container_method').classList.add('col-2');
            } else {
                document.getElementById('container_method').classList.remove('col-2');
                document.getElementById('container_method').classList.add('col-4');
                nomorRekeningInput.style.display = 'none';
            }
        });
        // end JS Metode penerimaan
    </script>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#tambahField").click(function() {
                var newRow = `
            <div class="pr-2 py-2 col-11" style="margin-left: 8.2%;"> <!-- Mengubah margin-left dan padding-right -->
                <div class="row">
                    <div class="pr-2 py-2 col-3"> <!-- Menyesuaikan lebar kolom -->
                        <span class="text-sm font-weight-bold text-form-detail">Nama item</span>
                        <input class="form-control bg-light" type="text" style="width:94.2%">
                    </div>
                    <div class="pr-2 py-2 col-3"> <!-- Menyesuaikan lebar kolom -->
                        <span class="text-sm font-weight-bold text-form-detail">Jumlah</span>
                        <select class="form-control bg-light" style="width:94.2%">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <div class="pr-2 py-2 col-3"> <!-- Menyesuaikan lebar kolom -->
                        <span class="text-sm font-weight-bold text-form-detail">Harga</span>
                        <input class="form-control bg-light" type="text" style="width:94.2%">
                    </div>
                    <div class="pr-2 py-2 col-3"> <!-- Menyesuaikan lebar kolom -->
                        <span class="text-sm font-weight-bold text-form-detail">Total</span>
                        <input class="form-control bg-light" type="text" style="width:94.2%">
                    </div>
                </div>
            </div>`;

                $("#itemFields").append(newRow);
            });
        });
    </script>
@endpush
