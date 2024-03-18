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
                <div class="d-none d-lg-block d-sm-none breadcrumb-tambah-perintah ml-3">
                    <span class="span_spk mr-2 fs-f5">Pages</span>
                    <span class="slash-spk mr-2">/</span>
                    <span class="breadcum-spk" style="color: #A0AEC0;">Surat Perintah Kerja</span>
                    <span class="slash-spk ml-2">/</span>
                    <span class="breadcum-mp-perintah">Form Pengisian SPK</span>
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
            <h2 class="text-mp font-weight-bold display-6">
                Form Pengisian SPK
            </h2>
        </div>
    </div>
    <form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none;">
        @csrf
    </form>
    <div class="container-fluid">
        <div class="row" style="margin-top: 36px;">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex pr-4">
                            <span class="pr-4 pt-2">Project</span>
                            <div class="d-block">
                                <div class="row py-2 ">
                                    <div class="col-md-6 col-lg-6 col-6">
                                        <span>Kode Project</span>
                                        <input class="w-100" type="text">
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-6">
                                        <span>Nama Project</span>
                                        <input class="w-100" type="text">
                                    </div>
                                </div>
                                <div class="row py-2">
                                    <div class="col">
                                        <span>User</span>
                                        <input class="w-100" type="text">
                                    </div>
                                    <div class="col">
                                        <span>Main Contractor</span>
                                        <input class="w-100" type="text">
                                    </div>
                                    <div class="col">
                                        <span>Project Manager</span>
                                        <input class="w-100" type="text">
                                    </div>
                                    <div class="col">
                                        <span>PIC</span>
                                        <input class="w-100" type="text">
                                    </div>
                                    <div class="col">
                                        <span>Penerima</span>
                                        <input class="w-100" type="text">
                                    </div>
                                </div>
                                <div class="row py-2">
                                    <div class="col-4">
                                        <span>Tanggal</span>
                                        <input class="w-100" type="text">
                                    </div>
                                    <div class="col-4">
                                        <span>Prioritas</span>
                                        <input class="w-100" type="text">
                                    </div>
                                    <div class="col-4">
                                        <span>Waktu Penyelesaian</span>
                                        <input class="w-100" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex pr-4">
                            <span class="pr-4 pt-2">Project</span>
                            <div class="d-block">
                                <div class="row py-2 ">
                                    <div class="col-md-6 col-lg-6 col-6">
                                        <span>Kode Project</span>
                                        <input class="w-100" type="text">
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-6">
                                        <span>Nama Project</span>
                                        <input class="w-100" type="text">
                                    </div>
                                </div>
                                <div class="row py-2">
                                    <div class="col">
                                        <span>User</span>
                                        <input class="w-100" type="text">
                                    </div>
                                    <div class="col">
                                        <span>Main Contractor</span>
                                        <input class="w-100" type="text">
                                    </div>
                                    <div class="col">
                                        <span>Project Manager</span>
                                        <input class="w-100" type="text">
                                    </div>
                                    <div class="col">
                                        <span>PIC</span>
                                        <input class="w-100" type="text">
                                    </div>
                                    <div class="col">
                                        <span>Penerima</span>
                                        <input class="w-100" type="text">
                                    </div>
                                </div>
                                <div class="row py-2">
                                    <div class="col-4">
                                        <span>Tanggal</span>
                                        <input class="w-100" type="text">
                                    </div>
                                    <div class="col-4">
                                        <span>Prioritas</span>
                                        <input class="w-100" type="text">
                                    </div>
                                    <div class="col-4">
                                        <span>Waktu Penyelesaian</span>
                                        <input class="w-100" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center p-4">
                        <button class="btn btn-success">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
