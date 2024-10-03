@php
    // 'data1', 11, 8, 35, 18, 19, 17, 33, 39, 48, 57, 39, 63
    $office_chart_value_str = "'data1'";
    foreach ($curriculum_office_report as $key => $item) {
        $office_chart_value_str .= ', ' . $item['n_pass'];
    }
    // categories: ['สคร.1', 'สคร.2', 'สคร.3', 'สคร.4', 'สคร.5', 'สคร.6', 'สคร.7', 'สคร.8', 'สคร.9', 'สคร.10', 'สคร.11', 'สคร.12', 'กทม.']
    $office_chart_name_str = '';
    foreach ($curriculum_office_report as $key => $item) {
        $office_chart_name_str .= $office_chart_name_str != '' ? ", '" . $item['name'] . "'" : "'" . $item['name'] . "'";
    }
@endphp
<div class="col-lg-12 mb-3">
    <div class="card">
        <div class="card-header bg-chart-header text-white">
            <div class="graph_title">
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
            </div>
        </div>
        <div class="card-body">
            {{-- <div class="d-flex justify-content-end">
            <div class="dropdown show menu_print">
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
            {{-- <div id="chart-monthly" class="chartsh"></div> --}}
            <div id="chart-office-sum" class="chartsh"></div>
        </div>
        <div class="table-responsive px-4">
            <table class="table table-bordered table-hover text-center table-style1">
                <thead>
                    <tr>
                        <th style="vertical-align: middle; " rowspan="2"></th>
                        <th colspan="12">
                            <div class="title-table">จำนวนผู้ผ่าน @if ($curriculum)
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
        </div>
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function() {
            var chart = c3.generate({
                bindto: '#chart-office-sum', // id of chart wrapper
                data: {
                    columns: [
                        // each columns data
                        [{!! $office_chart_value_str !!}]
                    ],
                    type: 'bar', // default type of chart
                    colors: {
                        data1: '#6c5ffc'
                    },
                    names: {
                        // name of each serie
                        'data1': 'ผ่าน'
                    }
                },
                axis: {
                    x: {
                        type: 'category',
                        // name of each category
                        categories: [{!! $office_chart_name_str !!}]
                    },
                    y: {
                        min: 1,
                    }
                },
                bar: {
                    /*width: 30*/
                    width: {
                        ratio: 0.7
                    }
                },
                legend: {
                    show: false, //hide legend
                },
                padding: {
                    bottom: 0,
                    top: 0
                },
            });
        });
    </script>
@endpush
