@extends('layouts.app')

@section('title', 'หมวดหมู่หลักสูตร / แก้ไขรายการ')

@section('content')
    {!! Form::model($rs, [
        'method' => 'PATCH',
        'route' => ['admin.curriculum-category.update', $rs->id],
        'files' => true,
        'class' => 'form',
        'autocomplete' => 'off',
    ]) !!}
    @include('admin.curriculum-category.form')
    {!! Form::close() !!}
@endsection
