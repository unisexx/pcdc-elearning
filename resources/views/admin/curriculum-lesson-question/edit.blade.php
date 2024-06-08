@extends('layouts.app')

@section('title', 'หลักสูตร / บทเรียนในหลักสูตร / แบบทดสอบท้ายบท / แก้ไขรายการ')

@section('content')
    {!! Form::model($rs, [
        'method' => 'PATCH',
        'route' => ['admin.curriculum-lesson-question.update', $rs->id],
        'files' => true,
        'class' => 'form',
        'autocomplete' => 'off',
    ]) !!}
    @include('admin.curriculum-lesson-question.form')
    {!! Form::close() !!}
@endsection
