<div class="form-group">
    {{ Form::label($name, $label) }}
    {{ Form::password($name, array_merge(['class' => 'form-control form-control-lg' . ($errors->has($name) ? ' is-invalid' : null), 'placeholder' => $label], $attributes)) }}
    {!! $errors->first($name, '<span class="invalid-feedback d-block">:message</span>') !!}
</div>
