@php

    $chart_curriculum_name_value_str = '';
    $chart_curriculum_name_str_month = '';
    $chart_curriculum_name_str = '';

    $max_month = intval($exam_year) - 543 == date('Y') ? date('m') : 12;

    // For column chart value
    // ['data1', 11, 8, 15, 18, 19, 17],
    $index = 0;
    foreach ($curriculum_month_pass_report as $key => $item) {
        $index++;
        $row_value = "'data" . $index . "'";
        for ($m = 1; $m <= $max_month; $m++) {
            $row_value .= ', ' . number_format($item['n_pass_m_' . $m], 0);
        }
        $chart_curriculum_name_value_str .= '[' . $row_value . '],';
    }
    // echo $chart_curriculum_name_value_str.'<hr>';

    // 'data1': 'หลักสูตรที่ 1 โรคติดต่อในเด็กและโควิด 19',
    $index = 0;
    foreach ($curriculum_month_pass_report as $key => $item) {
        $index++;
        $chart_curriculum_name_str .= $index > 1 ? ',' : '';
        $chart_curriculum_name_str .= "'data" . $index . "': '" . $item['name'] . "'";
    }
    // echo $chart_curriculum_name_str.'<hr>';

    // ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน']
    $index = 0;
    $month_list = get_month();
    for ($m = 1; $m <= $max_month; $m++) {
        $chart_curriculum_name_str_month .= $m > 1 ? ',' : '';
        $chart_curriculum_name_str_month .= "'" . $month_list[$m] . "'";
    }
    // echo $chart_curriculum_name_str_month;
@endphp
<table>
    <tr>
        <th>รายงานสถิติ จำนวนผู้ผ่านหลักสูตรต่างๆ</th>
    </tr>
</table>
<br>
<table border="1" cellspacing="2" cellpadding="5">
    <thead>
        <tr>
            <th style="vertical-align: middle; " rowspan="2">เดือน</th>
            <th colspan="{{ $ncol = count($curriculum_month_pass_report) == 0 ? 1 : count($curriculum_month_pass_report) }}">
                <div class="title-table">จำนวนผู้ผ่านหลักสูตรต่างๆ (คน)</div>
            </th>
        </tr>
        <tr>
            @foreach ($curriculum_month_pass_report as $key => $item)
                <th>{!! $item['name'] !!}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @for ($m = 1; $m <= $max_month; $m++)
            <tr>
                <td>{{ get_month()[$m] }}</td>
                @foreach ($curriculum_month_pass_report as $key => $item)
                    <th>{{ number_format($item['n_pass_m_' . $m], 0) }}</th>
                @endforeach
            </tr>
        @endfor
    </tbody>
</table>
