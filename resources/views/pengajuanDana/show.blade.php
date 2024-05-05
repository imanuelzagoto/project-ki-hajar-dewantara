<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Dana</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
        }

        th,
        td {
            background-color: #ffffff;
            border: 1px solid #000000;
            font-weight: 0;
        }

        .table-header {
            width: 80px;
        }

        .text-pengajuan-dana {
            font-size: 23px;
            text-align: center;
            font-weight: bold;
            vertical-align: top;
            width: 10px;
        }

        .text-date-table {
            font-size: 10px;
        }

        .coloumn-tanggal-pengajuan {
            font-size: 14.5px;
            border-bottom: 0px;
            width: 120px;
            padding-left: 3px;
        }

        .coloumn-no-doc {
            font-size: 14.5px;
            border-bottom: 0px;
            border-top: 0px;
            padding-left: 3px;
        }

        .column-revisi {
            border-top: 0px;
            font-size: 14.5px;
            padding-left: 3px;
        }

        .column-subject {
            width: 266px;
            font-size: 14.5px;
            padding-left: 3px;
        }

        .column_nama_pemohon {
            font-size: 14.5px;
            padding-left: 3px;
        }

        .data_tujuan {
            font-size: 14.5px;
            padding-left: 8px;
        }

        .data_lokasi {
            font-size: 14.5px;
            padding-left: 8px;
        }

        .data_batas_waktu {
            font-size: 14.5px;
            padding-left: 8px;
        }

        .data_nominal {
            font-size: 14.5px;
            padding-left: 8px;
        }

        .data_no_rekening {
            font-size: 14.5px;
            padding-left: 8px;
        }

        .data_catatan {
            font-size: 14.5px;
            padding-left: 8px;
        }

        .teks_drafting {
            font-size: 14.5px;
            padding-left: 8px;
        }

        .column-diajukan {
            font-size: 14.5px;
            text-align: center;
            font-weight: bold;
        }

        .column_persetujuan {
            font-size: 14.5px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>

<body>
    @php
        $i = 0;
    @endphp
    @foreach ($pengajuan_danas as $pds)
        {{-- @foreach ($pds->items as $item) --}}
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
                            {{ \Carbon\Carbon::parse($pds->tanggal_pengajuan)->format('d F Y') }}</th>
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
        <br>

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
        <br>

        <div class="form_list_pengajuan_dana">
            <div class="data_tujuan">
                1.
                <span style="padding-left: 3px; font-size: 14.5px;">Tujuan</span>
                <span style="padding-left: 181.8px; font-size: 14.5px;">:</span>
                <span style="padding-left: 10px; font-size: 14.5px;">{{ $pds->tujuan }}</span>
            </div>
            <div class="data_lokasi">
                2.
                <span style="padding-left: 4px; font-size: 14.5px;">Lokasi</span>
                <span style="padding-left: 183px; font-size: 14.5px;">:</span>
                <span style="padding-left: 10px; font-size: 14.5px;">{{ $pds->lokasi }}</span>
            </div>
            <div class="data_batas_waktu">
                3.
                <span style="padding-left: 3px; font-size: 14.5px;">Jangka waktu permohonan</span>
                <span style="padding-left: 52.2px; font-size: 14.5px;">:</span>
                <span style="padding-left: 6.8px; font-size: 14.5px;">
                    {{ \Carbon\Carbon::parse($pds->batas_waktu)->format('d F Y') }}
                </span>
            </div>
            <div class="data_nominal">
                4.
                <span style="padding-left: 3px; font-size: 14.5px;">Dana yang dibutuhkan</span>
                <span style="padding-left: 81.2px; font-size: 14.5px;">:</span>
                <span style="padding-left: 12px; font-size: 14.5px;">
                    Rp
                </span>
                <span style="padding-left: 11px; font-size: 14.5px;">
                    {{ number_format($pds->subtotal, 0, ',', '.') }}
                </span>
                <span style="padding-left: 5px; font-size: 14px; font-style:italic;">
                    {{ $pds->terbilang }}
                </span>
            </div>
            <div class="data_no_rekening">
                5.
                <span style="padding-left: 4px; font-size: 14.5px;">No. Rekening</span>
                <span style="padding-left: 137.6px; font-size: 14.5px;">:</span>
                <span
                    style="padding-left: 10px; font-size: 14.5px; font-weight:bold;">{{ $pds->metode_penerimaan }}</span>
            </div>
            <div class="data_catatan">
                6.
                <span style="padding-left: 4px; font-size: 14.5px;">Catatan</span>
                <span style="padding-left: 175px; font-size: 14.5px;">:</span>
                <span style="padding-left: 10px; font-size: 14.5px;">{{ $pds->catatan }}</span>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th rowspan="3" style="width: 20px; font-size:14px; text-align:center;">
                        NO
                    </th>
                    <th colspan="3" rowspan="3" style="text-align: center; font-size:14px; width:67px;">Item
                    </th>
                    <th colspan="2" style="text-align: center; font-size:14px; width:40px;">Item</th>
                    <th colspan="2" style="text-align: center; font-size:14px;">Harga</th>
                    <th style="text-align: center; font-size:14px; width:300px;">Total</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2" rowspan="2" style="text-align: center; padding-bottom:10px;">
                        <span>( a )</span>
                    </td>
                    <td colspan="2" rowspan="2" style="text-align: center; padding-bottom:10px;">
                        <span>( b )</span>
                    </td>
                    <td style="text-align: center; padding-bottom:10px;">
                        <span>(c)</span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; padding-bottom:10px;">
                        <span>( c )=( b )x( a )</span>
                    </td>
                </tr>
                @php
                    $i = 0;
                @endphp
                @foreach ($pds->items as $item)
                    @php
                        $i += 1;
                    @endphp
                    <tr>
                        <td style="text-align: center;">{{ $i }}.</td>
                        <td colspan="3">{{ $item->nama_item }}</td>
                        <td style="text-align: center;">{{ $item->jumlah }}</td>
                        <td style="text-align: center;">{{ $item->satuan }}</td>
                        <td colspan="2" style="text-align: right; padding-right:5px;">
                            {{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td style="text-align: right; padding-right:5px;">
                            {{ number_format($item->total, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="8" style="font-weight: bold; text-align: right; padding-right:5px;">Sub Total
                    </td>
                    <td style="text-align: right; padding-right:5px; font-weight:bold;">
                        {{ number_format($pds->subtotal, 0, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="teks_finnaly">
            <div class="teks_drafting">
                Demikian drafting pengajuan dana ini saya sampaikan atas bantuan dan kerja samanya saya ucapkan
                terima
                kasih.
            </div>
        </div>
        <br>

        <table>
            <thead>
                <tr>
                    <th class="column-diajukan">
                        Diajukan Oleh,
                    </th>
                    <th style="width:5px; border:none;"></th>
                    <th colspan="5" class="column_persetujuan">Diperiksa dan Disetujui oleh,</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td rowspan="3" style="text-align: center; width: 60px;"></td>
                    <td style="border:none;"></td>
                    <td rowspan="3" style="text-align: center; height:80px; width:60px;"></td>
                    <td rowspan="3" style="text-align: center; height:80px; width:60px;"></td>
                    <td rowspan="3" style="text-align: center; height:80px; width:60px;"></td>
                    <td rowspan="3" style="text-align: center; height:80px; width:60px;"></td>
                    <td rowspan="3" style="text-align: center; height:60px; width:60px;"></td>

                </tr>
                <tr>
                    <td style="border:none;"></td>
                </tr>
                <tr>
                    <td style="border:none;"></td>
                </tr>
                <tr>
                    <td style="padding-left: 3px; font-size:12.5px;">
                        Nama
                        <span style="padding-left: 20px;">:</span>
                        <span style="padding-left: 3px; font-size:12.5px;" nowrap>{{ $pds->nama_pemohon }}</span>
                    </td>
                    <td style="border:none;"></td>
                    <td style="padding-left: 3px; font-size:12.5px;">
                        Nama
                        <span style="padding-left: 18px;">:</span>
                        <span style="padding-left: 3px; font-size:12.5px;" nowrap>Bu Yani</span>
                    </td>
                    <td style="padding-left: 3px; font-size:12.5px;">
                        Nama
                        <span style="padding-left: 18px;">:</span>
                        <span style="padding-left: 3px; font-size:12.5px;" nowrap>Bayu</span>
                    </td>
                    <td style="padding-left: 3px; font-size:12.5px;">
                        Nama
                        <span style="padding-left: 18px;">:</span>
                        <span style="padding-left: 3px; font-size:12.5px;" nowrap>Sindu Irawan</span>
                    </td>
                    <td style="padding-left: 3px; font-size:12.5px;">
                        Nama
                        <span style="padding-left: 18px;">:</span>
                        <span style="padding-left: 3px; font-size:12.5px;" nowrap>Victor</span>
                    </td>
                    <td style="padding-left: 3px; font-size:12.5px;">
                        Nama
                        <span style="padding-left: 18px;">:</span>
                        <span style="padding-left: 3px; font-size:12.5px;" nowrap>Erwin Danuaji</span>
                    </td>

                </tr>
                <tr>
                    <td style="padding-left: 3px; font-size:12.5px;">
                        Jabatan
                        <span style="padding-left: 8px;">:</span>
                        <span style="padding-left: 3px; font-size:12.5px;" nowrap>{{ $pds->jabatan_pemohon }}</span>
                    </td>
                    <td style="border:none;"></td>
                    <td style="padding-left: 3px; font-size:12.5px;">
                        Jabatan
                        <span style="padding-left: 7px;">:</span>
                        <span style="padding-left: 3px; font-size:12.5px;" nowrap>GM</span>
                    </td>
                    <td style="padding-left: 3px; font-size:12.5px;">
                        Jabatan
                        <span style="padding-left: 7px;">:</span>
                        <span style="padding-left: 3px; font-size:12.5px;" nowrap>GM</span>
                    </td>
                    <td style="padding-left: 3px; font-size:12.5px;">
                        Jabatan
                        <span style="padding-left: 7px;">:</span>
                        <span style="padding-left: 3px; font-size:12.5px;" nowrap>BOD</span>
                    </td>
                    <td style="padding-left: 3px; font-size:12.5px;">
                        Jabatan
                        <span style="padding-left: 7px;">:</span>
                        <span style="padding-left: 3px; font-size:12.5px;" nowrap>BOD</span>
                    </td>
                    <td style="padding-left: 3px; font-size:12.5px;">
                        Jabatan
                        <span style="padding-left: 7px;">:</span>
                        <span style="padding-left: 3px; font-size:12.5px;" nowrap>BOD</span>
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 3px; font-size:12.5px;">
                        Date
                        <span style="padding-left: 25.3px;">:</span>
                        <span style="padding-left: 3px; font-size:12.5px;"
                            nowrap>{{ \Carbon\Carbon::parse($pds->tanggal_pengajuan)->format('d F Y') }}</span>
                    </td>
                    <td style="border:none;"></td>
                    <td style="padding-left: 3px; font-size:12.5px;">
                        Date
                        <span style="padding-left: 25.3px;">:</span>
                        <span style="padding-left: 3px; font-size:12.5px;"nowrap></span>
                    </td>
                    <td style="padding-left: 3px; font-size:12.5px;">
                        Date
                        <span style="padding-left: 25.3px;">:</span>
                        <span style="padding-left: 3px; font-size:12.5px;" nowrap></span>
                    </td>
                    <td style="padding-left: 3px; font-size:12.5px;">
                        Date
                        <span style="padding-left: 25.3px;">:</span>
                        <span style="padding-left: 3px; font-size:12.5px;" nowrap></span>
                    </td>
                    <td style="padding-left: 3px; font-size:12.5px;">
                        Date
                        <span style="padding-left: 25.3px;">:</span>
                        <span style="padding-left: 3px; font-size:12.5px;" nowrap></span>
                    </td>
                    <td style="padding-left: 3px; font-size:12.5px;">
                        Date
                        <span style="padding-left: 25.3px;">:</span>
                        <span style="padding-left: 3px; font-size:12.5px;" nowrap></span>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <br>
    @endforeach
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</body>
