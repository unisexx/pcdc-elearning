@extends('layouts.frontend')

@section('page', 'คำถามที่พบบ่อย')

@section('content')
    <!--====================================================
                =                      CONTENT                         =
                =====================================================-->
    <div class="container">
        <div class="row g-4 justify-content-between mb-5 wow fadeInDown">
            <div class="col-lg-12">
                <div class="box-contact">

                    <form class="mb-4 needs-validation register-form">
                        <div class="row g-3 pt-4">
                            <div class="col-md-4 col-lg-4">
                                <label for="" class="form-label fs-5 text-primary">หลักสูตร</label>     
                                {!! Form::select(
                                    'curriculum_id',
                                    $curriculum_list,
                                    @$_GET['curriculum_id'],
                                    ['class' => 'form-select select2 form-control-lg', 'id' => 'user_type_id', 'placeholder' => '--ทั้งหมด--'],
                                ) !!}                                                                                          
                            </div>

                            <div class="col-12 col-md-3 pt-1">
                                <label for="" class="form-label">ประเภทของผู้ทดสอบ</label>
                                {!! Form::select(
                                    'user_type_id',
                                    $user_type,
                                    @$_GET['user_type_id'],
                                    ['class' => 'form-select select2 form-control-lg', 'id' => 'user_type_id', 'placeholder' => '--ทั้งหมด--'],
                                ) !!}                                   
                            </div>
                            <div class="col-12 col-sm-auto pt-1">
                                <label for="" class="form-label">ปี</label>
                                <select class="form-select" id="exam_year" name="exam_year">
                                    <option selected disabled value="">--ทั้งหมด--</option>
                                    @for($i=(date("Y")+543);$i>=$min_year;$i--)
                                    @php
                                        $selected = @$_GET['exam_year'] == $i ? 'selected="selected"' : '';
                                    @endphp
                                    <option value="{{ $i }}" {!! $selected !!}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="clearfix"></div>
                            <div class="fs-5 fw-medium text-primary">เขตพื้นที่</div>
                            <div class="col-12 col-sm-auto">
                                <label for="" class="form-label">เจ้าหน้าที่ประจำเขต</label>
                                {!! Form::select(
                                    'area_id',
                                    [
                                        '999' => 'ส่วนกลาง',
                                        '1' => 'สคร.1',
                                        '2' => 'สคร.2',
                                        '3' => 'สคร.3',
                                        '4' => 'สคร.4',
                                        '5' => 'สคร.5',
                                        '6' => 'สคร.6',
                                        '7' => 'สคร.7',
                                        '8' => 'สคร.8',
                                        '9' => 'สคร.9',
                                        '10' => 'สคร.10',
                                        '11' => 'สคร.11',
                                        '12' => 'สคร.12',
                                        '99' => 'สปคม.',
                                    ],
                                    @$_GET['area_id'],
                                    ['class' => 'form-select select2 form-control-lg', 'id' => 'area_id', 'placeholder' => '--ทั้งหมด--'],
                                ) !!}
                            </div>
                            <div class="col-auto">หรือ</div>
                            <div class="col-12 col-sm-3">
                                <label for="" class="form-label">จังหวัด</label>
                                {!! Form::select('province_id', $provinces, @$_GET['province_id'], ['id' => 'province_id', 'class' => 'form-select select2 form-control-lg', 'placeholder' => '--ทั้งหมด--']) !!}
                            </div>
                            <div class="col-12 col-sm-auto">
                                <label for="" class="form-label">เขต/อำเภอ</label>
                                {!! Form::select('district_id', $districts, @$_GET['district_id'], ['class' => 'form-select select2 form-control-lg', 'id' => 'district_id', 'placeholder' => '--ทั้งหมด--']) !!}
                            </div>
                            <div class="col-12 col-sm-auto">
                                <label for="" class="form-label">แขวง/ตำบล</label>
                                {!! Form::select('subdistrict_id', $subdistricts, @$_GET['subdistrict_id'], ['class' => 'form-select select2 form-control-lg', 'id' => 'subdistrict_id', 'placeholder' => '--ทั้งหมด--']) !!}
                            </div>
                            <div class="col-auto text-center d-flex flex-column-reverse">
                                <button class="btn btn-primary px-5" type="submit"><span class="fa fa-fw fa-search"></span> ค้นหา</button>
                            </div>
                        </div>

                    </form>

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
                                                <th>หลักสูตรที่ 1<br>โรคติดต่อในเด็กและโควิด 19</th>
                                                <th>หลักสูตรที่ 2<br>โรคติดเชื้อทางเดินหายใจจากเชื้อไวรัสอาร์เอสวี</th>
                                                <th>หลักสูตรที่ 3<br>โรคไข้หวัดใหญ่ในเด็ก</th>
                                                <th>หลักสูตรที่ 4<br>โรคมือเท้าปาก</th>
                                                <th>หลักสูตรที่ 5<br>โรคเฮอร์แปงไจน่า</th>
                                                <th>หลักสูตรที่ 6<br>โรคติดเชื้อไอพีดี</th>
                                                <th>หลักสูตรที่ 7<br>โรคท้องเสียจากการติดเชื้อโนโรไวรัส</th>
                                                <th>หลักสูตรที่ 8<br>โรคอีสุกอีใส</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>มกราคม</td>
                                                <td>11</td>
                                                <td>50</td>
                                                <td>70</td>
                                                <td>20</td>
                                                <td>40</td>
                                                <td>21</td>
                                                <td>8</td>
                                                <td>70</td>
                                            </tr>
                                            <tr>
                                                <td>กุมภาพันธ์</td>
                                                <td>8</td>
                                                <td>50</td>
                                                <td>40</td>
                                                <td>30</td>
                                                <td>20</td>
                                                <td>31</td>
                                                <td>12</td>
                                                <td>10</td>
                                            </tr>
                                            <tr>
                                                <td>มีนาคม</td>
                                                <td>15</td>
                                                <td>15</td>
                                                <td>25</td>
                                                <td>35</td>
                                                <td>55</td>
                                                <td>65</td>
                                                <td>60</td>
                                                <td>5</td>
                                            </tr>
                                            <tr>
                                                <td>เมษายน</td>
                                                <td>18</td>
                                                <td>41</td>
                                                <td>22</td>
                                                <td>100</td>
                                                <td>20</td>
                                                <td>30</td>
                                                <td>44</td>
                                                <td>17</td>
                                            </tr>
                                            <tr>
                                                <td>พฤษภาคม</td>
                                                <td>19</td>
                                                <td>59</td>
                                                <td>41</td>
                                                <td>20</td>
                                                <td>99</td>
                                                <td>40</td>
                                                <td>39</td>
                                                <td>29</td>
                                            </tr>
                                            <tr>
                                                <td>มิถุนายน</td>
                                                <td>17</td>
                                                <td>42</td>
                                                <td>22</td>
                                                <td>75</td>
                                                <td>30</td>
                                                <td>50</td>
                                                <td>12</td>
                                                <td>122</td>
                                            </tr>
                                            <tr>
                                                <th>รวม</th>
                                                <th>88</th>
                                                <th>257</th>
                                                <th>220</th>
                                                <th>280</th>
                                                <th>264</th>
                                                <th>237</th>
                                                <th>175</th>
                                                <th>253</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                    </div>

                    <!-- ROW-2 OPEN -->
                    <div class="row my-5">
                        <div class="col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-header bg-chart-header text-white">
                                    <div class="graph_title">รายงานสถิติ ผู้ทำแบบทดสอบหลักสูตรที่ 1 โรคติดต่อในเด็กและโควิด 19<br>เปรียบเทียบ ผู้ที่ผ่าน และ ไม่ผ่าน ปี 2567</div>
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
                                    <div id="chart-bar-stacked" class="chartsh"></div>
                                </div>
                                <div class="table-responsive px-4">
                                    <table class="table table-bordered table-hover text-center table-style1">
                                        <thead>
                                            <tr>
                                                <th style="vertical-align: middle; " rowspan="2"></th>
                                                <th colspan="12">
                                                    <div class="title-table">จำนวนผู้ผ่านและไม่ผ่าน หลักสูตรที่ 1 โรคติดต่อในเด็กและโควิด 19 (คน)</div>
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
                                                <td>11</td>
                                                <td>50</td>
                                                <td>70</td>
                                                <td>20</td>
                                                <td>40</td>
                                                <td>21</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <td>ไม่ผ่าน</td>
                                                <td>8</td>
                                                <td>50</td>
                                                <td>40</td>
                                                <td>30</td>
                                                <td>20</td>
                                                <td>31</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                            <tr>
                                                <th>รวม</th>
                                                <th>18</th>
                                                <th>100</th>
                                                <th>110</th>
                                                <th>50</th>
                                                <th>60</th>
                                                <th>52</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- COL-END -->
                        <div class="col-lg-6 col-md-12">
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
                                    <div id="chart-monthly" class="chartsh"></div>
                                </div>
                                <div class="table-responsive px-4">
                                    <table class="table table-bordered table-hover text-center table-style1">
                                        <thead>
                                            <tr>
                                                <th style="vertical-align: middle; " rowspan="2"></th>
                                                <th colspan="12">
                                                    <div class="title-table">จำนวนผู้ผ่าน หลักสูตรที่ 1 โรคติดต่อในเด็กและโควิด 19 (คน)</div>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>สคร.1</th>
                                                <th>สคร.2</th>
                                                <th>สคร.3</th>
                                                <th>สคร.4</th>
                                                <th>สคร.5</th>
                                                <th>สคร.6</th>
                                                <th>สคร.7</th>
                                                <th>สคร.8</th>
                                                <th>สคร.9</th>
                                                <th>สคร.10</th>
                                                <th>สคร.11</th>
                                                <th>สคร.12</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>ผ่าน</td>
                                                <td>11</td>
                                                <td>8</td>
                                                <td>35</td>
                                                <td>18</td>
                                                <td>19</td>
                                                <td>17</td>
                                                <td>33</td>
                                                <td>39</td>
                                                <td>48</td>
                                                <td>57</td>
                                                <td>39</td>
                                                <td>63</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- COL-END -->
                    </div>
                    <!-- ROW-2 CLOSED -->

                    <!-- ROW-3 OPEN -->
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
                                                    <div class="title-table">จำนวนผู้ผ่าน หลักสูตรที่ 1 โรคติดต่อในเด็กและโควิด 19 (คน) ปี 2567</div>
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
                                            <tr>
                                                <td>เชียงใหม่</td>
                                                <td>12</td>
                                                <td>10</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <td>เชียงราย</td>
                                                <td>22</td>
                                                <td>20</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <td>แพร่</td>
                                                <td>35</td>
                                                <td>34</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>แม่ฮ่องสอน</td>
                                                <td>41</td>
                                                <td>40</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>น่าน</td>
                                                <td>51</td>
                                                <td>50</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>พะเยา</td>
                                                <td>61</td>
                                                <td>60</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>ลำปาง</td>
                                                <td>71</td>
                                                <td>70</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>ลำพูน</td>
                                                <td>81</td>
                                                <td>80</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>เพชรบูรณ์</td>
                                                <td>95</td>
                                                <td>94</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>ตาก</td>
                                                <td>102</td>
                                                <td>100</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <td>พิษณุโลก</td>
                                                <td>12</td>
                                                <td>10</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <td>สุโขทัย</td>
                                                <td>22</td>
                                                <td>20</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <td>อุตรดิตถ์</td>
                                                <td>35</td>
                                                <td>34</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>กำแพงเพชร</td>
                                                <td>41</td>
                                                <td>40</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>ชัยนาท</td>
                                                <td>51</td>
                                                <td>50</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>นครสวรรค์</td>
                                                <td>61</td>
                                                <td>60</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>พิจิตร</td>
                                                <td>71</td>
                                                <td>70</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>อุทัยธานี</td>
                                                <td>81</td>
                                                <td>80</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>นครนายก</td>
                                                <td>95</td>
                                                <td>94</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>นนทบุรี</td>
                                                <td>102</td>
                                                <td>100</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <td>ปทุมธานี</td>
                                                <td>12</td>
                                                <td>10</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <td>พระนครศรีอยุธยา</td>
                                                <td>22</td>
                                                <td>20</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <td>ลพบุรี</td>
                                                <td>35</td>
                                                <td>34</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>สระบุรี</td>
                                                <td>41</td>
                                                <td>40</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>สิงห์บุรี</td>
                                                <td>51</td>
                                                <td>50</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>อ่างทอง</td>
                                                <td>61</td>
                                                <td>60</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>เพชรบุรี</td>
                                                <td>71</td>
                                                <td>70</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>กาญจนบุรี</td>
                                                <td>81</td>
                                                <td>80</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>นครปฐม</td>
                                                <td>95</td>
                                                <td>94</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>ประจวบคีรีขันธ์</td>
                                                <td>102</td>
                                                <td>100</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <td>ราชบุรี</td>
                                                <td>12</td>
                                                <td>10</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <td>สมุทรสงคราม</td>
                                                <td>22</td>
                                                <td>20</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <td>สมุทรสาคร</td>
                                                <td>35</td>
                                                <td>34</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>สุพรรณบุรี</td>
                                                <td>41</td>
                                                <td>40</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>จันทบุรี</td>
                                                <td>51</td>
                                                <td>50</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>ฉะเชิงเทรา</td>
                                                <td>61</td>
                                                <td>60</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>ชลบุรี</td>
                                                <td>71</td>
                                                <td>70</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>ตราด</td>
                                                <td>81</td>
                                                <td>80</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>ปราจีนบุรี</td>
                                                <td>95</td>
                                                <td>94</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>ระยอง</td>
                                                <td>102</td>
                                                <td>100</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <td>สมุทรปราการ</td>
                                                <td>12</td>
                                                <td>10</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <td>สระแก้ว</td>
                                                <td>22</td>
                                                <td>20</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <td>กาฬสินธุ์</td>
                                                <td>35</td>
                                                <td>34</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>ขอนแก่น</td>
                                                <td>41</td>
                                                <td>40</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>มหาสารคาม</td>
                                                <td>51</td>
                                                <td>50</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>ร้อยเอ็ด</td>
                                                <td>61</td>
                                                <td>60</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>เลย</td>
                                                <td>71</td>
                                                <td>70</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>นครพนม</td>
                                                <td>81</td>
                                                <td>80</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>บึงกาฬ</td>
                                                <td>95</td>
                                                <td>94</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>สกลนคร</td>
                                                <td>102</td>
                                                <td>100</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <td>หนองคาย</td>
                                                <td>12</td>
                                                <td>10</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <td>หนองบัวลำภู</td>
                                                <td>22</td>
                                                <td>20</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <td>อุดรธานี</td>
                                                <td>35</td>
                                                <td>34</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>ชัยภูมิ</td>
                                                <td>41</td>
                                                <td>40</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>นครราชสีมา</td>
                                                <td>51</td>
                                                <td>50</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>บุรีรัมย์</td>
                                                <td>61</td>
                                                <td>60</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>สุรินทร์</td>
                                                <td>71</td>
                                                <td>70</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>มุกดาหาร</td>
                                                <td>81</td>
                                                <td>80</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>ยโสธร</td>
                                                <td>95</td>
                                                <td>94</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>ศรีสะเกษ</td>
                                                <td>102</td>
                                                <td>100</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <td>อำนาจเจริญ</td>
                                                <td>12</td>
                                                <td>10</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <td>อุบลราชธานี</td>
                                                <td>22</td>
                                                <td>20</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <td>กระบี่</td>
                                                <td>35</td>
                                                <td>34</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>ชุมพร</td>
                                                <td>41</td>
                                                <td>40</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>นครศรีธรรมราช</td>
                                                <td>51</td>
                                                <td>50</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>พังงา</td>
                                                <td>61</td>
                                                <td>60</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>ภูเก็ต</td>
                                                <td>71</td>
                                                <td>70</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>ระนอง</td>
                                                <td>81</td>
                                                <td>80</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>สุราษฎร์ธานี</td>
                                                <td>95</td>
                                                <td>94</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>ตรัง</td>
                                                <td>102</td>
                                                <td>100</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <td>นราธิวาส</td>
                                                <td>12</td>
                                                <td>10</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <td>ปัตตานี</td>
                                                <td>22</td>
                                                <td>20</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <td>พัทลุง</td>
                                                <td>35</td>
                                                <td>34</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>ยะลา</td>
                                                <td>41</td>
                                                <td>40</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>สงขลา</td>
                                                <td>51</td>
                                                <td>50</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>สตูล</td>
                                                <td>61</td>
                                                <td>60</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>กรุงเทพมหานคร</td>
                                                <td>71</td>
                                                <td>70</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <th>รวม</th>
                                                <th>4,290</th>
                                                <th>4,190</th>
                                                <th>100</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ROW-3 CLOSED -->

                </div>
            </div>

        </div>
    </div>
    <!--=================== End Content =================-->
@endsection

@push('css')
    <!-- Styles chart -->
    <link href="{{ asset('html/css/chart.css') }}" rel="stylesheet">
@endpush

@push('js')
    <!-- C3 CHART JS -->
    <script src="{{ asset('html/js/charts-c3/d3.v5.min.js') }}"></script>
    <script src="{{ asset('html/js/charts-c3/c3-chart.js') }}"></script>
    <!-- Chart -->
    <script src="{{ asset('html/js/charts.js') }}"></script>
@endpush
