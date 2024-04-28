@extends('layouts.app')

@section('title', 'ข้อมูลติดต่อ')

@section('content')
    {!! Form::model($rs, [
        'method' => 'PATCH',
        'route' => ['admin.contact.update', $rs->id],
        'files' => true,
        'class' => 'form',
        'autocomplete' => 'off',
    ]) !!}
    @include('admin.contact.form')
    {!! Form::close() !!}
@endsection
