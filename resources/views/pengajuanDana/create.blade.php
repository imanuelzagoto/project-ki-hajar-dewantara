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
                    <span class="span_pd mr-2 fs-f5">Pages</span>
                    <span class="slashPD mr-2">/</span>
                    <span class="breadcum-pd" style="color: #A0AEC0;">Pengajuan Dana</span>
                    <span class="slashPD ml-2">/</span>
                    <span class="breadcum-mp-perintah">Form Pengisian Pengajuan Dana</span>
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
                Pengajuan Dana
            </h2>
        </div>
    </div>
    <form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none;">
        @csrf
    </form>
    <div class="container-fluid">
        <div class="" style="margin-top: 36px;">
            <div class="">
                <div class="card">
                    <div class="card-body">
                        <div class="row pr-4">
                            <div class="col-12 col-lg-6 col-md-12 col-sm-12 d-flex">
                                <span class="font-weight-bold text-lg pr-4 pt-form-create">Project</span>
                                <div class="d-block w-100">
                                    <div class="row py-2">
                                        <div class="form-group col-12 col-md-4">
                                            <span class="text-sm">Kode Project</span>
                                            <input class="form-control bg-light w-100" type="text">
                                        </div>
                                        <div class="form-group col-12 col-md-4">
                                            <span class="text-sm">Nama Project</span>
                                            <input class="form-control bg-light w-100" type="text">
                                        </div>
                                        <div class="form-group col-12 col-md-4">
                                            <span class="text-sm">User</span>
                                            <input class="form-control bg-light w-100" type="text">
                                        </div>
                                        <div class="form-group col-12 col-md-6">
                                            <span class="text-sm">Main Contractor</span>
                                            <input class="form-control bg-light w-100" type="text">
                                        </div>
                                        <div class="form-group col-12 col-md-6">
                                            <span class="text-sm">Project Manager</span>
                                            <input class="form-control bg-light w-100" type="text">
                                        </div>
                                        <div class="form-group col-12 col-md-6">
                                            <span class="text-sm">PIC</span>
                                            <input class="form-control bg-light w-100" type="text">
                                        </div>
                                        <div class="form-group col-12 col-md-6">
                                            <span class="text-sm">Penerima</span>
                                            <input class="form-control bg-light w-100" type="text">
                                        </div>

                                        <div class="form-group col-12 col-md-4">
                                            <span class="text-sm">Tanggal</span>
                                            <input class="form-control bg-light w-100" type="text">
                                        </div>
                                        <div class="form-group col-12 col-md-4">
                                            <span class="text-sm">Prioritas</span>
                                            <input class="form-control bg-light w-100" type="text">
                                        </div>
                                        <div class="form-group col-12 col-md-4">
                                            <span class="text-sm">Waktu Penyelesaian</span>
                                            <input class="form-control bg-light w-100" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-12 col-sm-12 d-flex">
                                <span class="font-weight-bold text-lg pr-4 pt-form-create">Detail</span>
                                <div class="d-block w-100">
                                    <div class="row py-2">
                                        <div class="pt-2 col-12">
                                            <span class="text-sm">Jenis Pekerjaan</span>
                                            <input class="form-control bg-light w-100" type="text">
                                        </div>
                                        <div class="pt-2 col-12">
                                            <span class="text-sm">Uraian Pekerjaan</span>
                                            <textarea class="form-control bg-light w-100" rows="3" style="resize: none;"></textarea>
                                        </div>
                                        <div class="pt-2 col-12">
                                            <div class="text-sm text-center w-100 mb-2">File Pendukung</div>
                                            <label for="images" class="drop-container" id="dropcontainer">
                                                <span class="drop-title">Drop files here</span>
                                                <input type="file" id="images" accept="image/*" required>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="d-flex justify-content-center p-4 rounded-pill">
                                    <button class="btn btn-save" style="border-radius: 25px; font-size: 14px;">
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
        const dropContainer = document.getElementById("dropcontainer")
        const fileInput = document.getElementById("images")

        dropContainer.addEventListener("dragover", (e) => {
            // prevent default to allow drop
            e.preventDefault()
        }, false)

        dropContainer.addEventListener("dragenter", () => {
            dropContainer.classList.add("drag-active")
        })

        dropContainer.addEventListener("dragleave", () => {
            dropContainer.classList.remove("drag-active")
        })

        dropContainer.addEventListener("drop", (e) => {
            e.preventDefault()
            dropContainer.classList.remove("drag-active")
            fileInput.files = e.dataTransfer.files
        })
    </script>
@endsection
