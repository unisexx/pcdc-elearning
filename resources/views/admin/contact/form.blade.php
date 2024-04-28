@component('components.card.form')
    @slot('cardHeaderText')
        ข้อมูลติดต่อ
    @endslot

    @slot('form')
        <div class="row mt-3">
            <div class="col-12">
                {{ Form::bsText('address', 'ที่อยู่') }}
            </div>
            <div class="col-12">
                {{ Form::bsText('email', 'อีเมล์') }}
            </div>
            <div class="col-12">
                {{ Form::bsText('tel', 'เบอร์โทรศัพท์') }}
            </div>
            <div class="col-12">
                {{ Form::bsText('fax', 'แฟกซ์') }}
            </div>
            <div class="col-12">
                {{ Form::bsText('map', 'แผนที่') }}
            </div>
            <div class="col-12">
                {{ Form::bsText('facebook', 'facebook') }}
            </div>
            <div class="col-12">
                {{ Form::bsText('youtube', 'youtube') }}
            </div>
        </div>

        <div class="col-auto mt-3 float-end">
            {{ Form::submit('บันทึก', ['class' => 'btn btn-lg bg-gradient-primary']) }}
        </div>
    @endslot
@endcomponent
