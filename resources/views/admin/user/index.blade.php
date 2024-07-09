@extends('layouts.app')

@section('title', 'ผู้ใช้งาน')

@section('content')
    @component('components.card.index')
        @slot('cardHeaderText')
            ผู้ใช้งาน
        @endslot
        @slot('table')
            <div class="table-responsive">
                <table id="datatable" class="table align-items-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ชื่อ</th>
                            <th scope="col">อีเมล์</th>
                            <th scope="col">แอดมิน</th>
                            <th scope="col">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    @if ($item->is_admin = '1')
                                        <i class="fas fa-user-shield text-warning"></i>
                                    @else
                                        <i class="fas fa-user"></i>
                                    @endif
                                </td>
                                <td>
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
            </div>
            <!-- Pagination -->
            <div class="mt-3">
                {{ $users->links() }}
            </div>
        @endslot
    @endcomponent
@endsection
