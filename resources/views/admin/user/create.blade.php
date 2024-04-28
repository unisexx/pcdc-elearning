@extends('layouts.app')

@section('title', 'ผู้ใช้งาน')

@section('content')
    {!! Form::open([
        'route' => 'admin.user.store',
        'method' => 'POST',
        'files' => true,
        'class' => 'form',
        'autocomplete' => 'off',
    ]) !!}
    @include('admin.user.form')
    {!! Form::close() !!}
@endsection
