@extends('layouts.app')

@section('title', 'ข้อมูลหลักสูตร / กำหนดค่าการทำแบบทดสอบ')

@section('content')
    @php
        $sum_prepost_question = 0;
    @endphp
    {!! Form::open([
        'route' => 'admin.curriculum-exam-setting.store',
        'method' => 'POST',
        'files' => true,
        'class' => 'form',
        'autocomplete' => 'off',
    ]) !!}
    <div class="card mb-3">
        <div class="card-header pb-0">
            <div class="col-12">
                <h5>หลักสูตร : <a href=""><span class="text-success">{{ $curriculum->name }}</span></a></h5>
                <input type="hidden" name="curriculum_id" value="{{ $curriculum->id }}">
            </div>
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="mb-0">กำหนดค่าการทำแบบทดสอบ</h5>
                </div>
            </div>
        </div>
        <div class="card-body p-3">
            <div class="table-responsive">
                <table id="datatable" class="table align-items-center">
                    <thead>
                        <tr>
                            <th width="50" scope="col">#</th>
                            <th width="100">ชื่อหน่วยการเรียนรู้/บทเรียน</th>
                            <th width="100" class="text-center" scope="col">
                                จำนวนข้อ
                                <br>แบบทดสอบท้ายบท
                                <br>ที่เปิดใช้งาน
                            </th>
                            <th width="100" class="text-center" scope="col">เปิดให้ทดสอบ</th>
                            <th width="100" class="text-center" scope="col">การแสดง<br>คำถาม</th>
                            {{-- <th width="100" class="text-center" scope="col">การแสดง<br>คำตอบ</th> --}}
                            <th width="100" class="text-center" scope="col">จำนวนข้อ<br>ที่แสดง<br>สำหรับการทดสอบ</th>
                            <th width="100" class="text-center" scope="col">คะแนนขั้นต่ำ<br>เพื่อผ่านการทดสอบ</th>
                            <th width="100" class="text-center" scope="col">จำนวนข้อ<br>ที่แสดง<br>ใน Pre/Post Test</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($curriculum->curriculum_lesson as $item)
                            @php
                                if (!empty($rs)) {
                                    $detail = $rs
                                        ->curriculum_exam_setting_detail()
                                        ->where('curriculum_lesson_id', $item->id)
                                        ->first();
                                    $exam_status = $detail->exam_status;
                                    $question_random_status = $detail->question_random_status;
                                    $n_question = $detail->n_question;
                                    $pass_score = $detail->pass_score;
                                    $n_prepost_lesson_question = $detail->n_prepost_lesson_question;
                                    $sum_prepost_question += $n_prepost_lesson_question;
                                } else {
                                    $exam_status = '';
                                    $question_random_status = '';
                                    $n_question = 0;
                                    $pass_score = 0;
                                    $n_prepost_lesson_question = 0;
                                    $sum_prepost_question += $n_prepost_lesson_question;
                                }
                                $n_question_active = $item->curriculum_lesson_question->where('status', 'active')->count();
                                $n_all_question = @$item->curriculum_lesson_question->count();
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td style="white-space: break-spaces;">{{ @$item->name }}</td>
                                <td class="text-center">{{ @$n_question_active . '/' . @$n_all_question }}</td>
                                <td class="text-center">
                                    <div class="form-switch" style="display:block;">
                                        {!! Form::hidden('exam_status_' . $item->id, 'inactive') !!}
                                        {!! Form::checkbox('exam_status_' . $item->id, 'active', @$exam_status == 'active' ? true : false, ['class' => 'form-check-input exam_status']) !!}
                                        &nbsp;เปิด
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="form-switch" style="display:block;">
                                        {!! Form::hidden('question_random_status_' . $item->id, 'inactive') !!}
                                        {!! Form::checkbox('question_random_status_' . $item->id, 'active', @$question_random_status == 'active' ? true : false, ['class' => 'form-check-input check-question']) !!}
                                        &nbsp;สุ่ม
                                    </div>
                                </td>
                                {{-- <td class="text-center">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input check-answer" id="exam_random_answer_status_{{$item->id}}" name="exam_random_answer_status_{{$item->id}}" value="1">
                                        <label class="custom-control-label" for="exam_random_answer_status_{{$item->id}}">สุ่ม</label>
                                    </div>                                    
                                </td> --}}
                                <td class="text-center">
                                    <input type="hidden" name="n_question_active" id="n_question_active" value="{{$n_question_active}}">
                                    <input type="number" style="" class="form-control text-center input-question" name="n_question_{{ $item->id }}" value="{{ $n_question }}">
                                </td>
                                <td class="text-center">
                                    <input type="number" style="" class="form-control text-center input-score" name="pass_score_{{ $item->id }}" value="{{ $pass_score }}">
                                </td>
                                <td class="text-center">                                    
                                    <input type="number" style="" class="form-control text-center input-prepost-question" name="n_prepost_lesson_question_{{ $item->id }}" value="{{ $n_prepost_lesson_question }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-start" colspan="9">
                                สรุปจำนวนข้อคำถามที่แสดงใน Pre/PostTest
                                <span id="sp_sum_prepost_question" style="color:blue;padding-left:15px;padding-right:15px;">{{ @$sum_prepost_question }}</span>
                                ข้อ
                            </th>
                        </tr>
                        <tr>
                            <th class="text-start" colspan="9">
                                ระบุคะแนนขั้นต่ำเพื่อผ่านการทดสอบ Pre/Post Test
                                <input type="number" id="prepost_pass_score" name="prepost_pass_score" class="form-control text-center" style="max-width:200px;" value="{{ @$rs->prepost_pass_score }}">
                            </th>
                        </tr>
                        <tr>
                            <th colspan="9">
                                <div class="d-flex">
                                    <div class="me-6">
                                        เปิดให้ทำ Pre-Test
                                        <div class="form-switch" style="display:block;">
                                            {!! Form::hidden('pre_test_status', 'inactive') !!}
                                            {!! Form::checkbox('pre_test_status', 'active', @$rs->pre_test_status == 'active' ? true : false, ['class' => 'form-check-input check-question']) !!}
                                        </div>
                                    </div>
                                    <div>
                                        เปิดให้ทำ Post-Test
                                        <div class="form-switch" style="display:block;">
                                            {!! Form::hidden('post_test_status', 'inactive') !!}
                                            {!! Form::checkbox('post_test_status', 'active', @$rs->post_test_status == 'active' ? true : false, ['class' => 'form-check-input check-question']) !!}
                                        </div>
                                    </div>
                                    <div style="margin-left:30px;">
                                        เปิดให้ทำ Post-Test ได้หลังจากที่ทำ Pre Test แล้ว
                                        <div class="form-switch" style="display:block;">
                                            {!! Form::hidden('post_test_after_pre', 'inactive') !!}
                                            {!! Form::checkbox('post_test_after_pre', 'active', @$rs->post_test_after_pre == 'active' ? true : false, ['class' => 'form-check-input check-question']) !!}
                                        </div>
                                    </div>
                                </div>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="col-auto mt-3 float-end">
                {{ link_to_route('admin.curriculum.index', 'ย้อนกลับ', $parameters = [], $attributes = ['class' => 'btn btn-lg btn-light px-4']) }}
                {{ Form::submit('บันทึก', ['class' => 'btn btn-lg bg-gradient-primary']) }}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
@push('js')
    <script>
        $(document).ready(function() {

            $("#prepost_pass_score").keydown(function(){
                var n_total_prepost_question = $("#sp_sum_prepost_question").html();
                if(parseInt(n_total_prepost_question) < parseInt($(this).val())){
                    $(this).val('');
                    // $(this).addClass('border-danger');
                    // $(this).attr('style','background:#ffd1d1;');
                }
            });

            $("#prepost_pass_score").keyup(function(){
                var n_total_prepost_question = $("#sp_sum_prepost_question").html();
                if(parseInt(n_total_prepost_question) < parseInt($(this).val())){
                    $(this).val('');
                    $(this).addClass('border-danger');
                    $(this).attr('style','background:#ffd1d1;max-width:200px;');
                }else{
                    $(this).removeClass('border-danger');
                    $(this).attr('style','max-width:200px;');
                }
            });

            $(".input-question, .input-score, .input-prepost-question").keydown(function(){
                var n_question_active = $(this).closest('tr').find("#n_question_active").val();
                if(parseInt(n_question_active) < parseInt($(this).val())){
                    $(this).val('');
                }
            });

            $(".input-question, .input-score, .input-prepost-question").keyup(function(){
                var n_question_active = $(this).closest('tr').find("#n_question_active").val();
                if(parseInt(n_question_active) < parseInt($(this).val())){
                    $(this).val('');
                    $(this).addClass('border-danger');
                    $(this).attr('style','background:#ffd1d1;');
                }else{
                    $(this).removeClass('border-danger');
                    $(this).removeAttr('style');
                }
            });

            function checkExamEnable(element) {
                if (element.prop('checked')) {
                    element.closest('tr').find('.check-question, .check-answer, .input-question, .input-score').each(function() {
                        $(this).removeAttr('disabled');
                    });
                } else {
                    element.closest('tr').find('.check-question, .check-answer, .input-question, .input-score').each(function() {
                        $(this).prop('checked', false);
                        $(this).attr('disabled', 'disabled');
                    });
                }
            }

            $(".exam_status").each(function() {
                checkExamEnable($(this));
            });

            $(".input-prepost-question").keyup(function() {
                var n_question = 0;
                $(".input-prepost-question").each(function() {

                    n_question += $(this).val() != '' ? parseInt($(this).val()) : 0;
                });
                $("#sp_sum_prepost_question").html(n_question);
                var n_total_prepost_question = $("#sp_sum_prepost_question").html();
                var prepost_pass_score = $("#prepost_pass_score").val() != "" ? $("#prepost_pass_score").val() : 0;
                if(parseInt(n_total_prepost_question) < parseInt(prepost_pass_score)){
                    $("#prepost_pass_score").val('');
                    $("#prepost_pass_score").addClass('border-danger');
                    $("#prepost_pass_score").attr('style','background:#ffd1d1;max-width:200px;');
                }else{
                    $("#prepost_pass_score").removeClass('border-danger');
                    $("#prepost_pass_score").attr('style','max-width:200px;');
                }
            });

            $(".exam_status").click(function() {
                checkExamEnable($(this));
            });
        });
    </script>
@endpush
