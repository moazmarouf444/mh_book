@extends('admin.layout.master')

@section('content')
    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('dashboard.view_the_types_of_printing')}}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form  class="store form-horizontal" >
                                <div class="form-body">
                                    <div class="form-body">
                                        <div class="row">

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('dashboard.The name is in Arabic')}}</label>
                                                    <div class="controls">
                                                        <input type="text" name="name_ar" value="{{$print->getTranslations('name')['ar']}}" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('dashboard.The name is in English')}}</label>
                                                    <div class="controls">
                                                        <input type="text" name="name_en" value="{{$print->getTranslations('name')['en']}}" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('dashboard.The Price')}}</label>
                                                    <div class="controls">
                                                        <input type="text" name="price" class="form-control" value="{{$print->price}}" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-center mt-3">
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
    <script>
        $('.store input').attr('disabled' , true)
        $('.store textarea').attr('disabled' , true)
        $('.store select').attr('disabled' , true)

    </script>
@endsection