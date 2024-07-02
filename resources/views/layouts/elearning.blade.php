<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ config('app.name', 'e-learning โรคติดต่อในเด็กและโควิด 19') }}">
    <meta name="author" content="{{ config('app.name', 'e-learning โรคติดต่อในเด็กและโควิด 19') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'e-learning โรคติดต่อในเด็กและโควิด 19') }}</title>

    <!-- FAVICON -->
    <link rel="icon" href="{{ asset('html/images/favicon.svg') }}" type="image/x-icon" />
    
    <link href="{{ asset("elearning/css/bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset("elearning/css/animate.css") }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset("elearning/css/all.min.css") }}" />
    
    <!-- Styles for this template -->
    <link href="{{ asset("elearning/css/style.css") }}" rel="stylesheet">
    <link href="{{ asset("elearning/css/custom.css") }}" rel="stylesheet">
    @stack('css')
</head>

<body>
    @include('layouts.elearning.header')
    
<main>
    <!-- /.container breadcrumb-->
    <div class="container-fluid mt-4 pt-2">
        <nav class="breadcrumb-line" aria-label="breadcrumb">
          <ol class="breadcrumb justify-content-end mb-3">
            <li class="breadcrumb-item">
                <a href="{{ url('/home')}}">
                    <em class="fa fa-home-alt fs-6 me-2"></em>หน้าแรก
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('elearning/curriculum/'.$curriculum->id)}}">
                    {{$curriculum->name}}
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">@yield('page')</li>
          </ol>
        </nav>
    </div>
    <!-- /.container breadcrumb-->

<!--====================================================
=                      CONTENT                         =
=====================================================-->
<div class="container-fluid">

<!-- ##### START tabs ##### -->
<div class="tab_lesson">
    <!--##### Nav tabs #####-->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item mt-2" role="presentation">
        <a class="nav-link active" id="lesson-tab" data-bs-toggle="tab" data-bs-target="#lesson-tab-pane" type="button" role="tab" aria-controls="lesson-tab-pane" aria-selected="false">บทเรียน</a>
      </li>
      <li class="nav-item mt-2" role="presentation">
        <a class="nav-link" id="academic_results-tab" data-bs-toggle="tab" data-bs-target="#academic_results-tab-pane" type="button" role="tab" aria-controls="academic_results-tab-pane" aria-selected="false">ผลการเรียน</a>
      </li>
    </ul>

    <!--##### Tab content ####-->
    <div class="tab-content" id="myTabContent">
        <!-- Start Tab-content 1-->
        <div class="tab-pane fade active show" id="lesson-tab-pane" role="tabpanel" aria-labelledby="lesson-tab" tabindex="0">
          <div class="row bg-white rounded-5 p-3">
            <div class="col-lg-8">
                @yield('content')
            </div>
            <div class="col-lg-4">
              <div class="widget_block sticky-top sticky-offset vh-100 overflow-auto scrollable-element1">
                <div class="list_menu">{{ $curriculum->name }}</div>
                <hr>
                <div class="list_menu">สารบัญ</div>
                <div class="widget_categories">
                  <ul>
                    <li>
                      <div class="pass_score">
                          <a href="{{ url('elearning/curriculum/'.$curriculum->id) }}" class="d-flex align-items-center">
                              <em class="fa fa-home fs-5 me-2 icon_list_menu"></em> บทนำ
                              <img src="{{ asset('images/checked.png') }}" width="24" class="ms-auto">
                          </a>
                      </div>
                    </li>
                    @if(!empty($curriculum->curriculum_exam_setting))
                      @if($curriculum->curriculum_exam_setting->pre_test_status == 'active')
                        <li>
                          <div class="pass_score">
                            <a href="{{ url('elearning/curriculum/'.$curriculum->id.'/pretest') }}"><em class="fa fa fa-pencil fs-5 me-2 icon_list_menu "></em>ทำแบบทดสอบก่อนเรียน (pre-Test)</a>
                          </div>
                        </li>
                      @endif
                    @endif
                    <hr>
                    <div class="list_menu">เรียนรู้บทเรียน (Learning)</div>                
                    @php
                      $pretest_exam = \App\Models\UserCurriculumPpExam::where('user_id',\Auth::user()->id)->where('curriculum_id',$curriculum->id)->where('exam_type','pretest')->whereRaw('n_question = total_question')->count();                                        
                      $pretest_exam = $curriculum->curriculum_exam_setting->pre_test_status == 'inactive' ? 1 : $pretest_exam;
                      $all_pass = false;
                    @endphp
                    @foreach($curriculum->curriculum_lesson()->where('status','active')->orderBy('pos','asc')->get() as $key=>$lesson)
                      @php
                        //มีการทำแบบทดสอบผ่านแล้วหรือไม่
                        $exam_lesson[$key] = \App\Models\UserCurriculumPpExam::where('user_id',\Auth::user()->id)->where('curriculum_id',$curriculum->id)->where('curriculum_lesson_id',$lesson->id)->where('exam_type','lesson')->whereRaw('total_score >= pass_score and n_question = total_question')->count();                                        
                        
                        //เปิดให้ทดสอบหรือไม่
                        $lesson_has_exam[$key] = $curriculum->curriculum_exam_setting->curriculum_exam_setting_detail()->where('curriculum_lesson_id',$lesson->id)->where('exam_status','active')->count();
                        
                        if(empty($curriculum->curriculum_exam_setting) && $key == 0){                          
                            $can_action = 1;
                            $lesson_name[$key] = $lesson->name;
                        }else{                          
                          if($key==0){
                            $exam_lesson[$key] =  $exam_lesson[$key];
                            $lesson_name[$key] =  $lesson->name;
                            $can_action = $pretest_exam;
                          }else{
                              if($lesson_has_exam[$key-1] > 0){
                                  if($exam_lesson[$key-1])
                                    $can_action = 1;
                                  else
                                    $can_action = 0;
                              }

                              $exam_lesson[$key] = $lesson_has_exam[$key] == 0 ? $exam_lesson[$key-1] : $exam_lesson[$key];
                              $lesson_name[$key] = $lesson_has_exam[$key] == 0 ? $lesson_name[$key-1] : $lesson->name;                                                        
                          }
                          
                        }
                        
                        if($lesson_has_exam[$key] > 0){
                            $all_pass = empty($exam_lesson[$key]) || $exam_lesson[$key] == 0 ? false : true;
                        }
                        
                        $alert_msg_html = $key == 0 ? 'กรุณาทำ "<span style="color:blue;">แบบทดสอบก่อนเรียน</span>"<br>ก่อนเริ่มทำการเรียนรู้เนื้อหาในหลักสูตร'
                                            : 'กรุณาทำแบบทดสอบท้ายบท <br>"<span style="color:blue;">'.$lesson_name[$key-1].'</span>"<br><span style="color:green;">ให้ผ่าน</span><br>ก่อนเริ่มทำการเรียนรู้เนื้อหา/หรือทำแบบทดสอบท้ายบท';
                        // $alert_msg_html = $key == 0 ? 'กรุณาทำแบบทดสอบก่อนเรียน<br>ก่อนเริ่มทำการเรียนรู้เนื้อหาในหลักสูตร <a href="'.url('elearning/curriculum/'.$curriculum->id.'/pretest').'" class="btn btn-primary">ไปทำแบบทดสอบก่อนเรียน (Pre-Test)</a>'
                        //                     : 'กรุณาทำแบบทดสอบท้ายบท "'.$lesson_name[$key-1].'"<br>ก่อนเริ่มทำการเรียนรู้เนื้อหา/หรือทำแบบทดสอบท้ายบท <a href="'.url('elearning/curriculum/lesson-exam/'.$lesson->id).'" class="btn btn-primary">ไปทำแบบทดสอบท้ายบท "'.$lesson_name[$key-1].'"</a>';
                      @endphp                    
                      @if($can_action == 1)
                        <li>
                            <div class="pass_score">
                                <a href="{{ url("elearning/curriculum/lesson/".$lesson->id) }}">
                                    <em class="fa fa-arrow-alt-circle-right fs-5 me-2 icon_list_menu "></em>
                                    {{ $lesson->name }}
                                </a>
                            </div>
                        </li>
                      @else
                        <li>
                          <div class="none_score">
                              <a href="#" id="btn_do_lesson_{{ $lesson->id }}" class="d-flex align-items-center">
                                  <em class="fa fa-arrow-alt-circle-right fs-5 me-2 icon_list_menu"></em>{{ $lesson->name }}
                                  <img src="{{ asset('images/lock.png') }}" width="24" class="ms-auto">
                              </a>
                              <script>
                                  document.getElementById('btn_do_lesson_{{ $lesson->id }}').addEventListener('click', function() {
                                      Swal.fire({
                                          title: 'แจ้งเตือนการใช้งาน',
                                          html: '{!! $alert_msg_html !!}',
                                          showConfirmButton: true,                                        
                                      });
                                  });
                              </script>
                          </div>
                        </li>
                      @endif
                      @php
                            
                      @endphp
                      @if($lesson_has_exam[$key] > 0)
                          @if($can_action == 1)
                            <li style="/* padding-left:30px; */">
                                <div class="pass_score">
                                    <a href="{{ url('elearning/curriculum/lesson-exam/'.$lesson->id)}}">
                                        <em class="fa fa fa-pencil fs-5 me-2 icon_list_menu "></em>
                                        ทำแบบทดสอบท้ายบท                         
                                    </a>
                                </div>
                            </li>
                          @else
                            <li style="/* padding-left:30px; */">
                              <div class="none_score">
                                  <a id="btn_do_test_{{$lesson->id}}" href="#" class="d-flex align-items-center">
                                      <em class="fa fa fa-pencil fs-5 me-2 icon_list_menu"></em>
                                      ทำแบบทดสอบท้ายบท 
                                      <img src="{{ asset('images/lock.png') }}" width="24" class="ms-auto">
                                  </a>
                                  <script>
                                      document.getElementById('btn_do_test_{{$lesson->id}}').addEventListener('click', function() {
                                          Swal.fire({
                                              title: 'แจ้งเตือนการใช้งาน',
                                              html: '{!! $alert_msg_html !!}',
                                              showConfirmButton: true,                                        
                                          });
                                      });
                                  </script>
                              </div>
                            </li>
                          @endif
                      @endif                                                                               
                    @endforeach
                    <hr>  
                    @if(!empty($curriculum->curriculum_exam_setting))              
                      @if($curriculum->curriculum_exam_setting->pre_test_status == 'active')
                          @if($curriculum->curriculum_exam_setting->pre_test_status == 'active')
                            @php
                                $can_post_exam = $curriculum->curriculum_exam_setting->post_test_after_pre == 'active' ? $pretest_exam : $all_pass;
                                $alert_msg_html = $curriculum->curriculum_exam_setting->post_test_after_pre == 'active' ? 
                                                'กรุณาทำ "<span style="color:blue;">แบบทดสอบก่อนเรียน (Pre-test)</span>"<br>ก่อนเริ่มทำวัดผลหลังเรียนรู้ (Post-test)' :
                                                'กรุณาทำ "<span style="color:blue;">ทำแบบทดสอบท้ายบทเรียนให้ผ่านทั้งหมด</span>"<br>ก่อนเริ่มทำวัดผลหลังเรียนรู้ (Post-test)';
                            @endphp
                            @if($can_post_exam == 1)
                            <li>
                              <div class="pass_score">
                                <a href="{{ url('elearning/curriculum/'.$curriculum->id.'/posttest') }}"><em class="fas fa-graduation-cap fs-5 me-2 icon_list_menu "></em>วัดผลหลังเรียนรู้ (Post-test)</a>
                              </div>
                            </li>
                            @else
                            <li style="/* padding-left:30px; */">
                              <div class="none_score">
                                  <a id="btn_do_posttest" href="#" class="d-flex align-items-center">
                                      <em class="fas fa-graduation-cap fs-5 me-2 icon_list_menu"></em>
                                      วัดผลหลังเรียนรู้ (Post-test)
                                      <img src="{{ asset('images/lock.png') }}" width="24" class="ms-auto">
                                  </a>
                                  <script>
                                      document.getElementById('btn_do_posttest').addEventListener('click', function() {
                                          Swal.fire({
                                              title: 'แจ้งเตือนการใช้งาน',
                                              html: '{!! $alert_msg_html !!}',
                                              showConfirmButton: true,                                        
                                          });
                                      });
                                  </script>
                              </div>
                            </li>
                            @endif
                          @endif        
                      @endif        
                    @endif
                  </ul>
                </div>

              </div>
            </div>
          </div>
        </div>
        <!-- End tab-content 1 -->

        <!-- Start Tab-content 2-->
        <div class="tab-pane fade " id="academic_results-tab-pane" role="tabpanel" aria-labelledby="academic_results-tab" tabindex="0">
          <div class="container">
            <div class="title_disease">ผลการเรียน</div>
            <hr>
            <div class="row justify-content-center gx-5 box-bar">
                <div class="col-lg-5">
                  <div class="box_point_style1">
                    <div class="box_point_bg1"></div>
                    <div class="box_point_bg2"></div>
                    <div class="card-text">คะแนนแบบทดสอบก่อนเรียน (pre-Test)</div>
                    @php
                        $pretest = \App\Models\UserCurriculumPpExam::where('user_id',\Auth::user()->id)->where('curriculum_id',$curriculum->id)->where('exam_type','pretest')->first();
                        $total_score = empty($pretest) ? 0 : $pretest->total_score;
                        $total_question = empty($pretest) ? 0 : $pretest->n_question;
                    @endphp
                    @if(empty($pretest))
                      <div class="title_score_nopoints"><span>ยังไม่มี</span> คะแนน</div>
                    @else
                      <div class="title_score_points"><span>{{ number_format($pretest->total_score,0) }}/{{ number_format($pretest->total_question,0)}}</span> คะแนน</div>
                    @endif
                  </div>
                 </div>
                 <div class="col-lg-5">
                  <div class="box_point_style1">
                    <div class="box_point_bg1"></div>
                    <div class="box_point_bg2"></div>
                    <div class="card-text">คะแนนวัดผลหลังเรียนรู้ (Post-test)</div>
                    @php
                    $posttest = \App\Models\UserCurriculumPpExam::where('user_id',\Auth::user()->id)->where('curriculum_id',$curriculum->id)->where('exam_type','posttest')->first();
                    $total_score = empty($pretest) ? 0 : $pretest->total_score;
                    $total_question = empty($pretest) ? 0 : $pretest->n_question;
                    @endphp
                    @if(empty($posttest))
                      <div class="title_score_nopoints"><span>ยังไม่มี</span> คะแนน</div>
                    @else
                      <div class="title_score_points"><span>{{ number_format($posttest->total_score,0) }}/{{ number_format($posttest->total_question,0)}}</span> คะแนน</div>
                    @endif
                  </div>
                 </div>
            </div>
            @if(!empty($posttest))
              @if($posttest->total_question == $posttest->n_question && $posttest->total_score >= $posttest->pass_score)
              <div class="row box-bar text-center">
                <p>ผ่านการเรียนและทดสอบตามที่กำหนด คลิกที่นี่เพื่อรับใบประกาศนียบัตร                 
                  <button type="button" class="btn btn-success rounded-pill text-white btn-download-cert">
                    <em class="fa fa-download me-2"></em>
                    ดาวน์โหลดใบประกาศนียบัตรของคุณ
                  </button>
                  @push('js')
                  <script>
                      $(document).ready(function(){
                          $(".btn-download-cert").click(function(){
                              $exists_survey = $("#exists_survey").val();
                              if($exists_survey>=1){
                                window.open("{{ url('certificate/pdf/'.$curriculum->id)}}")
                              }else{
                                Swal.fire({
                                    title: 'แจ้งเตือนการใช้งาน',
                                    html: 'กรุณากรอกแบบสอบถามความพึงพอใจก่อนดาวน์โหลดใบประกาศนียบัตรของคุณ',
                                    showConfirmButton: true,                                        
                                });
                              }
                          });
                      });
                  </script>
                  @endpush
                </p>
                <p>ขอความร่วมมือตอบแบบสอบถามความพึงพอใจ เพื่อนำข้อมูลไปพัฒนาระบบ e-Learning                 
                  <button type="button" class="btn btn-info rounded-pill open-survey-btn" data-bs-toggle="modal" data-bs-target="#surveyModal" data-curriculum-id="{{ $curriculum->id }}">
                    แบบสอบถามความพึงพอใจ
                  </button>
                  @php
                    $n_survey = \App\Models\SurveyResult::where('user_id',\Auth::user()->id)->where('curriculum_id',$curriculum->id)->count();                  
                  @endphp
                  <input type="hidden" name="exists_survey" id="exists_survey" value="{{ number_format($n_survey,0) }}">
                </p>
              </div>
              @include('components.frontend.survey')
              @endif
            @endif
             <div class="row box-bar">
              <div class="col-lg-11 mx-auto">
                <ul class="results_list1">
                  <li>
                    <strong>แบบทดสอบก่อนเรียน (pre-Test)</strong> 
                    
                      @if(empty($pretest) || $pretest->total_question < $pretest->n_question)
                        <div class="notyet_pass">
                          ยังไม่ผ่าน (ยังไม่แล้วเสร็จ)                          
                        </div>                      
                      @elseif($pretest->total_question == $pretest->n_question && $pretest->total_score < $pretest->pass_score)
                        <div class="notyet_pass">
                          ยังไม่ผ่าน 
                          {{ number_format($pretest->total_score) }} / {{ $pretest->n_question }} 
                        </div>
                      @elseif($pretest->total_question == $pretest->n_question)
                        <div class="results_pass">
                          <em class="fa fa-check me-2"></em>ผ่าน  
                          {{ number_format($pretest->total_score) }} / {{ $pretest->n_question }} 
                        </div>
                      @endif                    
                  </li>
                  @foreach($curriculum->curriculum_lesson()->where('status','active')->orderBy('pos','asc')->get() as $key=>$lesson)
                  @php
                      $lesson_exam = \App\Models\UserCurriculumPpExam::where('user_id',\Auth::user()->id)->where('curriculum_lesson_id',$lesson->id)->where('exam_type','lesson')->first();
                      $total_score = empty($lesson_exam) ? 0 : $pretest->total_score;
                      $total_question = empty($lesson_exam) ? 0 : $pretest->n_question;                                        
                  @endphp                                    
                  <li>
                    <strong>{{ $lesson->name }}</strong> 
                    
                      @if(empty($lesson_exam) || $lesson_exam->total_question < $lesson_exam->n_question)
                        <div class="notyet_pass">
                          ยังไม่ผ่าน (ยังไม่แล้วเสร็จ)                          
                        </div>                      
                      @elseif($lesson_exam->total_question == $lesson_exam->n_question && $lesson_exam->total_score < $lesson_exam->pass_score)
                        <div class="notyet_pass">
                          ยังไม่ผ่าน 
                          {{ number_format($lesson_exam->total_score) }} / {{ $lesson_exam->n_question }} 
                        </div>
                      @elseif($lesson_exam->total_question == $lesson_exam->n_question)
                        <div class="results_pass">
                          <em class="fa fa-check me-2"></em>ผ่าน  
                          {{ number_format($lesson_exam->total_score) }} / {{ $lesson_exam->n_question }} 
                        </div>
                      @endif                    
                  </li>
                  @endforeach                  
                  <li>
                    <strong>วัดผลหลังเรียนรู้ (Post-test)</strong> 
                    
                      @if(empty($posttest) || $posttest->total_question < $posttest->n_question)
                        <div class="notyet_pass">
                          ยังไม่ผ่าน (ยังไม่แล้วเสร็จ)                          
                        </div>                      
                      @elseif($posttest->total_question == $posttest->n_question && $posttest->total_score < $posttest->pass_score)
                        <div class="notyet_pass">
                          ยังไม่ผ่าน 
                          {{ number_format($posttest->total_score) }} / {{ $posttest->n_question }} 
                        </div>
                      @elseif($posttest->total_question == $posttest->n_question && $posttest->total_score >= $posttest->pass_score)
                        <div class="results_pass">
                          <em class="fa fa-check me-2"></em>ผ่าน  
                          {{ number_format($posttest->total_score) }} / {{ $posttest->n_question }} 
                        </div>
                      @endif                    
                  </li>
                  <li class="text-center">
                    {!! Form::open([
                      'url' => url('elearning/curriculum/'.$curriculum->id.'/reset'),
                      'method' => 'POST',
                      'files' => false,
                      'class' => 'form',
                      'autocomplete' => 'off',
                      'class' => 'needs-validation',
                    ]) !!}
                        <button type="submit" class="btn btn-lg btn-danger ms-3 btn-reset-class" name="btn_reset" value="reset"><i class="fa fa-undo"></i> เริ่มเรียนใหม่อีกครั้ง</button>
                    {!! Form::close() !!}   
                  </li>
                </ul>                
              </div>
            </div>
           </div>
            <hr>
        </div>
        <!-- End tab-content 2 -->

    </div><!-- End Tab-content-->

</div><!-- ##### End tabs ##### -->



</div>
<!--=================== End Content =================-->
    
</main>

    @include('layouts.elearning.footer')
    @include('frontend._script')
    @stack('js')
    <script>
      $(document).ready(function(){
          $(".btn-reset-class").click(function(){
                if(confirm('เริ่มเรียนใหม่อีกครั้ง')){
                  return true;
                }else{
                  return false;
                }
          })
      });
    </script>

</body>
</html>