<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="brand">
                <a data-toggle="collapse" href="{{ route('home.index') }}" aria-expanded="true" class="brand-name">
                    <img class="side_logo" src="{{ asset('partas/img/side_logo.svg') }}" alt="BLogo"
                        class="brand-logo">
                </a>
            </div>
            <hr class="mt-4 hr-rectangle">
            @if ($isSuperAdmin)
                <ul class="nav nav-info">
                    <li class="nav-item {{ request()->routeIs('home.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('home.index') }}"
                            style="border-radius: 12px; height:50px; font-size:16px;">
                            <div class="d-flex align-items-center">
                                <span class="fas fa-home bg-white text-success mr-2 p-2 border border-light rounded-3"
                                    style="border-radius: 12px; background-color:#F8F9FA;"></span>
                                <p
                                    style="font-weight:700; font-size:14px; line-height:18px; font-family: Arial, Helvetica, sans-serif; color:#A0AEC0">
                                    Dashboard
                                </p>
                            </div>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ request()->routeIs('master-projek.index') ||
                        request()->routeIs('master-projek.create') ||
                        request()->routeIs('master-projek.show') ||
                        request()->routeIs('master-projek.edit')
                            ? 'active'
                            : '' }}">
                        <a class="nav-link" href="{{ route('master-projek.index') }}"
                            style="border-radius: 12px; height:50px; font-size:16px;">
                            <div class="d-flex align-items-center">
                                <span
                                    class="fas fa-database bg-white text-success mr-2 p-2 border border-light rounded-3"
                                    style="border-radius: 12px; background-color:#F8F9FA;"></span>
                                <p
                                    style="font-weight:700; font-size:14px; line-height:18px; font-family: Arial, Helvetica, sans-serif; color:#A0AEC0; position: relative; left:5px;">
                                    Master Projek
                                </p>
                            </div>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ request()->routeIs('pengajuanDana.index') ||
                        request()->routeIs('pengajuanDana.create') ||
                        request()->routeIs('pengajuanDana.show') ||
                        request()->routeIs('pengajuanDana.edit')
                            ? 'active'
                            : '' }}">
                        <a class="nav-link" href="{{ route('pengajuanDana.index') }}"
                            style="border-radius: 12px; height:50px; font-size:16px;">
                            <div class="d-flex align-items-center">
                                <span class="fas fa-credit-card text-success mr-2 p-2 border border-light rounded-3"
                                    style="border-radius: 12px; background-color:#F8F9FA;"></span>
                                <p
                                    style="font-weight:700; font-size:14px; line-height:18px; font-family: Arial, Helvetica, sans-serif; color:#A0AEC0; position: relative; left:2px;">
                                    Pengajuan Dana
                                </p>
                            </div>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ request()->routeIs('surat_perintah_kerja.index') ||
                        request()->routeIs('suratPerintahKerja.create') ||
                        request()->routeIs('suratPerintahKerja.ShowSuratPerintahKerja') ||
                        request()->routeIs('suratPerintahKerja.edit')
                            ? 'active'
                            : '' }}">
                        <a class="nav-link" href="{{ route('surat_perintah_kerja.index') }}"
                            style="border-radius: 12px; height:50px; font-size:16px;">
                            <div class="d-flex align-items-center">
                                <span class="fas fa-chart-bar text-success mr-2 p-2 border border-light rounded-3"
                                    style="border-radius: 12px; background-color:#F8F9FA;"></span>
                                <p
                                    style="font-weight:700; font-size:14px; line-height:18px; font-family: Arial, Helvetica, sans-serif; color:#A0AEC0; position: relative; left:4px;">
                                    Surat Perintah Kerja
                                </p>
                            </div>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a data-toggle="collapse" href="#forms">
                            <i class="fas fa-pen-square"></i>
                            <p>Forms</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="forms">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="forms/forms.html">
                                        <span class="sub-item">Basic Form</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li> --}}
                </ul>
            @elseif($isUser)
                <ul class="nav nav-info">
                    <li class="nav-item {{ request()->routeIs('home.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('home.index') }}"
                            style="border-radius: 12px; height:50px; font-size:16px;">
                            <div class="d-flex align-items-center">
                                <span class="fas fa-home bg-white text-success mr-2 p-2 border border-light rounded-3"
                                    style="border-radius: 12px; background-color:#F8F9FA;"></span>
                                <p
                                    style="font-weight:700; font-size:14px; line-height:18px; font-family: Arial, Helvetica, sans-serif; color:#A0AEC0">
                                    Dashboard
                                </p>
                            </div>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ request()->routeIs('master-projek.index') ||
                        request()->routeIs('master-projek.create') ||
                        request()->routeIs('master-projek.show') ||
                        request()->routeIs('master-projek.edit')
                            ? 'active'
                            : '' }}">
                        <a class="nav-link" href="{{ route('master-projek.index') }}"
                            style="border-radius: 12px; height:50px; font-size:16px;">
                            <div class="d-flex align-items-center">
                                <span
                                    class="fas fa-database bg-white text-success mr-2 p-2 border border-light rounded-3"
                                    style="border-radius: 12px; background-color:#F8F9FA;"></span>
                                <p
                                    style="font-weight:700; font-size:14px; line-height:18px; font-family: Arial, Helvetica, sans-serif; color:#A0AEC0; position: relative; left:5px;">
                                    Master Projek
                                </p>
                            </div>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ request()->routeIs('pengajuanDana.index') ||
                        request()->routeIs('pengajuanDana.create') ||
                        request()->routeIs('pengajuanDana.show') ||
                        request()->routeIs('pengajuanDana.edit')
                            ? 'active'
                            : '' }}">
                        <a class="nav-link" href="{{ route('pengajuanDana.index') }}"
                            style="border-radius: 12px; height:50px; font-size:16px;">
                            <div class="d-flex align-items-center">
                                <span class="fas fa-credit-card text-success mr-2 p-2 border border-light rounded-3"
                                    style="border-radius: 12px; background-color:#F8F9FA;"></span>
                                <p
                                    style="font-weight:700; font-size:14px; line-height:18px; font-family: Arial, Helvetica, sans-serif; color:#A0AEC0; position: relative; left:2px;">
                                    Pengajuan Dana
                                </p>
                            </div>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ request()->routeIs('surat_perintah_kerja.index') ||
                        request()->routeIs('suratPerintahKerja.create') ||
                        request()->routeIs('suratPerintahKerja.ShowSuratPerintahKerja') ||
                        request()->routeIs('suratPerintahKerja.edit')
                            ? 'active'
                            : '' }}">
                        <a class="nav-link" href="{{ route('surat_perintah_kerja.index') }}"
                            style="border-radius: 12px; height:50px; font-size:16px;">
                            <div class="d-flex align-items-center">
                                <span class="fas fa-chart-bar text-success mr-2 p-2 border border-light rounded-3"
                                    style="border-radius: 12px; background-color:#F8F9FA;"></span>
                                <p
                                    style="font-weight:700; font-size:14px; line-height:18px; font-family: Arial, Helvetica, sans-serif; color:#A0AEC0; position: relative; left:4px;">
                                    Surat Perintah Kerja
                                </p>
                            </div>
                        </a>
                    </li>
                </ul>
            @elseif ($isDriver)
                <ul class="nav nav-info">
                    <li class="nav-item {{ request()->routeIs('home.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('home.index') }}"
                            style="border-radius: 12px; height:50px; font-size:16px;">
                            <div class="d-flex align-items-center">
                                <span class="fas fa-home bg-white text-success mr-2 p-2 border border-light rounded-3"
                                    style="border-radius: 12px; background-color:#F8F9FA;"></span>
                                <p
                                    style="font-weight:700; font-size:14px; line-height:18px; font-family: Arial, Helvetica, sans-serif; color:#A0AEC0">
                                    Dashboard
                                </p>
                            </div>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ request()->routeIs('master-projek.index') ||
                        request()->routeIs('master-projek.create') ||
                        request()->routeIs('master-projek.show') ||
                        request()->routeIs('master-projek.edit')
                            ? 'active'
                            : '' }}">
                        <a class="nav-link" href="{{ route('master-projek.index') }}"
                            style="border-radius: 12px; height:50px; font-size:16px;">
                            <div class="d-flex align-items-center">
                                <span
                                    class="fas fa-database bg-white text-success mr-2 p-2 border border-light rounded-3"
                                    style="border-radius: 12px; background-color:#F8F9FA;"></span>
                                <p
                                    style="font-weight:700; font-size:14px; line-height:18px; font-family: Arial, Helvetica, sans-serif; color:#A0AEC0; position: relative; left:5px;">
                                    Master Projek
                                </p>
                            </div>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ request()->routeIs('pengajuanDana.index') ||
                        request()->routeIs('pengajuanDana.create') ||
                        request()->routeIs('pengajuanDana.show') ||
                        request()->routeIs('pengajuanDana.edit')
                            ? 'active'
                            : '' }}">
                        <a class="nav-link" href="{{ route('pengajuanDana.index') }}"
                            style="border-radius: 12px; height:50px; font-size:16px;">
                            <div class="d-flex align-items-center">
                                <span class="fas fa-credit-card text-success mr-2 p-2 border border-light rounded-3"
                                    style="border-radius: 12px; background-color:#F8F9FA;"></span>
                                <p
                                    style="font-weight:700; font-size:14px; line-height:18px; font-family: Arial, Helvetica, sans-serif; color:#A0AEC0; position: relative; left:2px;">
                                    Pengajuan Dana
                                </p>
                            </div>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ request()->routeIs('surat_perintah_kerja.index') ||
                        request()->routeIs('suratPerintahKerja.create') ||
                        request()->routeIs('suratPerintahKerja.ShowSuratPerintahKerja') ||
                        request()->routeIs('suratPerintahKerja.edit')
                            ? 'active'
                            : '' }}">
                        <a class="nav-link" href="{{ route('surat_perintah_kerja.index') }}"
                            style="border-radius: 12px; height:50px; font-size:16px;">
                            <div class="d-flex align-items-center">
                                <span class="fas fa-chart-bar text-success mr-2 p-2 border border-light rounded-3"
                                    style="border-radius: 12px; background-color:#F8F9FA;"></span>
                                <p
                                    style="font-weight:700; font-size:14px; line-height:18px; font-family: Arial, Helvetica, sans-serif; color:#A0AEC0; position: relative; left:4px;">
                                    Surat Perintah Kerja
                                </p>
                            </div>
                        </a>
                    </li>
                </ul>
            @elseif ($isGA)
                <ul class="nav nav-info">
                    <li class="nav-item {{ request()->routeIs('home.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('home.index') }}"
                            style="border-radius: 12px; height:50px; font-size:16px;">
                            <div class="d-flex align-items-center">
                                <span class="fas fa-home bg-white text-success mr-2 p-2 border border-light rounded-3"
                                    style="border-radius: 12px; background-color:#F8F9FA;"></span>
                                <p
                                    style="font-weight:700; font-size:14px; line-height:18px; font-family: Arial, Helvetica, sans-serif; color:#A0AEC0">
                                    Dashboard
                                </p>
                            </div>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ request()->routeIs('master-projek.index') ||
                        request()->routeIs('master-projek.create') ||
                        request()->routeIs('master-projek.show') ||
                        request()->routeIs('master-projek.edit')
                            ? 'active'
                            : '' }}">
                        <a class="nav-link" href="{{ route('master-projek.index') }}"
                            style="border-radius: 12px; height:50px; font-size:16px;">
                            <div class="d-flex align-items-center">
                                <span
                                    class="fas fa-database bg-white text-success mr-2 p-2 border border-light rounded-3"
                                    style="border-radius: 12px; background-color:#F8F9FA;"></span>
                                <p
                                    style="font-weight:700; font-size:14px; line-height:18px; font-family: Arial, Helvetica, sans-serif; color:#A0AEC0; position: relative; left:5px;">
                                    Master Projek
                                </p>
                            </div>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ request()->routeIs('pengajuanDana.index') ||
                        request()->routeIs('pengajuanDana.create') ||
                        request()->routeIs('pengajuanDana.show') ||
                        request()->routeIs('pengajuanDana.edit')
                            ? 'active'
                            : '' }}">
                        <a class="nav-link" href="{{ route('pengajuanDana.index') }}"
                            style="border-radius: 12px; height:50px; font-size:16px;">
                            <div class="d-flex align-items-center">
                                <span class="fas fa-credit-card text-success mr-2 p-2 border border-light rounded-3"
                                    style="border-radius: 12px; background-color:#F8F9FA;"></span>
                                <p
                                    style="font-weight:700; font-size:14px; line-height:18px; font-family: Arial, Helvetica, sans-serif; color:#A0AEC0; position: relative; left:2px;">
                                    Pengajuan Dana
                                </p>
                            </div>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ request()->routeIs('surat_perintah_kerja.index') ||
                        request()->routeIs('suratPerintahKerja.create') ||
                        request()->routeIs('suratPerintahKerja.ShowSuratPerintahKerja') ||
                        request()->routeIs('suratPerintahKerja.edit')
                            ? 'active'
                            : '' }}">
                        <a class="nav-link" href="{{ route('surat_perintah_kerja.index') }}"
                            style="border-radius: 12px; height:50px; font-size:16px;">
                            <div class="d-flex align-items-center">
                                <span class="fas fa-chart-bar text-success mr-2 p-2 border border-light rounded-3"
                                    style="border-radius: 12px; background-color:#F8F9FA;"></span>
                                <p
                                    style="font-weight:700; font-size:14px; line-height:18px; font-family: Arial, Helvetica, sans-serif; color:#A0AEC0; position: relative; left:4px;">
                                    Surat Perintah Kerja
                                </p>
                            </div>
                        </a>
                    </li>
                </ul>
            @elseif ($isHR)
                <ul class="nav nav-info">
                    <li class="nav-item {{ request()->routeIs('home.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('home.index') }}"
                            style="border-radius: 12px; height:50px; font-size:16px;">
                            <div class="d-flex align-items-center">
                                <span class="fas fa-home bg-white text-success mr-2 p-2 border border-light rounded-3"
                                    style="border-radius: 12px; background-color:#F8F9FA;"></span>
                                <p
                                    style="font-weight:700; font-size:14px; line-height:18px; font-family: Arial, Helvetica, sans-serif; color:#A0AEC0">
                                    Dashboard
                                </p>
                            </div>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ request()->routeIs('master-projek.index') ||
                        request()->routeIs('master-projek.create') ||
                        request()->routeIs('master-projek.show') ||
                        request()->routeIs('master-projek.edit')
                            ? 'active'
                            : '' }}">
                        <a class="nav-link" href="{{ route('master-projek.index') }}"
                            style="border-radius: 12px; height:50px; font-size:16px;">
                            <div class="d-flex align-items-center">
                                <span
                                    class="fas fa-database bg-white text-success mr-2 p-2 border border-light rounded-3"
                                    style="border-radius: 12px; background-color:#F8F9FA;"></span>
                                <p
                                    style="font-weight:700; font-size:14px; line-height:18px; font-family: Arial, Helvetica, sans-serif; color:#A0AEC0; position: relative; left:5px;">
                                    Master Projek
                                </p>
                            </div>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ request()->routeIs('pengajuanDana.index') ||
                        request()->routeIs('pengajuanDana.create') ||
                        request()->routeIs('pengajuanDana.show') ||
                        request()->routeIs('pengajuanDana.edit')
                            ? 'active'
                            : '' }}">
                        <a class="nav-link" href="{{ route('pengajuanDana.index') }}"
                            style="border-radius: 12px; height:50px; font-size:16px;">
                            <div class="d-flex align-items-center">
                                <span class="fas fa-credit-card text-success mr-2 p-2 border border-light rounded-3"
                                    style="border-radius: 12px; background-color:#F8F9FA;"></span>
                                <p
                                    style="font-weight:700; font-size:14px; line-height:18px; font-family: Arial, Helvetica, sans-serif; color:#A0AEC0; position: relative; left:2px;">
                                    Pengajuan Dana
                                </p>
                            </div>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ request()->routeIs('surat_perintah_kerja.index') ||
                        request()->routeIs('suratPerintahKerja.create') ||
                        request()->routeIs('suratPerintahKerja.ShowSuratPerintahKerja') ||
                        request()->routeIs('suratPerintahKerja.edit')
                            ? 'active'
                            : '' }}">
                        <a class="nav-link" href="{{ route('surat_perintah_kerja.index') }}"
                            style="border-radius: 12px; height:50px; font-size:16px;">
                            <div class="d-flex align-items-center">
                                <span class="fas fa-chart-bar text-success mr-2 p-2 border border-light rounded-3"
                                    style="border-radius: 12px; background-color:#F8F9FA;"></span>
                                <p
                                    style="font-weight:700; font-size:14px; line-height:18px; font-family: Arial, Helvetica, sans-serif; color:#A0AEC0; position: relative; left:4px;">
                                    Surat Perintah Kerja
                                </p>
                            </div>
                        </a>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</div>
