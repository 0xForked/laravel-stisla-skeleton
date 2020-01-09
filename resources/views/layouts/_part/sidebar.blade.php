<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">{{ app_settings()['site_title']->value }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <img src="{{ asset('assets/img/sites/' . app_settings()['site_logo']->value) }}" alt="logo" width="30">
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">DATA</li>
            <li class="nav-item dropdown {{
                (
                    Route::is('admin.users.*')
                    || Route::is('admin.roles.*')
                    || Route::is('admin.permissions.*')
                ) ? 'active' : ''
            }}
            ">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-users"></i>
                    <span>Pengguna</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::is('admin.users.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.users.index') }}">Pengguna</a>
                    </li>
                    <li class="{{ Route::is('admin.roles.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.roles.index') }}">Peran</a>
                    </li>
                    <li class="{{ Route::is('admin.permissions.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.permissions.index') }}">Izin</a>
                    </li>
                </ul>
            </li>

            <li class="menu-header">SITUS</li>
            <li class="{{ (Request::segment(2) == 'settings') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.app.setting') }}">
                    <i class="fas fa-cogs"></i>
                    <span>Pengaturan</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
