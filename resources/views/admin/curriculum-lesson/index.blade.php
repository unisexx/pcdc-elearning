@extends('layouts.app')

@section('title', 'ข้อมูลหลักสูตร / บทเรียนในหลักสูตร')

@section('content')
    <div class="card mb-3">
        <div class="card-header pb-0">
            <div class="col-12">
                <h5>หลักสูตร : <span class="text-success">{{ $curriculum->name }}</span></h5>
            </div>
            <div class="d-flex align-items-center">
                <div>                    
                    <h5 class="mb-0">บทเรียนในหลักสูตร</h5>                    
                </div>
                <div class="ms-auto my-auto">
                    @php
                        $parts = explode('.', Route::currentRouteName());
                        array_pop($parts);
                        $routeName = implode('.', $parts);
                    @endphp
                    <a href="{{ route($routeName . '.create').'?curriculum_id='.request('curriculum_id') }}" class="btn bg-gradient-primary btn-lg mb-0">+&nbsp;เพิ่มรายการ</a>
                </div>
            </div>
        </div>
        <div class="card-body p-3">
            <div class="table-responsive">
                <table id="datatable" class="table align-items-center">
                    <thead>
                        <tr>
                            <th width="50" scope="col">#</th>
                            <th scope="col">ชื่อหน่วยการเรียนรู้/บทเรียน</th>                            
                            <th width="100" class="text-center" scope="col">จำนวน<br>เนื้อหา</th>                                                        
                            <th width="100" class="text-center" scope="col">จำนวน<br>แบบทดสอบท้ายบท</th>                                                        
                            <th class="text-center" scope="col">เปิดใช้งาน</th>
                            <th scope="col">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rs as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>                                
                                <td>{{ @$item->name }}</td>
                                <td class="text-center">{{ @$item->curriculum_lesson_detail->count() }}</td>
                                <td class="text-center">{{ @$item->curriculum_lesson_question->where('status','active')->count().'/'.@$item->curriculum_lesson_question->count() }}</td>
                                <td class="text-center">{!! statusBadge(@$item->status) !!}</td>
                                <td class="text-sm">
                                    @component('components.table.button')
                                        @slot('itemID')
                                            {{ @$item->id }}
                                        @endslot
                                    @endcomponent              
                                    <a href="{{ url('admin/curriculum-lesson-question?curriculum_lesson_id='.$item->id) }}" class="mx-3">
                                        <i class="fas fa-check text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="จัดการแบบทดสอบท้ายบทเรียน"></i>
                                    </a>                   
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="mt-3">
                {{ $rs->links() }}
            </div>
        </div>
    </div>

@endsection
