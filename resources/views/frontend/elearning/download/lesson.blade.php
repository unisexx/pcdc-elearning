@extends('layouts.pdf')

@section('content')
    <h1 style="margin-bottom:10px;text-align:center">หลักสูตร "{{ $curriculum->name }}"</h1>
    <h1 style="margin-bottom:10px;text-align:center">{{ $lesson->name }}</h1>
    {!! $lesson->description !!}
    @foreach ($lesson_detail as $lkey => $ldetail)
        {!! $ldetail->detail !!}
    @endforeach
    <htmlpagefooter name="page-footer">
        <table>
            <tr>
                <td>
                    หลักสูตร {{ $curriculum->name }}
                    {{ $lesson->name }}
                </td>
                <td style="text-align: right;">{PAGENO}</td>
            </tr>
        </table>
    </htmlpagefooter>
@endsection
