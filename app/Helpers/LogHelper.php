<?php
if (!function_exists('getErrorCode'))
{
	function getErrorCode()
	{
		$error_code = 'ERR-';
		// Code from route:
		$routes = explode('.', \Route::current()->getName());
		$new_routes = [];
		foreach ($routes as $route)
			array_push($new_routes, strtoupper($route));
		$new_routes = implode('-', $new_routes);
		// set error code:
		$error_code .= $new_routes; //add prefix error code.
		$error_code .= ':'.substr(date('Y'), -2).date('mdHis'); //add time
		$error_code .= ':'.uniqid(); //add uniqid
		return ($error_code);
	}
}

if(!function_exists('logFormAction')) {
    function logFormAction($name, $date) 
    {
        $action_name = ($name) ? $name.' - ' : '';
        $action_name .= DBToDateText($date, true, true);
        return $action_name;
    }
}
?>