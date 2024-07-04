@php
$max_month = (intval($exam_year)-543) == date('Y') ? date("m") : 12;

$stack_report_month_pass_str = "'data1'";
for($m=1;$m<=$max_month;$m++){
    $stack_report_month_pass_str.=",".$curriculum_stack_exam_report['n_pass_m_'.$m];
}

$stack_report_month_no_pass_str = "'data2'";
for($m=1;$m<=$max_month;$m++){
    $stack_report_month_no_pass_str .= ",".$curriculum_stack_exam_report['n_no_pass_m_'.$m];
}

@endphp
<div class="card">
    <div class="card-header bg-chart-header text-white">
        <div class="graph_title">รายงานสถิติ ผู้ทำแบบทดสอบ 
            @if($curriculum)
                หลักสูตร {{ $curriculum->name }}
            @else
                รวมทุกหลักสูตร
            @endif
            <br>เปรียบเทียบ ผู้ที่ผ่าน และ ไม่ผ่าน 
            {{ $text = !empty($exam_year) ? 'ปี '.$exam_year : '' }}
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
        <div id="chart-bar-stacked" class="chartsh"></div>
    </div>
    <div class="table-responsive px-4">
        <table class="table table-bordered table-hover text-center table-style1">
            <thead>
                <tr>
                    <th style="vertical-align: middle; " rowspan="2"></th>
                    <th colspan="12">
                        <div class="title-table">จำนวนผู้ผ่านและไม่ผ่าน 
                            @if($curriculum)
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
                    @if($curriculum_stack_exam_report)
                        @for($m=1;$m<=12;$m++)
                            @if($m<=$max_month)
                            <td class="text-center">
                                {{ number_format($curriculum_stack_exam_report['n_pass_m_'.$m],0) }}
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
                    @if($curriculum_stack_exam_report)
                        @for($m=1;$m<=12;$m++)
                            @if($m<=$max_month)
                            <td class="text-center">
                                {{ number_format($curriculum_stack_exam_report['n_no_pass_m_'.$m],0) }}
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
                    @if($curriculum_stack_exam_report)
                        @for($m=1;$m<=12;$m++)
                            @if($m<=$max_month)
                            <td class="text-center">
                                {{ number_format(($curriculum_stack_exam_report['n_no_pass_m_'.$m] + $curriculum_stack_exam_report['n_pass_m_'.$m]),0) }}
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
    </div>
</div>
@push('js')
<script>
    $(document).ready(function(){
        var chart = c3.generate({
            bindto: '#chart-bar-stacked', // id of chart wrapper
            data: {
                columns: [
                    // each columns data
                    [{!!$stack_report_month_pass_str!!}],
                    [{!!$stack_report_month_no_pass_str!!}]
                ],
                type: 'bar', // default type of chart
                groups: [
                    ['data1', 'data2']
                ],
                colors: {
                    data1: '#6c5ffc',
                    data2: '#05c3fb'
                },
                names: {
                    // name of each serie
                    'data1': 'ผ่าน',
                    'data2': 'ไม่ผ่าน'
                }
            },
            axis: {   
                x: {
                    type: 'category',
                    // name of each category
                    categories: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.']
                },
                y: {
                    min: 1,
                }
            },
            bar: {
                /*width: 16*/
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