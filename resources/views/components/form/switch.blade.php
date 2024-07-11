<div class="form-group">
    {{ Form::label($name, $label) }}
    <div class="form-switch">
        {!! Form::hidden($name, $disableValue) !!}
        @php
            $baseClass = 'form-check-input';
            $attributes['class'] = $baseClass . ($errors->has($name) ? ' is-invalid' : '') . ' ' . ($attributes['class'] ?? '');
        @endphp
        {!! Form::checkbox($name, $enableValue, !$value || $value == $enableValue ? true : false, $attributes) !!}
    </div>
    {!! $errors->first($name, '<span class="invalid-feedback d-block">:message</span>') !!}
</div>
