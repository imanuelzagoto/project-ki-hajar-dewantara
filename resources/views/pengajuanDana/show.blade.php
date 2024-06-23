<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('sets/images/siops.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('sets/images/siops.svg') }}" type="image/x-icon">
    <title>{{ config('app.name') }} | Show Pengajuan Dana</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="pdf.css">
</head>

<body>
    @php
        $i = 0;
    @endphp
    @foreach ($pengajuan_danas as $pds)
        @foreach ($pds->details as $detail)
            @php
                $i += 1;
            @endphp
            <div class="header-pengajuan-dana">
                <table>
                    <thead>
                        <tr>
                            <th colspan="3" rowspan="3" class="table-header"></th>
                            <th colspan="3" rowspan="3" class="text-pengajuan-dana">FORM PENGAJUAN DANA</th>
                            <th class="coloumn-tanggal-pengajuan">Date</th>
                            <th style="width: 150px; padding-left:3px; font-size:14.5px;">
                                {{ \Carbon\Carbon::parse($pds->tanggal_pengajuan)->translatedFormat('d F Y') }}
                            </th>
                        </tr>

                    </thead>
                    <tbody>
                        <tr>
                            <td class="coloumn-no-doc">No.Doc.</td>
                            <td style="padding-left:3px; font-size:14.5px;">{{ $pds->no_doc }}</td>
                        </tr>
                        <tr>
                            <td class="column-revisi">Rev.</td>
                            <td style="padding-left:3px; font-size:14.5px;" nowrap>{{ $pds->revisi }} </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="acc_pengajuan_dana" style="position: relative; bottom:0.5%;">
                <span style="font-size: 13px; font-weight:bold; position: relative; top:1.7%; left:1%;">ACC :</span>
                @php
                    $hasData = false;
                @endphp
                <ul>
                    @foreach ($pengajuan_danas as $pds)
                        @php
                            $pemeriksa_ids = json_decode($pds->pemeriksa, true);
                        @endphp

                        @if (is_array($pemeriksa_ids) && count($pemeriksa_ids) > 0)
                            @foreach ($pemeriksa_ids as $id)
                                @php
                                    $approvalData = $tags_approval_data->firstWhere('id', $id);
                                @endphp

                                @if ($approvalData)
                                    @php
                                        $hasData = true;
                                    @endphp
                                    <li style="font-size: 13px; position: relative; left:3%; top:1px;">
                                        {{ $approvalData->nama }} - {{ $approvalData->jabatan }}
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    @if (!$hasData)
                        <li style="font-size: 13px; position: relative; left:3%;">-</li>
                    @endif
                </ul>
            </div>

            <div class="head_pengajuan_dana">
                <table>
                    <thead>
                        <tr>
                            <th class="column-subject">
                                Subject
                                <span style="padding-left: 200px;">:</span>
                            </th>
                            <th style="padding-left:3px; font-size:14.5px;">{{ $pds->subject }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="column_nama_pemohon">
                                Nama Pemohon
                                <span style="padding-left: 143.5px;">:</span>
                            </td>
                            <td style="padding-left:3px; font-size:14.5px;">{{ $pds->nama_pemohon }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="detail_pengajuan_dana">
                <ol style="position: relative; right:2%;">
                    <li class="tujuan">
                        <span class="label_tujuan">Tujuan</span>
                        <span style="position: relative; left: 17.2%;">:</span>
                        <span class="nilai_tujuan" style="position: relative; left:18.2%;">{{ $detail->tujuan }}</span>
                    </li>

                    <li class="lokasi">
                        <span class="label_lokasi">Lokasi</span>
                        <span style="position: relative; left: 17.4%;">:</span>
                        <span class="nilai_lokasi" style="position: relative; left:18.4%;">{{ $detail->lokasi }}</span>
                    </li>

                    <li class="jangka_waktu">
                        <span class="label_jangka_waktu">Jangka Waktu Permohonan</span>
                        <span style="position: relative; left: 4.5%;">:</span>
                        <span class="nilai_jangka_waktu"
                            style="position: relative; left:5.5%;">{{ \Carbon\Carbon::parse($detail->batas_waktu)->translatedFormat('d F Y') }}</span>
                    </li>

                    <li class="nominal">
                        <span class="label_nominal">Dana yang dibutuhkan</span>
                        <span style="position: relative; left: 7.7%;">:</span>
                        <span style="position: relative; left:9.3%;">Rp</span>
                        <span class="nilai_nominal" style="position: relative; left:10.7%;">
                            {{ number_format(floatval(str_replace(['Rp.', '.', ','], '', $detail->subtotal)), 0, ',', '.') }}</span>
                        <span class="nilai_terbilang"
                            style="position: relative; left:11.8%; font-size: 14px; font-style:italic;">
                            {{ ucfirst($detail->terbilang) }}
                        </span>
                    </li>

                    <li class="nomor_rekening">
                        <span class="label_rekening">No. Rekening</span>
                        <span style="position: relative; left: 13.1%;">:</span>
                        <span class="nilai_lokasi" style="position: relative; left: 13.7%; font-weight:bold;">
                            @if ($detail->tunai)
                                {{ $detail->tunai }}
                            @elseif ($detail->non_tunai)
                                {{ $detail->non_tunai }}
                            @endif
                        </span>
                    </li>

                    <li class="catatan">
                        <span class="label_catatan">Catatan</span>
                        <span style="position: relative; left: 16.6%;">:</span>
                        <span class="nilai_catatan" style="position: relative; left: 17.2%;">
                            {{ $detail->catatan }}
                        </span>
                    </li>
                </ol>
            </div>

            <div class="items_pengajuan_dana">
                <table>
                    <thead>
                        <tr>
                            <th rowspan="3" style="width: 35px; font-size:14px; text-align:center;">
                                NO
                            </th>
                            <th colspan="3" rowspan="3" style="text-align: center; font-size:14px; width:67px;">
                                Item
                            </th>
                            <th colspan="2" style="text-align: center; font-size:14px; width:40px;">Item</th>
                            <th colspan="2" style="text-align: center; font-size:14px;">Harga</th>
                            <th style="text-align: center; font-size:14px; width:300px;">Total</th>

                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th colspan="2" rowspan="2" style="text-align: center; padding-bottom:10px;">
                                <span>( a )</span>
                            </th>
                            <th colspan="2" rowspan="2" style="text-align: center; padding-bottom:10px;">
                                <span>( b )</span>
                            </th>
                            <th style="text-align: center; padding-bottom:10px;">
                                <span>(c)</span>
                            </th>
                        </tr>
                        <tr>
                            <th style="text-align: center; padding-bottom:10px;">
                                <span>( c )=( b )x( a )</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($pds->items as $item)
                            @php
                                $i += 1;
                            @endphp
                            <tr>
                                <td style="text-align: center;">{{ $i }}.</td>
                                <td colspan="3" style="padding-left:5px;">{{ $item->nama_item }}</td>
                                <td style="text-align: center;">{{ $item->jumlah }}</td>
                                <td style="text-align: center;">{{ $item->satuan }}</td>
                                <td colspan="2" style="text-align: right; padding-right:5px;">
                                    {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td style="text-align: right; padding-right:5px;">
                                    {{ number_format($item->total, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="8" style="font-weight: bold; text-align: right; padding-right:5px;">Sub
                                Total
                            </td>
                            <td style="text-align: right; padding-right:5px; font-weight:bold;">
                                {{ number_format(floatval(str_replace(['Rp.', '.', ','], '', $detail->subtotal)), 0, ',', '.') }}
                            </td>
                        </tr>
                        </thead>
                </table>
            </div>

            <div class="teks_finnaly">
                <div class="teks_drafting">
                    Demikian drafting pengajuan dana ini saya sampaikan atas bantuan dan kerja samanya saya ucapkan
                    terima
                    kasih.
                </div>
            </div>
            <br>

            @php
                $pds = $pengajuan_danas->first();
                $persetujuanIds = json_decode($pds->persetujuan, true);
                $pemeriksaIds = json_decode($pds->pemeriksa, true);
                $approvalData = [];

                foreach ($tags_approval_data as $approval) {
                    if (in_array($approval->id, $persetujuanIds)) {
                        $approvalData[$approval->id] = [
                            'nama' => $approval->nama,
                            'jabatan' => $approval->jabatan,
                        ];
                    }
                }
            @endphp

            @php
                $totalCols = 6;
                $activeCols = count($approvalData);
                $colspan = $totalCols - ($totalCols - $activeCols);
            @endphp

            <div class="approval_pengajuan_dana" style="page-break-inside: avoid;">
                <table>
                    <thead>
                        <tr>
                            <th class="column-diajukan">
                                Diajukan Oleh,
                            </th>
                            <th style="width:5px; border:none;"></th>
                            <th colspan="{{ $colspan }}" class="column_persetujuan">Diperiksa dan Disetujui
                                oleh,</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td rowspan="3" style="text-align: center; width: 60px;" id="kolom_pemohon"></td>
                            <td style="border:none;"></td>
                            @foreach ($approvalData as $id => $data)
                                <td rowspan="3" style="text-align: center; height:80px; width:60px;"
                                    id="id_{{ $id }}"></td>
                            @endforeach
                        </tr>
                        <tr>
                            <td style="border:none;"></td>
                        </tr>
                        <tr>
                            <td style="border:none;"></td>
                        </tr>
                        <tr>
                            <td class="flex-container" style="font-size:12.5px;" id="kolom_nama_pemohon">
                                <span class="label_nama">Nama</span>
                                <span class="colon_nama">:</span>
                                <span class="value_nama" nowrap>{{ $pds->nama_pemohon }}</span>
                            </td>

                            <td style="border:none;"></td>

                            @foreach ($approvalData as $id => $data)
                                <td style="font-size:12px;">
                                    <span class="label_nama">Nama</span>
                                    <span class="colon_nama">:</span>
                                    <span class="value_nama" nowrap>{{ $data['nama'] }}</span>
                                </td>
                            @endforeach
                        </tr>

                        <tr>
                            <td class="flex-container" style="font-size:12.5px;" id="kolom_jabatan_pemohon">
                                <span class="label_jabatan">Jabatan</span>
                                <span class="colon_jabatan">:</span>
                                <span class="value_jabatan" nowrap>{{ $pds->jabatan_pemohon }}</span>
                            </td>

                            <td style="border:none;"></td>

                            @foreach ($approvalData as $id => $data)
                                <td style="font-size:12px;">
                                    <span class="label_jabatan">Jabatan</span>
                                    <span class="colon_jabatan">:</span>
                                    <span class="value_jabatan" nowrap>{{ $data['jabatan'] }}</span>
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td class="flex-container" style="font-size:12.5px;">
                                <span class="label_date">Date</span>
                                <span class="colon_date">:</span>
                                <span class="value_date"
                                    nowrap>{{ \Carbon\Carbon::parse($pds->tanggal_pengajuan)->translatedFormat('d F Y') }}</span>
                            </td>
                            <td style="border:none;"></td>
                            @foreach ($approvalData as $id => $data)
                                <td style="font-size:12.5px;" id="date_id_{{ $id }}">
                                    <span class="label_date">Date</span>
                                    <span class="colon_date_approval">:</span>
                                    <span class="value_date" nowrap></span>
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- <div class="approval_pengajuan_dana" style="page-break-inside: avoid;">
                <table>
                    <thead>
                        <tr>
                            <th class="column-diajukan">
                                Diajukan Oleh,
                            </th>
                            <th style="width:5px; border:none;"></th>
                            <th colspan="6" class="column_persetujuan">Diperiksa dan Disetujui
                                oleh,</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td rowspan="3" style="text-align: center; width: 60px;" id="kolom_pemohon"></td>
                            <td style="border:none;"></td>
                            <td rowspan="3" style="text-align: center; height:80px; width:60px;" id="id_1">
                            </td>
                            <td rowspan="3" style="text-align: center; height:80px; width:60px;" id="id_2">
                            </td>
                            <td rowspan="3" style="text-align: center; height:80px; width:60px;" id="id_3">
                            </td>
                            <td rowspan="3" style="text-align: center; height:80px; width:60px;" id="id_4">
                            </td>
                            <td rowspan="3" style="text-align: center; height:80px; width:60px;" id="id_5">
                            </td>
                            <td rowspan="3" style="text-align: center; height:60px; width:60px;" id="id_6">
                            </td>

                        </tr>
                        <tr>
                            <td style="border:none;"></td>
                        </tr>
                        <tr>
                            <td style="border:none;"></td>
                        </tr>
                        <tr>
                            <td style="font-size:12.5px;" id="kolom_nama_pemohon">
                                <span style="position: relative; 3%">Nama</span>
                                <span style="position:relative; left: 9%;">
                                    :
                                </span>
                                <span style="position:relative; left: 6%;" nowrap>
                                    {{ $pds->nama_pemohon }}
                                </span>
                            </td>

                            <td style="border:none;"></td>

                            <td style="font-size:12px;">
                                <span style="position: relative; 3%">Nama</span>
                                <span style="position:relative; left: 9%;">
                                    :
                                </span>
                                <span style="position:relative; left: 6%;" nowrap>
                                    @php
                                        $pds = $pengajuan_danas->first();
                                        $persetujuanIds = json_decode($pds->persetujuan, true);
                                    @endphp

                                    @foreach ($tags_approval_data as $approval)
                                        @if ($approval->id == 1)
                                            @php
                                                $isPersetujuan = in_array($approval->id, $persetujuanIds);
                                            @endphp

                                            @if ($isPersetujuan)
                                                {{ $approval->nama }}
                                            @endif
                                        @endif
                                    @endforeach
                                </span>
                            </td>

                            <td style="font-size:12px;">
                                <span style="position: relative; 3%">Nama</span>
                                <span style="position:relative; left: 9%;">
                                    :
                                </span>
                                <span style="position:relative; left: 6%;" nowrap>
                                    @php
                                        $pds = $pengajuan_danas->first();
                                        $persetujuanIds = json_decode($pds->persetujuan, true);
                                    @endphp

                                    @foreach ($tags_approval_data as $approval)
                                        @if ($approval->id == 2)
                                            @php
                                                $isPersetujuan = in_array($approval->id, $persetujuanIds);
                                            @endphp

                                            @if ($isPersetujuan)
                                                {{ $approval->nama }}
                                            @endif
                                        @endif
                                    @endforeach
                                </span>
                            </td>

                            <td style="font-size:12px;">
                                <span style="position: relative; 3%">Nama</span>
                                <span style="position:relative; left: 9%;">
                                    :
                                </span>
                                <span style="position:relative; left: 6%;" nowrap>
                                    @php
                                        $pds = $pengajuan_danas->first();
                                        $persetujuanIds = json_decode($pds->persetujuan, true);
                                    @endphp

                                    @foreach ($tags_approval_data as $approval)
                                        @if ($approval->id == 3)
                                            @php
                                                $isPersetujuan = in_array($approval->id, $persetujuanIds);
                                            @endphp

                                            @if ($isPersetujuan)
                                                {{ $approval->nama }}
                                            @endif
                                        @endif
                                    @endforeach
                                </span>
                            </td>

                            <td style="font-size:12px;">
                                <span style="position: relative; 3%">Nama</span>
                                <span style="position:relative; left: 9%;">
                                    :
                                </span>
                                <span style="position:relative; left: 6%;" nowrap>
                                    @php
                                        $pds = $pengajuan_danas->first();
                                        $persetujuanIds = json_decode($pds->persetujuan, true);
                                    @endphp

                                    @foreach ($tags_approval_data as $approval)
                                        @if ($approval->id == 4)
                                            @php
                                                $isPersetujuan = in_array($approval->id, $persetujuanIds);
                                            @endphp

                                            @if ($isPersetujuan)
                                                {{ $approval->nama }}
                                            @endif
                                        @endif
                                    @endforeach
                                </span>
                            </td>

                            <td style="font-size:12px;">
                                <span style="position: relative; 3%">Nama</span>
                                <span style="position:relative; left: 9%;">
                                    :
                                </span>
                                <span style="position:relative; left: 6%;" nowrap>
                                    @php
                                        $pds = $pengajuan_danas->first();
                                        $persetujuanIds = json_decode($pds->persetujuan, true);
                                    @endphp

                                    @foreach ($tags_approval_data as $approval)
                                        @if ($approval->id == 5)
                                            @php
                                                $isPersetujuan = in_array($approval->id, $persetujuanIds);
                                            @endphp

                                            @if ($isPersetujuan)
                                                {{ $approval->nama }}
                                            @endif
                                        @endif
                                    @endforeach
                                </span>
                            </td>

                            <td style="font-size:12px;">
                                <span style="position: relative; 3%">Nama</span>
                                <span style="position:relative; left: 9%;">
                                    :
                                </span>
                                <span style="position:relative; left: 6%;" nowrap>
                                    @php
                                        $pds = $pengajuan_danas->first();
                                        $persetujuanIds = json_decode($pds->persetujuan, true);
                                    @endphp

                                    @foreach ($tags_approval_data as $approval)
                                        @if ($approval->id == 6)
                                            @php
                                                $isPersetujuan = in_array($approval->id, $persetujuanIds);
                                            @endphp

                                            @if ($isPersetujuan)
                                                {{ $approval->nama }}
                                            @endif
                                        @endif
                                    @endforeach
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12.5px;" id="kolom_jabatan_pemohon">
                                <span style="position: relative; 3%">Jabatan</span>
                                <span style="position:relative; left: 3.7%;">:</span>
                                <span style="position: relative; left: 2.6%;" nowrap>
                                    {{ $pds->jabatan_pemohon }}
                                </span>
                            </td>
                            <td style="border:none;"></td>
                            <td style="font-size:12px;">
                                <span style="position: relative; 3%">Jabatan</span>
                                <span style="position:relative; left: 3.7%;">:</span>
                                <span style="position: relative; left: 2.6%;" nowrap>
                                    @php
                                        $pds = $pengajuan_danas->first();
                                        $persetujuanIds = json_decode($pds->persetujuan, true);
                                    @endphp

                                    @foreach ($tags_approval_data as $approval)
                                        @if ($approval->id == 1)
                                            @php
                                                $isPersetujuan = in_array($approval->id, $persetujuanIds);
                                            @endphp

                                            @if ($isPersetujuan)
                                                {{ $approval->jabatan }}
                                            @endif
                                        @endif
                                    @endforeach
                                </span>
                            </td>

                            <td style="font-size:12px;">
                                <span style="position: relative; 3%">Jabatan</span>
                                <span style="position:relative; left: 3.7%;">:</span>
                                <span style="position: relative; left: 2.6%;" nowrap>
                                    @php
                                        $pds = $pengajuan_danas->first();
                                        $persetujuanIds = json_decode($pds->persetujuan, true);
                                    @endphp

                                    @foreach ($tags_approval_data as $approval)
                                        @if ($approval->id == 2)
                                            @php
                                                $isPersetujuan = in_array($approval->id, $persetujuanIds);
                                            @endphp

                                            @if ($isPersetujuan)
                                                {{ $approval->jabatan }}
                                            @endif
                                        @endif
                                    @endforeach
                                </span>
                            </td>

                            <td style="font-size:12px;">
                                <span style="position: relative; 3%">Jabatan</span>
                                <span style="position:relative; left: 3.7%;">:</span>
                                <span style="position: relative; left: 2.6%;" nowrap>
                                    @php
                                        $pds = $pengajuan_danas->first();
                                        $persetujuanIds = json_decode($pds->persetujuan, true);
                                    @endphp

                                    @foreach ($tags_approval_data as $approval)
                                        @if ($approval->id == 3)
                                            @php
                                                $isPersetujuan = in_array($approval->id, $persetujuanIds);
                                            @endphp

                                            @if ($isPersetujuan)
                                                {{ $approval->jabatan }}
                                            @endif
                                        @endif
                                    @endforeach
                                </span>
                            </td>

                            <td style="font-size:12px;">
                                <span style="position: relative; 3%">Jabatan</span>
                                <span style="position:relative; left: 3.7%;">:</span>
                                <span style="position: relative; left:3%;">
                                    @php
                                        $pds = $pengajuan_danas->first();
                                        $persetujuanIds = json_decode($pds->persetujuan, true);
                                    @endphp

                                    @foreach ($tags_approval_data as $approval)
                                        @if ($approval->id == 4)
                                            @php
                                                $isPersetujuan = in_array($approval->id, $persetujuanIds);
                                            @endphp

                                            @if ($isPersetujuan)
                                                {{ $approval->jabatan }}
                                            @endif
                                        @endif
                                    @endforeach
                                </span>
                            </td>

                            <td style="font-size:12px;">
                                <span style="position: relative; 3%">Jabatan</span>
                                <span style="position:relative; left: 3.7%;">:</span>
                                <span style="position: relative; left:3%;">
                                    @php
                                        $pds = $pengajuan_danas->first();
                                        $persetujuanIds = json_decode($pds->persetujuan, true);
                                    @endphp

                                    @foreach ($tags_approval_data as $approval)
                                        @if ($approval->id == 5)
                                            @php
                                                $isPersetujuan = in_array($approval->id, $persetujuanIds);
                                            @endphp

                                            @if ($isPersetujuan)
                                                {{ $approval->jabatan }}
                                            @endif
                                        @endif
                                    @endforeach
                                </span>
                            </td>

                            <td style="font-size:12px;">
                                <span style="position: relative; 3%">Jabatan</span>
                                <span style="position:relative; left: 3.7%;">:</span>
                                <span style="position: relative; left:3%;">
                                    @php
                                        $pds = $pengajuan_danas->first();
                                        $pemeriksaIds = json_decode($pds->pemeriksa, true);
                                        $persetujuanIds = json_decode($pds->persetujuan, true);
                                    @endphp

                                    @foreach ($tags_approval_data as $approval)
                                        @if ($approval->id == 6)
                                            @php
                                                $isPemeriksa = in_array($approval->id, $pemeriksaIds);
                                                $isPersetujuan = in_array($approval->id, $persetujuanIds);
                                            @endphp

                                            @if ($isPersetujuan)
                                                {{ $approval->jabatan }}
                                            @endif
                                        @endif
                                    @endforeach
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12.5px;" id="date_pemoho">
                                <span style="position: relative; 3%">Date</span>
                                <span style="position:relative; left: 15%;">:</span>
                                <span style="position: relative; left: 14%;" nowrap>
                                    {{ \Carbon\Carbon::parse($pds->tanggal_pengajuan)->translatedFormat('d F Y') }}
                                </span>
                            </td>

                            <td style="border:none;"></td>

                            <td style="font-size:12.5px;" id="date_id_1">
                                <span style="position: relative; 3%">Date</span>
                                <span style="position:relative; left: 14%;">:</span>
                                <span style="position: relative; left: 14%;" nowrap></span>
                            </td>

                            <td style="font-size:12.5px;" id="date_id_2">
                                <span style="position: relative; 3%">Date</span>
                                <span style="position:relative; left: 14%;">:</span>
                                <span style="position: relative; left: 14%;" nowrap></span>
                            </td>

                            <td style="font-size:12.5px;" id="date_id_3">
                                <span style="position: relative; 3%">Date</span>
                                <span style="position:relative; left: 14%;">:</span>
                                <span style="position: relative; left: 14%;" nowrap></span>
                            </td>

                            <td style="font-size:12.5px;" id="date_id_4">
                                <span style="position: relative; 3%">Date</span>
                                <span style="position:relative; left: 14.2%;">:</span>
                                <span style="position: relative; left: 15%;" nowrap></span>
                            </td>

                            <td style="font-size:12.5px;" id="date_id_5">
                                <span style="position: relative; 3%">Date</span>
                                <span style="position:relative; left: 14%;">:</span>
                                <span style="position: relative; left: 15%;" nowrap></span>
                            </td>

                            <td style="font-size:12.5px;" id="date_id_6">
                                <span style="position: relative; 3%">Date</span>
                                <span style="position:relative; left: 14%;">:</span>
                                <span style="position: relative; left: 15%;" nowrap></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div> --}}
            <br>
            <br>
        @endforeach
    @endforeach
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</body>
