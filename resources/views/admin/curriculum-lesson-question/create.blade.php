@extends('layouts.app')

@section('title', 'หลักสูตร / บทเรียนในหลักสูตร / บททดสอบท้ายบทเรียน / เพิ่มรายการ')

@section('content')
    {!! Form::open([
        'route' => 'admin.curriculum-lesson-question.store',
        'method' => 'POST',
        'files' => true,
        'class' => 'form',
        'autocomplete' => 'off',
    ]) !!}
    @include('admin.curriculum-lesson-question.form')
    {!! Form::close() !!}
@endsection
