@extends('layouts.app')

@section('title', 'นโยบายการคุ้มครองข้อมูลส่วนบุคคล')

@section('content')
    {!! Form::model($rs, [
        'method' => 'PATCH',
        'route' => ['admin.privacy-policy.update', $rs->id],
        'files' => true,
        'class' => 'form',
        'autocomplete' => 'off',
    ]) !!}
    @include('admin.privacy-policy.form')
    {!! Form::close() !!}
@endsection
