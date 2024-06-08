@component('components.card.form')
    @slot('cardHeaderText')
        <div class="col-12">
            <h5>หลักสูตร : <span class="text-success">{{ $curriculum_lesson->curriculum->name }}</span></h5>
        </div>
        <div class="col-12">
            <h5>บทเรียน : <span class="text-success">{{ $curriculum_lesson->name }}</span></h5>
        </div>
        <input type="hidden" name="curriculum_lesson_id" value="{{ $curriculum_lesson->id}}">
    @endslot

    @slot('form')
        <div class="row">            
            <div class="col-12">                
                <label for="name">หัวข้อคำถาม <span class="text-danger">*</span></label>
                <textarea name="name" class="form-control form-control-lg tiny-answer">{!!@$rs->name!!}</textarea>                                    
            </div>
            
            @if(empty(@$rs))
                <div class="card card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group">
                                <div class="input-group-text page-title">คำตอบที่&nbsp;&nbsp;<span class="page-number"></span></div>
                                <button class="btn btn-xs btn-primary btn-show-page" type="button">
                                ย่อ/ขยายรายละเอียด
                                </button>                                    
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="">
                                <div class="input-group-prepend text-end" id="button-addon3">
                                    <button class="btn btn-xs btn-outline-primary btn-up" type="button"><i class="ni ni-bold-up"></i></button>
                                    <button class="btn btn-xs btn-outline-primary btn-down" type="button"><i class="ni ni-bold-down"></i></button>
                                    <button class="btn btn-xs btn-danger btn-remove" type="button"><i class="ni ni-fat-remove"></i></button>
                                </div>                    
                            </div>
                        </div>
                    </div>

                    <div>                
                        <div class="col-12 mt-2">
                            <textarea name="page_detail[]" class="form-control form-control-lg tiny-answer"></textarea>                                    
                        </div>                   
                        <div class="mt-2 col-4" style="max-width:230px;">
                            <div class="input-group">                                        
                                <div class="input-group-text page-title">
                                    คะแนนที่ได้
                                </div>                                             
                                <input type="number" class="form-control text-end" name="score[]" value="">                                
                            </div>
                        </div>
                    </div>
                </div>                 
            @else
                @forelse($rs->curriculum_lesson_question_answer as $detail)
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group">
                                    <div class="input-group-text page-title">คำตอบที่&nbsp;&nbsp;<span class="page-number"></span></div>
                                    <button class="btn btn-xs btn-primary btn-show-page" type="button">
                                    ย่อ/ขยายรายละเอียด
                                    </button>                                    
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="">
                                    <div class="input-group-prepend text-end" id="button-addon3">
                                        <button class="btn btn-xs btn-outline-primary btn-up" type="button"><i class="ni ni-bold-up"></i></button>
                                        <button class="btn btn-xs btn-outline-primary btn-down" type="button"><i class="ni ni-bold-down"></i></button>
                                        <button class="btn btn-xs btn-danger btn-remove" type="button"><i class="ni ni-fat-remove"></i></button>
                                    </div>                    
                                </div>
                            </div>
                        </div>

                        <div>                
                            <div class="col-12 mt-2">
                                <textarea name="page_detail[]" class="form-control form-control-lg tiny-answer">{!!@$detail->name!!}</textarea>                                    
                            </div>      
                            <div class="mt-2 col-4" style="max-width:230px;">
                                <div class="input-group">                                        
                                    <div class="input-group-text page-title">
                                        คะแนนที่ได้
                                    </div>                                             
                                    <input type="number" class="form-control text-end number" name="score[]" value="{{ @$detail->score }}">                                
                                </div>
                            </div>
                        </div>
                    </div>            
                @empty
                @endforelse
            @endif

            <div id="pn_page_btn" class="mt-2 col-12">
                <button type="button" class="btn btn-sm btn-primary btn-add-page"><i class="fa fa-plus"></i> เพิ่มคำตอบ</button>
            </div>
            
            <div class="col-12">
                {{ Form::bsSwitch('status', 'เปิดใช้งาน', @$rs->status, 'active', 'inactive') }}
            </div>
        </div>
        
        <div class="col-auto mt-3">
            <div class="float-start">
                {{ link_to_route('admin.curriculum-lesson-question.index', 'ย้อนกลับ', $parameters = ['curriculum_lesson_id'=>$curriculum_lesson->id], $attributes = ['class' => 'btn btn-lg btn-light px-4']) }}
            </div>
            <div class="float-end">
                {{ Form::submit('บันทึก', ['class' => 'btn btn-lg bg-gradient-primary']) }}
            </div>
        </div>
    @endslot
@endcomponent
@push('css')
<style>
    .page-title{
        height: 42px!important;
        color: blue!important;
        font-weight: bold!important;
        font-size: 20px!important;
    }
</style>
@endpush

@push('js')
<script>
    $(document).ready(function(){
        runPageNo();
        tinymce.init({selector: '.tiny-answer', max_height: 250});
        $("#cl-page-1").toggle();
        function runPageNo(){
            page_index = 1;
            $(".page-number").each(function(page_index){                                
                $(this).html(page_index+1);
                page_index++;
            });
        }

        $("body").on("click",".btn-up",function(){    
            tinymce.remove();
            $(this).closest('div.card').insertBefore($(this).closest('div.card').prev('div.card'));                      
            runPageNo();
            tinymce.init({selector: '.tiny'});
            tinymce.init({selector: '.tiny-answer', max_height: 250});
        });

        $("body").on("click",".btn-down",function(){    
            tinymce.remove();        
            $(this).closest('div.card').insertAfter($(this).closest('div.card').next('div.card'));                        
            runPageNo();
            tinymce.init({selector: '.tiny'});
            tinymce.init({selector: '.tiny-answer', max_height: 250});
        });

        $("body").on("click",".btn-remove",function(){
            if(confirm('ต้องการลบรายการนี้ ?')){
                $(this).closest('div.card').remove();
                runPageNo();
            }
        });

        $("body").on("click",".btn-show-page",function(){            
            $(this).closest('div.row').next('div').toggle();                        
        });

        $(".btn-add-page").click(function(){
                str_panel = '<div class="card card-body">';
                    str_panel+='<div class="row">';
                        str_panel+='<div class="col-6">';
                            str_panel+='<div class="input-group">';
                                str_panel+='<div class="input-group-text page-title">คำตอบที่&nbsp;&nbsp;<span class="page-number"></span></div>';
                                str_panel+='<button class="btn btn-xs btn-primary btn-show-page" type="button">';
                                str_panel+='ย่อ/ขยายรายละเอียด';
                                str_panel+='</button>';
                            str_panel+='</div>';
                        str_panel+='</div>';
                        str_panel+='<div class="col-6">';
                            str_panel+='<div class="">';
                                str_panel+='<div class="input-group-prepend text-end" id="button-addon3">';
                                    str_panel+='<button class="btn btn-xs btn-outline-primary btn-up" type="button"><i class="ni ni-bold-up"></i></button>';
                                    str_panel+='<button class="btn btn-xs btn-outline-primary btn-down" type="button"><i class="ni ni-bold-down"></i></button>';
                                    str_panel+='<button class="btn btn-xs btn-danger btn-remove" type="button"><i class="ni ni-fat-remove"></i></button>';
                                str_panel+='</div>';
                            str_panel+='</div>';
                        str_panel+='</div>';
                    str_panel+='</div>';
                    str_panel+='<div>';
                            str_panel+='<div class="col-12 mt-2">';
                                str_panel+='<textarea name="page_detail[]" class="form-control form-control-lg tiny-answer"></textarea>';
                            str_panel+='</div>';
                            str_panel+='<div class="mt-2 col-4" style="max-width:230px;">';
                                str_panel+='<div class="input-group">';
                                    str_panel+='<div class="input-group-text page-title">';
                                        str_panel+='คะแนนที่ได้';
                                    str_panel+='</div>';
                                    str_panel+='<input type="number" class="form-control text-end" name="score[]" value="">';
                                str_panel+='</div>';
                            str_panel+='</div>';
                    str_panel+='</div>';
                str_panel+='</div>';
                
                $(str_panel).insertBefore($("#pn_page_btn"));
                runPageNo();
                tinymce.init({selector: '.tiny-answer', max_height: 250});
        });
    })    
</script>
@endpush