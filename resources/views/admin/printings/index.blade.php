@extends('admin.layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/pages/data-list-view.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css-rtl/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
@endsection

@section('content')
    <x-admin.table  filter="true" addbutton="{{route('admin.print.type.create')}}"  deletebutton="{{route('admin.print.type.deleteAll')}}">
        <x-slot name="tableHead">
            <th>
                <label class="container-checkbox">
                    <input type="checkbox" value="value1" name="name1" id="checkedAll">
                    <span class="checkmark"></span>
                </label>
            </th>

            <th>{{__('dashboard.The Date')}}</th>
            <th>{{__('dashboard.The name is in Arabic')}}</th>
            <th>{{__('dashboard.The name is in English')}}</th>
            <th>{{__('dashboard.The Price')}}</th>
            <th>{{__('dashboard.Control')}}</th>

        </x-slot>
        <x-slot name="tableBody">
            @foreach($printings as $printing)
                <tr >
                    <td class="text-center">
                        <label class="container-checkbox">
                            <input type="checkbox" class="checkSingle" id="{{$printing->id}}">
                            <span class="checkmark"></span>
                        </label>
                    </td>
                    <td>{{$printing->created_at->format('d/m/Y')}}</td>
                    <td>{{$printing->getTranslation('name','ar')}}</td>
                    <td>{{$printing->getTranslation('name','en')}}</td>
                    <td>{{$printing->price . ' ' . __('dashboard.r.s')}} </td>
                    <td class="product-action">
                        <span class="text-primary"><a href="{{route('admin.print.type.show' , ['id' => $printing->id])}}"><i class="feather icon-eye"></i></a></span>
                        <span class="action-edit text-primary"><a href="{{route('admin.print.type.edit' , ['id' => $printing->id])}}"><i class="feather icon-edit"></i></a></span>
                        <span class="delete-row text-danger" data-url="{{url('admin/print-type/'.$printing->id)}}"><i class="feather icon-trash"></i></span>
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
