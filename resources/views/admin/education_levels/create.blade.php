@extends('admin.layout.master')
{{-- extra css files --}}
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/plugins/forms/validation/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
@endsection
{{-- extra css files --}}

@section('content')
    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('dashboard.add_education_level')}}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form  method="POST" action="{{route('admin.education.level.store')}}" class="store form-horizontal" novalidate>
                                @csrf


                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('dashboard.the_name_of_the_academic_stage_in_arabic')}}</label>
                                                <div class="controls">
                                                    <input type="text" name="input_name[ar]" class="form-control"
                                                           placeholder="{{__('dashboard.write_the_name_of_the_schools_tage_in_arabic')}}"
                                                           required
                                                           data-validation-required-message="{{__('dashboard.This field is required')}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('dashboard.the_name_of_the_academic_stage_in_english')}}</label>
                                                <div class="controls">
                                                    <input type="text" name="input_name[en]" class="form-control"
                                                           placeholder="{{__('dashboard.write_the_name_of_the_schools_tage_in_english')}}"
                                                           required
                                                           data-validation-required-message="{{__('dashboard.This field is required')}}">
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('dashboard.The name is in Arabic')}}</label>
                                                <div class="controls">
                                                    <input type="text" name="name[ar]" class="form-control" placeholder="{{__('dashboard.Write the name in Arabic')}}" required data-validation-required-message="{{__('dashboard.This field is required')}}" >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('dashboard.The name is in English')}}</label>
                                                <div class="controls">
                                                    <input type="text" name="name[en]" class="form-control" placeholder="{{__('dashboard.Write the name in english')}}" required data-validation-required-message="{{__('dashboard.This field is required')}}" >
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-12 d-flex justify-content-center mt-3">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1 submit_button">{{__('dashboard.Add')}}</button>
                                        <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{__('dashboard.Reference')}}</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')
    <script src="{{asset('admin/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/forms/validation/form-validation.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/extensions/sweet-alerts.js')}}"></script>

    {{-- show selected image script --}}
    @include('admin.shared.addImage')
    {{-- show selected image script --}}

    {{-- submit add form script --}}
    @include('admin.shared.submitAddForm')
    {{-- submit add form script --}}

@endsection