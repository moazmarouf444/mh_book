@extends('admin.layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/pages/data-list-view.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
@endsection

@section('content')
    <x-admin.table  filter="true">
        <x-slot name="tableHead">
            <th>
                <label class="container-checkbox">
                    <input type="checkbox" value="value1" name="name1" id="checkedAll">
                    <span class="checkmark"></span>
                </label>
            </th>

            <th>{{__('dashboard.The Date')}}</th>
            <th>{{__('dashboard.user_name')}}</th>
            <th>{{__('dashboard.total_price')}}</th>
            <th>{{__('dashboard.order_status')}}</th>
            <th>{{__('dashboard.payment_status')}}</th>
            <th>{{__('dashboard.payment_type')}}</th>
            <th>{{__('dashboard.details')}}</th>

        </x-slot>
        <x-slot name="tableBody">
            @foreach($orders as $order)
                <tr >
                    <td class="text-center">
                        <label class="container-checkbox">
                            <input type="checkbox" class="checkSingle" id="{{$order->id}}">
                            <span class="checkmark"></span>
                        </label>
                    </td>
                    <td>{{$order->created_at?$order->created_at->format('d/m/Y') : ''}}</td>
                    <td>{{$order->user ? $order->user-> name : ''}}</td>
                    <td>{{$order->total_price . ' ' . __('dashboard.r.s')}}</td>
                    <td>
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
                    </td>
                    <td>@if($order->pay_status == 0)
                            {{__('dashboard.not_paid')}}
                        @else($order->pay_status == 2)
                            {{__('dashboard.the_payment_was_made')}}
                        @endif
                    </td>

                    <td>
                        @if($order->pay_type == 1)
                            {{__('dashboard.payment_when_recieving')}}
                        @else($order->pay_status == 4)
                            {{__('dashboard.pay_online')}}
                        @endif
                    </td>
                    {{--                    <td>{{$cover->getTranslation('name','ar')}}</td>--}}
                    {{--                    <td>{{$cover->getTranslation('name','en')}}</td>--}}
                    {{--                    <td>{{$cover->price . ' ' . __('dashboard.r.s')}} </td>--}}
                    <td class="product-action">
                        <span class="text-primary"><a href="{{route('admin.orders.show' , ['id' => $order->id])}}"><i class="feather icon-eye"></i></a></span>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-admin.table >
    {{-- #table --}}
@endsection

@section('js')
    <script src="{{asset('admin/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/tables/datatable/pdfmake.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/tables/datatable/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/tables/datatable/buttons.print.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/datatable_custom.js')}}"></script>
    <script src="{{asset('admin/search.js')}}"></script>
    <script src="{{asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/extensions/sweet-alerts.js')}}"></script>

    {{-- delete all script --}}
    @include('admin.shared.deleteAll')
    {{-- delete all script --}}

    {{-- delete one user script --}}
    @include('admin.shared.deleteOne')
    {{-- delete one user script --}}
@endsection
