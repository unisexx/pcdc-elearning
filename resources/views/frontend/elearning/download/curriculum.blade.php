@extends('layouts.pdf')

@section('content')
    <h1 style="margin-bottom:10px;text-align:center">หลักสูตร "{{ $curriculum->name }}"</h1>
    {!! $curriculum->intro !!}
    <h2 style="margin-bottom:10px;">วัตถุประสงค์</h2>
    {!! $curriculum->objective !!}
    @if ($curriculum->curriculum_lesson)
        <h2 style="margin-bottom:0px;">บทเรียนในหลักสูตร</h2>
        <ul style="list-style-type:none;">
            @foreach ($curriculum->curriculum_lesson as $key => $lesson)
                <li>
                    <span style="font-weight: bold">{{ $lesson->name }}</span>&nbsp;&nbsp;&nbsp;&nbsp;
                    {{ $lesson->description }}
                </li>
            @endforeach
        </ul>
    @endif

    @if ($curriculum->curriculum_lesson)
        @foreach ($curriculum->curriculum_lesson as $key => $lesson)
            {{-- หน้าปกแต่ละบทเรียน --}}
            <div class="page-break"></div>
            <h1 style="text-align:center;padding-top:400px;font-size:50px;">{{ $lesson->name }}</h1>
            {{-- เนื้อหาบทเรียน --}}
            <div class="page-break"></div>
            <h1 style="margin-bottom:10px;text-align:center">{{ $lesson->name }}</h1>
            {!! $lesson->description !!}
            @php
                $lesson_detail = \App\Models\CurriculumLessonDetail::where('curriculum_lesson_id',$lesson->id)->orderBy('pos','asc')->get();        
            @endphp
            @foreach($lesson_detail as $lkey => $ldetail)
                {!! $ldetail->detail !!}
            @endforeach
        @endforeach
    @endif
    <htmlpagefooter name="page-footer">
        <table>
            <tr>
                <td>หลักสูตร {{ $curriculum->name }}</td>
                <td style="text-align: right;">{PAGENO}</td>
            </tr>    
        </table>    
    </htmlpagefooter>
@endsection
