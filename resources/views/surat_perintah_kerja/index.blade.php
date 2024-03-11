@extends('layouts.master')

@section('spk')
    Surat Perintah Kerja
@endsection

@section('title')
    Surat Perintah Kerja (SPK)
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display table table-striped table-hover" id="dataSPK" style="width:100%">
                                <thead>
                                    <tr style="color: #718EBF; font-family: 'Inter', sans-serif; line-height:19.36px;">
                                        <th class="text-center" nowrap>Nama Project</th>
                                        <th class="text-center">User</th>
                                        <th class="text-center" nowrap>Main Contractor</th>
                                        <th class="text-center" nowrap>Project Manager</th>
                                        <th class="text-center" style="width:19%;">PIC</th>
                                        <th class="text-center" style="width:25%;">No SPK</th>
                                        <th class="text-center" style="width:23%;">Tanggal</th>
                                        <th class="text-center" nowrap>Tanggal selesai</th>
                                        <th class="text-center" nowrap>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suratPerintahKerjas as $spk)
                                        <tr style="color: #232323; font-family: 'Inter', sans-serif; line-height:19.36px;">
                                            <td class="text-center" style="font-weight:400;">
                                                {{ $spk->nama_project }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;" nowrap>
                                                {{ $spk->user }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;" nowrap>
                                                {{ $spk->main_contractor }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;">
                                                {{ $spk->project_manager }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;" nowrap>
                                                {{ $spk->pic }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;" nowrap>
                                                {{ $spk->no_spk }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;" nowrap>
                                                {{ $spk->tanggal }}
                                            </td>
                                            <td class="text-center" style="font-weight:400;" nowrap>
                                                {{ $spk->waktu_penyelesaian }}
                                            </td>
                                            <td class="justify-content-end" style="font-weight:400;" nowrap>
                                                <button class="btn btn-sm btn-outline-primary"
                                                    style="border-radius: 6px; border: 1px solid #1814F3; padding: 5px 10px;">
                                                    Edit
                                                </button>
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
            var dataSPK = $('#dataSPK').DataTable({
                "pageLength": getPageLengthFromLocalStorage('dataSPK'),
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
            $('select[name="dataSPK_length"]').change(function() {
                var val = $(this).val();
                localStorage.setItem('dataSPK_pageLength', val);
            });
        });
    </script>
@endsection
