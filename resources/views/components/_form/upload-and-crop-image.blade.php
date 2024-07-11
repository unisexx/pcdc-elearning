@php
    /* random ไว้เผื่อใช้ component นี้หลายครั้งในฟอร์มเดียวกัน ไอดีจะได้ไม่ซ้ำ */
    $randomByte = bin2hex(random_bytes(3));
@endphp
<div class="form-group">
    {{ Form::label($name, $label) }}
    <div>
        {{-- ปุ่มเพิ่ม & select image --}}
        {{ Form::button('<i class="fas fa-camera"></i> เพิ่มรูป', [
            'id' => 'selecImgBtn-' . $randomByte,
            'class' => 'btn btn-primary',
            'onclick' => '$(".FileUpload").click()',
            'type' => 'button',
            'style' => @$value ? 'display:none;' : '',
        ]) }}
        {{ Form::file('#tmpImage', [
            'id' => 'input-' . $randomByte,
            'class' => 'sr-only FileUpload',
            'accept' => 'image/*',
        ]) }}

        {{-- โชว์รูปที่ตัดแล้วใน resultCropImage --}}
        <div id="resultCropImage-{{ $randomByte }}" class="col-2 position-relative">
            @if (@$value)
                <img class="avatar rounded-circle" src="{{ asset('storage/uploads/user/' . $value) }}"
                    style="width:150px; height:150px;">
                <i class="far fa-times-circle fa-2x text-secondary position-absolute top-0 end-0 delImgIcon"
                    role="button"></i>
            @endif
        </div>
    </div>
</div>


@push('modal')
    <div class="modal fade" id="modal-{{ $randomByte }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">อัปโหลดภาพ</h5>
                    {{-- ปุ่ม x ปิด modal --}}
                    {{ Form::button('<i class="fas fa-times text-secondary"></i>', [
                        'class' => 'btn-close',
                        'data-bs-dismiss' => 'modal',
                        'aria-label' => 'Close',
                    ]) }}
                </div>
                <div class="modal-body">
                    {{-- แสดงรูปที่เลือกแล้ว crop รูป --}}
                    <div class="img-container">
                        <img id="image-{{ $randomByte }}" src="">
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- ปุ่มปิด & เลือกภาพที่ตัด --}}
                    {{ Form::button('ปิด', [
                        'class' => 'btn btn-secondary',
                        'data-bs-dismiss' => 'modal',
                    ]) }}
                    {{ Form::button('อัปโหลดภาพ', [
                        'id' => 'cropBtn-' . $randomByte,
                        'class' => 'btn btn-primary',
                        'data-bs-dismiss' => 'modal',
                    ]) }}
                </div>
            </div>
        </div>
    </div>
@endpush

@push('css')
    <style>
        .img-container img {
            max-width: 100%;
        }
    </style>
@endpush

@push('js')
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            var image = document.getElementById('image-' + "{{ $randomByte }}");
            var input = document.getElementById('input-' + "{{ $randomByte }}");
            var cropBtn = document.getElementById('cropBtn-' + "{{ $randomByte }}");
            var $resultCropImage = $('#resultCropImage-' + "{{ $randomByte }}");
            var $selecImgBtn = $('#selecImgBtn-' + "{{ $randomByte }}");
            var $modal = $('#modal-' + "{{ $randomByte }}");

            var cropper;

            input.addEventListener('change', function(e) {
                var files = e.target.files;

                var done = function(url) {
                    input.value = '';
                    image.src = url;
                    $modal.modal('show');
                };
                var reader;
                var file;
                var url;

                if (files && files.length > 0) {
                    file = files[0];

                    if (URL) {
                        done(URL.createObjectURL(file));
                    } else if (FileReader) {
                        reader = new FileReader();
                        reader.onload = function(e) {
                            done(reader.result);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });

            $modal.on('shown.bs.modal', function() {
                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 3,
                });
            }).on('hidden.bs.modal', function() {
                cropper.destroy();
                cropper = null;
            });

            // คลิกปุ่ม crop ใน modal
            cropBtn.onclick = function() {
                $modal.modal('hide');
                // console.log(cropper.getCroppedCanvas().toDataURL("image/png"));

                $selecImgBtn.hide();

                $resultCropImage.html('');
                $resultCropImage.append('<img class="avatar rounded-circle" src="' + cropper
                    .getCroppedCanvas()
                    .toDataURL("image/png") + '" style="width:150px; height:150px;">');
                $resultCropImage.append(
                    '<i class="far fa-times-circle fa-2x text-secondary position-absolute top-0 end-0 delImgIcon" role="button"></i>'
                );
                $resultCropImage.append('<textarea name="{{ $name }}" class="d-none">' + cropper
                    .getCroppedCanvas()
                    .toDataURL("image/png") + '</textarea>');
            };
        });

        $(function() {
            $(document).on('click', '.delImgIcon', function() {
                $(this).closest('#resultCropImage-' + "{{ $randomByte }}").html('');
                $('#selecImgBtn-' + "{{ $randomByte }}").show();
            });
        });
    </script>
@endpush
