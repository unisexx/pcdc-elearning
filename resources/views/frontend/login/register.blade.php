@extends('layouts.frontend')

@section('page', 'สมัครสมาชิก')

@section('content')
    <!--====================================================
        =                      CONTENT                         =
        =====================================================-->
    <div class="container">
        <div class="row g-4 justify-content-between mb-5 wow fadeInDown">
            <div class="col-lg-12">
                <div class="box-contact">
                    <div class="title-register text-center mb-3">สมัครสมาชิก</div>
                    <form class="my-4 needs-validation register-form" novalidate>
                        <fieldset class="mb-5 mt-4 border rounded-3 p-3 p-lg-5 position-relative">
                            <legend class="title-form w-auto rounded-2"><img src="images/user-group.svg" alt="" width="24">ข้อมูลผู้ใช้งาน</legend>
                            <div class="row g-3 pt-4">
                                <div class="col-md-4 col-lg-2">
                                    <label for="" class="form-label">ประเภทผู้ใช้งาน<span class="text-danger ms-1">*</span></label>
                                    <select class="form-select" id="" required>
                                        <option selected disabled value="">โปรดเลือก...</option>
                                        <option>เจ้าหน้าที่ศูนย์เด็กเล็ก</option>
                                        <option>เจ้าหน้าที่ครูโรงเรียน</option>
                                        <option>เจ้าหน้าที่สาธารณสุข</option>
                                        <option>บุคคลทั่วไป</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        กรุณาเลือกประเภทผู้ใช้งาน
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-2">
                                    <label for="validationCustom04" class="form-label">คำนำหน้า</label>
                                    <select class="form-select" id="validationCustom04">
                                        <option selected disabled value="">โปรดเลือก...</option>
                                        <option>นาย</option>
                                        <option>นาง</option>
                                        <option>นางสาว</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <label for="validationCustom01" class="form-label">ชื่อ<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" id="validationCustom01" value="" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        กรุณาระบุชื่อ
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <label for="validationCustom02" class="form-label">นามสกุล<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" id="validationCustom02" value="" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-2">
                                    <label for="validationCustom04" class="form-label">เพศ</label>
                                    <select class="form-select" id="validationCustom04" required>
                                        <option selected disabled value="">โปรดเลือก...</option>
                                        <option>ชาย</option>
                                        <option>หญิง</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        กรุณาเลือกเพศ
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="basic-url" class="form-label">อายุ</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" aria-label=" " maxlength="5">
                                            <span class="input-group-text">ปี</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-3">
                                    <label for="" class="form-label">ประเภทเจ้าหน้าที่</label>
                                    <select class="form-select" id="">
                                        <option selected disabled value="">โปรดเลือก...</option>
                                        <option>เจ้าหน้าที่ประจำเขต</option>
                                        <option>เจ้าหน้าที่ประจำจังหวัด</option>
                                        <option>เจ้าหน้าที่ประจำอำเภอ</option>
                                        <option>เจ้าหน้าที่ประจำตำบล</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-lg-3">
                                    <label for="" class="form-label">พื้นที่ เจ้าหน้าที่ประจำเขต</label>
                                    <select class="form-select" id="">
                                        <option selected disabled value="">โปรดเลือก...</option>
                                        <option value="ส่วนกลาง">ส่วนกลาง</option>
                                        <option value="สคร.1">สคร.1</option>
                                        <option value="สคร.2">สคร.2</option>
                                        <option value="สคร.3">สคร.3</option>
                                        <option value="สคร.4">สคร.4</option>
                                        <option value="สคร.5">สคร.5</option>
                                        <option value="สคร.6">สคร.6</option>
                                        <option value="สคร.7">สคร.7</option>
                                        <option value="สคร.8">สคร.8</option>
                                        <option value="สคร.9">สคร.9</option>
                                        <option value="สคร.10">สคร.10</option>
                                        <option value="สคร.11">สคร.11</option>
                                        <option value="สคร.12">สคร.12</option>
                                        <option value="สปคม.">สปคม.</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-label">ชื่อศูนย์เด็กเล็ก<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" id="" required>
                                    <div class="invalid-feedback">
                                        กรุณาระบุชื่อศูนย์เด็กเล็ก
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-label">ชื่อสถานศึกษา<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" id="" required>
                                    <div class="invalid-feedback">
                                        กรุณาระบุชื่อสถานศึกษา
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="" class="form-label">เลขที่<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" id="" required>
                                    <div class="invalid-feedback">
                                        กรุณากรอก เลขที่บ้าน
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="" class="form-label">หมู่<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" id="" required>
                                    <div class="invalid-feedback">
                                        กรุณาระบุ หมู่ที่
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="form-label">เบอร์ติดต่อศูนย์<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" id="" required>
                                    <div class="invalid-feedback">
                                        กรุณากรอก เบอร์ติดต่อศูนย์
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="form-label">เบอร์ติดต่อโรงเรียน<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" id="" required>
                                    <div class="invalid-feedback">
                                        กรุณากรอก เบอร์ติดต่อโรงเรียน
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="form-label">จังหวัด<span class="text-danger ms-1">*</span></label>
                                    <select class="form-select" id="" required>
                                        <option selected disabled value="">โปรดเลือก...</option>
                                        <option value="1">กระบี่</option>
                                        <option value="2">กรุงเทพมหานคร</option>
                                        <option value="3">กาญจนบุรี</option>
                                        <option value="4">กาฬสินธุ์</option>
                                        <option value="5">กำแพงเพชร</option>
                                        <option value="6">ขอนแก่น</option>
                                        <option value="7">จันทบุรี</option>
                                        <option value="8">ฉะเชิงเทรา</option>
                                        <option value="9">ชลบุรี</option>
                                        <option value="10">ชัยนาท</option>
                                        <option value="11">ชัยภูมิ</option>
                                        <option value="12">ชุมพร</option>
                                        <option value="15">ตรัง</option>
                                        <option value="16">ตราด</option>
                                        <option value="17">ตาก</option>
                                        <option value="18">นครนายก</option>
                                        <option value="19">นครปฐม</option>
                                        <option value="20">นครพนม</option>
                                        <option value="21">นครราชสีมา</option>
                                        <option value="22">นครศรีธรรมราช</option>
                                        <option value="23">นครสวรรค์</option>
                                        <option value="24">นนทบุรี</option>
                                        <option value="25">นราธิวาส</option>
                                        <option value="26">น่าน</option>
                                        <option value="27">บึงกาฬ</option>
                                        <option value="28">บุรีรัมย์</option>
                                        <option value="29">ปทุมธานี</option>
                                        <option value="30">ประจวบคีรีขันธ์</option>
                                        <option value="31">ปราจีนบุรี</option>
                                        <option value="32">ปัตตานี</option>
                                        <option value="34">พระนครศรีอยุธยา</option>
                                        <option value="33">พะเยา</option>
                                        <option value="35">พังงา</option>
                                        <option value="36">พัทลุง</option>
                                        <option value="37">พิจิตร</option>
                                        <option value="38">พิษณุโลก</option>
                                        <option value="42">ภูเก็ต</option>
                                        <option value="43">มหาสารคาม</option>
                                        <option value="44">มุกดาหาร</option>
                                        <option value="47">ยะลา</option>
                                        <option value="46">ยโสธร</option>
                                        <option value="49">ระนอง</option>
                                        <option value="50">ระยอง</option>
                                        <option value="51">ราชบุรี</option>
                                        <option value="48">ร้อยเอ็ด</option>
                                        <option value="52">ลพบุรี</option>
                                        <option value="53">ลำปาง</option>
                                        <option value="54">ลำพูน</option>
                                        <option value="56">ศรีสะเกษ</option>
                                        <option value="57">สกลนคร</option>
                                        <option value="58">สงขลา</option>
                                        <option value="59">สตูล</option>
                                        <option value="60">สมุทรปราการ</option>
                                        <option value="61">สมุทรสงคราม</option>
                                        <option value="62">สมุทรสาคร</option>
                                        <option value="64">สระบุรี</option>
                                        <option value="63">สระแก้ว</option>
                                        <option value="65">สิงห์บุรี</option>
                                        <option value="67">สุพรรณบุรี</option>
                                        <option value="68">สุราษฎร์ธานี</option>
                                        <option value="69">สุรินทร์</option>
                                        <option value="66">สุโขทัย</option>
                                        <option value="70">หนองคาย</option>
                                        <option value="71">หนองบัวลำภู</option>
                                        <option value="73">อำนาจเจริญ</option>
                                        <option value="74">อุดรธานี</option>
                                        <option value="75">อุตรดิตถ์</option>
                                        <option value="76">อุทัยธานี</option>
                                        <option value="77">อุบลราชธานี</option>
                                        <option value="72">อ่างทอง</option>
                                        <option value="13">เชียงราย</option>
                                        <option value="14">เชียงใหม่</option>
                                        <option value="39">เพชรบุรี</option>
                                        <option value="40">เพชรบูรณ์</option>
                                        <option value="55">เลย</option>
                                        <option value="41">แพร่</option>
                                        <option value="45">แม่ฮ่องสอน</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        กรุณาเลือกจังหวัด
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="form-label">เขต/อำเภอ<span class="text-danger ms-1">*</span></label>
                                    <select class="form-select" id="" required>
                                        <option selected disabled value="">โปรดเลือก...</option>
                                        <option value="">พญาไท</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        กรุณาเลือกเขต/อำเภอ
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="form-label">แขวง/ตำบล<span class="text-danger ms-1">*</span></label>
                                    <select class="form-select" id="" required>
                                        <option selected disabled value="">โปรดเลือก...</option>
                                        <option value="">พญาไท</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        กรุณาเลือกเขต/อำเภอ
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="form-label">รหัสไปรษณีย์<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" id="" required>
                                    <div class="invalid-feedback">
                                        กรุณากรอกรหัสไปรษณีย์
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-3">
                                    <label for="" class="form-label">สังกัด<span class="text-danger ms-1">*</span></label>
                                    <select class="form-select" id="" required>
                                        <option selected disabled value="">โปรดเลือก...</option>
                                        <option value="สพฐ.">สพฐ.</option>
                                        <option value="เทศบาล/ตำบล">เทศบาล/ตำบล</option>
                                        <option value="อบจ.">อบจ.</option>
                                        <option value="กทม.">กทม.</option>
                                        <option value="มหาวิทยาลัย">มหาวิทยาลัย</option>
                                        <option value="เอกชน">เอกชน</option>
                                        <option value="อื่นๆ">อื่นๆ</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        สังกัด
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="form-label">ตำแหน่ง<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" id="" required>
                                    <div class="invalid-feedback">
                                        กรุณาระบุตำแหน่งงาน
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-3">
                                    <label for="" class="form-label">ระดับการศึกษา</label>
                                    <select class="form-select" id="">
                                        <option selected disabled value="">โปรดเลือก...</option>
                                        <option value="ต่ำกว่าปริญญาตรี">ต่ำกว่าปริญญาตรี</option>
                                        <option value="ปริญญาตรีขึ้นไป">ปริญญาตรีขึ้นไป</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-lg-3">
                                    <label for="" class="form-label">เบอร์โทรศัพท์ *<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" id="" required>
                                    <div class="invalid-feedback">
                                        กรุณากรอกหมายเลขเบอร์โทรศัพท์
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-3">
                                    <label for="" class="form-label">อีเมล *<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" id="" required>
                                    <div class="invalid-feedback">
                                        กรุณากรอกอีเมล
                                    </div>
                                </div>
                            </div><!--.row -->
                        </fieldset>

                        <fieldset class="mb-4 mt-4 border rounded-3 p-3 p-lg-5 position-relative">
                            <legend class="title-form w-auto rounded-2"><img src="images/user-group.svg" alt="" width="24">ข้อมูลการเข้าใช้งาน</legend>
                            <div class="row g-3 pt-4">
                                <div class="col-md-4">
                                    <label for="validationServerUsername" class="form-label">ชื่อผู้ใช้งาน (Username)</label>
                                    <input type="text" class="form-control" id="" required>
                                    <div class="invalid-feedback">
                                        โปรดระบุชื่อผู้ใช้งาน Username
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="form-label">รหัสผ่าน</label>
                                    <input type="password" class="form-control" id="" required>
                                    <div class="invalid-feedback">
                                        โปรดกรอกรหัสผ่าน
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="form-label">ยืนยันรหัสผ่าน</label>
                                    <input type="password" class="form-control" id="" required>
                                    <div class="invalid-feedback">
                                        โปรดยืนยันรหัสผ่าน
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                                <label class="form-check-label" for="invalidCheck">
                                    ฉันยอมรับข้อกำหนดและเงื่อนไข
                                </label>
                                <div class="invalid-feedback">
                                    คุณยังไม่ได้ติ๊กเลือกยอมรับข้อกำหนดและเงื่อนไข
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4 text-center">
                            <button class="btn btn-primary btn-lg px-5" type="submit" data-bs-toggle="modal" data-bs-target="#modalSheet">สมัครสมาชิก</button>
                        </div>
                    </form>
                    <!-- Modal -->
                    <div class="modal fade" id="modalSheet" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                        <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                                        <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                                    </svg>
                                    <h5 class="text-success fs-4 pt-2">ระบบได้ทำการบันทึกข้อมูลเรียบร้อยแล้ว</h5>
                                </div>
                                <div class="modal-footer">
                                    <div class="mx-auto">
                                        <a type="button" class="btn btn-success2 rounded-pill text-white px-4 mx-2" data-bs-dismiss="modal">OK</a>
                                        <a href="index.html" type="" class="btn btn-outline-primary rounded-pill mx-2" value="">กลับหน้าแรก</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Modal-->
                </div>
            </div>

        </div>
    </div>
    <!--=================== End Content =================-->
@endsection
