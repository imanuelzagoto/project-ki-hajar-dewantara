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
                <div class="header_surat_perintah_kerja">
                    <div class="name_pic">
                        <Span>PIC : {{ $suratPerintahKerja->pic }}</Span>
                    </div>

                    <div class="title_company">
                        <span class="company">PT. SOLUSI INTEK INDONESIA</span>
                    </div>

                    <div class="sub-title-spk">
                        <span class="titel_perintah_kerja">SURAT PERINTAH KERJA WORKSHOP</span>
                    </div>

                    <div class="Yth">
                        Kepada Yth
                        <span style="padding-left:5px;">:</span>
                        <span style="padding-left:6px;">Workshop Manager</span>
                    </div>

                    <div class="teks_pelaksanaan">
                        <span style="letter-spacing: 1px;">Mohon dapat dilaksanakan pekerjaan di bawah ini :</span>
                    </div>
                </div>

                <div class="table_project_spk" style="margin-top: 24px;">
                    <table class="table_form_project">
                        <thead>
                            <tr>

                                <th class="label_kode_project font-weight-bold" nowrap> Kode Project</th>
                                <th class="colon_kode_project" nowrap>
                                    :
                                </th>
                                <th colspan="4" class="value_kode_project font-weight-bold" nowrap>
                                    {{ $suratPerintahKerja->code }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="label_nama_project" nowrap>Nama Project</td>
                                <td class="colon_nama_project" nowrap>:</td>
                                <td class="value_nama_project" nowrap>
                                    {{ $suratPerintahKerja->title }}</td>

                                <td class="label_no_spk font-weight-bold" nowrap>NO SPK</td>
                                <td class="colon_no_spk" nowrap>:</td>
                                <td class="value_no_spk" nowrap>{{ $suratPerintahKerja->no_spk }}</td>
                            </tr>

                            <tr>
                                <td class="label_user" nowrap>User</td>
                                <td class="colon_user" nowrap>:</td>
                                <td class="value_user" nowrap>
                                    {{ $suratPerintahKerja->user }}</td>

                                <td class="label_tanggal_spk" nowrap>Tanggal</td>
                                <td class="colon_tanggal_spk" nowrap>:</td>
                                <td class="value_tanggal_spk" nowrap>{{ $suratPerintahKerja->submission_date }}</td>
                            </tr>

                            <tr>
                                <td class="label_contractor" nowrap>Main Contractor</td>
                                <td class="colon_contractor" nowrap>:</td>
                                <td class="value_contractor" nowrap>
                                    {{ $suratPerintahKerja->main_contractor }}
                                </td>

                                <td class="label_prioritas" nowrap>Prioritas</td>
                                <td class="colon_prioritas" nowrap>:</td>
                                <td class="value_prioritas" nowrap>{{ $suratPerintahKerja->priority }}</td>
                            </tr>

                            <tr>
                                <td class="label_manager_project" nowrap>Project Manager</td>
                                <td class="colon_manager_project" nowrap>:</td>
                                <td class="value_manager_project" nowrap>
                                    {{ $suratPerintahKerja->project_manager }}
                                </td>

                                <td class="label_batas_waktu" nowrap>Waktu Penyelesaian</td>
                                <td class="colon_batas_waktu" nowrap>:</td>
                                <td class="value_batas_waktu" nowrap>
                                    {{ \Carbon\Carbon::parse($suratPerintahKerja->completion_time)->format('d/m/y') }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="border_horizontal" style="margin-top: 13px">
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
                                <td class="value_jenis_pekerjaan">
                                    {{ $suratPerintahKerja->job_type }}
                                </td>
                                <td class="value_uraian_pekerjaan">
                                    {{-- @php

                                        dd(nl2br(e($suratPerintahKerja->job_description)));
                                        dd(strlen($suratPerintahKerja->job_description));
                                        dd(substr_count(nl2br($suratPerintahKerja->job_description), "\n"));
                                        dd(substr_count(nl2br($suratPerintahKerja->job_description), "<br />"));

                                    @endphp --}}
                                    {!! nl2br($suratPerintahKerja->job_description) !!}
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

                <div style="page-break-inside: avoid;">
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

                <div class="detail_form_number">
                    <span class="form_number font-weight-bold"
                        style="font-size: 13px; position: absolute; top: 98.2%; left:77%">
                        Form Number : {{ $suratPerintahKerja->form_number }}
                    </span>

                    <div style="border-bottom: 3px solid black; position: absolute; top: 100%; width: 950px;">
                    </div>
                </div>

                @php include_once(app_path().'/Helpers/helpers.php') @endphp
                <div class="detail_image_dokumen">
                    @foreach ($suratPerintahKerja->details as $detail)
                        @foreach ($suratPerintahKerjas as $suratPerintahKerja)
                            @php
                                $paths = json_decode($detail->supporting_document_file, true);
                            @endphp

                            @if (is_array($paths))
                                @foreach ($paths as $path)
                                    <div class="page-break">
                                        @php
                                            $base64Image = imageToBase64($path);
                                        @endphp

                                        <span class="form_number font-weight-bold"
                                            style="font-size: 14px; position: relative; top: 97.5%; left:76%">
                                            Form Number : {{ $suratPerintahKerja->form_number }}
                                        </span>

                                        <div
                                            style="border-bottom: 3px solid black; position: relative; top:97.5%; width: 950px;">
                                        </div>

                                        @if ($base64Image)
                                            <img src="{{ $base64Image }}" alt="Supporting Document"
                                                style="object-fit: cover; image-rendering: crisp-edges; width: 927px; height: 1184px; position: relative; left:13px; bottom: 15px;">
                                        @else
                                            <p>Gambar tidak dapat dimuat</p>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="page-break">
                                    <p>No valid paths found</p>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                </div>

            </div>
        </div>
    @endforeach
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</body>
