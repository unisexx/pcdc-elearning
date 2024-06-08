@extends('layouts.app')

@section('title', 'หลักสูตร / บทเรียนในหลักสูตร / แก้ไขรายการ')

@section('content')
    {!! Form::model($rs, [
        'method' => 'PATCH',
        'route' => ['admin.curriculum-lesson.update', $rs->id],
        'files' => true,
        'class' => 'form',
        'autocomplete' => 'off',
    ]) !!}
    @include('admin.curriculum-lesson.form')
    {!! Form::close() !!}
@endsection
