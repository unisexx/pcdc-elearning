@extends('layouts.elearning')

@section('page', $bread_crumb_name )

@section('content')
@php    
    $question_no = empty(request('q')) ? $total_answer + 1 : request('q');
    $pwidth = $question_no / $total_question * 100;
@endphp
<div class="bg-1 h-100 wow fadeIn">
    <div class="d-flex justify-content-center title_welcome">
        {{ $bread_crumb_name }}
        <br>
        {{ $curriculum->name }}
        @if($user_curriculum_pp_exam->exam_type=='lesson')
        <br>
        {{ $current_question->curriculum_lesson_question->curriculum_lesson->name }}
        @endif
    </div>
    <hr>
    <div class="row">
        <div class="col-12 text-center">
            ท่านกำลังทำข้อสอบข้อที่ {{ $question_no }} จากทั้งหมด {{$total_question}} ข้อ
        </div>
        <div class="progress mb-3" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">        
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width: {{$pwidth}}%">{{$question_no}}/{{$total_question}}</div>
        </div>    
    </div>
    <div class="row">
        <div class="col-12">
            {!! Form::open([
                'url' => url('elearning/'.$user_curriculum_pp_exam->id.'/exam/save'),
                'method' => 'POST',
                'files' => false,
                'class' => 'form',
                'autocomplete' => 'off',
                'class' => 'needs-validation',
            ]) !!}
            <div class="row g-3 justify-content-center" id="invalidCheck">
                <div class="col-lg-9">                    
                <div class="my-3" style="font-size:20px;">
                   <input type="hidden" name="current_question_id" value="{{$current_question->id}}">
                   <input type="hidden" name="question_no" value="{{ $question_no }}">
                   คำถามข้อที่ {{ $question_no }}
                </div>
                <div class="my-3" style="font-weight:bold!important;">{!! $current_question->curriculum_lesson_question->name !!}</div>
                <hr>
                    @foreach($current_question->curriculum_lesson_question->curriculum_lesson_question_answer()->get() as $answer)
                        <div class="form-check my-3" style="padding-left:60px!important;">                            
                            <label class="form-check-label label_answer">                                
                                @php
                                  $checked = $current_question->curriculum_lesson_question_answer_id == $answer->id ? 'checked="checked"' : '';
                                @endphp
                                <input class="form-check-input input_answer" type="radio" name="answer_id" value="{{$answer->id}}" {!! $checked !!}>                                                            
                                {!! $answer->name !!}                                
                            </label>
                            @if(in_array(\Auth::user()->email,['admin@admin.com', 'ultraauchz@gmail.com']) && $answer->score > 0)
                                <span style="color:#47a66c!important;">X</span>                                                                
                            @endif
                        </div>                
                    @endforeach
                    <!-- ส่วนแสดงข้อความแจ้งเตือน -->
                    <div class="invalid-feedback">
                        กรุณาเลือกคำตอบ 1 ข้อ
                    </div>
                </div>
            </div>            
                <hr class="mb-4">
            <div class="row">
                <div class="col-12">
                <div class="d-block d-lg-flex">
                    @if($question_no==1)
                      @php
                        $back_url = $user_curriculum_pp_exam->exam_type == 'lesson' ? url('elearning/curriculum/lesson-exam/'.$user_curriculum_pp_exam->curriculum_lesson_id) : url('elearning/curriculum/'.$user_curriculum_pp_exam->curriculum_id.'/'.$user_curriculum_pp_exam->exam_type);
                      @endphp
                      <div class="flex-grow-1">                    
                          <a class="btn btn-outline-secondary rounded-pill py-2 btn_prev_quiz" href="{{ $back_url }}">
                              <em class="fa fa-angle-left me-3"></em> ย้อนกลับ
                          </a>
                      </div>
                    @else
                      <div class="flex-grow-1">                    
                          <a class="btn btn-outline-secondary rounded-pill py-2 btn_prev_quiz" href="{{ url('elearning/'.$user_curriculum_pp_exam->id.'/exam?q='.($question_no-1))}}">
                              <em class="fa fa-angle-left me-3"></em> ข้อก่อนหน้า
                          </a>
                      </div>
                    @endif
                    {{-- <button class="btn btn-info rounded-pill py-2 btn_next_quiz" type="submit">
                    ข้อถัดไป<em class="fa fa-angle-right ms-3"></em>
                    </button> --}}
                    <button type="submit" class="btn btn-success rounded-pill py-2 btn_next_quiz btn_submit_answer">
                    ส่งคำตอบ<em class="fa fa-angle-right ms-3"></em>
                    </button>
                </div>
                </div>
            </div>
            {!! Form::close() !!}      
        </div>  
    </div>
</div>
@endsection
@push('js')
<script>
  // Validation form submissions if there are invalid fields
  (() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {        
            if (!form.checkValidity()) {              
              event.preventDefault()
              event.stopPropagation()              
            } else {
              // Custom validation for single checkbox selection
              const checkboxes = form.querySelectorAll('.form-check-input')
              let checkedCount = 0
              checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                  checkedCount++
                }
              })
              if (checkedCount !== 1) {
                event.preventDefault()
                event.stopPropagation()
                form.querySelector('.invalid-feedback').style.display = 'block'
              } else {
                form.querySelector('.invalid-feedback').style.display = 'none'
              }
            }
            form.classList.add('was-validated')
      }, false)
    })
  })()
</script>
@endpush