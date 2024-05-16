<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Perintah Kerja</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .box_surat_perintah_kerja {
            width: 1050px;
            height: 1240px;
            border: 2px solid black;
            right: 13px;
            position: relative;
        }

        .right-box-position {
            border-right: 2px solid black;
            height: 1240.4px;
            position: relative;
            right: 4px;
            bottom: 5px;
        }

        .name-pic {
            font-family: arial, sans-serif;
            text-align: right;
            padding-right: 6%;
            padding-top: 1%;
            margin-top: 5px;
            margin-bottom: 5px;
            font-size: 13pt;
            font-weight: bold;
            top: 5px;
            right: 5px;
            color: #000;
        }

        .title_company {
            font-family: arial, sans-serif;
            color: #1066ad;
            font-size: 18pt;
            text-align: center;
            margin-bottom: 5px;
            margin-top: 5px;
            font-weight: bold;
        }

        .sub-title-spk {
            font-family: arial, sans-serif;
            color: #000000;
            font-size: 18pt;
            text-align: center;
            position: relative;
            bottom: 6px;
            font-weight: bold;
        }

        .Yth {
            font-family: Arial, sans-serif;
            padding-left: 18%;
            font-size: 17pt;
            font-weight: bold;
            position: relative;
            bottom: 20px;
        }

        .teks-pelaksanaan {
            font-family: Arial, sans-serif;
            position: relative;
            bottom: 27px;
            left: 32.8%;
            font-size: 13pt;
        }

        .border_horizontal_1 {
            border-bottom: 2px solid black;
            width: 1044px;
            position: relative;
            left: 4px;
            top: 3%;
        }

        .border_horizontal_2 {
            border-bottom: 2px solid black;
            width: 1044px;
            position: relative;
            top: 0.8%;
        }

        .border_horizontal_3 {
            border-bottom: 2px solid black;
            width: 1044px;
            position: relative;
            left: 4px;
            top: 2%;
        }

        .border_horizontal_4 {
            border-bottom: 2px solid black;
            width: 1044px;
            position: relative;
            top: 1%;
        }

        .border_horizontal_5 {
            border-bottom: 4px solid black;
            width: 1045px;
            position: relative;
            top: 25%;
            margin-left: 3px;
        }

        .teks_dokumen_pendukung {
            padding-left: 2.9%;
            position: relative;
            top: 4%;
        }

        .teks_file_pendukung {
            padding-left: 2.9%;
            position: relative;
            top: 5%;
        }

        .checkbox_gambar .box1 {
            width: 30px;
            height: 30px;
            -webkit-appearance: none;
            appearance: none;
            background-color: #fff;
            border: 1px solid #000;
            display: inline-block;
            position: relative;
            cursor: pointer;
        }

        .checkbox_gambar .box1:checked {
            background-color: #ffffff;
        }

        .checkbox_gambar .box1:checked::after {
            content: '✓';
            font-size: 20px;
            color: #000000;
            position: absolute;
            top: 38%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .checkbox_gambar .box1::before {
            content: '';
            display: none;
        }
    </style>
</head>

<body>
    @foreach ($suratPerintahKerjas as $suratPerintahKerja)
        <div class="box_surat_perintah_kerja">
            <div class="right-box-position">
                <div class="name-pic">
                    <Span>PIC : {{ $suratPerintahKerja->pic }}</Span>
                </div>
                <div class="title_company">
                    <span style="font-family: Times New Roman, Times, serif; ">PT. SOLUSI INTEK INDONESIA</span>
                </div>
                <div class="sub-title-spk">
                    <span style="font-family: Times New Roman, Times, serif; ">SURAT PERINTAH KERJA WORKSHOP</span>
                </div>
                <br>

                <div class="Yth">
                    Kepada Yth
                    <span style="padding-left:5px;">:</span>
                    <span style="padding-left:6px;">Workshop Manager</span>
                </div>
                <div class="teks-pelaksanaan">
                    <span style="letter-spacing: 1px;">Mohon dapat dilaksanakan pekerjaan di bawah ini :</span>
                </div>

                <div class="table-project-spk">
                    <table
                        style="border-collapse: collapse; width: 97%; margin: 0 auto; position: relative; left: 9px;">
                        <thead>
                            <tr>
                                <th style="border: 2px solid black; font-size:19px; line-height:normal; width:308px; padding-left:5px;"
                                    nowrap>
                                    Kode Project
                                </th>
                                <th style="border: 2px solid black; font-size:19px; line-height:normal; font-weight:normal; width:21px; padding-left:5px;"
                                    nowrap>
                                    :
                                </th>
                                <th colspan="4"
                                    style="border: 2px solid black; font-size:19px; line-height:normal; padding-left:5px;"
                                    nowrap>
                                    {{ $suratPerintahKerja->code }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="border: 2px solid black; padding-left:5px;" nowrap>Nama project</td>
                                <td style="border: 2px solid black; padding-left:5px;" nowrap>:</td>
                                <td style="border: 2px solid black; padding-left:5px;" nowrap>
                                    {{ $suratPerintahKerja->title }}</td>
                                <td style="border: 2px solid black; padding-left:5px; width:0.1px;" nowrap>
                                    <span style="font-weight: bold;">NO SPK</span>
                                </td>
                                <td style="border: 2px solid black; padding-left:5px; width:11px;" nowrap>:</td>
                                <td style="border: 2px solid black; padding-left:5px;" nowrap>
                                    {{ $suratPerintahKerja->no_spk }}</td>
                            </tr>
                            <tr>
                                <td style="border: 2px solid black; padding-left:5px;" nowrap>User</td>
                                <td style="border: 2px solid black; padding-left:5px;" nowrap>:</td>
                                <td style="border: 2px solid black; padding-left:5px;" nowrap>
                                    {{ $suratPerintahKerja->user }}</td>
                                <td style="border: 2px solid black; padding-left:5px; width:0.1px;" nowrap>Tanggal</td>
                                <td style="border: 2px solid black; padding-left:5px; width:11px;" nowrap>:</td>
                                <td style="border: 2px solid black; padding-left:5px;" nowrap>
                                    {{ $suratPerintahKerja->tanggal }}</td>
                            </tr>
                            <tr>
                                <td style="border: 2px solid black; padding-left:5px;" nowrap>Main Contractor</td>
                                <td style="border: 2px solid black; padding-left:5px;" nowrap>:</td>
                                <td style="border: 2px solid black; padding-left:5px;" nowrap>
                                    {{ $suratPerintahKerja->main_contractor }}</td>
                                <td style="border: 2px solid black; padding-left:5px; width:0.1px;" nowrap>Prioritas
                                </td>
                                <td style="border: 2px solid black; padding-left:5px;" nowrap>:</td>
                                <td style="border: 2px solid black; padding-left:5px;">
                                    {{ $suratPerintahKerja->prioritas }}</td>
                            </tr>
                            <tr>
                                <td style="border: 2px solid black; padding-left:5px;" nowrap>Project Manager</td>
                                <td style="border: 2px solid black; padding-left:5px;" nowrap>:</td>
                                <td style="border: 2px solid black; padding-left:5px;" nowrap>
                                    {{ $suratPerintahKerja->project_manager }}</td>
                                <td style="border: 2px solid black; padding-left:5px; width:0.1px;" nowrap>Waktu
                                    Penyelesaian</td>
                                <td style="border: 2px solid black; padding-left:5px; width:11px;" nowrap>:</td>
                                <td style="border: 2px solid black; padding-left:5px;" nowrap>
                                    {{ $suratPerintahKerja->waktu_penyelesaian }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="border_horizontal">
                        <div class="border_horizontal_1">
                            <div class="border_horizontal_2">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="supporting documents">
                    <div class="chekbox-dokumen">
                        <span class="teks_dokumen_pendukung">Dokumen Pendukung</span>
                        <span class="checkbox_gambar" style="position: relative; top:5%; left:14%; width:10%;">
                            <input class="box1" type="checkbox" @if ($suratPerintahKerja->dokumen_pendukung_type == 1) checked @endif>
                            <span class="teks_gambar" style="position: relative; bottom:1%;">Gambar</span>
                        </span>
                        <span class="checkbox_gambar" style="position: relative; top:5%; left:25.5%; width:10%;">
                            <input class="box1" type="checkbox" @if ($suratPerintahKerja->dokumen_pendukung_type == 2) checked @endif>
                            <span class="teks_gambar" style="position: relative; bottom:1%;">Kontrak</span>
                        </span>
                        <span class="checkbox_gambar" style="position: relative; top:5%; left:33%; width:10%;">
                            <input class="box1" type="checkbox" @if ($suratPerintahKerja->dokumen_pendukung_type == 3) checked @endif>
                            <span class="teks_gambar" style="position: relative; bottom:1%;">Brosur</span>
                        </span>
                    </div>
                </div>


                <div class="other_supporting">
                    <span class="teks_file_pendukung">File Pendukung Lainnya :</span>
                    <hr style="background-color:#000; height:0.5px; width:58%; position: relative; top:2.5%;">
                </div>

                <div class="border_horizontal">
                    <div class="border_horizontal_3">
                        <div class="border_horizontal_4">
                        </div>
                    </div>
                </div>
                <br>

                <div class="detail_spk">
                    <table
                        style="border-collapse: collapse; width: 97%; margin: 0 auto; position: relative; left: 9px; margin-top:10px;">
                        <thead>
                            <tr>
                                <th style="border: 1.5px solid black; font-size:17px; text-align:center; line-height:normal; width:340px; padding-left:5px;"
                                    nowrap>
                                    JENIS PEKERJAAN
                                </th>
                                <th style="border: 1.5px solid black; font-size:17px; border-right:none; text-align:center; line-height:normal; width:664px; padding-left:16px;"
                                    nowrap>
                                    URAIAN PEKERJAAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="border: 1.5px solid black;"></td>
                                <td style="border: 1.5px solid black; border-right:none;"></td>
                            </tr>
                            <tr>
                                <td
                                    style="border: 1.5px solid black; text-align:center; vertical-align:top; height:250px;">
                                    {{ $suratPerintahKerja->jenis_pekerjaan }}
                                </td>
                                <td
                                    style="border: 1.5px solid black; border-right:none; padding-left:5px; text-align:left; vertical-align:top; height:250px;">
                                    {{ $suratPerintahKerja->uraian_pekerjaan }}
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 1.5px solid black; padding-left:5px;"></td>
                                <td
                                    style="border: 1.5px solid black; border-right:none; text-align:right; line-height:normal;">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>

                <div class="teks_hormat_kami" style="margin-top: 2%;">
                    <span style="position: relative; padding-left:3%;">Hormat Kami,</span>
                </div>

                <div class="table_persetujuan" style="margin-top: 1%;">
                    <table
                        style="border-collapse: collapse; width: 98%; margin: 0 auto; position: relative; left: 8px; margin-top:10px;">
                        <thead>
                            <tr>
                                <th style="border-bottom: none; border-top: 3px solid black; border-left:3px solid black; border-right:6px solid black;"
                                    nowrap>
                                    <span style="font-weight: normal; padding-left:7px;">Pemohon</span>
                                </th>
                                <th style="border-bottom: none; border-top: 3px solid black; border-left:3px solid black; border-right:6px solid black;"
                                    nowrap>
                                    <span style="font-weight: normal; padding-left:7px;">Penerima</span>
                                </th>
                                <th style="border-bottom: none; border-top: 3px solid black; border-left:3px solid black; border-right:6px solid black;"
                                    nowrap>
                                    <span style="font-weight: normal; padding-left:7px;">Menyetujui</span>
                                </th>
                                <th style="border-bottom: none; border-top: 3px solid black; border-left:3px solid black; border-right:3px solid black;"
                                    nowrap>
                                    <span style="font-weight: normal; padding-left:7px;">Mengetahui</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:6px solid black; text-align:center">
                                </td>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:6px solid black; text-align:center">
                                </td>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:6px solid black; text-align:center">
                                </td>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:3px solid black;">
                                    <span style="padding-left: 5px;">1.</span>
                                    <span>Nama</span>
                                    <span style="padding-left: 12px;">:</span>
                                    <span>Sindu Irawan</span>
                                </td>
                            </tr>
                            <tr>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:6px solid black; text-align:center">
                                </td>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:6px solid black; text-align:center">
                                </td>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:6px solid black; text-align:center">
                                </td>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:3px solid black;">
                                    <span style="padding-left: 21px;">Jabatan</span>
                                    <span>:</span>
                                    <span>BOD</span>
                                </td>
                            </tr>
                            <tr>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:6px solid black; text-align:center">
                                </td>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:6px solid black; text-align:center">
                                </td>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:6px solid black; text-align:center">
                                </td>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:3px solid black; ">
                                    <span style="visibility: hidden;">4</span>
                                </td>
                            </tr>
                            <tr>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:6px solid black; text-align:center">
                                </td>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:6px solid black; text-align:center">
                                </td>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:6px solid black; text-align:center">
                                </td>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:3px solid black; text-align:center">
                                    <span style="visibility: hidden;">4</span>
                                </td>
                            </tr>
                            <tr>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:6px solid black; text-align:center">
                                </td>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:6px solid black; text-align:center">
                                </td>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:6px solid black; text-align:center">
                                </td>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:3px solid black; padding-left:2%;">
                                    <span style="padding-left:18px;">...........................</span>
                                </td>
                            </tr>
                            <tr>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:6px solid black; text-align:center">
                                </td>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:6px solid black; text-align:center">
                                </td>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:6px solid black; text-align:center">
                                </td>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:3px solid black;">
                                    <span style="padding-left: 5px;">2.</span>
                                    <span>Nama</span>
                                    <span style="padding-left: 12px;">:</span>
                                    <span>Bayu Nugraha</span>
                                </td>
                            </tr>
                            <tr>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:6px solid black; text-align:center">
                                </td>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:6px solid black; text-align:center">
                                </td>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:6px solid black; text-align:center">
                                </td>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:3px solid black;">
                                    <span style="padding-left: 21px;">Jabatan</span>
                                    <span>:</span>
                                    <span>General Manager</span>
                                </td>
                            </tr>
                            <tr>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:6px solid black; padding-left:7px;">
                                    <span class="nama_pemohon">Nama</span>
                                    <span style="padding-left: 15px;">:</span>
                                    <span class="data_pemohon">{{ $suratPerintahKerja->pemohon }}</span>
                                </td>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:6px solid black; padding-left:7px;">
                                    <span class="nama_penerima">Nama</span>
                                    <span style="padding-left: 15px;">:</span>
                                    <span class="data_pemohon">{{ $suratPerintahKerja->penerima }}</span>
                                </td>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:6px solid black; padding-left:7px;">
                                    <span class="nama_menyetujui">Nama</span>
                                    <span style="padding-left: 15px;">:</span>
                                    <span class="data_pemohon">{{ $suratPerintahKerja->menyetujui }}</span>
                                </td>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:3px solid black; text-align:center">
                                    <span style="visibility: hidden;">4</span>
                                </td>
                            </tr>
                            <tr>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:6px solid black; padding-left:7px;">
                                    <span class="Jabatan_pemohon">Jabatan</span>
                                    <span>:</span>
                                    <span class="data_pemohon">{{ $suratPerintahKerja->jabatan_1 }}</span>
                                </td>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:6px solid black; padding-left:7px;">
                                    <span class="Jabatan_pemohon">Jabatan</span>
                                    <span>:</span>
                                    <span class="data_pemohon">{{ $suratPerintahKerja->jabatan_2 }}</span>
                                </td>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:6px solid black; padding-left:7px;">
                                    <span class="Jabatan_pemohon">Jabatan</span>
                                    <span>:</span>
                                    <span class="data_pemohon">{{ $suratPerintahKerja->jabatan_3 }}</span>
                                </td>
                                <td
                                    style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:3px solid black;">
                                    <span style="padding-left:21px;">...........................</span>
                                </td>
                            </tr>
                            <tr>
                                <td
                                    style="border-bottom: 3px solid black; border-top: none; border-left:3px solid black; border-right:6px solid black; text-align:center">
                                </td>
                                <td
                                    style="border-bottom: 3px solid black; border-top: none; border-left:3px solid black; border-right:6px solid black; text-align:center">
                                </td>
                                <td
                                    style="border-bottom: 3px solid black; border-top: none; border-left:3px solid black; border-right:6px solid black; text-align:center">
                                </td>
                                <td
                                    style="border-bottom: 3px solid black; border-top: none; border-left:3px solid black; border-right:3px solid black; text-align:center">
                                    <span style="visibility: hidden;">4</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="form_number_spk" style="margin-top: 2%;">
                    <span style="font-size: 10pt; font-weight:bold; position: relative; padding-left:79%;">
                        Form Number : {{ $suratPerintahKerja->form_number }}</span>
                    <div class="border_horizontal">
                        <div class="border_horizontal_5">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</body>

</html>
