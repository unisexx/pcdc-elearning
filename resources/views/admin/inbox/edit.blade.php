@extends('layouts.app')

@section('title', 'คำถามที่พบบ่อย')

@section('content')
    {!! Form::model($rs, [
        'method' => 'PATCH',
        'route' => ['admin.inbox.update', $rs->id],
        'files' => true,
        'class' => 'form',
        'autocomplete' => 'off',
    ]) !!}
    @include('admin.inbox.form')
    {!! Form::close() !!}
@endsection
