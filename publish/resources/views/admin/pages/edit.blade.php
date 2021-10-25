@extends('layouts.admin.app')

@section('title')
    @lang('pages.pages')
@endsection

@push('styles')

@endpush

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">@lang('general.dashboard')</a>
                                </li>
                                @php
                                    $routeGroup = 'admin/';
                                    $routeGroup = str_replace('/', '.', $routeGroup);
                                @endphp
                                <li class="breadcrumb-item"><a href="{{route($routeGroup . 'pages.index')}}">@lang('pages.pages')</a>
                                </li>
                                <li class="breadcrumb-item active"> @lang('general.update')
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-6 col-12">
                    <div class="btn-group">
                        <a href="{{ url()->previous() }}" class="btn btn-round btn-info mb-1 buttonAnimation" data-animation="flash" > <span class="display-inline-block">@lang('general.back')</span> </a>
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
                                    <h4 class="card-title">@lang('general.update')</h4>
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
                                        <form method="POST" class="form form-horizontal" action="{{route($routeGroup . 'pages.update', $page->id)}}"  enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf

                                            @include ('admin.pages.form', ['formMode' => 'edit'])

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
    </div>
@endsection

@push('scripts')

@endpush
