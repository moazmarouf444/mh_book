@extends('admin.layout.master')
@section('css')
    <style>
        .uploadedBlock img{
            width: auto!important;
        }
    </style>
@endsection
@section('content')
    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('dashboard.cover_show')}}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="store form-horizontal">
                                <div class="form-body">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="imgMontg col-12 text-center">
                                                    <div class="dropBox">
                                                        <div class="textCenter">
                                                            <div class="imagesUploadBlock">
                                                                <label class="uploadImg">
                                                                    <span><i class="feather icon-image"></i></span>
                                                                    <input type="file" accept="image/*" name="image"
                                                                           class="imageUploader">
                                                                </label>
                                                                <div class="uploadedBlock">
                                                                    <img src="{{$row->image}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p>{{__('dashboard.front.img')}}</p>

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
                                                                    <input type="file" accept="image/*" name="image"
                                                                           class="imageUploader">
                                                                </label>
                                                                <div class="uploadedBlock">
                                                                    <img src="{{$row->back_img}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p>{{__('dashboard.back.img')}}</p>

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
                                                                    <input type="file" accept="image/*" name="image"
                                                                           class="imageUploader">
                                                                </label>
                                                                <div class="uploadedBlock">
                                                                    <img src="{{$row->edge_img}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p>{{__('dashboard.edge.img')}}</p>

                                                    </div>
                                                </div>
                                            </div>

{{--                                            <div class="col-3">--}}
{{--                                                <div class="imgMontg col-12 text-center">--}}
{{--                                                    <div class="dropBox">--}}
{{--                                                        <div class="textCenter">--}}
{{--                                                            <div class="imagesUploadBlock">--}}
{{--                                                                <label class="uploadImg">--}}
{{--                                                                    <span><i class="feather icon-image"></i></span>--}}
{{--                                                                    <input type="file" accept="image/*" name="image"--}}
{{--                                                                           class="imageUploader">--}}
{{--                                                                </label>--}}
{{--                                                                <div class="uploadedBlock">--}}
{{--                                                                    <img src="{{$row->file_3d}}">--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <p>{{__('dashboard.3d_file')}}</p>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}


                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('dashboard.The name is in Arabic')}}</label>
                                                    <div class="controls">
                                                        <input type="text" name="name_ar"
                                                               value="{{$row->getTranslations('name')['ar']}}"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('dashboard.The name is in English')}}</label>
                                                    <div class="controls">
                                                        <input type="text" name="name_en"
                                                               value="{{$row->getTranslations('name')['en']}}"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('dashboard.The Price')}}</label>
                                                    <div class="controls">
                                                        <input type="text" name="price" class="form-control"
                                                               value="{{$row->price}}">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-12 d-flex justify-content-center mt-3">
                                                <a href="{{ url()->previous() }}" type="reset"
                                                   class="btn btn-outline-warning mr-1 mb-1">{{__('dashboard.Reference')}}</a>
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
    <script>
        $('.store input').attr('disabled', true)
        $('.store textarea').attr('disabled', true)
        $('.store select').attr('disabled', true)

    </script>
@endsection