@extends('layouts.frontend')

@section('page', 'ระบบการเรียนรู้ออนไลน์ e-learning')

@section('content')
    <div class="container">        
        <div class="row g-4 justify-content-between mb-5 wow fadeInDown">
            <div class="col-lg-6">
                <div class="position-relative pb-2 my-4">
                    <img src="http://localhost/html/images/icon-hat.svg" alt="" class="icon-hat">
                    <div class="title-send-us">ข้อมูลและประวัติการเรียน</div>
                </div>
            </div>            
        </div>        

        <div class="row g-4 justify-content-center wow fadeInDown" style="visibility: visible; animation-name: fadeInDown;">
            <div class="col-12">
                <table class="history-table table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="50">ลำดับ</th>
                            <th>หลักสูตร</th>                                                        
                            <th width="150">สถานะ</th>
                            <th width="200">วันที่ผ่านการทดสอบ</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($exam_history as $key=>$item)            
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->curriculum->name }}</td>
                            <td class="text-center">
                                @if(!$item->post_date_finished)
                                    <span class="text-default">ยังไม่จบบทเรียน</span>
                                @elseif($item->post_pass_status == 'y')
                                    <span class="text-success">ผ่าน</span>
                                @else
                                    <span class="text-danger">ไม่ผ่าน</span>
                                @endif
                            </td>
                            <td>
                                {{ DbToDate($item->post_date_finished, true, true) }}
                            </td>
                            <td class="text-center">
                                @if($item->post_pass_status == 'y')
                                    <a href="{{ url('certificate/pdf/'.$item->curriculum_id)}}" class="btn btn-success"><i class="fa fa-download"></i> ดาวน์โหลดใบประกาศ</a>
                                @else
                                    <a href="{{ url('elearning/curriculum/'.$item->curriculum_id) }}" class="btn btn-primary">
                                        <em class="fa fa-arrow-alt-circle-right fs-5 me-2 icon_list_menu "></em>
                                        ไปยังหลักสูตร
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        @endempty
                    </tbody>
                </table>
            </div>
                
        </div>
    </div>    
@endsection

@push('js')
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'สำเร็จ!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'ตกลง'
            });
        </script>
    @endif
@endpush
