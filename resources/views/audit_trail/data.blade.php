@extends('layouts.master')
@section('page-header-scripts')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatable/media/css/jquery.dataTables.css')}}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatable/media/css/dataTables.bootstrap.css')}}">
<link rel="stylesheet" href="{{ asset('assets/plugins/datatable/extensions/Buttons/css/buttons.dataTables.min.css')}}">

@endsection
@section('title')
    {{ trans_choice('general.audit_trail',2) }}
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">  {{ trans_choice('general.audit_trail',2) }} </h3>

            <div class="box-tools pull-right mb-2">

            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table id="data-table" class="table table-bordered table-condensed table-hover">
                    <thead>
                    <tr>
                        <th> {{ trans_choice('general.user',1) }}</th>
                        <th> {{ trans_choice('general.note',2) }}</th>
                        <th> {{ trans_choice('general.date',2) }}</th>
                    </tr>
                    </thead>
                </table>
            </div>
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
            processing: true,
            serverSide: false,
            ajax: '{!! url('audit_trail/get_audit_trail') !!}',
            columns: [
                { data: 'user', name: 'user' },
                { data: 'notes', name: 'notes' },
                { data: 'created_at', name: 'created_at' }
            ],
            "order": [[2, "desc"]],
            "paging": true,
            "lengthChange": true,
            "displayLength": 15,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
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
