<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}">Apotek Al Hutama</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">N-A</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>
                        <a class="nav-link" href="{{ url('dashboard-general-dashboard') }}">General Dashboard</a>
                    </li>

                </ul>
            </li>
            <li class="menu-header">Management user</li>
            <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>

                <a href="{{ route('user.index') }}" class="nav-link"><i class="fas fa-fire"></i><span>Sytem
                        Controller</span></a>
            </li>

            <li class="menu-header">Management Produk</li>
            <li class='{{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}'>

                <a href="{{ route('product.index') }}" class="nav-link"><i
                        class="fas fa-water"></i><span>Product</span></a>
            </li>
    </aside>
</div>
