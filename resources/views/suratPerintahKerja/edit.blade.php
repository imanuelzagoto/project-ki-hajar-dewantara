@extends('layouts.master')
@section('title')
    Edit Surat Perintah Kerja
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
                            <a href="{{ route('surat_perintah_kerja.index') }}" class="breadcrumbs__link"
                                style="color: #A0AEC0;font-size: 14px; font-weight: 500;">
                                Pages
                            </a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a id="saveForm" href="{{ route('surat_perintah_kerja.index') }}" class="breadcrumbs__link"
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
                        {{ $suratPerintahKerja->no_spk }}
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
                        <form action="/surat-perintah-kerja/update/{{ $suratPerintahKerja->id }}"
                            enctype="multipart/form-data" method="POST" onsubmit="return handleSubmit(event)">
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
                                                <input type="hidden" id="kode_project_hidden" name="code"  value="{{ $suratPerintahKerja->code }}" required>
                                                <select id="project_id" name="code" class="form-control bg-light w-100"
                                                    onchange="changeProjectName()" required>
                                                    <option value="{{ $suratPerintahKerja->code }}" selected>
                                                        {{ $suratPerintahKerja->code }}
                                                    </option>
                                                    @foreach ($projects as $p)
                                                        @if ($p['code'] !== null)
                                                            <option value="{{ $p['code'] }}" data-title="{{ $p['title'] }}" data-user="{{ $p['user'] }}" data-main-contractor="{{ $p['main_contractor'] }}" data-project-manager="{{ $p['project_manager'] }}">
                                                                {{ $p['code'] }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">Nama Projek</span>
                                                <input name="title" class="form-control w-100 disabled-input-project" id="nama" type="text" value="{{ $suratPerintahKerja->title }}" style="background-color: #D9D9D9 !important; color:black; font-weight:500;" required>
                                            </div>

                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">User</span>
                                                <input name="user" id="user" class="form-control w-100 disabled-input-project" type="text" style="background-color: #D9D9D9 !important; color:black; font-weight:500;" value="{{ $suratPerintahKerja->user }}" required>
                                            </div>

                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">
                                                    Main Contractor
                                                </span>
                                                <input name="main_contractor" id="main_contractor" class="form-control w-100 disabled-input-project"
                                                    type="text" style="background-color: #D9D9D9 !important; color:black; font-weight:500;" value="{{ $suratPerintahKerja->main_contractor }}" required>
                                            </div>

                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">
                                                    Project Manager
                                                </span>
                                                <input name="project_manager" id="project_manager" class="form-control w-100 disabled-input-project"
                                                    type="text" style="background-color: #D9D9D9 !important; color:black; font-weight:500;" value="{{ $suratPerintahKerja->project_manager }}" required>
                                            </div>

                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail">PIC</span>
                                                <select id="picSelect" name="pic" class="form-control bg-light w-100">
                                                    <option value="-" {{ $suratPerintahKerja->pic == '-' ? 'selected' : '' }}>
                                                        - 
                                                    </option>
                                                    <option value="Saring Puspo Hidayat" {{ $suratPerintahKerja->pic == 'Saring Puspo Hidayat' ? 'selected' : '' }}>Saring Puspo Hidayat</option>
                                                    <option value="Edward Halley" {{ $suratPerintahKerja->pic == 'Edward Helly' ? 'selected' : '' }}>Edward Helly</option>
                                                    <option value="Awan Setiawan" {{ $suratPerintahKerja->pic == 'Awan Setiawan' ? 'selected' : '' }}>Awan Setiawan</option>
                                                    <option value="Rizal Affandi" {{ $suratPerintahKerja->pic == 'Rizal Affandi' ? 'selected' : '' }}>Rizal Affandi</option>
                                                </select>
                                            </div>      

                                            <div class="pr-4 py-2 col-4">
                                                <span class="text-sm font-weight-bold text-form-detail">Tanggal
                                                    Pengajuan
                                                </span>
                                                <?php
                                                if ($suratPerintahKerja->submission_date) {
                                                    $submission_date = date('Y-m-d', strtotime(str_replace('/', '-', $suratPerintahKerja->submission_date)));
                                                } else {
                                                    $submission_date = '';
                                                }
                                                ?>
                                                <input id="submission_date" name="submission_date" class="form-control w-100 disabled-input-project" value="{{ $submission_date }}" type="date" style="background-color: #D9D9D9;" required>
                                            </div>

                                            <div class="pr-4 py-2 col-4">
                                                <span class="text-sm font-weight-bold text-form-detail">Prioritas</span>
                                                <select name="priority" class="form-control bg-light w-100">
                                                    <option value="" disabled
                                                        {{ $suratPerintahKerja->priority == '' ? 'selected' : '' }}>--
                                                        Pilih Prioritas --</option>
                                                    <option value="-"
                                                        {{ $suratPerintahKerja->priority == '-' ? 'selected' : '' }}> -
                                                    </option>
                                                    <option value="Segera"
                                                        {{ $suratPerintahKerja->priority == 'Segera' ? 'selected' : '' }}>
                                                        Segera</option>
                                                </select>
                                            </div>

                                            <div class="pr-4 py-2 col-4">
                                                <span class="text-sm font-weight-bold text-form-detail">Waktu
                                                    Penyelesaian</span>
                                                <?php
                                                if ($suratPerintahKerja->completion_time) {
                                                    $completion_time = date('Y-m-d', strtotime(str_replace('/', '-', $suratPerintahKerja->completion_time)));
                                                } else {
                                                    $completion_time = '';
                                                }
                                                ?>
                                                <input name="completion_time" class="form-control bg-light w-100"
                                                    type="date" value="{{ $completion_time }}">
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

                                            <div class="pr-4 py-2 col-6" id="container_type_format">
                                                <span class="text-sm font-weight-bold text-form-detail">Type Format
                                                    Pekerjaan</span>
                                                <select name="type_format_pekerjaan" id="type_format_pekerjaan"
                                                    class="form-control bg-light w-100" onchange="toggleTypeFormat()"
                                                    required>
                                                    <option value="Surat Perintah Kerja"
                                                        {{ $suratPerintahKerja->type_format_pekerjaan == 'Surat Perintah Kerja' ? 'selected' : '' }}>
                                                        Surat Perintah Kerja</option>
                                                    <option value="Surat Permintaan Barang"
                                                        {{ $suratPerintahKerja->type_format_pekerjaan == 'Surat Permintaan Barang' ? 'selected' : '' }}>
                                                        Surat Permintaan Barang</option>
                                                </select>
                                            </div>

                                            <div class="pr-4 py-2 col-3" id="to_container">
                                                <span class="text-sm font-weight-bold text-form-detail">To</span>
                                                <select name="to" id="select_to" class="form-control bg-light w-100">
                                                    <option value="" {{ $suratPerintahKerja->to == '' ? 'selected' : '' }} disabled selected></option>
                                                    <option value="GA Manager" {{ $suratPerintahKerja->to == 'GA Manager' ? 'selected' : '' }}>GA Manager</option>
                                                    <option value="Purchase Manager" {{ $suratPerintahKerja->to == 'Purchase Manager' ? 'selected' : '' }}>Purchase Manager</option>
                                                    <option value="Design Manager" {{ $suratPerintahKerja->to == 'Design Manager' ? 'selected' : '' }}>Design Manager</option>
                                                </select>
                                            </div>

                                            <div class="pr-4 py-2 col-6" id="job_type_Container">
                                                <span class="text-sm font-weight-bold text-form-detail">
                                                    Jenis Pekerjaan
                                                </span>
                                                <input name="job_type" id="job_type"
                                                    value="{{ $suratPerintahKerja->job_type }}"
                                                    class="form-control bg-light w-100" type="text" required>
                                            </div>

                                            <div class="pr-4 py-2 col-6" id="uraianPekerjaan">
                                                <span class="text-sm font-weight-bold text-form-detail">
                                                    Uraian Pekerjaan
                                                </span>
                                                <textarea name="job_description" id="uraian-pekerjaan" class="form-control bg-light" rows="3"
                                                    style="height: 138px;" required>{{ $suratPerintahKerja->job_description }}</textarea>
                                            </div>

                                            @foreach ($details_job as $detailss)
                                                <div class="pr-4 py-2 col-6" id="filePendukung">
                                                    <div class="text-sm font-weight-bold w-100 mb-2 text-form-detail"
                                                        style="margin-top: 7px;">
                                                        File Pendukung
                                                    </div>

                                                    <div class="d-flex">
                                                        <div class="form-checkbox-gambar d-flex">
                                                            <input name="supporting_document_type" type="checkbox"
                                                                id="checkbox_gambar" value="1"
                                                                onclick="handleCheckboxClick('gambar')"
                                                                {{ $detailss->supporting_document_type == 1 ? 'checked' : '' }}>
                                                            <span for="checkbox_gambar"
                                                                class="text-checkbox">Gambar</span>
                                                        </div>
                                                        <div class="form-checkbox-kontrak d-flex">
                                                            <input name="supporting_document_type" type="checkbox"
                                                                id="checkbox_kontrak" value="2"
                                                                onclick="handleCheckboxClick('kontrak')"
                                                                {{ $detailss->supporting_document_type == 2 ? 'checked' : '' }}>
                                                            <span for="checkbox_kontrak"
                                                                class="text-checkbox">Kontrak</span>
                                                        </div>
                                                        <div class="form-checkbox-brosur d-flex">
                                                            <input name="supporting_document_type" type="checkbox"
                                                                id="checkbox_brosur" value="3"
                                                                onclick="handleCheckboxClick('brosur')"
                                                                {{ $detailss->supporting_document_type == 3 ? 'checked' : '' }}>
                                                            <span for="checkbox_brosur"
                                                                class="text-checkbox">Brosur</span>
                                                        </div>
                                                    </div>

                                                    <label for="choosefile" class="drop-container" id="dropcontainer">
                                                        <span class="drop-title">Drop files here or click to upload</span>
                                                        <input name="supporting_document_file[]" type="file"
                                                            id="choosefile" multiple onchange="handleFileSelect(this)">
                                                    </label>

                                                    <div>
                                                        <ul id="fileList" class="mt-2">
                                                            @foreach ($suratPerintahKerja->details as $detail)
                                                                @if (isset($detail['supporting_document_file']))
                                                                    @foreach (json_decode($detail['supporting_document_file'], true) as $filePath)
                                                                        <li id="listFileDokumen"
                                                                            name="supporting_document_file[]">
                                                                            {{ basename($filePath) }}
                                                                        </li>
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>

                                                    <div id="alertFileLimit" class="alert alert-danger"
                                                        style="display: none; position: relative; bottom:3px;">
                                                        <strong style="color: red; font-weight: bold; font-size: 17px;">
                                                            Peringatan!
                                                        </strong>
                                                        <p>Anda hanya dapat memilih maksimal 3 file.</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="pr-4 py-2 col-12" id="tambahFieldContainer"
                                                style="display: none; margin-top:3px;">
                                                <button id="tambahField" type="button"
                                                    class="btn button-tambah font-weight-bold">
                                                    <span class="btn-label">
                                                        <i class="fa-solid fa-plus"></i>
                                                        Tambah
                                                    </span>
                                                </button>
                                            </div>

                                            <div style="width:99.5%;" id="itemFields">
                                                @if (isset($details))
                                                    @foreach ($details as $detail)
                                                        <div class="row mb-2" style="margin-left: 0px;">
                                                            <div class="pr-4 py-2 col-2" id="spesifikasiContainer">
                                                                <span
                                                                    class="text-sm font-weight-bold text-form-detail">Spesifikasi</span>
                                                                <input type="text" id="spesifikasi" name="spesifikasi[]" value="{{ $detail->spesifikasi }}" class="form-control bg-light" style="height: 40px;" required>
                                                            </div>

                                                            <div class="pr-4 py-2 col-2" id="aliasContainer">
                                                                <span
                                                                    class="text-sm font-weight-bold text-form-detail">Alias</span>
                                                                <input type="text" id="alias" name="alias[]" value="{{ $detail->alias }}" class="form-control bg-light" style="height: 40px;">
                                                            </div>

                                                            <div class="pr-4 py-2 col-2" id="jumlahContainer">
                                                                <span
                                                                    class="text-sm font-weight-bold text-form-detail">Jumlah</span>
                                                                <input type="number" id="jumlah" name="jumlah[]" value="{{ $detail->jumlah }}" class="form-control bg-light text-center" style="height: 40px;" required>
                                                            </div>

                                                            <div class="pr-4 py-2 col-1" id="satuanContainer">
                                                                <span
                                                                    class="text-sm font-weight-bold text-form-detail">Satuan</span>
                                                                <input type="text" id="satuan" name="satuan[]" value="{{ $detail->satuan }}" class="form-control bg-light text-center" style="height: 40px;" required>
                                                            </div>

                                                            <div class="pr-4 py-2 col-4" id="keteranganContainer">
                                                                <span class="text-sm font-weight-bold text-form-detail">
                                                                    Keterangan
                                                                </span>
                                                                <input type="text" value="{{ $detail->keterangan }}" name="keterangan[]" id="keterangan" class="form-control bg-light" style="height: 40px;" required>
                                                            </div>

                                                            <div class="py-2 col-1 JS-button-delete" id="deleteContainer"
                                                                style="display: flex; justify-content: flex-end; padding-right: 35px;">
                                                                <button class="btn btn-danger font-weight-bold JS-delete-btn" id="buttonDelete" style=" font-size: 11px; margin-top:21px; position: absolute; right: 29px; width:54px;" disabled>
                                                                    <i class="fa-solid fa-minus"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row pr-3 pb-2">
                                <div class="col-12 col-lg-12 col-md-12 col-sm-12 d-flex ">
                                    <div class="font-weight-bold text-lg padding-project pt-form-create text-center">
                                        <span class="head-project">Hormat<br>Kami</span>
                                        <span class="hide-project">Project</span>
                                    </div>
                                    <div class="d-block w-100">
                                        <div class="row py-2">
                                            @foreach ($suratPerintahKerja->approvals as $suratPerintahKerja)
                                                <div class="pr-4 py-2 col-6">
                                                    <span class="text-sm font-weight-bold text-form-detail">Pemohon</span>
                                                    <input name="applicant_name" class="form-control w-100 disabled-input-project" type="text" value="{{ $suratPerintahKerja->applicant_name }}" style="background-color: #D9D9D9 !important; color:black; font-weight:500;" required>
                                                </div>
                                                <div class="pr-4 py-2 col-6">
                                                    <span class="text-sm font-weight-bold text-form-detail">Jabatan</span>
                                                    <input name="applicant_position" class="form-control w-100 disabled-input-project" type="text" value="{{ $suratPerintahKerja->applicant_position }}" style="background-color: #D9D9D9 !important; color:black; font-weight:500;" required>
                                                </div>

                                                <div class="pr-4 py-2 col-6">
                                                    <span class="text-sm font-weight-bold text-form-detail">Penerima</span>
                                                    <input id="receiverInput" name="receiver_name" class="form-control w-100 disabled-input-project" type="text" value="{{ $suratPerintahKerja->receiver_name }}" style="background-color: #D9D9D9 !important; color:black; font-weight:500;">
                                                </div>

                                                <div class="pr-4 py-2 col-6">
                                                    <span class="text-sm font-weight-bold text-form-detail">Jabatan</span>
                                                    <input id="positionInput" name="receiver_position" class="form-control w-100 disabled-input-project" type="text" value="{{ $suratPerintahKerja->receiver_position }}" style="background-color: #D9D9D9 !important; color:black; font-weight:500;">
                                                </div>

                                                <div class="pr-4 py-2 col-6">
                                                    <span class="text-sm font-weight-bold text-form-detail">Menyetujui</span>
                                                    <input name="approver_name" class="form-control w-100 disabled-input-project" type="text" value="{{ $suratPerintahKerja->approver_name }}" style="background-color: #D9D9D9 !important; color:black; font-weight:500;" required>
                                                </div>
                                                <div class="pr-4 py-2 col-6">
                                                    <span class="text-sm font-weight-bold text-form-detail">Jabatan</span>
                                                    <input name="approver_position" class="form-control w-100 disabled-input-project" type="text" value="{{ $suratPerintahKerja->approver_position }}" style="background-color: #D9D9D9 !important; color:black; font-weight:500;" required>
                                                </div>

                                                <div class="pr-4 py-2 col-6" style="position: relative !important; right: 4px !important;">
                                                    <span for="board_of_directors" class="text-sm font-weight-bold text-form-detail">Mengetahui</span>
                                                    <select name="board_of_directors[]" id="board_of_directors" class="form-control select2" multiple="multiple" style="width: 100% !important;" required>
                                                        <option value="1"
                                                            {{ in_array(1, json_decode($suratPerintahKerja->board_of_directors)) ? 'selected' : '' }}>
                                                            Erwin Danuaji
                                                        </option>
                                                        <option value="2"
                                                            {{ in_array(2, json_decode($suratPerintahKerja->board_of_directors)) ? 'selected' : '' }}>
                                                            Victor
                                                        </option>
                                                        <option value="3"
                                                            {{ in_array(3, json_decode($suratPerintahKerja->board_of_directors)) ? 'selected' : '' }}>
                                                            Sindu Irawan
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="pr-4 py-2 col-6">
                                                    <span class="text-sm font-weight-bold text-form-detail">
                                                        Jabatan
                                                    </span>
                                                    <input name="position" id="position" class="form-control w-100 disabled-input-project" value="{{ $suratPerintahKerja->position }}" type="text" style="background-color: #D9D9D9 !important; color:black; font-weight:500;" required>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-center p-4 rounded-pill">
                                        <button id="submitSave" class="btn btn-save" type="submit"
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
        // function approval spk
        $(document).ready(function() {
            $('#board_of_directors').select2({
                placeholder: 'Pilih Mengetahui',
                allowClear: true,
                ajax: {
                    url: '{{ route("getApprovalSpk") }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            name: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                maximumSelectionLength: 2 
            }).on('change', function() {
                let selectedValues = $(this).val();
                console.log('Selected values:', selectedValues);
                
                if (selectedValues && selectedValues.length > 2) {
                    $(this).val(selectedValues.slice(0, 2)).trigger('change');
                    alert('Anda hanya bisa memilih maksimal dua item.');
                }
                
                if (selectedValues && selectedValues.length > 0) {
                    $('#position').val('BOD');
                } else {
                    $('#position').val('');
                }

                console.log('Position value set to:', $('#position').val());
            });
        });


        // Function PIC auto penerima
        document.addEventListener('DOMContentLoaded', function() {
            var picSelect = document.getElementById('picSelect');
            var receiverInput = document.getElementById('receiverInput');
            var positionInput = document.getElementById('positionInput');
            function setInitialValues() {
                if (picSelect.value === "-") {
                    receiverInput.value = "-";
                    positionInput.value = "-";
                }
            }
            setInitialValues();
            picSelect.addEventListener('change', function() {
                var selectedValue = this.value;
                if (selectedValue === "-") {
                    receiverInput.value = "-";
                    positionInput.value = "-";
                } else {
                    receiverInput.value = selectedValue;
                    positionInput.value = "Asisten";
                }
            });
        });

        // project id
        function changeProjectName() {
            var selectBox = document.getElementById("project_id");
            var selectedOption = selectBox.options[selectBox.selectedIndex];

            var title = selectedOption.getAttribute('data-title');
            var user = selectedOption.getAttribute('data-user');
            var mainContractor = selectedOption.getAttribute('data-main-contractor');
            var projectManager = selectedOption.getAttribute('data-project-manager');

            document.getElementById("nama").value = title ? title : '';
            document.getElementById("user").value = user ? user : '';
            document.getElementById("main_contractor").value = mainContractor ? mainContractor : '';
            document.getElementById("project_manager").value = projectManager ? projectManager : '';
        }

        document.getElementById('uraian-pekerjaan').addEventListener('input', function(event) {
            var textarea = event.target;
            var text = textarea.value;
            textarea.value = text;
        });


        function handleSubmit(event) {
            event.preventDefault();
            const form = event.target;
            const submitButton = document.getElementById('submitSave');
            if (isFormValid(form)) {
                submitButton.disabled = true;
                submitButton.innerText = 'Processing...';
                console.log('Button has been disabled successfully.');
                setTimeout(() => {
                    form.submit();
                }, 1000);
            } else {
                console.log('Form is not valid. Please fill out all required fields.');
            }
        }

        function isFormValid(form) {
            const requiredFields = form.querySelectorAll('input[required], select[required], textarea[required]');
            let allValid = true;
            requiredFields.forEach((field) => {
                if (!isVisible(field) || field.value.trim() !== '') {
                    return;
                }
                allValid = false;
            });
            return allValid;
        }

        function isVisible(elem) {
            return !!(elem.offsetWidth || elem.offsetHeight || elem.getClientRects().length);
        }


        document.getElementById('submitSave').addEventListener('click', function() {
            console.log('Submit Save button clicked');
        });


        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('choosefile');
            const fileListElement = document.getElementById('fileList');
            const checkboxGambar = document.getElementById('checkbox_gambar');
            const checkboxKontrak = document.getElementById('checkbox_kontrak');
            const checkboxBrosur = document.getElementById('checkbox_brosur');
            const alertFileLimit = document.getElementById('alertFileLimit');

            function isAnyCheckboxSelected() {
                return checkboxGambar.checked || checkboxKontrak.checked || checkboxBrosur.checked;
            }

            function isFileListEmpty() {
                return fileListElement.children.length === 0;
            }

            function updateFileInputRequired() {
                if (isAnyCheckboxSelected() && isFileListEmpty()) {
                    fileInput.setAttribute('required', 'required');
                } else {
                    fileInput.removeAttribute('required');
                }
            }

            fileInput.addEventListener('change', function() {
                const files = fileInput.files;

                alertFileLimit.style.display = 'none';

                fileListElement.innerHTML = '';
                if (files.length > 3) {
                    alertFileLimit.style.display = 'block';
                    fileInput.value = '';
                    return;
                }

                if (files.length > 0) {
                    fileInput.removeAttribute('required');

                    if (!isAnyCheckboxSelected()) {
                        checkboxGambar.checked = true;
                        handleCheckboxClick('gambar');
                    }

                    for (let i = 0; i < files.length; i++) {
                        const listItem = document.createElement('li');
                        listItem.textContent = files[i].name;
                        fileListElement.appendChild(listItem);
                    }
                } else {
                    updateFileInputRequired();
                }
            });

            window.handleCheckboxClick = function(type) {
                console.log(type + ' checkbox clicked');

                let clickedCheckbox;

                switch (type) {
                    case 'gambar':
                        clickedCheckbox = checkboxGambar;
                        checkboxKontrak.checked = false;
                        checkboxBrosur.checked = false;
                        break;
                    case 'kontrak':
                        clickedCheckbox = checkboxKontrak;
                        checkboxGambar.checked = false;
                        checkboxBrosur.checked = false;
                        break;
                    case 'brosur':
                        clickedCheckbox = checkboxBrosur;
                        checkboxGambar.checked = false;
                        checkboxKontrak.checked = false;
                        break;
                    default:
                        return;
                }

                if (!isAnyCheckboxSelected()) {
                    fileListElement.innerHTML = '';
                    fileInput.value = '';
                    fileInput.removeAttribute('required');
                } else {
                    updateFileInputRequired();
                }

                console.log(type + ' checkbox clicked');
            };

            checkboxGambar.addEventListener('change', function() {
                handleCheckboxClick('gambar');
            });
            checkboxKontrak.addEventListener('change', function() {
                handleCheckboxClick('kontrak');
            });
            checkboxBrosur.addEventListener('change', function() {
                handleCheckboxClick('brosur');
            });

            updateFileInputRequired();
        });

        const deleteButtons = document.querySelectorAll('.JS-delete-btn');
        for (let i = 1; i < deleteButtons.length; i++) {
            deleteButtons[i].disabled = false;
        }
        deleteButtons[0].addEventListener('click', function() {});
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


        function toggleTypeFormat() {
            var selectBox = document.getElementById('type_format_pekerjaan');
            var selectedValue = selectBox ? selectBox.options[selectBox.selectedIndex].value : null;

            var filePendukung = document.getElementById('filePendukung');
            var tambahFieldContainer = document.getElementById('tambahFieldContainer');
            var spesifikasiContainer = document.getElementById('spesifikasiContainer');
            var aliasContainer = document.getElementById('aliasContainer');
            var jumlahContainer = document.getElementById('jumlahContainer');
            var satuanContainer = document.getElementById('satuanContainer');
            var keteranganContainer = document.getElementById('keteranganContainer');
            var deleteContainer = document.getElementById('deleteContainer');
            var fileListContainer = document.getElementById('fileList');
            var itemFieldsContainer = document.getElementById('itemFields');
            var uraianPekerjaan = document.getElementById('uraianPekerjaan');
            var uraianPekerjaanLabel = uraianPekerjaan.querySelector('span.text-form-detail');
            var uraianPekerjaanTextarea = document.getElementById('uraian-pekerjaan');
            var toContainer = document.getElementById('to_container');
            var containerTypeFormat = document.getElementById('container_type_format');

            if (!selectedValue) {
                console.error("Select box or its value is not found.");
                return;
            }

            if (selectedValue === 'Surat Perintah Kerja') {
                if (filePendukung) filePendukung.style.display = 'block';

                if (tambahFieldContainer) tambahFieldContainer.style.display = 'none';
                if (spesifikasiContainer) spesifikasiContainer.style.display = 'none';
                if (aliasContainer) aliasContainer.style.display = 'none';
                if (jumlahContainer) jumlahContainer.style.display = 'none';
                if (satuanContainer) satuanContainer.style.display = 'none';
                if (keteranganContainer) keteranganContainer.style.display = 'none';
                if (deleteContainer) deleteContainer.style.display = 'none';
                if (itemFieldsContainer) {
                    if (itemFieldsContainer.children.length > 1) {
                        while (itemFieldsContainer.children.length > 1) {
                            itemFieldsContainer.removeChild(itemFieldsContainer.lastChild);
                        }
                    }
                    itemFieldsContainer.style.display = 'none';
                }

                if (document.getElementById('spesifikasi')) document.getElementById('spesifikasi').removeAttribute('required');
                if (document.getElementById('jumlah')) document.getElementById('jumlah').removeAttribute('required');
                if (document.getElementById('satuan')) document.getElementById('satuan').removeAttribute('required');
                if (document.getElementById('keterangan')) document.getElementById('keterangan').removeAttribute('required');

                if (document.getElementById('spesifikasi')) document.getElementById('spesifikasi').value = null;
                if (document.getElementById('alias')) document.getElementById('alias').value = null;
                if (document.getElementById('jumlah')) document.getElementById('jumlah').value = null;
                if (document.getElementById('satuan')) document.getElementById('satuan').value = null;
                if (document.getElementById('keterangan')) document.getElementById('keterangan').value = null;
                if (document.getElementById('select_to')) document.getElementById('select_to').value = null;

                uraianPekerjaan.classList.remove('col-12');
                uraianPekerjaan.classList.add('col-6');
                if (uraianPekerjaanLabel) uraianPekerjaanLabel.textContent = 'Uraian Pekerjaan';

                if (toContainer) toContainer.style.display = 'none';
                containerTypeFormat.classList.remove('col-3');
                containerTypeFormat.classList.add('col-6');

            } else if (selectedValue === 'Surat Permintaan Barang') {
                if (tambahFieldContainer) tambahFieldContainer.style.display = 'block';
                if (spesifikasiContainer) spesifikasiContainer.style.display = 'block';
                if (aliasContainer) aliasContainer.style.display = 'block';
                if (jumlahContainer) jumlahContainer.style.display = 'block';
                if (satuanContainer) satuanContainer.style.display = 'block';
                if (keteranganContainer) keteranganContainer.style.display = 'block';
                if (deleteContainer) deleteContainer.style.display = 'block';
                if (itemFieldsContainer) itemFieldsContainer.style.display = 'block';

                if (filePendukung) filePendukung.style.display = 'none';

                if (document.getElementById('choosefile')) document.getElementById('choosefile').removeAttribute('required');

                if (document.getElementById('choosefile')) document.getElementById('choosefile').value = null;
                if (fileListContainer) fileListContainer.value = null;

                if (document.getElementById('checkbox_gambar')) document.getElementById('checkbox_gambar').checked = false;
                if (document.getElementById('checkbox_kontrak')) document.getElementById('checkbox_kontrak').checked =
                    false;
                if (document.getElementById('checkbox_brosur')) document.getElementById('checkbox_brosur').checked = false;

                if (document.getElementById('spesifikasi')) document.getElementById('spesifikasi').setAttribute('required',
                    'required');
                if (document.getElementById('jumlah')) document.getElementById('jumlah').setAttribute('required',
                    'required');

                if (fileListContainer) {
                    fileListContainer.innerHTML = '';
                }

                uraianPekerjaan.classList.remove('col-6');
                uraianPekerjaan.classList.add('col-12');
                if (uraianPekerjaanLabel) uraianPekerjaanLabel.textContent = 'Catatan';

                if (toContainer) toContainer.style.display = 'block';
                containerTypeFormat.classList.remove('col-6');
                containerTypeFormat.classList.add('col-3');

            }
        }
        document.addEventListener("DOMContentLoaded", function() {
            toggleTypeFormat();
        });


        $(document).ready(function() {
            $("#tambahField").click(function(e) {
                e.preventDefault();
                addNewRow();
            });

            function addNewRow() {
                var newRow = `
            <div class="row mb-2" style="margin-left: 0px;">
                <div class="pr-4 py-2 col-2" id="spesifikasiContainer">
                    <span class="text-sm font-weight-bold text-form-detail">Spesifikasi</span>
                    <input type="text" id="newspesifikasi" name="spesifikasi[]" class="form-control bg-light w-100" style="height: 40px;" required>
                </div>

                <div class="pr-4 py-2 col-2" id="aliasContainer">
                    <span class="text-sm font-weight-bold text-form-detail">Alias</span>
                    <input type="text" id="newsalias" name="alias[]" class="form-control bg-light w-100" style="height: 40px;" required>
                </div>

                <div class="pr-4 py-2 col-2" id="jumlahContainer">
                    <span class="text-sm font-weight-bold text-form-detail">Jumlah</span>
                    <input type="number" name="jumlah[]" id="newjumlah" class="form-control bg-light text-center w-100" style="height: 40px;" required>
                </div>

                <div class="pr-4 py-2 col-1" id="satuanContainer">
                    <span class="text-sm font-weight-bold text-form-detail">Satuan</span>
                    <input type="text" name="satuan[]" id="newsatuan" class="form-control bg-light text-center w-100" style="height: 40px;" required>
                </div>

                <div class="pr-4 py-2 col-4" id="keteranganContainer">
                    <span class="text-sm font-weight-bold text-form-detail">Keterangan</span>
                    <input type="text" name="keterangan[]" id="newketerangan" class="form-control bg-light w-100" style="height: 40px;" required>
                </div>

                <div class="py-2 col-1 JS-button-delete" id="deleteContainer" style="display: flex; justify-content: flex-end; padding-right: 35px; position:relative; left:9px;">
                    <button class="btn btn-danger font-weight-bold JS-delete-btn" style="font-size: 11px; margin-top:21px; padding-right: 29px; width:54px;">
                        <i class="fa-solid fa-minus"></i>
                    </button>
                </div>
            </div>`;
                $("#itemFields").append(newRow);
                activateDeleteButtons();
                activateAutoHeight();
            }

            function activateDeleteButtons() {
                $(".JS-delete-btn").click(function() {
                    $(this).closest(".row").remove();
                });
            }

            activateDeleteButtons();
        });


        function handleFileSelect(input) {
            var files = input.files;
            var fileList = document.getElementById('fileList');
            var errorMessages = [];

            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var fileType = file.type.toLowerCase();

                if (fileType === 'application/pdf' ||
                    fileType === 'application/msword' ||
                    fileType === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' ||
                    fileType === 'application/vnd.ms-excel' ||
                    fileType === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
                    errorMessages.push('<span class="error-message">' + file.name +
                        ' cannot be uploaded. Please choose another file.</span>');
                }
            }

            if (errorMessages.length > 0) {
                var errorMessageHtml = '<div class="alert alert-danger" role="alert">' + errorMessages.join('<br>') +
                    '</div>';
                fileList.innerHTML = errorMessageHtml;
                input.value = '';
            } else {
                fileList.innerHTML = '';
            }
        }
    </script>
@endpush

