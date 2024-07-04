@extends('layouts.app')

@section('title', 'แบบสำรวจความพึงพอใจ')

@section('content')
    @component('components.card.index')
        @slot('cardHeaderText')
            แบบสำรวจความพึงพอใจ
        @endslot
        @slot('table')
            <div class="table-responsive">
                <table id="datatable" class="table align-items-center">
                    <thead>
                        <tr>
                            <th scope="col">จัดลำดับ</th>
                            <th scope="col">หัวข้อแบบสำรวจ</th>
                            <th scope="col">เปิดใช้งาน</th>
                            <th scope="col">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody id="sortable">
                        @foreach ($rs as $item)
                            <tr data-id="{{ $item->id }}">
                                <td class="drag-handle"><i class="fas fa-grip-lines"></i></td>
                                <td>{{ @$item->title }}</td>
                                <td>{!! statusBadge(@$item->status) !!}</td>
                                <td>
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
            $("#sortable").sortable({
                update: function(event, ui) {
                    let order = $(this).sortable('toArray', {
                        attribute: 'data-id'
                    });
                    $.ajax({
                        url: '{{ route('survey.updateOrder') }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            order: order
                        },
                        success: function(response) {
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
