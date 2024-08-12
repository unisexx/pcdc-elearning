@php
    $menuItems = [
        ['name' => 'แดชบอร์ด', 'route' => 'admin.dashboard', 'icon' => 'fa-house'],
        ['name' => 'หมวดหมู่หลักสูตร', 'route' => 'admin.curriculum-category.index', 'icon' => 'fa-list'],
        ['name' => 'หลักสูตร', 'route' => 'admin.curriculum.index', 'icon' => 'fa-graduation-cap', 'additional_routes' => ['admin.curriculum-lesson', 'admin.curriculum-lesson-question', 'admin.curriculum-exam-setting'], 'exclude_routes' => ['admin.curriculum-category']],
        ['name' => 'ไฮไลท์', 'route' => 'admin.hilight.index', 'icon' => 'fa-images'],
        ['name' => 'คำถามที่พบบ่อย', 'route' => 'admin.faq.index', 'icon' => 'fa-circle-question'],
        ['name' => 'ข้อมูลติดต่อ', 'route' => ['admin.contact.edit', ['contact' => 1]], 'icon' => 'fa-map-location-dot'],
        ['name' => 'นโยบายเว็บไซต์', 'route' => ['admin.website-policy.edit', ['website_policy' => 1]], 'icon' => 'fa-globe'],
        ['name' => 'นโยบายข้อมูลส่วนบุคคล', 'route' => ['admin.privacy-policy.edit', ['privacy_policy' => 1]], 'icon' => 'fa-shield-halved'],
        ['name' => 'แบบสำรวจความพึงพอใจ', 'route' => 'admin.survey.index', 'icon' => 'fa-poll'],
        ['name' => 'ผู้ใช้งาน', 'route' => 'admin.user.index', 'icon' => 'fa-user'],
        ['name' => 'กล่องข้อความ', 'route' => 'admin.inbox.index', 'icon' => 'fa-inbox'],
        ['name' => 'Logs', 'route' => 'admin.log.index', 'icon' => 'fa-history'],
    ];
@endphp




@php
    function isActive($baseRoute, $additionalRoutes = [], $excludeRoutes = [])
    {
        $routes = array_merge([$baseRoute], $additionalRoutes);
        $currentRoute = Route::currentRouteName();
        $currentUri = Route::current()->uri();

        // ตรวจสอบว่า currentRoute ไม่อยู่ใน excludeRoutes
        foreach ($excludeRoutes as $excludeRoute) {
            if (strpos($currentRoute, $excludeRoute) !== false || strpos($currentUri, $excludeRoute) !== false) {
                return false;
            }
        }

        // ตรวจสอบว่า currentRoute ตรงกับ routes ที่ต้องการ
        foreach ($routes as $route) {
            $baseRouteOnly = preg_replace('/\.(index|edit|create)$/', '', $route);
            $currentRouteOnly = preg_replace('/\.(index|edit|create)$/', '', $currentRoute);

            if (strpos($currentRouteOnly, $baseRouteOnly) === 0 || strpos($currentUri, $baseRouteOnly) !== false) {
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
            <span class="ms-1 font-weight-bold">e-pcdc</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto h-auto ps" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @foreach ($menuItems as $item)
                @php
                    $baseRoute = $item['base_route'] ?? (is_array($item['route']) ? $item['route'][0] : $item['route']);
                    $additionalRoutes = $item['additional_routes'] ?? [];
                    $excludeRoutes = $item['exclude_routes'] ?? [];
                @endphp
                <li class="nav-item {{ isActive($baseRoute, $additionalRoutes, $excludeRoutes) ? 'active' : '' }}">
                    <a class="nav-link {{ isActive($baseRoute, $additionalRoutes, $excludeRoutes) ? 'active' : '' }}" href="{{ is_array($item['route']) ? route($item['route'][0], $item['route'][1]) : route($item['route']) }}">
                        <div class="icon text-center d-flex align-items-center justify-content-center">
                            <i class="fa-solid {{ $item['icon'] }} text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{ $item['name'] }}</span>
                    </a>
                </li>
            @endforeach
            <li class="nav-item">
                <hr class="horizontal dark">
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ asset('js/tinymce_5.10.9/tinymce/js/tinymce/plugins/responsive_filemanager/responsive_filemanager//source/%E0%B8%84%E0%B8%B9%E0%B9%88%E0%B8%A1%E0%B8%B7%E0%B8%AD%E0%B8%81%E0%B8%B2%E0%B8%A3%E0%B9%83%E0%B8%8A%E0%B9%89%E0%B8%87%E0%B8%B2%E0%B8%99%E0%B8%AA%E0%B8%B3%E0%B8%AB%E0%B8%A3%E0%B8%B1%E0%B8%9A%E0%B8%9C%E0%B8%B9%E0%B9%89%E0%B8%94%E0%B8%B9%E0%B9%81%E0%B8%A5%E0%B8%A3%E0%B8%B0%E0%B8%9A%E0%B8%9A.pdf') }}" target="_blank">
                    <div class="icon text-center d-flex align-items-center justify-content-center">
                        <i class="fas fa-file-pdf text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">คู่มือการใช้งาน</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
