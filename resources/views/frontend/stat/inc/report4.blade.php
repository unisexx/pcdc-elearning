<div class="col-lg-12 mb-3">
    <div class="card">
        <div class="card-header bg-chart-header text-white">
            <div class="graph_title">รายงานสถิติ ผู้ผ่านแบบทดสอบ
                @if ($curriculum)
                    {{ $curriculum->name }}
                @else
                    รวมทุกหลักสูตร
                @endif
                <br>จำแนกรายเขตและจังหวัด
                @if (!empty($exam_year))
                    ปี {{ $exam_year }}
                @endif
            </div>
        </div>
        <div class="card-body">
            {{-- <div class="d-flex justify-content-end">
                    <div class="dropdown show menu_print">
                        <a class="new option-dots" href="JavaScript:void(0);" data-bs-toggle="dropdown">
                            <span class=""><em class="fas fa-bars fs-5"></em></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="javascript:void(0)"><em class="fa fa-print fs-5 me-2"></em>
                                Print chart</a>
                            <hr>
                            <a class="dropdown-item" href="javascript:void(0)">Download PNG image</a>
                            <a class="dropdown-item" href="javascript:void(0)">Download JPEG image</a>
                            <a class="dropdown-item" href="javascript:void(0)">Download PDF document</a>
                            <a class="dropdown-item" href="javascript:void(0)">Download SVG vector image</a>
                            <hr>
                            <a class="dropdown-item" href="javascript:void(0)">Download CSV</a>
                            <a class="dropdown-item" href="javascript:void(0)">Download XLS</a>
                            <a class="dropdown-item" href="javascript:void(0)">View data table</a>
                        </div>
                    </div>
                </div> --}}
            {{-- <div id="chart-monthly22" class="chartsh text_ver"></div> --}}
            <div id="chart-monthly2" class="chartsh text_ver"></div>
        </div>
        <div class="table-responsive px-4">
            <table class="table table-bordered table-hover text-center table-style1">
                <thead>
                    <tr>
                        <th rowspan="2">จังหวัด</th>
                        <th colspan="3">
                            <div class="title-table">จำนวนผู้ผ่าน
                                @if ($curriculum_id)
                                    หลักสูตร {{ $curriculum->name }}
                                @else
                                    ทุกหลักสูตร (คน)
                                @endif
                                @if ($exam_year)
                                    ปี {{ $exam_year }}
                                @endif
                            </div>
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
                            $province_pass_str .= $province_pass_str ? ',' . number_format($item->all_exam, 0) : number_format($item->all_exam, 0);
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
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function() {
            var chart = c3.generate({
                bindto: '#chart-monthly2',
                data: {
                    x: 'x',
                    columns: [
                        ['x', {!! $province_list_str !!}],
                        ['ผ่าน', {!! $province_pass_str !!}],
                    ],
                    type: 'bar',
                },
                axis: {
                    x: {
                        type: 'category',
                        tick: {
                            rotate: 75,
                            multiline: false,
                        },
                        height: 130
                    },
                    y: {
                        min: 1,
                    }
                },
                bar: {
                    /*width: 6*/
                    width: {
                        ratio: 0.2
                    }
                },
                legend: {
                    show: false, //hide legend
                },
            });
        });
    </script>
@endpush
