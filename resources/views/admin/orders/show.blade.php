@extends('admin.layout.master')

@section('content')
    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('dashboard.view_order_details')}}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="store form-horizontal">
                                <div class="form-body">
                                    <div class="form-body">
                                        <div class="row">

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('dashboard.order_number')}}</label>
                                                    <div class="controls">
                                                        <input type="text" name="price" class="form-control"
                                                               value="{{$order->order_num}}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('dashboard.requester\'s_ user_name')}}</label>
                                                    <div class="controls">
                                                        <input type="text" name="price" class="form-control"
                                                               value="{{$order->user->name}}">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('dashboard.requester\'s_ phone_number')}}</label>
                                                    <div class="controls">
                                                        <input type="text" name="price" class="form-control"
                                                               value="{{$order->user->phone}}">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('dashboard.total_price')}}</label>
                                                    <div class="controls">
                                                        <input type="text" name="price" class="form-control"
                                                               value="{{$order->total_price  . ' ' . __('dashboard.r.s')}}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('dashboard.address')}}</label>
                                                    <div class="controls">
                                                        <a target="_blank" href="https://maps.google.com/?q={{$order->lat}},{{$order->lng}}"> عرض الموقع الجغرافي</a>
                                                        <input type="text" name="address" class="form-control"
                                                               value="{{$order->address}}">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('dashboard.education_level')}}</label>
                                                    <div class="controls">
                                                        <input type="text" name="price" class="form-control"
                                                               value="{{$order->educationLevel->getTranslation('name','ar')}}">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('dashboard.paper_size')}}</label>
                                                    <div class="controls">
                                                        <input type="text" name="price" class="form-control"
                                                               value="{{$order->paperSize->name}}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('dashboard.print_types')}}</label>
                                                    <div class="controls">
                                                        <input type="text" name="price" class="form-control"
                                                               value="{{$order->printing->getTranslation('name','ar')}}">
                                                    </div>
                                                </div>
                                            </div>


{{--                                            <div class="col-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="first-name-column">{{__('dashboard.frame')}}</label>--}}
{{--                                                    <div class="controls">--}}
{{--                                                        <input type="text" name="price" class="form-control"--}}
{{--                                                               value="{{$order->frame? __('dashboard.yes') :__('dashboard.no')}}">--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('dashboard.printing_price')}}</label>
                                                    <div class="controls">
                                                        <input type="text" name="price" class="form-control"
                                                               value="{{$order->printing->price . ' ' . __('dashboard.r.s')}}">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('dashboard.cover_name')}}</label>
                                                    <div class="controls">
                                                        <input type="text" name="price" class="form-control"
                                                               value="{{$order->cover->name}}">
                                                    </div>
                                                </div>
                                            </div>
{{--                                            @if($order->frame != null)--}}
{{--                                            <div class="col-6">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="first-name-column">{{__('dashboard.frame_name')}}</label>--}}
{{--                                                    <div class="controls">--}}
{{--                                                        <input type="text" name="price" class="form-control"--}}
{{--                                                               value="{{$order->frame ? $order->frame->name : ''}}">--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            @endif--}}
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('dashboard.The_name_of_the_university_or_school')}}</label>
                                                    <div class="controls">
                                                        <input type="text" name="price" class="form-control"
                                                               value="{{$order->university_name}}">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('dashboard.order_status')}}</label>
                                                    <div class="controls">
                                                        <input type="text" name="price" class="form-control"
                                                               value="
                                                                @if($order->status == 0)
                                                               {{__('dashboard.new')}}
                                                               @elseif($order->status == 1)
                                                               {{__('dashboard.accepted')}}
                                                               @elseif($order->status == 2)
                                                               {{__('dashboard.refused')}}
                                                               @elseif($order->status == 3)
                                                               {{__('dashboard.cancel')}}
                                                               @elseif($order->status == 4)
                                                               {{__('dashboard.finished')}}
                                                               @elseif($order->status == 5)
                                                               {{__('dashboard.inprogress')}}
                                                               @endif
                                                                       ">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('dashboard.payment_type')}}</label>
                                                    <div class="controls">
                                                        <input type="text" name="price" class="form-control"
                                                               value="   @if($order->pay_type == 1)
                                                               {{__('dashboard.payment_when_recieving')}}
                                                               @else($order->pay_status == 4)
                                                               {{__('dashboard.pay_online')}}
                                                               @endif">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="first-name-column">{{__('dashboard.payment_status')}}</label>
                                                    <div class="controls">
                                                        <input type="text" name="price" class="form-control"
                                                               value=" @if($order->pay_status == 0)
                                                               {{__('dashboard.not_paid')}}
                                                               @else($order->pay_status == 2)
                                                               {{__('dashboard.the_payment_was_made')}}
                                                               @endif">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-12 d-flex justify-content-center">
                                                <h2 for="first-name-column">{{__('dashboard.files_and_photos')}}</h2>

                                            </div>

                                            @foreach($order->orderFiles as $file)
                                                <div class="col-6 row">
                                                    <div class="col-8">
                                                        <lable>{{__('dashboard.file_type')}}</lable>
                                                        <div class="form-group">
                                                            <div class="controls">
                                                                <input type="text" readonly name="price"
                                                                       class="form-control"
                                                                       value="{{$file->file}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <lable>{{__('dashboard.download')}}</lable>
                                                        <div class="form-group">
                                                            <div class="controls mt-1">
                                                                <a href="{{$file->file}}" download target="_blank">
                                                                    <i style="background: #dd9045;padding: 5px;color: white;border-radius: 6px;"
                                                                       class="feather icon-download"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach


                                            {{--                                            <div class="col-12  mt-3" >--}}

                                            {{--                                                <div id="map" style="position: absolute !important; width: 100%;height: 100%" ></div>--}}
                                            {{--                                            </div>--}}

                                            <div class="col-12 d-flex justify-content-center mt-3">
                                                @if($order->status == 0)
                                                        <a class="btn btn-success mr-1 mb-1 waves-effect waves-light " href="{{route('admin.change.order.status',['id' => $order->id , 'status' => 5])}}">
                                                            {{__('dashboard.transfer_in_progress')}}
                                                        </a>
                                                @elseif($order->status == 5 and $order->status != 4)

                                                    <a class="btn btn-success mr-1 mb-1 waves-effect waves-light " href="{{route('admin.change.order.status',['id' => $order->id , 'status' => 4])}}">
                                                        {{__('dashboard.transfer_completed')}}
                                                    </a>
                                                @endif

                                                    @if($order->pay_status == 0 && $order->status != 3 &&  $order->status != 4)
                                                        <a class="btn btn-danger mr-1 mb-1 waves-effect waves-light " href="{{route('admin.change.order.status',['id' => $order->id , 'status' => 3])}}">
                                                            {{__('dashboard.cancellation')}}
                                                        </a>
                                                    @endif
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
    <script>
        function initMap() {
            var uluru = {lat: Number('{{$order->lat}}'), lng: Number('{{$order->lng}}')};
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 10,
                center: uluru
            });
            var marker = new google.maps.Marker({
                position: uluru,
                map: map
            });
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9_ve_oT3ynCaAF8Ji4oBuDjOhWEHE92U&callback=initMap"
            type="text/javascript"></script>

@endsection