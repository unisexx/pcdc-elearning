@extends('layouts.frontend')

@section('page', 'ตรวจสอบใบประกาศนียบัตร')

@section('content')
    <div class="container py-5 wow fadeInDown">
        <div class="row my-4 justify-content-center">
            @if (isset($error))
                <div class="col-md-6">
                    <div class="alert alert-danger text-center">
                        <h3>{{ $error }}</h3>
                    </div>
                </div>
            @else
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
                            <h2 class="mt-3">ใบประกาศนียบัตร</h2>
                            <p><strong>หมายเลขใบประกาศ:</strong> {{ $data['running_number'] }}</p>
                            <p><strong>ชื่อผู้รับ:</strong> {{ $data['user'] }}</p>
                            <p><strong>ชื่อหลักสูตร:</strong> {{ $data['course_name'] }}</p>
                            <p><strong>วันที่ออกใบประกาศ:</strong> {{ $data['issued_at'] }}</p>
                            <p><strong>วันหมดอายุ:</strong> {{ $data['expires_at'] }}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
