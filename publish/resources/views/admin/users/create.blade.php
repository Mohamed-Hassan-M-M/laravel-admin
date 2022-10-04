@extends('layouts.admin.app')

@section('title')
@lang('users.users')
@endsection

@push('styles')

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
                                href="{{route('admin.users.index')}}">@lang('users.users')</a>
                        </li>
                        <li class="breadcrumb-item active"> @lang('general.create')</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Form Section -->
        <section class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('general.create')</h4>
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
                            <form method="POST" class="form form-horizontal" action="{{route('admin.users.store')}}"
                                enctype="multipart/form-data">
                                @csrf

                                @include ('admin.users.form', ['formMode' => 'create'])

                            </form>
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

@endpush