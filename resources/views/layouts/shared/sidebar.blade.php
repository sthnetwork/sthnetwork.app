<!-- Sidenav Menu Start -->
<div class="app-menu">
    <!-- Brand Logo -->
    <a href="{{ route('any', 'index') }}" class="logo-box">
        <div class="logo-light">
            <img src="/images/logo-light.png" class="logo-lg h-6" alt="Light logo">
            <img src="/images/logo-sm.png" class="logo-sm" alt="Small logo">
        </div>
        <div class="logo-dark">
            <img src="/images/logo-dark.png" class="logo-lg h-6" alt="Dark logo">
            <img src="/images/logo-sm.png" class="logo-sm" alt="Small logo">
        </div>
    </a>

    <!-- Menu Toggle -->
    <button id="button-hover-toggle" class="absolute top-5 end-2 rounded-full p-1.5">
        <span class="sr-only">Menu Toggle Button</span>
        <i class="mgc_round_line text-xl"></i>
    </button>

    <!-- Menu List -->
    <div class="srcollbar" data-simplebar>
        <ul class="menu" data-fc-type="accordion">

            {{-- DASHBOARD --}}
            <li class="menu-title">Menu</li>
            <li class="menu-item">
                <a href="{{ route('any', 'index') }}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_home_3_line"></i></span>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>

            {{-- NETWORK SECTION --}}
            <li class="menu-title">Network</li>
            <li class="menu-item">
                <a href="{{ route('mikrotik.index') }}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_server_line"></i></span>
                    <span class="menu-text">Mikrotik</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('vpn.index') }}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_shield_keyhole_line"></i></span>
                    <span class="menu-text">VPN</span>
                </a>
            </li>
            {{-- <li class="menu-item">
                <a href="{{ route('olt.index') }}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_network_line"></i></span>
                    <span class="menu-text">OLT / ODP</span>
                </a>
            </li> --}}

            {{-- FINANCIAL SECTION --}}
            <li class="menu-title">Keuangan</li>
            <li class="menu-item">
                <a href="{{ route('customers.index') }}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_user_2_line"></i></span>
                    <span class="menu-text">Pelanggan</span>
                </a>
            </li>
            {{-- <li class="menu-item">
                <a href="{{ route('billing.index') }}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_wallet_2_line"></i></span>
                    <span class="menu-text">Tagihan</span>
                </a>
            </li> --}}

        </ul>
    </div>
</div>
<!-- Sidenav Menu End -->

