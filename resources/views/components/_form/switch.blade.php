<div class="form-group">
    {{ Form::label($name, $label) }}
    <div class="form-switch">
        {!! Form::hidden($name, $disableValue) !!}
        {!! Form::checkbox($name, $enableValue, !$value || $value == $enableValue ? true : false, ['class' => 'form-check-input']) !!}
    </div>
    {!! $errors->first($name, '<span class="invalid-feedback d-block">:message</span>') !!}
</div>
