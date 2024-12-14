@extends('layouts.app')

@section('title', 'ผู้ใช้งาน')

@section('content')
    @component('components.card.index')
        @slot('cardHeaderText')
            ผู้ใช้งาน
        @endslot
        @slot('table')
            <div class="d-flex justify-content-between align-items-center mb-3">
                <!-- Form ด้านซ้าย -->
                <form method="GET" action="" class="d-flex align-items-center flex-grow-1 me-3">
                    <input type="text" name="search" class="form-control me-2 flex-grow-1" placeholder="ค้นหาชื่อ, อีเมล์" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary btn-sm mt-3">ค้นหา</button>
                </form>

                <!-- ปุ่ม Export ด้านขวา -->
                <a href="{{ route('export.user') }}" class="btn btn-success btn-sm mt-3" title="ส่งออก Excel">
                    ส่งออก Excel
                </a>
            </div>
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
                                <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    @if ($item->is_admin == '1')
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
