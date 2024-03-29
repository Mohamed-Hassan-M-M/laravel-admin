@extends('layouts.admin.app')

@section('title')
@lang('pages.pages')
@endsection

@push('styles')
<style>
    .select2-container {
        width: 100% !important;
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
                        <li class="breadcrumb-item"><a href="{{route('admin.pages.index')}}">@lang('pages.pages')</a>
                        </li>
                        <li class="breadcrumb-item active"> @lang('general.show')</li>
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
                        <h4 class="card-title">@lang('general.show')</h4>
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
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>ID</th>
                                            <td>{{ $page->id }}</td>
                                        </tr>
                                        <tr>
                                            <th> {{ trans('pages.title') }} @lang('general.'.'en') </th>
                                            <td> {{ $page->getTranslation('title','en') }} </td>
                                        </tr>
                                        <tr>
                                            <th> {{ trans('pages.title') }} @lang('general.'.'ar') </th>
                                            <td> {{ $page->getTranslation('title','ar') }} </td>
                                        </tr>
                                        <tr>
                                            <th> {{ trans('pages.slug') }} </th>
                                            <td> {{ $page->slug }} </td>
                                        </tr>
                                        <tr>
                                            <th> {{ trans('pages.content') }} </th>
                                            <td> {!! $page->content !!} </td>
                                        </tr>
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

@endpush