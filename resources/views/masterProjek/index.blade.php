@extends('layouts.master')
@section('title')
    Master Projek
@endsection
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <div class="main-dashboard mt--3">
        <nav aria-label="breadcrumb">
            <div class="breadcrumb mt-1 d-flex justify-content-between">
                <div class="d-lg-none">
                    <button class=" navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                        data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon">
                            <i class="fas fa-bars"></i>
                        </span>
                    </button>
                </div>
                <div class="d-none d-lg-block d-sm-none breadcrumb-item">
                    <ul class="breadcrumbs">
                        <li class="breadcrumbs__item">
                            <a href="{{ route('master-projek.index') }}" class="breadcrumbs__link"
                                style="color: #A0AEC0;font-size: 15px; font-weight: 500;">
                                Pages
                            </a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a href="{{ route('master-projek.index') }}" class="breadcrumbs__link"
                                style="color: #17a2b8;font-size: 15px; font-weight: 500;">
                                Master Projek
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="btn btn-sm mt--2 rounded tooltip-container" type="button"
                    style="float: left; margin-left:13px; background-color:#F1F4FA;">
                    <a class="button-logout" onclick="$('#logout-form').submit()" style="color: #D41B14;">
                        Logout
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                    <span class="tooltip-text mb-2" style="font-size: 10px;">Logout</span>
                </button>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h2 class="text-dashboard font-weight-bold display-6">
                        Master Projek
                    </h2>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <h2 class="fiturjam font-weight-bold display-6">
                        <ul class="list-unstyled mb-0" style="margin-top: 3px;">
                            <li id="datetime" class="datetime_home">
                                <i class="fas fa-calendar"></i>&nbsp;
                                <i class="far fa-clock"></i>&nbsp;
                            </li>
                        </ul>
                    </h2>
                </div>
            </div>
        </nav>
        <form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none;">
            @csrf
        </form>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mb-3 mb-md-0 d-flex align-items-center" style="margin-top: 23px;">
                <form id="dataTableSearchForm" style="height: 44px; width: 255px;" class="mr-2">
                    <div class="col mr-1 border-container">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchProject" class="form-control form-control-sm pl-0 rounded-right"
                            placeholder="Type here...." aria-controls="dataTable">
                    </div>
                </form>
                <button type="button" id="filtersButtonProject" class="btn btn-sm btn-outline-info ml-2 btn-filters"
                    style="font-size: 15.18px;">
                    <i class="fas fa-sliders-h"></i> Search
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="margin-top: 10px;">
                    <div class="card-body">
                        <div class="align-items-center d-flex-center" style="margin-bottom: -77px;">
                            <select id="showEntriesProject" class="form-control form-control-sm mr-2 select_entries"
                                style="width: 70px; border-color:#ECEDF2; position: relative; left:10px;">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <span class="labelentris">entries per page</span>
                        </div>
                        <div class="custom_table_wrapper">
                            <table class="element-scrollbar table table-hover display-6 w-100" style="overflow-x: auto; display: block; padding-top: 20px; overflow-y: hidden;" id="tableProject">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="font-weight:700;">No</th>
                                        <th class="text-center" style="font-weight:700;" nowrap>Nama Projek</th>
                                        <th class="text-center" style="font-weight:700;" nowrap>Kode Projek</th>
                                        <th class="text-center" style="font-weight:700;" nowrap>User</th>
                                        <th class="text-center" style="font-weight:700;" nowrap>Main Contractor</th>
                                        <th class="text-center" style="font-weight:700;" nowrap>Project Manager</th>
                                        <th class="text-center" style="font-weight:700;" nowrap>Tenggat</th>
                                        <th class="text-center" style="font-weight:700;" nowrap>Mulai</th>
                                        <th class="text-center" style="font-weight:700;" nowrap>Akhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        use Illuminate\Support\Str;
                                    @endphp
    
                                    @php $i = 0; @endphp
                                    @foreach ($projects as $project)
                                        @php $i += 1; @endphp
                                        <tr class="Column_td">
                                            <td class="text-center" style="font-weight:500;">{{ $i }}</td>
                                            <td class="text-left wrapper first-column" style="font-weight:500;" nowrap>
                                                {{ Str::limit($project['title'], 50) }}
                                                <span class="tooltip_custom" id="tooltip_{{ $loop->index }}">{{ $project['title'] }}</span>
                                            </td>                                                                                                                                                                                                     
                                            <td class="text-left" style="font-weight:500; " nowrap>
                                                {{ $project['code'] }}
                                            </td>
                                            <td class="text-left" style="font-weight:500;" nowrap>
                                                {{ $project['user'] }}
                                            </td>
                                            <td class="text-center" style="font-weight:500;" nowrap>
                                                {{ $project['main_contractor'] }}
                                            </td>
                                            <td class="text-left" style="font-weight:500;" nowrap>
                                                {{ $project['project_manager'] }}
                                            </td>
                                            <td class="text-center" style="font-weight:500;" nowrap>
                                                {{ Carbon\Carbon::parse($project['end_date'])->format('d-m-Y') }}
                                            </td>
                                            <td class="text-center" style="font-weight:500;" nowrap>
                                                {{ Carbon\Carbon::parse($project['start_date'])->format('d-m-Y') }}
                                            </td>
                                            <td class="text-center" style="font-weight:500;" nowrap>
                                                {{ Carbon\Carbon::parse($project['end_date'])->format('d-m-Y') }}
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
        document.addEventListener('DOMContentLoaded', function () {
            var wrappers = document.querySelectorAll('.wrapper');
            wrappers.forEach(function(wrapper) {
                var tooltip = wrapper.querySelector('.tooltip_custom');
                if (tooltip) {
                    var fullTitle = tooltip.textContent.trim();
                    tooltip.remove();
                    var newTooltip = document.createElement('span');
                    newTooltip.className = 'tooltip_custom';
                    newTooltip.textContent = fullTitle;
                    wrapper.appendChild(newTooltip);
                }
            });
        });
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.tooltip_custom').forEach(function(tooltip) {
                const text = tooltip.textContent || tooltip.innerText;
                const wrapper = tooltip.closest('.wrapper');

                if (text.length > 30) {
                    tooltip.style.background = '#4FD1C5';
                    tooltip.style.width = '130%';
                    tooltip.style.wordBreak = 'break-word';
                    tooltip.style.whiteSpace = 'normal';

                    if (wrapper && wrapper.classList.contains('first-column')) {
                        tooltip.style.position = 'absolute';
                        tooltip.style.bottom = '20px';
                    }
                } else {
                    tooltip.style.background = '#4FD1C5';
                    tooltip.style.width = '55%';
                }
            });
        });
    </script>
@endsection

@push('scripts')
    <script>
        // JS DELETE
        function submitDelete(id) {
            event.preventDefault();
            Swal.fire({
                title: "<span style='color: #F31414; font-weight: 700;'>HAPUS?</span>",
                html: "<span style='color: #2D3748; font-weight: 700;'>Apakah Anda yakin ingin menghapus item ini?</span>",
                // icon: "warning",
                iconHtml: "<i class='fas fa-trash-alt' style='color: #FFFFFF; background-color: #F31414; border-radius: 50%; padding: 23.5px; font-size: 47px; width:90px; height:90px;'></i>",
                showCancelButton: true,
                confirmButtonColor: "#22B37C",
                cancelButtonColor: "#d33",
                confirmButtonText: "Lanjutkan",
                customClass: {
                    title: 'swal2-title-custom',
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "<span style='color: #22B37C; font-size:25px; border-radius: 19px; font-weight: 700; font-family: Helvetica;'>SUCCESS</span>",
                        icon: "success",
                        showConfirmButton: false,
                        confirmButtonColor: "#22B37C",
                    });
                    setTimeout(() => {
                        document.getElementById('delete-form-' + id).submit();
                    }, 2000);
                }
            });
        }


        document.addEventListener('DOMContentLoaded', function() {
            setInterval(updateClock, 1000);
            updateClock();
        });

        function updateClock() {
            var now = new Date();
            var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
                'November', 'Desember'
            ];

            // Set timezone to Asia/Jakarta
            var options = {
                timeZone: 'Asia/Jakarta',
                weekday: 'long'
            };
            var dayName = new Intl.DateTimeFormat('id-ID', options).format(now);

            var dateTimeString = '<i class="fas fa-calendar"></i>&nbsp;' + dayName + ', ' + now.getDate() + ' ' +
                months[now.getMonth()] + ' ' + now.getFullYear() + '&nbsp;&nbsp;<i class="far fa-clock"></i>&nbsp;' +
                formatTime(now);

            var datetimeElement = document.getElementById('datetime');
            if (datetimeElement) {
                datetimeElement.innerHTML = dateTimeString;
            } else {
                console.error("Datetime element not found.");
            }
        }

        function formatTime(date) {
            var hours = date.getHours();
            var minutes = date.getMinutes();
            var seconds = date.getSeconds();
            hours = hours < 10 ? '0' + hours : hours;
            minutes = minutes < 10 ? '0' + minutes : minutes;
            seconds = seconds < 10 ? '0' + seconds : seconds;
            var strTime = hours + ':' + minutes + ':' + seconds;
            return strTime;
        }


        // JS DATATABLE
        $(document).ready(function() {
            function getPageLengthFromLocalStorage(tableId) {
                var storedLength = localStorage.getItem(tableId + '_pageLength');
                if (storedLength) {
                    return parseInt(storedLength);
                } else {
                    return 10;
                }
            }

            // table spk
            var tableProject = $('#tableProject').DataTable({
                "pageLength": getPageLengthFromLocalStorage('tableProject'),
                // "info": false, // Menonaktifkan pesan info
                // "paging": false,
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
                                '</option>');
                        });
                    });
                }
            });

            // Set value for show entries dropdown on page load
            $('#showEntriesProject').val(getPageLengthFromLocalStorage('tableProject'));

            $('#showEntriesProject').change(function() {
                var val = $(this).val();
                tableProject.page.len(val).draw();
                localStorage.setItem('tableProject_pageLength', val);
            });

            $('#filtersButtonProject').click(function() {
                var searchText = $('#searchProject').val();
                tableProject.search(searchText).draw();
            });

            $('#searchProject').on('input', function() {
                var searchText = $(this).val();
                if (!searchText.trim()) {
                    tableProject.search('').draw();
                }
            });

            $('#dataTableSearchForm').submit(function(event) {
                event.preventDefault();
                $('#filtersButtonProject').click();
            });
        });
        // End JS Table
    </script>
@endpush
