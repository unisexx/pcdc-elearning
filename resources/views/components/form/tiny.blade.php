<div class="form-group">
    {{ Form::label($name, $label) }}
    @php
        $baseClass = 'form-control';
        $sizeClass = 'form-control-lg';
        if (isset($attributes['class'])) {
            if (strpos($attributes['class'], 'form-control-sm') !== false) {
                $sizeClass = 'form-control-sm';
            } elseif (strpos($attributes['class'], 'form-control-md') !== false) {
                $sizeClass = 'form-control-md';
            } elseif (strpos($attributes['class'], 'form-control-lg') !== false) {
                $sizeClass = 'form-control-lg';
            }
        }
        $additionalClasses = 'tiny';
        $attributes['class'] = $baseClass . ' ' . $sizeClass . ' ' . $additionalClasses . ($errors->has($name) ? ' is-invalid' : '') . ' ' . ($attributes['class'] ?? '');
    @endphp
    {{ Form::textarea($name, $value, array_merge(['placeholder' => $label], $attributes)) }}
    {!! $errors->first($name, '<span class="invalid-feedback d-block">:message</span>') !!}
</div>
