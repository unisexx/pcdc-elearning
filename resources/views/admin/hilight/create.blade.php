@extends('layouts.app')

@section('title', 'ไฮไลท์')

@section('content')
    {!! Form::open([
        'route' => 'admin.hilight.store',
        'method' => 'POST',
        'files' => true,
        'class' => 'form',
        'autocomplete' => 'off',
    ]) !!}
    @include('admin.hilight.form')
    {!! Form::close() !!}
@endsection
