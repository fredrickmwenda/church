@extends('layouts.master')
@section('title')
    {{ trans('general.edit') }} {{ trans_choice('general.role',1) }}
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('general.edit') }} {{ trans_choice('general.role',1) }}</h3>
        </div>
        {!! Form::open(array('url' => 'user/role/'.$role->id.'/update', 'class' => '', "enctype" => "multipart/form-data")) !!}
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="form-line">
                            {!! Form::label('name', trans_choice('general.name', 1), array('class' => 'control-label')) !!}
                            {!! Form::text('name', $role->name, array('class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <hr>
                        <h4>{{ trans_choice('general.manage', 1) }} {{ trans_choice('general.permission', 2) }}</h4>

                        <div class="col-md-6">
                            <table class="table table-striped table-hover">
                                @foreach($data as $permission)
                                    <tr>
                                        <td>
                                            @if($permission->parent_id == 0)
                                                <strong>{{ $permission->name }}</strong>
                                            @else
                                                __ {{ $permission->name }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($permission->description))
                                                <i class="fa fa-info" data-bs-toggle="tooltip"
                                                   data-original-title="{!!  $permission->description !!}"></i>
                                            @endif
                                        </td>
                                        <td>
                                            <input type="checkbox"
                                                   @if(isset($role->permissions) && array_key_exists($permission->slug, $role->permissions)) checked @endif
                                                   data-parent="{{ $permission->parent_id }}"
                                                   name="permission[]"
                                                   value="{{ $permission->slug }}"
                                                   id="{{ $permission->id }}"
                                                   class="form-check-input pcheck">
                                            <label class="" for="{{ $permission->id }}"></label>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right">{{ trans_choice('general.save', 1) }}</button>
        </div>
        {!! Form::close() !!}
    </div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $(".pcheck").on('change', function() {
            if ($(this).attr('data-parent') == 0) {
                var id = $(this).attr('id');
                var isChecked = $(this).is(':checked');
                console.log("Checkbox changed:", $(this).attr('id'));
                $(":checkbox[data-parent=" + id + "]").prop('checked', isChecked);
            }
        });

        // Reinitialize if necessary after AJAX or DOM changes
        $(document).on("ajaxComplete", function() {
            console.log("Reinitializing checkboxes after AJAX");
        });
    });
</script>
@endpush
