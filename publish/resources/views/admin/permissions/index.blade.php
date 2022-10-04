@extends('layouts.admin.app')

@section('title')
@lang('permissions.permissions')
@endsection

@push('styles')
<style>
    .select2-container {
        width: 100% !important;
    }

    .select2-container--classic .select2-selection--single,
    .select2-container--default .select2-selection--single {
        height: 52px !important;
        padding: 5px;
        width: auto;
        border-color: #717171 !important;
    }
</style>
@endpush

@section('content')
<div class="app-content content">
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.home')}}">@lang('general.dashboard')</a>
                        </li>
                        <li class="breadcrumb-item"><a
                                href="{{route('admin.permissions.index')}}">@lang('permissions.permissions')</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- datatable -->
        <section class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('general.all') @lang('permissions.permissions')</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="table">
                                <table class="table table-striped table-bordered zero-configuration data-table w-100">
                                    <thead>
                                        <tr>
                                            <th style="width: 1%">
                                                <input type="checkbox" id="record__select-all" />
                                                <label for="record__select-all"></label>
                                            </th>
                                            <th dt-type="text" dt-name="name">{{ trans('permissions.name') }}</th>
                                            <th dt-type="text" dt-name="label">{{ trans('permissions.label') }}</th>
                                            <th style="width: 25%;">@lang('general.action')</th>
                                        </tr>
                                        <tr id="searchable-row" @if(app()->getLocale() == 'ar') dir="rtl" @endif></tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/ datatable -->
    </div>
</div>
@endsection

@push('scripts')
<script>
    var lang = '{{app()->getLocale()}}';
        var dataTablesSearchLink = '{{url('admin/permissions')}}';
        const dataTablesLanguageLink = '{{(app()->getLocale() == 'ar')? asset('admin-assets/datatable-lang/ar.json') : ''}}';
</script>
<script src="{{asset('datatables/js/datatable.js')}}"></script>
@endpush