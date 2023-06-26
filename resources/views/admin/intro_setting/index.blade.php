@extends('admin.layout.master')
{{-- extra css files --}}
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css-rtl/plugins/forms/validation/form-validation.css') }}">
@endsection
{{-- extra css files --}}
@section('content')

    <div class="content-body">
        <!-- account setting page start -->
        <section id="page-account-settings">
            <div class="row">
                <!-- left menu section -->
                <div class="col-md-3 mb-2 mb-md-0">
                    <ul class="nav nav-pills flex-column mt-md-0 mt-1">

                        <li class="nav-item">
                            <a class="nav-link d-flex py-75 active" id="account-pill-main" data-toggle="pill" href="#account-vertical-main" aria-expanded="true">
                                <i class="feather icon-globe mr-50 font-medium-3"></i>
                                {{awtTrans('إعدادات التطبيق')}}
                            </a>
                        </li>
                        <li class="nav-item" style="margin-top: 3px">
                            <a class="nav-link d-flex py-75" id="account-pill-texts" data-toggle="pill" href="#account-vertical-texts" aria-expanded="false">
                                <i class="feather icon-edit mr-50 font-medium-3"></i>
                                {{awtTrans('نصوص متكرره')}}
                            </a>
                        </li>
                        <li class="nav-item" style="margin-top: 3px">
                            <a class="nav-link d-flex py-75" id="account-pill-about" data-toggle="pill" href="#account-vertical-about" aria-expanded="false">
                                <i class="feather icon-file mr-50 font-medium-3"></i>
                                {{awtTrans('عن التطبيق')}}
                            </a>
                        </li>

                    </ul>
                </div>
                <!-- right content section -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="tab-content">

                                    <div role="tabpanel" class="tab-pane active" id="account-vertical-main" aria-labelledby="account-pill-main" aria-expanded="true">
                                        <form action="{{route('admin.settings.update')}}" method="post" enctype="multipart/form-data" class="form-horizontal" novalidate >
                                            @method('put')
                                            @csrf
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{awtTrans('اسم الموقع التعريفي بالعربي')}}</label>
                                                            <input type="text" class="form-control" name="intro_name_ar" id="account-name" placeholder="{{awtTrans('اسم الموقع التعريفي بالعربي')}}" value="{{$data['intro_name_ar']}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{awtTrans('اسم الموقع التعريفي بالانجليزيه')}}</label>
                                                            <input type="text" class="form-control" name="intro_name_en" id="account-name" placeholder="{{awtTrans('اسم الموقع التعريفي بالانجليزيه')}}" value="{{$data['intro_name_en']}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{awtTrans('البريد الالكتروني')}}</label>
                                                            <input type="email" class="form-control" name="intro_email" id="account-name" placeholder="{{awtTrans('البريد الالكتروني')}}" value="{{$data['intro_email']}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" data-validation-email-message="{{awtTrans('صيغة الايميل غير صحيحة')}}"  >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{awtTrans('رقم الهاتف')}}</label>
                                                            <input type="text" class="form-control" name="intro_phone" minlength="10" id="account-name" placeholder="{{awtTrans('رقم الهاتف')}}" value="{{$data['intro_phone']}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" data-validation-minlength-message="{{awtTrans('يجب ان يكون رقم الهاتف 10 ارقام علي الاقل')}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{awtTrans('العنوان')}}</label>
                                                            <input type="text" class="form-control" name="intro_address" id="account-name" placeholder="{{awtTrans('العنوان')}}" value="{{$data['intro_address']}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-name">{{awtTrans('لون الموقع الرئيسي')}}</label>
                                                                    <input type="color" class="form-control" name="color" id="account-name" placeholder="{{awtTrans('لون الموقع الرئيسي')}}" value="{{$data['color']}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-name">{{awtTrans('لون  ال buttons')}}</label>
                                                                    <input type="color" class="form-control" name="buttons_color" id="account-name" placeholder="{{awtTrans('لون  ال buttons')}}" value="{{$data['buttons_color']}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-name">{{awtTrans('لون  ال hover')}}</label>
                                                                    <input type="color" class="form-control" name="hover_color" id="account-name" placeholder="{{awtTrans('لون  ال hover')}}" value="{{$data['hover_color']}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">

                                                        <div class="imgMontg col-2 text-center">
                                                            <div class="dropBox">
                                                                <div class="textCenter d-flex flex-lg-column">
                                                                    <div class="imagesUploadBlock">
                                                                        <label class="uploadImg">
                                                                            <span><i class="feather icon-image"></i></span>
                                                                            <input type="file" accept="image/*" name="intro_logo" class="imageUploader">
                                                                        </label>
                                                                        <div class="uploadedBlock">
                                                                            <img src="{{$data['intro_logo'] ?? ''}}">
                                                                            <button class="close"><i class="feather icon-trash-2"></i></button>
                                                                        </div>
                                                                    </div>
                                                                    <span>{{awtTrans('صورة لوجو الموقع التعريفي')}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="imgMontg col-2 text-center">
                                                            <div class="dropBox">
                                                                <div class="textCenter d-flex flex-lg-column">
                                                                    <div class="imagesUploadBlock">
                                                                        <label class="uploadImg">
                                                                            <span><i class="feather icon-image"></i></span>
                                                                            <input type="file" accept="image/*" name="intro_loader" class="imageUploader">
                                                                        </label>
                                                                        <div class="uploadedBlock">
                                                                            <img src="{{$data['intro_loader'] ?? '' }}">
                                                                            <button class="close"><i class="feather icon-trash-2"></i></button>
                                                                        </div>
                                                                    </div>
                                                                    <span>{{awtTrans('صورة ال  loader ')}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-12 d-flex justify-content-center mt-3">
                                                    <button type="submit" class="btn btn-primary mr-1 mb-1 submit_button">{{awtTrans('حفظ التغييرات')}}</button>
                                                    <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{awtTrans(' رجوع ')}}</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="account-vertical-texts" aria-labelledby="account-pill-texts" aria-expanded="false">
                                        <form action="{{route('admin.settings.update')}}" method="post" enctype="multipart/form-data">
                                            @method('put')
                                            @csrf

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{awtTrans('عنوان قسم خدماتنا بالعربية')}}</label>
                                                            <textarea class="form-control" name="services_text_ar" id="" cols="30" rows="10" placeholder="{{awtTrans('عنوان قسم خدماتنا بالعربية')}}">{{$data['services_text_ar']}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{awtTrans('عنوان قسم خدماتنا بالانجليزية')}}</label>
                                                            <textarea class="form-control" name="services_text_en" id="" cols="30" rows="10" placeholder="{{awtTrans('عنوان قسم خدماتنا بالانجليزية')}}">{{$data['services_text_en']}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{awtTrans('عنوان قسم كيف يعمل الموقع بالعربية')}}</label>
                                                            <textarea class="form-control" name="how_work_text_ar" id="" cols="30" rows="10" placeholder="{{awtTrans('عنوان قسم كيف يعمل الموقع بالعربية')}}">{{$data['how_work_text_ar']}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{awtTrans('عنوان قسم كيف يعمل الموقع  بالانجليزية')}}</label>
                                                            <textarea class="form-control" name="how_work_text_en" id="" cols="30" rows="10" placeholder="{{awtTrans('عنوان قسم كيف يعمل الموقع  بالانجليزية')}}">{{$data['how_work_text_en']}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{awtTrans('عنوان قسم الاسئلة الشائعه بالعربية')}}</label>
                                                            <textarea class="form-control" name="fqs_text_ar" id="" cols="30" rows="10" placeholder="{{awtTrans('عنوان قسم الاسئلة الشائعه بالعربية')}}">{{$data['fqs_text_ar']}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{awtTrans('عنوان قسم الاسئلة الشائعه  بالانجليزية')}}</label>
                                                            <textarea class="form-control" name="fqs_text_en" id="" cols="30" rows="10" placeholder="{{awtTrans('عنوان قسم الاسئلة الشائعه  بالانجليزية')}}">{{$data['fqs_text_en']}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{awtTrans('عنوان قسم شركائنا بالعربية')}}</label>
                                                            <textarea class="form-control" name="parteners_text_ar" id="" cols="30" rows="10" placeholder="{{awtTrans('عنوان قسم شركائنا بالعربية')}}">{{$data['parteners_text_ar']}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{awtTrans('عنوان قسم شركائنا  بالانجليزية')}}</label>
                                                            <textarea class="form-control" name="parteners_text_en" id="" cols="30" rows="10" placeholder="{{awtTrans('parteners_text_en')}}">{{$data['parteners_text_en']}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{awtTrans('عنوان قسم تواصل بالعربية')}}</label>
                                                            <textarea class="form-control" name="contact_text_ar" id="" cols="30" rows="10" placeholder="{{awtTrans('عنوان قسم تواصل بالعربية')}}">{{$data['contact_text_ar']}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{awtTrans('عنوان قسم تواصل  بالانجليزية')}}</label>
                                                            <textarea class="form-control" name="contact_text_en" id="" cols="30" rows="10" placeholder="{{awtTrans('عنوان قسم تواصل  بالانجليزية')}}">{{$data['contact_text_en']}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 d-flex justify-content-center mt-3">
                                                    <button type="submit" class="btn btn-primary mr-1 mb-1 submit_button">{{awtTrans('حفظ التغييرات')}}</button>
                                                    <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{awtTrans(' رجوع ')}}</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="account-vertical-about" aria-labelledby="account-pill-about" aria-expanded="false">
                                        <form action="{{route('admin.settings.update')}}" method="post" enctype="multipart/form-data">
                                            @method('put')
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="imgMontg col-6 text-center">
                                                            <div class="dropBox">
                                                                <div class="textCenter d-flex flex-lg-column">
                                                                    <div class="imagesUploadBlock">
                                                                        <label class="uploadImg">
                                                                            <span><i class="feather icon-image"></i></span>
                                                                            <input type="file" accept="image/*" name="about_image_1" class="imageUploader">
                                                                        </label>
                                                                        <div class="uploadedBlock">
                                                                            <img src="{{$data['about_image_1'] ?? ''}}">
                                                                            <button class="close"><i class="feather icon-trash-2"></i></button>
                                                                        </div>
                                                                    </div>
                                                                    <span>{{awtTrans('صورة عن التطبيق الاولي')}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="imgMontg col-6 text-center">
                                                            <div class="dropBox">
                                                                <div class="textCenter d-flex flex-lg-column">
                                                                    <div class="imagesUploadBlock">
                                                                        <label class="uploadImg">
                                                                            <span><i class="feather icon-image"></i></span>
                                                                            <input type="file" accept="image/*" name="about_image_2" class="imageUploader">
                                                                        </label>
                                                                        <div class="uploadedBlock">
                                                                            <img src="{{ $data['about_image_2'] ?? ''}}">
                                                                            <button class="close"><i class="feather icon-trash-2"></i></button>
                                                                        </div>
                                                                    </div>
                                                                    <span>{{awtTrans('صورة عن التطبيق الثانية')}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{awtTrans('عن التطبيق بالعربية')}}</label>
                                                            <textarea class="form-control" name="intro_about_ar" id="" cols="30" rows="10" placeholder="{{awtTrans('عن التطبيق بالعربية')}}">{{$data['intro_about_ar']}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="account-name">{{awtTrans('عن التطبيق بالانجليزية')}}</label>
                                                            <textarea class="form-control" name="intro_about_en" id="" cols="30" rows="10" placeholder="{{awtTrans('عن التطبيق بالانجليزية')}}">{{$data['intro_about_en']}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex justify-content-center mt-3">
                                                    <button type="submit" class="btn btn-primary mr-1 mb-1 submit_button">{{awtTrans('حفظ التغييرات')}}</button>
                                                    <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{awtTrans(' رجوع ')}}</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- account setting page end -->

    </div>

@endsection
@section('js')
    <script src="{{asset('admin/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/forms/validation/form-validation.js')}}"></script>
    {{-- show selected image script --}}
    @include('admin.shared.addImage')
    {{-- show selected image script --}}
@endsection
