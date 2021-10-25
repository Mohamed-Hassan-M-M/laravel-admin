@extends('layouts.admin.app')

@section('title')
    @lang('activity logs.activity logs')
@endsection

@push('styles')
    <style>
        .select2-container{
            width: 100%!important;
        }
        .select2-container--classic .select2-selection--single, .select2-container--default .select2-selection--single {
            height: 52px!important;
            padding: 5px;
            width: auto;
            border-color: #717171!important;
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
                                <li class="breadcrumb-item active"> @lang('activity logs.activity logs')
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-6 col-12">
                    <div class="btn-group">
                        {{--                        @if (auth()->check() && auth()->user()->can('delete roles'))--}}
                        @php
                            $routeGroup = 'admin/';
                            $routeGroup = str_replace('/', '.', $routeGroup);
                        @endphp
                        <form method="post" action="{{ route($routeGroup . 'activitylogs.bulk_delete') }}" style="display: inline-block;">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="record_ids" id="record-ids">
                            <button class="btn btn-danger rounded btn-info mb-1 mt-1 white buttonAnimation" disabled type="submit" id="bulk-delete" data-animation="pulse" > <span class="display-inline-block">@lang('general.bulk_delete')</span> <i class="la la-lg la-trash"></i></button>
                        </form>
                        {{--                        @endif--}}
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- datatable -->
                <section id="column-filtering">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">@lang('general.all') @lang('activity logs.activity logs')</h4>
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
                                                    <th class="align-middle text-center" style="width: 1%">
                                                        <input type="checkbox" id="record__select-all"/>
                                                        <label for="record__select-all"></label>
                                                    </th>
                                                    <th class="align-middle text-center">{{ trans('activity logs.activity') }}</th>
                                                    <th class="align-middle text-center">{{ trans('activity logs.actor') }}</th>
                                                    <th class="align-middle text-center">{{ trans('activity logs.date') }}</th>
                                                    <th class="align-middle text-center" style="width: 25%;">@lang('general.action')</th>
                                                </tr>
                                                <tbody>
                                                    @foreach($activitylogs as $item)
                                                    <tr>
                                                        <td class="align-middle text-center">
                                                            <input type="checkbox" id="record-{{$item->id}}" value="{{$item->id}}" class="record__select"/>
                                                            <label for="record-{{$item->id}}"></label>
                                                        </td>
                                                        <td class="align-middle text-center">{{ $item->description }}</td>
                                                        <td class="align-middle text-center">
                                                            @if ($item->causer)
                                                                <a href="{{ url('/admin/users/' . $item->causer->id) }}">{{ $item->causer->name }}</a>
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td class="align-middle text-center">{{ $item->created_at }}</td>
                                                        <td class="align-middle text-center">
                                                            <a href="{{route('admin.activitylogs.show', $item->id)}}" class="btn btn-jinja btn-sm ml-1 mr-1"><i class="fa fa-eye"></i> </a>
                                                            <form action="{{route('admin.activitylogs.destroy', $item->id)}}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="submit" class="btn btn-jinja btn-sm delete"><i class="fa fa-trash"></i> </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
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
        $(function () {

            const dataTablesLanguageLink = '{{(app()->getLocale() == 'ar')? asset('admin-assets/datatable-lang/ar.json') : ''}}';
            $(".data-table").dataTable().fnDestroy();
            var table = $('.data-table').DataTable({
                dom: "fltipr",
                serverSide: false,
                processing: false,
                language: {
                    "url": dataTablesLanguageLink,
                },
                order: [],
            });//end datatable
        });
    </script>
@endpush
