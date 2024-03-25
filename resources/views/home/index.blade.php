@extends('layouts.master')

@section('content')
    <div class="main-dashboard mt--3">
        <nav aria-label="breadcrumb">
            <div class="breadcrumb mt-1 d-flex justify-content-between">
                <div class="d-lg-none">
                    <button class=" navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                        data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon">
                            <i class="icon-menu"></i>
                        </span>
                    </button>
                </div>
                <div class="d-none d-lg-block d-sm-none breadcrumb-item">
                    <ul class="breadcrumbs">
                        <li class="breadcrumbs__item">
                            <a href="{{ route('home.index') }}" class="breadcrumbs__link"
                                style="color: #A0AEC0;font-size: 15px; font-weight: 500;">
                                Pages
                            </a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a href="{{ route('home.index') }}" class="breadcrumbs__link"
                                style="color: #17a2b8;font-size: 15px; font-weight: 500;">
                                Dashboard
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="btn btn-sm mt--2 rounded tooltip-container" type="button"
                    style="float: left; background-color:#F1F4FA;">
                    <a class="button-logout" onclick="$('#logout-form').submit()" style="color: #D41B14;">
                        Logout
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                    <span class="tooltip-text mb-2" style="font-size: 10px;">Logout</span>
                </button>
            </div>
        </nav>
        <div class="row">
            <div class="col-md-6">
                <h2 class="text-dashboard font-weight-bold display-6">
                    Dashboard
                </h2>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <h2 class="fiturjam font-weight-bold display-6">
                    <ul class="list-unstyled mb-0">
                        <li id="datetime" style="color: #718EBF; font-weight: bold; font-size: 13px">
                            <i class="fas fa-calendar"></i>&nbsp;
                            <i class="far fa-clock"></i>&nbsp;
                        </li>
                    </ul>
                </h2>
            </div>
        </div>
    </div>
    <form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none;">
        @csrf
    </form>

    <div class="container-fluid">
        <div class="row" style="margin-top: 34.5px;">
            <div class="col-md-8">
                <div class="card card-chart" style="border-radius: 9px;">
                    <div class="card-header">
                        <h5 class="card-title font-weight-bold"
                            style="color: #2D3748; font-family:Arial, Helvetica, sans-serif; font-size: 18px; line-height:25.2px;">
                            Perkembangan Grafik</h5>
                    </div>
                    <div id="chart" style="margin-top: 1%;"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card p-3 custom-card h-100 my-custom-card"
                            style="background-image: url('{{ asset('partas/img/card.png') }}');">
                            <p style="font-size: 16.44px; font-weight:400; line-height:24.66px;">Dashboard ki hajar
                                dewantara</p>
                            <h2 class="font-weight-bold text-white username mt--3" id="greeting">Hello <span
                                    id="shortName"></span> !</h2>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="text-center center-card">
                            <div class="card p-3 font-weight-bold text-center card-pd">
                                <div
                                    class="rounded-3 text-white d-flex align-items-center justify-content-center mt-2 round-card">
                                    <i class="fas fa-wallet fa-2x mr-2 mt--1 iconwallet"></i>
                                </div>
                                <h4 class="mt-3 text-pd">
                                    Pengajuan Dana
                                </h4>
                                <h6 class="text-active">
                                    Pengajuan Aktif
                                </h6>
                                <hr class="hr-card">
                                <h4 class="total-pengajuan">{{ $total_pengajuan_dana }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="text-center" style="font-family: Arial, Helvetica, sans-serif;">
                            <div class="card p-3 font-weight-bold text-center card-pd">
                                <div
                                    class="rounded-3 text-white d-flex align-items-center justify-content-center mt-2 round-card">
                                    <i class="fab fa-paypal fa-2x mt--1 iconwallet"></i>
                                </div>
                                <h4 class="mt-3 text-pd">
                                    SPK
                                </h4>
                                <h6 class="text-active">
                                    Permintaan Aktif
                                </h6>
                                <hr class="hr-card">
                                <h4 class="total-pengajuan">{{ $total_pengajuan_spk }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="font-weight-bold text-pt">
                Permintaan Hari Ini
            </div>
        </div>
    </div>
    <!-- Menu Button -->
    <div class="row">
        <div class="col card-menu">
            <div class="menu mt-3">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link card-menu-pd active" id="home-tab" data-toggle="tab" data-target="#home"
                            role="tab" aria-controls="home" aria-selected="true">Pengajuan Dana</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link card-menu-pd" id="profile-tab" data-toggle="tab" data-target="#profile"
                            role="tab" aria-controls="profile" aria-selected="false">Pengajuan
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
                    <div class="col-md-6 mb-3 mb-md-0 d-flex align-items-center" style="margin-top: 10px;">
                        <form id="dataTableSearchFormPengajuanDana" action="#" method="get"
                            style="height: 44px; width: 255px;" class="mr-2">
                            <div class="col mr-1 border-container">
                                <i class="fas fa-search"></i>
                                <input type="text" id="searchPengajuanDana" name="search"
                                    class="form-control form-control-sm pl-0 rounded-right" placeholder="Type here...."
                                    aria-controls="dataTable">
                            </div>
                        </form>
                        <button type="button" id="filtersButtonPengajuanDana"
                            class="btn btn-sm btn-outline-info ml-2 btn-filters" style="font-size: 17.18px;">
                            <i class="fas fa-sliders-h"></i> Filters
                        </button>
                    </div>
                    <div class="col-md-12">
                        <div class="card mt-lg-3 card-table-pd">
                            <div class="card-body ml-4">
                                <div class="table-responsive">
                                    <div class="d-flex align-items-center mb-3 d-flex-center">
                                        <select id="showEntriesPengajuanDana" class="form-control form-control-sm mr-2"
                                            style="width: 70px; border-color:#4FD1C5;">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                        <span class="labelentris" style="color: #A0AEC0;">entries per
                                            page</span>
                                    </div>
                                    <table class="table display-6 mb-6 table-responsive" id="TablePengajuanDana">
                                        <thead>
                                            <tr class="tr-table">
                                                <th class="text-left"nowrap>No.Doc</th>
                                                <th class="text-left"nowrap>Revisi</th>
                                                <th class="text-left"nowrap>Pemohon</th>
                                                <th class="text-center"nowrap>Tujuan</th>
                                                <th class="text-center" nowrap>Lokasi<br>
                                                    <span style="display:block; text-align:center;">Pengajuan</span>
                                                </th>
                                                <th class="text-center" style="width:19%;" nowrap>Tanggal<br>
                                                    <span style="display:block; text-align:center;">Pengajuan</span>
                                                </th>
                                                <th class="text-center" style="width:25%;" nowrap>Batas Waktu
                                                </th>
                                                <th class="text-center" style="width:23%;" nowrap>Total Dana
                                                </th>
                                                <th class="text-center" nowrap>Metode<br>
                                                    <span style="display:block; text-align:center;">Penerimaan</span>
                                                </th>
                                                <th class="text-center" nowrap>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pengajuan_dana_per_day as $pdt)
                                                <tr class="kolom-td">
                                                    <td class="text-left" style="font-weight:400;" nowrap>
                                                        {{ $pdt->no_doc }}
                                                    </td>
                                                    <td class="text-left" style="font-weight:400;" nowrap>
                                                        {{ $pdt->revisi }}
                                                    </td>
                                                    <td class="text-left" style="font-weight:400;" nowrap>
                                                        {{ $pdt->nama_pemohon }}
                                                    </td>
                                                    <td class="text-left" style="font-weight:400;" nowrap>
                                                        {{ $pdt->tujuan }}
                                                    </td>
                                                    <td class="text-center" style="font-weight:400;" nowrap>
                                                        {{ $pdt->lokasi }}
                                                    </td>
                                                    <td class="text-center" style="font-weight:400;" nowrap>
                                                        {{ Carbon\Carbon::parse($pdt->updated_at)->format('H:i d-m-Y') }}
                                                    </td>
                                                    <td class="text-center" style="font-weight:400;" nowrap>
                                                        {{ Carbon\Carbon::parse($pdt->jangka_waktu)->format('d-m-Y') }}
                                                    </td>
                                                    <td class="text-right" style="font-weight:400;" nowrap>
                                                        {{ 'Rp. ' . number_format($pdt->dana_yang_dibutuhkan, 0, ',', '.') }}
                                                    </td>
                                                    <td class="text-center" style="font-weight:400;" nowrap>
                                                        {{ $pdt->no_rekening }}
                                                    </td>
                                                    <td class="text-center" style="font-weight:400;" nowrap>
                                                        <a href="{{ route('pengajuan-dana.edit', ['id' => $pdt->id]) }}"
                                                            class="fas fa-pen btn btn-sm tooltip-container"
                                                            style="color:#4FD1C5; font-size:20px;">
                                                            <span class="tooltip-edit">Edit</span>
                                                        </a>
                                                        <a href="{{ route('pengajuan-dana.show', ['id' => $pdt->id]) }}"
                                                            class="fas fa-eye btn btn-sm tooltip-container"
                                                            style="color:#1814F3; font-size:20px; border: none; margin-left:2px;">
                                                            <span class="tooltip-show">View</span>
                                                        </a>

                                                        <a href=""
                                                            class="fas fa-trash-alt btn btn-sm tooltip-container"
                                                            style="color:#F31414; font-size:20px;"
                                                            onclick="submitDelete({{ $pdt->id }})">
                                                            <span class="tooltip-delete">Delete</span>
                                                        </a>
                                                        <form id="delete-form-{{ $pdt->id }}"
                                                            action="{{ route('pengajuan-dana.delete', $pdt->id) }}"
                                                            method="get" style="display: none;">
                                                        </form>
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
                    <div class="col-md-6 mb-3 mb-md-0 d-flex align-items-center" style="margin-top: 10px;">
                        <form id="dataTableSearchFormPengajuanSPK" action="#" method="get"
                            style="height: 44px; width: 255px;" class="mr-2">
                            <div class="col mr-1 border-container">
                                <i class="fas fa-search"></i>
                                <input type="text" id="searchPengajuanSPK" name="search"
                                    class="form-control form-control-sm pl-0 rounded-right" placeholder="Type here...."
                                    aria-controls="dataTable">
                            </div>
                        </form>
                        <button type="button" id="filtersButtonPengajuanSPK"
                            class="btn btn-sm btn-outline-info ml-2 btn-filters" style="font-size: 17.18px;">
                            <i class="fas fa-sliders-h"></i> Filters
                        </button>
                    </div>
                    <div class="col-md-12">
                        <div class="card mt-lg-3 card-table-spk">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="d-flex align-items-center mb-3 d-flex-center">
                                        <select id="showEntriesPengajuanSPK" class="form-control form-control-sm mr-2"
                                            style="width: 70px; border-color:#4FD1C5;">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                        <span class="labelentris" style="color: #A0AEC0;">entries per
                                            page</span>
                                    </div>
                                    <table class="table display-6 mb-6 table-responsive" id="TablePengajuanSPK"
                                        style="width:100%">
                                        <thead>
                                            <tr class="tr-table">
                                                <th class="text-left" nowrap>Nama Project</th>
                                                <th class="text-left" nowrap>User</th>
                                                <th class="text-left" nowrap>Main Contractor</th>
                                                <th class="text-left" nowrap>Project Manager</th>
                                                <th class="text-left" nowrap style="width:19%;">PIC</th>
                                                <th class="text-center" nowrap style="width:25%;">No SPK</th>
                                                <th class="text-center" nowrap style="width:23%;">Tanggal</th>
                                                <th class="text-center" nowrap>Tanggal selesai</th>
                                                <th class="text-center" nowrap>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pengajuan_spk_per_day as $pst)
                                                <tr class="kolom-td">
                                                    <td class="text-left" style="font-weight:400;"nowrap>
                                                        {{ $pst->nama_project }}
                                                    </td>
                                                    <td class="text-left" style="font-weight:400;" nowrap>
                                                        {{ $pst->user }}
                                                    </td>
                                                    <td class="text-left" style="font-weight:400;" nowrap>
                                                        {{ $pst->main_contractor }}
                                                    </td>
                                                    <td class="text-left" style="font-weight:400;" nowrap>
                                                        {{ $pst->project_manager }}
                                                    </td>
                                                    <td class="text-left" style="font-weight:400;" nowrap>
                                                        {{ $pst->pic }}
                                                    </td>
                                                    <td class="text-center" style="font-weight:400;" nowrap>
                                                        {{ $pst->no_spk }}
                                                    </td>
                                                    <td class="text-center" style="font-weight:400;" nowrap>
                                                        {{ \Carbon\Carbon::createFromFormat('d/m/y', $pst->tanggal)->format('d-m-Y') }}
                                                    </td>
                                                    <td class="text-center" style="font-weight:400;" nowrap>
                                                        {{ \Carbon\Carbon::createFromFormat('d/m/y', $pst->waktu_penyelesaian)->format('d-m-Y') }}
                                                    </td>
                                                    <td class="text-center" style="font-weight:400;" nowrap>
                                                        <a href="{{ route('surat-perintah-kerja.edit', ['id' => $pst->id]) }}"
                                                            class="fas fa-pen btn btn-sm tooltip-container"
                                                            style="color:#4FD1C5; font-size:20px;">
                                                            <span class="tooltip-edit">Edit</span>
                                                        </a>
                                                        <a href="{{ route('surat-perintah-kerja.show', ['id' => $pst->id]) }}"
                                                            class="fas fa-eye btn btn-sm tooltip-container"
                                                            style="color:#1814F3; font-size:20px; border: none; margin-left:2px;">
                                                            <span class="tooltip-show">View</span>
                                                        </a>
                                                        <a href=""
                                                            class="fas fa-trash-alt btn btn-sm tooltip-container"
                                                            style="color:#F31414; font-size:20px;"
                                                            onclick="submitDelete({{ $pst->id }})">
                                                            <span class="tooltip-delete">Delete</span>
                                                        </a>
                                                        <form id="delete-form-{{ $pst->id }}"
                                                            action="{{ route('surat-perintah-kerja.delete', $pst->id) }}"
                                                            method="get" style="display: none;">
                                                        </form>
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
        // JS MENU PENGAJUAN DANA & SPK
        document.addEventListener("DOMContentLoaded", function() {
            // Mendapatkan URL saat ini
            var currentUrl = window.location.href;

            // Mendapatkan elemen menu
            var menuItems = document.querySelectorAll('.nav-link');

            // Loop melalui setiap elemen menu
            menuItems.forEach(function(item) {
                // Mendapatkan URL yang ditargetkan oleh setiap elemen menu
                var targetUrl = item.getAttribute('data-target');

                // kondisi URL saat ini cocok dengan URL yang ditargetkan
                if (currentUrl.includes(targetUrl)) {
                    item.classList.add('active');
                }
            });
        });
        // END JS MENU



        // JS charts
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
        // End JS Chart


        // JS get name
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

@push('scripts')
    <script>
        // JS DATATABLE
        $(document).ready(function() {
            // Function to get page length from localStorage
            function getPageLengthFromLocalStorage(tableId) {
                var storedLength = localStorage.getItem(tableId + '_pageLength');
                if (storedLength) {
                    return parseInt(storedLength);
                } else {
                    return 10; // Default page length
                }
            }

            // Inisialisasi DataTable Pengajuan Dana
            var tablePengajuanDana = $('#TablePengajuanDana').DataTable({
                "pageLength": getPageLengthFromLocalStorage('TablePengajuanDana'),
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
            $('#showEntriesPengajuanDana').val(getPageLengthFromLocalStorage('TablePengajuanDana'));

            // Inisialisasi DataTable Pengajuan SPK
            var tablePengajuanSPK = $('#TablePengajuanSPK').DataTable({
                "pageLength": getPageLengthFromLocalStorage('TablePengajuanSPK'),
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
            $('#showEntriesPengajuanSPK').val(getPageLengthFromLocalStorage('TablePengajuanSPK'));

            // fitur show entri
            $('#showEntriesPengajuanDana').change(function() {
                var val = $(this).val();
                tablePengajuanDana.page.len(val).draw();
                localStorage.setItem('TablePengajuanDana_pageLength', val);
            });

            $('#showEntriesPengajuanSPK').change(function() {
                var val = $(this).val();
                tablePengajuanSPK.page.len(val).draw();
                localStorage.setItem('TablePengajuanSPK_pageLength', val);
            });

            // fitur search
            $('#filtersButtonPengajuanDana').click(function() {
                var searchText = $('#searchPengajuanDana').val();
                tablePengajuanDana.search(searchText).draw();
            });

            $('#filtersButtonPengajuanSPK').click(function() {
                var searchText = $('#searchPengajuanSPK').val();
                tablePengajuanSPK.search(searchText).draw();
            });

            // Memantau perubahan pada input pencarian
            $('#searchPengajuanDana').on('input', function() {
                var searchText = $(this).val();
                if (!searchText.trim()) { // Jika input pencarian kosong
                    tablePengajuanDana.search('').draw(); // Atur ulang pencarian dan gambar ulang tabel
                }
            });

            $('#searchPengajuanSPK').on('input', function() {
                var searchText = $(this).val();
                if (!searchText.trim()) { // Jika input pencarian kosong
                    tablePengajuanSPK.search('').draw(); // Atur ulang pencarian dan gambar ulang tabel
                }
            });
        });
        // End JS Table
    </script>
@endpush
