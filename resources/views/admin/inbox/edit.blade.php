@extends('layouts.app')

@section('title', 'คำถามที่พบบ่อย')

@section('content')
    {!! Form::model($rs, [
        'method' => 'PATCH',
        'route' => ['admin.faq.update', $rs->id],
        'files' => true,
        'class' => 'form',
        'autocomplete' => 'off',
    ]) !!}
    @include('admin.faq.form')
    {!! Form::close() !!}
@endsection
