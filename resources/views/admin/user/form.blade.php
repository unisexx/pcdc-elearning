@component('components.card.form')
    @slot('cardHeaderText')
        ผู้ใช้งาน
    @endslot

    @slot('form')
        <div class="row mt-3">
            <div class="col-12">
                {{ Form::bsText('name', 'ชื่อ') }}
            </div>
            <div class="col-12">
                {{ Form::bsText('email', 'อีเมล์') }}
            </div>
            <div class="col-12">
                {{ Form::bsPassword('password', 'รหัสผ่าน') }}
            </div>
            <div class="col-12">
                {{ Form::bsPassword('password_confirmation', 'ยืนยันรหัสผ่าน') }}
            </div>
            <div class="col-12">
                {{ Form::bsSwitch('is_admin', 'แอดมิน', @$rs->is_admin, '1', '0') }}
            </div>
        </div>

        <div class="col-auto mt-3 float-end">
            {{ link_to_route('admin.user.index', 'ย้อนกลับ', $parameters = [], $attributes = ['class' => 'btn btn-lg btn-light px-4']) }}
            {{ Form::submit('บันทึก', ['class' => 'btn btn-lg bg-gradient-primary']) }}
        </div>
    @endslot
@endcomponent
