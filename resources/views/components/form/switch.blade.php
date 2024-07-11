<div class="form-group">
    @php
        $isRequired = isset($attributes['required']) && $attributes['required'];
    @endphp
    {{ Form::label($name, $label) }}
    @if ($isRequired)
        <span class="text-danger">*</span>
    @endif
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
