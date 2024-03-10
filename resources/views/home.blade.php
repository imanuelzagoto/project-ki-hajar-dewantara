@extends('layouts.master')

@section('bredcrum')
    Dashboard
@endsection

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-chart" style="border-radius: 8.16px;">
                    <div class="card-header">
                        <h5 class="card-title font-weight-bold"
                            style="color: #2D3748; font-family:Arial, Helvetica, sans-serif; font-size: 18px; line-height:25.2px;">
                            Grafik Bulanan</h5>
                    </div>
                    <div id="chart" style="margin-top: 1%;"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card p-3 custom-card h-100"
                            style="background-image: url('{{ asset('partas/img/card.png') }}'); 
                                font-family: Arial, Helvetica, sans-serif; 
                                background-size: auto 112%; 
                                background-repeat: no-repeat; 
                                background-position: center;
                                color: #FFFFFF;">
                            <p style="font-size: 16.44px; font-weight:400; line-height:24.66px;">Dashboard ki hajar
                                dewantara</p>
                            <h2 class="font-weight-bold text-white username mt--3"
                                style="font-size: 39px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis; line-height:65.03px; font-weight:700;"
                                id="greeting">Hello <span id="shortName"></span> !</h2>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="text-center" style="font-family: Arial, Helvetica, sans-serif;">
                            <div class="card p-3 font-weight-bold text-center"
                                style="height: 248px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                                <div class="rounded-3 text-white d-flex align-items-center justify-content-center mt-2"
                                    style="width: 67.68px; height: 67.68px; border-radius: 12.69px; background: #4FD1C5;">
                                    <i class="fas fa-wallet fa-2x mr-2 mt--1" style="width: 20px; height: 20px;"></i>
                                </div>
                                <h4 class="mt-3"
                                    style="font-size: 19.04px; line-height: 26.65px; color:#2D3748; font-weight:700;">
                                    Pengajuan Dana
                                </h4>
                                <h6 style="font-size: 12.69px; line-height: 19.04px; color:#A0AEC0; font-weight:700;">
                                    Pengajuan Aktif
                                </h6>
                                <hr
                                    style="width: 100%; border: 0; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(186, 181, 181, 0.75), rgba(0, 0, 0, 0));">
                                <h4 style="font-size:19.04px; font-weight:700; line-height:26.65px;">
                                    {{ $total_pengajuan_dana }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="text-center" style="font-family: Arial, Helvetica, sans-serif;">
                            <div class="card p-3 font-weight-bold text-center"
                                style="height: 248px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                                <div class="rounded-3 text-white d-flex align-items-center justify-content-center mt-2"
                                    style="width: 67.68px; height: 67.68px; border-radius: 12.69px; background: #4FD1C5;">
                                    <i class="fab fa-paypal fa-2x mt--1" style="width: 20px; height: 20px;"></i>
                                </div>
                                <h4 class="mt-3"
                                    style="font-size: 19.04px; line-height: 26.65px; color:#2D3748; font-weight:700;">
                                    SPK
                                </h4>
                                <h6 style="font-size: 12.69px; line-height: 19.04px; color:#A0AEC0; font-weight:700;">
                                    Permintaan Aktif
                                </h6>
                                <hr
                                    style="width: 100%; border: 0; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(186, 181, 181, 0.75), rgba(0, 0, 0, 0));">
                                <h4 style="font-size:19.04px; font-weight:700; line-height:26.65px;">
                                    {{ $total_pengajuan_spk }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="font-weight-bold"
                style="font-family: 'Inter', sans-serif; font-size: 22px; line-height: 26.63px; color: #343C6A; font-weight: 600; margin-left: 19px;">
                Permintaan Terakhir
            </div>
        </div>
    </div>
    <!-- Menu Button -->
    <div class="row">
        <div class="col" style="margin-left: 14px;">
            <div class="menu mt-3">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" role="tab"
                            aria-controls="home" aria-selected="true"
                            style="color: #718EBF; transition: color 0.3s; font-weight: 700; font-family: 'Inter', sans-serif; font-size:16px; line-height:19.36px;">Pengajuan
                            Dana</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" role="tab"
                            aria-controls="profile" aria-selected="false"
                            style="color: #718EBF; transition: color 0.3s; font-weight: 700; font-family: 'Inter', sans-serif; sans-serif; font-size:16px; line-height:19.36px;">Pengajuan
                            SPK</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="row mt-3">
        <div class="col ml--12">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body ml-4">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="TablePengajuanDana">
                                        <thead>
                                            <tr
                                                style="color: #718EBF; font-family: 'Inter', sans-serif; line-height:19.36px;">
                                                <th class="text-center">No. Doc</th>
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
                                            @foreach ($pengajuan_dana_per_day as $pdt)
                                                <tr
                                                    style="color: #232323; font-family: 'Inter', sans-serif; line-height:19.36px;">
                                                    <td class="text-center" style="font-weight:400;">
                                                        {{ $pdt->no_doc }}
                                                    </td>
                                                    <td class="text-center" style="font-weight:400;">
                                                        {{ $pdt->revisi }}
                                                    </td>
                                                    <td class="text-center" style="font-weight:400;" nowrap>
                                                        {{ $pdt->nama_pemohon }}
                                                    </td>
                                                    <td class="text-center" style="font-weight:400;">
                                                        {{ $pdt->tujuan }}
                                                    </td>
                                                    <td class="text-center" style="font-weight:400;">
                                                        {{ $pdt->lokasi }}
                                                    </td>
                                                    <td class="text-center" style="font-weight:400;" nowrap>
                                                        {{ $pdt->tanggal }}
                                                    </td>
                                                    <td class="text-center" style="font-weight:400;" nowrap>
                                                        {{ $pdt->jangka_waktu }}
                                                    </td>
                                                    <td class="text-center" style="font-weight:400;" nowrap>
                                                        {{ 'Rp. ' . number_format($pdt->dana_yang_dibutuhkan, 0, ',', '.') }}
                                                    </td>
                                                    <td class="text-center" style="font-weight:400;">
                                                        {{ $pdt->no_rekening }}
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
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="display table table-striped table-hover" id="TablePengajuanSPK"
                                        style="width:100%">
                                        <thead>
                                            <tr
                                                style="color: #718EBF; font-family: 'Inter', sans-serif; line-height:19.36px;">
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
                                            @foreach ($pengajuan_spk_per_day as $pst)
                                                <tr
                                                    style="color: #232323; font-family: 'Inter', sans-serif; line-height:19.36px;">
                                                    <td class="text-center" style="font-weight:400;">
                                                        {{ $pst->nama_project }}
                                                    </td>
                                                    <td class="text-center" style="font-weight:400;">
                                                        {{ $pst->user }}
                                                    </td>
                                                    <td class="text-center" style="font-weight:400;" nowrap>
                                                        {{ $pst->main_contractor }}
                                                    </td>
                                                    <td class="text-center" style="font-weight:400;">
                                                        {{ $pst->project_manager }}
                                                    </td>
                                                    <td class="text-center" style="font-weight:400;">
                                                        {{ $pst->pic }}
                                                    </td>
                                                    <td class="text-center" style="font-weight:400;">
                                                        {{ $pst->no_spk }}
                                                    </td>
                                                    <td class="text-center" style="font-weight:400;" nowrap>
                                                        {{ $pst->tanggal }}
                                                    </td>
                                                    <td class="text-center" style="font-weight:400;" nowrap>
                                                        {{ $pst->waktu_penyelesaian }}
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
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        // charts
        var monthly_pengajuan_dana = {!! json_encode($monthly_pengajuan_dana) !!};
        var monthly_pengajuan_spk = {!! json_encode($monthly_pengajuan_spk) !!};

        // total pengajuan dana dan SPK setiap bulan
        var total_pengajuan_dana_per_month = [];
        var total_pengajuan_spk_per_month = [];

        // Loop melalui data bulanan dan isi array total pengajuan dana dan SPK
        for (var i = 0; i < 12; i++) {
            var monthFoundDana = monthly_pengajuan_dana.find(function(item) {
                return parseInt(item.month) === i + 1;
            });

            if (monthFoundDana) {
                total_pengajuan_dana_per_month.push(monthFoundDana.total);
            } else {
                total_pengajuan_dana_per_month.push(0);
            }

            var monthFoundSPK = monthly_pengajuan_spk.find(function(item) {
                return parseInt(item.month) === i + 1;
            });

            if (monthFoundSPK) {
                total_pengajuan_spk_per_month.push(monthFoundSPK.total);
            } else {
                total_pengajuan_spk_per_month.push(0);
            }
        }

        // Inisialisasi opsi grafik
        var options = {
            chart: {
                height: 350,
                type: "line",
                stacked: false,
                toolbar: {
                    show: false
                }
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#FF1654", "#247BA0"],
            series: [{
                    name: "Pengajuan Dana",
                    data: total_pengajuan_dana_per_month
                },
                {
                    name: "Pengajuan SPK",
                    data: total_pengajuan_spk_per_month
                }
            ],
            stroke: {
                width: [4, 4]
            },
            plotOptions: {
                bar: {
                    columnWidth: "20%"
                }
            },
            xaxis: {
                type: 'category',
                categories: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
                labels: {
                    rotate: -45,
                    rotateAlways: true,
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            yaxis: [{
                    axisTicks: {
                        show: true
                    },
                    axisBorder: {
                        show: true,
                        color: "#FF1654"
                    },
                    labels: {
                        style: {
                            colors: "#FF1654"
                        }
                    },
                    title: {
                        text: "Pengajuan Dana",
                        style: {
                            color: "#FF1654"
                        }
                    }
                },
                {
                    opposite: true,
                    axisTicks: {
                        show: true
                    },
                    axisBorder: {
                        show: true,
                        color: "#247BA0"
                    },
                    labels: {
                        style: {
                            colors: "#247BA0"
                        }
                    },
                    title: {
                        text: "Pengajuan SPK",
                        style: {
                            color: "#247BA0"
                        }
                    }
                }
            ],
            tooltip: {
                shared: false,
                intersect: true,
                x: {
                    show: false
                }
            },
            legend: {
                horizontalAlign: "left",
                offsetX: 40
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 300
                    }
                }
            }],
            title: {
                text: 'Total Pengajuan Dana: ' + total_pengajuan_dana_per_month.reduce((a, b) => a + b, 0) +
                    ', Total Pengajuan SPK: ' + total_pengajuan_spk_per_month.reduce((a, b) => a + b, 0),
                align: 'center',
                margin: 10,
                offsetY: 10,
                style: {
                    fontSize: '16px',
                    color: '#718EBF',
                    fontFamily: 'Helvetica'
                }
            }
        };

        // Tentukan bulan-bulan yang ingin ditambahkan setelah Agustus
        var additionalMonths = ["Sep", "Okt", "Nov", "Des"];

        // Ambil bulan terakhir dari kategori saat ini
        var lastMonth = options.xaxis.categories[options.xaxis.categories.length - 1];

        // Jika bulan terakhir adalah Agustus, tambahkan bulan-bulan tambahan
        if (lastMonth === "Agu") {
            // Gunakan spread operator untuk menggabungkan array kategori dengan array bulan tambahan
            options.xaxis.categories.push(...additionalMonths);
        }

        // Inisialisasi grafik dengan opsi yang telah diperbarui
        var chart = new ApexCharts(document.querySelector("#chart"), options);

        // Render grafik
        chart.render();


        // JS Datatable PD dan SPK
        $(document).ready(function() {
            // Inisialisasi DataTable Pengajuan Dana
            $('#TablePengajuanDana').DataTable({
                "pageLength": 5,
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

            // Inisialisasi DataTable Pengajuan SPK
            $('#TablePengajuanSPK').DataTable({
                "pageLength": 5,
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

            // Add Row
            $('#add-row').DataTable({
                "pageLength": 5,
            });

            var action =
                '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

            $('#addRowButton').click(function() {
                $('#add-row').dataTable().fnAddData([
                    $("#addName").val(),
                    $("#addPosition").val(),
                    $("#addOffice").val(),
                    action
                ]);
                $('#addRowModal').modal('hide');
            });
        });


        // get name
        function getShortName(fullName) {
            // Memisahkan nama pertama dan nama terakhir
            var names = fullName.split(' ');
            var firstName = names[0];
            var lastName = names[names.length - 1];

            // Mengambil inisial dari nama terakhir
            var lastNameInitial = lastName.charAt(0);

            // Menggabungkan nama pertama dengan inisial nama terakhir
            var shortName = firstName + ' ' + lastNameInitial;

            // Jika panjang nama pertama lebih dari 6 karakter, maka persingkat nama pertama
            if (firstName.length > 9) {
                shortName = firstName.substring(0, 6);
            }

            return shortName;
        }

        // Mendapatkan nama pengguna dan mempersingkatnya menggunakan JavaScript
        var fullName = "<?php echo auth()->user()->full_name; ?>";
        var shortName = getShortName(fullName);

        // Mengisi elemen span dengan nama yang dipersingkat
        document.getElementById('shortName').innerText = shortName;

        // Mengambil semua tombol menu
        var menuButtons = document.querySelectorAll('.nav-link');

        // Menambahkan event listener pada setiap tombol menu
        menuButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Menghapus kelas 'active' dari semua tombol menu
                menuButtons.forEach(function(btn) {
                    btn.classList.remove('active');
                    btn.style.color = '#718EBF';
                    btn.style.borderBottomColor = 'transparent';
                });

                // Menambahkan kelas 'active' ke tombol menu yang diklik
                this.classList.add('active');
                this.style.color = '#4FD1C5';
                this.style.borderBottomColor = '#4FD1C5';

                // Menyembunyikan semua tab
                var tabs = document.querySelectorAll('.tab-pane');
                tabs.forEach(function(tab) {
                    tab.classList.remove('show');
                    tab.classList.remove('active');
                });

                // Menampilkan tab yang sesuai dengan tombol menu yang diklik
                var targetTabId = this.getAttribute('data-target');
                var targetTab = document.querySelector(targetTabId);
                targetTab.classList.add('show');
                targetTab.classList.add('active');
            });
        });
    </script>
@endsection


{{-- // JS datatable Pengajuan Dana
        $(document).ready(function() {

            $('#TablePengajuanDana').DataTable({
                "pageLength": 5,
                initComplete: function() {
                    this.api().columns().every(function() {
                        var column = this;
                        var select = $(
                                '<select class="form-control"><option value=""></option></select>'
                            )
                            .appendTo($(column.footer()).empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d +
                                '</option>')
                        });
                    });
                }
            });

            // Add Row
            $('#add-row').DataTable({
                "pageLength": 5,
            });

            var action =
                '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

            $('#addRowButton').click(function() {
                $('#add-row').dataTable().fnAddData([
                    $("#addName").val(),
                    $("#addPosition").val(),
                    $("#addOffice").val(),
                    action
                ]);
                $('#addRowModal').modal('hide');

            });
        }); --}}
