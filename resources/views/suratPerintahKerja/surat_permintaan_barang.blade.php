<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('sets/images/siops.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('sets/images/siops.svg') }}" type="image/x-icon">
    <title>{{ config('app.name') }} | Show Surat Permintaan Barang</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="pdf.css">
</head>


<body>
    @foreach ($suratPerintahKerjas as $suratPerintahKerja)
        <div class="frame_box_spb">
            <div class="right_box_position_spb">
                <div class="row_header_permintaan_barang">

                    <div class="Company">
                        <span>PT. SOLUSI INTEK INDONESIA</span>
                    </div>

                    <div class="title_permintaan_barang">
                        <span>
                            @if ($suratPerintahKerja->to === 'GA Manager')
                                SURAT PERINTAH KERJA G.A.
                            @elseif ($suratPerintahKerja->to === 'Purchase Manager')
                                SURAT PERINTAH KERJA PURCHASING
                            @elseif ($suratPerintahKerja->to === 'Design Manager')
                                SURAT PERINTAH KERJA DESIGN
                            @else
                                SURAT PERINTAH KERJA
                            @endif
                        </span>
                    </div>

                    <div class="General_Affair">
                        Kepada Yth
                        <span style="padding-left:5px;">:</span>
                        <span style="padding-left:6px;">{{ $suratPerintahKerja->to }}</span>
                    </div>

                    <div class="pelaksanaan">
                        <span>Mohon dapat dilaksanakan pekerjaan di bawah ini :</span>
                    </div>
                </div>

                <div class="table_project_spk" style="margin-top: 24px;">
                    <table class="table_form_project_permintaan_barang">
                        <thead>
                            <tr>

                                <th class="label_kode_project_permintaan_barang font-weight-bold" nowrap> Kode Project
                                </th>
                                <th class="colon_kode_project_permintaan_barang" nowrap>
                                    :
                                </th>
                                <th colspan="4" class="value_kode_project_permintaan_barang font-weight-bold" nowrap>
                                    {{ $suratPerintahKerja->code }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="label_nama_project_permintaan_barang" nowrap>Nama Project</td>
                                <td class="colon_nama_project_permintaan_barang" nowrap>:</td>
                                <td class="value_nama_project_permintaan_barang" nowrap>
                                    {{ $suratPerintahKerja->title }}</td>

                                <td class="label_tanggal_spk_permintaan_barang" nowrap>Tanggal</td>
                                <td class="colon_tanggal_spk_permintaan_barang" nowrap>:</td>
                                <td class="value_tanggal_spk_permintaan_barang text-center" nowrap>
                                    {{ \Carbon\Carbon::parse($suratPerintahKerja->submission_date)->format('d-M-y') }}
                                </td>
                            </tr>

                            <tr>
                                <td class="label_user_permintaan_barang" nowrap>User</td>
                                <td class="colon_user_permintaan_barang" nowrap>:</td>
                                <td class="value_user_permintaan_barang text-center" nowrap>
                                    {{ $suratPerintahKerja->user }}</td>

                                <td class="label_prioritas_permintaan_barang" nowrap>Prioritas</td>
                                <td class="colon_prioritas_permintaan_barang" nowrap>:</td>
                                <td class="value_prioritas_permintaan_barang text-center" nowrap>
                                    {{ $suratPerintahKerja->priority }}
                                </td>
                            </tr>

                            <tr>
                                <td class="label_contractor_permintaan_barang" nowrap>Main Contractor</td>
                                <td class="colon_contractor_permintaan_barang" nowrap>:</td>
                                <td class="value_contractor_permintaan_barang text-center" nowrap>
                                    {{ $suratPerintahKerja->main_contractor }}
                                </td>

                                <td class="label_batas_waktu_permintaan_barang" nowrap>Waktu Penyelesaian</td>
                                <td class="colon_batas_waktu_permintaan_barang" nowrap>:</td>
                                <td class="value_batas_waktu_permintaan_barang text-center" nowrap>
                                    {{ \Carbon\Carbon::parse($suratPerintahKerja->completion_time)->format('d-M-y') }}
                                </td>
                            </tr>

                            <tr>
                                <td class="label_manager_project_permintaan_barang" nowrap>Project Manager</td>
                                <td class="colon_manager_projec_permintaan_barang" nowrap>:</td>
                                <td class="value_manager_project_permintaan_barang text-center" nowrap>
                                    {{ $suratPerintahKerja->project_manager }}
                                </td>

                                <td class="label_no_spk_permintaan_barang font-weight-bold" nowrap>NO SPK</td>
                                <td class="colon_no_spk_permintaan_barang" nowrap>:</td>
                                <td class="value_no_spk_permintaan_barang text-center" nowrap>
                                    {{ $suratPerintahKerja->no_spk }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="border_horizontal" style="margin-top: 2px">
                    <div class="border_horizontal_1">
                        <div class="border_horizontal_2">
                            @foreach ($suratPerintahKerja->details as $detail)
                                <div class="supporting_documents">
                                    <div class="chekbox-dokumen">
                                        <span class="teks_dokumen_pendukung">Dokumen Pendukung</span>
                                        <span class="checkbox_gambar" style="position: relative; top: 43px; left:73px;">
                                            <input class="box1" type="checkbox"
                                                @if ($detail->supporting_document_type == 1) checked @endif>
                                            <span class="teks_gambar"
                                                style="position: relative; bottom:1%;">Gambar</span>
                                        </span>
                                        <span class="checkbox_gambar"
                                            style="position: relative; top: 43px; left:260px;">
                                            <input class="box1" type="checkbox"
                                                @if ($detail->supporting_document_type == 2) checked @endif>
                                            <span class="teks_gambar"
                                                style="position: relative; bottom:1%;">Kontrak</span>
                                        </span>
                                        <span class="checkbox_brosur"
                                            style="position: relative; top: 43px; left:356px;">
                                            <input class="box2" type="checkbox"
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

                <div style="margin-top: 50px; width: 900px; margin-left: 23px;">
                    <table style="border-collapse: collapse; border:none; ">
                        <thead>
                            <tr>
                                <th style="border: 1.8px solid black; font-weight:bold;" class="text-center">
                                    JENIS PEKERJAAN
                                </th>
                                <th style="border: 1.8px solid black; border-right: none; font-weight:bold;"
                                    class="text-center">
                                    SPESIFIKASI
                                </th>
                                <th style="border: 1.8px solid black; border-right: none; font-weight:bold;"
                                    class="text-center">
                                    JUMLAH
                                </th>
                                <th style="border: 1.8px solid black;  font-weight:bold;" class="text-center">
                                    KETERANGAN
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count_td = 0;
                            @endphp
                            @foreach ($suratPerintahKerja->details_permintaan as $index => $detail)
                                @php
                                    $count_td_2 = 0;
                                    $count_td += 1;
                                    if ($count_td >= 8) {
                                        $count_td_2 = $count_td - 7;
                                    }
                                @endphp
                                <tr style="border-bottom:none;">
                                    @if (
                                        $count_td == 7 ||
                                            ($count_td >= 8 && $count_td_2 % 11 === 0) ||
                                            $count_td == count($suratPerintahKerja->details_permintaan))
                                        <td class="text-center"
                                            style=" border:none; border-left:1.8px solid black; border-bottom: 1.8px solid black; vertical-align: top; height:100px;">
                                            @if ($index == 0 || $count_td == 8 || ($count_td >= 8 && ($count_td_2 - 1) % 11 === 0))
                                                <div
                                                    style="word-break: break-all; word-wrap: break-word; width: 220px;">
                                                    {{ $suratPerintahKerja->job_type }}
                                                </div>
                                            @endif
                                        </td>
                                    @else
                                        <td class="text-center"
                                            style=" border:none; border-left:1.8px solid black; vertical-align: top;  height:100px;">
                                            @if ($index == 0 || $count_td == 8 || ($count_td >= 8 && ($count_td_2 - 1) % 11 === 0))
                                                <div
                                                    style="word-break: break-all; word-wrap: break-word; width: 220px;">
                                                    {{ $suratPerintahKerja->job_type }}
                                                </div>
                                            @endif
                                        </td>
                                    @endif

                                    <td
                                        style="border:none;border-bottom:1.8px solid black;  border-left: 1.8px solid black; vertical-align: top;  height:100px;">
                                        <div style="word-break: break-all; word-wrap: break-word; width: 220px;">
                                            {{ $detail->spesifikasi }}
                                        </div>
                                    </td>
                                    <td class="text-center"
                                        style="border:none;border-bottom:1.8px solid black;  border-left: 1.8px solid black; vertical-align: top; height:100px;">
                                        <div style="word-break: break-all; word-wrap: break-word; width: 220px;">
                                            {{ $detail->jumlah ?? '' }}
                                            {{ $detail->satuan ?? '' }}
                                        </div>
                                    </td>
                                    <td class="text-center"
                                        style="border:none;border-bottom:1.8px solid black;  border-left: 1.8px solid black; border-right:1.8px solid black;vertical-align: top; height:100px;">
                                        <div style="word-break: break-all; word-wrap: break-word; width: 220px;">
                                            {{ $detail->keterangan }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div style="page-break-inside: avoid;">
                    <div class="column_catatan" style="position: relative; top: 40px; left: 24px; width: 897.5px;">
                        <div>
                            <span>Catatan :</span>
                        </div>
                        <table>
                            <thead>
                                <tr></tr>
                            </thead>
                            <tbody>
                                <td id="jobDescription" style="overflow: auto; page-break-inside: avoid; height:100px; vertical-align: top;">
                                    {!! nl2br(e($suratPerintahKerja->job_description)) !!}
                                </td>
                            </tbody>
                        </table>
                    </div>
                    <div class="approval_spk" style="margin-top:70px; margin-left:17px;">
                        <div>
                            <span>Hormat Kami,</span>
                        </div>
                        <table class="table_approval_spk">
                            <thead>
                                <tr>
                                    <th style="border-bottom: none; border-top: 3px solid black; border-left:3px solid black; border-right:6px solid black;"
                                        nonowrap>
                                        <span style="font-weight: normal; padding-left:7px;">Pemohon</span>
                                    </th>
                                    <th style="border-bottom: none; border-top: 3px solid black; border-left:3px solid black; border-right:6px solid black; width:215px;"
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
                                            style="border-bottom: none; border-top: none; border-left:3px solid black; border-right:3px solid black;">
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

                <div class="detail_form_number">
                    <span class="form_number font-weight-bold"
                        style="font-size: 13px; position: absolute; top: 98.2%; left:77%">
                        Form Number : {{ $suratPerintahKerja->form_number }}
                    </span>

                    <div style="border-bottom: 3px solid black; position: absolute; top: 100%; width: 950px;">
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</body>

