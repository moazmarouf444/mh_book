@extends('admin.layout.master')

@section('content')
<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{awtTrans('عرض كوبون ')}}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form  class="store form-horizontal" >
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('رقم الكوبون')}}</label>
                                            <div class="controls">
                                                <input type="text" name="identity" value="{{$row->identity}}" class="form-control" placeholder="{{awtTrans('اكتب رقم الكوبون')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('عدد مرات الاستخدام')}}</label>
                                            <div class="controls">
                                                <input type="number" name="usage" value="{{$row->usage}}" class="form-control" placeholder="{{awtTrans('اكتب عدد مرات الاستخدام')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('نوع الخصم')}}</label>
                                            <div class="controls">
                                                <select name="type" class="select2 form-control" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                                    <option value>{{awtTrans('اختر حالة الخصم')}}</option>
                                                    <option {{$row->type == 'ratio' ? 'selected' : ''}} value="ratio">{{awtTrans('نسبة')}}</option>
                                                    <option {{$row->type == 'number' ? 'selected' : ''}} value="number">{{awtTrans('رقم ثابت')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('قيمة الخصم')}}</label>
                                            <div class="controls">
                                                <input type="number" value="{{$row->discount}}" name="discount" class="discount form-control" placeholder="{{awtTrans('اكتب قيمة الخصم')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('اكبر قيمة للخصم')}}</label>
                                            <div class="controls">
                                                <input readonly type="number" value="{{$row->max_discount}}" name="max_discount" class="max_discount form-control" placeholder="{{awtTrans('اكتب اكبر قيمة للخصم')}}" required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="first-name-column">{{awtTrans('تاريخ الانتهاء')}}</label>
                                            <div class="controls">
                                                <input  type="text" value="{{date('M,Y d', strtotime($row->expire_date));}}" name="expire_date" class="pickadate form-control"  required data-validation-required-message="{{awtTrans('هذا الحقل مطلوب')}}" >
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