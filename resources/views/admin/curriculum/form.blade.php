@component('components.card.form')
    @slot('cardHeaderText')
        หลักสูตร
    @endslot

    @slot('form')
        <div class="row mt-3">            
            <div class="col-12">
                {{ Form::bsText('name', 'ชื่อหลักสูตร') }}
            </div>
            <div class="col-12">
                {{ Form::bsTiny('intro', 'บทนำ') }}
            </div>
            <div class="col-12">
                {{ Form::bsTiny('objective', 'วัตถุประสงค์') }}
            </div>
            <div class="col-12">
                {{ Form::bsSwitch('status', 'เปิดใช้งาน', @$rs->status, 'active', 'inactive') }}
            </div>
        </div>

        <div class="col-auto mt-3">
            <div class="float-start">
                {{ link_to_route('admin.curriculum.index', 'ย้อนกลับ', $parameters = [], $attributes = ['class' => 'btn btn-lg btn-light px-4']) }}
            </div>
            <div class="float-end">
                {{ Form::submit('บันทึก', ['class' => 'btn btn-lg bg-gradient-primary']) }}
            </div>
        </div>
    @endslot
@endcomponent
