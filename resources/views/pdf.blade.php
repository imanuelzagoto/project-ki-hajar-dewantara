{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Perintah Kerja</title>
    <style>
        body {
            font-family: arial, sans-serif;
            margin: 7px;
        }

        .garis_tepi1 {
            border: 2px solid red;
        }

        .titileSPK {
            color: #00008B;
            font-size: 20px;
            line-height: 1.33;
            margin-top: 0;
            margin-bottom: 0;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>

<body>
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
                <th>PIC</th>
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
                    <td>{{ $suratPerintahKerja->pic }} </td>
                    <td>{{ $suratPerintahKerja->dokumen_pendukung_type }}</td>
                    <td><a href="{{ asset('posts/images/' . $suratPerintahKerja->dokumen_pendukung_file) }}">Open
                            Document</a></td>
                    <td>{{ $suratPerintahKerja->file_pendukung_lainnya }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html> --}}
