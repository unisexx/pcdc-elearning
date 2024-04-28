@extends('layouts.app')

@section('title', 'ไฮไลท์')

@section('content')
    @component('components.card.index')
        @slot('cardHeaderText')
            ไฮไลท์
        @endslot
        @slot('table')
            <div class="table-responsive">
                <table id="datatable" class="table align-items-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">รูป</th>
                            <th scope="col">ลิ้งค์</th>
                            <th scope="col">เปิดใช้งาน</th>
                            <th scope="col">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rs as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="{{ Storage::url('uploads/hilight/' . @$item->image) }}" width="300"></td>
                                <td>{{ @$item->link }}</td>
                                <td>{!! statusBadge(@$item->status) !!}</td>
                                <td class="text-sm">
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
                {{ $rs->links() }}
            </div>
        @endslot
    @endcomponent
@endsection
