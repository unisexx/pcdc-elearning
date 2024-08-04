@php
    // 'data1', 11, 8, 35, 18, 19, 17, 33, 39, 48, 57, 39, 63
    $office_chart_value_str = "'data1'";
    foreach ($curriculum_office_report as $key => $item) {
        $office_chart_value_str .= ', ' . $item['n_pass'];
    }
    // categories: ['สคร.1', 'สคร.2', 'สคร.3', 'สคร.4', 'สคร.5', 'สคร.6', 'สคร.7', 'สคร.8', 'สคร.9', 'สคร.10', 'สคร.11', 'สคร.12', 'กทม.']
    $office_chart_name_str = '';
    foreach ($curriculum_office_report as $key => $item) {
        $office_chart_name_str .=
            $office_chart_name_str != '' ? ", '" . $item['name'] . "'" : "'" . $item['name'] . "'";
    }
@endphp
<table>
    <tr>
        <th>
            รายงานสถิติ ผู้ผ่านแบบทดสอบ
            @if ($curriculum)
                หลักสูตร {{ $curriculum->name }}
            @else
                รวมทุกหลักสูตร
            @endif
            <br>จำแนกรายเขตและจังหวัด
            @if (!empty($exam_year))
                ปี {{ $exam_year }}
            @endif
        </th>
    </tr>
</table>
<br>

<table border="1" cellspacing="2" cellpadding="5">
    <thead>
        <tr>
            <th style="vertical-align: middle; " rowspan="2"></th>
            <th colspan="12">
                จำนวนผู้ผ่าน @if ($curriculum)
                    หลักสูตร {{ $curriculum->name }}
                @else
                    รวมทุกหลักสูตร
                @endif (คน)</div>
            </th>
        </tr>
        <tr>
            @foreach ($curriculum_office_report as $key => $item)
                <th>{{ $item['name'] }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>ผ่าน</td>
            @foreach ($curriculum_office_report as $key => $item)
                <td>{{ number_format($item['n_pass'], 0) }}</td>
            @endforeach
        </tr>
    </tbody>
</table>
