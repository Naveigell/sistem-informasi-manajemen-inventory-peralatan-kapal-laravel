
<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Ct</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">Ct</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Home</li>
            <li class="@if (request()->routeIs('admin.dashboards.*')) active @endif"><a class="nav-link" href="{{ route('admin.dashboards.index') }}"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
            @if (auth()->user()->isAdmin())
                <li class="menu-header">Additional</li>
                <li class="@if (request()->routeIs('admin.products.*')) active @endif"><a class="nav-link" href="{{ route('admin.products.index') }}"><i class="fas fa-shopping-bag"></i> <span>Produk</span></a></li>
                <li class="@if (request()->routeIs('admin.suppliers.*')) active @endif"><a class="nav-link" href="{{ route('admin.suppliers.index') }}"><i class="fas fa-truck-loading"></i> <span>Supplier</span></a></li>
            @endif
            @if (auth()->user()->isDirector())
                <li class="menu-header">Members</li>
                <li class="@if (request()->routeIs('admin.users.*')) active @endif"><a class="nav-link" href="{{ route('admin.users.index') }}"><i class="fas fa-user"></i> <span>Admin</span></a></li>
            @endif
        </ul>
    </aside>
</div>
