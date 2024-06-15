@php
    $menuItems = [
        ['name' => 'แดชบอร์ด', 'route' => 'admin.dashboard', 'icon' => 'fa-house'],
        ['name' => 'หลักสูตร', 'route' => 'admin.curriculum.index', 'icon' => 'fa-graduation-cap', 'additional_routes' => ['admin.curriculum-lesson', 'admin.curriculum-lesson-question', 'admin.curriculum-exam-setting']],
        ['name' => 'ไฮไลท์', 'route' => 'admin.hilight.index', 'icon' => 'fa-images'],
        ['name' => 'คำถามที่พบบ่อย', 'route' => 'admin.faq.index', 'icon' => 'fa-circle-question'],
        ['name' => 'ข้อมูลติดต่อ', 'route' => ['admin.contact.edit', ['contact' => 1]], 'icon' => 'fa-map-location-dot'],
        ['name' => 'นโยบายเว็บไซต์', 'route' => ['admin.website-policy.edit', ['website_policy' => 1]], 'icon' => 'fa-globe'],
        ['name' => 'นโยบายข้อมูลส่วนบุคคล', 'route' => ['admin.privacy-policy.edit', ['privacy_policy' => 1]], 'icon' => 'fa-shield-halved'],
        ['name' => 'แบบสำรวจความพึงพอใจ', 'route' => 'admin.survey.index', 'icon' => 'fa-poll'],
        ['name' => 'ผู้ใช้งาน', 'route' => 'admin.user.index', 'icon' => 'fa-user'],
        ['name' => 'กล่องข้อความ', 'route' => 'admin.inbox.index', 'icon' => 'fa-inbox'],
    ];
@endphp


@php
    function isActive($baseRoute, $additionalRoutes = [])
    {
        $routes = array_merge([$baseRoute], $additionalRoutes);
        $currentRoute = Route::currentRouteName();

        foreach ($routes as $route) {
            // ตัดส่วนที่เป็น .index และ .edit ออก
            $baseRouteOnly = preg_replace('/\.(index|edit)$/', '', $route);
            $currentRouteOnly = preg_replace('/\.(index|edit)$/', '', $currentRoute);

            if (strpos($currentRouteOnly, $baseRouteOnly) === 0) {
                return true;
            }
        }
        return false;
    }
@endphp



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
            @foreach ($menuItems as $item)
                @php
                    $baseRoute = $item['base_route'] ?? (is_array($item['route']) ? $item['route'][0] : $item['route']);
                    $additionalRoutes = $item['additional_routes'] ?? [];
                @endphp
                <li class="nav-item {{ isActive($baseRoute, $additionalRoutes) ? 'active' : '' }}">
                    <a class="nav-link {{ isActive($baseRoute, $additionalRoutes) ? 'active' : '' }}" href="{{ is_array($item['route']) ? route($item['route'][0], $item['route'][1]) : route($item['route']) }}">
                        <div class="icon text-center d-flex align-items-center justify-content-center">
                            <i class="fa-solid {{ $item['icon'] }} text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ $item['name'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</aside>
