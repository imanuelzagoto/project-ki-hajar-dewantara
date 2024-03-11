<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="brand">
                <a data-toggle="collapse" href="{{ route('dashboard') }}" aria-expanded="true" class="brand-name">
                    <img src="{{ asset('partas/img/logo.png') }}" alt="BLogo" class="brand-logo">
                </a>
            </div>
            <hr class="mt-4 hr-rectangle">
            <ul class="nav nav-info">
                <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('dashboard') }}"
                        style="border-radius: 15px; height:50px; font-size:16px;">
                        <div class="d-flex align-items-center">
                            <span class="fas fa-home bg-white text-success mr-2 p-2 border border-white rounded-3"
                                style="border-radius: 12px;"></span>
                            <p class="text-menu">Dashboard</p>
                        </div>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('master_data') ? 'active' : '' }}">
                    <a class="nav-link" href="#" style="border-radius: 15px; height:50px; font-size:16px;">
                        <div class="d-flex align-items-center">
                            <span class="fas fa-database bg-white text-success mr-2 p-2 border border-white rounded-3"
                                style="border-radius: 12px;"></span>
                            <p class="text-menu">Master Projek</p>
                        </div>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('PD.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('PD.index') }}"
                        style="border-radius: 15px; height:50px; font-size:16px;">
                        <div class="d-flex align-items-center">
                            <span
                                class="fas fa-credit-card bg-white text-success mr-2 p-2 border border-white rounded-3"
                                style="border-radius: 12px;"></span>
                            <p class="text-menu">PengajuanDana</p>
                        </div>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('surat_perintah_kerja.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('surat_perintah_kerja.index') }}"
                        style="border-radius: 15px; height:50px; font-size:16px;">
                        <div class="d-flex align-items-center">
                            <span class="fas fa-chart-bar bg-white text-success mr-2 p-2 border border-white rounded-3"
                                style="border-radius: 12px;"></span>
                            <p class="text-menu">Surat Perintah Kerja</p>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
