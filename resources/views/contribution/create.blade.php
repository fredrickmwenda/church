@extends('layouts.master')
@section('title')
    {{ trans_choice('general.add', 1) }} {{ trans_choice('general.contribution', 1) }}
@endsection

@section('content')
    <div class="box box-primary" id="app">

        <div class="box-header with-border">
            <h3 class="box-title">{{ trans_choice('general.add', 1) }} {{ trans_choice('general.contribution', 1) }}</h3>

            <div class="box-tools pull-right">

            </div>
        </div>
        {!! Form::open([
            'url' => url('contribution/store'),
            //** 'url' => url('contribution/store/way'),*/
            /**'url' => url('pay'), */
            'method' => 'post',
            'class' => '',
            'name' => 'form',
            'enctype' => 'multipart/form-data',
        ]) !!}
        <div class="box-body">
            <p class="bg-navy disabled color-palette">{{ trans_choice('general.required', 1) }}
                {{ trans_choice('general.field', 2) }}</p>
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
                {!! Form::label('member_id', trans_choice('general.member', 1), ['class' => ' control-label']) !!}
                <div id="memberDetails">
                    {!! Form::select('member_id', $members, null, [
                        'class' => 'form-control select2',
                        'placeholder' => '',
                        'required' => 'required',
                        'id' => 'member_id',
                    ]) !!}
                </div>
                <div class="checkbox icheck">
                    <label>
                        <input type="checkbox" name="member_type" value="1" id="member_type">
                        {{ trans('general.anonymous') }}
                    </label>
                </div>
            </div>
            <div class="row" v-for="(item,index) in selected_contributions">
                <input type="hidden" name="selected_contributions[]" v-bind:value="index">
                <div class="col-md-2">
                    <div class="form-group">
                        <label v-bind:for="'amount_'+index">
                            {{ trans_choice('general.amount', 1) }}
                            <strong class="text-danger"> * </strong>
                        </label>
                        <input class="form-control touchspin" v-bind:name="'amount['+index+'][]'"
                            v-bind:id="'amount_'+index" v-model="item.amount" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label v-bind:for="'contribution_batch_id_'+index">
                            {{ trans_choice('general.batch', 1) }}
                            <strong class="text-danger"> * </strong>
                        </label>
                        <select class="form-control" v-bind:name="'contribution_batch_id['+index+'][]'"
                            v-model="item.contribution_batch_id" v-bind:id="'contribution_batch_id_'+index">
                            <option v-for="batch in batches" v-bind:value="batch.id" required>
                                @{{ batch.name }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label v-bind:for="'contribution_type_id_'+index">
                            {{ trans_choice('general.type', 1) }}
                            <strong class="text-danger"> * </strong>
                        </label>
                        <select class="form-control" v-bind:name="'contribution_type_id['+index+'][]'"
                            v-model="item.contribution_type_id" v-bind:id="'contribution_type_id_'+index">
                            <option v-for="contribution_type in contribution_types" v-bind:value="contribution_type.id"
                                required>
                                @{{ contribution_type.name }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label v-bind:for="'fund_id_'+index">
                            {{ trans_choice('general.fund', 1) }}
                            <strong class="text-danger"> * </strong>
                        </label>
                        <select class="form-control" v-bind:name="'fund_id['+index+'][]'" v-model="item.fund_id"
                            v-bind:id="'fund_id_'+index" required>
                            <option v-for="fund in funds" v-bind:value="fund.id">@{{ fund.name }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label v-bind:for="'payment_method_id_'+index">
                            {{ trans_choice('general.payment', 1) }}
                            {{ trans_choice('general.method', 1) }}
                            <strong class="text-danger"> * </strong>
                        </label>
                        <select class="form-control" v-bind:name="'payment_method_id['+index+'][]'"
                            v-model="item.payment_method_id" v-bind:id="'payment_method_id_'+index" required>
                            <option v-for="payment_method in payment_methods" v-bind:value="payment_method.id">
                                @{{ payment_method.name }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label></label>
                        <span v-if="index>0" class="label label-danger margin"
                            v-on:click="selected_contributions.splice(index,1)">
                            <i class="fa fa-minus"></i>
                        </span>
                        <span v-if="index==0" class="label label-success" v-on:click="add_contribution">
                            <i class="fa fa-plus"></i>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('date', trans_choice('general.date', 1), ['class' => '']) !!}
                {!! Form::text('date', null, [
                    'class' => 'form-control date-picker',
                    'placeholder' => '',
                    'required' => 'required',
                ]) !!}
            </div>


            <p class="bg-navy disabled color-palette">{{ trans_choice('general.optional', 1) }}
                {{ trans_choice('general.field', 2) }}</p>
            <div class="form-group">
                {!! Form::label('notes', trans_choice('general.note', 2), ['class' => '']) !!}
                {!! Form::textarea('notes', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label(
                    'files',
                    trans_choice('general.file', 2) . '(' . trans_choice('general.borrower_file_types', 1) . ')',
                    ['class' => ''],
                ) !!}
                {!! Form::file('files[]', ['class' => 'form-control', 'multiple' => '', 'rows' => '3']) !!}
                <div class="col-sm-12">{{ trans_choice('general.select_thirty_files', 1) }}
                </div>
            </div>
            <div class="form-group">
                <hr>
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
                </div>
            @endforeach
            <p style="text-align:center; font-weight:bold;">
                <small><a href="{{ url('custom_field/create') }}" target="_blank">Click here to add custom fields on
                        this page</a></small>
            </p>

        </div>

        <div class="box-footer">

            <button type="submit" class="btn btn-primary margin pull-right" name="pay_now" value="pay_now">
                {{-- {{ trans_choice('general.save', 1) }}
                & {{ trans_choice('general.exit', 1) }} --}}
                Pay now
            </button>

            <button type="submit" class="btn btn-primary margin pull-right" name="save_return" value="save_return">
                {{ trans_choice('general.save', 1) }}
                & {{ trans_choice('general.return', 1) }}
            </button>

        </div>
        {!! Form::close() !!}
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@endsection
@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
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
       
    });
</script>
@endpush
@section('footer-scripts')
    <script>
        $("#member_type").on('ifChecked', function(e) {
            $("#member_id").removeAttr('required');
            $("#memberDetails").hide();

        });
        $("#member_type").on('ifUnchecked', function(e) {
            $("#member_id").attr('required', 'required');
            $("#memberDetails").show();
        });
        $(document).ready(function(e) {

        });
        var app = new Vue({
            el: '#app',
            data: {
                batches: batches,
                funds: funds,
                branches: branches,
                payment_methods: payment_methods,
                contribution_types: contribution_types,
                selected_contributions: [{
                    amount: '',
                    contribution_batch_id: '',
                    contribution_type_id: '',
                    fund_id: '',
                    payment_method_id: '',
                }]
            },
            methods: {
                add_contribution() {
                    this.selected_contributions.push({
                        amount: '',
                        contribution_batch_id: '',
                        contribution_type_id: '',
                        fund_id: '',
                        payment_method_id: '',
                    });
                }
            }
        });
    </script>
@endsection
