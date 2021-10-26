@extends('layouts.admin.app')

@section('title')
    @lang('activity logs.activity logs')
@endsection

@push('styles')
    <style>
        .select2-container{
            width: 100%!important;
        }
    </style>
@endpush

@section('content')
    <div class="app-content content">
        @include ('layouts.admin._card_header', ['routeGroup' => 'admin', 'viewName' => 'activitylogs', 'type' => 'show'])
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
                                            <th>ID</th><td>{{ $activitylog->id }}</td>
                                        </tr>
                                        <tr>
                                            <th> {{ trans('activity logs.activity') }} </th><td> {{ $activitylog->description }} </td>
                                        </tr>
                                        <tr>
                                            <th> {{ trans('activity logs.actor') }} </th>
                                            <td>
                                                @if ($activitylog->causer)
                                                    <a href="{{ url('/admin/users/' . $activitylog->causer->id) }}">{{ $activitylog->causer->name }}</a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> {{ trans('activity logs.date') }} </th><td> {{ $activitylog->created_at }} </td>
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
