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
                            <a href="" class="breadcrumbs__link"
                                style="color: #17a2b8;font-size: 14px; font-weight: 500;">
                                Edit Form SPK
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
        </nav>
        <div class="row">
            <div class="col-md-6">
                <h2 class="text-mp font-weight-bold display-6">
                    Edit Form SPK <span style="font-size: 22px; padding-left:8px;">&rArr;</span>
                    <span style="color: #a43b19; font-size: 17px; padding-left:8px;">
                        {{ $suratPerintahKerjas->no_spk }}
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
    </div>
    <form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none;">
        @csrf
    </form>
    <div class="container-fluid">
        <div class="element-scrollbar" style="margin-top: 36px;">
            <div class="">
                <div class="card card-with-scrollbar">
                    <div class="card-body">
                        <form action="/surat-perintah-kerja/update/{{ $suratPerintahKerjas->id }}" method="POST">
                            @csrf
                            @method('PUT')
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
                                                <input type="hidden" id="kode_project_hidden" name="code"
                                                    value="{{ $suratPerintahKerjas->code }}">
                                                <select id="project_id" name="code" class="form-control bg-light w-100"
                                                    onchange="changeProjectName()">
                                                    <option value="{{ $suratPerintahKerjas->code }}" selected>
                                                        {{ $suratPerintahKerjas->code }}
                                                    </option>
                                                    @foreach ($projects as $p)
                                                        <option value="{{ $p['code'] }}"
                                                            data-title="{{ $p['title'] }}">{{ $p['code'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Nama Projek</span>
                                                <input name="title" class="form-control w-100 disabled_input"
                                                    id="nama" type="text" value="{{ $suratPerintahKerjas->title }}"
                                                    required>
                                            </div>

                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">User</span>
                                                <input name="user" class="form-control bg-light w-100" type="text"
                                                    value="{{ $suratPerintahKerjas->user }}">
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Main
                                                    Contractor</span>
                                                <input name="main_contractor" class="form-control bg-light w-100"
                                                    type="text" value="{{ $suratPerintahKerjas->main_contractor }}">
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Project
                                                    Manager</span>
                                                <input name="project_manager" class="form-control bg-light w-100"
                                                    type="text" value="{{ $suratPerintahKerjas->project_manager }}">
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">PIC</span>
                                                <input name="pic" class="form-control bg-light w-100" type="text"
                                                    value="{{ $suratPerintahKerjas->pic }}">
                                            </div>
                                            <div class="pr-4 py-2 col-4">
                                                <span class="text-sm font-weight-bold text-form-detail">Tanggal</span>
                                                <?php
                                                $tanggal = date_format(date_create_from_format('d/m/y', $suratPerintahKerjas->tanggal), 'Y-m-d');
                                                ?>
                                                <input name="tanggal" class="form-control bg-light w-100" type="date"
                                                    value="{{ $tanggal }}">
                                            </div>
                                            <div
                                                class="pr-4
                                                    py-2 col-4">
                                                <span class="text-sm font-weight-bold text-form-detail">Prioritas</span>
                                                <input name="prioritas" class="form-control bg-light w-100"
                                                    type="text" value="{{ $suratPerintahKerjas->prioritas }}">
                                            </div>
                                            <div class="pr-4 py-2 col-4">
                                                <span class="text-sm font-weight-bold text-form-detail">Waktu
                                                    Penyelesaian</span>
                                                <?php
                                                $tanggal_penyelesaian = date_format(date_create_from_format('d/m/y', $suratPerintahKerjas->waktu_penyelesaian), 'Y-m-d');
                                                ?>
                                                <input name="waktu_penyelesaian" class="form-control bg-light w-100"
                                                    type="date" value="{{ $tanggal_penyelesaian }}">
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
                                                    type="text" value="{{ $suratPerintahKerjas->jenis_pekerjaan }}">
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Uraian
                                                    Pekerjaan</span>
                                                <textarea name="uraian_pekerjaan" id="uraian-pekerjaan" class="form-control bg-light" rows="3"
                                                    style="height: 138px;" required>{{ $suratPerintahKerjas->uraian_pekerjaan }}</textarea>
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <div class="text-sm font-weight-bold w-100 mb-2 text-form-detail"
                                                    style="margin-top: 7px;">
                                                    File Pendukung
                                                </div>
                                                <div class="d-flex">
                                                    <div class="form-checkbox-gambar d-flex">
                                                        <input name="dokumen_pendukung_type" type="checkbox"
                                                            id="checkbox_gambar" value="1"
                                                            onclick="handleCheckboxClick('gambar')"
                                                            {{ $suratPerintahKerjas->dokumen_pendukung_type == 1 ? 'checked' : '' }}>
                                                        <span for="checkbox_gambar" class="text-checkbox">Gambar</span>
                                                    </div>
                                                    <div class="form-checkbox-kontrak d-flex">
                                                        <input name="dokumen_pendukung_type" type="checkbox"
                                                            id="checkbox_kontrak" value="2"
                                                            onclick="handleCheckboxClick('kontrak')"
                                                            {{ $suratPerintahKerjas->dokumen_pendukung_type == 2 ? 'checked' : '' }}>
                                                        <span for="checkbox_kontrak" class="text-checkbox">Kontrak</span>
                                                    </div>
                                                    <div class="form-checkbox-brosur d-flex">
                                                        <input name="dokumen_pendukung_type" type="checkbox"
                                                            id="checkbox_brosur" value="3"
                                                            onclick="handleCheckboxClick('brosur')"
                                                            {{ $suratPerintahKerjas->dokumen_pendukung_type == 3 ? 'checked' : '' }}>
                                                        <span for="checkbox_brosur" class="text-checkbox">Brosur</span>
                                                    </div>
                                                </div>
                                                <label for="choosefile" class="drop-container" id="dropcontainer">
                                                    <span class="drop-title">Drop files here</span>
                                                    <input name="dokumen_pendukung_file" type="file" id="choosefile"
                                                        onchange="handleFileSelect(this)">
                                                </label>
                                                @if ($suratPerintahKerjas->dokumen_pendukung_file)
                                                    <p id="fileName">File yang
                                                        sudah dipilih: {{ $suratPerintahKerjas->dokumen_pendukung_file }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pr-3 pb-2" style="position: relative; bottom:18px;">
                                <div class="col-12 col-lg-12 col-md-12 col-sm-12 d-flex ">
                                    <div class="font-weight-bold text-lg padding-project pt-form-create text-center">
                                        <span class="head-project">Hormat<br>Kami</span>
                                        <span class="hide-project">Project</span>
                                    </div>
                                    <div class="d-block w-100">
                                        <div class="row py-2">
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Pemohon</span>
                                                <input name="pemohon" class="form-control bg-light w-100" type="text"
                                                    value="{{ $suratPerintahKerjas->pemohon }}" required>
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Jabatan</span>
                                                <input name="jabatan_1" class="form-control bg-light w-100"
                                                    type="text" value="{{ $suratPerintahKerjas->jabatan_1 }}"
                                                    required>
                                            </div>

                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Penerima</span>
                                                <input name="penerima" class="form-control bg-light w-100" type="text"
                                                    value="{{ $suratPerintahKerjas->penerima }}" required>
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Jabatan</span>
                                                <input name="jabatan_2" class="form-control bg-light w-100"
                                                    value="{{ $suratPerintahKerjas->jabatan_2 }}" type="text"
                                                    required>
                                            </div>

                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Menyetujui</span>
                                                <input name="menyetujui" class="form-control bg-light w-100"
                                                    type="text" value="{{ $suratPerintahKerjas->menyetujui }}"
                                                    required>
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Jabatan</span>
                                                <input name="jabatan_3" class="form-control bg-light w-100"
                                                    type="text" value="{{ $suratPerintahKerjas->jabatan_3 }}"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-center p-4 rounded-pill">
                                        <button class="btn btn-save"
                                            style="border-radius: 25px; font-weight:bold; font-size: 14px; position: relative; bottom:10px;">
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
        function handleCheckboxClick(checkboxName) {
            var checkboxes = ['gambar', 'kontrak', 'brosur'];
            checkboxes.forEach(function(name) {
                if (name !== checkboxName) {
                    document.getElementById('checkbox_' + name).checked = false;
                    clearFileInput();
                }
            });
        }

        function clearFileInput() {
            var fileInput = document.getElementById('choosefile');
            fileInput.value = '';

            var fileNameParagraph = document.getElementById('fileName');
            if (fileNameParagraph) {
                fileNameParagraph.innerHTML = "File yang sudah dipilih: ";
            }
        }

        function handleFileSelect(input) {
            var checkboxGambar = document.getElementById('checkbox_gambar');
            var checkboxKontrak = document.getElementById('checkbox_kontrak');
            var checkboxBrosur = document.getElementById('checkbox_brosur');

            // if (!checkboxGambar.checked && !checkboxKontrak.checked && !checkboxBrosur.checked) {
            //     clearFileInput();
            // }

            if (!checkboxGambar.checked && !checkboxKontrak.checked && !checkboxBrosur.checked) {
                // Automatically select checkbox gambar checkbox if no other checkbox is selected
                selectCheckbox('gambar');
            }
        }

        function selectCheckbox(checkboxName) {
            var checkbox = document.getElementById('checkbox_' + checkboxName);
            checkbox.checked = true;
        }

        document.getElementById('choosefile').addEventListener('change', function(event) {
            var fileInput = event.target;
            var fileName = fileInput.files[0].name;

            var fileNameParagraph = document.getElementById('fileName');
            if (fileNameParagraph) {
                fileNameParagraph.innerHTML = "File yang sudah dipilih: " + fileName;
            }
        });



        // fungsi project
        function changeProjectName() {
            var selectBox = document.getElementById("project_id");
            var selectedValue = selectBox.options[selectBox.selectedIndex].getAttribute('data-title');
            document.getElementById("nama").value = selectedValue;
        }
    </script>
@endsection

@push('scripts')
    <script>
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
@endpush
