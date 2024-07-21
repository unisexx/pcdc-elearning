@extends('layouts.app')

@section('title', 'Logs')

@section('content')
    @component('components.card.index')
        @slot('cardHeaderText')
            Logs
        @endslot
        @slot('table')
            <div class="table-responsive">
                <table id="datatable" class="table align-items-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">วันที่</th>
                            <th scope="col">ประเภท</th>
                            <th scope="col">ชื่อ</th>
                            <th scope="col">เหตุการณ์</th>
                            <th scope="col">รายละเอียด</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rs as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ @$item->created_at }}</td>
                                <td>{{ @$item->log_type }}</td>
                                <td>{{ @$item->user->name }}</td>
                                <td>{{ @$item->action }}</td>
                                <td class="text-wrap" style="max-width:300px;">
                                    @php
                                        $description = json_decode($item->description, true);
                                        if (is_array($description)) {
                                            $description = collect($description)
                                                ->map(function ($value, $key) {
                                                    return "{$key}: {$value}";
                                                })
                                                ->implode("\n");
                                        }
                                    @endphp
                                    {!! Form::textarea('description', $description, ['class' => 'form-control', 'style' => 'height: 100px; overflow-y: auto;']) !!}
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
