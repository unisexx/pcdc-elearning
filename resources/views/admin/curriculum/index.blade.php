@extends('layouts.app')

@section('title', 'หลักสูตร')

@section('content')
    @component('components.card.index')
        @slot('cardHeaderText')
            หลักสูตร
        @endslot
        @slot('table')
            <div class="table-responsive">
                <table id="datatable" class="table align-items-center">
                    <thead>
                        <tr>
                            <th width="50" class="text-center" scope="col">#</th>
                            <th class="text-start" scope="col">ชื่อหลักสูตร</th>                            
                            <th width="100" class="text-center" scope="col">เปิดใช้งาน</th>
                            <th width="200" class="text-center" scope="col">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rs as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>                                
                                <td>{{ @$item->name }}</td>
                                <td class="text-center">{!! statusBadge(@$item->status) !!}</td>
                                <td class="text-center text-sm">
                                    @component('components.table.button')
                                        @slot('itemID')
                                            {{ @$item->id }}
                                        @endslot
                                    @endcomponent
                                    <a href="{{ url('admin/curriculum-lesson?curriculum_id='.$item->id) }}" class="mx-3">
                                        <i class="fas fa-book text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="จัดการบทเรียนและแบบทดสอบท้ายบทเรียน"></i>
                                    </a>
                                    <a href="{{ url('admin/curriculum-exam-setting?curriculum_id='.$item->id) }}" class="">
                                        <i class="fas fa-cog text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="กำหนดการการทำแบบทดสอบ"></i>
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
        @endslot
    @endcomponent
@endsection
