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
                            <th width="200" scope="col">หมวดหมู่หลักสูตร</th>
                            <th width="200" scope="col">ภาพหน้าปก</th>
                            <th class="text-start" scope="col">ชื่อหลักสูตร</th>
                            <th class="text-start" scope="col">ประเภทสมาชิก</th>
                            <th width="100" class="text-center" scope="col">เปิดใช้งาน</th>
                            <th width="200" class="text-center" scope="col">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rs as $item)
                            <tr>
                                <td class="text-center">{{ autoNumber($rs) }}</td>
                                <td class="text-wrap" style="vertical-align:top;padding-left:20px;word-wrap: break-word; max-width: 300px;">
                                    @if($item->curriculum_category)
                                        {{ $item->curriculum_category->name }}
                                    @endif
                                </td>
                                <td><img src="{{ Storage::url('uploads/curriculum/' . @$item->cover_image) }}" height="100"></td>
                                <td class="text-wrap" style="vertical-align:top;padding-left:20px;word-wrap: break-word; max-width: 300px;">{{ @$item->name }}</td>
                                <td style="vertical-align:top;padding-left:20px;">
                                    @php
                                        if ($item->curriculum_user_type()->count() > 0) {
                                            foreach ($item->curriculum_user_type()->get() as $ut) {
                                                echo '<div>-' . $ut->user_type->name . '</div>';
                                            }
                                        }
                                    @endphp
                                </td>
                                <td style="vertical-align:top;" class="text-center">{!! statusBadge(@$item->status) !!}</td>
                                <td style="vertical-align:top;" class="text-center">
                                    @component('components.table.button')
                                        @slot('itemID')
                                            {{ @$item->id }}
                                        @endslot
                                    @endcomponent
                                    <a href="{{ url('admin/curriculum-lesson?curriculum_id=' . $item->id) }}" class="mx-3">
                                        <i class="fas fa-book text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="จัดการบทเรียนและแบบทดสอบท้ายบทเรียน"></i>
                                    </a>
                                    <a href="{{ url('admin/curriculum-exam-setting?curriculum_id=' . $item->id) }}" class="">
                                        <i class="fas fa-cog text-secondary" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="กำหนดการการทำแบบทดสอบ"></i>
                                    </a>
                                    <br>
                                    <a href="{{ url('elearning/download-curriculum/'.$item->id) }}" target="_blank" class="mx-3">
                                        <i class="fa fa-download text-primary" data-toggle="tooltip" data-placement="top" title="ดาวน์โหลดเนื้อหาบทเรียน"></i>
                                    </a>

                                    <a href="{{ url('elearning/download-curriculum-exam/'.$item->id) }}" target="_blank">
                                        <i class="fa fa-download text-info" data-toggle="tooltip" data-placement="top" title="ดาวน์โหลดแบบทดสอบบทเรียน"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="mt-3">
                {{ $rs->appends(@$_GET)->render('vendor.pagination.bootstrap-5-right') }}
            </div>
        @endslot
    @endcomponent
@endsection
