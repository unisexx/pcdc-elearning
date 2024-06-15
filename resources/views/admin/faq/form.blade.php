@component('components.card.form')
    @slot('cardHeaderText')
        คำถามที่พบบ่อย
    @endslot

    @slot('form')
        <div class="row mt-3">
            <div class="col-12">
                {{ Form::bsText('question', 'คำถาม') }}
            </div>
            <div class="col-12">
                {{ Form::bsTextArea('answer', 'คำตอบ') }}
            </div>
            {{-- <div class="col-12">
                {{ Form::bsText('order', 'ลำดับที่', null, ['class' => 'mask-alphanumeric form-control form-control-lg']) }}
            </div> --}}
            <div class="col-12">
                {{ Form::bsSwitch('status', 'เปิดใช้งาน', @$rs->status, 'active', 'inactive') }}
            </div>
        </div>

        <div class="col-auto mt-3 float-end">
            {{ link_to_route('admin.faq.index', 'ย้อนกลับ', $parameters = [], $attributes = ['class' => 'btn btn-lg btn-light px-4']) }}
            {{ Form::submit('บันทึก', ['class' => 'btn btn-lg bg-gradient-primary']) }}
        </div>
    @endslot
@endcomponent
