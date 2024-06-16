@extends('layouts.frontend')

@section('page', 'แบบสำรวจความพึงพอใจ')

@section('content')
    <div class="container mt-5">
        <h2>Survey Form (เอาปุ่มไปใส่ในหน้าหลักสูตรที่ต้องการ)</h2>
        <button type="button" class="btn btn-primary open-survey-btn" data-bs-toggle="modal" data-bs-target="#surveyModal" data-curriculum-id="1">
            แบบสอบถามสำหรับหลักสูตร (curriculum_id = 1)
        </button>

        <button type="button" class="btn btn-primary open-survey-btn" data-bs-toggle="modal" data-bs-target="#surveyModal" data-curriculum-id="2">
            แบบสอบถามสำหรับหลักสูตร (curriculum_id = 2)
        </button>

        <button type="button" class="btn btn-primary open-survey-btn" data-bs-toggle="modal" data-bs-target="#surveyModal" data-curriculum-id="3">
            แบบสอบถามสำหรับหลักสูตร (curriculum_id = 3)
        </button>

        @include('components.frontend.survey')
    </div>
@endsection
