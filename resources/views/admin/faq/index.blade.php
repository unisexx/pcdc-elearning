@extends('layouts.app')

@section('title', 'คำถามที่พบบ่อย')

@section('content')
    @component('components.card.index')
        @slot('cardHeaderText')
            คำถามที่พบบ่อย
        @endslot
        @slot('table')
            <div class="table-responsive">
                <table id="datatable" class="table align-items-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">คำถาม</th>
                            <th scope="col">ลำดับที่</th>
                            <th scope="col">เปิดใช้งาน</th>
                            <th scope="col">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rs as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ @$item->question }}</td>
                                <td>{{ @$item->order }}</td>
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
