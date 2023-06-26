@extends('admin.layout.master')
{{-- extra css files --}}
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/plugins/forms/validation/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
    <style>
        .uploadedBlock img{
            width: auto!important;
        }
    </style>
@endsection
{{-- extra css files --}}

@section('content')
    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('dashboard.Add Cover')}}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form  method="POST" action="{{route('admin.cover.store')}}" class="store form-horizontal" novalidate>
                                @csrf
                                <div class="form-body">
                                    <p> انواع الصور المطلوبه
                                        (jpeg ,
                                        jpg ,
                                        png)</p>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="imgMontg col-12 text-center">
                                                <div class="dropBox">
                                                    <div class="textCenter">
                                                        <div class="imagesUploadBlock">
                                                            <label class="uploadImg">
                                                                <span><i class="feather icon-image"></i></span>
                                                                <input onchange="previewImag(this ,7 ,10,1)" type="file" accept="image/*" name="image" class="imageUploader">
                                                            </label>
                                                        </div>
                                                        <p>
                                                            <p>{{__('dashboard.front.img')}}</p>
                                                            <small>ابعاد الصوره المطلوبه (10 : 7)</small>
                                                            <small class="aspect_error d-none" style="color: #ff2332 ;display: block">يجب ان تكون ابعاد الصورة المححده قريبة من النسبة <br>  (10 : 7)</small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-4">
                                            <div class="imgMontg col-12 text-center">
                                                <div class="dropBox">
                                                    <div class="textCenter">
                                                        <div class="imagesUploadBlock">
                                                            <label class="uploadImg">
                                                                <span><i class="feather icon-image"></i></span>
                                                                <input onchange="previewImag(this,7 ,10,2)" type="file" accept="image/*" name="back_img" class="imageUploader">
                                                            </label>
                                                        </div>
                                                        <p>
                                                            <p>{{__('dashboard.back.img')}}</p>
                                                            <small>ابعاد الصوره المطلوبه (10 : 7)</small>
                                                            <small class="aspect_error d-none" style="color: #ff2332 ;display: block">يجب ان تكون ابعاد الصورة المححده قريبة من النسبة <br>  (10 : 7)</small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-4">
                                            <div class="imgMontg col-12 text-center">
                                                <div class="dropBox">
                                                    <div class="textCenter">
                                                        <div class="imagesUploadBlock">
                                                            <label class="uploadImg">
                                                                <span><i class="feather icon-image"></i></span>
                                                                <input onchange="previewImag(this,1 ,10 ,3)" type="file" accept="image/*" name="edge_img" class="imageUploader">
                                                            </label>
                                                        </div>

                                                        <p>
                                                            <p>{{__('dashboard.edge.img')}}</p>
                                                            <small>ابعاد الصوره المطلوبه (10 : 1)</small>
                                                            <small class="aspect_error d-none" style="color: #ff2332 ;display: block">يجب ان تكون ابعاد الصورة المححده قريبة من النسبة <br>  (10 : 1)</small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


{{--                                        <div class="col-3">--}}
{{--                                            <div class="imgMontg col-12 text-center">--}}
{{--                                                <div class="dropBox">--}}
{{--                                                    <div class="textCenter">--}}
{{--                                                        <div class="imagesUploadBlock">--}}
{{--                                                            <label class="uploadImg">--}}
{{--                                                                <span><i class="feather icon-image"></i></span>--}}
{{--                                                                <input type="file" accept="image/*" name="file_3d" class="imageUploader">--}}
{{--                                                            </label>--}}
{{--                                                        </div>--}}
{{--                                                        <p>--}}
{{--                                                            {{__('dashboard.3d_file')}}--}}
{{--                                                        </p>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}



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

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="first-name-column">{{__('dashboard.The Price')}}</label>
                                                <div class="controls">
                                                    <input type="text" name="price" class="form-control" placeholder="{{__('dashboard.Write the price')}}" required data-validation-required-message="{{__('dashboard.This field is required')}}" >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-center mt-3">
                                            <button type="submit"  class="btn btn-primary mr-1 mb-1 submit_button">{{__('dashboard.Add')}}</button>
                                            <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{__('dashboard.Reference')}}</a>
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

    <script>

        let imgsErrors = [];

        function gcd (a, b) {
            return (b == 0) ? a : gcd (b, a % b);
        }

        function previewImag (ele ,widthR ,heightR ,errorNum){
            var fr = new FileReader;
            fr.onload = function() { // file is loaded
                var img = new Image;
                img.onload = function() {
                    var r = gcd (img.width, img.height);
                    let widthRatio  = img.width / r ;
                    let heightRatio = img.height / r ;
                    if((Math.abs(heightRatio - heightR) >= 0 && Math.abs(heightRatio - heightR) <= 2) && (Math.abs(widthRatio - widthR) >= 0 && Math.abs(widthRatio - widthR) <= 2)){
                        $(ele).parent().parent().parent().find('.aspect_error').addClass('d-none');
                        if (imgsErrors.indexOf(errorNum) !== -1){
                            imgsErrors.splice(imgsErrors.indexOf(errorNum) ,1);
                            console.log(imgsErrors)
                        }
                        if(imgsErrors.length === 0){
                            $('.submit_button').removeAttr('disabled')
                        }
                    }else{
                        $(ele).parent().parent().parent().find('.aspect_error').removeClass('d-none');
                        if (imgsErrors.indexOf(errorNum)){
                            imgsErrors.push(errorNum);
                            console.log(imgsErrors)
                        }
                        $('.submit_button').attr('disabled' ,true)
                    }
                };
                img.src = fr.result;
            };
            fr.readAsDataURL(ele.files[0]);
        }
    </script>

@endsection