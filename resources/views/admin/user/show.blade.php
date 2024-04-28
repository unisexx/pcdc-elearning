@extends('layouts.app')

@section('title', 'ผู้ใช้งาน')

@section('content')
    {!! Form::model($rs, [
        'id' => 'myForm',
        'class' => 'form',
        'autocomplete' => 'off',
    ]) !!}
    @include('admin.user.form')
    {!! Form::close() !!}
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $("#myForm :submit, #myForm .delImgIcon").remove();
            $("#myForm :input").prop("disabled", true);
        });
    </script>
@endpush
