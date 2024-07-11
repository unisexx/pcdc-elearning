<div class="form-group">
    @php
        $isRequired = isset($attributes['required']) && $attributes['required'];
    @endphp
    {{ Form::label($name, $label) }}
    @if ($isRequired)
        <span class="text-danger">*</span>
    @endif
    @php
        $baseClass = 'form-control';
        $sizeClass = 'form-control-lg';
        $additionalClasses = 'datepicker w-75';

        if (isset($attributes['class'])) {
            if (strpos($attributes['class'], 'form-control-sm') !== false) {
                $sizeClass = 'form-control-sm';
            } elseif (strpos($attributes['class'], 'form-control-md') !== false) {
                $sizeClass = 'form-control-md';
            } elseif (strpos($attributes['class'], 'form-control-lg') !== false) {
                $sizeClass = 'form-control-lg';
            }
        }

        $attributes['class'] = $baseClass . ' ' . $sizeClass . ' ' . $additionalClasses . ($errors->has($name) ? ' is-invalid' : '') . ' ' . ($attributes['class'] ?? '');
    @endphp
    {{ Form::text($name, $value, array_merge(['placeholder' => $label], $attributes)) }}
    {!! $errors->first($name, '<span class="invalid-feedback d-block">:message</span>') !!}
</div>
