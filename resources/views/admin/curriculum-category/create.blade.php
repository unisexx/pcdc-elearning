@extends('layouts.app')

@section('title', 'หมวดหมู่หลักสูตร / เพิ่มรายการ')

@section('content')
    {!! Form::open([
        'route' => 'admin.curriculum-category.store',
        'method' => 'POST',
        'files' => true,
        'class' => 'form',
        'autocomplete' => 'off',
    ]) !!}
    @include('admin.curriculum-category.form')
    {!! Form::close() !!}
@endsection
