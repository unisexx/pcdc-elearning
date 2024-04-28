@extends('layouts.app')

@section('title', 'แดชบอร์ด')

@section('content')
    {{-- @component('components.card.index')
        @slot('cardHeaderText')
            ผู้ใช้งาน
        @endslot
        @slot('table')
            <table id="datatable" class="table align-items-center">
                <thead>
                    <tr>
                        <th class="ps-2">ชื่อ</th>
                        <th class="ps-2">อีเมล์</th>
                        <th class="ps-2">แอดมิน</th>
                        <th class="ps-2">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rs as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->is_admin ? 'Yes' : 'No' }}</td>
                            <td class="text-sm">
                                @component('components.table.button')
                                    @slot('itemID')
                                        {{ $item->id }}
                                    @endslot
                                @endcomponent
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endslot
    @endcomponent --}}
@endsection
