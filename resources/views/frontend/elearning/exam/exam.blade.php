@extends('layouts.elearning')

@section('page', $bread_crumb_name )

@section('content')
@php
    $pwidth = ($total_answer + 1) / $total_question * 100;
@endphp
<div class="bg-1 h-100">
    <div class="d-flex justify-content-center title_welcome">{{ $bread_crumb_name }}</div>
    <hr>
    <div class="row">
        <div class="col-12 text-center">
            ท่านกำลังทำข้อสอบข้อที่ {{ $total_answer+1 }} จากทั้งหมด {{$total_question}} ข้อ
        </div>
        <div class="progress mb-3" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">        
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width: {{$pwidth}}%">{{$total_answer + 1}}/{{$total_question}}</div>
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
                <div class="my-3" style="font-size:20px;"> คำถามข้อที่ {{ $total_answer + 1 }}</div>
                <div class="my-3" style="font-weight:bold!important;">{!! $current_question->curriculum_lesson_question->name !!}</div>
                <hr>
                    @foreach($current_question->curriculum_lesson_question->curriculum_lesson_question_answer()->get() as $answer)
                        <div class="form-check my-3" style="padding-left:60px!important;">
                            <label class="form-check-label label_answer">
                                <input class="form-check-input input_answer" type="radio" name="answer_id" value="{{$answer->id}}">                            
                                {!! $answer->name !!}
                            </label>
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
                    <div class="flex-grow-1">
                    <button class="btn btn-outline-secondary rounded-pill py-2 btn_prev_quiz" type="button">
                        <em class="fa fa-angle-left me-3"></em> ข้อก่อนหน้า
                    </button>
                    </div>
                    <button class="btn btn-info rounded-pill py-2 btn_next_quiz" type="submit">
                    ข้อถัดไป<em class="fa fa-angle-right ms-3"></em>
                    </button>
                    <a href="lesson_pre_test_scores.html" class="btn btn-success rounded-pill py-2 btn_next_quiz" type="submit">
                    ส่งคำตอบ<em class="fa fa-angle-right ms-3"></em>
                    </a>
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