@extends('layouts.app')

@section('title', 'แบบสำรวจความพึงพอใจ')

@section('content')
    {!! Form::model($rs, [
        'method' => 'PATCH',
        'route' => ['admin.survey.update', $rs->id],
        'files' => true,
        'class' => 'form',
        'autocomplete' => 'off',
    ]) !!}
    @include('admin.survey.form')
    {!! Form::close() !!}
@endsection
