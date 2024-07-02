@component('components.card.form')
    @slot('cardHeaderText')
        <h5>หลักสูตร : <span class="text-success">{{ $curriculum->name }}</span></h5>
        <input type="hidden" name="curriculum_id" value="{{ $curriculum->id }}">
    @endslot

    @slot('form')
        <div class="row mt-3">
            <div class="col-12">
                {{ Form::bsText('name', 'ชื่อบทเรียน') }}
            </div>
            <div class="col-12">
                {{ Form::bsTextArea('description', 'คำอธิบายบทเรียน') }}
            </div>

            <div class="col-12">
                {{ Form::bsFile('cover_image', 'ภาพหน้าปก (ขนาด 740 x 370 px)', @$rs->cover_image, 'uploads/curriculum_lesson', ['accept' => 'image/*']) }}
            </div>

            @if (empty(@$rs))
                <div class="card card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="input-group">
                                <div class="input-group-text page-title">หน้าที่&nbsp;&nbsp;<span class="page-number"></span></div>
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
                    <div class="collapse" style="display:block">
                        <div class="col-12 mt-2">
                            {{ Form::bsTiny('page_detail[]', 'รายละเอียดเนื้อหา') }}
                        </div>
                    </div>
                </div>
            @else
                @forelse($rs->curriculum_lesson_detail as $detail)
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group">
                                    <div class="input-group-text page-title">หน้าที่&nbsp;&nbsp;<span class="page-number"></span></div>
                                    <button class="btn btn-xs btn-primary btn-show-page" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
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

                        <div class="collapse" style="display:block">
                            <div class="col-12 mt-2">
                                <textarea name="page_detail[]" class="form-control form-control-lg tiny">{!! $detail->detail !!}</textarea>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            @endif

            <div id="pn_page_btn" class="mt-2 col-12">
                <button type="button" class="btn btn-sm btn-primary btn-add-page"><i class="fa fa-plus"></i> เพิ่มหน้า</button>
            </div>

            <div class="col-12">
                {{ Form::bsSwitch('status', 'เปิดใช้งาน', @$rs->status, 'active', 'inactive') }}
            </div>
        </div>

        <div class="col-auto mt-3 float-end">
            {{ link_to_route('admin.curriculum-lesson.index', 'ย้อนกลับ', $parameters = ['curriculum_id' => $curriculum->id], $attributes = ['class' => 'btn btn-lg btn-light px-4']) }}
            {{ Form::submit('บันทึก', ['class' => 'btn btn-lg bg-gradient-primary']) }}
        </div>
    @endslot
@endcomponent
@push('css')
    <style>
        .page-title {
            height: 42px !important;
            color: blue !important;
            font-weight: bold !important;
            font-size: 20px !important;
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            runPageNo();
            $("#cl-page-1").toggle();

            function runPageNo() {
                page_index = 1;
                $(".page-number").each(function(page_index) {
                    $(this).html(page_index + 1);
                    page_index++;
                });
            }

            $("body").on("click", ".btn-up", function() {
                tinymce.remove();
                $(this).closest('div.card').insertBefore($(this).closest('div.card').prev('div.card'));
                runPageNo();
                tinymce.init({
                    selector: '.tiny'
                });
            });

            $("body").on("click", ".btn-down", function() {
                tinymce.remove();
                $(this).closest('div.card').insertAfter($(this).closest('div.card').next('div.card'));
                runPageNo();
                tinymce.init({
                    selector: '.tiny'
                });
            });

            $("body").on("click", ".btn-remove", function() {
                if (confirm('ต้องการลบรายการนี้ ?')) {
                    $(this).closest('div.card').remove();
                    runPageNo();
                }
            });

            $("body").on("click", ".btn-show-page", function() {
                $(this).closest('div.row').next('div').toggle();
            });

            $(".btn-add-page").click(function() {
                str_panel = '<div class="card card-body">';
                str_panel += '<div class="row">';
                str_panel += '<div class="col-6">';
                str_panel += '<div class="input-group">';
                str_panel += '<div class="input-group-text page-title">หน้าที่&nbsp;&nbsp;<span class="page-number"></span></div>';
                str_panel += '<button class="btn btn-xs btn-primary btn-show-page" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">';
                str_panel += 'ย่อ/ขยายรายละเอียด';
                str_panel += '</button>';
                str_panel += '</div>';
                str_panel += '</div>';
                str_panel += '<div class="col-6">';
                str_panel += '<div class="">';
                str_panel += '<div class="input-group-prepend text-end" id="button-addon3">';
                str_panel += '<button class="btn btn-xs btn-outline-primary btn-up" type="button"><i class="ni ni-bold-up"></i></button>';
                str_panel += '<button class="btn btn-xs btn-outline-primary btn-down" type="button"><i class="ni ni-bold-down"></i></button>';
                str_panel += '<button class="btn btn-xs btn-danger btn-remove" type="button"><i class="ni ni-fat-remove"></i></button>';
                str_panel += '</div>';
                str_panel += '</div>';
                str_panel += '</div>';
                str_panel += '</div>';
                str_panel += '<div class="collapse" style="display:block">';
                str_panel += '<div class="col-12 mt-2">';
                str_panel += '<textarea name="page_detail[]" class="form-control form-control-lg tiny"></textarea>';
                str_panel += '</div>';
                str_panel += '</div>';
                str_panel += '</div>';
                $(str_panel).insertBefore($("#pn_page_btn"));
                runPageNo();
                // tinymce.init({selector: '.tiny'});
                tinymce.init({
                    selector: "textarea.tiny",
                    menubar: false,
                    theme: "silver",
                    min_height: 600,
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
