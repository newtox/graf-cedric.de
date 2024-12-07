<div class="nav-item dropdown">
    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown">
        @auth
            <span class="avatar avatar-sm">
                <i class="ti ti-user"></i>
            </span>
            <div class="d-none d-xl-block ps-2">
                <div>{{Auth()->user()->name}}</div>
            </div>
        @else
            <span class="avatar avatar-sm">
                <i class="ti ti-user"></i>
            </span>
            <div class="d-none d-xl-block ps-2">
                <div>{{ __('Guest') }}</div>
            </div>
        @endauth
    </a>
    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
        @auth
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a class="dropdown-item" href="#"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="ti ti-logout text-red me-2"></i>Log Out
            </a>
        @else
            <a href="{{ route('login') }}" class="dropdown-item">
                <i class="ti ti-login me-2"></i>Login
            </a>
        @endauth
        <div class="dropdown-divider"></div>
        <a href="{{ route('language.switch', 'en') }}" class="dropdown-item">
            <i class="ti ti-language me-2"></i>English
        </a>
        <a href="{{ route('language.switch', 'de') }}" class="dropdown-item">
            <i class="ti ti-language me-2"></i>Deutsch
        </a>
    </div>
</div>
