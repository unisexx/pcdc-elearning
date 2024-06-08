@extends('layouts.app')

@section('title', 'หลักสูตร')

@section('content')
    {!! Form::model($rs, [
        'method' => 'PATCH',
        'route' => ['admin.curriculum.update', $rs->id],
        'files' => true,
        'class' => 'form',
        'autocomplete' => 'off',
    ]) !!}
    @include('admin.curriculum.form')
    {!! Form::close() !!}
@endsection
