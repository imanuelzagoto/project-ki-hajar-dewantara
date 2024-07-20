@extends('layouts.master')
@section('title')
    Tambah Pengajuan
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
                                style="color: #A0AEC0;font-size: 15px; font-weight: 500;">
                                Pages
                            </a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a href="{{ route('pengajuanDana.index') }}" class="breadcrumbs__link"
                                style="color: #A0AEC0;font-size: 15px; font-weight: 500;">
                                Pengajuan Dana
                            </a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a href="{{ route('pengajuanDana.create') }}" class="breadcrumbs__link"
                                style="color: #17a2b8;font-size: 15px; font-weight: 500;">
                                Form Pengisian Pengajuan Dana
                            </a>
                        </li>
                    </ul>
                </div>

                <button class="btn btn-sm mt--2 rounded tooltip-container" type="button"
                    style="float: left; background-color:#F1F4FA;">
                    <a class="button-logout" onclick="$('#logout-form').submit()" style="color: #D41B14;">
                        Logout
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                    <span class="tooltip-text mb-2" style="font-size: 10px;">Logout</span>
                </button>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h2 class="text-mp font-weight-bold display-6">
                        Form Pengisian Pengajuan Dana <span style="font-size: 22px; padding-left:5px;">&rArr;</span>
                        <span style="color: #a43b19; font-size: 17px; padding-left:8px;">
                            {{ $no_doc }}
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
                        <form id="form_pengajuandana" action="{{ url('/pengajuan-dana/store') }}" method="POST"
                            onsubmit="return handleSubmit(event)">
                            @csrf
                            <div class="row pr-3 pt-3">
                                <div class="col-12 col-lg-12 col-md-12 col-sm-12 d-flex">
                                    <div class="font-weight-bold text-lg padding-head pr-teks-pengajuan text-center">
                                        <span class="head-title">Head</span>
                                        <span class="detail-text">Pengaju</span>
                                    </div>
                                    <div class="d-block w-100">
                                        <div class="row py-2">
                                            <div class="pr-4 py-2 col-4">
                                                <span class="text-sm font-weight-bold text-form-detail">Subjek</span>
                                                <input name="subject" class="form-control bg-light w-100" type="text"
                                                    autofocus required>
                                                <span id="subject-error" class="error-message"></span>
                                            </div>

                                            <div class="pr-4 py-2 col-4" id="container_revisi">
                                                <span class="text-sm font-weight-bold text-form-detail">Revisi</span>
                                                <input name="revisi" class="form-control bg-light w-100" type="text"
                                                    required>
                                            </div>

                                            <div class="pr-4 py-2 col-4">
                                                <span class="text-sm font-weight-bold text-form-detail">Project Manager</span>
                                                <select name="project_manager" class="form-control bg-light w-100" required>
                                                    <option value="" disabled selected></option>
                                                    @foreach ($projects as $p)
                                                        <option value="{{ $p['project_manager'] }}">{{ $p['project_manager'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>            

                                            <div class="pr-4 py-2 col-6" id="container_tanggalPengajuan"
                                                style="position: relative; bottom:3px;">
                                                <span class="text-sm font-weight-bold text-form-detail">Tanggal
                                                    Pengajuan</span>
                                                <input name="tanggal_pengajuan" id="tanggalPengajuan" type="date"
                                                    class="form-control w-100 disabled-input-project" required
                                                    style="background-color: #D9D9D9 !important; color:black; font-weight:500;">
                                            </div>

                                            <div class="pr-4 py-2 col-6" id="container_method">
                                                <span class="text-sm font-weight-bold text-form-detail"
                                                    style="display: block;">Projek</span>
                                                <select id="kode_Project" name="project" class="form-control bg-light w-100"
                                                    onchange="onchangeProjectid()" required>
                                                    <option value="Project">Project</option>
                                                    <option value="Non Project">Non Project</option>
                                                </select>
                                            </div>

                                            <div class="pr-4 py-2 col-4" id="container_selectProject"
                                                style="display: none;">
                                                <span class="text-sm font-weight-bold text-form-detail"
                                                    style="position:relative; bottom:2.8px;">Pilih Kode
                                                    Projek</span>
                                                <select id="selectProject" name="code"
                                                    class="form-control bg-light selectProject"
                                                    style="max-width: 100%; width:100%;" required>
                                                    <option value="" disabled selected></option>
                                                    @foreach ($projects as $p)
                                                        <option value="{{ $p['code'] }}">{{ $p['code'] }}</option>
                                                    @endforeach
                                                </select>
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
                                            <div class="pr-4 py-2 col-5" id="tujuan_container">
                                                <span class="text-sm font-weight-bold text-form-detail">
                                                    Tujuan
                                                </span>
                                                <input name="tujuan"
                                                    class="form-control bg-light w-100 disabled-input-project"
                                                    type="text" value="Finance"
                                                    style="background-color: #D9D9D9 !important; color:black; font-weight:500;"
                                                    required>
                                            </div>
                                            <div class="pr-4 py-2 col-6" id="lokasi_container">
                                                <span class="text-sm font-weight-bold text-form-detail">Lokasi</span>
                                                <select name="lokasi" class="form-control bg-light w-100" required>
                                                    <option value="" disabled selected></option>
                                                    <option value="Tebet">Tebet</option>
                                                    <option value="Cikunir">Cikunir</option>
                                                </select>
                                            </div>
                                            <div class="pr-4 py-2 col-3" id="deadline_container">
                                                <span class="text-sm font-weight-bold text-form-detail">Batas
                                                    Waktu</span>
                                                <input name="batas_waktu" class="form-control bg-light w-100"
                                                    type="date" required>
                                            </div>

                                            <div class="pr-4 py-2 col-3">
                                                <span class="text-sm font-weight-bold text-form-detail">Nominal</span>
                                                <input name="subtotal" id="subtotalInput"
                                                    class="form-control w-100 disabled-input-project" type="text"
                                                    style="background-color: #D9D9D9 !important; text-align: right; color:black; font-weight:500;"
                                                    required readonly>
                                            </div>

                                            <div class="pr-4 py-2 col-3">
                                                <span class="text-sm font-weight-bold text-form-detail">Terbilang</span>
                                                <input name="terbilang"
                                                    class="form-control bg-light w-100 disabled-input-project"
                                                    style="background-color: #D9D9D9 !important; text-align: right; color:black; font-weight:500;"
                                                    type="text" required readonly>
                                            </div>

                                            <div class="pr-4 py-2 col-2" id="container_penerimaan">
                                                <span class="text-sm font-weight-bold text-form-detail">Metode
                                                    Penerimaan</span>
                                                <select id="metode_penerimaan" class="form-control bg-light w-100"
                                                    onchange="toggleRekeningInput()">
                                                    <option value="transfer">Transfer</option>
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
                                                    style="font-size: 11px; color: black; font-weight: 500;" required>
                                            </div>

                                            <div id="namaBankInput" class="pr-4 col-2"
                                                style="margin-top: 8px; display: none;">
                                                <span class="text-sm font-weight-bold text-form-detail">Nama
                                                    Bank</span>
                                                <input id="namabank" name="nama_bank"
                                                    class="form-control bg-light w-100" type="text"
                                                    placeholder="Bank tujuan"
                                                    style="font-size: 11px; color: black; font-weight: 500;" required>
                                            </div>

                                            <div class="pr-4 py-2 col-12">
                                                <span class="text-sm font-weight-bold text-form-detail">Catatan</span>
                                                <textarea name="catatan" class="form-control bg-light w-100" rows="3" style="resize: none;"></textarea>
                                            </div>
                                        </div>
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
                                                    type="text"
                                                    style="font-size: 10px; font-weight: bold; color: #92A1BB; height:10px; width:11px; visibility: hidden;">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row pr-3 pt-3">
                                <div class="col-12 col-lg-12 col-md-12 col-sm-12 d-flex ">
                                    <div class="font-weight-bold text-lg padding-head pr-teks-pengajuan text-center">
                                        <span class="head-pengaju">Pengaju</span>
                                        <span class="detail-text">Pengaju</span>
                                    </div>
                                    <div class="d-block w-100">
                                        <div class="row py-2">
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail"
                                                    style="position: relative; left:2px;">Pemohon</span>
                                                <input name="nama_pemohon" class="form-control bg-light w-100"
                                                    type="text" style="position: relative; left:1px;" required>
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span class="text-sm font-weight-bold text-form-detail"
                                                    style="position: relative; right:2px;">Jabatan</span>
                                                <input name="jabatan_pemohon" class="form-control bg-light w-100"
                                                    style="position: relative; right:3px;" type="text" required>
                                            </div>
                                            <div class="pr-4 py-2 col-6">
                                                <span for="nama_pemeriksa"
                                                    class="text-sm font-weight-bold text-form-detail">Pemeriksa</span>
                                                <select name="pemeriksa[]" id="nama_pemeriksa"
                                                    class="form-control select2" multiple="multiple"
                                                    style="width: 100% !important;">
                                                </select>
                                            </div>
                                            <div class="pr-4 py-2 col-6"
                                                style="position: relative !important; right: 4px !important;">
                                                <span for="nama_menyetujui"
                                                    class="text-sm font-weight-bold text-form-detail">Menyetujui</span>
                                                <select name="persetujuan[]" id="nama_menyetujui"
                                                    class="form-control select2" multiple="multiple"
                                                    style="width: 100% !important;" required>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-center p-4 rounded-pill">
                                        <button id="submitSave" class="btn btn-save" type="submit">
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
        function onchangeProjectid() {
            const projectDropdown = document.getElementById('kode_Project');
            const selectedValue = projectDropdown.value;
            const containerSelectProject = document.getElementById('container_selectProject');
            const selectProject = document.getElementById('selectProject');

            const columnsToResizeTanggal = [
                document.getElementById('container_tanggalPengajuan')
            ];
            const columnsToResizeProjek = [
                document.getElementById('container_method')
            ];

            if (selectedValue === 'Project') {
                containerSelectProject.style.display = 'block';

                columnsToResizeTanggal.forEach(column => {
                    column.classList.remove('col-6');
                    column.classList.add('col-4');
                });
                columnsToResizeProjek.forEach(column => {
                    column.classList.remove('col-6');
                    column.classList.add('col-4');
                });

                $(selectProject).select2({
                    placeholder: 'Pilih Kode Projek',
                    allowClear: true
                });

                selectProject.setAttribute('required', 'required');
            } else {
                containerSelectProject.style.display = 'none';
                columnsToResizeTanggal.forEach(column => {
                    column.classList.remove('col-4');
                    column.classList.add('col-6');
                });
                columnsToResizeProjek.forEach(column => {
                    column.classList.remove('col-4');
                    column.classList.add('col-6');
                });
                $(selectProject).select2('destroy');
                selectProject.removeAttribute('required');
                selectProject.value = '';
            }
        }

        // Inisialisasi Select2 pada dokumen siap
        $(document).ready(function() {
            $('.selectProject').select2({
                placeholder: 'Pilih Kode Projek',
                allowClear: true
            });

            const projectDropdown = document.getElementById('kode_Project');
            const selectedValue = projectDropdown.value;
            onchangeProjectid();
            $(projectDropdown).trigger('change');
        });


        // select2 multiple approval
        $(document).ready(function() {
            function handleNoResults(data, params) {
                if (data.length === 0) {
                    return [{
                        id: 'no_results',
                        text: 'Hasil tidak ditemukan',
                        disabled: true
                    }, ];
                }
                return $.map(data, function(item) {
                    return {
                        text: item.text,
                        id: item.id
                    };
                });
            }

            function initializeSelect2(selector, placeholder, otherSelector) {
                $(selector).select2({
                    ajax: {
                        url: '/get-approval',
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                name: params.term
                            };
                        },
                        processResults: function(data, params) {
                            return {
                                results: handleNoResults(data, params)
                            };
                        },
                        cache: true
                    },
                    multiple: true,
                    placeholder: `Pilih ${placeholder}`,
                    width: '100%'
                }).on('select2:select', function(e) {
                    var selectedData = e.params.data.id;
                    var otherSelect = $(otherSelector);
                    var otherValues = otherSelect.val();

                    otherValues = otherValues.filter(function(value) {
                        return value !== selectedData;
                    });
                    otherSelect.val(otherValues).trigger('change');

                }).on('select2:unselect', function(e) {
                    var removedData = e.params.data.id;
                });

            }

            initializeSelect2('#nama_pemeriksa', 'Pemeriksa', '#nama_menyetujui');
            initializeSelect2('#nama_menyetujui', 'Menyetujui', '#nama_pemeriksa');
            $('#nama_pemeriksa, #nama_menyetujui').on('change', function() {
                var pemeriksaValue = $('#nama_pemeriksa').val();
                var menyetujuiValue = $('#nama_menyetujui').val();
                if (pemeriksaValue && menyetujuiValue) {
                    var commonValue = pemeriksaValue.filter(function(value) {
                        return menyetujuiValue.indexOf(value) !== -1;
                    });
                    if (commonValue.length > 0) {
                        $('#nama_menyetujui, #nama_pemeriksa').not(this).val(function(index, value) {
                            return value.filter(function(val) {
                                return commonValue.indexOf(val) === -1;
                            });
                        }).trigger('change');
                    }
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            var inputElement = document.querySelector('input[name="terbilang"]');
            if (inputElement) {
                var terbilangValue = inputElement.value;
                inputElement.value = ucfirst(terbilangValue);
            }

            function ucfirst(str) {
                return str.charAt(0).toUpperCase() + str.slice(1);
            }
        });

        window.onload = function() {
            toggleRekeningInput();
        };

        function toggleRekeningInput() {
            var metodePenerimaan = document.getElementById("metode_penerimaan").value;
            var nomorRekeningInput = document.getElementById("nomorRekeningInput");
            var namaBankInput = document.getElementById("namaBankInput");
            var nomorRekeningField = document.getElementById("nomor_rekening");
            var namaBankField = document.getElementById("namabank");
            var inputTunaiContainer = document.getElementById("input_tunai_container");
            var inputTunai = document.getElementById("inputTunai");
            var containerMethod = document.getElementById("container_penerimaan");
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
                nomorRekeningField.setAttribute('required', 'required');
                namaBankField.setAttribute('required', 'required');

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
                nomorRekeningField.removeAttribute('required');
                namaBankField.removeAttribute('required');
                nomorRekeningField.value = "";
                namaBankField.value = "";
            }
        }

        var currentDate = new Date();

        var year = currentDate.getFullYear();
        var month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
        var day = ('0' + currentDate.getDate()).slice(-2);
        var formattedDate = year + '-' + month + '-' + day;
        document.getElementById('tanggalPengajuan').value = formattedDate;

        // Fungsi Datetime
        document.addEventListener('DOMContentLoaded', function() {
            setInterval(updateClock, 1000);
            updateClock();
        });

        function updateClock() {
            var now = new Date();
            var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                'Oktober',
                'November', 'Desember'
            ];
            var options = {
                timeZone: 'Asia/Jakarta',
                weekday: 'long'
            };
            var dayName = new Intl.DateTimeFormat('id-ID', options).format(now);

            var dateTimeString = '<i class="fas fa-calendar"></i>&nbsp;' + dayName + ', ' + now.getDate() + ' ' +
                months[now.getMonth()] + ' ' + now.getFullYear() +
                '&nbsp;&nbsp;<i class="far fa-clock"></i>&nbsp;' +
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
            seconds = seconds < 10 ? '0' +
                seconds : seconds;
            var strTime = hours + ':' + minutes + ':' + seconds;
            return strTime;
        }

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

        // document.addEventListener('keydown', handleEnterKey);
    </script>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            addNewRow();
            $("#tambahField").click(function() {
                addNewRow();
            });
            function addNewRow() {
                var newRow = `
                        <div class="row py-2" style="margin-left: 90px;">
                            <div class="py-2 col-2">
                                <span class="text-sm font-weight-bold text-form-detail form_item">Nama item</span>
                                <input name="nama_item[]" class="form-control bg-light w-100" type="text" required>
                        
                            </div>

                            <div class="py-2 col-2">
                                <span class="text-sm font-weight-bold text-form-detail form_item">Nama Alias</span>
                                <input name="alias[]" class="form-control bg-light w-100" type="text">
                        
                            </div>

                            <div class="py-2 col-2">
                                <span class="text-sm font-weight-bold text-form-detail form_item">Jumlah</span>
                                <input name="jumlah[]" class="form-control bg-light jumlah w-100" type="number" style="left:-11px; text-align:center;" required>
                        
                            </div>
                            <div class="py-2 col-1">
                                <span class="text-sm font-weight-bold text-form-detail form_item">Satuan</span>
                                <input name="satuan[]" class="form-control bg-light w-100" type="text" style="text-align:center; font-size:11px;" required>
                        
                            </div>
                            <div class="py-2 col-2">
                                <span class="text-sm font-weight-bold text-form-detail form_item">Harga</span>
                                <input name="harga[]" class="form-control bg-light harga" type="text" style="text-align:right;"  required>
                        
                            </div>
                            <div class="py-2 col-2">
                                <span class="text-sm font-weight-bold text-form-detail form_item">Total</span>
                                <input name="total" class="form-control bg-light text-right total disabled-input-project" type="text" style="background-color: #D9D9D9 !important; text-align: left; color:black; font-weight:500;" required>
                        
                            </div>
                            <div class="py-2 col-1 JS-button-delete">
                                <button class="btn btn-sm btn-danger font-weight-bold JS-delete-btn" style="font-size: 14px; margin-top:21px;position: absolute;right: 26px;" disabled><i class="fa-solid fa-minus"></i></button>
                            </div>
                        </div>`;
                $("#itemFields").append(newRow);
                activateDeleteButtons();
            }

            function updateTerbilang() {
                var terbilang = [
                    '', 'satu ', 'dua ', 'tiga ', 'empat ', 'lima ', 'enam ', 'tujuh ', 'delapan ', 'sembilan ',
                    'sepuluh ',
                    'sebelas ', 'dua belas ', 'tiga belas ', 'empat belas ', 'lima belas ', 'enam belas ',
                    'tujuh belas ',
                    'delapan belas ', 'sembilan belas '
                ];

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

                var subtotal = parseFloat($('#subtotalInput').val().replace(/[^\d]/g, '')) || 0;
                var terbilangText = bilang(subtotal);
                terbilangText += 'rupiah';
                $('input[name="terbilang"]').val(terbilangText);
            }

            $(document).on('input', '.harga', function() {
                $(this).val(formatRupiah($(this).val(), "Rp. "));
            });

            $(document).on('input', '.jumlah, .harga', function() {
                var row = $(this).closest('.row');
                hitungTotal(row);
                hitungSubtotal();
            });

            function hitungTotal(row) {
                var jumlah = parseFloat($(row).find('.jumlah').val()) || 0;
                var harga = parseFloat($(row).find('.harga').val().replace(/[^\d]/g, '')) || 0;
                var total = jumlah * harga;
                $(row).find('.total').val(formatRupiah(total.toString(), "Rp. "));
            }

            function hitungSubtotal() {
                var subtotal = 0;
                $('.total').each(function() {
                    subtotal += parseFloat($(this).val().replace(/[^\d]/g, '')) ||
                        0;
                });
                var formattedSubtotal = formatRupiah(subtotal.toString(), "Rp. ");
                $('#subtotalInput').val(formattedSubtotal);
                updateTerbilang();
            }

            function activateDeleteButtons() {
                $('.JS-button-delete').first().find('.JS-delete-btn').prop('disabled', true);
                $('.JS-button-delete').not(':first').find('.JS-delete-btn').prop('disabled', false);
            }

            function formatRupiah(angka, prefix) {
                var number_string = angka.toString().replace(/[^,\d]/g, "").toString(),
                    split = number_string.split(","),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

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
