@php
    $userData = Session::get('user');
    $userrole = $userData['modules']['name'];
    $userId = $userData['id'];
@endphp

@extends('layouts.master')

@section('content')

    @if ($userrole == 'Super Admin')
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
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="text-dashboard font-weight-bold display-6">
                            Dashboard <span style="font-size: 22px; padding-left:8px; display:none;">&rArr;</span>
                            <span style="color: #a43b19; font-size: 17px; padding-left:8px;">
                        </h2>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <h2 class="fiturjam font-weight-bold display-6">
                            <ul class="list-unstyled mb-0">
                                <li id="datetime" class="datetime_home">
                                    <i class="fas fa-calendar"></i>&nbsp;
                                    <i class="far fa-clock"></i>&nbsp;
                                </li>
                            </ul>
                        </h2>
                    </div>
                </div>
            </nav>
        </div>
        <form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none;">
            @csrf
        </form>

        <div class="container-fluid">
            <div class="row" style="margin-top: 34.5px;">
                <div class="col-md-8">
                    <div class="card card-chart" style="border-radius: 9px; height:473px;">
                        <div class="card-header">
                            <h5 class="card-title font-weight-bold"
                                style="color: #2D3748; font-family:Arial, Helvetica, sans-serif; font-size: 18px; line-height:25.2px;">
                                Perkembangan Grafik
                            </h5>
                        </div>
                        <div id="chart" style="margin-top: 1%;"></div>
                        <div style="display: flex; justify-content: space-between;">
                            <div style="position: relative; bottom:20px;">
                                <div class="total_pengajuan_dana">
                                    <span class="fas fa-circle"
                                        style="font-size: 12px; font-weight: bold; color:#FF1755"></span>
                                    <span style="font-size: 13px; font-weight: bold; color:#484E50">Total</span>
                                    <span style="font-size: 14px; font-weight: bold; color:#484E50">:</span>
                                    @if ($monthly_pengajuan_dana_by_user_id->isEmpty())
                                        <span style="font-size: 14px; font-weight: bold; color:#FF1755">0</span>
                                    @else
                                        @foreach ($monthly_pengajuan_dana_by_user_id as $data)
                                            <span
                                                style="font-size: 14px; font-weight: bold; color:#FF1755">{{ $data->total }}</span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div style="position: relative; bottom:15px; right:535px;">
                                <div class="total_pengajuan_spk">
                                    <span class="fas fa-circle"
                                        style="font-size: 12px; font-weight: bold; color:#247BA0"></span>
                                    <span style="font-size: 13px; font-weight: bold; color:#484E50">Total</span>
                                    <span style="font-size: 14px; font-weight: bold; color:#484E50">
                                        :
                                    </span>
                                    @if ($monthly_pengajuan_spk->isEmpty())
                                        <span style="font-size: 14px; font-weight: bold; color:#247BA0">0</span>
                                    @else
                                        @foreach ($monthly_pengajuan_spk as $data)
                                            <span
                                                style="font-size: 14px; font-weight: bold; color:#247BA0">{{ $data->total }}</span>
                                        @endforeach
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="p-3 custom-card my-custom-card w-100"
                                style="background-image: url('{{ asset('partas/img/card.png') }}');">
                                <p class="dashboard_kihajar">Dashboard ki hajar
                                    dewantara</p>
                                <h2 class="font-weight-bold text-white username mt--3" id="greeting">Hello
                                    {{ Session::get('user')['username'] }}<span id="shortName"></span> !</h2>
                            </div>
                        </div>

                        <div class="col-md-6 mt-4" style="font-family: Arial, Helvetica, sans-serif;">
                            <div class="card card_count_pengajuan_dana">
                                <div class="rounded-3 mt-2 backgorund_card_pd">
                                    <div class="card_icon_walets">
                                        <i class="fas fa-wallet iconwallet"></i>
                                    </div>
                                    <div class="title_card_pd">
                                        <span>Pengajuan Dana</span>
                                    </div>
                                    <div class="permintaan_card_spk">
                                        <span>Permintaan Aktif</span>
                                    </div>
                                    <div class="garis_pengajuan_dana">
                                        <hr class="hr-card">
                                    </div>
                                    <div class="count_permintaan">
                                        <span class="total-permintaan">
                                            {{ $total_pengajuan_dana_by_user_id }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mt-4" style="font-family: Arial, Helvetica, sans-serif;">
                            <div class="card card_count_spk">
                                <div class="rounded-3 mt-2 backgorund_card_spk">
                                    <div>
                                        <i class="fab fa-paypal icon_paypal"></i>
                                    </div>
                                    <div class="title_card_spk">
                                        <span>SPK</span>
                                    </div>
                                    <div class="pengajuan_card_spk">
                                        <span>Pengajuan Aktif</span>
                                    </div>
                                    <div class="garis_spk">
                                        <hr class="hr_spk_card">
                                    </div>
                                    <div class="count_penajuan">
                                        <span class="total-pengajuan">
                                            {{ $total_pengajuan_spk }}
                                        </span>
                                    </div>
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
                            <button class="nav-link card-menu-pd active" id="home-tab" data-toggle="tab"
                                data-target="#home" role="tab" aria-controls="home" aria-selected="true">Pengajuan
                                Dana</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link card-menu-pd" id="profile-tab" data-toggle="tab"
                                data-target="#profile" role="tab" aria-controls="profile"
                                aria-selected="false">Pengajuan
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
                            <div class="card mt-lg-2 card-table-pd">
                                <div class="card-body ml-4">
                                    <div class="table-responsive">
                                        <table class="table display-6 mb-6 table-hover w-100" id="TablePengajuanDana">
                                            <thead>
                                                <tr class="tr-table">
                                                    <th class="text-left" style="font-weight:700;" nowrap>No.Doc</th>
                                                    <th class="text-left" style="font-weight:700;" nowrap>Revisi</th>
                                                    <th class="text-left" style="font-weight:700;" nowrap>Pemohon</th>
                                                    <th class="text-center" style="font-weight:700;" nowrap>Tujuan</th>
                                                    <th class="text-center" style="font-weight:700;" nowrap>Lokasi<br>
                                                        <span style="display:block; text-align:center;">Pengajuan</span>
                                                    </th>
                                                    <th class="text-center" style="width:19px;" nowrap>Tanggal<br>
                                                        <span style="display:block; text-align:center;">Pengajuan</span>
                                                    </th>
                                                    <th class="text-center" style="width:25px;" nowrap>Batas Waktu
                                                    </th>
                                                    <th class="text-center" style="width:23px;" nowrap>Total Dana
                                                    </th>
                                                    <th class="text-center" style="font-weight:700;" nowrap>Metode<br>
                                                        <span style="display:block; text-align:center;">Penerimaan</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pengajuan_dana_per_day_by_user_id as $pdt)
                                                    <tr class="Column_td">
                                                        <td class="text-left" style="font-weight:500;" nowrap>
                                                            {{ $pdt->no_doc }}
                                                        </td>
                                                        <td class="text-left" style="font-weight:500;" nowrap>
                                                            {{ $pdt->revisi }}
                                                        </td>
                                                        <td class="text-left" style="font-weight:500;" nowrap>
                                                            {{ $pdt->nama_pemohon }}
                                                        </td>
                                                        <td class="text-left" style="font-weight:500;" nowrap>
                                                            {{ $pdt->tujuan }}
                                                        </td>
                                                        <td class="text-center" style="font-weight:500;" nowrap>
                                                            {{ $pdt->lokasi }}
                                                        </td>
                                                        <td class="text-center" style="font-weight:500;" nowrap>
                                                            {{ Carbon\Carbon::parse($pdt->updated_at)->format('H:i d-m-Y') }}
                                                        </td>
                                                        <td class="text-center" style="font-weight:500;" nowrap>
                                                            {{ Carbon\Carbon::parse($pdt->batas_waktu)->format('d-m-Y') }}
                                                        </td>
                                                        <td class="text-right" style="font-weight:500;" nowrap>
                                                            {{ 'Rp. ' . number_format(floatval(str_replace(['Rp.', '.', ','], '', $pdt->subtotal)), 0, ',', '.') }}
                                                        </td>
                                                        <td class="text-center" style="font-weight:500;" nowrap>
                                                            @if ($pdt->tunai)
                                                                {{ $pdt->tunai }}
                                                            @elseif ($pdt->non_tunai)
                                                                {{ $pdt->non_tunai }}
                                                            @endif
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
                            <div class="card mt-lg-2 card-table-pd">
                                <div class="card-body ml-4">
                                    <div class="table-responsive">
                                        <table class="table display-6 mb-6 table-hover w-100" id="TablePengajuanSPK">
                                            <thead>
                                                <tr class="column_th">
                                                    <th class="text-left" style="width:25px; font-weight: 700;" nowrap>
                                                        No SPK
                                                    </th>
                                                    <th class="text-center" style="font-weight: 700;" nowrap>
                                                        Nama Project
                                                    </th>
                                                    <th class="text-left" style="font-weight: 700;" nowrap>Pemohon</th>
                                                    <th class="text-left" style="font-weight: 700;" nowrap>User</th>
                                                    <th class="text-center" style="font-weight: 700;" nowrap>
                                                        Main Contractor
                                                    </th>
                                                    <th class="text-center" style="font-weight: 700;" nowrap>
                                                        Project Manager
                                                    </th>
                                                    <th class="text-left" style="width:19px; font-weight:700;" nowrap>PIC
                                                    </th>
                                                    <th class="text-center" style="width:23px; font-weight:700;" nowrap>
                                                        Tanggal</th>
                                                    <th class="text-center" style="font-weight:700;" nowrap>Tanggal
                                                        selesai
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pengajuan_spk_per_day as $pst)
                                                    <tr class="Column_td">
                                                        <td class="text-left" style="font-weight: 500;" nowrap>
                                                            {{ $pst->no_spk }}
                                                        </td>
                                                        <td class="text-left" style="font-weight: 500;" nowrap>
                                                            {{ $pst->title }}
                                                        </td>
                                                        <td class="text-left" style="font-weight: 500;" nowrap>
                                                            {{ $pst->pemohon }}
                                                        </td>
                                                        <td class="text-left" style="font-weight: 500;" nowrap>
                                                            {{ $pst->user }}
                                                        </td>
                                                        <td class="text-left" style="font-weight: 500;" nowrap>
                                                            {{ $pst->main_contractor }}
                                                        </td>
                                                        <td class="text-left" style="font-weight: 500;" nowrap>
                                                            {{ $pst->project_manager }}
                                                        </td>
                                                        <td class="text-center" style="font-weight: 500;" nowrap>
                                                            {{ $pst->pic }}
                                                        </td>
                                                        <td class="text-center" style="font-weight: 500;" nowrap>
                                                            {{ \Carbon\Carbon::createFromFormat('d/m/y', $pst->tanggal)->format('d-m-Y') }}
                                                        </td>
                                                        <td class="text-center" style="font-weight:500;" nowrap>
                                                            {{ \Carbon\Carbon::createFromFormat('d/m/y', $pst->waktu_penyelesaian)->format('d-m-Y') }}
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
    @endif

    @if ($userrole == 'user biasa')
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
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="text-dashboard font-weight-bold display-6">
                            Dashboard <span style="font-size: 22px; padding-left:8px; display:none;">&rArr;</span>
                            <span style="color: #a43b19; font-size: 17px; padding-left:8px;">
                        </h2>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <h2 class="fiturjam font-weight-bold display-6">
                            <ul class="list-unstyled mb-0">
                                <li id="datetime" class="datetime_home">
                                    <i class="fas fa-calendar"></i>&nbsp;
                                    <i class="far fa-clock"></i>&nbsp;
                                </li>
                            </ul>
                        </h2>
                    </div>
                </div>
            </nav>
        </div>
        <form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none;">
            @csrf
        </form>

        <div class="container-fluid">
            <div class="row" style="margin-top: 34.5px;">
                <div class="col-md-8">
                    <div class="card card-chart" style="border-radius: 9px; height:473px;">
                        <div class="card-header">
                            <h5 class="card-title font-weight-bold"
                                style="color: #2D3748; font-family:Arial, Helvetica, sans-serif; font-size: 18px; line-height:25.2px;">
                                Perkembangan Grafik
                            </h5>
                        </div>
                        <div id="chart" style="margin-top: 1%;"></div>
                        <div style="display: flex; justify-content: space-between;">
                            <div style="position: relative; bottom:20px;">
                                <div class="total_pengajuan_dana">
                                    <span class="fas fa-circle"
                                        style="font-size: 12px; font-weight: bold; color:#FF1755"></span>
                                    <span style="font-size: 13px; font-weight: bold; color:#484E50">Total</span>
                                    <span style="font-size: 14px; font-weight: bold; color:#484E50">:</span>
                                    @if ($monthly_pengajuan_dana_by_user_id->isEmpty())
                                        <span style="font-size: 14px; font-weight: bold; color:#FF1755">0</span>
                                    @else
                                        @foreach ($monthly_pengajuan_dana_by_user_id as $data)
                                            <span
                                                style="font-size: 14px; font-weight: bold; color:#FF1755">{{ $data->total }}</span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div style="position: relative; bottom:15px; right:535px;">
                                <div class="total_pengajuan_spk">
                                    <span class="fas fa-circle"
                                        style="font-size: 12px; font-weight: bold; color:#247BA0"></span>
                                    <span style="font-size: 13px; font-weight: bold; color:#484E50">Total</span>
                                    <span style="font-size: 14px; font-weight: bold; color:#484E50">
                                        :
                                    </span>
                                    @if ($monthly_pengajuan_spk->isEmpty())
                                        <span style="font-size: 14px; font-weight: bold; color:#247BA0">0</span>
                                    @else
                                        @foreach ($monthly_pengajuan_spk as $data)
                                            <span
                                                style="font-size: 14px; font-weight: bold; color:#247BA0">{{ $data->total }}</span>
                                        @endforeach
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="p-3 custom-card my-custom-card w-100"
                                style="background-image: url('{{ asset('partas/img/card.png') }}');">
                                <p class="dashboard_kihajar">Dashboard ki hajar
                                    dewantara</p>
                                <h2 class="font-weight-bold text-white username mt--3" id="greeting">Hello
                                    {{ Session::get('user')['username'] }}<span id="shortName"></span> !</h2>
                            </div>
                        </div>

                        <div class="col-md-6 mt-4" style="font-family: Arial, Helvetica, sans-serif;">
                            <div class="card card_count_pengajuan_dana">
                                <div class="rounded-3 mt-2 backgorund_card_pd">
                                    <div class="card_icon_walets">
                                        <i class="fas fa-wallet iconwallet"></i>
                                    </div>
                                    <div class="title_card_pd">
                                        <span>Pengajuan Dana</span>
                                    </div>
                                    <div class="permintaan_card_spk">
                                        <span>Permintaan Aktif</span>
                                    </div>
                                    <div class="garis_pengajuan_dana">
                                        <hr class="hr-card">
                                    </div>
                                    <div class="count_permintaan">
                                        <span class="total-permintaan">
                                            {{ $total_pengajuan_dana_by_user_id }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mt-4" style="font-family: Arial, Helvetica, sans-serif;">
                            <div class="card card_count_spk">
                                <div class="rounded-3 mt-2 backgorund_card_spk">
                                    <div>
                                        <i class="fab fa-paypal icon_paypal"></i>
                                    </div>
                                    <div class="title_card_spk">
                                        <span>SPK</span>
                                    </div>
                                    <div class="pengajuan_card_spk">
                                        <span>Pengajuan Aktif</span>
                                    </div>
                                    <div class="garis_spk">
                                        <hr class="hr_spk_card">
                                    </div>
                                    <div class="count_penajuan">
                                        <span class="total-pengajuan">
                                            {{ $total_pengajuan_spk }}
                                        </span>
                                    </div>
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
                            <button class="nav-link card-menu-pd active" id="home-tab" data-toggle="tab"
                                data-target="#home" role="tab" aria-controls="home" aria-selected="true">Pengajuan
                                Dana</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link card-menu-pd" id="profile-tab" data-toggle="tab"
                                data-target="#profile" role="tab" aria-controls="profile"
                                aria-selected="false">Pengajuan
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
                            <div class="card mt-lg-2 card-table-pd">
                                <div class="card-body ml-4">
                                    <div class="table-responsive">
                                        <table class="table display-6 mb-6 table-hover w-100" id="TablePengajuanDana">
                                            <thead>
                                                <tr class="tr-table">
                                                    <th class="text-left" style="font-weight:700;" nowrap>No.Doc</th>
                                                    <th class="text-left" style="font-weight:700;" nowrap>Revisi</th>
                                                    <th class="text-left" style="font-weight:700;" nowrap>Pemohon</th>
                                                    <th class="text-center" style="font-weight:700;" nowrap>Tujuan</th>
                                                    <th class="text-center" style="font-weight:700;" nowrap>Lokasi<br>
                                                        <span style="display:block; text-align:center;">Pengajuan</span>
                                                    </th>
                                                    <th class="text-center" style="width:19px;" nowrap>Tanggal<br>
                                                        <span style="display:block; text-align:center;">Pengajuan</span>
                                                    </th>
                                                    <th class="text-center" style="width:25px;" nowrap>Batas Waktu
                                                    </th>
                                                    <th class="text-center" style="width:23px;" nowrap>Total Dana
                                                    </th>
                                                    <th class="text-center" style="font-weight:700;" nowrap>Metode<br>
                                                        <span style="display:block; text-align:center;">Penerimaan</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pengajuan_dana_per_day_by_user_id as $pdt)
                                                    <tr class="Column_td">
                                                        <td class="text-left" style="font-weight:500;" nowrap>
                                                            {{ $pdt->no_doc }}
                                                        </td>
                                                        <td class="text-left" style="font-weight:500;" nowrap>
                                                            {{ $pdt->revisi }}
                                                        </td>
                                                        <td class="text-left" style="font-weight:500;" nowrap>
                                                            {{ $pdt->nama_pemohon }}
                                                        </td>
                                                        <td class="text-left" style="font-weight:500;" nowrap>
                                                            {{ $pdt->tujuan }}
                                                        </td>
                                                        <td class="text-center" style="font-weight:500;" nowrap>
                                                            {{ $pdt->lokasi }}
                                                        </td>
                                                        <td class="text-center" style="font-weight:500;" nowrap>
                                                            {{ Carbon\Carbon::parse($pdt->updated_at)->format('H:i d-m-Y') }}
                                                        </td>
                                                        <td class="text-center" style="font-weight:500;" nowrap>
                                                            {{ Carbon\Carbon::parse($pdt->batas_waktu)->format('d-m-Y') }}
                                                        </td>
                                                        <td class="text-right" style="font-weight:500;" nowrap>
                                                            {{ 'Rp. ' . number_format(floatval(str_replace(['Rp.', '.', ','], '', $pdt->subtotal)), 0, ',', '.') }}
                                                        </td>
                                                        <td class="text-center" style="font-weight:500;" nowrap>
                                                            @if ($pdt->tunai)
                                                                {{ $pdt->tunai }}
                                                            @elseif ($pdt->non_tunai)
                                                                {{ $pdt->non_tunai }}
                                                            @endif
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
                            <div class="card mt-lg-2 card-table-pd">
                                <div class="card-body ml-4">
                                    <div class="table-responsive">
                                        <table class="table display-6 mb-6 table-hover w-100" id="TablePengajuanSPK">
                                            <thead>
                                                <tr class="column_th">
                                                    <th class="text-left" style="width:25px; font-weight: 700;" nowrap>
                                                        No SPK
                                                    </th>
                                                    <th class="text-center" style="font-weight: 700;" nowrap>
                                                        Nama Project
                                                    </th>
                                                    <th class="text-left" style="font-weight: 700;" nowrap>Pemohon</th>
                                                    <th class="text-left" style="font-weight: 700;" nowrap>User</th>
                                                    <th class="text-center" style="font-weight: 700;" nowrap>
                                                        Main Contractor
                                                    </th>
                                                    <th class="text-center" style="font-weight: 700;" nowrap>
                                                        Project Manager
                                                    </th>
                                                    <th class="text-left" style="width:19px; font-weight:700;" nowrap>PIC
                                                    </th>
                                                    <th class="text-center" style="width:23px; font-weight:700;" nowrap>
                                                        Tanggal</th>
                                                    <th class="text-center" style="font-weight:700;" nowrap>Tanggal
                                                        selesai
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pengajuan_spk_per_day as $pst)
                                                    <tr class="Column_td">
                                                        <td class="text-left" style="font-weight: 500;" nowrap>
                                                            {{ $pst->no_spk }}
                                                        </td>
                                                        <td class="text-left" style="font-weight: 500;" nowrap>
                                                            {{ $pst->title }}
                                                        </td>
                                                        <td class="text-left" style="font-weight: 500;" nowrap>
                                                            {{ $pst->pemohon }}
                                                        </td>
                                                        <td class="text-left" style="font-weight: 500;" nowrap>
                                                            {{ $pst->user }}
                                                        </td>
                                                        <td class="text-left" style="font-weight: 500;" nowrap>
                                                            {{ $pst->main_contractor }}
                                                        </td>
                                                        <td class="text-left" style="font-weight: 500;" nowrap>
                                                            {{ $pst->project_manager }}
                                                        </td>
                                                        <td class="text-center" style="font-weight: 500;" nowrap>
                                                            {{ $pst->pic }}
                                                        </td>
                                                        <td class="text-center" style="font-weight: 500;" nowrap>
                                                            {{ \Carbon\Carbon::createFromFormat('d/m/y', $pst->tanggal)->format('d-m-Y') }}
                                                        </td>
                                                        <td class="text-center" style="font-weight:500;" nowrap>
                                                            {{ \Carbon\Carbon::createFromFormat('d/m/y', $pst->waktu_penyelesaian)->format('d-m-Y') }}
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
    @endif

    @if ($userrole == 'Driver')
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
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="text-dashboard font-weight-bold display-6">
                            Dashboard <span style="font-size: 22px; padding-left:8px; display:none;">&rArr;</span>
                            <span style="color: #a43b19; font-size: 17px; padding-left:8px;">
                        </h2>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <h2 class="fiturjam font-weight-bold display-6">
                            <ul class="list-unstyled mb-0">
                                <li id="datetime" class="datetime_home">
                                    <i class="fas fa-calendar"></i>&nbsp;
                                    <i class="far fa-clock"></i>&nbsp;
                                </li>
                            </ul>
                        </h2>
                    </div>
                </div>
            </nav>
        </div>
        <form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none;">
            @csrf
        </form>

        <div class="container-fluid">
            <div class="row" style="margin-top: 34.5px;">
                <div class="col-md-8">
                    <div class="card card-chart" style="border-radius: 9px; height:473px;">
                        <div class="card-header">
                            <h5 class="card-title font-weight-bold"
                                style="color: #2D3748; font-family:Arial, Helvetica, sans-serif; font-size: 18px; line-height:25.2px;">
                                Perkembangan Grafik
                            </h5>
                        </div>
                        <div id="chart" style="margin-top: 1%;"></div>
                        <div style="display: flex; justify-content: space-between;">
                            <div style="position: relative; bottom:20px;">
                                <div class="total_pengajuan_dana">
                                    <span class="fas fa-circle"
                                        style="font-size: 12px; font-weight: bold; color:#FF1755"></span>
                                    <span style="font-size: 13px; font-weight: bold; color:#484E50">Total</span>
                                    <span style="font-size: 14px; font-weight: bold; color:#484E50">:</span>
                                    @if ($monthly_pengajuan_dana_by_user_id->isEmpty())
                                        <span style="font-size: 14px; font-weight: bold; color:#FF1755">0</span>
                                    @else
                                        @foreach ($monthly_pengajuan_dana_by_user_id as $data)
                                            <span
                                                style="font-size: 14px; font-weight: bold; color:#FF1755">{{ $data->total }}</span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div style="position: relative; bottom:15px; right:535px;">
                                <div class="total_pengajuan_spk">
                                    <span class="fas fa-circle"
                                        style="font-size: 12px; font-weight: bold; color:#247BA0"></span>
                                    <span style="font-size: 13px; font-weight: bold; color:#484E50">Total</span>
                                    <span style="font-size: 14px; font-weight: bold; color:#484E50">
                                        :
                                    </span>
                                    @if ($monthly_pengajuan_spk->isEmpty())
                                        <span style="font-size: 14px; font-weight: bold; color:#247BA0">0</span>
                                    @else
                                        @foreach ($monthly_pengajuan_spk as $data)
                                            <span
                                                style="font-size: 14px; font-weight: bold; color:#247BA0">{{ $data->total }}</span>
                                        @endforeach
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="p-3 custom-card my-custom-card w-100"
                                style="background-image: url('{{ asset('partas/img/card.png') }}');">
                                <p class="dashboard_kihajar">Dashboard ki hajar
                                    dewantara</p>
                                <h2 class="font-weight-bold text-white username mt--3" id="greeting">Hello
                                    {{ Session::get('user')['username'] }}<span id="shortName"></span> !</h2>
                            </div>
                        </div>

                        <div class="col-md-6 mt-4" style="font-family: Arial, Helvetica, sans-serif;">
                            <div class="card card_count_pengajuan_dana">
                                <div class="rounded-3 mt-2 backgorund_card_pd">
                                    <div class="card_icon_walets">
                                        <i class="fas fa-wallet iconwallet"></i>
                                    </div>
                                    <div class="title_card_pd">
                                        <span>Pengajuan Dana</span>
                                    </div>
                                    <div class="permintaan_card_spk">
                                        <span>Permintaan Aktif</span>
                                    </div>
                                    <div class="garis_pengajuan_dana">
                                        <hr class="hr-card">
                                    </div>
                                    <div class="count_permintaan">
                                        <span class="total-permintaan">
                                            {{ $total_pengajuan_dana_by_user_id }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mt-4" style="font-family: Arial, Helvetica, sans-serif;">
                            <div class="card card_count_spk">
                                <div class="rounded-3 mt-2 backgorund_card_spk">
                                    <div>
                                        <i class="fab fa-paypal icon_paypal"></i>
                                    </div>
                                    <div class="title_card_spk">
                                        <span>SPK</span>
                                    </div>
                                    <div class="pengajuan_card_spk">
                                        <span>Pengajuan Aktif</span>
                                    </div>
                                    <div class="garis_spk">
                                        <hr class="hr_spk_card">
                                    </div>
                                    <div class="count_penajuan">
                                        <span class="total-pengajuan">
                                            {{ $total_pengajuan_spk }}
                                        </span>
                                    </div>
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
                            <button class="nav-link card-menu-pd active" id="home-tab" data-toggle="tab"
                                data-target="#home" role="tab" aria-controls="home" aria-selected="true">Pengajuan
                                Dana</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link card-menu-pd" id="profile-tab" data-toggle="tab"
                                data-target="#profile" role="tab" aria-controls="profile"
                                aria-selected="false">Pengajuan
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
                            <div class="card mt-lg-2 card-table-pd">
                                <div class="card-body ml-4">
                                    <div class="table-responsive">
                                        <table class="table display-6 mb-6 table-hover w-100" id="TablePengajuanDana">
                                            <thead>
                                                <tr class="tr-table">
                                                    <th class="text-left" style="font-weight:700;" nowrap>No.Doc</th>
                                                    <th class="text-left" style="font-weight:700;" nowrap>Revisi</th>
                                                    <th class="text-left" style="font-weight:700;" nowrap>Pemohon</th>
                                                    <th class="text-center" style="font-weight:700;" nowrap>Tujuan</th>
                                                    <th class="text-center" style="font-weight:700;" nowrap>Lokasi<br>
                                                        <span style="display:block; text-align:center;">Pengajuan</span>
                                                    </th>
                                                    <th class="text-center" style="width:19px;" nowrap>Tanggal<br>
                                                        <span style="display:block; text-align:center;">Pengajuan</span>
                                                    </th>
                                                    <th class="text-center" style="width:25px;" nowrap>Batas Waktu
                                                    </th>
                                                    <th class="text-center" style="width:23px;" nowrap>Total Dana
                                                    </th>
                                                    <th class="text-center" style="font-weight:700;" nowrap>Metode<br>
                                                        <span style="display:block; text-align:center;">Penerimaan</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pengajuan_dana_per_day_by_user_id as $pdt)
                                                    <tr class="Column_td">
                                                        <td class="text-left" style="font-weight:500;" nowrap>
                                                            {{ $pdt->no_doc }}
                                                        </td>
                                                        <td class="text-left" style="font-weight:500;" nowrap>
                                                            {{ $pdt->revisi }}
                                                        </td>
                                                        <td class="text-left" style="font-weight:500;" nowrap>
                                                            {{ $pdt->nama_pemohon }}
                                                        </td>
                                                        <td class="text-left" style="font-weight:500;" nowrap>
                                                            {{ $pdt->tujuan }}
                                                        </td>
                                                        <td class="text-center" style="font-weight:500;" nowrap>
                                                            {{ $pdt->lokasi }}
                                                        </td>
                                                        <td class="text-center" style="font-weight:500;" nowrap>
                                                            {{ Carbon\Carbon::parse($pdt->updated_at)->format('H:i d-m-Y') }}
                                                        </td>
                                                        <td class="text-center" style="font-weight:500;" nowrap>
                                                            {{ Carbon\Carbon::parse($pdt->batas_waktu)->format('d-m-Y') }}
                                                        </td>
                                                        <td class="text-right" style="font-weight:500;" nowrap>
                                                            {{ 'Rp. ' . number_format(floatval(str_replace(['Rp.', '.', ','], '', $pdt->subtotal)), 0, ',', '.') }}
                                                        </td>
                                                        <td class="text-center" style="font-weight:500;" nowrap>
                                                            @if ($pdt->tunai)
                                                                {{ $pdt->tunai }}
                                                            @elseif ($pdt->non_tunai)
                                                                {{ $pdt->non_tunai }}
                                                            @endif
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
                            <div class="card mt-lg-2 card-table-pd">
                                <div class="card-body ml-4">
                                    <div class="table-responsive">
                                        <table class="table display-6 mb-6 table-hover w-100" id="TablePengajuanSPK">
                                            <thead>
                                                <tr class="column_th">
                                                    <th class="text-left" style="width:25px; font-weight: 700;" nowrap>
                                                        No SPK
                                                    </th>
                                                    <th class="text-center" style="font-weight: 700;" nowrap>
                                                        Nama Project
                                                    </th>
                                                    <th class="text-left" style="font-weight: 700;" nowrap>Pemohon</th>
                                                    <th class="text-left" style="font-weight: 700;" nowrap>User</th>
                                                    <th class="text-center" style="font-weight: 700;" nowrap>
                                                        Main Contractor
                                                    </th>
                                                    <th class="text-center" style="font-weight: 700;" nowrap>
                                                        Project Manager
                                                    </th>
                                                    <th class="text-left" style="width:19px; font-weight:700;" nowrap>PIC
                                                    </th>
                                                    <th class="text-center" style="width:23px; font-weight:700;" nowrap>
                                                        Tanggal</th>
                                                    <th class="text-center" style="font-weight:700;" nowrap>Tanggal
                                                        selesai
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pengajuan_spk_per_day as $pst)
                                                    <tr class="Column_td">
                                                        <td class="text-left" style="font-weight: 500;" nowrap>
                                                            {{ $pst->no_spk }}
                                                        </td>
                                                        <td class="text-left" style="font-weight: 500;" nowrap>
                                                            {{ $pst->title }}
                                                        </td>
                                                        <td class="text-left" style="font-weight: 500;" nowrap>
                                                            {{ $pst->pemohon }}
                                                        </td>
                                                        <td class="text-left" style="font-weight: 500;" nowrap>
                                                            {{ $pst->user }}
                                                        </td>
                                                        <td class="text-left" style="font-weight: 500;" nowrap>
                                                            {{ $pst->main_contractor }}
                                                        </td>
                                                        <td class="text-left" style="font-weight: 500;" nowrap>
                                                            {{ $pst->project_manager }}
                                                        </td>
                                                        <td class="text-center" style="font-weight: 500;" nowrap>
                                                            {{ $pst->pic }}
                                                        </td>
                                                        <td class="text-center" style="font-weight: 500;" nowrap>
                                                            {{ \Carbon\Carbon::createFromFormat('d/m/y', $pst->tanggal)->format('d-m-Y') }}
                                                        </td>
                                                        <td class="text-center" style="font-weight:500;" nowrap>
                                                            {{ \Carbon\Carbon::createFromFormat('d/m/y', $pst->waktu_penyelesaian)->format('d-m-Y') }}
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
    @endif

    @if ($userrole == 'General Affair')
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
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="text-dashboard font-weight-bold display-6">
                            Dashboard <span style="font-size: 22px; padding-left:8px; display:none;">&rArr;</span>
                            <span style="color: #a43b19; font-size: 17px; padding-left:8px;">
                        </h2>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <h2 class="fiturjam font-weight-bold display-6">
                            <ul class="list-unstyled mb-0">
                                <li id="datetime" class="datetime_home">
                                    <i class="fas fa-calendar"></i>&nbsp;
                                    <i class="far fa-clock"></i>&nbsp;
                                </li>
                            </ul>
                        </h2>
                    </div>
                </div>
            </nav>
        </div>
        <form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none;">
            @csrf
        </form>

        <div class="container-fluid">
            <div class="row" style="margin-top: 34.5px;">
                <div class="col-md-8">
                    <div class="card card-chart" style="border-radius: 9px; height:473px;">
                        <div class="card-header">
                            <h5 class="card-title font-weight-bold"
                                style="color: #2D3748; font-family:Arial, Helvetica, sans-serif; font-size: 18px; line-height:25.2px;">
                                Perkembangan Grafik
                            </h5>
                        </div>
                        <div id="chart" style="margin-top: 1%;"></div>
                        <div style="display: flex; justify-content: space-between;">
                            <div style="position: relative; bottom:20px;">
                                <div class="total_pengajuan_dana">
                                    <span class="fas fa-circle"
                                        style="font-size: 12px; font-weight: bold; color:#FF1755"></span>
                                    <span style="font-size: 13px; font-weight: bold; color:#484E50">Total</span>
                                    <span style="font-size: 14px; font-weight: bold; color:#484E50">:</span>
                                    @if ($monthly_pengajuan_dana_by_user_id->isEmpty())
                                        <span style="font-size: 14px; font-weight: bold; color:#FF1755">0</span>
                                    @else
                                        @foreach ($monthly_pengajuan_dana_by_user_id as $data)
                                            <span
                                                style="font-size: 14px; font-weight: bold; color:#FF1755">{{ $data->total }}</span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div style="position: relative; bottom:15px; right:535px;">
                                <div class="total_pengajuan_spk">
                                    <span class="fas fa-circle"
                                        style="font-size: 12px; font-weight: bold; color:#247BA0"></span>
                                    <span style="font-size: 13px; font-weight: bold; color:#484E50">Total</span>
                                    <span style="font-size: 14px; font-weight: bold; color:#484E50">
                                        :
                                    </span>
                                    @if ($monthly_pengajuan_spk->isEmpty())
                                        <span style="font-size: 14px; font-weight: bold; color:#247BA0">0</span>
                                    @else
                                        @foreach ($monthly_pengajuan_spk as $data)
                                            <span
                                                style="font-size: 14px; font-weight: bold; color:#247BA0">{{ $data->total }}</span>
                                        @endforeach
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="p-3 custom-card my-custom-card w-100"
                                style="background-image: url('{{ asset('partas/img/card.png') }}');">
                                <p class="dashboard_kihajar">Dashboard ki hajar
                                    dewantara</p>
                                <h2 class="font-weight-bold text-white username mt--3" id="greeting">Hello
                                    {{ Session::get('user')['username'] }}<span id="shortName"></span> !</h2>
                            </div>
                        </div>

                        <div class="col-md-6 mt-4" style="font-family: Arial, Helvetica, sans-serif;">
                            <div class="card card_count_pengajuan_dana">
                                <div class="rounded-3 mt-2 backgorund_card_pd">
                                    <div class="card_icon_walets">
                                        <i class="fas fa-wallet iconwallet"></i>
                                    </div>
                                    <div class="title_card_pd">
                                        <span>Pengajuan Dana</span>
                                    </div>
                                    <div class="permintaan_card_spk">
                                        <span>Permintaan Aktif</span>
                                    </div>
                                    <div class="garis_pengajuan_dana">
                                        <hr class="hr-card">
                                    </div>
                                    <div class="count_permintaan">
                                        <span class="total-permintaan">
                                            {{ $total_pengajuan_dana_by_user_id }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mt-4" style="font-family: Arial, Helvetica, sans-serif;">
                            <div class="card card_count_spk">
                                <div class="rounded-3 mt-2 backgorund_card_spk">
                                    <div>
                                        <i class="fab fa-paypal icon_paypal"></i>
                                    </div>
                                    <div class="title_card_spk">
                                        <span>SPK</span>
                                    </div>
                                    <div class="pengajuan_card_spk">
                                        <span>Pengajuan Aktif</span>
                                    </div>
                                    <div class="garis_spk">
                                        <hr class="hr_spk_card">
                                    </div>
                                    <div class="count_penajuan">
                                        <span class="total-pengajuan">
                                            {{ $total_pengajuan_spk }}
                                        </span>
                                    </div>
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
                            <button class="nav-link card-menu-pd active" id="home-tab" data-toggle="tab"
                                data-target="#home" role="tab" aria-controls="home" aria-selected="true">Pengajuan
                                Dana</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link card-menu-pd" id="profile-tab" data-toggle="tab"
                                data-target="#profile" role="tab" aria-controls="profile"
                                aria-selected="false">Pengajuan
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
                            <div class="card mt-lg-2 card-table-pd">
                                <div class="card-body ml-4">
                                    <div class="table-responsive">
                                        <table class="table display-6 mb-6 table-hover w-100" id="TablePengajuanDana">
                                            <thead>
                                                <tr class="tr-table">
                                                    <th class="text-left" style="font-weight:700;" nowrap>No.Doc</th>
                                                    <th class="text-left" style="font-weight:700;" nowrap>Revisi</th>
                                                    <th class="text-left" style="font-weight:700;" nowrap>Pemohon</th>
                                                    <th class="text-center" style="font-weight:700;" nowrap>Tujuan</th>
                                                    <th class="text-center" style="font-weight:700;" nowrap>Lokasi<br>
                                                        <span style="display:block; text-align:center;">Pengajuan</span>
                                                    </th>
                                                    <th class="text-center" style="width:19px;" nowrap>Tanggal<br>
                                                        <span style="display:block; text-align:center;">Pengajuan</span>
                                                    </th>
                                                    <th class="text-center" style="width:25px;" nowrap>Batas Waktu
                                                    </th>
                                                    <th class="text-center" style="width:23px;" nowrap>Total Dana
                                                    </th>
                                                    <th class="text-center" style="font-weight:700;" nowrap>Metode<br>
                                                        <span style="display:block; text-align:center;">Penerimaan</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pengajuan_dana_per_day_by_user_id as $pdt)
                                                    <tr class="Column_td">
                                                        <td class="text-left" style="font-weight:500;" nowrap>
                                                            {{ $pdt->no_doc }}
                                                        </td>
                                                        <td class="text-left" style="font-weight:500;" nowrap>
                                                            {{ $pdt->revisi }}
                                                        </td>
                                                        <td class="text-left" style="font-weight:500;" nowrap>
                                                            {{ $pdt->nama_pemohon }}
                                                        </td>
                                                        <td class="text-left" style="font-weight:500;" nowrap>
                                                            {{ $pdt->tujuan }}
                                                        </td>
                                                        <td class="text-center" style="font-weight:500;" nowrap>
                                                            {{ $pdt->lokasi }}
                                                        </td>
                                                        <td class="text-center" style="font-weight:500;" nowrap>
                                                            {{ Carbon\Carbon::parse($pdt->updated_at)->format('H:i d-m-Y') }}
                                                        </td>
                                                        <td class="text-center" style="font-weight:500;" nowrap>
                                                            {{ Carbon\Carbon::parse($pdt->batas_waktu)->format('d-m-Y') }}
                                                        </td>
                                                        <td class="text-right" style="font-weight:500;" nowrap>
                                                            {{ 'Rp. ' . number_format(floatval(str_replace(['Rp.', '.', ','], '', $pdt->subtotal)), 0, ',', '.') }}
                                                        </td>
                                                        <td class="text-center" style="font-weight:500;" nowrap>
                                                            @if ($pdt->tunai)
                                                                {{ $pdt->tunai }}
                                                            @elseif ($pdt->non_tunai)
                                                                {{ $pdt->non_tunai }}
                                                            @endif
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
                            <div class="card mt-lg-2 card-table-pd">
                                <div class="card-body ml-4">
                                    <div class="table-responsive">
                                        <table class="table display-6 mb-6 table-hover w-100" id="TablePengajuanSPK">
                                            <thead>
                                                <tr class="column_th">
                                                    <th class="text-left" style="width:25px; font-weight: 700;" nowrap>
                                                        No SPK
                                                    </th>
                                                    <th class="text-center" style="font-weight: 700;" nowrap>
                                                        Nama Project
                                                    </th>
                                                    <th class="text-left" style="font-weight: 700;" nowrap>Pemohon</th>
                                                    <th class="text-left" style="font-weight: 700;" nowrap>User</th>
                                                    <th class="text-center" style="font-weight: 700;" nowrap>
                                                        Main Contractor
                                                    </th>
                                                    <th class="text-center" style="font-weight: 700;" nowrap>
                                                        Project Manager
                                                    </th>
                                                    <th class="text-left" style="width:19px; font-weight:700;" nowrap>PIC
                                                    </th>
                                                    <th class="text-center" style="width:23px; font-weight:700;" nowrap>
                                                        Tanggal</th>
                                                    <th class="text-center" style="font-weight:700;" nowrap>Tanggal
                                                        selesai
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pengajuan_spk_per_day as $pst)
                                                    <tr class="Column_td">
                                                        <td class="text-left" style="font-weight: 500;" nowrap>
                                                            {{ $pst->no_spk }}
                                                        </td>
                                                        <td class="text-left" style="font-weight: 500;" nowrap>
                                                            {{ $pst->title }}
                                                        </td>
                                                        <td class="text-left" style="font-weight: 500;" nowrap>
                                                            {{ $pst->pemohon }}
                                                        </td>
                                                        <td class="text-left" style="font-weight: 500;" nowrap>
                                                            {{ $pst->user }}
                                                        </td>
                                                        <td class="text-left" style="font-weight: 500;" nowrap>
                                                            {{ $pst->main_contractor }}
                                                        </td>
                                                        <td class="text-left" style="font-weight: 500;" nowrap>
                                                            {{ $pst->project_manager }}
                                                        </td>
                                                        <td class="text-center" style="font-weight: 500;" nowrap>
                                                            {{ $pst->pic }}
                                                        </td>
                                                        <td class="text-center" style="font-weight: 500;" nowrap>
                                                            {{ \Carbon\Carbon::createFromFormat('d/m/y', $pst->tanggal)->format('d-m-Y') }}
                                                        </td>
                                                        <td class="text-center" style="font-weight:500;" nowrap>
                                                            {{ \Carbon\Carbon::createFromFormat('d/m/y', $pst->waktu_penyelesaian)->format('d-m-Y') }}
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
    @endif

    @if ($userrole == 'Hr')
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
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="text-dashboard font-weight-bold display-6">
                            Dashboard <span style="font-size: 22px; padding-left:8px; display:none;">&rArr;</span>
                            <span style="color: #a43b19; font-size: 17px; padding-left:8px;">
                        </h2>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <h2 class="fiturjam font-weight-bold display-6">
                            <ul class="list-unstyled mb-0">
                                <li id="datetime" class="datetime_home">
                                    <i class="fas fa-calendar"></i>&nbsp;
                                    <i class="far fa-clock"></i>&nbsp;
                                </li>
                            </ul>
                        </h2>
                    </div>
                </div>
            </nav>
        </div>
        <form action="{{ route('logout') }}" method="post" id="logout-form" style="display: none;">
            @csrf
        </form>

        <div class="container-fluid">
            <div class="row" style="margin-top: 34.5px;">
                <div class="col-md-8">
                    <div class="card card-chart" style="border-radius: 9px; height:473px;">
                        <div class="card-header">
                            <h5 class="card-title font-weight-bold"
                                style="color: #2D3748; font-family:Arial, Helvetica, sans-serif; font-size: 18px; line-height:25.2px;">
                                Perkembangan Grafik
                            </h5>
                        </div>
                        <div id="chart" style="margin-top: 1%;"></div>
                        <div style="display: flex; justify-content: space-between;">
                            <div style="position: relative; bottom:20px;">
                                <div class="total_pengajuan_dana">
                                    <span class="fas fa-circle"
                                        style="font-size: 12px; font-weight: bold; color:#FF1755"></span>
                                    <span style="font-size: 13px; font-weight: bold; color:#484E50">Total</span>
                                    <span style="font-size: 14px; font-weight: bold; color:#484E50">:</span>
                                    @if ($monthly_pengajuan_dana_by_user_id->isEmpty())
                                        <span style="font-size: 14px; font-weight: bold; color:#FF1755">0</span>
                                    @else
                                        @foreach ($monthly_pengajuan_dana_by_user_id as $data)
                                            <span
                                                style="font-size: 14px; font-weight: bold; color:#FF1755">{{ $data->total }}</span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div style="position: relative; bottom:15px; right:535px;">
                                <div class="total_pengajuan_spk">
                                    <span class="fas fa-circle"
                                        style="font-size: 12px; font-weight: bold; color:#247BA0"></span>
                                    <span style="font-size: 13px; font-weight: bold; color:#484E50">Total</span>
                                    <span style="font-size: 14px; font-weight: bold; color:#484E50">
                                        :
                                    </span>
                                    @if ($monthly_pengajuan_spk->isEmpty())
                                        <span style="font-size: 14px; font-weight: bold; color:#247BA0">0</span>
                                    @else
                                        @foreach ($monthly_pengajuan_spk as $data)
                                            <span
                                                style="font-size: 14px; font-weight: bold; color:#247BA0">{{ $data->total }}</span>
                                        @endforeach
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="p-3 custom-card my-custom-card w-100"
                                style="background-image: url('{{ asset('partas/img/card.png') }}');">
                                <p class="dashboard_kihajar">Dashboard ki hajar
                                    dewantara</p>
                                <h2 class="font-weight-bold text-white username mt--3" id="greeting">Hello
                                    {{ Session::get('user')['username'] }}<span id="shortName"></span> !</h2>
                            </div>
                        </div>

                        <div class="col-md-6 mt-4" style="font-family: Arial, Helvetica, sans-serif;">
                            <div class="card card_count_pengajuan_dana">
                                <div class="rounded-3 mt-2 backgorund_card_pd">
                                    <div class="card_icon_walets">
                                        <i class="fas fa-wallet iconwallet"></i>
                                    </div>
                                    <div class="title_card_pd">
                                        <span>Pengajuan Dana</span>
                                    </div>
                                    <div class="permintaan_card_spk">
                                        <span>Permintaan Aktif</span>
                                    </div>
                                    <div class="garis_pengajuan_dana">
                                        <hr class="hr-card">
                                    </div>
                                    <div class="count_permintaan">
                                        <span class="total-permintaan">
                                            {{ $total_pengajuan_dana_by_user_id }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mt-4" style="font-family: Arial, Helvetica, sans-serif;">
                            <div class="card card_count_spk">
                                <div class="rounded-3 mt-2 backgorund_card_spk">
                                    <div>
                                        <i class="fab fa-paypal icon_paypal"></i>
                                    </div>
                                    <div class="title_card_spk">
                                        <span>SPK</span>
                                    </div>
                                    <div class="pengajuan_card_spk">
                                        <span>Pengajuan Aktif</span>
                                    </div>
                                    <div class="garis_spk">
                                        <hr class="hr_spk_card">
                                    </div>
                                    <div class="count_penajuan">
                                        <span class="total-pengajuan">
                                            {{ $total_pengajuan_spk }}
                                        </span>
                                    </div>
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
                            <button class="nav-link card-menu-pd active" id="home-tab" data-toggle="tab"
                                data-target="#home" role="tab" aria-controls="home"
                                aria-selected="true">Pengajuan
                                Dana</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link card-menu-pd" id="profile-tab" data-toggle="tab"
                                data-target="#profile" role="tab" aria-controls="profile"
                                aria-selected="false">Pengajuan
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
                    <div class="tab-pane fade show active" id="home" role="tabpanel"
                        aria-labelledby="home-tab">
                        <div class="col-md-12">
                            <div class="card mt-lg-2 card-table-pd">
                                <div class="card-body ml-4">
                                    <div class="table-responsive">
                                        <table class="table display-6 mb-6 table-hover w-100" id="TablePengajuanDana">
                                            <thead>
                                                <tr class="tr-table">
                                                    <th class="text-left" style="font-weight:700;" nowrap>No.Doc</th>
                                                    <th class="text-left" style="font-weight:700;" nowrap>Revisi</th>
                                                    <th class="text-left" style="font-weight:700;" nowrap>Pemohon</th>
                                                    <th class="text-center" style="font-weight:700;" nowrap>Tujuan</th>
                                                    <th class="text-center" style="font-weight:700;" nowrap>Lokasi<br>
                                                        <span style="display:block; text-align:center;">Pengajuan</span>
                                                    </th>
                                                    <th class="text-center" style="width:19px;" nowrap>Tanggal<br>
                                                        <span style="display:block; text-align:center;">Pengajuan</span>
                                                    </th>
                                                    <th class="text-center" style="width:25px;" nowrap>Batas Waktu
                                                    </th>
                                                    <th class="text-center" style="width:23px;" nowrap>Total Dana
                                                    </th>
                                                    <th class="text-center" style="font-weight:700;" nowrap>Metode<br>
                                                        <span style="display:block; text-align:center;">Penerimaan</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pengajuan_dana_per_day_by_user_id as $pdt)
                                                    <tr class="Column_td">
                                                        <td class="text-left" style="font-weight:500;" nowrap>
                                                            {{ $pdt->no_doc }}
                                                        </td>
                                                        <td class="text-left" style="font-weight:500;" nowrap>
                                                            {{ $pdt->revisi }}
                                                        </td>
                                                        <td class="text-left" style="font-weight:500;" nowrap>
                                                            {{ $pdt->nama_pemohon }}
                                                        </td>
                                                        <td class="text-left" style="font-weight:500;" nowrap>
                                                            {{ $pdt->tujuan }}
                                                        </td>
                                                        <td class="text-center" style="font-weight:500;" nowrap>
                                                            {{ $pdt->lokasi }}
                                                        </td>
                                                        <td class="text-center" style="font-weight:500;" nowrap>
                                                            {{ Carbon\Carbon::parse($pdt->updated_at)->format('H:i d-m-Y') }}
                                                        </td>
                                                        <td class="text-center" style="font-weight:500;" nowrap>
                                                            {{ Carbon\Carbon::parse($pdt->batas_waktu)->format('d-m-Y') }}
                                                        </td>
                                                        <td class="text-right" style="font-weight:500;" nowrap>
                                                            {{ 'Rp. ' . number_format(floatval(str_replace(['Rp.', '.', ','], '', $pdt->subtotal)), 0, ',', '.') }}
                                                        </td>
                                                        <td class="text-center" style="font-weight:500;" nowrap>
                                                            @if ($pdt->tunai)
                                                                {{ $pdt->tunai }}
                                                            @elseif ($pdt->non_tunai)
                                                                {{ $pdt->non_tunai }}
                                                            @endif
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
                            <div class="card mt-lg-2 card-table-pd">
                                <div class="card-body ml-4">
                                    <div class="table-responsive">
                                        <table class="table display-6 mb-6 table-hover w-100" id="TablePengajuanSPK">
                                            <thead>
                                                <tr class="column_th">
                                                    <th class="text-left" style="width:25px; font-weight: 700;" nowrap>
                                                        No SPK
                                                    </th>
                                                    <th class="text-center" style="font-weight: 700;" nowrap>
                                                        Nama Project
                                                    </th>
                                                    <th class="text-left" style="font-weight: 700;" nowrap>Pemohon</th>
                                                    <th class="text-left" style="font-weight: 700;" nowrap>User</th>
                                                    <th class="text-center" style="font-weight: 700;" nowrap>
                                                        Main Contractor
                                                    </th>
                                                    <th class="text-center" style="font-weight: 700;" nowrap>
                                                        Project Manager
                                                    </th>
                                                    <th class="text-left" style="width:19px; font-weight:700;" nowrap>
                                                        PIC
                                                    </th>
                                                    <th class="text-center" style="width:23px; font-weight:700;" nowrap>
                                                        Tanggal</th>
                                                    <th class="text-center" style="font-weight:700;" nowrap>Tanggal
                                                        selesai
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pengajuan_spk_per_day as $pst)
                                                    <tr class="Column_td">
                                                        <td class="text-left" style="font-weight: 500;" nowrap>
                                                            {{ $pst->no_spk }}
                                                        </td>
                                                        <td class="text-left" style="font-weight: 500;" nowrap>
                                                            {{ $pst->title }}
                                                        </td>
                                                        <td class="text-left" style="font-weight: 500;" nowrap>
                                                            {{ $pst->pemohon }}
                                                        </td>
                                                        <td class="text-left" style="font-weight: 500;" nowrap>
                                                            {{ $pst->user }}
                                                        </td>
                                                        <td class="text-left" style="font-weight: 500;" nowrap>
                                                            {{ $pst->main_contractor }}
                                                        </td>
                                                        <td class="text-left" style="font-weight: 500;" nowrap>
                                                            {{ $pst->project_manager }}
                                                        </td>
                                                        <td class="text-center" style="font-weight: 500;" nowrap>
                                                            {{ $pst->pic }}
                                                        </td>
                                                        <td class="text-center" style="font-weight: 500;" nowrap>
                                                            {{ \Carbon\Carbon::createFromFormat('d/m/y', $pst->tanggal)->format('d-m-Y') }}
                                                        </td>
                                                        <td class="text-center" style="font-weight:500;" nowrap>
                                                            {{ \Carbon\Carbon::createFromFormat('d/m/y', $pst->waktu_penyelesaian)->format('d-m-Y') }}
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
    @endif

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
        var monthly_pengajuan_dana = {!! json_encode($monthly_pengajuan_dana_by_user_id) !!};
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
        };

        var additionalMonths = ["Sep", "Okt", "Nov", "Des"];
        var lastMonth = options.xaxis.categories[options.xaxis.categories.length - 1];
        if (lastMonth === "Agu") {
            options.xaxis.categories.push(...additionalMonths);
        }
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
@endsection

@push('scripts')
    <script>
        // Pastikan kode ini berada setelah elemen-elemen HTML yang diperlukan dimuat
        document.addEventListener('DOMContentLoaded', function() {
            // Panggil updateClock secara berkala setiap detik
            setInterval(updateClock, 1000);
            // Panggil updateClock untuk memastikan waktu ditampilkan saat halaman dimuat
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
                // Perbarui innerHTML elemen 'datetime' jika ditemukan
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

        // End Datetime



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
                "info": false, // Menonaktifkan pesan info
                "paging": false,
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
                "info": false, // Menonaktifkan pesan info
                "paging": false,
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
