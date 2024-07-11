<div class="form-group">
    @php
        $isRequired = isset($attributes['required']) && $attributes['required'];
    @endphp
    {{ Form::label($name, $label) }}
    @if ($isRequired)
        <span class="text-danger">*</span>
    @endif
    @php
        $baseClass = 'form-select';
        $sizeClass = 'form-select-lg';
        if (isset($attributes['class'])) {
            if (strpos($attributes['class'], 'form-select-sm') !== false) {
                $sizeClass = 'form-select-sm';
            } elseif (strpos($attributes['class'], 'form-select-md') !== false) {
                $sizeClass = 'form-select-md';
            } elseif (strpos($attributes['class'], 'form-select-lg') !== false) {
                $sizeClass = 'form-select-lg';
            }
        }
        $attributes['class'] = $baseClass . ' ' . $sizeClass . ($errors->has($name) ? ' is-invalid' : '') . ' ' . ($attributes['class'] ?? '');
    @endphp
    {{ Form::select($name, $selectOptionArray, $value, array_merge(['placeholder' => '--- เลือก ---'], $attributes)) }}
    {!! $errors->first($name, '<span class="invalid-feedback d-block">:message</span>') !!}
</div>
