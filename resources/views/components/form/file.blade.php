<div class="form-group">
    {{ Form::label($name, $label) }}
    @if ($value)
        @php
            $extension = pathinfo($value, PATHINFO_EXTENSION);
        @endphp
        @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
            <div><img src="{{ asset('storage/' . $path . '/' . $value) }}" style="max-width: 400px; max-height:100px;"></div>
        @elseif ($extension == 'pdf')
            <div>
                <a href="{{ asset('storage/' . $path . '/' . $value) }}" target="_blank" class="btn btn-outline-primary">
                    <i class="fas fa-file-pdf"></i> ดูเอกสารแนบ
                </a>
            </div>
        @endif
    @endif
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

        $attributes['class'] = $baseClass . ' ' . $sizeClass . ($errors->has($name) ? ' is-invalid' : '') . ' ' . ($attributes['class'] ?? '');
    @endphp
    {!! Form::file($name, array_merge(['placeholder' => $label], $attributes)) !!}
    {!! $errors->first($name, '<span class="invalid-feedback d-block">:message</span>') !!}
</div>
