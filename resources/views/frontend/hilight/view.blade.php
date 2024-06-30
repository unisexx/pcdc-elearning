@extends('layouts.frontend')

@section('page', @$rs->title)

@section('content')
    <div class="container py-5 wow fadeInDown">
        <div class="title-content pb-3">{{ @$rs->title }}</div>
        <div class="page-content row my-4">
            {!! $rs->description !!}
        </div>
    </div>
@endsection
