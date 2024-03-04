<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ asset('partas/img/profile.jpg') }}" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ auth()->user()->full_name }}
                            <span class="user-level">{{ auth()->user()->designation }}</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#edit">
                                    <span class="link-collapse">Edit Profil</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item active">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Menu SPK</h4>
                </li>
                <li class="nav-item">
                    <a href="{{ route('spks.index') }}">
                        <i class="fas fa-clipboard"></i>
                        <p>Surat Perintah Kerja</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="widgets.html">
                        <i class="fas fa-folder-open"></i>
                        <p>Manajemen SPK</p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Manajemen SPK</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="components/flaticons.html">
                                    <span class="sub-item">Flaticons</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/typography.html">
                                    <span class="sub-item">Typography</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Menu Pengajuan Dana</h4>
                </li>
                <li class="nav-item">
                    <a href="widgets.html">
                        <i class="fas fa-clipboard"></i>
                        <p>Surat Perintah Kerja</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="widgets.html">
                        <i class="fas fa-folder-open"></i>
                        <p>Manajemen SPK</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
