<!-- Modal -->
<div class="modal fade" id="surveyModal" tabindex="-1" aria-labelledby="surveyModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="surveyModalLabel">แบบสำรวจความพึงพอใจ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="surveyForm" method="POST">
                    @csrf
                    <input type="hidden" name="curriculum_id" id="curriculum_id">
                    @foreach ($surveys as $item)
                        <div class="mb-3">
                            <label for="question{{ $item->id }}" class="form-label">{{ $item->title }}</label>
                            <div class="smiley-group">
                                <input type="radio" id="question{{ $item->id }}_1" name="question{{ $item->id }}" value="1">
                                <label for="question{{ $item->id }}_1"><i class="fas fa-frown"></i></label>

                                <input type="radio" id="question{{ $item->id }}_2" name="question{{ $item->id }}" value="2">
                                <label for="question{{ $item->id }}_2"><i class="fas fa-frown-open"></i></label>

                                <input type="radio" id="question{{ $item->id }}_3" name="question{{ $item->id }}" value="3">
                                <label for="question{{ $item->id }}_3"><i class="fas fa-meh"></i></label>

                                <input type="radio" id="question{{ $item->id }}_4" name="question{{ $item->id }}" value="4">
                                <label for="question{{ $item->id }}_4"><i class="fas fa-smile"></i></label>

                                <input type="radio" id="question{{ $item->id }}_5" name="question{{ $item->id }}" value="5">
                                <label for="question{{ $item->id }}_5"><i class="fas fa-laugh"></i></label>
                            </div>
                        </div>
                    @endforeach
                    <div class="mb-3">
                        <label for="suggestion" class="form-label">ข้อเสนอแนะ</label>
                        <textarea class="form-control" id="suggestion" name="suggestion" rows="3"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-primary" id="submitBtn" disabled>ส่งแบบสำรวจ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('css')
    <style>
        .smiley-group {
            display: flex;
            gap: 10px;
            justify-content: space-around;
        }

        .smiley-group input[type="radio"] {
            display: none;
        }

        .smiley-group label {
            cursor: pointer;
            font-size: 2rem;
            transition: opacity 0.3s ease;
        }

        .smiley-group label .fa-frown {
            color: red;
        }

        .smiley-group label .fa-frown-open {
            color: #ff7e19;
        }

        .smiley-group label .fa-meh {
            color: #ffbf31;
        }

        .smiley-group label .fa-smile {
            color: #20a8f8;
        }

        .smiley-group label .fa-laugh {
            color: green;
        }

        .smiley-group input[type="radio"]:not(:checked)+label {
            opacity: 0.5;
        }

        .smiley-group input[type="radio"]:checked+label {
            opacity: 1;
        }
    </style>
@endpush

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('surveyForm');
            const submitBtn = document.getElementById('submitBtn');
            const radios = form.querySelectorAll('input[type="radio"]');
            const curriculumIdInput = document.getElementById('curriculum_id');

            document.querySelectorAll('.open-survey-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const curriculumId = this.getAttribute('data-curriculum-id');
                    curriculumIdInput.value = curriculumId;
                });
            });

            function checkRadios() {
                const groups = new Set();
                radios.forEach(radio => {
                    if (radio.checked) {
                        groups.add(radio.name);
                    }
                });
                submitBtn.disabled = groups.size < {{ $surveys->count() }};
            }

            radios.forEach(radio => {
                radio.addEventListener('change', checkRadios);
            });

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(form);
                fetch(`{{ route('survey.submit') }}`, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: 'แบบสำรวจถูกส่งเรียบร้อยแล้ว',
                                icon: 'success',
                                confirmButtonText: 'ตกลง'
                            }).then(() => {
                                form.reset();
                                radios.forEach(radio => radio.checked = false); // Uncheck radio buttons
                                checkRadios();
                                submitBtn.disabled = true;
                                var modal = bootstrap.Modal.getInstance(document.getElementById('surveyModal'));
                                modal.hide();
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'เกิดข้อผิดพลาดในการส่งแบบสำรวจ',
                                icon: 'error',
                                confirmButtonText: 'ตกลง'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Error!',
                            text: 'เกิดข้อผิดพลาดในการส่งแบบสำรวจ',
                            icon: 'error',
                            confirmButtonText: 'ตกลง'
                        });
                    });
            });
        });
    </script>
@endpush
