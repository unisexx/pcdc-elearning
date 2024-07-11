@extends('layouts.app')

@section('title', 'หมวดหมู่หลักสูตร')

@section('content')
    @component('components.card.index')
        @slot('cardHeaderText')
        หมวดหมู่หลักสูตร
        @endslot
        @slot('table')
            <div class="table-responsive">
                <table id="datatable" class="table align-items-center">
                    <thead>
                        <tr>
                            <th width="50" scope="col">จัดลำดับ</th>
                            <th width="50" class="text-center" scope="col">#</th>
                            <th class="text-start" scope="col">ชื่อหมวดหมู่หลักสูตร</th>
                            <th width="100" class="text-center" scope="col">เปิดใช้งาน</th>
                            <th width="200" class="text-center" scope="col">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody id="sortable">
                        @foreach ($rs as $item)
                            <tr data-id="{{ $item->id }}">
                                <td class="drag-handle"><i class="fas fa-grip-lines"></i></td>
                                <td class="td-item-no text-center">{{ autoNumber($rs) }}</td>                                
                                <td class="text-wrap" style="vertical-align:top;padding-left:20px;word-wrap: break-word; max-width: 300px;">{{ @$item->name }}</td>                                
                                <td style="vertical-align:top;" class="text-center">{!! statusBadge(@$item->status) !!}</td>
                                <td style="vertical-align:top;" class="text-center">
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
        @endslot
    @endcomponent
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
                        url: '{{ url('admin/curriculum-category/update-order') }}',
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
