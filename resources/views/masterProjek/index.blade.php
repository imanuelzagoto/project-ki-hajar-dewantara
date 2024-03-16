@extends('layouts.master')

@section('master_projek')
    Master Projek
@endsection

@section('title')
    Master Projek
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mb-3">
                <button class="btn btn-perintah" onclick="tambahData()" style="border-radius: 7px;">
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
                            <table class="table table-striped table-bordered table-hover" id="DataTableMP"
                                style="width:100%">
                                <thead>
                                    <tr class="tr-table" style="box-sizing: border-box;">
                                        <th class="text-center">Nama Projek</th>
                                        <th class="text-center">Kode Projek</th>
                                        <th class="text-center">Tenggat</th>
                                        <th class="text-center">Mulai</th>
                                        <th class="text-center">Akhir</th>
                                        <th class="text-center" nowrap>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($masterProjeks as $mps)
                                        <tr class="kolom-td">
                                            <td class="text-center" style="font-weight:400; box-sizing: border-box;" nowrap>
                                                {{ $mps->nama_project }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;" nowrap>
                                                {{ $mps->kode_project }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;" nowrap>
                                                {{ $mps->tenggat }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;" nowrap>
                                                {{ \Carbon\Carbon::parse($mps->mulai)->format('d-m-Y') }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;" nowrap>
                                                {{ \Carbon\Carbon::parse($mps->akhir)->format('d-m-Y') }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;" nowrap>
                                                <a href="#" class="fas fa-pen btn btn-sm tooltip-container"
                                                    style="color:#4FD1C5; font-size:20px;">
                                                    <span class="tooltip-edit">Edit</span>
                                                </a>
                                                <a href="#" class="fas fa-eye btn btn-sm tooltip-container"
                                                    style="color:#1814F3; font-size:20px; border: none; margin-left:2px;">
                                                    <span class="tooltip-show">View</span>
                                                </a>

                                                <a href="#" class="fas fa-trash-alt btn btn-sm tooltip-container"
                                                    style="color:#F31414; font-size:20px;">
                                                    <span class="tooltip-delete">Delete</span>
                                                </a>
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


    <script>
        $(document).ready(function() {
            // Mengambil nilai entri per halaman yang tersimpan atau default jika tidak ada
            var storedPageLength = getPageLengthFromLocalStorage('DataTableMP');

            var DataTablePD = $('#DataTableMP').DataTable({
                "pageLength": storedPageLength,
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
                                '</option>')
                        });
                    });
                }
            });

            // Function untuk mendapatkan jumlah entri per halaman dari localStorage
            function getPageLengthFromLocalStorage(tableId) {
                var storedLength = localStorage.getItem(tableId + '_pageLength');
                if (storedLength) {
                    return parseInt(storedLength);
                } else {
                    return 10; // Default jumlah entri per halaman
                }
            }

            // Menyimpan jumlah entri per halaman ke localStorage saat dipilih
            $('select[name="DataTableMP_length"]').change(function() {
                var val = $(this).val();
                localStorage.setItem('DataTableMP_pageLength', val);
            });
        });
    </script>
@endsection
