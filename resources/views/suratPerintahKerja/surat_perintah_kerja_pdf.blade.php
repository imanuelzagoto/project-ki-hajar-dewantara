<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('sets/images/siops.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('sets/images/siops.svg') }}" type="image/x-icon">
    <title>{{ config('app.name') }} | Show Surat Perintah Kerja</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="pdf.css">
</head>

<body>
    @foreach ($suratPerintahKerjas as $suratPerintahKerja)
        <div class="frame_box_spk">
            <div class="right_box_position">
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

                <div class="teks_pelaksanaan">
                    <span style="letter-spacing: 1px;">Mohon dapat dilaksanakan pekerjaan di bawah ini :</span>
                </div>

                <div class="table_project_spk">
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
                                <td style="border: 2px solid black; padding-left:5px; width:0.1px;" nowrap>Tanggal
                                </td>
                                <td style="border: 2px solid black; padding-left:5px; width:11px;" nowrap>:</td>
                                <td style="border: 2px solid black; padding-left:5px;" nowrap>
                                    {{ $suratPerintahKerja->submission_date }}</td>
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
                                    {{ $suratPerintahKerja->priority }}</td>
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
                                    {{ \Carbon\Carbon::parse($suratPerintahKerja->completion_time)->format('d/m/y') }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="border_horizontal">
                        <div class="border_horizontal_1">
                            <div class="border_horizontal_2">
                                @foreach ($suratPerintahKerja->details as $detail)
                                    <div class="supporting_documents">
                                        <div class="chekbox-dokumen">
                                            <span class="teks_dokumen_pendukung">Dokumen Pendukung</span>
                                            <span class="checkbox_gambar"
                                                style="position: relative; top:5%; left:14%; width:10%;">
                                                <input class="box1" type="checkbox"
                                                    @if ($detail->supporting_document_type == 1) checked @endif>
                                                <span class="teks_gambar"
                                                    style="position: relative; bottom:1%;">Gambar</span>
                                            </span>
                                            <span class="checkbox_gambar"
                                                style="position: relative; top:5%; left:25.5%; width:10%;">
                                                <input class="box1" type="checkbox"
                                                    @if ($detail->supporting_document_type == 2) checked @endif>
                                                <span class="teks_gambar"
                                                    style="position: relative; bottom:1%;">Kontrak</span>
                                            </span>
                                            <span class="checkbox_gambar"
                                                style="position: relative; top:5%; left:33%; width:10%;">
                                                <input class="box1" type="checkbox"
                                                    @if ($detail->supporting_document_type == 3) checked @endif>
                                                <span class="teks_gambar"
                                                    style="position: relative; bottom:1%;">Brosur</span>
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="other_supporting">
                        <span class="teks_file_pendukung">
                            File Pendukung Lainnya :
                        </span>
                        <hr class="hr_dokumen">
                        <div class="border_horizontal_bottom">
                            <div class="border_horizontal_3">
                                <div class="border_horizontal_4">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="detail_spk">
                        <table>
                            <thead>
                                <tr>
                                    <th class="jenis_pekerjaan">JENIS PEKERJAAN</th>
                                    <th class="uraian_pekerjaan">URAIAN PEKERJAAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="border: 1.5px solid black;"></td>
                                    <td style="border: 1.5px solid black; border-right:none;"></td>
                                </tr>
                                <tr>
                                    <td class="value_jenis_pekerjaan">{{ $detail->job_type }}</td>
                                    <td class="value_uraian_pekerjaan"> {!! nl2br(e($detail->job_description)) !!}</td>
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
                </div>
                <div class="hormat_kami" style="position: relative; top: 100px;">
                    <span class="line_hormat_kami">Hormat Kami,</span>
                    <div class="approval_spk">
                        <table>
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
                                @foreach ($suratPerintahKerja->approvals as $approval)
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
                                            <span>{{ $approval->board_of_directors }}</span>
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
                                            <span>{{ $approval->position }}</span>
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
                                            style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:3px solid black; text-align: left;">
                                            <span
                                                style="position: relative; left:20px;">...........................</span>
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
                                            <span class="nama_pemohon_spk">Nama</span>
                                            <span style="padding-left: 15px;">:</span>
                                            <span class="data_pemohon">{{ $approval->applicant_name }}</span>
                                        </td>
                                        <td
                                            style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:6px solid black; padding-left:7px;">
                                            <span class="nama_penerima">Nama</span>
                                            <span style="padding-left: 15px;">:</span>
                                            <span class="data_pemohon">{{ $approval->receiver_name }}</span>
                                        </td>
                                        <td
                                            style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:6px solid black; padding-left:7px;">
                                            <span class="nama_menyetujui">Nama</span>
                                            <span style="padding-left: 15px;">:</span>
                                            <span class="data_pemohon">{{ $approval->approver_name }}</span>
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
                                            <span class="data_pemohon">{{ $approval->applicant_position }}</span>
                                        </td>
                                        <td
                                            style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:6px solid black; padding-left:7px;">
                                            <span class="Jabatan_pemohon">Jabatan</span>
                                            <span>:</span>
                                            <span class="data_pemohon">{{ $approval->receiver_position }}</span>
                                        </td>
                                        <td
                                            style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:6px solid black; padding-left:7px;">
                                            <span class="Jabatan_pemohon">Jabatan</span>
                                            <span>:</span>
                                            <span class="data_pemohon">{{ $approval->approver_position }}</span>
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form_number_spk">
                    <span class="value_form_number"> Form Number : {{ $suratPerintahKerja->form_number }}</span>
                </div>
            </div>
        </div>
        <div class="bottom_box_position">
        </div>
    @endforeach
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</body>

</html>
