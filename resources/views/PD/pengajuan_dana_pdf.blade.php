<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengajuan Dana</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 7px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            font-size: 7pt;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Pengajuan Dana</h2>
    <table>
        <thead>
            <tr>
                <th>Nama Pemohon</th>
                <th>Subject</th>
                <th>Tujuan</th>
                <th>Lokasi</th>
                <th>Jangka Waktu</th>
                <th>Dana yang Dibutuhkan</th>
                <th>No.Rekening</th>
                <th>Catatan</th>
                <th>Tanggal</th>
                <th>No.Doc</th>
                <th>Revisi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengajuan_danas as $pengajuanDana)
                <tr>
                    <td>{{ $pengajuanDana->nama_pemohon }}</td>
                    <td>{{ $pengajuanDana->subject }}</td>
                    <td>{{ $pengajuanDana->tujuan }}</td>
                    <td>{{ $pengajuanDana->lokasi }}</td>
                    <td>{{ $pengajuanDana->jangka_waktu }}</td>
                    <td>{{ number_format($pengajuanDana->dana_yang_dibutuhkan, 0, ',', '.') }}</td>
                    <td>{{ $pengajuanDana->no_rekening }}</td>
                    <td>{{ $pengajuanDana->catatan }}</td>
                    <td>{{ $pengajuanDana->tanggal }}</td>
                    <td>{{ $pengajuanDana->no_doc }}</td>
                    <td>{{ $pengajuanDana->revisi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
