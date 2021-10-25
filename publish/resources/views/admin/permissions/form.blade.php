<div class="form-body">
    <div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
        {!! Form::label('name', __("permissions.name"), ['class' => '']) !!}
        {!! Form::text('name', $permission->name, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('name', '<p class="text-danger help-block">:message</p>') !!}
    </div>
    <div class="form-group{{ $errors->has('label') ? ' has-error' : ''}}">
        {!! Form::label('label', __("permissions.label"), ['class' => '']) !!}
        {!! Form::text('label', $permission->label, ['class' => 'form-control']) !!}
        {!! $errors->first('label', '<p class="text-danger help-block">:message</p>') !!}
    </div>
</div>
<div class="form-actions text-right">
    <button type="submit" class="btn btn-jinja">
        <i class="la la-check-square-o"></i> @lang('general.save')
    </button>
</div>
