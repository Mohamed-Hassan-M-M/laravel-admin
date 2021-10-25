<div class="form-body">
    <div class="form-group{{ $errors->has('title') ? 'has-error' : ''}}">
        {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
        {!! Form::text('title', $page->title, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('title', '<p class="text-danger help-block">:message</p>') !!}
    </div>
    <div class="form-group{{ $errors->has('content') ? 'has-error' : ''}}">
        {!! Form::label('content', 'Content', ['class' => 'control-label']) !!}
        {!! Form::textarea('content', $page->content, ['class' => 'form-control tinymce']) !!}
        {!! $errors->first('content', '<p class="text-danger help-block">:message</p>') !!}
    </div>
</div>
<div class="form-actions text-right">
    <button type="submit" class="btn btn-success">
        <i class="la la-check-square-o"></i> @lang('general.save')
    </button>
</div>
