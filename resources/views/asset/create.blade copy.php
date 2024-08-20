@extends('layouts.master')

@section('title')
    {{ trans_choice('general.add', 1) }} {{ trans_choice('general.asset', 1) }}
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans_choice('general.add', 1) }} {{ trans_choice('general.asset', 1) }}</h3>

            <div class="box-tools pull-right mb-2">
                <!-- Add any additional buttons or controls here if needed -->
            </div>
        </div>

        {!! Form::open([
            'url' => url('asset/store'),
            'method' => 'post',
            'class' => '',
            'name' => 'form',
            'enctype' => 'multipart/form-data'
        ]) !!}

        <div class="box-body">
            <p class="bg-navy disabled color-palette">{{ trans_choice('general.required', 1) }} {{ trans_choice('general.field', 2) }}</p>
            
            <div class="form-group">
                {!! Form::label('branch_id', trans_choice('general.branch', 1), ['class' => 'control-label']) !!}
                {!! Form::select('branch_id', $branches, null, ['class' => 'form-control select2', 'placeholder' => '', 'required' => 'required', 'id' => 'branch_id']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('asset_type_id', trans_choice('general.asset', 1) . ' ' . trans_choice('general.type', 1), ['class' => 'control-label']) !!}
                {!! Form::select('asset_type_id', $types, null, ['class' => 'form-control', 'required' => 'required']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('current_value', trans_choice('general.current', 1) . ' ' . trans_choice('general.value', 1)) !!}
                <div class="col-sm-12">
                    <table width="100%" id="current_valuation" class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width:5px" class="bg-gray padding"><b>#</b></th>
                                <th class="bg-gray padding"><b>{{ trans_choice('general.date', 1) }} {{ trans_choice('general.of', 1) }} {{ trans_choice('general.valuation', 1) }}</b></th>
                                <th class="bg-gray padding"><b>{{ trans_choice('general.value', 1) }} {{ trans_choice('general.amount', 1) }}</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    {!! Form::text('asset_management_current_date[]', null, ['class' => 'date-picker form-control is-datepick', 'placeholder' => 'yyyy-mm-dd', 'required']) !!}
                                </td>
                                <td>
                                    {!! Form::text('asset_management_current_value[]', null, ['class' => 'form-control decimal-2-places touchspin', 'required']) !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <button type="button" class="btn btn-info margin" onclick="addRow()">{{ trans_choice('general.add', 1) }} {{ trans_choice('general.row', 1) }}</button>
                    <button type="button" class="btn btn-info margin" onclick="deleteRow()">{{ trans_choice('general.delete', 1) }} {{ trans_choice('general.row', 1) }}</button>
                </div>
            </div>

            <p><small>{{ trans_choice('general.add_asset_msg', 1) }}</small></p>
            
            <p class="bg-navy disabled color-palette">{{ trans_choice('general.optional', 1) }} {{ trans_choice('general.field', 2) }}</p>

            <div class="callout callout-warning no-margin">
                <p>{{ trans_choice('general.add_asset_msg2', 1) }}</p>
            </div>

            <div class="form-group">
                {!! Form::label('purchase_date', trans_choice('general.purchase', 1) . ' ' . trans_choice('general.date', 1)) !!}
                {!! Form::text('purchase_date', null, ['class' => 'form-control date-pickerr', 'placeholder' => ""]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('purchase_price', trans_choice('general.purchase', 1) . ' ' . trans_choice('general.price', 1)) !!}
                {!! Form::text('purchase_price', null, ['class' => 'form-control touchspin', 'placeholder' => ""]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('replacement_value', trans_choice('general.replacement', 1) . ' ' . trans_choice('general.value', 1)) !!}
                {!! Form::text('replacement_value', null, ['class' => 'form-control touchspin', 'placeholder' => ""]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('serial_number', trans_choice('general.serial_number', 1)) !!}
                {!! Form::textarea('serial_number', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('notes', trans_choice('general.description', 1)) !!}
                {!! Form::textarea('notes', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('files', trans_choice('general.file', 2) . ' (' . trans_choice('general.borrower_file_types', 1) . ')') !!}
                {!! Form::file('files[]', ['class' => 'form-control', 'multiple' => 'multiple']) !!}
                <div class="col-sm-12">{{ trans_choice('general.select_thirty_files', 1) }}</div>
            </div>

            <div class="form-group">
                <hr>
            </div>

            <p class="bg-navy disabled color-palette">{{ trans_choice('general.custom_field', 2) }}</p>

            @foreach($custom_fields as $key)
                <div class="form-group">
                    {!! Form::label($key->id, $key->name) !!}
                    @switch($key->field_type)
                        @case('number')
                            {!! Form::number($key->id, null, ['class' => 'form-control', 'required' => $key->required ? 'required' : '']) !!}
                            @break
                        @case('textfield')
                            {!! Form::text($key->id, null, ['class' => 'form-control', 'required' => $key->required ? 'required' : '']) !!}
                            @break
                        @case('date')
                            {!! Form::text($key->id, null, ['class' => 'form-control date-pickerrr', 'required' => $key->required ? 'required' : '']) !!}
                            @break
                        @case('textarea')
                            {!! Form::textarea($key->id, null, ['class' => 'form-control', 'required' => $key->required ? 'required' : '']) !!}
                            @break
                        @case('decimal')
                            {!! Form::text($key->id, null, ['class' => 'form-control touchspin', 'required' => $key->required ? 'required' : '']) !!}
                            @break
                    @endswitch
                </div>
            @endforeach

            <p style="text-align:center; font-weight:bold;">
                <small><a href="{{ url('custom_field/create') }}" target="_blank">{{ trans_choice('general.add_custom_fields', 1) }}</a></small>
            </p>
        </div>

        <div class="box-footer">
            {!! Form::submit(trans_choice('general.save', 1), ['class' => 'btn btn-primary pull-right']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    new tempusDominus.TempusDominus(document.querySelector('.date-picker'), {
        display: {
            components: {
                calendar: true,
                date: true,
                month: true,
                year: true,
                decades: true,
                clock: false,
                hours: false,
                minutes: false,
                seconds: false
            }
        },
        localization: {
            format: 'yyyy-MM-dd' // Adjust format according to your needs
        }
    });
    new tempusDominus.TempusDominus(document.querySelector('.date-pickerr'), {
        display: {
            components: {
                calendar: true,
                date: true,
                month: true,
                year: true,
                decades: true,
                clock: false,
                hours: false,
                minutes: false,
                seconds: false
            }
        },
        localization: {
            format: 'yyyy-MM-dd' // Adjust format according to your needs
        }
    });
    new tempusDominus.TempusDominus(document.querySelector('.date-pickerrr'), {
        display: {
            components: {
                calendar: true,
                date: true,
                month: true,
                year: true,
                decades: true,
                clock: false,
                hours: false,
                minutes: false,
                seconds: false
            }
        },
        localization: {
            format: 'yyyy-MM-dd' // Adjust format according to your needs
        }
    });
    
});

</script>
<script>

$(document).ready(function (e) {
    $(".touchspin").TouchSpin({
        buttondown_class: 'btn blue',
        buttonup_class: 'btn blue',
        min: 0,
        max: 10000000000,
        step: 0.01,
        decimals: 2,
        boostat: 5,
        maxboostedstep: 1,
        prefix: ''
    });
})
// function addRow() {
//     var fixed_count = 0;
//     var table = document.getElementById("current_valuation");
//     var rowCount = table.rows.length;
//     if (rowCount < 100) {                            // limit the user from creating fields more than your limits
//         var row = table.insertRow(rowCount);
//         var colCount = table.rows[fixed_count].cells.length;
//         if (colCount == 0) {
//             colCount = hiddenTable.rows[fixed_count].cells.length;
//         }
//         for (var i = 0; i < colCount; i++) {
//             var newcell = row.insertCell(i);
//             if (i == 0) {
//                 newcell.innerHTML = rowCount;
//             }
//             else if (i == 1) {
//                 newcell.innerHTML = "<input id=\"inputAssetManagementDateCurrent" + rowCount + "\" type=\"text\" placeholder=\"yyyy-mm-dd\" name=\"asset_management_current_date[]\" class=\"date-picker form-control\" value=\"\">";
//             }
//             else if (i == 2)
//                 newcell.innerHTML = "<input id=\"inputAssetManagementCurrentValue" + rowCount + "\" type=\"text\"  placeholder=\"\" name=\"asset_management_current_value[]\" class=\"form-control touchspin\" value=\"\">";
//         }
//         bindDeactivate();
//     } else {
//         alert("Maximum Rows you can add is 100");

//     }
// }
// function deleteRow() {
//     var fixed_count = 2;
//     var table = document.getElementById("current_valuation");
//     var rowCount = table.rows.length;
//     for (var i = rowCount - 1; i < rowCount; i++) {
//         var row = table.rows[i];
//         if (rowCount <= fixed_count) {               // limit the user from removing all the fields
//             break;
//         }
//         table.deleteRow(i);
//         rowCount--;
//         i--;
//     }
// }


</script>
@endpush

