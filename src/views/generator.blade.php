@extends('layouts.admin.app')

@section('title')
    @lang('generator.generator')
@endsection

@push('styles')
    <style>
        .select2-container{
            width: 20% !important;
            text-align: center;
        }
    </style>
@endpush

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">@lang('general.dashboard')</a>
                            </li>
                            <li class="breadcrumb-item active"> @lang('generator.generator')
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Form Section -->
            <section id="horizontal-form-layouts">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">@lang('generator.generator')</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collpase show">
                                <div class="card-body">
                                    <form class="form-horizontal" method="post" action="{{ url('/admin/generator') }}">
                                        @csrf
                                        <div class="form-body">
                                            <div class="form-group row">
                                                <label for="crud_name" class="col-form-label text-right">Crud Name</label>
                                                <input type="text" name="crud_name" class="form-control" id="crud_name" placeholder="Posts" required="true">
                                            </div>
                                            <div class="form-group row">
                                                <label for="controller_namespace" class="col-form-label text-right">Controller Namespace</label>
                                                <input type="text" name="controller_namespace" class="form-control" id="controller_namespace" placeholder="Admin">
                                            </div>
                                            <div class="form-group row">
                                                <label for="route_group" class="col-form-label text-right">Route Group Prefix</label>
                                                <input type="text" name="route_group" class="form-control" id="route_group" placeholder="admin">
                                            </div>
                                            <div class="form-group row">
                                                <label for="view_path" class="col-form-label text-right">View Path</label>
                                                <input type="text" name="view_path" class="form-control" id="view_path" placeholder="admin">
                                            </div>
                                            <div class="form-group row">
                                                <label for="route" class="col-form-label text-right">Want to add route?</label>
                                                <select name="route" class="form-control" id="route">
                                                    <option value="yes">@lang('general.yes')</option>
                                                    <option value="no">@lang('general.no')</option>
                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label for="relationships" class="col-form-label text-right">Relationships</label>
                                                <input type="text" name="relationships" class="form-control" id="relationships" placeholder="comments#hasMany#App\Comment">
                                                <p class="help-block">method#relationType#Model</p>
                                            </div>
                                            <div class="form-group row">
                                                <label for="form_helper" class="col-form-label text-right">Form Helper</label>
                                                <input type="text" name="form_helper" class="form-control" id="form_helper" placeholder="laravelcollective" value="laravelcollective">
                                            </div>
                                            <div class="form-group row">
                                                <label for="soft_deletes" class=" col-form-label text-right">Want to use soft deletes?</label>
                                                <select name="soft_deletes" class="form-control" id="soft_deletes">
                                                    <option value="no">@lang('general.no')</option>
                                                    <option value="yes">@lang('general.yes')</option>
                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label for="localize" class="col-form-label text-right">Want to use locales?</label>
                                                <select name="localize" class="form-control" id="localize">
                                                    <option value="no">@lang('general.no')</option>
                                                    <option value="yes">@lang('general.yes')</option>
                                                </select>
                                            </div>
                                            <hr>
                                            <div class="form-group table-fields">
                                                <h4 class="text-center">Table Fields</h4><br>
                                                <div class="entry col-md-12 d-flex justify-content-center form-inline">
                                                    <label class="m-1">Field Name</label>
                                                    <input class="form-control text-center" name="fields[]" type="text" placeholder="field_name" required="true">
                                                    <label class="m-1">Required</label>
                                                    <select name="fields_required[]" class="form-control text-center">
                                                        <option value="0">@lang('general.no')</option>
                                                        <option value="1">@lang('general.yes')</option>
                                                    </select>
                                                    <label class="m-1">translatable</label>
                                                    <select name="fields_translated[]" class="form-control text-center">
                                                        <option value="0" selected>@lang('general.no')</option>
                                                        <option value="1">@lang('general.yes')</option>
                                                    </select>
                                                    <label class="m-1">Type</label>
                                                    <select name="fields_type[]" class="form-control select-opt select-custom">
                                                        <option value="string">string</option>
                                                        <option value="char">char</option>
                                                        <option value="varchar">varchar</option>
                                                        <option value="password">password</option>
                                                        <option value="email">email</option>
                                                        <option value="date">date</option>
                                                        <option value="datetime">datetime</option>
                                                        <option value="time">time</option>
                                                        <option value="timestamp">timestamp</option>
                                                        <option value="text">textarea</option>
                                                        <option value="mediumtext">mediumtext</option>
                                                        <option value="longtext">longtext</option>
                                                        <option value="json">json</option>
                                                        <option value="jsonb">jsonb</option>
                                                        <option value="binary">binary</option>
                                                        <option value="number">number</option>
                                                        <option value="integer">integer</option>
                                                        <option value="bigint">bigint</option>
                                                        <option value="mediumint">mediumint</option>
                                                        <option value="tinyint">tinyint</option>
                                                        <option value="smallint">smallint</option>
                                                        <option value="boolean">boolean</option>
                                                        <option value="decimal">decimal</option>
                                                        <option value="double">double</option>
                                                        <option value="float">float</option>
                                                        <option value="enum">enum</option>
                                                        <option value="select">select</option>
                                                        <option value="file">file</option>
                                                    </select>
                                                    <input class="form-control select-options" style="display: none;min-width: 50%" name="options[]" type="text" placeholder='{"tips": "Tips", "health": "Health"}' value="{}">
                                                    <button class="btn btn-success btn-add inline m-1" type="button">
                                                        <span class="la la-plus"> @lang('general.add')</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions text-right">
                                            <button type="submit" class="btn btn-success">
                                                <i class="la la-check-square-o"></i> @lang('generator.generate')
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Form Sections -->
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $( document ).ready(function() {
            $('.select-custom').select2();
            $(document).on('click', '.btn-add', function(e) {
                e.preventDefault();

                $('.select-custom').select2("destroy");

                var tableFields = $('.table-fields'),
                    currentEntry = $(this).parents('.entry:first');
                tableFields.append('<hr>');
                var newEntry = $(currentEntry.clone()).appendTo(tableFields);

                $('.select-custom').select2();

                newEntry.find('input').val('');
                tableFields.find('.entry:not(:last) .btn-add')
                    .removeClass('btn-add').addClass('btn-remove')
                    .removeClass('btn-success').addClass('btn-danger')
                    .html('<span class="la la-minus">Rem</span>');
            }).on('click', '.btn-remove', function(e) {
                $(this).parents().next('hr').remove();
                $(this).parents('.entry:first').remove();
                e.preventDefault();
                return false;
            });

            $('body').on('change', '.select-custom', function(e) {
                if($(this).val() == 'enum' || $(this).val() == 'select'){
                    console.log('here');
                    $(this).parent().find('.select-options').val('');
                    $(this).parent().find('.select-options').show();
                }
                if($(this).val() != 'enum' && $(this).val() != 'select'){
                    $(this).parent().find('.select-options').hide();
                }
            });


        });
    </script>
@endpush
