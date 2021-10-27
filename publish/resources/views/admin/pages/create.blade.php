@extends('layouts.admin.app')

@section('title')
    @lang('pages.pages')
@endsection

@push('styles')

@endpush

@section('content')
    <div class="app-content content">
        @include ('layouts.admin._card_header', ['routeGroup' => 'admin', 'viewName' => 'pages', 'type' => 'create'])
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
                                    <form method="POST" class="form form-horizontal" action="{{route('admin.pages.store')}}"  enctype="multipart/form-data">
                                        @csrf

                                        @include ('admin.pages.form', ['formMode' => 'create'])

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
    <script src="{{asset('tinymce/tinymce.min.js')}}"></script>
    <script>
        $(function () {
            tinymce.init({
                selector: '#content'
            });
        });
    </script>
@endpush
