@extends('layouts.elearning')

@section('page', $bread_crumb_name )

@section('content')
<div class="bg-1 row wow fadeInDown g-0">
    <div class="d-flex justify-content-center title_welcome">
        {{ $bread_crumb_name }}
        <br>
        {{ $curriculum->name }}
        @if($exam_type=='lesson')
        <br>
        {{ $curriculum_lesson->name }}
        @endif
    </div>    
    <fieldset class="my-5 border rounded-3 pt-5 px-3 position-relative">
        <legend class="tab_lesson_title w-auto rounded-pill">
            <img src="http://localhost/elearning/images/persent2.svg" alt="" height="35" class="me-2">เกณฑ์
        </legend>
        <ul>
            <li>จำนวนคำถามมีทั้งหมด&nbsp;<span class="text-danger fw-bolder">{{ $n_question }}</span> คำถาม</li>
            <li>ต้องสอบได้คะแนนไม่ต่ำกว่า&nbsp;<span class="text-danger fw-bolder">{{ $pass_score }}</span> คะแนน</li>
            <li>สามารถทดสอบได้ไม่จำกัดจำนวนครั้งจนกว่าจะผ่าน</li>
        </ul>    
    
        <div class="row justify-content-center gx-5 box-bar">
            <div class="col-lg-5">
                @if(!empty($exam_result))
                    <div class="box_point_style1">
                        <div class="box_point_bg1"></div>
                        <div class="box_point_bg2"></div>
                        <div class="card-text">เริ่มทำแบบทดสอบเมื่อ</div>
                        <div class="col-12 text-center">
                            {{DBToDate($exam_result->created_at,true ,true)}} 
                        </div>
                        <div class="card-text">ความคืบหน้า</div>
                        <div class="col-12 text-center">
                            ท่านทำข้อสอบไปแล้ว {{number_format($exam_result->total_question,0)}} ข้อจากทั้งหมด {{number_format($exam_result->n_question,0)}} ข้อ
                        </div>
                        <div class="card-text">คะแนนที่ได้</div>
                        <div class="title_score_points"><span>{{ number_format($exam_result->total_score,0) }}/{{$exam_result->n_question}}</span> คะแนน</div>
                        @if($exam_result->total_question == $exam_result->n_question)
                            @if($pass_score > $exam_result->total_score)
                                <div class="title_score_points"><span>ไม่ผ่าน</span></div>
                            @else
                                <div class="title_score_points"><span style="color:#47a66c!important;">ผ่าน</span></div>
                            @endif
                        @else
                            <div class="title_score_points"><span>อยู่ระหว่างการทำข้อสอบ</span></div>
                        @endif
                        
                    </div>
                @endif  
            </div>           
            <div class="col-12 text-center">
                {!! Form::open([
                    'url' => url('elearning/curriculum/'.$curriculum->id.'/'.$exam_type.'/execute'),
                    'method' => 'POST',
                    'files' => false,
                    'class' => 'form',
                    'autocomplete' => 'off',
                ]) !!}
                @if($exam_type=="lesson")
                    <input type="hidden" name="curriculum_lesson_id" value="{{ $curriculum_lesson->id }}">
                @endif
                @if(empty($exam_result))
                    <button type="submit" id="submit_start" name="submit_start" class="btn btn-lg btn-primary" value="start">
                        <em class="fa fa fa-pencil fs-5 me-2 icon_list_menu "></em>
                        เริ่มทำแบบทดสอบ
                    </button>        
                @else
                    @if($exam_result->n_question > $exam_result->total_question)
                        <a href="{{ url('elearning/'.$exam_result->id.'/exam') }}" class="btn btn-lg btn-primary">
                            <em class="fa fa fa-pencil fs-5 me-2 icon_list_menu "></em>
                            ทำแบบทดสอบต่อ
                        </a>        
                    @endif
                    @if($pass_score > $exam_result->total_score)
                        @if($exam_type == 'lesson')
                            <a href="{{ url('elearning/curriculum/lesson/'.$curriculum_lesson->id) }}" class="btn btn-lg btn-success"><i class="fa fa-book"></i> ทบทวนเนื้อหาบทเรียน</a>
                        @endif
                        <button type="submit" id="submit_restart" name="submit_restart" class="btn btn-warning btn-lg btn-restart"  value="restart">
                            <em class="fa fa fa-rotate-right fs-5 me-2 icon_list_menu "></em>
                            เริ่มทำใหม่อีกครั้ง
                        </button>
                    @elseif($exam_result->total_score >= $pass_score)
                        @php                            
                            if($exam_type == 'lesson'){
                                $exam_curriculum_pos = $exam_result->curriculum_lesson->pos;
                                if($exam_curriculum_pos){
                                    $next_lesson = $curriculum->curriculum_lesson()->where('pos','>',$exam_curriculum_pos)->first();
                                    if($next_lesson){
                                        echo '<a href="'.url('elearning/curriculum/lesson/'.$curriculum_lesson->id).'" class="btn btn-lg btn-success">ไปยังเนื้อหาบทถัดไป <em class="fa fa-arrow-alt-circle-right fs-5 me-2 icon_list_menu "></em></a>';
                                    }else{
                                        if($curriculum->curriculum_exam_setting)
                                            if($curriculum->curriculum_exam_setting->post_test_status == 'active')
                                            {
                                                echo '<a href="'.url('elearning/curriculum/'.$curriculum->id.'/posttest').'" class="btn btn-lg btn-success">วัดผลหลังเรียนรู้ (Post-test) <em class="fa fa-arrow-alt-circle-right fs-5 me-2 icon_list_menu "></em></a>';
                                            }
                                    }
                                }
                            }elseif($exam_type == 'pretest'){
                                $next_lesson = $curriculum->curriculum_lesson()->orderBy('pos','asc')->first();
                                if($next_lesson){
                                    echo '<a href="'.url('elearning/curriculum/lesson/'.$curriculum_lesson->id).'" class="btn btn-lg btn-success">ไปยังเนื้อหาบทถัดไป <em class="fa fa-arrow-alt-circle-right fs-5 me-2 icon_list_menu "></em></a>';
                                }
                            }elseif($exam_type=='posttest'){
                                if($exam_result->pass_score <= $exam_result->total_score){
                                    echo '<button type="button" class="btn btn-lg btn-success" id="btn-show-result">ตรวจสอบผลการเรียน/ดาวนโหลดใบประกาศ</a>';                                    
                                }
                            }
                        @endphp                        
                    @endif
                @endif
                {!! Form::close() !!}        
            </div>  
        </div>            
    
    </fieldset>    
</div>
@endsection
@push('js')
<script>
    $(document).ready(function(){
        $("#submit_start").click(function(){
            if(confirm('ต้องการเริ่มทำแบบทดสอบ ?')){
                return true;
            }else{
                return false;
            }
        });
        $("#submit_restart").click(function(){
            if(confirm('ต้องการเริ่มทำแบบทดสอบใหม่อีกครั้ง ?')){
                return true;
            }else{
                return false;
            }
        });
    });
</script>
@endpush

@push('js')
<script>
    $(document).ready(function(){
        function setResultTab(){
            $("#lesson-tab").attr("class", "nav-link");
            $("#lesson-tab-pane").attr("class","tab-pane fade");
            $("#academic_results-tab").attr("class", "nav-link active");
            $("#academic_results-tab-pane").attr("class","tab-pane fade active show");
        }        

        $("#btn-show-result").click(function(){
            setResultTab();
        });
    });
</script>
@endpush