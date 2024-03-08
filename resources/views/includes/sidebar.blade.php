<div class="sidebar sidebar-style-2" style="height: auto;">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="brand">
                <a data-toggle="collapse" href="{{ route('dashboard') }}" aria-expanded="true" class="brand-name">
                    <img src="{{ asset('partas/img/logo.png') }}" alt="BLogo" class="brand-logo"
                        style="width: 230px; border: 2px solid #fff; border-radius: 5px; margin-left: 9.8px; margin-top: 28px;">
                </a>
            </div>
            <hr class="mt-4"
                style="width: 233.25px; top: 94.5px; left: 24.5px; border: 0 #E0E1E2; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(192, 188, 188, 0.75), rgba(0, 0, 0, 0));">
            <ul class="nav nav-info">
                <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('dashboard') }}"
                        style="border-radius: 15px; height:54px; font-size:16px;">
                        <div class="d-flex align-items-center">
                            <span class="fas fa-home bg-white text-success mr-2 p-2 border border-white rounded-3"
                                style="border-radius: 12px;"></span>
                            <p class="text-menu" style="font-weight:700; font-size:14px; line-height:18px;">Dashboard
                            </p>
                        </div>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('PD.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('PD.index') }}"
                        style="border-radius: 15px; height:54px; font-size:16px;">
                        <div class="d-flex align-items-center">
                            <span
                                class="fas fa-credit-card bg-white text-success mr-2 p-2 border border-white rounded-3"
                                style="border-radius: 12px;"></span>
                            <p class="text-menu" style="font-weight:700; font-size:14px; line-height:18px;">Pengajuan
                                Dana</p>
                        </div>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('surat_perintah_kerja.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('surat_perintah_kerja.index') }}"
                        style="border-radius: 15px; height:54px; font-size:16px;">
                        <div class="d-flex align-items-center">
                            <span class="fas fa-chart-bar bg-white text-success mr-2 p-2 border border-white rounded-3"
                                style="border-radius: 12px;"></span>
                            <p class="text-menu" style="font-weight:700; font-size:14px; line-height:18px;">Surat
                                Perintah Kerja</p>
                        </div>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('master_data') ? 'active' : '' }}">
                    <a class="nav-link" href="#" style="border-radius: 15px; height:54px; font-size:16px;">
                        <div class="d-flex align-items-center">
                            <span class="fas fa-database bg-white text-success mr-2 p-2 border border-white rounded-3"
                                style="border-radius: 12px;"></span>
                            <p class="text-menu" style="font-weight:700; font-size:14px; line-height:18px;">Master Data
                            </p>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
