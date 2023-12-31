@extends('admin.layout.master')

@section('css')
  <link rel="stylesheet" type="text/css"
        href="{{ asset('admin/app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
  <link rel="stylesheet" type="text/css"
        href="{{ asset('admin/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css') }}">
  <link rel="stylesheet" type="text/css"
        href="{{ asset('admin/app-assets/css-rtl/pages/data-list-view.css') }}">
  <link rel="stylesheet" type="text/css"
        href="{{ asset('admin/app-assets/css-rtl/core/colors/palette-gradient.css') }}">
  <link rel="stylesheet" type="text/css"
        href="{{ asset('admin/app-assets/vendors/css/extensions/sweetalert2.min.css') }}">
@endsection

@section('content')
  <x-admin.table filter="true" addbutton="{{ route('admin.admins.create') }}"
                 deletebutton="{{ route('admin.admins.deleteAll') }}">
    <x-slot name="tableHead">
      <th>
        <label class="container-checkbox">
          <input type="checkbox" value="value1" name="name1" id="checkedAll">
          <span class="checkmark"></span>
        </label>
      </th>
      <th>{{ awtTrans('التاريخ') }}</th>
      <th>{{ awtTrans('الصوره') }}</th>
      <th>{{ awtTrans('الاسم') }}</th>
      <th>{{ awtTrans('البريد الالكتروني') }}</th>
      <th>{{ awtTrans('رقم الهاتف') }}</th>
      <th>{{ awtTrans('الحالة') }}</th>
      <th>{{ awtTrans('التحكم') }}</th>
    </x-slot>
    <x-slot name="tableBody">
      @foreach ($admins as $admin)
        <tr class="delete_row">
          <td class="text-center">
            @if ($admin->id != 1 && auth()->id() != $admin->id)
              <label class="container-checkbox">
                <input type="checkbox" class="checkSingle" id="{{ $admin->id }}">
                <span class="checkmark"></span>
              </label>
            @else
              *
            @endif
          </td>
          <td>{{ $admin->created_at->format('d/m/Y') }}</td>
          <td>
            <img src="{{ asset($admin->avatar) }}" width="50px" height="50px"
                 alt="avatar">
          </td>
          <td>{{ $admin->name }}</td>
          <td>{{ $admin->email }}</td>
          <td>{{ $admin->phone }}</td>
          <td>
            @if ($admin->is_blocked)
              <span class="btn btn-sm btn-outline-danger">
                {{ awtTrans('محظور') }}
                <i class="la la-close font-medium-2"></i>
              </span>
            @else
              <span class="btn btn-sm btn-outline-success">
                {{ awtTrans('نشط') }}
                <i class="la la-check font-medium-2"></i>
              </span>
            @endif
          </td>
          <td class="product-action">
            <span class="action-edit text-primary">
              <a href="{{ route('admin.admins.edit', ['id' => $admin->id]) }}">
                <i class="feather icon-edit"></i>
              </a>
            </span>
            <span class="text-primary">
              <a href="{{ route('admin.admins.show', ['id' => $admin->id]) }}">
                <i class="feather icon-eye"></i>
              </a>
            </span>
            @if ($admin->id != 1 && auth()->id() != $admin->id)
              <span class="delete-row text-danger"
                    data-url="{{ url('admin/admins/' . $admin->id) }}">
                <i class="feather icon-trash"></i>
              </span>
            @endif
          </td>
        </tr>
      @endforeach
    </x-slot>
  </x-admin.table>
  {{-- #table --}}
@endsection


@section('js')
  <script
          src="{{ asset('admin/app-assets/vendors/js/tables/datatable/datatables.min.js') }}">
  </script>
  <script
          src="{{ asset('admin/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}">
  </script>
  <script
          src="{{ asset('admin/app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}">
  </script>
  <script
          src="{{ asset('admin/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}">
  </script>
  <script
          src="{{ asset('admin/app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}">
  </script>
  <script
          src="{{ asset('admin/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js') }}">
  </script>
  <script
          src="{{ asset('admin/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}">
  </script>
  <script src="{{ asset('admin/datatable_custom.js') }}"></script>
  <script src="{{ asset('admin/search.js') }}"></script>
  <script
          src="{{ asset('admin/app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}">
  </script>
  <script src="{{ asset('admin/app-assets/js/scripts/extensions/sweet-alerts.js') }}">
  </script>

  {{-- delete all script --}}
  @include('admin.shared.deleteAll')
  {{-- delete all script --}}

  {{-- delete one user script --}}
  @include('admin.shared.deleteOne')
  {{-- delete one user script --}}
@endsection
