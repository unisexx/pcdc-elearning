@extends('layouts.pdf')

@section('content')
    @php
        extract($data);
    @endphp

    @include('frontend.stat.inc.table1')
    <br><br>
    @include('frontend.stat.inc.table2')
    <br><br>
    @include('frontend.stat.inc.table3')
    <br><br>
    @include('frontend.stat.inc.table4')
@endsection
