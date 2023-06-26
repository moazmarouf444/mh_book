@extends('admin.master')

@section('title', __('dashboard.__pluralName__.create___snake_single_name__'))

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
                            <li class="breadcrumb-item active">{{ __('dashboard.__pluralName__.create___snake_single_name__') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end of content wrapper -->

    <div class="content-body">
        <!-- // Basic multiple Column Form section start -->
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('dashboard.__pluralName__.create___snake_single_name__') }}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form" action="{{ route('admin.__routeName__.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- You can all alert messages by removing the comment -->
                                    {{--                                    @include('admin.includes.alerts.all-errors')--}}

                                    <div class="form-body">
                                        <div class="row">

                                            @foreach(config('app.languages') as $key => $language)
                                                <div class="col-md-6 col-12">
                                                    <div class="form-label-group form-group">
                                                        <input type="text" id="{{$key}}-string_field" class="form-control" name="string_field[{{$key}}]"
                                                               placeholder="{{ __('dashboard.main.name_in_' . $key) }}" autofocus
                                                               value="{{ old("string_field.$key") }}">

                                                        <label for="{{$key}}-string_field">{{ __('dashboard.main.name_in_' . $key) }}</label>

                                                        @include('admin.includes.alerts.input-errors', ['input' => "string_field.$key"])
                                                    </div>
                                                </div>
                                            @endforeach

                                            @foreach(config('app.languages') as $key => $language)
                                                <div class="col-md-6 col-12">
                                                    <div class="form-label-group form-group">
                                                        <textarea class="form-control" id="text_field[{{$key}}]"
                                                                  name="text_field[{{$key}}]">{!! old("text_field.$key") !!}</textarea>
                                                        <label for="{{$key}}-text_field">{{ __('dashboard.main.description_in_' . $key) }}</label>

                                                        @include('admin.includes.alerts.input-errors', ['input' => "text_field.$key"])
                                                    </div>
                                                </div>
                                            @endforeach

                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group form-group">
                                                    <input type='number' id="float_field" class="form-control"
                                                           name="float_field" placeholder="float_field " value="{{ old('float_field') }}"/>

                                                    <label for="float_field">float_field</label>
                                                    @include('admin.includes.alerts.input-errors', ['input' => 'float_field'])
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group form-group">
                                                    <select class="form-control select2" name="enum_field">
                                                        <option value="active" @if(old('enum_field') == 'agreed' ) selected @endif >تم الموافقة</option>
                                                        <option value="pending" @if(old('enum_field') == 'refused' ) selected @endif >تم الرفض</option>
                                                        <option value="block" @if(old('enum_field') == 'pending' ) selected @endif >جاري الاطلاع</option>
                                                    </select>
                                                    <label for="email-id-column">{{ __('dashboard.user.status') }}</label>

                                                    @include('admin.includes.alerts.input-errors', ['input' => 'enum_field'])
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group form-group">
                                                    <input type='text' id="time_field" class="form-control pickatime"
                                                           name="time_field" placeholder="time_field"
                                                           value="{{ old('time_field') }}"/>

                                                    <label for="time_field">time_field</label>
                                                    @include('admin.includes.alerts.input-errors', ['input' => 'time_field'])
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group form-group">
                                                    <input type='text' id="date_field" class="form-control format-picker"
                                                           name="date_field" placeholder="date_field"
                                                           value="{{ old('date_field') }}"/>

                                                    <label for="date_field">date_field</label>
                                                    @include('admin.includes.alerts.input-errors', ['input' => 'date_field'])
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group form-group">
                                                    <div class="custom-control custom-switch switch-lg">
                                                        <input id="boolean_field" type="checkbox" name="boolean_field" @if(old('boolean_field') == 'on' ) checked @endif class="custom-control-input">
                                                        <label class="custom-control-label" for="boolean_field">
                                                            <span class="switch-text-left">مفعل</span>
                                                            <span class="switch-text-right">غير مفعل</span>
                                                        </label>
                                                    </div>
                                                    <label for="email-id-column">الحالة</label>

                                                    @include('admin.includes.alerts.input-errors', ['input' => 'boolean_field'])
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 ">
                                                <div class="form-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="image_field" class="custom-file-input" id="image">
                                                        <label class="custom-file-label" for="inputGroupFile01">اختر صورة </label>
                                                    </div>

                                                    <div class="form-label-group">
                                                        <div class="multi-img-result">
                                                            <div class="img-uploaded">
                                                                <img src="{{ asset('assets/uploads/__routeName__/default.png') }}" alt="default Image">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @include('admin.includes.alerts.input-errors', ['input' => 'image_field'])
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary mr-1 mb-1">{{ __('dashboard.add') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- // Basic Floating Label Form section end -->
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('includes/image-preview-2.js') }}"></script>
    <script src="{{asset('Admin/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{asset('Admin/app-assets/vendors/js/pickers/pickadate/picker.js')}}"></script>
    <script src="{{asset('Admin/app-assets/vendors/js/pickers/pickadate/picker.date.js')}}"></script>
    <script src="{{asset('Admin/app-assets/vendors/js/pickers/pickadate/picker.time.js')}}"></script>
    <script src="{{asset('Admin/app-assets/vendors/js/pickers/pickadate/legacy.js')}}"></script>
    <script src="{{ asset('includes/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('text_field[ar]',{
            contentsLangDirection:'rtl',
            language: '{{ app()->getLocale() }}',
            removePlugins:'image,flash,iframe,smiley,about',

        });
        CKEDITOR.replace('text_field[en]',{
            contentsLangDirection:'ltr',
            language: '{{ app()->getLocale() }}',
            removePlugins:'image,flash,iframe,smiley,about',

        });

        $(".select2").select2({
            dropdownAutoWidth: true,
            width: '100%'
        });

        $('.pickatime').pickatime();
        $('.format-picker').pickadate();
    </script>
@stop
