
<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboards.index') }}">Inventory</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboards.index') }}">Invt</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Home</li>
            <li class="@if (request()->routeIs('admin.dashboards.*')) active @endif"><a class="nav-link" href="{{ route('admin.dashboards.index') }}"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
            @if (auth()->user()->isAdmin())
                <li class="menu-header">Additional</li>
                <li class="@if (request()->routeIs('admin.products.*')) active @endif"><a class="nav-link" href="{{ route('admin.products.index') }}"><i class="fas fa-shopping-bag"></i> <span>Produk</span></a></li>
                <li class="@if (request()->routeIs('admin.suppliers.*')) active @endif"><a class="nav-link" href="{{ route('admin.suppliers.index') }}"><i class="fas fa-truck-loading"></i> <span>Supplier</span></a></li>
                <li class="menu-header">Request & Shipping</li>
                @if (auth()->user()->isAdmin())
                    <li class="@if (request()->routeIs('admin.request-orders.*')) active @endif"><a class="nav-link" href="{{ route('admin.request-orders.index') }}"><i class="fas fa-paper-plane"></i> <span>Request</span></a></li>

                    @if(auth()->user()->isInBali())
                        <li class="@if (request()->routeIs('admin.orders.*')) active @endif"><a class="nav-link" href="{{ route('admin.orders.index') }}"><i class="fas fa-download"></i> <span>Order</span></a></li>
                    @endif

                @endif
            @endif
            <li class="@if (request()->routeIs('admin.shippings.*')) active @endif"><a class="nav-link" href="{{ route('admin.shippings.index') }}"><i class="fas fa-truck"></i> <span>Pengiriman</span></a></li>
            @if (auth()->user()->isDirector())
                <li class="menu-header">Members</li>
                <li class="@if (request()->routeIs('admin.users.*')) active @endif"><a class="nav-link" href="{{ route('admin.users.index') }}"><i class="fas fa-user"></i> <span>Admin</span></a></li>
                <li class="menu-header">Request & Shipping</li>
                <li class="@if (request()->routeIs('admin.orders.*')) active @endif"><a class="nav-link" href="{{ route('admin.orders.index') }}"><i class="fas fa-download"></i> <span>Order</span></a></li>
            @endif
        </ul>
    </aside>
</div>
