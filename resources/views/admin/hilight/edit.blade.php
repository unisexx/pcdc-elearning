@extends('layouts.app')

@section('title', 'ไฮไลท์')

@section('content')
    {!! Form::model($rs, [
        'method' => 'PATCH',
        'route' => ['admin.hilight.update', $rs->id],
        'files' => true,
        'class' => 'form',
        'autocomplete' => 'off',
    ]) !!}
    @include('admin.hilight.form')
    {!! Form::close() !!}
@endsection
