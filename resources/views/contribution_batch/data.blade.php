@extends('layouts.master')
@section('page-header-scripts')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatable/media/css/jquery.dataTables.css')}}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatable/media/css/dataTables.bootstrap.css')}}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatable/extensions/Buttons/css/buttons.dataTables.min.css')}}">

@endsection
@section('title'){{trans_choice('general.batch',2)}}
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{trans_choice('general.batch',2)}}</h3>

            <div class="box-tools pull-right mb-2">
                @if(Sentinel::hasAccess('contributions.create'))
                    <a href="{{ url('contribution/batch/create') }}"
                       class="btn btn-info btn-sm">{{trans_choice('general.add',1)}} {{trans_choice('general.batch',1)}}</a>
                @endif
            </div>
        </div>
        <div class="box-body">
            <table id="data-table" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>{{ trans_choice('general.id',1) }}</th>
                    <th>{{ trans_choice('general.name',1) }}</th>
                    <th>{{ trans_choice('general.date',1) }}</th>
                    <th>{{ trans_choice('general.status',1) }}</th>
                    <th>{{ trans_choice('general.entry',2) }}</th>
                    <th>{{ trans_choice('general.total',2) }}</th>
                    <th>{{ trans_choice('general.action',1) }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $key)
                    <tr>
                        <td>{{ $key->id }}</td>
                        <td>{{ $key->name }}</td>
                        <td>{{ $key->date }}</td>
                        <td>
                            @if($key->status==0)
                                <span class="label label-success">{{ trans_choice('general.open',1) }}</span>
                            @else
                                <span class="label label-danger">{{ trans_choice('general.closed',1) }}</span>
                            @endif
                        </td>
                        <td>{{ count($key->contributions) }}</td>
                        <td>
                            @if(\App\Models\Setting::where('setting_key', 'currency_position')->first()->setting_value=='left')
                                {{ \App\Models\Setting::where('setting_key', 'currency_symbol')->first()->setting_value }}
                                {{number_format(\App\Helpers\GeneralHelper::batch_total_amount($key->id),2)}}
                            @else
                                {{number_format(\App\Helpers\GeneralHelper::batch_total_amount($key->id),2)}}  {{ \App\Models\Setting::where('setting_key', 'currency_symbol')->first()->setting_value}}
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-info btn-xs dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ trans('general.choose') }} <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    @if(Sentinel::hasAccess('contributions.view'))
                                        <li><a href="{{ url('contribution/batch/'.$key->id.'/show') }}"
                                               class=""><i
                                                        class="fa fa-search"></i> {{ trans_choice('general.detail',2) }}
                                            </a></li>
                                    @endif
                                    @if($key->status==0)
                                        @if(Sentinel::hasAccess('contributions.update'))
                                            <li><a href="{{ url('contribution/batch/'.$key->id.'/close') }}"
                                                   class="delete"><i
                                                            class="fa fa-minus-circle"></i> {{ trans('general.close') }}
                                                </a></li>
                                        @endif
                                    @else
                                        @if(Sentinel::hasAccess('contributions.update'))
                                            <li><a href="{{ url('contribution/batch/'.$key->id.'/open') }}"
                                                   class="delete"><i
                                                            class="fa fa-check"></i> {{ trans('general.open') }}
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                    @if(Sentinel::hasAccess('contributions.update'))
                                        <li><a href="{{ url('contribution/batch/'.$key->id.'/edit') }}"><i
                                                        class="fa fa-edit"></i> {{ trans('general.edit') }} </a>
                                        </li>
                                    @endif
                                    @if(Sentinel::hasAccess('contributions.delete'))
                                        <li><a href="{{ url('contribution/batch/'.$key->id.'/delete') }}"
                                               class="delete"><i
                                                        class="fa fa-trash"></i> {{ trans('general.delete') }}
                                            </a></li>
                                    @endif
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
    <script src="{{ asset('assets/plugins/datatable/media/js/jquery.dataTables.js')}}"></script>
    <script src="{{ asset('assets/plugins/datatable/media/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{ asset('assets/plugins/datatable/extensions/Buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/datatable/extensions/Buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/datatable/extensions/Buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/datatable/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/datatable/extensions/Buttons/js/buttons.colVis.min.js')}}"></script>
    <script>

        $('#data-table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {extend: 'copy', 'text': '{{ trans('general.copy') }}'},
                {extend: 'excel', 'text': '{{ trans('general.excel') }}'},
                {extend: 'pdf', 'text': '{{ trans('general.pdf') }}'},
                {extend: 'print', 'text': '{{ trans('general.print') }}'},
                {extend: 'csv', 'text': '{{ trans('general.csv') }}'},
                {extend: 'colvis', 'text': '{{ trans('general.colvis') }}'}
            ],
            "paging": true,
            "lengthChange": true,
            "displayLength": 15,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "order": [[0, "desc"]],
            "columnDefs": [
                {"orderable": false, "targets": [6]}
            ],
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
                }
            },
            responsive: false
        });
    </script>
@endsection
