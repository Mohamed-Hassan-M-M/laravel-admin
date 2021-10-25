<div class="form-body">
    <div class="form-group{{ $errors->has('key') ? 'has-error' : ''}}">
        {!! Form::label('key', 'Key', ['class' => 'control-label']) !!}
        {!! Form::text('key', $setting->key, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('key', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group{{ $errors->has('value') ? 'has-error' : ''}}">
        {!! Form::label('value', 'Value', ['class' => 'control-label']) !!}
        {!! Form::text('value', $setting->value, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('value', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-actions text-right">
    <button type="submit" class="btn btn-success">
        <i class="la la-check-square-o"></i> @lang('general.save')
    </button>
</div>
