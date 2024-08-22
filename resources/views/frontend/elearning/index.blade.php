@extends('layouts.frontend')

@section('page', 'ระบบการเรียนรู้ออนไลน์ e-learning')

@section('content')
    <div class="container">
        <div class="row g-4 justify-content-between mb-5 wow fadeInDown">
            <div class="col-lg-6">
                <div class="position-relative pb-2 my-4">
                    <img src="{{ asset('html/images/icon-hat.svg') }}" alt="" class="icon-hat">
                    <div class="title-send-us">เลือกหลักสูตรที่ท่านต้องการเรียนรู้</div>
                </div>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 g-4 justify-content-center wow fadeInDown" style="visibility: visible; animation-name: fadeInDown;">
            @forelse($curriculum as $item)
                @php
                    $url = url('elearning/curriculum/' . $item->id);
                @endphp
                <div class="col my-6">
                    <div class="blog-style1">
                        <div class="blog-img">
                            <a href="{{ $url }}">
                                <img src="{{ Storage::url('uploads/curriculum/' . @$item->cover_image) }}" alt="{{ $item->name }}" class="img-fluid w-100">
                            </a>
                        </div>
                        <div class="blog-content">
                            <div class="lesson d-inline-flex align-items-center">
                                <img src="{{ url('html/images/bulb.svg') }}" alt="" width="24" class="me-2">
                                <span class="mt-2">{{ $item->name }}</span>
                            </div>

                            <h3 class="blog-title h5">
                                <a href="{{ $url }}">{!! $item->intro !!}</a>
                            </h3>
                            <p>มีทั้งหมด {{ @$item->curriculum_lesson->count() }} หน่วยการเรียนรู้/บทเรียน</p>
                        </div>
                        <a href="{{ $url }}" class="blog-btn text-center">ดูรายละเอียด</a>
                    </div>
                </div>
            @empty

            @endempty
    </div>
</div>
@endsection

@push('js')
@if (session('success'))
    <script>
        Swal.fire({
            title: 'สำเร็จ!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'ตกลง'
        });
    </script>
@endif
@endpush
