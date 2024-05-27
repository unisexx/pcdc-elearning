@component('components.card.form')
    @slot('cardHeaderText')
        กล่องข้อความ
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
                {{ Form::bsText('tel', 'โทรศัพท์') }}
            </div>
            <div class="col-12">
                {{ Form::bsTextArea('msg', 'ข้อความ') }}
            </div>
        </div>

        <div class="col-auto mt-3 float-end">
            {{ link_to_route('admin.inbox.index', 'ย้อนกลับ', $parameters = [], $attributes = ['class' => 'btn btn-lg btn-light px-4']) }}
            {{ Form::submit('บันทึก', ['class' => 'btn btn-lg bg-gradient-primary']) }}
        </div>
    @endslot
@endcomponent
