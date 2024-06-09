@extends('layouts.frontend')

@section('page', 'ระบบการเรียนรู้ออนไลน์ e-learning')

@section('content')
    <div class="container">        
        <div class="row g-4 justify-content-between mb-5 wow fadeInDown">
            <div class="col-12">
                    <table class="table table-borderless">
                        <tr>
                            <th class="text-end">
                                <div class="title-send-us">
                                    <span class="text-success">หลักสูตร </span>
                                </div>
                            </th>
                            <td class="text-start">
                                <div class="title-send-us">
                                    {{$curriculum->name}}
                                </div>             
                                @if(!empty($curriculum->intro))
                                    <div class="intro-text" style="padding-top:15px;">                   
                                        {!!$curriculum->intro!!}
                                    </div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="text-end" >
                                <div class="title-send-us">
                                    <span class="text-success">วัตถุประสงค์ </span>
                                </div>
                            </th>
                            <td class="text-start" style="padding-top:15px;">
                                {!!$curriculum->objective!!}
                            </td>
                        </tr>
                        <tr class="my-4">
                            <th colspan="2" class="text-center">
                                <div class="my-4">
                                    <a href="" class="btn btn-lg btn-success">
                                        <i class="fa fa-edit"></i> ทำแบบทดสอบก่อนการเรียนรู้ Pre-Test
                                    </a>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th class="text-end" >
                                <div class="title-send-us">
                                    <span class="text-success">หน่วยเรียนรู้/บทเรียน </span>
                                </div>
                            </th>
                            <td class="text-start" style="padding-top:15px;">
                                <table class="table table-hover">                    
                                    <tbody>
                                        @foreach($curriculum->curriculum_lesson as $key=>$lesson)
                                        <tr>                                                                      
                                            <td>
                                                {{$lesson->name}}
                                            </td>               
                                            <td width="100" nowrap>
                                                <a href="{{url('elearning/curriculum/lesson/'.$lesson->id)}}" class="btn btn-info text-white"><i class="fa fa-book-open"></i> ดูรายละเอียด</a>
                                            </td>      
                                            <td width="100" nowrap>
                                                <a href="{{url('elearning/curriculum/lesson/'.$lesson->id)}}" class="btn btn-info text-white"><i class="fa fa-edit"></i> ทำแบบทดสอบ</a>
                                            </td>                                    
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2" class="text-center">
                                <div class="my-4">
                                    <a href="" class="btn btn-lg btn-warning">
                                        <i class="fa fa-edit"></i> ทำแบบทดสอบหลังการเรียนรู้ Post-Test
                                    </a>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="2" class="text-center">
                                <div class="my-4">
                                    <a href="" class="btn btn-lg btn-primary">
                                        <i class="fa fa-download"></i> ดาวน์โหลดใบประกาศ
                                    </a>
                                </div>
                            </th>
                        </tr>
                    </table>
            </div>    
        </div>        
    </div>    
@endsection