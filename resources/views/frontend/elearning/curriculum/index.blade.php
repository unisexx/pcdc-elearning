@extends('layouts.elearning')

@section('page', 'บทนำ')

@section('content')
<div class="bg-1 h-100">
    <div class="d-flex justify-content-center title_welcome">ยินดีต้อนรับเข้าสู่บทเรียน</div>
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
  </div>
@endsection