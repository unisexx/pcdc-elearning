@extends('layouts.app')

@section('title', 'ข้อมูลหลักสูตร / บทเรียนในหลักสูตร / แบบทดสอบท้ายบทเรียน')

@section('content')
    <div class="card mb-3">
        <div class="card-header pb-0">
            <div class="col-12">
                <h5>หลักสูตร : <a href="{{ url('admin/curriculum-lesson?curriculum_id=' . $curriculum_lesson->curriculum_id) }}"><span class="text-success">{{ $curriculum_lesson->curriculum->name }}</span></a></h5>
                <h5>บทเรียน : <span class="text-success">{{ $curriculum_lesson->name }}</span></h5>
            </div>
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="mb-0">แบบทดสอบท้ายบทเรียน</h5>
                </div>
                <div class="ms-auto my-auto">
                    @php
                        $parts = explode('.', Route::currentRouteName());
                        array_pop($parts);
                        $routeName = implode('.', $parts);
                    @endphp
                    <a href="{{ route($routeName . '.create') . '?curriculum_lesson_id=' . request('curriculum_lesson_id') }}" class="btn bg-gradient-primary btn-lg mb-0">+&nbsp;เพิ่มรายการ</a>
                </div>
            </div>
        </div>
        <div class="card-body p-3">
            <div class="table-responsive">
                <table id="datatable" class="table align-items-center">
                    <thead>
                        <tr>
                            <th width="50" scope="col">จัดลำดับ</th>
                            <th width="50" class="text-center" scope="col">#</th>
                            <th scope="col">หัวข้อคำถาม</th>
                            <th width="50" scope="col">เปิดใช้งาน</th>
                            <th width="70" scope="col">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody id="sortable">
                        @foreach ($rs as $item)
                            <tr data-id="{{ $item->id }}">
                                <td class="drag-handle"><i class="fas fa-grip-lines"></i></td>
                                <td class="text-center td-item-no">{{ autoNumber($rs) }}</td>
                                <td>{!! @$item->name !!}</td>
                                <td class="text-center">{!! statusBadge(@$item->status) !!}</td>
                                <td class="text-center">
                                    @component('components.table.button')
                                        @slot('itemID')
                                            {{ @$item->id }}
                                        @endslot
                                    @endcomponent
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="mt-3">
                {{-- {{ $rs->appends(@$_GET)->render("vendor.pagination.bootstrap-5-right") }} --}}
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script>
        $(function() {

            function runItemNo() {
                item_no = 1;
                $(".td-item-no").each(function(item_no) {
                    $(this).html(item_no + 1);
                });
            }

            $("#sortable").sortable({
                update: function(event, ui) {
                    let order = $(this).sortable('toArray', {
                        attribute: 'data-id'
                    });
                    $.ajax({
                        url: '{{ url('admin/curriculum-lesson-question/update-order') }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            order: order
                        },
                        success: function(response) {
                            runItemNo();
                            Toastify({
                                text: "เรียงลำดับใหม่สำเร็จ",
                                duration: 3000,
                                close: true,
                                gravity: "top", // `top` or `bottom`
                                position: "center", // `left`, `center` or `right`
                                backgroundColor: "#4fbe87",
                                stopOnFocus: true // Prevents dismissing of toast on hover
                            }).showToast();
                        },
                        error: function(xhr) {
                            Toastify({
                                text: "เรียงลำดับไม่สำเร็จ",
                                duration: 3000,
                                close: true,
                                gravity: "top", // `top` or `bottom`
                                position: "center", // `left`, `center` or `right`
                                backgroundColor: "#dc3545",
                                stopOnFocus: true // Prevents dismissing of toast on hover
                            }).showToast();
                        }
                    });
                }
            });
        });
    </script>
@endpush
