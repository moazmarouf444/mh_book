@extends('admin.layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/pages/data-list-view.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
@endsection

@section('content')
    <x-admin.table filter="true"   deletebutton="{{route('admin.messages.deleteAll')}}">
        <x-slot name="tableHead">
            <th>
                <label class="container-checkbox">
                    <input type="checkbox" value="value1" name="name1" id="checkedAll">
                    <span class="checkmark"></span>
                </label>
            </th>
            <th>{{__('dashboard.The Date')}}</th>
            <th>{{__('dashboard.the_name_of_the_author_of_the_message')}}</th>
            <th>{{__('dashboard.the_message_owner\'s_number')}}</th>
            <th>{{__('dashboard.email_of_the_sender')}}</th>
            <th>{{__('dashboard.Control')}}</th>
        </x-slot>
        <x-slot name="tableBody">
            @foreach($messages as $message)
                <tr class="delete_row">
                    <td class="text-center">
                        <label class="container-checkbox">
                            <input type="checkbox" class="checkSingle" id="{{$message->id}}">
                            <span class="checkmark"></span>
                        </label>
                    </td>
                    <td>{{($message->created_at)->format('d/m/Y')}}</td>
                    <td>{{$message->user->name}}</td>
                    <td>{{$message->user->phone}}</td>
                    <td>{{$message->user->email}}</td>
                    <td class="product-action">
                        <span class="action-edit text-primary"><a href="{{route('admin.message.show' , ['id' => $message->id])}}"><i class="feather icon-eye"></i></a></span>
                        <span class="delete-row text-danger" data-url="{{url('admin/messages/'.$message->id)}}"><i class="feather icon-trash"></i></span>
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
