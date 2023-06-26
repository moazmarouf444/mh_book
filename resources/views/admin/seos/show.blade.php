@extends('admin.layout.master')

@section('content')
<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{awtTrans('عرض سيو ')}}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form  class="store form-horizontal" >
                            <div class="form-body">
                                <div class="row">
                                    
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('key')}}</label>
                                            <div class="controls">
                                                <input type="text" value="{{$row->key}}" name="key" class="form-control" placeholder="{{awtTrans('اكتب key')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('meta title بالعربية')}}</label>
                                            <div class="controls">
                                                <textarea name="meta_title_ar" class="form-control" placeholder="{{awtTrans('اكتب meta title')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" cols="30" rows="10">{{$row->getTranslations('meta_title')['ar']}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('meta title بالانجليزية')}}</label>
                                            <div class="controls">
                                                <textarea name="meta_title_en" class="form-control" placeholder="{{awtTrans('اكتب meta title')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" cols="30" rows="10">{{$row->getTranslations('meta_title')['en']}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('meta description بالعربية')}}</label>
                                            <div class="controls">
                                                <textarea name="meta_description_ar" class="form-control" placeholder="{{awtTrans('اكتب meta description')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" cols="30" rows="10">{{$row->getTranslations('meta_description')['ar']}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('meta description بالانجليزية')}}</label>
                                            <div class="controls">
                                                <textarea name="meta_description_en" class="form-control" placeholder="{{awtTrans('اكتب meta description')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" cols="30" rows="10">{{$row->getTranslations('meta_description')['en']}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('meta keywords بالعربية')}}</label>
                                            <div class="controls">
                                                <textarea name="meta_keywords_ar" class="form-control" placeholder="{{awtTrans('اكتب meta keywords')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" cols="30" rows="10">{{$row->getTranslations('meta_keywords')['ar']}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('meta keywords بالانجليزية')}}</label>
                                            <div class="controls">
                                                <textarea name="meta_keywords_en" class="form-control" placeholder="{{awtTrans('اكتب meta keywords')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" cols="30" rows="10">{{$row->getTranslations('meta_keywords')['en']}}</textarea>
                                            </div>
                                        </div>
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