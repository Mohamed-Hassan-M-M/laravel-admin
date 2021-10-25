<div class="form-body">
<div class="form-group{{ $errors->has('code') ? 'has-error' : ''}}">
    {!! Form::label('code', trans('languages.code'), ['class' => 'control-label']) !!}
    {!! Form::text('code', $language->code, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}

    {!! $errors->first('code', '<p class="text-danger help-block">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', trans('languages.name'), ['class' => 'control-label']) !!}
    {!! Form::text('name', $language->name, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}

    {!! $errors->first('name', '<p class="text-danger help-block">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('icon') ? 'has-error' : ''}}">
    {!! Form::label('icon', trans('languages.icon'), ['class' => 'control-label']) !!}
    {!! Form::text('icon', $language->icon, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}

    {!! $errors->first('icon', '<p class="text-danger help-block">:message</p>') !!}
</div>


</div>
<div class="form-actions text-right">
    <button type="submit" class="btn btn-jinja">
        <i class="la la-check-square-o"></i> @lang('general.save')
    </button>
</div>
