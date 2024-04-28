<div class="form-group">
    {{ Form::label($name, $label) }}
    @if ($value)
        @php
            $extension = pathinfo($value, PATHINFO_EXTENSION);
        @endphp
        @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
            <div><img src="{{ asset('storage/' . $path . '/' . $value) }}" width="400"></div>
        @endif
    @endif
    {!! Form::file($name, array_merge(['class' => 'form-control form-control-lg' . ($errors->has($name) ? ' is-invalid' : null), 'placeholder' => $label], $attributes)) !!}
    {!! $errors->first($name, '<span class="invalid-feedback d-block">:message</span>') !!}
</div>
