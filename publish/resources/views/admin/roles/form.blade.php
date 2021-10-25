<div class="form-body">
    <div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
        {!! Form::label('name', 'Name: ', ['class' => 'control-label']) !!}
        {!! Form::text('name', $role->name, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('name', '<p class="text-danger help-block">:message</p>') !!}
    </div>
    <div class="form-group{{ $errors->has('label') ? ' has-error' : ''}}">
        {!! Form::label('label', 'Label: ', ['class' => 'control-label']) !!}
        {!! Form::text('label', $role->label, ['class' => 'form-control']) !!}
        {!! $errors->first('label', '<p class="text-danger help-block">:message</p>') !!}
    </div>
    <div class="form-group{{ $errors->has('label') ? ' has-error' : ''}}">
        {!! Form::label('label', 'Permissions: ', ['class' => 'control-label']) !!}
        {!! Form::select('permissions[]', $permissions, isset($role) ? $role->permissions->pluck('name') : [], ['class' => 'form-control select2', 'multiple' => true]) !!}
        {!! $errors->first('label', '<p class="text-danger help-block">:message</p>') !!}
    </div>
</div>
<div class="form-actions text-right">
    <button type="submit" class="btn btn-jinja">
        <i class="la la-check-square-o"></i> @lang('general.save')
    </button>
</div>
