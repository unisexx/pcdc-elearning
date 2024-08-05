@extends('layouts.frontend')

@section('page', 'ลืมรหัสผ่าน')

@section('content')
    <div class="container">
        <div class="row g-4 justify-content-between mb-5 wow fadeInDown">
            <div class="col-lg-6 mx-auto">
                <div class="box-contact">
                    <div class="title-register text-center mb-3">ลืมรหัสผ่าน</div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {!! Form::open(['url' => '/front/password/email', 'method' => 'post']) !!}

                    <fieldset id="loginSection" class="mb-4 mt-4 border rounded-3 p-3 p-lg-5 position-relative">
                        <legend class="title-form w-auto rounded-2">รีเซ็ตรหัสผ่าน</legend>
                        <div class="row g-3 pt-4">
                            <div class="col-md-12">
                                {!! Form::label('email', 'กรุณากรอกอีเมล', ['class' => 'form-label']) !!}
                                <span class="text-danger ms-1">*</span>
                                {!! Form::email('email', null, ['class' => 'form-control form-control-lg', 'id' => 'email', 'required']) !!}
                                <div class="invalid-feedback">
                                    กรุณากรอกอีเมล
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <div class="col-12 mt-4 text-center">
                        <button class="btn btn-primary btn-lg px-5" type="submit">ยืนยัน</button>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        fieldset {
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1),
                0 4px 6px rgba(0, 0, 0, 0.08);
        }
    </style>
@endpush

@include('frontend.register.inc._regis_form_js')
