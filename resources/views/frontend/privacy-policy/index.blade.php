@extends('layouts.frontend')

@section('page', @$rs->title)

@section('content')
    <div class="container py-5 wow fadeInDown">
        <div class="row my-4">
            {!! @$rs->description !!}
        </div>
    </div>
@endsection
