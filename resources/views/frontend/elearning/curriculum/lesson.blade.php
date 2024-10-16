@extends('layouts.elearning')

@section('page', $curriculum_lesson->name)

@section('content')
    <div id="tab1Page" class="container fs-5">
        <div class="row g-4 justify-content-between mb-5 wow fadeInDown">
            <div class="col-12">
                <table class="table table-borderless">
                    <tr>
                        <th style="width: 220px;" class="text-start">
                            <div class="title-send-us">
                                <span class="text-success">หลักสูตร </span>
                            </div>
                        </th>
                        <td class="text-start">
                            <div class="title-send-us">
                                {{ $curriculum_lesson->curriculum->name }}
                            </div>
                            @if (!empty($curriculum_lesson->description))
                                <div class="intro-text" style="padding-top:15px;">
                                    {!! $curriculum_lesson->description !!}
                                </div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="text-start">
                            <div class="title-send-us">
                                <span class="text-success">หน่วยเรียนรู้/บทเรียน </span>
                            </div>
                        </th>
                        <td class="text-start" style="">
                            <div class="title-send-us">
                                {!! $curriculum_lesson->name !!}
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <hr class="my-3">
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2" class="text-center">
                            <div class="input-group">
                                <div class="input-group-text">
                                    เลือกเนื้อหา
                                </div>
                                <select name="page_select" id="page_select" class="form-select form-control-lg page_select">
                                    @foreach ($curriculum_lesson->curriculum_lesson_detail()->orderBy('pos', 'asc')->get() as $dkey => $ditem)
                                    @php
                                        $current_page = $page == ($dkey+1) ? 'selected="selected"' : '';
                                    @endphp
                                        <option value="{{ $dkey + 1 }}" {!! $current_page !!}>หน้า {{ $dkey + 1 }} :: {{ $ditem->name }}
                                        </option>
                                    @endforeach
                                </select>                                
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2" class="text-center">
                            <div class="float-start">
                                @if ($page > 1)
                                    <a href="{{ url('elearning/curriculum/lesson/' . $curriculum_lesson->id . '?page=' . ($page - 1)) }}"
                                        class="btn btn-lg btn-success">
                                        <i class="fa fa-angle-left"></i> ย้อนกลับ
                                    </a>
                                @endif
                            </div>
                            <div class="float-end text-end">
                                @if ($total_page > $page)
                                    <a href="{{ url('elearning/curriculum/lesson/' . $curriculum_lesson->id . '?page=' . ($page + 1)) }}"
                                        class="btn btn-lg btn-success">
                                        หน้าถัดไป
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                @else
                                    @if (\App\Models\CurriculumExamSettingDetail::where('curriculum_lesson_id', $curriculum_lesson->id)->where('exam_status', 'active')->count() > 0)
                                        <a href="{{ url('elearning/curriculum/lesson-exam/' . $curriculum_lesson->id) }}"
                                            class="btn btn-lg btn-success">
                                            <i class="fa fa-edit"></i> ทำแบบทดสอบ
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </th>
                    </tr>
                    <tr class="my-4">
                        <th colspan="2" class="text-left">
                            <div class="lessonContent" class="my-4">
                                {!! $detail[0]->detail !!}
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2" class="text-center">
                            <div class="input-group">
                                <div class="input-group-text">
                                    เลือกเนื้อหา
                                </div>
                                <select name="page_select" id="page_select" class="form-select form-control-lg page_select">
                                    @foreach ($curriculum_lesson->curriculum_lesson_detail()->orderBy('pos', 'asc')->get() as $dkey => $ditem)
                                    @php
                                        $current_page = $page == ($dkey+1) ? 'selected="selected"' : '';
                                    @endphp
                                        <option value="{{ $dkey + 1 }}" {!! $current_page !!}>หน้า {{ $dkey + 1 }} :: {{ $ditem->name }}
                                        </option>
                                    @endforeach
                                </select>                                
                            </div>
                        </th>
                    </tr>
                    <tr class="my-4">
                        <th colspan="2" class="text-center">
                            <div class="float-start">
                                @if ($page > 1)
                                    <a href="{{ url('elearning/curriculum/lesson/' . $curriculum_lesson->id . '?page=' . ($page - 1)) }}"
                                        class="btn btn-lg btn-success">
                                        <i class="fa fa-angle-left"></i> ย้อนกลับ
                                    </a>
                                @endif
                            </div>
                            <div class="float-end">
                                @if ($total_page > $page)
                                    <a href="{{ url('elearning/curriculum/lesson/' . $curriculum_lesson->id . '?page=' . ($page + 1)) }}"
                                        class="btn btn-lg btn-success">
                                        หน้าถัดไป
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                @else
                                    @if (\App\Models\CurriculumExamSettingDetail::where('curriculum_lesson_id', $curriculum_lesson->id)->where('exam_status', 'active')->count() > 0)
                                        <a href="{{ url('elearning/curriculum/lesson-exam/' . $curriculum_lesson->id) }}"
                                            class="btn btn-lg btn-success">
                                            <i class="fa fa-edit"></i> ทำแบบทดสอบ
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $("#a_lesson_{{ $curriculum_lesson->id }}").addClass("active");
    </script>
    <script>
        $(document).ready(function(){
            $('.page_select').change(function(){
                var url = "{{ url('elearning/curriculum/lesson/' . $curriculum_lesson->id . '?page=') }}" + $(this).val();
                window.location = url;
            });
        });
    </script>
@endpush
