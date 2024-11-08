@extends('layouts.master')
@section('page-header-scripts')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatable/media/css/jquery.dataTables.css')}}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatable/media/css/dataTables.bootstrap.css')}}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatable/extensions/Buttons/css/buttons.dataTables.min.css')}}">

@endsection
@section('title')
    {{trans_choice('general.custom_field',2)}}
@endsection
@section('content')
    <!-- Default box -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans_choice('general.custom_field',2)}}</h3>

            <div class="box-tools pull-right mb-2">
                <a href="{{ url('custom_field/create') }}"
                   class="btn btn-info btn-sm">{{trans_choice('general.add',2)}} {{trans_choice('general.custom_field',1)}}</a>
            </div>
        </div>
        <div class="box-body">
            <table id="data-table" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>{{trans_choice('general.name',1)}}</th>
                    <th>{{trans_choice('general.category',1)}}</th>
                    <th>{{trans_choice('general.required_field',1)}}</th>
                    <th>{{trans_choice('general.type',1)}}</th>
                    <th>{{ trans_choice('general.action',1) }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $key)
                    <tr>
                        <td>{{ $key->name }}</td>
                        <td>
                            @if($key->category=="events")
                                {{trans_choice('general.add',1)}} {{trans_choice('general.event',1)}}
                            @endif
                            @if($key->category=="members")
                                {{trans_choice('general.add',1)}} {{trans_choice('general.member',1)}}
                            @endif
                        </td>
                        <td>
                            @if($key->required==0)
                                {{trans_choice('general.no',1)}}
                            @else
                                {{trans_choice('general.yes',1)}}
                            @endif
                        </td>
                        <td>
                            @if($key->field_type=="number")
                                {{trans_choice('general.number_field',1)}}
                            @endif
                            @if($key->field_type=="textfield")
                                {{trans_choice('general.text_field',1)}}
                            @endif
                            @if($key->field_type=="textarea")
                                {{trans_choice('general.text_area',1)}}
                            @endif
                            @if($key->field_type=="decimal")
                                {{trans_choice('general.decimal_field',1)}}
                            @endif
                            @if($key->field_type=="date")
                                {{trans_choice('general.date_field',1)}}
                            @endif
                            @if($key->field_type=="radiobox")
                                {{trans_choice('general.radio_box',1)}}
                            @endif
                            @if($key->field_type=="select")
                                {{trans_choice('general.select',1)}}
                            @endif
                            @if($key->field_type=="checkbox")
                                {{trans_choice('general.checkbox',1)}}
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-info btn-flat dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ trans('general.choose') }} <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('custom_field/'.$key->id.'/edit') }}"><i
                                                    class="fa fa-edit"></i> {{ trans('general.edit') }} </a></li>
                                    <li><a href="{{ url('custom_field/'.$key->id.'/delete') }}"
                                           class="delete"><i
                                                    class="fa fa-trash"></i> {{ trans('general.delete') }} </a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@endsection
@section('footer-scripts')
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $('#data-table').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "language": {
                "lengthMenu": "{{ trans('general.lengthMenu') }}",
                "zeroRecords": "{{ trans('general.zeroRecords') }}",
                "info": "{{ trans('general.info') }}",
                "infoEmpty": "{{ trans('general.infoEmpty') }}",
                "search": "{{ trans('general.search') }}",
                "infoFiltered": "{{ trans('general.infoFiltered') }}",
                "paginate": {
                    "first": "{{ trans('general.first') }}",
                    "last": "{{ trans('general.last') }}",
                    "next": "{{ trans('general.next') }}",
                    "previous": "{{ trans('general.previous') }}"
                },
                "columnDefs": [
                    {"orderable": false, "targets": 2}
                ]
            },
        });
    </script>
@endsection
