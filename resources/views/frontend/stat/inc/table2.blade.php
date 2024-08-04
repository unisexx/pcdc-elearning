@php
    $max_month = intval($exam_year) - 543 == date('Y') ? date('m') : 12;

    $stack_report_month_pass_str = "'data1'";
    for ($m = 1; $m <= $max_month; $m++) {
        $stack_report_month_pass_str .= ',' . $curriculum_stack_exam_report['n_pass_m_' . $m];
    }

    $stack_report_month_no_pass_str = "'data2'";
    for ($m = 1; $m <= $max_month; $m++) {
        $stack_report_month_no_pass_str .= ',' . $curriculum_stack_exam_report['n_no_pass_m_' . $m];
    }

@endphp
<table>
    <tr>
        <th>
            รายงานสถิติ ผู้ทำแบบทดสอบ
            @if ($curriculum)
                หลักสูตร {{ $curriculum->name }}
            @else
                รวมทุกหลักสูตร
            @endif
            <br>เปรียบเทียบ ผู้ที่ผ่าน และ ไม่ผ่าน
            {{ $text = !empty($exam_year) ? 'ปี ' . $exam_year : '' }}
        </th>
    </tr>
</table>
<br>
<table border="1" cellspacing="2" cellpadding="5">
    <thead>
        <tr>
            <th style="vertical-align: middle; " rowspan="2"></th>
            <th colspan="12">
                <div class="title-table">จำนวนผู้ผ่านและไม่ผ่าน
                    @if ($curriculum)
                        หลักสูตร {{ $curriculum->name }}
                    @else
                        รวมทุกหลักสูตร
                    @endif
                    (คน)
                </div>
            </th>
        </tr>
        <tr>
            <th>ม.ค.</th>
            <th>ก.พ.</th>
            <th>มี.ค.</th>
            <th>เม.ย.</th>
            <th>พ.ค.</th>
            <th>มิ.ย.</th>
            <th>ก.ค.</th>
            <th>ส.ค.</th>
            <th>ก.ย.</th>
            <th>ต.ค.</th>
            <th>พ.ย.</th>
            <th>ธ.ค.</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>ผ่าน</td>
            @if ($curriculum_stack_exam_report)
                @for ($m = 1; $m <= 12; $m++)
                    @if ($m <= $max_month)
                        <td class="text-center">
                            {{ number_format($curriculum_stack_exam_report['n_pass_m_' . $m], 0) }}
                        </td>
                    @else
                        <td class="text-center">
                            -
                        </td>
                    @endif
                @endfor
            @endif
        </tr>
        <tr>
            <td>ไม่ผ่าน</td>
            @if ($curriculum_stack_exam_report)
                @for ($m = 1; $m <= 12; $m++)
                    @if ($m <= $max_month)
                        <td class="text-center">
                            {{ number_format($curriculum_stack_exam_report['n_no_pass_m_' . $m], 0) }}
                        </td>
                    @else
                        <td class="text-center">
                            -
                        </td>
                    @endif
                @endfor
            @endif
        </tr>
        <tr>
            <th>รวม</th>
            @if ($curriculum_stack_exam_report)
                @for ($m = 1; $m <= 12; $m++)
                    @if ($m <= $max_month)
                        <td class="text-center">
                            {{ number_format($curriculum_stack_exam_report['n_no_pass_m_' . $m] + $curriculum_stack_exam_report['n_pass_m_' . $m], 0) }}
                        </td>
                    @else
                        <td class="text-center">
                            -
                        </td>
                    @endif
                @endfor
            @endif
        </tr>
    </tbody>
</table>
