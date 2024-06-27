@extends('layouts.elearning')

@section('page', $bread_crumb_name )

@section('content')
<div class="bg-1 h-100">
    <div class="d-flex justify-content-center title_welcome">{{ $bread_crumb_name }}</div>
    <fieldset class="my-5 border rounded-3 pt-5 px-3 position-relative">
      <legend class="tab_lesson_title w-auto rounded-pill">
        <img src="{{ asset("elearning/images/info2.svg") }}" alt="" height="35" class="me-2">
        {{ $curriculum->name }}
    </legend>
    {!!$curriculum->intro!!}    
    </fieldset>
    <fieldset class="my-5 border rounded-3 pt-5 px-3 position-relative">
        <legend class="tab_lesson_title w-auto rounded-pill">
            <img src="images/target-flag.svg" alt="" height="35" class="me-2">
            วัตถุประสงค์
        </legend>
        {!!$curriculum->objective!!}
    </fieldset>
    <fieldset class="my-5 border rounded-3 pt-5 px-3 position-relative">
        <legend class="tab_lesson_title w-auto rounded-pill">
            <img src="{{ asset("elearning/images/persent2.svg") }}" alt="" height="35" class="me-2">เกณฑ์
        </legend>
        {!! $curriculum->pass_criteria !!}
    </fieldset>
    <div class="col-12 text-center">
        {!! Form::open([
            'url' => url('elearning/curriculum/'.$curriculum->id.'/pretest/start'),
            'method' => 'POST',
            'files' => false,
            'class' => 'form',
            'autocomplete' => 'off',
        ]) !!}
        <button type="submit" class="btn btn-lg btn-primary">
            <em class="fa fa fa-pencil fs-5 me-2 icon_list_menu "></em>
            เริ่มทำแบบทดสอบ
        </button>
        {!! Form::close() !!}
        {!! Form::open([
            'url' => url('elearning/curriculum/'.$curriculum->id.'/pretest/restart'),
            'method' => 'POST',
            'files' => false,
            'class' => 'form',
            'autocomplete' => 'off',
        ]) !!}
        <button type="submit" class="btn btn-warning btn-lg">
            <em class="fa fa fa-rotate-right fs-5 me-2 icon_list_menu "></em>
            เริ่มทำใหม่อีกครั้ง
        </button>
        {!! Form::close() !!}
    </div>
</div>
@endsection