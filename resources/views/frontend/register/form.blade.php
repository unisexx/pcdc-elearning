@extends('layouts.frontend')

@section('page', 'สมัครสมาชิก')

@section('content')
    <div class="container">
        <div class="row g-4 justify-content-between mb-5 wow fadeInDown">
            <div class="col-lg-8 mx-auto">
                <div class="box-contact">
                    <div class="title-register text-center mb-3">สมัครสมาชิก</div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {!! Form::open(['url' => route('front.register'), 'method' => 'post', 'class' => 'my-4 needs-validation register-form', 'novalidate']) !!}

                    @include('frontend.register.inc._sec1_usertype')
                    @include('frontend.register.inc._sec2_profile')
                    @include('frontend.register.inc._sec3_login')

                    <div class="col-12 mt-4 text-center">
                        <button id="registerSubmitBtn" class="btn btn-primary btn-lg px-5" type="submit">สมัครสมาชิก</button>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        fieldset {
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1),
                0 4px 6px rgba(0, 0, 0, 0.08);
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            // เรียกใช้ฟังก์ชั่นเมื่อมีการเปลี่ยนแปลง #user_type_id
            $('#user_type_id').change(function() {
                var userTypeId = $(this).val();
                loadFieldset(userTypeId);
            });

            // เรียกใช้ฟังก์ชั่นเมื่อโหลดเพจครั้งแรก
            var initialUserTypeId = $('#user_type_id').val();
            loadFieldset(initialUserTypeId);
        });

        function loadFieldset(userTypeId) {
            if (userTypeId) {
                $.ajax({
                    url: '/get-fieldset/' + userTypeId,
                    method: 'GET',
                    success: function(response) {
                        $('#form-container').html(response);
                        $('#loginSection, #registerSubmitBtn').show();
                    },
                    error: function(xhr, status, error) {
                        alert('Error: ' + error);
                    }
                });
            } else {
                $('#form-container').html('');
                $('#loginSection, #registerSubmitBtn').hide();
            }
        }
    </script>
@endpush

@push('js')
    {{-- JS Validation --}}
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\RegisterUserRequest', '.register-form') !!}
@endpush

{{-- @include('frontend.register.inc._regis_form_js') --}}

@push('modal')
    @php
        $privacy_policy = \App\Models\PrivacyPolicy::find(1);
    @endphp
    <!-- Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" style="height: 93vh;">
            <div class="modal-content" style="height: 100%;">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">{{ $privacy_policy->title }}</h5>
                </div>
                <div class="modal-body p-5" style="overflow-y: auto;">
                    {!! $privacy_policy->description !!}
                </div>
                <div class="modal-footer flex-column">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="acceptTerms">
                        <label class="form-check-label" for="acceptTerms">
                            ข้าพเจ้ายอมรับ และได้อ่านข้อความในข้อตกลงและเงื่อนไขข้างต้นโดยละเอียดแล้ว
                        </label>
                    </div>
                    <div>
                        <button id="acceptButton" type="button" class="btn btn-primary CloseModal" data-bs-dismiss="modal" disabled>ตกลง</button>
                        <a href="{{ url('/') }}" class="btn btn-link">กลับหน้าแรก</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var termsModal = new bootstrap.Modal(document.getElementById('termsModal'), {
                backdrop: 'static',
                keyboard: false
            });

            var acceptTerms = document.getElementById('acceptTerms');
            var acceptButton = document.getElementById('acceptButton');

            acceptTerms.addEventListener('change', function() {
                acceptButton.disabled = !this.checked;
            });

            acceptButton.addEventListener('click', function() {
                termsModal.hide();
            });

            termsModal.show();
        });
    </script>
@endpush
