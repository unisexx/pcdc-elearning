@extends('layouts.app')

@section('title', 'คำถามที่พบบ่อย')

@section('content')
    {!! Form::open([
        'route' => 'admin.inbox.store',
        'method' => 'POST',
        'files' => true,
        'class' => 'form',
        'autocomplete' => 'off',
    ]) !!}
    @include('admin.inbox.form')
    {!! Form::close() !!}
@endsection
