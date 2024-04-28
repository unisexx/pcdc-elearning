<div class="form-group">
    {{ Form::label($name, $label) }}
    {{ Form::select($name, $selectOptionArray, $value, array_merge(['class' => 'form-control form-control-lg' . ($errors->has($name) ? ' is-invalid' : null), 'placeholder' => '--- เลือก ---'], $attributes)) }}
    {!! $errors->first($name, '<span class="invalid-feedback d-block">:message</span>') !!}
</div>
