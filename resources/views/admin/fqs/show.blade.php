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
                                    
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="account-name">{{awtTrans('السؤال بالعربية')}}</label>
                                                <textarea class="form-control" name="question_ar" id="" cols="30" rows="10" placeholder="{{awtTrans('السؤال بالعربية')}}">{{$row->getTranslations('question')['ar']}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="account-name">{{awtTrans('السؤال بالانجليزية')}}</label>
                                                <textarea class="form-control" name="question_en" id="" cols="30" rows="10" placeholder="{{awtTrans('السؤال بالانجليزية')}}">{{$row->getTranslations('question')['en']}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="account-name">{{awtTrans('الاجابة بالعربية')}}</label>
                                                <textarea class="form-control" name="answer_ar" id="" cols="30" rows="10" placeholder="{{awtTrans('الاجابة بالعربية')}}">{{$row->getTranslations('answer')['ar']}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="controls">
                                                <label for="account-name">{{awtTrans('الاجابة بالانجليزية')}}</label>
                                                <textarea class="form-control" name="answer_en" id="" cols="30" rows="10" placeholder="{{awtTrans('الاجابة بالانجليزية')}}">{{$row->getTranslations('answer')['en']}}</textarea>
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