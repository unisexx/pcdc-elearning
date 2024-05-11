@extends('layouts.app')

@section('title', 'นโยบายเว็บไซต์')

@section('content')
    {!! Form::model($rs, [
        'method' => 'PATCH',
        'route' => ['admin.website-policy.update', $rs->id],
        'files' => true,
        'class' => 'form',
        'autocomplete' => 'off',
    ]) !!}
    @include('admin.website-policy.form')
    {!! Form::close() !!}
@endsection
