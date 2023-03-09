

<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
        </ul>
    </form>
    <style>
        .dropdown-no-after::after {
            content: none !important;
        }
    </style>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown dropdown-list-toggle">
            <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep position-relative">
                <i class="far fa-bell"></i>
{{--                @if ($notifications->count() > 0)--}}
{{--                    <a class="position-absolute d-inline-block bg-danger text-white" style="top: -3px; right: -5px; line-height: normal; padding: 2px 7px 2px 7px; border-radius: 100px;">{{ $notifications->count() }}</a>--}}
{{--                @endif--}}
            </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">
                    Notifications
                </div>
                <div class="dropdown-list-content dropdown-list-icons dropdown-no-after">
{{--                    @foreach($notifications as $notification)--}}
{{--                        <a href="{{ route('admin.orders.index') }}" class="dropdown-item dropdown-item-unread">--}}
{{--                            <div class="dropdown-item-icon bg-primary text-white">--}}
{{--                                <i class="fas fa-shopping-bag"></i>--}}
{{--                            </div>--}}
{{--                            <div class="dropdown-item-desc">--}}
{{--                                There's new order!--}}
{{--                                <div class="time text-primary">{{ $notification->created_at->diffForHumans() }}</div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    @endforeach--}}
                </div>
            </div>
        </li>
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->username }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
{{--                <a href="{{ route('admin.biodatas.create') }}" class="dropdown-item has-icon">--}}
{{--                    <i class="far fa-user"></i> Profile--}}
{{--                </a>--}}
{{--                <div class="dropdown-divider"></div>--}}
                <a href="{{ route('logout.store') }}" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
