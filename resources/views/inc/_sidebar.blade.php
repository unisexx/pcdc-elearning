<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 ps ps--active-y" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="">
            <img src="{{ asset('images/logo-pcdc-1.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">E-learning</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto h-auto ps" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            {{-- <li class="nav-item">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">แดชบอร์ด</h6>
            </li> --}}
            <li class="nav-item {{ strpos(Route::currentRouteName(), 'dashboard') === 0 ? 'active' : '' }}">
                <a class="nav-link {{ strpos(Route::currentRouteName(), 'dashboard') === 0 ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <div class="icon text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-house text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">แดชบอร์ด</span>
                </a>
            </li>
            <li class="nav-item {{ strpos(Route::currentRouteName(), 'curriculum') === 0 ? 'active' : '' }}">
                <a class="nav-link {{ strpos(Route::currentRouteName(), 'curriculum') === 0 ? 'active' : '' }}" href="{{ route('admin.curriculum.index') }}">
                    <div class="icon text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-images text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">หลักสูตร</span>
                </a>
            </li>
            <li class="nav-item {{ strpos(Route::currentRouteName(), 'hilight') === 0 ? 'active' : '' }}">
                <a class="nav-link {{ strpos(Route::currentRouteName(), 'hilight') === 0 ? 'active' : '' }}" href="{{ route('admin.hilight.index') }}">
                    <div class="icon text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-images text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">ไฮไลท์</span>
                </a>
            </li>
            <li class="nav-item {{ strpos(Route::currentRouteName(), 'faq') === 0 ? 'active' : '' }}">
                <a class="nav-link {{ strpos(Route::currentRouteName(), 'faq') === 0 ? 'active' : '' }}" href="{{ route('admin.faq.index') }}">
                    <div class="icon text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-circle-question text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">คำถามที่พบบ่อย</span>
                </a>
            </li>
            <li class="nav-item {{ strpos(Route::currentRouteName(), 'contact') === 0 ? 'active' : '' }}">
                <a class="nav-link {{ strpos(Route::currentRouteName(), 'contact') === 0 ? 'active' : '' }}" href="{{ route('admin.contact.edit', ['contact' => 1]) }}">
                    <div class="icon text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-map-location-dot text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">ข้อมูลติดต่อ</span>
                </a>
            </li>
            <li class="nav-item {{ strpos(Route::currentRouteName(), 'website-policy') === 0 ? 'active' : '' }}">
                <a class="nav-link {{ strpos(Route::currentRouteName(), 'website-policy') === 0 ? 'active' : '' }}" href="{{ route('admin.website-policy.edit', ['website_policy' => 1]) }}">
                    <div class="icon text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-globe text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">นโยบายเว็บไซต์</span>
                </a>
            </li>
            <li class="nav-item {{ strpos(Route::currentRouteName(), 'privacy-policy') === 0 ? 'active' : '' }}">
                <a class="nav-link {{ strpos(Route::currentRouteName(), 'privacy-policy') === 0 ? 'active' : '' }}" href="{{ route('admin.privacy-policy.edit', ['privacy_policy' => 1]) }}">
                    <div class="icon text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-shield-halved text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">นโยบายข้อมูลส่วนบุคคล</span>
                </a>
            </li>
            {{-- <li class="nav-item {{ strpos(Route::currentRouteName(), 'home') === 0 ? 'active' : '' }}">
                <a class="nav-link {{ strpos(Route::currentRouteName(), 'home') === 0 ? 'active' : '' }}" href="{{ route('home') }}">
                    <div class="icon text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-briefcase text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">สิทธิ์การใช้งาน</span>
                </a>
            </li> --}}
            <li class="nav-item {{ strpos(Route::currentRouteName(), 'user') === 0 ? 'active' : '' }}">
                <a class="nav-link {{ strpos(Route::currentRouteName(), 'user') === 0 ? 'active' : '' }}" href="{{ route('admin.user.index') }}">
                    <div class="icon text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-user text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">ผู้ใช้งาน</span>
                </a>
            </li>
            <li class="nav-item {{ strpos(Route::currentRouteName(), 'inbox') === 0 ? 'active' : '' }}">
                <a class="nav-link {{ strpos(Route::currentRouteName(), 'inbox') === 0 ? 'active' : '' }}" href="{{ route('admin.inbox.index') }}">
                    <div class="icon text-center d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-inbox text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">กล่องข้อความ</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
@push('js')
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('argon/assets/js/argon-dashboard.js?v=2.0.4') }}"></script>
@endpush
