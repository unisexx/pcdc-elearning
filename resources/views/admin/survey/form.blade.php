@component('components.card.form')
    @slot('cardHeaderText')
        แบบสำรวจความพึงพอใจ
    @endslot

    @slot('form')
        <div class="row mt-3">
            <div class="col-12">
                {{ Form::bsSelect('category_id', 'หมวดหมู่', ['1' => 'ด้านเนื้อหา', '2' => 'ด้านรูปแบบ', '3' => 'ด้านการนำไปใช้ประโยชน์']) }}
            </div>
            <div class="col-12">
                {{ Form::bsText('title', 'หัวข้อแบบสำรวจ') }}
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
