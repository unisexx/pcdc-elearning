@extends('layouts.app')

@section('title', 'นโยบายคุกกี้')

@section('content')
    {!! Form::model($rs, [
        'method' => 'PATCH',
        'route' => ['admin.cookie-policy.update', $rs->id],
        'files' => true,
        'class' => 'form',
        'autocomplete' => 'off',
    ]) !!}
    @include('admin.cookie-policy.form')
    {!! Form::close() !!}
@endsection
