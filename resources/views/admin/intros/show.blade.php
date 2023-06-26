@extends('admin.layout.master')

@section('content')
<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{awtTrans('عرض صفحة تعريفية ')}}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form  class="store form-horizontal" >
                            <div class="form-body">
                                <div class="row">
                                    
                                    <div class="col-12">
                                        <div class="imgMontg col-12 text-center">
                                            <div class="dropBox">
                                                <div class="textCenter">
                                                    <div class="imagesUploadBlock">
                                                        <label class="uploadImg">
                                                            <span><i class="feather icon-image"></i></span>
                                                            <input type="file" accept="image/*" name="image" class="imageUploader">
                                                        </label>
                                                        <div class="uploadedBlock">
                                                            <img src="{{$row->image}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('السؤال بالعربية')}}</label>
                                            <div class="controls">
                                                <input type="text" name="title_ar" value="{{$row->getTranslations('title')['ar']}}" class="form-control" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('السؤال بالانجليزية')}}</label>
                                            <div class="controls">
                                                <input type="text" name="title_en" value="{{$row->getTranslations('title')['en']}}" class="form-control" placeholder="{{awtTrans('اكتب السؤال بالانجليزية')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                            </div>
                                        </div>
                                    </div> --}}
                                    
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="account-name">{{awtTrans('العنوان  بالعربية')}}</label>
                                                <textarea class="form-control" name="title_ar" id="" cols="30" rows="10" placeholder="{{awtTrans('العنوان بالعربية')}}">{{$row->getTranslations('title')['ar']}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="account-name">{{awtTrans('العنوان  بالانجليزية')}}</label>
                                                <textarea class="form-control" name="title_en" id="" cols="30" rows="10" placeholder="{{awtTrans('العنوان بالانجليزية')}}">{{$row->getTranslations('title')['en']}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="account-name">{{awtTrans('الوصف  بالعربية')}}</label>
                                                <textarea class="form-control" name="description_ar" id="" cols="30" rows="10" placeholder="{{awtTrans('الوصف بالعربية')}}">{{$row->getTranslations('description')['ar']}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="account-name">{{awtTrans('الوصف  بالانجليزية')}}</label>
                                                <textarea class="form-control" name="description_en" id="" cols="30" rows="10" placeholder="{{awtTrans('الوصف بالانجليزية')}}">{{$row->getTranslations('description')['en']}}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-center mt-3">
                                        <a href="{{ url()->previous() }}" type="reset" class="btn btn-outline-warning mr-1 mb-1">{{awtTrans(' رجوع ')}}</a>
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
        $('.store input').attr('disabled' , true)
        $('.store textarea').attr('disabled' , true)
        $('.store select').attr('disabled' , true)

    </script>
@endsection