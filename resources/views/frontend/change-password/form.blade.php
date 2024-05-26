@extends('layouts.frontend')

@section('page', 'เปลี่ยนรหัสผ่าน')

@section('content')
    <div class="container">
        <div class="row g-4 justify-content-between mb-5 wow fadeInDown">
            <div class="col-lg-8 mx-auto">
                <div class="box-contact">
                    <div class="title-register text-center mb-3">เปลี่ยนรหัสผ่าน</div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {!! Form::model($rs, [
                        'method' => 'PUT',
                        'route' => ['change_password.update', $rs->id],
                        'class' => 'my-4 needs-validation register-form',
                        'novalidate',
                    ]) !!}

                    {{-- @include('frontend.register.inc._sec1_usertype') --}}
                    {{-- @include('frontend.register.inc._sec2_profile') --}}
                    @include('frontend.register.inc._sec3_login')

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
