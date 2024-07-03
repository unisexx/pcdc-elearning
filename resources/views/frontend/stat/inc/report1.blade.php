<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-chart-header text-white">
                <div class="graph_title">รายงานสถิติ จำนวนผู้ผ่านหลักสูตรต่างๆ ปี 2567</div>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-end">
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
                </div>
                <div id="chart-bar2" class="chartsh"></div>
                {{-- <div id="chart-bar12" class="chartsh"></div> --}}
            </div>
            <div class="table-responsive px-4">
                <table class="table table-bordered table-hover text-center table-style1">
                    <thead>
                        <tr>
                            <th style="vertical-align: middle; " rowspan="2"></th>
                            <th colspan="12">
                                <div class="title-table">จำนวนผู้ผ่านหลักสูตรต่างๆ (คน)</div>
                            </th>
                        </tr>
                        <tr>                            
                            @foreach($curriculum_month_pass_report as $key=>$item)                                
                                <th>{!! $item['name'] !!}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @php                            
                            $max_month = (intval($exam_year)-543) == date('Y') ? date("m") : 12;
                            $chart_curriculum_name_value_str ='';
                            $chart_curriculum_name_str_month = '';
                            $chart_curriculum_name_str = '';
                            // 'data1': 'หลักสูตรที่ 1 โรคติดต่อในเด็กและโควิด 19',
                        @endphp
                        @for($m=1;$m<=$max_month;$m++)
                        <tr>
                            <td>{{ get_month()[$m] }}</td>
                            @foreach($curriculum_month_pass_report as $key=>$item)
                                @php
                                    $chart_curriculum_name_str_month.= $chart_curriculum_name_str_month ? "'data".($key+1)."', ".number_format($item['n_pass_m_'.$m],0) : ", ".number_format($item['n_pass_m_'.$m],0);
                                @endphp
                                <th>{{ number_format($item['n_pass_m_'.$m],0) }}</th>
                            @endforeach  
                            @php
                                $chart_curriculum_name_value_str = '['.$chart_curriculum_name_str_month.'],';
                            @endphp                          
                        </tr>
                        @endfor                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
@push('js')
{{-- <script>
    $(document).ready(function(){
        var chart = c3.generate({
            bindto: '#chart-bar12', // id of chart wrapper
            data: {
                columns: [
                    // each columns data
                    // ['data1', 11, 8, 15, 18, 19, 17],
                    // ['data2', 50, 50, 15, 41, 59, 42],
                    // ['data3', 70, 40, 25, 22, 41, 22],
                    // ['data4', 20, 30, 35, 100, 20, 75],
                    {!! $chart_curriculum_name_value_str !!}                    
                ],
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
                names: {
                    // name of each serie
                    'data1': 'หลักสูตรที่ 1 โรคติดต่อในเด็กและโควิด 19',
                    'data2': 'หลักสูตรที่ 2 โรคติดเชื้อทางเดินหายใจจากเชื้อไวรัสอาร์เอสวี',
                    'data3': 'หลักสูตรที่ 3 โรคไข้หวัดใหญ่ในเด็ก',
                    'data4': 'หลักสูตรที่ 4 โรคมือเท้าปาก',
                
                }
            },
            axis: {
                x: {
                    type: 'category',
                    // name of each category
                    categories: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน']
                },
            },
            bar: {
                /*width: 10*/
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
</script> --}}
@endpush