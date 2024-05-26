@extends('layouts.frontend')

@section('page', 'ติดต่อเรา')

@section('content')
    <div class="container">
        <div class="row g-4 justify-content-between mb-5 wow fadeInDown">
            <div class="col-lg-6">
                <div class="box-contact">
                    <div class="title-send-us">ส่งข้อความถึงเรา</div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {!! Form::open(['route' => 'contact.save', 'method' => 'post', 'class' => 'row g-3 my-4']) !!}

                    <div class="col-12 mb-3">
                        {!! Form::label('name', 'ชื่อ - สกุล', ['class' => 'form-label', 'for' => 'inputName']) !!}
                        <span class="text-danger ms-1">*</span>
                        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'inputName', 'placeholder' => '', 'aria-label' => 'First name', 'required' => 'required']) !!}
                    </div>
                    <div class="col-md-6 mb-3">
                        {!! Form::label('email', 'อีเมล', ['class' => 'form-label', 'for' => 'inputEmail4']) !!}
                        <span class="text-danger ms-1">*</span>
                        {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'inputEmail4', 'required' => 'required']) !!}
                    </div>
                    <div class="col-md-6 mb-3">
                        {!! Form::label('tel', 'เบอร์โทรศัพท์', ['class' => 'form-label', 'for' => 'inputPhonenumber']) !!}
                        {!! Form::text('tel', null, ['class' => 'form-control', 'id' => 'inputPhonenumber']) !!}
                    </div>
                    <div class="col-12 mb-3">
                        {!! Form::label('msg', 'ข้อความ', ['class' => 'form-label', 'for' => 'validationTextarea']) !!}
                        <span class="text-danger ms-1">*</span>
                        {!! Form::textarea('msg', null, ['class' => 'form-control', 'rows' => 6, 'id' => 'validationTextarea', 'placeholder' => '', 'required' => 'required']) !!}
                    </div>
                    <div class="col-12">
                        {!! Form::button('ส่งข้อความ', ['type' => 'submit', 'class' => 'btn btn-red rounded-pill text-white fw-bold px-5 py-2']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
            <div class="col-lg-4">
                <img src="{{ asset('html/images/girl-contact.png') }}" alt="" class="img-fluid mx-auto d-block p-4 mt-5">
            </div>
        </div>
    </div>
@endsection

@push('js')
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'สำเร็จ!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'ตกลง'
            });
        </script>
    @endif
@endpush
