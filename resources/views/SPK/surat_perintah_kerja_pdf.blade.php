<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Perintah Kerja</title>
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
    <h2>Surat Perintah Kerja</h2>
    <table>
        <thead>
            <tr>
                <th>Kode Project</th>
                <th>Nama Project</th>
                <th>User</th>
                <th>Main Contractor</th>
                <th>Project Manager</th>
                <th>No SPK</th>
                <th>Tanggal</th>
                <th>Prioritas</th>
                <th>Waktu Penyelesaian</th>
                <th>Tipe Dokumen Pendukung</th>
                <th>File Dokumen Pendukung</th>
                <th>File Pendukung Lainnya</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suratPerintahKerjas as $suratPerintahKerja)
                <tr>
                    <td>{{ $suratPerintahKerja->kode_project }}</td>
                    <td>{{ $suratPerintahKerja->nama_project }}</td>
                    <td>{{ $suratPerintahKerja->user }}</td>
                    <td>{{ $suratPerintahKerja->main_contractor }}</td>
                    <td>{{ $suratPerintahKerja->project_manager }}</td>
                    <td>{{ $suratPerintahKerja->no_spk }}</td>
                    <td>{{ $suratPerintahKerja->tanggal }}</td>
                    <td>{{ $suratPerintahKerja->prioritas }}</td>
                    <td>{{ $suratPerintahKerja->waktu_penyelesaian }} </td>
                    <td>{{ $suratPerintahKerja->dokumen_pendukung_type }}</td>
                    <td><a href="{{ asset('posts/images/' . $suratPerintahKerja->dokumen_pendukung_file) }}">Open
                            Document</a></td>
                    <td>{{ $suratPerintahKerja->file_pendukung_lainnya }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
