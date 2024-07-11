@component('components.card.form')
    @slot('cardHeaderText')
        หมวดหมู่หลักสูตร
    @endslot

    @slot('form')
        <div class="row mt-3">
            <div class="col-12">
                {{ Form::bsText('name', 'ชื่อหมวดหมู่หลักสูตร') }}
            </div>
            <div class="col-12">
                {{ Form::bsTiny('description', 'คำอธิบาย') }}
            </div>                        
            <div class="col-12">
                {{ Form::bsSwitch('status', 'เปิดใช้งาน', @$rs->status, 'active', 'inactive') }}
            </div>
        </div>

        <div class="col-auto mt-3 float-end">
            {{ link_to_route('admin.curriculum-category.index', 'ย้อนกลับ', $parameters = [], $attributes = ['class' => 'btn btn-lg btn-light px-4']) }}
            {{ Form::submit('บันทึก', ['class' => 'btn btn-lg bg-gradient-primary']) }}
        </div>
    @endslot
@endcomponent
