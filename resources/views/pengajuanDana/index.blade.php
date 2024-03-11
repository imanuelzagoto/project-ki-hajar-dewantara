@extends('layouts.master')

@section('PD')
    Pengajuan Dana
@endsection

@section('title')
    Pengajuan Dana
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display table table-striped table-hover" id="DataTablePD" style="width:100%">
                                <thead>
                                    <tr class="tr-table">
                                        <th class="text-center">No.Doc</th>
                                        <th class="text-center">Revisi</th>
                                        <th class="text-center">Pemohon</th>
                                        <th class="text-center">Tujuan</th>
                                        <th class="text-center">Lokasi Pengajuan</th>
                                        <th class="text-center" style="width:19%;">Tanggal
                                            Pengajuan</th>
                                        <th class="text-center" style="width:25%;">Batas Waktu
                                        </th>
                                        <th class="text-center" style="width:23%;">Total Dana
                                        </th>
                                        <th class="text-center">Metode Penerimaan</th>
                                        <th class="text-center" nowrap>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengajuanDanas as $pds)
                                        <tr class="kolom-td">
                                            <td class="text-center" style="font-weight:400;">
                                                {{ $pds->no_doc }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;">
                                                {{ $pds->revisi }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;" nowrap>
                                                {{ $pds->nama_pemohon }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;">
                                                {{ $pds->tujuan }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;">
                                                {{ $pds->lokasi }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;" nowrap>
                                                {{ $pds->tanggal }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;" nowrap>
                                                {{ $pds->jangka_waktu }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;" nowrap>
                                                {{ 'Rp. ' . number_format($pds->dana_yang_dibutuhkan, 0, ',', '.') }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;">
                                                {{ $pds->no_rekening }}
                                            </td>
                                            <td class="justify-content-end" style="font-weight:400;" nowrap>
                                                <button class="btn btn-sm btn-outline-primary btn-action">Edit</button>
                                                <a href="#" class="fas fa-eye btn btn-sm"
                                                    style="color:#1814F3; font-size:18px; border: none; padding: 0; margin-left:8px;"></a>

                                                <a href="#" class="fas fa-trash-alt btn btn-sm"
                                                    style="color:#F31414; font-size:17px; border: none; padding: 0;margin-left:8px;"></a>
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

    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var DataTablePD = $('#DataTablePD').DataTable({
                "pageLength": getPageLengthFromLocalStorage('DataTablePD'),
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

            // Function to get page length from localStorage
            function getPageLengthFromLocalStorage(tableId) {
                var storedLength = localStorage.getItem(tableId + '_pageLength');
                if (storedLength) {
                    return parseInt(storedLength);
                } else {
                    return 5; // Default page length
                }
            }

            // Save page length to localStorage
            $('select[name="DataTablePD_length"]').change(function() {
                var val = $(this).val();
                localStorage.setItem('DataTablePD_pageLength', val);
            });
        });
    </script>
@endsection
