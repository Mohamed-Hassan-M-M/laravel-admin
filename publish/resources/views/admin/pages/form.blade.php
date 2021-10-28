<div class="form-body">
    @foreach($languages as $language)
        <div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
            {!! Form::label('title'.'_'.$language->code, trans('pages.title') .' '. __('general.'.$language->code), ['class' => 'control-label']) !!}
            {!! Form::text("title"."_"."$language->code", $city->getTranslation('title', $language->code), ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}

            {!! $errors->first('title'.'_'.$language->code, '<p class="text-danger help-block">:message</p>') !!}
        </div>
    @endforeach
    <div class="form-group{{ $errors->has('content') ? 'has-error' : ''}}">
        {!! Form::label('content', trans('pages.content') .' '. __('general.'.$language->code), ['class' => 'control-label']) !!}
        {!! Form::textarea('content', $page->content, ['class' => 'form-control tinymce']) !!}
        {!! $errors->first('content', '<p class="text-danger help-block">:message</p>') !!}
    </div>
</div>
<div class="form-actions text-right">
    <button type="submit" class="btn btn-success">
        <i class="la la-check-square-o"></i> @lang('general.save')
    </button>
</div>
