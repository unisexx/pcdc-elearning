@extends('layouts.pdf')

@section('content')
            <h1 style="text-align:center">แบบทดสอบท้ายบทเรียน</h1>
            <h1 style="margin-bottom:10px;text-align:center">หลักสูตร "{{ $curriculum->name }}"</h1>
            <h1 style="margin-bottom:10px;text-align:center">{{ $lesson->name }}</h1>
            @php
                $lesson_question = \App\Models\CurriculumLessonQuestion::where('curriculum_lesson_id', $lesson->id)
                    ->where('status', 'active')
                    ->orderBy('pos', 'asc')
                    ->get();
            @endphp
            @foreach ($lesson_question as $lkey => $question)
                <table width="100%" style="page-break-inside: avoid;">
                    <tr>
                        <td style="text-align:left;!important;vertical-align:top;width:50px;">
                            ข้อ {{ $lkey + 1 }}.
                        </td>
                        <td style="text-align:left;!important;vertical-align:top;">
                            {!! trim(preg_replace('/font-family.+?;/', '', $question->name)) !!}
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            @php
                                $question_answer = \App\Models\CurriculumLessonQuestionAnswer::where(
                                    'curriculum_lesson_question_id',
                                    $lesson->id,
                                )
                                    ->where('status', 'active')
                                    ->orderBy('pos', 'asc')
                                    ->get();
                                $answer_choice = [0 => 'ก.', 1 => 'ข.', 2 => 'ค.', 3 => 'ง.', 4 => 'จ.'];
                            @endphp
                            <table width="100%">
                                @foreach ($question_answer as $akey => $answer)
                                    <tr>
                                        <td style="text-align:left;!important;vertical-align:top;width:30px;">
                                            {{ $answer_choice[$akey] }}
                                        </td>
                                        <td style="text-align:left;!important;vertical-align:top;">
                                            {!! trim(preg_replace('/font-family.+?;/', '', $answer->name)) !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                </table>
            @endforeach
    <htmlpagefooter name="page-footer">
        <table>
            <tr>
                <td>
                    แบบทดสอบท้ายบทเรียนหลักสูตร {{ $curriculum->name }}
                    {{ $lesson->name }}
                </td>
                <td style="text-align: right;">{PAGENO}</td>
            </tr>
        </table>
    </htmlpagefooter>
@endsection
