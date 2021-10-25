<div class="form-body">
    <div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
        {!! Form::label('name', __('users.name'), ['class' => 'control-label']) !!}
        {!! Form::text('name', $user->name, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('name', '<p class="text-danger help-block">:message</p>') !!}
    </div>
    <div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
        {!! Form::label('email', __('users.email'), ['class' => 'control-label']) !!}
        {!! Form::email('email', $user->email, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('email', '<p class="text-danger help-block">:message</p>') !!}
    </div>
    <div class="form-group{{ $errors->has('mobile') ? ' has-error' : ''}}">
        {!! Form::label('mobile', __('users.mobile'), ['class' => 'control-label']) !!}
        {!! Form::number('mobile', $user->mobile, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('mobile', '<p class="text-danger help-block">:message</p>') !!}
    </div>
    <div class="form-group{{ $errors->has('password') ? ' has-error' : ''}}">
        {!! Form::label('password', __('users.password'), ['class' => 'control-label']) !!}
        @php
            $passwordOptions = ['class' => 'form-control'];
            if ($formMode === 'create') {
                $passwordOptions = array_merge($passwordOptions, ['required' => 'required']);
            }
        @endphp
        {!! Form::password('password', $passwordOptions) !!}
        {!! $errors->first('password', '<p class="text-danger help-block">:message</p>') !!}
    </div>
    <div class="form-group{{ $errors->has('roles') ? ' has-error' : ''}}">
        {!! Form::label('role', __('users.role'), ['class' => 'control-label']) !!}
        {!! Form::select('roles[]', $roles, isset($user_roles) ? $user_roles : [], ['class' => 'form-control select2', 'multiple' => true]) !!}
    </div>
</div>
<div class="form-actions text-right">
    <button type="submit" class="btn btn-jinja">
        <i class="la la-check-square-o"></i> @lang('general.save')
    </button>
</div>
