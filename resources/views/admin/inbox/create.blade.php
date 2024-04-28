@extends('layouts.app')

@section('title', 'คำถามที่พบบ่อย')

@section('content')
    {!! Form::open([
        'route' => 'admin.faq.store',
        'method' => 'POST',
        'files' => true,
        'class' => 'form',
        'autocomplete' => 'off',
    ]) !!}
    @include('admin.faq.form')
    {!! Form::close() !!}
@endsection
