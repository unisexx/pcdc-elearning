@extends('layouts.app')

@section('title', 'แบบสำรวจความพึงพอใจ')

@section('content')
    {!! Form::open([
        'route' => 'admin.survey.store',
        'method' => 'POST',
        'files' => true,
        'class' => 'form',
        'autocomplete' => 'off',
    ]) !!}
    @include('admin.survey.form')
    {!! Form::close() !!}
@endsection
