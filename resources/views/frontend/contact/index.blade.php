@extends('layouts.frontend')

@section('page', 'ติดต่อเรา')

@section('content')
    <!--====================================================
                    =                      CONTENT                         =
                    =====================================================-->
    <div class="container">
        <div class="row g-4 justify-content-between mb-5 wow fadeInDown">
            <div class="col-lg-6">
                <div class="box-contact">
                    <div class="title-send-us">ส่งข้อความถึงเรา</div>
                    {!! Form::open(['url' => 'contact.save', 'method' => 'post', 'class' => 'row g-3 my-4']) !!}

                    <div class="col-12 mb-3">
                        <label for="inputName" class="form-label">ชื่อ - สกุล<span class="text-danger ms-1">*</span></label>
                        <input type="text" class="form-control" placeholder="" aria-label="First name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputEmail4" class="form-label">อีเมล<span class="text-danger ms-1">*</span></label>
                        <input type="email" class="form-control" id="inputEmail4">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputPhonenumber" class="form-label">เบอร์โทรศัพท์</label>
                        <input type="" class="form-control" id="inputPhonenumber">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="validationTextarea" class="form-label">ข้อความ<span class="text-danger ms-1">*</span></label>
                        <textarea class="form-control" rows="6" id="validationTextarea" placeholder="" required></textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-red rounded-pill text-white fw-bold px-5 py-2">ส่งข้อความ</button>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
            <div class="col-lg-4">
                <img src="{{ asset('html/images/girl-contact.png') }}" alt="" class="img-fluid mx-auto d-block p-4 mt-5">
            </div>
        </div>
    </div>
    <!--=================== End Content =================-->
@endsection
