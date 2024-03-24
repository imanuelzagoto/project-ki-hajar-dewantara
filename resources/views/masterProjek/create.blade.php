@extends('layouts.master')

@section('content')
    <div class="main-dashboard mt--3">
        <nav aria-label="breadcrumb">
            <div class="breadcrumb mt-2 d-flex justify-content-between">
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
                            <a href="{{ route('master-projek.index') }}" class="breadcrumbs__link"
                                style="color: #A0AEC0;font-size: 14px; font-weight: 500;">
                                Pages
                            </a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a href="{{ route('master-projek.index') }}" class="breadcrumbs__link"
                                style="color: #A0AEC0;font-size: 14px; font-weight: 500;">
                                Master Projek
                            </a>
                        </li>
                        <li class="breadcrumbs__item">
                            <a href="{{ route('master-projek.create') }}" class="breadcrumbs__link"
                                style="color: #17a2b8;font-size: 14px; font-weight: 500;">
                                Form Pengisian Master Projek
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="btn btn-sm mt--2 rounded tooltip-container" type="button"
                    style="float: left; margin-right:3px; background-color:#F1F4FA;">
                    <a class="button-logout" onclick="$('#logout-form').submit()" style="color: #D41B14;">
                        Logout
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                    <span class="tooltip-text">Logout</span>
                </button>
            </div>
        </nav>
        <div class="row">
            <div class="col-md-6">
                <h2 class="text-mp font-weight-bold display-6">
                    Form Pengisian Master Projek
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
        <div class="" style="margin-top: 36px;">
            <div class="">
                <div class="card">
                    <div class="card-body">
                        <div class="row pr-3 pt-3">
                            <div class="col-12 col-lg-12 col-md-12 col-sm-12 d-flex ">
                                <div class="font-weight-bold text-lg padding-project pt-form-create">
                                    <span class="">Project</span>
                                </div>
                                <div class="d-block w-100">
                                    <div class="row py-2">
                                        <div class="pr-4 py-2 col-6">
                                            <span class="text-sm font-weight-bold">Nama Project</span>
                                            <input class="form-control bg-light w-100" type="text">
                                        </div>
                                        <div class="pr-4 py-2 col-6">
                                            <span class="text-sm font-weight-bold">Kode Project</span>
                                            <input class="form-control bg-light w-100" type="text">
                                        </div>
                                        <div class="pr-4 py-2 col-4">
                                            <span class="text-sm font-weight-bold">Tenggat</span>
                                            <input class="form-control bg-light w-100" type="text">
                                        </div>
                                        <div class="pr-4 py-2 col-4">
                                            <span class="text-sm font-weight-bold">Mulai</span>
                                            <input class="form-control bg-light w-100" type="text">
                                        </div>
                                        <div class="pr-4 py-2 col-4">
                                            <span class="text-sm font-weight-bold">Akhir / Selesai</span>
                                            <input class="form-control bg-light w-100" type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="d-flex justify-content-center p-4 rounded-pill">
                                <button class="btn btn-save" style="border-radius: 25px; font-size: 14px;">
                                    SAVE
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
