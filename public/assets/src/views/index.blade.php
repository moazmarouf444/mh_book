@extends('admin.master')

@section('title', __('dashboard.__pluralName__.all___pluralName__'))

@section('content')
    <!--content wrapper -->
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">{{ __('dashboard.__pluralName__.__pluralName__') }}</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.__routeName__.index') }}">{{ __('dashboard.__pluralName__.__pluralName__') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('dashboard.__pluralName__.all___pluralName__') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end of content wrapper -->

    <!-- Data list view starts -->
    <section id="data-list-view" class="data-list-view-header">
        <div class="action-btns d-none">
            <div class="btn-dropdown mr-1 mb-1">
                <div class="btn-group dropdown actions-dropodown">
                    <button type="button" class="btn btn-white px-1 py-1 dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ __('dashboard.main.Actions') }}
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('admin.__routeName__.create') }}"><i class="feather icon-plus"></i>{{ __('dashboard.action.add') }}</a>
                        <a class="dropdown-item delete-all" href="#"><i class="feather icon-trash"></i>{{ __('dashboard.action.delete') }}</a>
                        <a class="dropdown-item action-download" href="{{ route('admin.__routeName__.downloadExcel') }}" ><i class="feather icon-file"></i>{{ __('dashboard.action.download_excel') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Data list view Ends -->

        <!-- DataTable starts -->
        <div class="table-responsive">
            <table class="table data-list-view">
                <thead>
                <tr>
                    <th></th>
                    <th>{{ __('dashboard.main.Image') }}</th>
                    @foreach(config('app.languages') as $key => $lang)
                        <th>{{ __('dashboard.main.name_in_' . $key) }}</th>
                    @endforeach

                    @foreach(config('app.languages') as $key => $lang)
                        <th>{{ __('dashboard.main.description_in_' . $key) }}</th>
                    @endforeach
                    <th>{{ __('dashboard.main.status') }}</th>
                    <th>{{ __('dashboard.main.Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach(__pluralVariable__ as __singleVariable__)
                    <tr id="row-{{__singleVariable__->id}}">
                        <td data-id="{{ __singleVariable__->id }}"></td>
                        <td class="td-img">
                            <img src="{{ __singleVariable__->imagePath }}" alt="">
                        </td>

                        @foreach(config('app.languages') as $key => $lang)
                            <td>{{ __singleVariable__->getTranslation('name', $key) }}</td>
                        @endforeach

                        @foreach(config('app.languages') as $key => $lang)
                            <td>{!! Str::limit( __singleVariable__->getTranslation('description', $key), 20) !!}</td>
                        @endforeach

                        <td>
                            <div class="chip @if(__singleVariable__->status == 1) chip-success @else chip-primary @endif">
                                <div class="chip-body">
                                    <div class="chip-text">{{ __('dashboard.categories.' . __singleVariable__->status) }}</div>
                                </div>
                            </div>
                        </td>

                        <td class="product-action">
                            <a href="{{ route('admin.__routeName__.edit', __singleVariable__) }}">
                                    <span data-id="{{ __singleVariable__->id }}" >
                                        <i class="feather icon-edit"></i>
                                    </span>
                            </a>
                            <span class="action-delete" data-url="{{ route("admin.__routeName__.destroy", __singleVariable__) }}" data-id="{{ __singleVariable__->id }}" title="{{ __('dashboard.action.delete') }}">
                                    <i class="feather icon-trash"></i>
                                </span>

                            <a href="{{ route('admin.__routeName__.show', __singleVariable__) }}">
                                <span title="{{ __('dashboard.action.show') }}">
                                    <i class="feather icon-eye"></i>
                                </span>
                            </a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- DataTable ends -->

    </section>
    <!-- Data list view end -->

@endsection

@section('scripts')
    <script>
        var selectedItems = [],
            rowId;

        $('.action-delete').on('click', function () {
            var url = $(this).data('url'),
                rowId = $(this).data('id');

            swal_confirm_delete(url, rowId);
        });

        $('.delete-all').click(function () {
            var url = "{{ route('admin.__routeName__.destroy_selected') }}";
            $('.dt-checkboxes:checked').each(function () {
                selectedItems.push($(this).parent().data('id'));
            });
            console.log(selectedItems);
            swal_confirm_delete_selected(url, selectedItems);
        });

    </script>
    @include('admin.includes.confirm-deletes')
@endsection
