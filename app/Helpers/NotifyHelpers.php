<?php
if (!function_exists('notify')) {
    function set_notify($type = 'success', $msg = null, $delay = 3000)
    {
        Session::flash('notify', true);
        Session::flash('type', $type);
        Session::flash('msg', $msg);
        Session::flash('delay', $delay);

        if ($type == 'success') {
            Session::flash('color', '#4fbe87');
        } elseif ($type == 'error') {
            Session::flash('color', '#dc3545');
        }
    }
}

if (!function_exists('jsNotify')) {
    function js_notify()
    {
        if (Session::get('notify')) {
            return '
                <link href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" rel="stylesheet">
                <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
				<script type="text/javascript">
                    Toastify({
                        text: "' . Session::get('msg') . '",
                        duration: ' . Session::get('delay') . ',
                        close:true,
                        gravity:"top",
                        position: "center",
                        backgroundColor: "' . Session::get('color') . '",
                    }).showToast();
                </script>';
        }
    }
}
