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
            @php
                $key = 0;
            @endphp
            @if(@$rs)
                @forelse($rs->curriculum_lesson_question_answer as $key=>$detail)
                    @php
                        $checked = $detail->score > 0 ? 'checked="checked"' : '';
                    @endphp
                    <div class="answer_row card card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group">
                                    <div class="input-group-text page-title">คำตอบที่&nbsp;&nbsp;<span class="page-number"></span></div>
                                    <button class="btn btn-xs btn-primary btn-show-page" type="button">
                                    ย่อ/ขยายรายละเอียด
                                    </button>                                    
                                </div>                                
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="correct_answer" id="correct_answer_{{ $key+1 }}" value="{{ $key+1 }}" {!! $checked !!}>
                                    <label class="custom-control-label" for="correct_answer_{{ $key+1 }}">เป็นคำตอบที่ถูกต้อง</label>
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
                                <input type="hidden" class="answer_id" name="answer_id_{{$key+1}}" value="{{ $detail->id }}">
                                <input type="hidden" class="answer_pos" name="answer_pos_{{$key+1}}" value="{{ $detail->pos }}">
                                <textarea name="page_detail_{{$key+1}}" class="form-control form-control-lg tiny-answer">{!!@$detail->name!!}</textarea>                                    
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
                @php
                    $total_answer = 0;
                    if(@$rs){
                        $total_answer = $rs->curriculum_lesson_question_answer ? $key+1 : 0;
                    }else{
                        $total_answer = 0;
                    }
                @endphp
                <input type="hidden" name="total_answer" value="{{ $total_answer }}">                                                
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
        tinymce.init({
            selector: "textarea.tiny-answer",
            menubar: false,
            theme: "silver",
            min_height: 250,
            resize: 'vertical',
            external_plugins: {
                "responsivefilemanager": "{{ asset('js/tinymce_5.10.9/tinymce/js/tinymce/plugins/responsive_filemanager/responsive_filemanager/tinymce/plugins/responsivefilemanager/plugin.min.js') }}",
                'youtube': '{{ asset('js/tinymce_5.10.9/tinymce/js/tinymce/plugins/youtube/plugin.min.js') }}',
            },
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons paste textcolor responsivefilemanager code youtube"
            ],
            menubar: 'file edit view insert format tools table tc help',
            toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect | fontsizeselect",
            // toolbar2: "| responsivefilemanager | link unlink | image media | youtube | forecolor backcolor | preview code ",
            toolbar2: "| responsivefilemanager | youtube | link unlink | forecolor backcolor | preview code ",
            image_advtab: true,
            external_filemanager_path: "{{ asset('js/tinymce_5.10.9/tinymce/js/tinymce/plugins/responsive_filemanager/responsive_filemanager/filemanager') }}/",
            filemanager_title: "Responsive Filemanager",
            // content_css: "{{ asset('front-html/css/bootstrap.min.css') }}, {{ asset('front-html/css/styles.css') }}",
            // relative_urls : false,
            // remove_script_host : false,
            // convert_urls : true,
        });
        $("#cl-page-1").toggle();
        function runPageNo(){
            page_index = 1;
            $(".page-number").each(function(page_index){                                
                $(this).html(page_index+1);
                page_index++;
            });

            page_index = 1;
            $(".answer_pos").each(function(page_index){                                
                $(this).val(page_index+1);
                page_index++;
            });
        }

        $("body").on("click",".btn-up",function(){    
            tinymce.remove();
            $(this).closest('div.card').insertBefore($(this).closest('div.card').prev('div.card'));                      
            runPageNo();
            // tinymce.init({selector: '.tiny'});
            // tinymce.init({selector: '.tiny-answer', max_height: 250});
            tinymce.init({
                selector: "textarea.tiny",
                menubar: false,
                theme: "silver",
                min_height: 350,
                resize: 'vertical',
                external_plugins: {
                    "responsivefilemanager": "{{ asset('js/tinymce_5.10.9/tinymce/js/tinymce/plugins/responsive_filemanager/responsive_filemanager/tinymce/plugins/responsivefilemanager/plugin.min.js') }}",
                    'youtube': '{{ asset('js/tinymce_5.10.9/tinymce/js/tinymce/plugins/youtube/plugin.min.js') }}',
                },
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                    "table contextmenu directionality emoticons paste textcolor responsivefilemanager code youtube"
                ],
                menubar: 'file edit view insert format tools table tc help',
                toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect | fontsizeselect",
                // toolbar2: "| responsivefilemanager | link unlink | image media | youtube | forecolor backcolor | preview code ",
                toolbar2: "| responsivefilemanager | youtube | link unlink | forecolor backcolor | preview code ",
                image_advtab: true,
                external_filemanager_path: "{{ asset('js/tinymce_5.10.9/tinymce/js/tinymce/plugins/responsive_filemanager/responsive_filemanager/filemanager') }}/",
                filemanager_title: "Responsive Filemanager",
                // content_css: "{{ asset('front-html/css/bootstrap.min.css') }}, {{ asset('front-html/css/styles.css') }}",
                // relative_urls : false,
                // remove_script_host : false,
                // convert_urls : true,
            });
            tinymce.init({
                selector: "textarea.tiny-answer",
                menubar: false,
                theme: "silver",
                min_height: 250,
                resize: 'vertical',
                external_plugins: {
                    "responsivefilemanager": "{{ asset('js/tinymce_5.10.9/tinymce/js/tinymce/plugins/responsive_filemanager/responsive_filemanager/tinymce/plugins/responsivefilemanager/plugin.min.js') }}",
                    'youtube': '{{ asset('js/tinymce_5.10.9/tinymce/js/tinymce/plugins/youtube/plugin.min.js') }}',
                },
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                    "table contextmenu directionality emoticons paste textcolor responsivefilemanager code youtube"
                ],
                menubar: 'file edit view insert format tools table tc help',
                toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect | fontsizeselect",
                // toolbar2: "| responsivefilemanager | link unlink | image media | youtube | forecolor backcolor | preview code ",
                toolbar2: "| responsivefilemanager | youtube | link unlink | forecolor backcolor | preview code ",
                image_advtab: true,
                external_filemanager_path: "{{ asset('js/tinymce_5.10.9/tinymce/js/tinymce/plugins/responsive_filemanager/responsive_filemanager/filemanager') }}/",
                filemanager_title: "Responsive Filemanager",
                // content_css: "{{ asset('front-html/css/bootstrap.min.css') }}, {{ asset('front-html/css/styles.css') }}",
                // relative_urls : false,
                // remove_script_host : false,
                // convert_urls : true,
            });
        });

        $("body").on("click",".btn-down",function(){    
            tinymce.remove();        
            $(this).closest('div.card').insertAfter($(this).closest('div.card').next('div.card'));                        
            runPageNo();
            // tinymce.init({selector: '.tiny'});
            // tinymce.init({selector: '.tiny-answer', max_height: 250});
            tinymce.init({
                selector: "textarea.tiny",
                menubar: false,
                theme: "silver",
                min_height: 350,
                resize: 'vertical',
                external_plugins: {
                    "responsivefilemanager": "{{ asset('js/tinymce_5.10.9/tinymce/js/tinymce/plugins/responsive_filemanager/responsive_filemanager/tinymce/plugins/responsivefilemanager/plugin.min.js') }}",
                    'youtube': '{{ asset('js/tinymce_5.10.9/tinymce/js/tinymce/plugins/youtube/plugin.min.js') }}',
                },
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                    "table contextmenu directionality emoticons paste textcolor responsivefilemanager code youtube"
                ],
                menubar: 'file edit view insert format tools table tc help',
                toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect | fontsizeselect",
                // toolbar2: "| responsivefilemanager | link unlink | image media | youtube | forecolor backcolor | preview code ",
                toolbar2: "| responsivefilemanager | youtube | link unlink | forecolor backcolor | preview code ",
                image_advtab: true,
                external_filemanager_path: "{{ asset('js/tinymce_5.10.9/tinymce/js/tinymce/plugins/responsive_filemanager/responsive_filemanager/filemanager') }}/",
                filemanager_title: "Responsive Filemanager",
                // content_css: "{{ asset('front-html/css/bootstrap.min.css') }}, {{ asset('front-html/css/styles.css') }}",
                // relative_urls : false,
                // remove_script_host : false,
                // convert_urls : true,
            });
            tinymce.init({
                selector: "textarea.tiny-answer",
                menubar: false,
                theme: "silver",
                min_height: 250,
                resize: 'vertical',
                external_plugins: {
                    "responsivefilemanager": "{{ asset('js/tinymce_5.10.9/tinymce/js/tinymce/plugins/responsive_filemanager/responsive_filemanager/tinymce/plugins/responsivefilemanager/plugin.min.js') }}",
                    'youtube': '{{ asset('js/tinymce_5.10.9/tinymce/js/tinymce/plugins/youtube/plugin.min.js') }}',
                },
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                    "table contextmenu directionality emoticons paste textcolor responsivefilemanager code youtube"
                ],
                menubar: 'file edit view insert format tools table tc help',
                toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect | fontsizeselect",
                // toolbar2: "| responsivefilemanager | link unlink | image media | youtube | forecolor backcolor | preview code ",
                toolbar2: "| responsivefilemanager | youtube | link unlink | forecolor backcolor | preview code ",
                image_advtab: true,
                external_filemanager_path: "{{ asset('js/tinymce_5.10.9/tinymce/js/tinymce/plugins/responsive_filemanager/responsive_filemanager/filemanager') }}/",
                filemanager_title: "Responsive Filemanager",
                // content_css: "{{ asset('front-html/css/bootstrap.min.css') }}, {{ asset('front-html/css/styles.css') }}",
                // relative_urls : false,
                // remove_script_host : false,
                // convert_urls : true,
            });
            
        });

        $("body").on("click",".btn-remove",function(){
            if(confirm('ต้องการลบรายการนี้ ?')){
                answer_id = $(this).closest('div.card').find('.answer_id').val();
                if(answer_id != "new"){
                    delete_input = '<input type="hidden" name="delete_answer[]" value="'+answer_id+'">';                
                    $("[type=submit]").closest('div').append(delete_input);
                }
                $(this).closest('div.card').remove();
                runPageNo();
            }
        });

        $("body").on("click",".btn-show-page",function(){            
            $(this).closest('div.row').next('div').toggle();                        
        });

        $(".btn-add-page").click(function(){
                total_key = $("[name=total_answer]").val();
                current_key = parseInt(total_key) + 1;
                str_panel = '<div class="card card-body">';
                    str_panel+='<div class="row">';
                        str_panel+='<div class="col-6">';
                            str_panel+='<div class="input-group">';
                                str_panel+='<div class="input-group-text page-title">คำตอบที่&nbsp;&nbsp;<span class="page-number"></span></div>';
                                str_panel+='<button class="btn btn-xs btn-primary btn-show-page" type="button">';
                                str_panel+='ย่อ/ขยายรายละเอียด';
                                str_panel+='</button>';
                            str_panel+='</div>';
                            str_panel+='<div class="form-check mb-3">';
                                str_panel+='<input class="form-check-input" type="radio" name="correct_answer" id="correct_answer_'+current_key+'" value="'+current_key+'">';
                                str_panel+='<label class="custom-control-label" for="correct_answer_'+current_key+'">เป็นคำตอบที่ถูกต้อง</label>';
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
                                str_panel+='<input type="hidden" class="answer_id" name="answer_id_'+current_key+'" id="answer_id_'+current_key+'" value="new">';
                                str_panel+='<input type="hidden" class="answer_pos" name="answer_pos_'+current_key+'" value="">';
                                str_panel+='<textarea name="page_detail_'+current_key+'" class="form-control form-control-lg tiny-answer"></textarea>';
                            str_panel+='</div>';                            
                    str_panel+='</div>';
                str_panel+='</div>';
                
                $(str_panel).insertBefore($("#pn_page_btn"));
                runPageNo();
                // tinymce.init({selector: '.tiny-answer', max_height: 250});
                $("[name=total_answer]").val(current_key);                
                tinymce.init({
                    selector: "textarea.tiny-answer",
                    menubar: false,
                    theme: "silver",
                    min_height: 250,
                    resize: 'vertical',
                    external_plugins: {
                        "responsivefilemanager": "{{ asset('js/tinymce_5.10.9/tinymce/js/tinymce/plugins/responsive_filemanager/responsive_filemanager/tinymce/plugins/responsivefilemanager/plugin.min.js') }}",
                        'youtube': '{{ asset('js/tinymce_5.10.9/tinymce/js/tinymce/plugins/youtube/plugin.min.js') }}',
                    },
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                        "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                        "table contextmenu directionality emoticons paste textcolor responsivefilemanager code youtube"
                    ],
                    menubar: 'file edit view insert format tools table tc help',
                    toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect | fontsizeselect",
                    // toolbar2: "| responsivefilemanager | link unlink | image media | youtube | forecolor backcolor | preview code ",
                    toolbar2: "| responsivefilemanager | youtube | link unlink | forecolor backcolor | preview code ",
                    image_advtab: true,
                    external_filemanager_path: "{{ asset('js/tinymce_5.10.9/tinymce/js/tinymce/plugins/responsive_filemanager/responsive_filemanager/filemanager') }}/",
                    filemanager_title: "Responsive Filemanager",
                    // content_css: "{{ asset('front-html/css/bootstrap.min.css') }}, {{ asset('front-html/css/styles.css') }}",
                    // relative_urls : false,
                    // remove_script_host : false,
                    // convert_urls : true,
                });
        });
    })    
</script>
@endpush