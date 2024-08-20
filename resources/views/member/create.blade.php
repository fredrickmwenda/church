@extends('layouts.master')
@section('title')
    {{ trans_choice('general.add', 1) }} {{ trans_choice('general.member', 1) }}
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans_choice('general.add', 1) }} {{ trans_choice('general.member', 1) }}</h3>

            <div class="box-tools pull-right">

            </div>
        </div>
        {!! Form::open([
            'url' => url('member/store'),
            'method' => 'post',
            'id' => 'add_member_form',
            'enctype' => 'multipart/form-data',
        ]) !!}
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('branch_id', trans_choice('general.branch', 1), ['class' => ' control-label']) !!}
                {!! Form::select('branch_id', $branches, null, [
                    'class' => 'form-control select2',
                    'placeholder' => '',
                    'required' => 'required',
                    'id' => 'contribution_batch_id',
                ]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('first_name', trans_choice('general.first_name', 1), ['class' => '']) !!}
                {!! Form::text('first_name', null, [
                    'class' => 'form-control',
                    'placeholder' => trans_choice('general.first_name', 1),
                    'required' => 'required',
                ]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('middle_name', trans_choice('general.middle_name', 1), ['class' => '']) !!}
                {!! Form::text('middle_name', null, ['class' => 'form-control', 'placeholder' => '']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('last_name', trans_choice('general.last_name', 1), ['class' => '']) !!}
                {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => '', 'required' => 'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('gender', trans_choice('general.gender', 1), ['class' => '']) !!}
                {!! Form::select(
                    'gender',
                    [
                        'male' => trans_choice('general.male', 1),
                        'female' => trans_choice('general.female', 1),
                        'unknown' => trans_choice('general.unknown', 1),
                    ],
                    'unknown',
                    ['class' => 'form-control', '' => ''],
                ) !!}
            </div>
            <div class="form-group">
                {!! Form::label('marital_status', trans_choice('general.marital_status', 1), ['class' => '']) !!}
                {!! Form::select(
                    'marital_status',
                    [
                        'single' => trans_choice('general.single', 1),
                        'engaged' => trans_choice('general.engaged', 1),
                        'married' => trans_choice('general.married', 1),
                        'divorced' => trans_choice('general.divorced', 1),
                        'widowed' => trans_choice('general.widowed', 1),
                        'separated' => trans_choice('general.separated', 1),
                        'unknown' => trans_choice('general.unknown', 1),
                    ],
                    'unknown',
                    ['class' => 'form-control', '' => ''],
                ) !!}
            </div>
            <div class="form-group">
                {!! Form::label('status', trans_choice('general.status', 1), ['class' => '']) !!}
                {!! Form::select(
                    'status',
                    [
                        'attender' => trans_choice('general.attender', 1),
                        'visitor' => trans_choice('general.visitor', 1),
                        'inactive' => trans_choice('general.inactive', 1),
                        'unknown' => trans_choice('general.unknown', 1),
                    ],
                    'unknown',
                    ['class' => 'form-control', '' => ''],
                ) !!}
            </div>
            <div class="form-group">
                {!! Form::label('home_phone', trans_choice('general.home_phone', 1), ['class' => '']) !!}
                {!! Form::text('home_phone', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('mobile_phone', trans_choice('general.mobile_phone', 1), ['class' => '']) !!}
                {!! Form::text('mobile_phone', null, [
                    'class' => 'form-control',
                    'placeholder' => trans_choice('general.numbers_only', 1),
                ]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('work_phone', trans_choice('general.work_phone', 1), ['class' => '']) !!}
                {!! Form::text('work_phone', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', trans_choice('general.email', 1), ['class' => '']) !!}
                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => trans_choice('general.email', 1)]) !!}
            </div>
            <div class="form-group">
                {!! Form::label('dob', trans_choice('general.dob', 1), ['class' => '']) !!}
                {!! Form::text('dob', null, ['class' => 'form-control date-picker', 'placeholder' => 'yyyy-mm-dd']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('address', trans_choice('general.address', 1), ['class' => '']) !!}
                {!! Form::textarea('address', null, ['class' => 'form-control', 'rows' => '3']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('photo', trans_choice('general.photo', 1), ['class' => '']) !!}
                {!! Form::file('photo', ['class' => 'form-control', 'placeholder' => '']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('notes', trans_choice('general.description', 1), ['class' => '']) !!}
                {!! Form::textarea('notes', null, ['class' => 'form-control', 'placeholder' => '']) !!}
            </div>
            <div class="form-group">
                {!! Form::label(
                    'files',
                    trans_choice('general.file', 2) .
                        ' 
                                                    ' .
                        trans_choice('general.borrower_file_types', 2),
                    ['class' => ''],
                ) !!}
                {!! Form::file('files[]', ['class' => 'form-control', 'multiple' => '']) !!}

                {{ trans_choice('general.select_thirty_files', 2) }}

            </div>
            <div class="form-group">
                {{-- {!! Form::label(
                    'tags',
                    /*trans_choice('general.assign', 2).*/
                    'Add to organization',
                    /* trans_choice('general.tag', 2)*/ [
                        'class' => '',
                    ],
                ) !!}

                <div id="jstree_div">
                    <ul>

                        <li data-jstree='{ "opened" : true }' id="0">{{ trans_choice('general.all', 2) }}
                             {{ trans_choice('general.tag', 2) }} 
                            Organization
                            ({{ \App\Models\MemberTag::count() }} {{ trans_choice('general.people', 2) }})
                            {!! \App\Helpers\GeneralHelper::createTreeView(0, $menus) !!}
                        </li>
                    </ul>
                </div>
                <input type="hidden" name="tags" id="tags" value="" /> --}}

                <div class=" col-12 mt-4">
                    <label> {{ __('Add to organization') }} <span class="text-red">*</span> </label>

                    <select name="tags" class="form-control" _multiple required>
                        {{-- <option value="">Select a organization</option> --}}
                        @foreach ($organizations as $key => $organization)
                            <option value="{{ $organization->id }}">
                                {{ $organization->name }}
                            </option>
                        @endforeach
                    </select>
                    {{-- Hold down the Ctrl (windows)
                    or Command (Mac) button to select multiple organizations. --}}
                </div>

            </div>

            <p class="bg-navy disabled color-palette">{{ trans_choice('general.custom_field', 2) }}</p>

            @foreach ($custom_fields as $key)
                <div class="form-group">
                    {!! Form::label($key->id, $key->name, ['class' => '']) !!}
                    @if ($key->field_type == 'number')
                        <input type="number" class="form-control" name="{{ $key->id }}"
                            @if ($key->required == 1) required @endif>
                    @endif
                    @if ($key->field_type == 'textfield')
                        <input type="text" class="form-control" name="{{ $key->id }}"
                            @if ($key->required == 1) required @endif>
                    @endif
                    @if ($key->field_type == 'date')
                        <input type="text" class="form-control date-picker" name="{{ $key->id }}"
                            @if ($key->required == 1) required @endif>
                    @endif
                    @if ($key->field_type == 'textarea')
                        <textarea class="form-control" name="{{ $key->id }}" @if ($key->required == 1) required @endif></textarea>
                    @endif
                    @if ($key->field_type == 'decimal')
                        <input type="text" class="form-control touchspin" name="{{ $key->id }}"
                            @if ($key->required == 1) required @endif>
                    @endif
                    @if ($key->field_type == 'select')
                        <select class="form-control touchspin" name="{{ $key->id }}"
                            @if ($key->required == 1) required @endif>
                            @if ($key->required != 1)
                                <option value=""></option>
                            @else
                                <option value="" disabled selected>Select...</option>
                            @endif
                            @foreach (explode(',', $key->select_values) as $v)
                                <option>{{ $v }}</option>
                            @endforeach
                        </select>
                    @endif
                    @if ($key->field_type == 'radiobox')
                        @foreach (explode(',', $key->radio_box_values) as $v)
                            <div class="radio">
                                <label>
                                    <input type="radio" name="{{ $key->id }}" id="{{ $key->id }}"
                                        value="{{ $v }}" @if ($key->required == 1) required @endif>
                                    <b>{{ $v }}</b>
                                </label>
                            </div>
                        @endforeach
                    @endif
                    @if ($key->field_type == 'checkbox')
                        @foreach (explode(',', $key->checkbox_values) as $v)
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="{{ $key->id }}[{{ $v }}]"
                                        id="{{ $key->id }}" value="{{ $v }}"
                                        @if ($key->required == 1) required @endif>
                                    <b>{{ $v }}</b>
                                </label>
                            </div>
                        @endforeach
                    @endif
                </div>
            @endforeach
            <p style="text-align:center; font-weight:bold;">
                <small><a href="{{ url('custom_field/create') }}" target="_blank">Click here to add custom fields on
                        this page</a></small>
            </p>


            <div class=" col-12 mt-4">
                <label> {{ __('Cell') }} <span class="text-red">*</span> </label>
                <select name="cell_id" class="form-control" required>
                    <option value="">Select a cell</option>
                    @foreach ($cells as $key => $cell)
                        <option value="{{ $cell->id }}" {{-- @if ($member->cell_id == $cell->leader) selected @endif --}}>
                            {{ $cell->name }}
                        </option>
                    @endforeach
                </select>
            </div>


        </div>

        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right"
                id="add_member">{{ trans_choice('general.save', 1) }}</button>
        </div>
        {!! Form::close() !!}
    </div>
    <!-- /.box -->
@endsection
@section('footer-scripts')
    <script>
        $('#jstree_div').jstree({
            "core": {
                "themes": {
                    "responsive": true
                },
                // so that create works
                "check_callback": true,
            },
            "plugins": ["checkbox", 'wholerow'],
        });
        $('#add_member').click(function(e) {
            e.preventDefault();
            $('#tags').val($('#jstree_div').jstree("get_selected"))
            $('#add_member_form').submit();
        })
    </script>
@endsection