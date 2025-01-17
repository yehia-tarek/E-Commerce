<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                @foreach (config('admin.menu') as $menu)
                    <a class="nav-link" href="{{ route($menu['route']) }}">
                        <div class="sb-nav-link-icon"><i class="fas {{ $menu['icon'] }}"></i></div>
                        {{ __($menu['name']) }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="sb-sidenav-footer">
        </div>
    </nav>
</div>
