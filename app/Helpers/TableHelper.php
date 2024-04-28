<?php
// for run no. in paginate list.
if(!function_exists('autoNumber')) {
	function autoNumber($obj)
	{
		$is_object     = is_object($obj);
		$has_paginator = method_exists($obj, 'currentPage');
		static $i;

		if($is_object && $has_paginator) 
			return (($obj->currentPage()-1)*$obj->perPage())+(++$i);
		else
			return (++$i);
	}
}

if(!function_exists('tbl_empty')) 
{
    function tbl_empty($col=false, $txt='ไม่มีข้อมูล') 
	{
        echo '<tr><td '.($col?'colspan="'.$col.'"':false).' class="text-center">'.$txt.'</td></tr>';
    }
}