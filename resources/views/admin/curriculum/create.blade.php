@extends('layouts.app')

@section('title', 'หลักสูตร')

@section('content')
    {!! Form::open([
        'route' => 'admin.curriculum.store',
        'method' => 'POST',
        'files' => true,
        'class' => 'form',
        'autocomplete' => 'off',
    ]) !!}
    @include('admin.curriculum.form')
    {!! Form::close() !!}
@endsection
