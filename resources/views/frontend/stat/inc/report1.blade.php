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
    $chart_curriculum_name_array = [];
    $index = 0;
    foreach ($curriculum_month_pass_report as $key => $item) {
        $index++;
        // เก็บค่าลงในอาเรย์แทนการต่อสตริง
        $chart_curriculum_name_array['data' . $index] = $item['name'];
    }

    // แปลงอาเรย์เป็น JSON object ที่ถูกต้อง
    $chart_curriculum_name_str = json_encode($chart_curriculum_name_array, JSON_UNESCAPED_UNICODE);
    // echo $chart_curriculum_name_str.'<hr>';

    // ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน']
    $index = 0;
    $month_list = get_month();
    for ($m = 1; $m <= $max_month; $m++) {
        $chart_curriculum_name_str_month .= $m > 1 ? ',' : '';
        $chart_curriculum_name_str_month .= "'" . $month_list[$m] . "'";
    }
@endphp

<div class="col-lg-12 mb-3">
    <div class="card">
        <div class="card-header bg-chart-header text-white">
            <div class="graph_title">รายงานสถิติ จำนวนผู้ผ่านหลักสูตรต่างๆ
                @if (!empty($exam_year))
                    ปี {{ $exam_year }}
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end">
                {{-- <div class="dropdown show menu_print">
                        <a class="new option-dots" href="JavaScript:void(0);" data-bs-toggle="dropdown">
                            <span class=""><em class="fas fa-bars fs-5"></em></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="javascript:void(0)"><em class="fa fa-print fs-5 me-2"></em> Print chart</a>
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
                {{-- <div id="chart-bar2" class="chartsh"></div> --}}
                <div id="chart-table-1" class="chartsh"></div>
            </div>
            <div class="table-responsive px-4">
                <table class="table table-bordered table-hover text-center table-style1">
                    <thead>
                        <tr>
                            <th style="vertical-align: middle; " rowspan="3">เดือน</th>
                            <th colspan="{{ $ncol = count($curriculum_month_pass_report) == 0 ? 1 : count($curriculum_month_pass_report) }}">
                                <div class="title-table">จำนวนผู้ผ่านหลักสูตรต่างๆ (คน)</div>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="3">ครูผู้ดูแลเด็กในศูนย์เด็กเล็กและ<br>โรงเรียนอนุบาล</th>
                            <th colspan="4">ครูผู้ดูแลเด็กระดับประถมศึกษาปีที่ 1-6<br>ครูผู้ดูแลเด็กระดับมัธยมศึกษาปีที่ 1-3</th>
                            <th colspan="4">เจ้าหน้าที่สาธารณสุขและประชาชนทั่วไป</th>
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
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function() {
            var chart = c3.generate({
                bindto: '#chart-table-1', // id of chart wrapper
                data: {
                    columns: [{!! $chart_curriculum_name_value_str !!}],
                    type: 'bar', // default type of chart
                    colors: {
                        data1: '#f86e90',
                        data2: '#05c3fb',
                        data3: '#4cb140',
                        data4: '#009596',
                        data5: '#5752d1',
                        data6: '#ec7a08',
                        data7: '#ecc35c',
                        data8: '#2a64c5'
                    },
                    names: {!! $chart_curriculum_name_str !!}
                },
                axis: {
                    x: {
                        type: 'category',
                        categories: [{!! $chart_curriculum_name_str_month !!}]
                    },
                    y: {
                        min: 1,
                    }
                },
                bar: {
                    width: {
                        ratio: 0.5
                    }
                },
                legend: {
                    show: true, //hide legend
                },
                padding: {
                    bottom: 0,
                    top: 0
                },
            });
        });
    </script>
@endpush
