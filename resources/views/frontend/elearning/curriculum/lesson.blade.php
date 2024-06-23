@extends('layouts.elearning')

@section('page', $curriculum_lesson->name )

@section('content')
    <div class="container">        
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
                                    {{$curriculum_lesson->curriculum->name}}
                                </div>                                
                                @if(!empty($curriculum_lesson->description))
                                    <div class="intro-text" style="padding-top:15px;">                   
                                        {!!$curriculum_lesson->description!!}
                                    </div>
                                @endif             
                            </td>
                        </tr>
                        <tr>
                            <th class="text-start" >
                                <div class="title-send-us">
                                    <span class="text-success">หน่วยเรียนรู้/บทเรียน </span>
                                </div>
                            </th>
                            <td class="text-start" style="">
                                <div class="title-send-us">
                                    {!!$curriculum_lesson->name!!}
                                </div>
                            </td>
                        </tr>                        
                        <tr class="my-4">
                            <th colspan="2" class="text-left">
                                <div class="my-4">
                                    {!!$detail[0]->detail!!}
                                </div>
                            </th>
                        </tr>
                        <tr class="my-4">
                            <th colspan="2" class="text-center">
                                <div class="float-start">
                                    @if($total_page <= $page && $page > 1)
                                        <a href="{{ url('elearning/curriculum/lesson/9?page='.($page-1))}}" class="btn btn-lg btn-success">
                                            <i class="fa fa-angle-left"></i> ย้อนกลับ
                                        </a>
                                    @else
                                        <a href="{{ url('elearning/curriculum/'.$curriculum_lesson->curriculum_id) }}" class="btn btn-lg btn-success">
                                            <i class="fa fa-angle-left"></i> ย้อนกลับ
                                        </a>
                                    @endif
                                </div>
                                <div class="float-end">
                                    @if($total_page > $page)
                                        <a href="{{ url('elearning/curriculum/lesson/9?page='.($page+1))}}" class="btn btn-lg btn-success">
                                            หน้าถัดไป
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    @else
                                        <a href="" class="btn btn-lg btn-success">
                                            <i class="fa fa-edit"></i> ทำแบบทดสอบ
                                        </a>
                                    @endif
                                </div>                                
                            </th>
                        </tr>                 
                    </table>
            </div>    
        </div>        
    </div>    
@endsection