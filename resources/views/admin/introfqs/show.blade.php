@extends('admin.layout.master')

@section('content')
<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{awtTrans('عرض سؤال ')}}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form  class="store form-horizontal" >
                            <div class="form-body">
                                <div class="row">
                                    
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('القسم')}}</label>
                                            <div class="controls">
                                                <select name="intro_fqs_category_id" class="select2 form-control" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                                    <option value>{{awtTrans('اختر القسم')}}</option>
                                                    @foreach ($categories as $category)
                                                        <option {{$category->id == $row->intro_fqs_category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
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
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('الاجابة بالعربية')}}</label>
                                            <div class="controls">
                                                <textarea name="description_ar" class="form-control" placeholder="{{awtTrans('اكتب الاجابة بالعربية')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" cols="30" rows="10">{{$row->getTranslations('description')['ar']}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('الاجابة بالانجليزية')}}</label>
                                            <div class="controls">
                                                <textarea name="description_en" class="form-control" placeholder="{{awtTrans('اكتب الاجابة بالانجليزية')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" cols="30" rows="10">{{$row->getTranslations('description')['en']}}</textarea>
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