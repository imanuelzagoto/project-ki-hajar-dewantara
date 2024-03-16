<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Perintah Kerja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            margin: 7px;
            /* height: 6000px; */
        }

        .rectangle-outline {
            width: 730px;
            height: 987px;
            border: 2px solid black;
            position: relative;
            left: -25px;
        }

        .rectangle-outline::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0.4%;
            border-right: 2px solid black;
            height: 100%;
        }

        .pic-text {
            font-family: arial, sans-serif;
            text-align: right;
            padding-right: 6%;
            padding-top: 1%;
            margin-top: 5px;
            margin-bottom: 5px;
            font-size: 13px;
            font-weight: bold;
            top: 5px;
            right: 5px;
            color: #000;
        }

        .company {
            font-family: arial, sans-serif;
            color: #1066ad;
            font-size: 15.5pt;
            text-align: center;
            margin-bottom: 5px;
            margin-top: 5px;
        }

        .title1 {
            font-family: arial, sans-serif;
            color: #000000;
            font-size: 15.5pt;
            text-align: center;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .teks1 {
            font-family: Arial, sans-serif;
            padding-left: 11%;
            font-size: 13.5pt;
        }

        .teks1 span {
            padding: 0 7px;
        }

        .teks2 {
            font-family: Arial, sans-serif;
            padding-left: 27.9%;
            margin-top: -0.5em;
            font-size: 11.5pt;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        table {
            margin-left: 11px;
            width: 97%;
        }


        .tb {
            font-family: Arial, sans-serif;
            font-size: 11.5pt;
            font-weight: bold;
            text-align: left;
        }

        td {
            text-align: left;
            font-family: Arial, sans-serif;
            font-size: 10pt;
        }

        .semi-colon {
            text-align: center;
            width: 12px;
        }

        .horizontal-line {
            border-top: 1px solid black;
            width: 99.3%;
            margin-top: 25px;
        }

        .horizontal-line1 {
            border-top: 1px solid black;
            width: 99.3%;
            margin-top: 2.3px;
        }

        .dokumen {
            display: inline-block;
            margin-right: 20px;
            font-size: 10pt;
            font-family: Arial, sans-serif;
            padding-left: 1.8%;
            margin-top: 26px;
        }

        .checkbox-container {
            display: inline-block;
            margin-right: 10px;
            margin-bottom: 10px;
            width: 118px;
            font-family: Arial, sans-serif;
            font-size: 10pt;
            padding-left: 29px;

        }

        .box1 {
            width: 20px;
            height: 24px;
            border: 1px solid #000;
        }

        .box2 {
            width: 18px;
            height: 24px;
            border: 1px solid #000;
        }

        .box3 {
            width: 14px;
            height: 24px;
            border: 1px solid #000;
            margin-left: 4px;
        }

        .pendukung {
            position: relative;
            font-size: 10pt;
            font-family: Arial, sans-serif;
            padding-left: 1.8%;
            width: 150px;
            top: -15px;
        }

        .pendukung::after {
            content: '';
            position: absolute;
            width: 412px;
            height: 1px;
            background-color: black;
            margin-left: 13px;
            top: 12px;
        }

        .garis-lurus1 {
            border-top: 1px solid black;
            width: 99.3%;
            margin-bottom: 60px;
            margin-top: -20px;
            /* Ubah nilai margin-top */
        }

        .garis-lurus2 {
            border-top: 1px solid black;
            width: 99.3%;
            margin-top: -58px;
            /* Ubah nilai margin-top */
        }

        .job-table {
            border-top: 1px solid black;
            width: 97.8%;
            margin-top: 15px;
            margin-left: 12px;
        }

        .job-table::before,
        .job-table::after {
            content: '';
            position: absolute;
            top: 0;
            width: 1px;
            height: 33%;
            background-color: black;
        }

        .job-table::before {
            left: -10px;
            margin-top: 50.4%;
            margin-left: 3%;
        }

        .job-table::after {
            right: -10px;
            margin-right: 71.8%;
            margin-top: 50.4%;
        }

        .type-work-container {
            font-size: 10pt;
            font-family: Arial, sans-serif;
            font-weight: bold;
        }

        .type-work1,
        .Job-description {
            display: inline-block;
            margin: 10px 0 0 0;
            padding: 0;
        }

        .type-work1 {
            margin-left: 51px;
            position: relative;
        }

        .Job-description {
            margin-left: 193px;
            position: relative;
        }

        .garis-lurus3 {
            border: none;
            border-top: 1px solid black;
            width: 97.8%;
            margin-top: 3px;
            margin-left: 12px;
            margin-bottom: -8px;
        }

        .garis-lurus4 {
            border-bottom: 1px solid black;
            width: 97.8%;
            margin-top: 38%;
            margin-left: 12px;
        }

        .garis-lurus5 {
            border-bottom: 1px solid black;
            width: 97.8%;
            margin-top: -1.8%;
            margin-left: 12px;
        }

        .teks3 {
            text-align: 11pt;
            font-family: Arial, sans-serif;
            margin-top: 2%;
            margin-left: 3%;
            font-weight: normal;
        }

        .garis-lurus6 {
            border-top: 3.3px solid black;
            width: 98%;
            margin-left: 12px;
        }



        .garis-lurus7 {
            border-bottom: 3.3px solid black;
            width: 98%;
            margin-top: 25.3%;
            margin-left: 12px;
        }


        .ttd {
            font-size: 10pt;
            font-family: Arial, sans-serif;
            font-weight: bold;
        }

        .teks-tabel {
            font-family: Arial, sans-serif;
            text-align: 10pt;
            font-weight: normal;
            margin-left: 61%;
            margin-top: 1%;
        }

        .content-ttd {
            font-family: Calibri, sans-serif;
            font-size: 10.5pt;
        }

        .teks5::before,
        .teks5::before,
        .teks6::before,
        .teks7::before,
        .teks8::before,
        .teks13,
        .teks14,
        .teks15,
        .teks16,
        .teks17,
        .teks18,
        .teks19,
        .teks20,
        .teks21,
        .garis-lurus8,
        .garis-lurus9,
        .garis-lurus0,
        .garis-lurus11,
        .garis-lurus12 {
            content: "";
            border-left: 3px solid black;
            height: 99.2%;
            position: absolute;
            left: -17.7px;
            top: -2.5%;
        }

        .teks13 {
            border: none;
            margin-top: 124.4%;
            margin-left: 51.6%;
        }

        .teks14 {
            border: none;
            margin-top: 127.3%;
            margin-left: 51.6%;
        }

        .teks15 {
            border: none;
            margin-top: 109%;
            margin-left: 74.2%;
        }

        .teks16 {
            border: none;
            margin-top: 111.4%;
            margin-left: 76%;
        }

        .teks17 {
            border: none;
            margin-top: 118.6%;
            margin-left: 76%;
        }

        .teks18 {
            border: none;
            margin-top: 121.5%;
            margin-left: 74.2%;
        }

        .teks19 {
            border: none;
            margin-top: 124%;
            margin-left: 76%;
        }

        .teks20 {
            border: none;
            margin-top: 130%;
            margin-left: 76%;
        }

        .teks21 {
            border: none;
            margin-top: 136%;
            margin-left: 76%;
            font-family: Arial, sans-serif;
            font-size: 8pt;
            font-weight: bold;
        }

        .garis-lurus8 {
            margin-top: 105%;
            height: 21.5%;
            margin-left: 101.5%;
            border: 2px solid black;
        }

        .garis-lurus9 {
            margin-top: 105%;
            height: 21.5%;
            margin-left: 27%;
            border: 2px solid black;
        }

        .garis-lurus0 {
            margin-top: 105%;
            height: 21.5%;
            margin-left: 48.8%;
            border: 2px solid black;
        }

        .garis-lurus11 {
            margin-top: 105%;
            height: 21.5%;
            margin-left: 72.5%;
            border: 2px solid black;
        }

        .garis-lurus12 {
            margin-top: 105%;
            height: 21.5%;
            margin-left: 73.2%;
            border: 2px solid black;
        }

        .teks5,
        .teks6,
        .teks7,
        .teks8 {
            display: inline-block;
            margin: 10px 0 0 0;
            padding: 0;
        }

        .teks5 {
            margin-left: 4%;
            position: relative;
        }

        .teks6 {
            margin-left: 14%;
            position: relative;
        }

        .teks7 {
            margin-left: 13%;
            position: relative;
        }

        .teks8 {
            margin-left: 13%;
            position: relative;
        }

        .teks9 {
            margin-top: -10.3%;
            margin-left: 4%;
        }

        .teks0 {
            margin-left: 4%;
            margin-top: -7.2%;
        }

        .teks11 {
            margin-top: -10.5%;
            margin-left: 27%;
        }

        .teks12 {
            margin-left: 26.6%;
            margin-top: -7.5%;
        }

        .garis-lurus13 {
            border-bottom: 3px solid black;
            width: 99.5%;
            margin-top: 22px;
        }
    </style>
</head>

<body>
    @if ($surat_perintah_kerjas->isEmpty())
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <img src="no-data.svg" alt="No Data" style="max-width: 100%; height: auto;">
                    <h2 class="mt-4">Maaf, belum ada surat perintah kerja yang tersedia.</h2>
                </div>
            </div>
        </div>
    @else
        @foreach ($surat_perintah_kerjas as $suratPerintahKerja)
            <!-- Judul -->
            <div class="rectangle-outline">
                <div class="pic-text">PIC : {{ $suratPerintahKerja->pic }}</div>
                <h2 class="company">PT. SOLUSI INTEK INDONESIA</h2>
                <h2 class="title1">SURAT PERINTAH KERJA WORKSHOP</h2>
                <h3 class="teks1">Kepada Yth<span> : </span>Workshop Manager</h3>
                <p class="teks2">Mohon dapat dilaksanakan pekerjaan di bawah ini :</p>

                <!--table data -->
                <table>
                    <tr>
                        <th class="tb" style="width: 185px;">Kode Project</th>
                        <th style="font-weight: normal">:</th>
                        <th class="tb" colspan="6">{{ $suratPerintahKerja->kode_project }}</th>
                    </tr>
                    <tr>
                        <td>Nama Project</td>
                        <td>:</td>
                        <td>{{ $suratPerintahKerja->nama_project }}</td>
                        <td>NO SPK</td>
                        <td class="semi-colon">:</td>
                        <td colspan="3">{{ $suratPerintahKerja->no_spk }}</td>
                    </tr>
                    <tr>
                        <td>User</td>
                        <td>:</td>
                        <td>{{ $suratPerintahKerja->user }}</td>
                        <td>Tanggal</td>
                        <td class="semi-colon">:</td>
                        <td colspan="3">{{ $suratPerintahKerja->tanggal }}</td>
                    </tr>
                    <tr>
                        <td>Main Contractor</td>
                        <td>:</td>
                        <td>{{ $suratPerintahKerja->main_contractor }}</td>
                        <td>Prioritas</td>
                        <td class="semi-colon">:</td>
                        <td colspan="3">{{ $suratPerintahKerja->prioritas }}</td>
                    </tr>
                    <tr>
                        <td>Project Manager</td>
                        <td>:</td>
                        <td>{{ $suratPerintahKerja->project_manager }}</td>
                        <td>Waktu Penyelesaian</td>
                        <td class="semi-colon">:</td>
                        <td colspan="3">{{ $suratPerintahKerja->waktu_penyelesaian }} </td>
                    </tr>
                </table>
                <div class="horizontal-line"></div>
                <div class="horizontal-line1"></div>
                <!-- konten -->
                <p class="dokumen">Dokumen Pendukung</p>
                <label class="checkbox-container">
                    <input class="box1"> Gambar
                </label>
                <label class="checkbox-container">
                    <input class="box2"> Kontrak
                </label>
                <label class="checkbox-container">
                    <input class="box3"> Brosur
                </label>
                <p class="pendukung">File Pendukung Lainnya:</p>
                {{-- @endforeach --}}
                <div class="garis-lurus1"></div>
                <div class="garis-lurus2"></div>
                <div class="job-table"></div>
                <div class="type-work-container">
                    <p class="type-work1">JENIS PEKERJAAN</p>
                    <p class="Job-description">URAIAN PEKERJAAN</p>
                    <div class="garis-lurus3"></div>
                    <div class="garis-lurus3"></div>
                    <div class="garis-lurus4"></div>
                    <p class="teks-tabel">Bersambung ke halaman berikutnya …..........</p>
                    <div class="garis-lurus5"></div>
                    <p class="teks3">Hormat Kami,</p>
                </div>
                <div class="content-ttd">
                    <p class="teks15">1. Nama : Sindu Irawan</p>
                    <p class="teks16">Jabatan : B.O.D</p>
                    <p class="teks17">..........................</p>
                    <p class="teks18">2. Nama : Bayu Nugraha </p>
                    <p class="teks19">Jabatan : General Manager</p>
                    <p class="teks20">..........................</p>
                    <p class="teks21">Form Number : SPK/01/admin/2022</p>
                    <div class="garis-lurus6"></div>
                    <p class="teks14">Jabatan :</p>
                    <p class="teks5">Pemohon</p>
                    <p class="teks13">Nama :</p>
                    <p class="teks6">Penerima</p>
                    <p class="teks7">Menyetujui</p>
                    <p class="teks8">Mengetahui</p>
                    <div class="garis-lurus7"></div>
                    <div class="garis-lurus8"></div>
                    <div class="garis-lurus9"></div>
                    <p class="teks12">Jabatan : </p>
                    <div class="garis-lurus0"></div>
                    <p class="teks11">Nama : </p>
                    <div class="garis-lurus11"></div>
                    <p class="teks0">Jabatan : Koor PM</p>
                    <div class="garis-lurus12"></div>
                    <p class="teks9">Nama : Susilo</p>
                </div>
                <div class="garis-lurus13"></div>
            </div>
        @endforeach
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>


</html>








@extends('layouts.master')

@section('spk')
    Surat Perintah Kerja
@endsection

@section('title')
    Surat Perintah Kerja (SPK)
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mb-3">
                <button class="btn btn-perintah" style="border-radius: 7px;"
                    onclick="window.location.href='{{ route('suratPerintahKerja.create') }}'">
                    <span class="btn-label">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="tambah-perintah">Tambah Perintah</span>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="tableDataSPK"
                                style="width:100%">
                                <thead>
                                    <tr style="color: #718EBF; font-family: 'Inter', sans-serif; line-height:19.36px;">
                                        <th class="text-center" nowrap>Nama Project</th>
                                        <th class="text-center">Pemohon</th>
                                        <th class="text-center">User</th>
                                        <th class="text-center" nowrap>Main Contractor</th>
                                        <th class="text-center" nowrap>Project Manager</th>
                                        <th class="text-center" style="width:19%;">PIC</th>
                                        <th class="text-center" style="width:25%;">No SPK</th>
                                        <th class="text-center" style="width:23%;">Tanggal</th>
                                        <th class="text-center" nowrap>Tanggal selesai</th>
                                        <th class="text-center" nowrap>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suratPerintahKerjas as $spk)
                                        <tr style="color: #232323; font-family: 'Inter', sans-serif; line-height:19.36px;">
                                            <td class="text-center" style="font-weight:400;" nowrap>
                                                {{ $spk->nama_project }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;" nowrap>
                                                {{ $spk->pemohon }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;" nowrap>
                                                {{ $spk->user }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;" nowrap>
                                                {{ $spk->main_contractor }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;">
                                                {{ $spk->project_manager }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;" nowrap>
                                                {{ $spk->pic }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;" nowrap>
                                                {{ $spk->no_spk }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;" nowrap>
                                                {{ \Carbon\Carbon::createFromFormat('d/m/y', $spk->tanggal)->format('d-m-Y') }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;" nowrap>
                                                {{ \Carbon\Carbon::createFromFormat('d/m/y', $spk->waktu_penyelesaian)->format('d-m-Y') }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;" nowrap>
                                                <a href="{{ route('suratPerintahKerja.edit', $spk->id) }}"
                                                    class="fas fa-pen btn btn-sm tooltip-container"
                                                    style="color:#4FD1C5; font-size:20px;">
                                                    <span class="tooltip-edit">Edit</span>
                                                </a>
                                                <a href="{{ route('suratPerintahKerja.show', $spk->id) }}"
                                                    class="fas fa-eye btn btn-sm tooltip-container"
                                                    style="color:#1814F3; font-size:20px; border: none; margin-left:2px;">
                                                    <span class="tooltip-show">View</span>
                                                </a>

                                                <a class="fas fa-trash-alt btn btn-sm tooltip-container"
                                                    style="color:#F31414; font-size:20px;"
                                                    onclick="submitDelete({{ $spk->id }})">
                                                    <span class="tooltip-delete">Delete</span>
                                                </a>
                                                <form id="delete-form-{{ $spk->id }}"
                                                    action="{{ route('surat_perintah_kerja.destroy', $spk->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}
    <script>
        // JS DATATABLE
        $(document).ready(function() {
            var tableDataSPK = $('#tableDataSPK').DataTable({
                "pageLength": getPageLengthFromLocalStorage('tableDataSPK'),
                initComplete: function() {
                    this.api().columns().every(function() {
                        var column = this;
                        var select = $(
                                '<select class="form-control"><option value=""></option></select>'
                            )
                            .appendTo($(column.footer()).empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d +
                                '</option>');
                        });
                    });
                }
            });

            // Function to get page length from localStorage
            function getPageLengthFromLocalStorage(tableId) {
                var storedLength = localStorage.getItem(tableId + '_pageLength');
                return storedLength ? parseInt(storedLength) : 5; // Default page length
            }

            // Save page length to localStorage
            $('select[name="tableDataSPK_length"]').change(function() {
                localStorage.setItem('tableDataSPK_pageLength', $(this).val());
            });
        });

        // Function to submit delete
        function submitDelete(id) {
            Swal.fire({
                title: "HAPUS?",
                text: "Apakah anda benar-benar yakin ingin menghapus item ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#22B37C",
                cancelButtonColor: "#d33",
                confirmButtonText: "Lanjutkan",
                customClass: {
                    title: 'swal2-title-custom',
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "<span style='color: #F31414; font-weight: 700; font-family: Helvetica;'>HAPUS!</span>",
                        icon: "success",
                        showConfirmButton: true,
                        confirmButtonColor: "#22B37C",
                    }).then((success) => {
                        if (success.isConfirmed) {
                            document.getElementById('delete-form-' + id).submit();
                        }
                    });
                }
            });
        }
    </script>
@endsection
