<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-chart-header text-white">
                <div class="graph_title">รายงานสถิติ ผู้ผ่านแบบทดสอบหลักสูตรที่ 1 โรคติดต่อในเด็กและโควิด 19<br>จำแนกรายเขตและจังหวัด ปี 2567</div>
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
                <div id="chart-monthly2" class="chartsh text_ver"></div>
            </div>
            <div class="table-responsive px-4">
                <table class="table table-bordered table-hover text-center table-style1">
                    <thead>
                        <tr>
                            <th colspan="12">
                                <div class="title-table">จำนวนผู้ผ่าน 
                                    @if($curriculum_id)
                                        {{ $curriculum->name }}
                                    @else
                                        ทุกหลักสูตร (คน) 
                                    @endif
                                    @if($exam_year)
                                        ปี {{$exam_year}}
                                    @endif                                    
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>จังหวัด</th>
                            <th>จำนวนผู้ทดสอบทั้งหมด</th>
                            <th>จำนวนผู้ที่ผ่าน</th>
                            <th>จำนวนผู้ที่ไม่ผ่าน</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($province_exam as $key=>$item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{ number_format($item->all_exam,0) }}</td>
                            <td>{{ number_format($item->all_pass_exam,0) }}</td>
                            <td>{{ number_format($item->all_not_pass_exam,0) }}</td>
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
    </div>
</div>