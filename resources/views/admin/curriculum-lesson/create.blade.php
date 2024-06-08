@extends('layouts.app')

@section('title', 'หลักสูตร / บทเรียนในหลักสูตร / เพิ่มรายการ')

@section('content')
    {!! Form::open([
        'route' => 'admin.curriculum-lesson.store',
        'method' => 'POST',
        'files' => true,
        'class' => 'form',
        'autocomplete' => 'off',
    ]) !!}
    @include('admin.curriculum-lesson.form')
    {!! Form::close() !!}
@endsection
