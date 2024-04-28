<?php
if (!function_exists('DB2Date')) {
    function DB2Date($Dt)
    {
        if (($Dt != null) && ($Dt != '0000-00-00')) {
            @list($date, $time) = explode(" ", $Dt);
            list($y, $m, $d)    = explode("-", $date);

            return $d . "/" . $m . "/" . ($y + 543);
        } else {
            $Dt = "";

            return $Dt;
        }
    }
}

if (!function_exists('DB2DateEn')) {
    function DB2DateEn($Dt)
    {
        if (($Dt != null) && ($Dt != '0000-00-00')) {
            @list($date, $time) = explode(" ", $Dt);
            list($y, $m, $d)    = explode("-", $date);

            return $y . "-" . $m . "-" . $d;
        } else {
            $Dt = "";

            return $Dt;
        }
    }
}

if (!function_exists('Date2DBEn')) {
    function Date2DBEn($Dt)
    {
        if (($Dt != "") && ($Dt != '0000-00-00')) {
            @list($date, $time) = explode(" ", $Dt);
            list($y, $m, $d)    = explode("-", $date);

            return $d . "/" . $m . "/" . $y;
        } else {
            $Dt = "";

            return $Dt;
        }
    }
}

if (!function_exists('Date2DB')) {
    function Date2DB($Dt)
    {
        if (($Dt != "") && ($Dt != '0000/00/00')) {
            @list($date, $time) = explode(" ", $Dt);
            list($d, $m, $y)    = explode("/", $date);

            return ($y - 543) . "-" . $m . "-" . $d;
        } else {return $Dt;}
    }
}

if (!function_exists('DBToDate')) {
    function DBToDate($date = null, $is_date_thai = true, $showTime = false)
    {
        if (!$date ||
            $date == '0000-00-00' ||
            $date == '0000-00-00 00:00:00') {
            return null;
        }
        //year tyep (buddha or christ).
        $year = ($is_date_thai) ? (date('Y', strtotime($date)) + 543) : date('Y', strtotime($date));

        return ($showTime) ? date('d/m/', strtotime($date)) . $year . ' ' . date('H:i:s', strtotime($date)) : date('d/m/', strtotime($date)) . $year;
    }
}

if (!function_exists('thMonth')) {
    function thMonth($month)
    {
        $thai_month_arr = [
            "0"  => "",
            "1"  => "มกราคม",
            "2"  => "กุมภาพันธ์",
            "3"  => "มีนาคม",
            "4"  => "เมษายน",
            "5"  => "พฤษภาคม",
            "6"  => "มิถุนายน",
            "7"  => "กรกฎาคม",
            "8"  => "สิงหาคม",
            "9"  => "กันยายน",
            "10" => "ตุลาคม",
            "11" => "พฤศจิกายน",
            "12" => "ธันวาคม",
        ];

        return $thai_month_arr[ltrim($month, '0')];
    }
}

if (!function_exists('get_month')) {
    function get_month()
    {
        return ['1' => 'มกราคม', '2' => 'กุมภาพันธ์', '3' => 'มีนาคม', '4' => 'เมษายน', '5' => 'พฤษภาคม', '6' => 'มิถุนายน', '7' => 'กรกฏาคม', '8' => 'สิงหาคม', '9' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม'];
    }
}

if (!function_exists('DBToDateThai')) {
    function DBToDateThai($date = null, $is_date_thai = true, $showTime = false, $format = 'S')
    {
        if (
            !$date ||
            $date == '0000-00-00' ||
            $date == '0000-00-00 00:00:00'
        ) {
            return null;
        }

        if ($format == 'F') {
            $month_th = [1 => 'มกราคม', 2 => 'กุมภาพันธ์', 3 => 'มีนาคม', 4 => 'เมษายน', 5 => 'พฤษภาคม', 6 => 'มิถุนายน', 7 => 'กรกฏาคม', 8 => 'สิงหาคม', 9 => 'กันยายน', 10 => 'ตุลาคม', 11 => 'พฤศจิกายน', 12 => 'ธันวาคม'];
        } else {
            $month_th = [1 => 'ม.ค.', 2 => 'ก.พ.', 3 => 'มี.ค.', 4 => 'เม.ย', 5 => 'พ.ค.', 6 => 'มิ.ย', 7 => 'ก.ค.', 8 => 'ส.ค.', 9 => 'ก.ย.', 10 => 'ต.ค.', 11 => 'พ.ย.', 12 => 'ธ.ค.'];
        }

        //year tyep (buddha or christ).
        $year = ($is_date_thai) ? (date('Y', strtotime($date)) + 543) : date('Y', strtotime($date));

        return ($showTime) ? date('d', strtotime($date)) . ' ' . $month_th[ltrim(date('m', strtotime($date)), '0')] . ' ' . $year . ' ' . date('H:i:s', strtotime($date)) : date('d', strtotime($date)) . ' ' . $month_th[ltrim(date('m', strtotime($date)), '0')] . ' ' . $year;
    }
}

if (!function_exists('displyDateTime')) {
    function displyDateTime($sDate, $sTime, $eDate, $eTime)
    {
        $txt = '';
        if ($sDate == $eDate) {
            $txt = date("H:i", strtotime($sTime)) . ' น. - ' . date("H:i", strtotime($eTime)) . ' น.';
        } else {
            $txt = DBToDateThai($sDate) . ' ' . date("H:i", strtotime($sTime)) . ' น. - ' . DBToDateThai($eDate) . ' ' . date("H:i", strtotime($eTime)) . ' น.';
        }

        return $txt;
    }
}

if (!function_exists('displyDateTime2')) {
    function displyDateTime2($sDate, $sTime, $eDate, $eTime)
    {
        $txt = DBToDateThai($sDate) . ' ' . date("H:i", strtotime($sTime)) . ' น. - ' . DBToDateThai($eDate) . ' ' . date("H:i", strtotime($eTime)) . ' น.';

        return $txt;
    }
}

/**
 * ฟังก์ชั่นนเดิมของ พก. แปลงวันที่ให้เป็นตัวหนังสือ 14-08-2527 => 14 ส.ค. 2527
 */
if (!function_exists('f_date_thai_format')) {
    function f_date_thai_format($p_date, $type = "abbr")
    {
        if (strlen($p_date) != 10) {
            return $p_date;
        }
        $v_month = [];
        if (strtoupper($type) == "FULL") {$v_month = ["", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];} else { $v_month = ["", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค."];}
        $v_date = intval(substr($p_date, 0, 2));
        if ($v_date == 0) {
            $v_date = "";
        }
        $v_month = @$v_month[intval(substr($p_date, 3, 2))];

        $v_year = substr($p_date, 6, 4);
        if ($v_year == 0) {
            $v_year = "";
        }

        return ltrim(rtrim($v_date . " " . $v_month . " " . $v_year));
    }
}

/**
 * ฟังก์ชั่นนเดิมของ พก. แปลงวันที่ให้เป็นตัวหนังสือ (Eng) 14-08-2527 => 14 Aug 2527
 */
if (!function_exists('f_date_eng_format')) {
    function f_date_eng_format($p_date, $type = "abbr")
    {
        if (strlen($p_date) != 10) {
            if ($p_date == 'ตลอดชีพ') {
                return 'lifelong';
            } else {
                return $p_date;
            }
        }
        $v_month = [];
        if (strtoupper($type) == "FULL") {$v_month = ["", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];} else { $v_month = ["", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];}
        $v_date = intval(substr($p_date, 0, 2));
        if ($v_date == 0) {
            $v_date = "";
        }
        $v_month = @$v_month[intval(substr($p_date, 3, 2))];

        $v_year = substr($p_date, 6, 4) - 543;
        if ($v_year == 0) {
            $v_year = "";
        }

        return ltrim(rtrim($v_date . " " . $v_month . " " . $v_year));
    }
}

//วันเดือนปีไทย แถมเวลา
if (!function_exists('DBToDateThaiAndTime')) {
    function DBToDateThaiAndTime($date = null, $is_date_thai = true, $showTime = true, $format = 'S')
    {
        if (
            !$date ||
            $date == '0000-00-00' ||
            $date == '0000-00-00 00:00:00'
        ) {
            return null;
        }

        if ($format == 'F') {
            $month_th = [1 => 'มกราคม', 2 => 'กุมภาพันธ์', 3 => 'มีนาคม', 4 => 'เมษายน', 5 => 'พฤษภาคม', 6 => 'มิถุนายน', 7 => 'กรกฏาคม', 8 => 'สิงหาคม', 9 => 'กันยายน', 10 => 'ตุลาคม', 11 => 'พฤศจิกายน', 12 => 'ธันวาคม'];
        } else {
            $month_th = [1 => 'ม.ค.', 2 => 'ก.พ.', 3 => 'มี.ค.', 4 => 'เม.ย', 5 => 'พ.ค.', 6 => 'มิ.ย', 7 => 'ก.ค.', 8 => 'ส.ค.', 9 => 'ก.ย.', 10 => 'ต.ค.', 11 => 'พ.ย.', 12 => 'ธ.ค.'];
        }

        //year tyep (buddha or christ).
        $year = ($is_date_thai) ? (date('Y', strtotime($date)) + 543) : date('Y', strtotime($date));

        return ($showTime) ? date('d', strtotime($date)) . ' ' . $month_th[ltrim(date('m', strtotime($date)), '0')] . ' ' . $year . ' ' . date('H:i:s', strtotime($date)) : date('d', strtotime($date)) . ' ' . $month_th[ltrim(date('m', strtotime($date)), '0')] . ' ' . $year;
    }
}
