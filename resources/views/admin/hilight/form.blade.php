@component('components.card.form')
    @slot('cardHeaderText')
        ไฮไลท์
    @endslot

    @slot('form')
        <div class="row mt-3">
            <div class="col-12">
                {{ Form::bsFile('image', 'รูป (ขนาด 1400 x 476 px)', @$rs->image, 'uploads/hilight', ['accept' => 'image/*']) }}
            </div>
            <div class="col-12">
                {{ Form::bsText('link', 'ลิ้งค์') }}
            </div>
            <div class="col-12">
                {{ Form::bsTiny('description', 'รายละเอียด') }}
            </div>
            <div class="col-12">
                {{ Form::bsSwitch('status', 'เปิดใช้งาน', @$rs->status, 'active', 'inactive') }}
            </div>
        </div>

        <div class="col-auto mt-3 float-end">
            {{ link_to_route('admin.hilight.index', 'ย้อนกลับ', $parameters = [], $attributes = ['class' => 'btn btn-lg btn-light px-4']) }}
            {{ Form::submit('บันทึก', ['class' => 'btn btn-lg bg-gradient-primary']) }}
        </div>
    @endslot
@endcomponent
