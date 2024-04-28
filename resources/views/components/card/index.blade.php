<div class="card mb-3">
    <div class="card-header pb-0">
        <div class="d-flex align-items-center">
            <div>
                <h5 class="mb-0">{{ $cardHeaderText }}</h5>
            </div>
            <div class="ms-auto my-auto">
                @php
                    $parts = explode('.', Route::currentRouteName());
                    array_pop($parts);
                    $routeName = implode('.', $parts);
                @endphp
                <a href="{{ route($routeName . '.create') }}" class="btn bg-gradient-primary btn-lg mb-0">+&nbsp;เพิ่มรายการ</a>
            </div>
        </div>
    </div>
    <div class="card-body p-3">
        {{ $table }}
    </div>
</div>
