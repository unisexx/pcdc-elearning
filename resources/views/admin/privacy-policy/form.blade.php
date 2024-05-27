@component('components.card.form')
    @slot('cardHeaderText')
        นโยบายส่วนบุคคล
    @endslot

    @slot('form')
        <div class="row mt-3">
            <div class="col-12">
                {{ Form::bsText('title', 'หัวข้อ') }}
            </div>
            <div class="col-12">
                {{ Form::bsTiny('description', 'รายละเอียด') }}
            </div>
        </div>

        <div class="col-auto mt-3 float-end">
            {{ Form::submit('บันทึก', ['class' => 'btn btn-lg bg-gradient-primary']) }}
        </div>
    @endslot
@endcomponent
