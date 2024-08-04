<table>
    <tr>
        <th>
            รายงานสถิติ ผู้ผ่านแบบทดสอบ
            @if ($curriculum)
                {{ $curriculum->name }}
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
            <th rowspan="2">จังหวัด</th>
            <th colspan="3">
                จำนวนผู้ผ่าน
                @if ($curriculum_id)
                    หลักสูตร {{ $curriculum->name }}
                @else
                    ทุกหลักสูตร (คน)
                @endif
                @if ($exam_year)
                    ปี {{ $exam_year }}
                @endif
            </th>
        </tr>
        <tr>
            <th>จำนวนผู้ทดสอบทั้งหมด</th>
            <th>จำนวนผู้ที่ผ่าน</th>
            <th>จำนวนผู้ที่ไม่ผ่าน</th>
        </tr>
    </thead>
    <tbody>
        @php
            $province_list_str = '';
            $province_pass_str = '';
        @endphp
        @forelse($province_exam as $key=>$item)
            @php
                $province_list_str .= $province_list_str ? ",'" . $item->name . "'" : "'" . $item->name . "'";
                $province_pass_str .= $province_pass_str
                    ? ',' . number_format($item->all_exam, 0)
                    : number_format($item->all_exam, 0);
            @endphp
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ number_format($item->all_exam, 0) }}</td>
                <td>{{ number_format($item->all_pass_exam, 0) }}</td>
                <td>{{ number_format($item->all_not_pass_exam, 0) }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">--ไม่มีข้อมูล--</td>
            </tr>
        @endempty
</tbody>
</table>
