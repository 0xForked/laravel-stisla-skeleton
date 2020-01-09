<ul class="navbar-nav navbar-right">
    <li class="dropdown dropdown-list-toggle">
        <a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep">
            <i class="far fa-envelope"></i>
        </a>
        <div class="dropdown-menu dropdown-list dropdown-menu-right">
            <div class="dropdown-header">
                Messages
                <div class="float-right">
                    <a href="#">Mark All As Read</a>
                </div>
            </div>
            <div class="dropdown-list-content dropdown-list-message">
                <a href="#" class="dropdown-item dropdown-item-unread">
                    <div class="dropdown-item-avatar">
                        <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle">
                        <div class="is-online"></div>
                    </div>
                    <div class="dropdown-item-desc">

                        <b>Kusnaedi</b>
                        <p>Hello, Bro!</p>
                        <div class="time">10 Hours Ago</div>
                    </div>
                </a>
            </div>
            <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
            </div>
        </div>
    </li>
    <li class="dropdown dropdown-list-toggle">
        <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep">
            <i class="far fa-bell"></i>
        </a>
        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">
                    Notifications
                    <div class="float-right">
                        <a href="#">Mark All As Read</a>
                    </div>
                </div>
            <div class="dropdown-list-content dropdown-list-icons">
                <a href="#" class="dropdown-item dropdown-item-unread">
                    <div class="dropdown-item-icon bg-primary text-white">
                        <i class="fas fa-code"></i>
                    </div>
                    <div class="dropdown-item-desc">
                        Template update is available now!
                        <div class="time text-primary">2 Min Ago</div>
                    </div>
                </a>
            </div>
            <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
            </div>
        </div>
    </li>
    <li class="dropdown">
        <a
            href="#"
            data-toggle="dropdown"
            class="nav-link dropdown-toggle nav-link-lg
            nav-link-user"
        >
            <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hai, {{ last_name(auth()->user()->name) }}</div>
        </a>

        <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-title">Masuk  {{ (!is_null(login_activity())) ? last_logged_in(login_activity()->created_at) : "0 min lalu" }}</div>
            <a href="{{ route('account.profile') }}" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Akun
            </a>
            <a href="{{ route('account.activity') }}" class="dropdown-item has-icon">
                <i class="fas fa-bolt"></i> Aktifitas
            </a>
            <div class="dropdown-divider"></div>
            <a
                href="#"
                class="dropdown-item has-icon text-danger"
                data-toggle="modal"
                data-target="#logoutModal"
                >
                <i class="fas fa-sign-out-alt"></i> Keluar
            </a>
        </div>
    </li>
</ul>
