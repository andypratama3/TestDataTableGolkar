<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('dashboard.index') ? '' : 'collapsed' }}"
                href="{{ route('dashboard.index') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('dashboard.datamaster.*') ? '' : 'collapsed' }}"
                data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Data Master</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content {{ Request::routeIs('dashboard.datamaster.*') ? '' : 'collapse' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('dashboard.datamaster.desa.index') }}"
                        class="nav-link {{ Request::routeIs('dashboard.datamaster.desa.*') ? '' : 'collapsed' }} ">
                        <i class="bi bi-circle"></i><span>Desa</span>
                    </a>
                    <a href="{{ route('dashboard.datamaster.kecamatan.index') }}"
                        class="nav-link {{ Request::routeIs('dashboard.datamaster.kecamatan.*') ? '' : 'collapsed' }} ">
                        <i class="bi bi-circle"></i><span>Kecamatan</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- End Components Nav -->
        <li class="nav-item">
            <a href="{{ route('dashboard.dpt.index') }}"
                class="nav-link {{ Request::routeIs('dashboard.dpt.*') ? '' : 'collapsed' }} ">
                <i class="bi bi-file-earmark-text"></i><span>Dpt</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('dashboard.data.index') }}"
                class="nav-link {{ Request::routeIs('dashboard.data.*') ? '' : 'collapsed' }} ">
                <i class="bi bi-file-earmark-text"></i><span>Data</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('dashboard.realcount.*') ? '' : 'collapsed' }}"
                data-bs-target="#real-count" data-bs-toggle="collapse" href="#">
                <i class="bi bi-bar-chart-fill"></i><span>Real Count</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="real-count" class="nav-content {{ Request::routeIs('dashboard.realcount.*') ? '' : 'collapse' }}" data-bs-parent="#sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('dashboard.realcount.*') ? '' : 'collapsed' }}"
                        href="{{ route('dashboard.realcount.index') }}">
                        <i class="bar bar-chart-line"></i>
                        <span>Chart RealCount</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('dashboard.realcount.create') ? '' : 'collapsed' }}"
                        href="{{ route('dashboard.realcount.create') }}">
                        <i class="bi bi-person"></i>
                        <span>Tambah Data</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('dashboard.realcount.tabel') ? '' : 'collapsed' }}"
                        href="{{ route('dashboard.realcount.tabel') }}">
                        <i class="bi bi-person"></i>
                        <span>RealCount Tabel</span>
                    </a>
                </li>

            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('dashboard.input.*') ? '' : 'collapsed' }}"
                data-bs-target="#input-data" data-bs-toggle="collapse" href="#">
                <i class="bx bxl-unsplash"></i><span>Input Data</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="input-data" class="nav-content {{ Request::routeIs('dashboard.input.*') ? '' : 'collapse' }}" data-bs-parent="#sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('dashboard.input.peserta.create') ? '' : 'collapsed' }}"
                        href="{{ route('dashboard.input.peserta.create') }}">
                        <i class="bi bi-person"></i>
                        <span>Tambah Data Peserta</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('dashboard.input.kordinator.kecamatan.*') ? '' : 'collapsed' }}"
                        href="{{ route('dashboard.input.kordinator.kecamatan.index') }}">
                        <i class="bi bi-person"></i>
                        <span>Kordinator Kecamatan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('dashboard.input.kordinator.desa.*') ? '' : 'collapsed' }}"
                        href="{{ route('dashboard.input.kordinator.desa.index') }}">
                        <i class="bi bi-person"></i>
                        <span>Kordinator Desa</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('dashboard.input.peserta.index') ? '' : 'collapsed' }}"
                        href="{{ route('dashboard.input.peserta.index') }}">
                        <i class="bi bi-person"></i>
                        <span>Relawan TPS</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('dashboard.input.simpatisan.*') ? '' : 'collapsed' }}"
                        href="{{ route('dashboard.input.simpatisan.index') }}">
                        <i class="bi bi-person"></i>
                        <span>Simpatisan MHF</span>
                    </a>
                </li>
            </ul>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('dashboard.user.*') ? '' : 'collapsed' }}"
                href="{{ route('dashboard.user.index') }}">
                <i class="bi bi-person"></i>
                <span>User</span>
            </a>
        </li> --}}
</aside>
