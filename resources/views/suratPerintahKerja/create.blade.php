@extends('layouts.master')
@section('title')
    Tambah Perintah
@endsection
@section('content')
    <div class="col-md-12 main-dashboard mt--3">
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
                    <ul class="header_text_spk">
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
                    style="float: left; margin-right:3px; background-color:#F1F4FA; margin-bottom:8px;">
                    <a class="button-logout" onclick="$('#logout-form').submit()" style="color: #D41B14;">
                        Logout
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                    <span class="tooltip-text">Logout</span>
                </button>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h2 class="form_spk font-weight-bold display-6"
                        style="position: relative; left:7px; bottom:26px; font-size:20px;">
                        Form Pengisian SPK <span style="font-size: 22px; padding-left:8px;">&rArr;</span>
                        <span style="color: #a43b19; font-size: 17px; padding-left:8px;">
                            {{ $no_spk }}
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
        <form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none;">
            @csrf
        </form>
    </div>
    <div class="container-fluid">
        <div class="element-scrollbar">
            <div class="">
                <div class="card card-with-scrollbar">
                    <div class="card-body">
                        <form action="{{ url('/surat-perintah-kerja/store') }}" method="POST" id="store_form">
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
                                                <input type="hidden" id="kode_project_hidden" name="code" required>
                                                <select id="project_id" name="code" class="form-control bg-light w-100"
                                                    onchange="changeProjectName()" required>
                                                    <option value="" disabled selected>
                                                        -- Pilih Kode Project --
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
                                                    id="nama" type="text" required>
                                            </div>

                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">User</span>
                                                <input name="user" class="form-control bg-light w-100" type="text"
                                                    required>
                                            </div>

                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Main
                                                    Contractor</span>
                                                <input name="main_contractor" class="form-control bg-light w-100"
                                                    type="text" required>
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Project
                                                    Manager</span>
                                                <input name="project_manager" class="form-control bg-light w-100"
                                                    type="text" required>
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">PIC</span>
                                                <input name="pic" class="form-control bg-light w-100" type="text">
                                            </div>
                                            <div class="pr-4 py-2 col-4">
                                                <span class="text-sm font-weight-bold text-form-detail">Tanggal
                                                    Pengajuan</span>
                                                <input id="submission_date" name="submission_date"
                                                    class="form-control w-100 disabled-input" type="date" required
                                                    style="background-color: #D9D9D9;">
                                            </div>

                                            <div class="pr-4 py-2 col-4">
                                                <span class="text-sm font-weight-bold text-form-detail">Prioritas</span>
                                                <select name="priority" class="form-control bg-light w-100" required>
                                                    <option value="" disabled selected>-- Pilih
                                                        Prioritas --</option>
                                                    <option value="-"> - </option>
                                                    <option value="Segera">Segera</option>
                                                </select>
                                            </div>

                                            <div class="pr-4 py-2 col-4">
                                                <span class="text-sm font-weight-bold text-form-detail">Waktu
                                                    Penyelesaian</span>
                                                <input name="completion_time" class="form-control bg-light w-100"
                                                    type="date" required>
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
                                                <input name="job_type" class="form-control bg-light w-100" type="text"
                                                    required>
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Uraian
                                                    Pekerjaan</span>
                                                <textarea name="job_description" id="uraian-pekerjaan" class="form-control bg-light" rows="3"
                                                    style="height: 138px;" required></textarea>
                                            </div>

                                            <div class="pr-4 py-2 col-6">
                                                <div class="text-sm font-weight-bold w-100 mb-2 text-form-detail"
                                                    style="margin-top: 7px;">
                                                    File Pendukung
                                                </div>
                                                <div class="d-flex">
                                                    <div class="form-checkbox-gambar d-flex">
                                                        <input name="supporting_document_type" type="checkbox"
                                                            id="checkbox_gambar" value="1"
                                                            onclick="handleCheckboxClick('gambar')">
                                                        <span for="checkbox_gambar" class="text-checkbox">Gambar</span>
                                                    </div>
                                                    <div class="form-checkbox-kontrak d-flex">
                                                        <input name="supporting_document_type" type="checkbox"
                                                            id="checkbox_kontrak" value="2"
                                                            onclick="handleCheckboxClick('kontrak')">
                                                        <span for="checkbox_kontrak" class="text-checkbox">Kontrak</span>
                                                    </div>
                                                    <div class="form-checkbox-brosur d-flex">
                                                        <input name="supporting_document_type" type="checkbox"
                                                            id="checkbox_brosur" value="3"
                                                            onclick="handleCheckboxClick('brosur')">
                                                        <span for="checkbox_brosur" class="text-checkbox">Brosur</span>
                                                    </div>
                                                </div>
                                                <label for="choosefile" class="drop-container" id="dropcontainer">
                                                    <span class="drop-title">Drop files here</span>
                                                    <input name="supporting_document_file" type="file" id="choosefile"
                                                        onchange="handleFileSelect(this)">
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
                                                <input name="applicant_name" class="form-control bg-light w-100"
                                                    type="text" required>
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Jabatan</span>
                                                <input name="applicant_position" class="form-control bg-light w-100"
                                                    type="text" required>
                                            </div>

                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Penerima</span>
                                                <input name="receiver_name" class="form-control bg-light w-100"
                                                    type="text">
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Jabatan</span>
                                                <input name="receiver_position" class="form-control bg-light w-100"
                                                    type="text">
                                            </div>

                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Menyetujui</span>
                                                <input name="approver_name" class="form-control bg-light w-100"
                                                    type="text" required>
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Jabatan</span>
                                                <input name="approver_position" class="form-control bg-light w-100"
                                                    type="text" required>
                                            </div>

                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Mengetahui</span>
                                                <input name="board_of_directors" class="form-control bg-light w-100"
                                                    type="text" required>
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">
                                                    Jabatan
                                                </span>
                                                <input name="position" class="form-control bg-light w-100 disabled-input"
                                                    value="BOD" type="text"
                                                    style="background-color: #D9D9D9 !important;" required>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-center p-4 rounded-pill">
                                        <button class="btn btn-save" type="submit"
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
        // function tanggal pengajuan
        var submissionDateInput = document.getElementById('submission_date');
        var today = new Date().toISOString().split('T')[0];
        submissionDateInput.value = today;

        // function chekbox input file
        function handleCheckboxClick(checkboxName) {
            var checkboxes = ['gambar', 'kontrak', 'brosur'];
            checkboxes.forEach(function(name) {
                if (name !== checkboxName) {
                    document.getElementById('checkbox_' + name).checked = false;
                }
            });

            // Hapus file input jika tidak ada checkbox yang dipilih
            var anyCheckboxChecked = checkboxes.some(function(name) {
                return document.getElementById('checkbox_' + name).checked;
            });

            if (anyCheckboxChecked) {
                if (document.getElementById("choosefile").files.length == 0) {
                    document.getElementById("choosefile").required = true;
                }
            } else {
                document.getElementById("choosefile").required = false;
            }

            if (!anyCheckboxChecked) {
                clearFileInput();
            }
        }

        function clearFileInput() {
            var fileInput = document.getElementById('choosefile');
            fileInput.value = '';
        }

        function handleFileSelect(input) {
            var checkboxes = ['gambar', 'kontrak', 'brosur'];

            // Jika tidak ada checkbox yang dipilih, otomatis pilih checkbox "gambar"
            var anyCheckboxChecked = checkboxes.some(function(name) {
                return document.getElementById('checkbox_' + name).checked;
            });

            if (!anyCheckboxChecked) {
                selectCheckbox('gambar');
            }
        }

        function selectCheckbox(checkboxName) {
            var checkbox = document.getElementById('checkbox_' + checkboxName);
            checkbox.checked = true;
        }

        // Tambahkan event listener untuk memastikan file input dihapus jika tidak ada checkbox yang dipilih
        document.querySelectorAll('input[name="supporting_document_type"]').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                var checkboxes = ['gambar', 'kontrak', 'brosur'];
                var anyCheckboxChecked = checkboxes.some(function(name) {
                    return document.getElementById('checkbox_' + name).checked;
                });

                if (!anyCheckboxChecked) {
                    clearFileInput();
                }
            });
        });


        // project id
        function changeProjectName() {
            var selectBox = document.getElementById("project_id");
            var selectedValue = selectBox.options[selectBox.selectedIndex].getAttribute('data-title');
            document.getElementById("nama").value = selectedValue;
        }

        document.getElementById('uraian-pekerjaan').addEventListener('input', function(event) {
            var textarea = event.target;
            var text = textarea.value;

            // Set value textarea dengan teks yang belum diubah
            textarea.value = text;
        });

        // fungsi untuk newline tag br
        // document.getElementById('uraian-pekerjaan').addEventListener('input', function(event) {
        //     var textarea = event.target;
        //     var text = textarea.value;
        //     var formattedText = text.replace(/\n/g, '<br>');
        //     textarea.value = formattedText;
        // });
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
