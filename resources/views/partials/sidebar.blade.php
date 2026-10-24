<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}" class="brand-link">
            <img
                src="{{ asset('adminLte/assets/img/AdminLTELogo.png') }}"
                alt=""
                class="brand-image opacity-75 shadow"
            >
            <span class="brand-text fw-light">Master Praktikum</span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2" aria-label="Navigasi utama">
            <ul class="nav sidebar-menu flex-column">
                @foreach ([
                    ['route' => 'dashboard', 'match' => 'dashboard', 'icon' => 'bi-speedometer', 'label' => 'Dashboard'],
                    ['route' => 'pasien.index', 'match' => 'pasien.*', 'icon' => 'bi-people', 'label' => 'Data Pasien'],
                    ['route' => 'dokter.index', 'match' => 'dokter.*', 'icon' => 'bi-person-badge', 'label' => 'Data Dokter'],
                    ['route' => 'poli.index', 'match' => 'poli.*', 'icon' => 'bi-hospital', 'label' => 'Data Poli'],
                    ['route' => 'pendaftaran.index', 'match' => 'pendaftaran.*', 'icon' => 'bi-clipboard-check', 'label' => 'Pendaftaran'],
                    ['route' => 'jadwal.index', 'match' => 'jadwal.*', 'icon' => 'bi-calendar-week', 'label' => 'Jadwal Dokter'],
                ] as $menu)
                    <li class="nav-item">
                        <a
                            href="{{ route($menu['route']) }}"
                            class="nav-link {{ request()->routeIs($menu['match']) ? 'active' : '' }}"
                            @if(request()->routeIs($menu['match'])) aria-current="page" @endif
                        >
                            <i class="nav-icon bi {{ $menu['icon'] }}" aria-hidden="true"></i>
                            <p>{{ $menu['label'] }}</p>
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
</aside>
