@extends('admin.master')

@section('title', __('dashboard.__pluralName__.show___snake_single_name__'))

@section('content')

    <!-- BEGIN: Content-->

    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">{{ __('dashboard.__pluralName__.__pluralName__') }}</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.__routeName__.index') }}">{{ __('dashboard.__pluralName__.__pluralName__') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('dashboard.__pluralName__.show___snake_single_name__') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">


        <!-- Media Alignment start -->
        <section id="media-alignment">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('dashboard.__pluralName__.show___snake_single_name__') }}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media-list media-bordered">
                                    <div class="media">
                                        <div class="media-body">
                                            <h3 class="media-heading">{{ __('dashboard.main.Image') }}</h3>
                                            <img src="{{ __singleVariable__->imagePath }}" class="mr-1 p-1" alt="img placeholder" height="150">

                                            <h3 class="media-heading">{{ __('dashboard.main.name_in_ar') }}</h3>
                                            <p>{{ __singleVariable__->getTranslation('name', 'ar') }}</p>

                                            <h3 class="media-heading">{{ __('dashboard.main.name_in_en') }}</h3>
                                            <p>{{ __singleVariable__->getTranslation('name', 'en') }}</p>

                                            <h3 class="media-heading">{{ __('dashboard.main.description_in_ar') }}</h3>
                                            <p>{!! __singleVariable__->getTranslation('description', 'ar') !!}</p>

                                            <h3 class="media-heading">{{ __('dashboard.main.description_in_en') }}</h3>
                                            <p>{!! __singleVariable__->getTranslation('description', 'en') !!}</p>


                                            <h3 class="media-heading">{{ __('dashboard.main.status') }}</h3>
                                            <p>{{ __('dashboard.categories.' . __singleVariable__->status) }}</p>

                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <a href="{{ route('admin.__routeName__.edit', __singleVariable__) }}" class="btn btn-primary mr-1">
                                            <i class="feather icon-edit-1"></i> {{ __('dashboard.action.edit') }}</a>
                                        <a class="btn btn-outline-danger action-delete" data-id="{{ __singleVariable__->id }}">
                                            <i class="feather icon-trash-2"></i> {{ __('dashboard.action.delete') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Media Alignment end -->

    </div>
    <!-- END: Content-->
@endsection

@section('scripts')
    <script>
        // On Delete
        // confirm options
        $('.action-delete').on('click', function () {
            var __jsSingleVariable__ = $(this).data('id'),
                url = '{{ route("admin.__routeName__.destroy", ":id") }}',
                newUrl = url.replace(':id', __jsSingleVariable__);

            console.log(__jsSingleVariable__);
            console.log(newUrl);

            Swal.fire({
                title: '{{ __('dashboard.alerts.do_you_want_to_delete_this_row') }}',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ __('dashboard.action.yes_delete') }}',
                confirmButtonClass: 'btn btn-primary',
                cancelButtonClass: 'btn btn-danger ml-1',
                cancelButtonText: '{{ __('dashboard.action.cancel') }}',
                buttonsStyling: false,
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        url: newUrl,
                        method: 'DELETE',
                        success: function (response) {
                            Swal.fire({
                                position: 'top-start',
                                type: 'success',
                                title: '{{ __('dashboard.alerts.deleted')  }}',
                                showConfirmButton: false,
                                timer: 1500,
                                confirmButtonClass: 'btn btn-primary',
                                buttonsStyling: false,
                            })
                            setTimeout(function () {
                                window.location.href = '{{ route('admin.__routeName__.index') }}';
                            }, 1500)
                        }
                    });
                }
            })
        });
    </script>

@stop
