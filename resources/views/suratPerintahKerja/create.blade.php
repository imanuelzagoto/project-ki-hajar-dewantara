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
                            <a href="{{ route('surat_perintah_kerja.index') }}" class="breadcrumbs__link"
                                style="color: #A0AEC0;font-size: 14px; font-weight: 500;">
                                Pages
                            </a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a href="{{ route('surat_perintah_kerja.index') }}" class="breadcrumbs__link"
                                style="color: #A0AEC0;font-size: 14px; font-weight: 500;">
                                Surat Perintah Kerja
                            </a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a href="{{ route('suratPerintahKerja.create') }}" class="breadcrumbs__link"
                                style="color: #17a2b8;font-size: 14px; font-weight: 500;">
                                Form Pengisian SPK
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
                        Form Pengisian SPK
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
        <div class="element-scrollbar" style="margin-top: 36px;">
            <div class="">
                <div class="card card-with-scrollbar">
                    <div class="card-body">
                        <form action="{{ url('/surat-perintah-kerja/store') }}" method="POST">
                            @csrf
                            <div class="row pr-3 pt-3">
                                <div class="col-12 col-lg-12 col-md-12 col-sm-12 d-flex ">
                                    <div class="font-weight-bold text-lg padding-project pt-form-create text-center">
                                        <span class="head-project" style="margin-left:6px;">Project</span>
                                        <span class="hide-project">Project</span>
                                    </div>
                                    <div class="d-block w-100">
                                        <div class="row py-2">

                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Kode project</span>
                                                <input type="hidden" id="kode_project_hidden" name="kode_project">
                                                <select id="project_id" class="form-control bg-light w-100"
                                                    onchange="changeProjectName()">
                                                    <option value="" disabled selected>-- Pilih Kode Project --
                                                    </option>
                                                    @foreach ($projects as $p)
                                                        <option value="{{ $p['id'] }}">{{ $p['code_project'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Nama Project</span>
                                                <input name="nama_project" class="form-control w-100 disabled_input"
                                                    id="nama" type="text">
                                            </div>

                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">User</span>
                                                <input name="user" class="form-control bg-light w-100" type="text">
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Main
                                                    Contractor</span>
                                                <input name="main_contractor" class="form-control bg-light w-100"
                                                    type="text">
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Project
                                                    Manager</span>
                                                <input name="project_manager" class="form-control bg-light w-100"
                                                    type="text">
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">PIC</span>
                                                <input name="pic" class="form-control bg-light w-100" type="text">
                                            </div>
                                            <div class="pr-4 py-2 col-4">
                                                <span class="text-sm font-weight-bold text-form-detail">Tanggal</span>
                                                <input name="tanggal" class="form-control bg-light w-100" type="date">
                                            </div>
                                            <div
                                                class="pr-4
                                                    py-2 col-4">
                                                <span class="text-sm font-weight-bold text-form-detail">Prioritas</span>
                                                <input name="prioritas" class="form-control bg-light w-100"
                                                    type="text">
                                            </div>
                                            <div class="pr-4 py-2 col-4">
                                                <span class="text-sm font-weight-bold text-form-detail">Waktu
                                                    Penyelesaian</span>
                                                <input name="waktu_penyelesaian" class="form-control bg-light w-100"
                                                    type="date">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pr-3 pt-3">
                                <div class="col-12 col-lg-12 col-md-12 col-sm-12 d-flex ">
                                    <div class="font-weight-bold text-lg padding-project pt-form-create text-center">
                                        <span class="head-project" style="margin-left:17px;">Detail</span>
                                        <span class="hide-project">Project</span>
                                    </div>
                                    <div class="d-block w-100">
                                        <div class="row py-2">
                                            <div class="pr-4 py-2 col-12">
                                                <span class="text-sm font-weight-bold text-form-detail">Jenis
                                                    Pekerjaan</span>
                                                <input name="jenis_pekerjaan" class="form-control bg-light w-100"
                                                    type="text">
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Uraian
                                                    Pekerjaan</span>
                                                <textarea name="uraian_pekerjaan" id="uraian-pekerjaan" class="form-control bg-light w-100" rows="3"
                                                    style="resize: vertical;"></textarea>
                                            </div>

                                            <div class="pr-4 py-2 col-6">
                                                <div class="text-sm font-weight-bold w-100 mb-2 text-form-detail"
                                                    style="padding-top: 4px;">File
                                                    Pendukung
                                                </div>
                                                <div class="d-flex">
                                                    <div class="form-checkbox-gambar d-flex">
                                                        <input name="dokumen_pendukung_type" type="checkbox"
                                                            id="checkbox_gambar" value="1">
                                                        <span for="checkbox_gambar" class="text-checkbox">Gambar</span>
                                                    </div>
                                                    <div class="form-checkbox-kontrak d-flex">
                                                        <input name="dokumen_pendukung_type" type="checkbox"
                                                            id="checkbox_kontrak" value="2">
                                                        <span for="checkbox_kontrak" class="text-checkbox">Kontrak</span>
                                                    </div>
                                                    <div class="form-checkbox-brosur d-flex">
                                                        <input name="dokumen_pendukung_type" type="checkbox"
                                                            id="checkbox_brosur" value="3">
                                                        <span for="checkbox_brosur" class="text-checkbox">Brosur</span>
                                                    </div>
                                                </div>
                                                <label for="images" class="drop-container" id="dropcontainer">
                                                    <span class="drop-title">Drop files here</span>
                                                    <input name="dokumen_pendukung_file" type="file" id="images"
                                                        accept="image/*">
                                                </label>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pr-3 pt-3">
                                <div class="col-12 col-lg-12 col-md-12 col-sm-12 d-flex ">
                                    <div class="font-weight-bold text-lg padding-project pt-form-create text-center">
                                        <span class="head-project">Hormat<br>Kami</span>
                                        <span class="hide-project">Project</span>
                                    </div>
                                    <div class="d-block w-100">
                                        <div class="row py-2">
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Pemohon</span>
                                                <input name="pemohon" class="form-control bg-light w-100" type="text">
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Jabatan</span>
                                                <input name="jabatan_1" class="form-control bg-light w-100"
                                                    type="text">
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Penerima</span>
                                                <input name="penerima" class="form-control bg-light w-100"
                                                    type="text">
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Jabatan</span>
                                                <input name="jabatan_2" class="form-control bg-light w-100"
                                                    type="text">
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Menyetujui</span>
                                                <input name="menyetujui" class="form-control bg-light w-100"
                                                    type="text">
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Jabatan</span>
                                                <input name="jabatan_3" class="form-control bg-light w-100"
                                                    type="text">
                                            </div>
                                            {{-- <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Mengetahui 1</span>
                                                <input class="form-control bg-light w-100" type="text">
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Jabatan</span>
                                                <input class="form-control bg-light w-100" type="text">
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Mengetahui 2</span>
                                                <input class="form-control bg-light w-100" type="text">
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Jabatan</span>
                                                <input class="form-control bg-light w-100" type="text">
                                            </div> --}}
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
    </div>
    <script>
        function changeProjectName() {
            let project_id = $('#project_id').val(); // Menggunakan .val() untuk mendapatkan nilai select
            console.log(project_id);

            var settings = {
                url: "http://172.15.2.134/api/projects/" + project_id,
                method: "GET",
                timeout: 0,
                headers: {
                    "Accept": "application/json",
                    "Authorization": "{{ Session::get('token') }}"
                },
            };

            $.ajax(settings)
                .done(function(response) {
                    console.log(response);
                    if (response && response.data) {
                        $('#nama').val(response.data.project_name);
                        $('#kode_project_hidden').val(response.data.code_project);
                    } else {
                        console.log("Data tidak ditemukan");
                    }
                })
                .fail(function(xhr, status, error) {
                    console.log("Kesalahan saat melakukan permintaan AJAX: " + status);
                });
        }

        // JS textarea
        const textarea = document.getElementById('uraian-pekerjaan');
        // fungsi mengubah ukuran dinamis
        function autoResizeTextarea() {
            // set nilai minnimum agar tidak terlalu kecil
            textarea.style.height = '130px';
            // set nilai tinggi textarea
            textarea.style.height = textarea.scrollHeight + 'px';
        }
        // Panggil fungsi autoResizeTextarea()
        textarea.addEventListener('input', autoResizeTextarea);
        // panggil autoresize
        autoResizeTextarea();
        // End textarea


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
