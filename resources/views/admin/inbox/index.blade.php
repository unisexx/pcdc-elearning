@extends('layouts.app')

@section('title', 'กล่องข้อความ')

@section('content')
    @component('components.card.index')
        @slot('cardHeaderText')
            กล่องข้อความ
        @endslot
        @slot('table')
            <div class="table-responsive">
                <table id="datatable" class="table align-items-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ชื่อ</th>
                            <th scope="col">อีเมล์</th>
                            <th scope="col">เบอร์โทร</th>
                            <th scope="col">ตอบแล้ว</th>
                            {{-- <th scope="col">ข้อความ</th> --}}
                            <th scope="col">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rs as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ @$item->name }}</td>
                                <td>{{ @$item->email }}</td>
                                <td>{{ @$item->tel }}</td>
                                <td>
                                    @if (empty($item->reply))
                                        <span class="badge bg-warning">
                                            <i class="bi bi-hourglass-split"></i> รอการตอบกลับ
                                        </span>
                                    @else
                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle"></i> ตอบกลับแล้ว
                                        </span>
                                    @endif
                                </td>

                                {{-- <td>{{ @$item->msg }}</td> --}}
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
            <!-- Pagination -->
            <div class="mt-3">
                {{ $rs->links() }}
            </div>
        @endslot
    @endcomponent
@endsection
