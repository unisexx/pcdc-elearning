<?php

if (!function_exists('statusBadge')) {
    function statusBadge($status)
    {
        if ($status == 'active') {
            $html = '<span class="badge badge-success badge-sm">เปิด</span>';
        } elseif ($status == 'inactive') {
            $html = '<span class="badge badge-danger badge-sm">ปิด</span>';
        }

        return @$html;
    }
}
