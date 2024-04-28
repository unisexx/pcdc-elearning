@extends('layouts.app')

@section('title', 'ผู้ใช้งาน')

@section('content')
    {!! Form::model($rs, [
        'method' => 'PATCH',
        'route' => ['admin.user.update', $rs->id],
        'files' => true,
        'class' => 'form',
        'autocomplete' => 'off',
    ]) !!}
    @include('admin.user.form')
    {!! Form::close() !!}
@endsection
