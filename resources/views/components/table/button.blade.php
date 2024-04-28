@php
    // แก้ current route name จาก setting.prefix.index เป็น setting.prefix (เอา .index ออก เพราะจะใส่ .show, .edit, .delete)
    $parts = explode('.', Route::currentRouteName());
    array_pop($parts);
    $routeName = implode('.', $parts);
    // dump($routeName);
@endphp
{{-- <a href="{{ route($routeName . '.show', $itemID) }}">
    <i class="fas fa-eye text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="ดู"></i>
</a> --}}
<a href="{{ route($routeName . '.edit', $itemID) }}" class="mx-3">
    <i class="fas fa-edit text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="แก้ไข"></i>
</a>

{!! Form::open([
    'method' => 'DELETE',
    'route' => [$routeName . '.destroy', [$itemID]],
    'style' => 'display:inline',
    // 'onclick' => 'return confirm(&quot;ยืนยันการลบข้อมูล?&quot;)',
]) !!}

{!! Form::button(
    '<i class="fas fa-trash text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="top"
title="ลบ"></i>',
    [
        'type' => 'submit',
        'class' => 'btn btn-link m-0 p-0 mb-1 btnDelete',
        'onclick' => 'return confirm("ยืนยันการลบข้อมูล?");',
    ],
) !!}
{!! Form::close() !!}
