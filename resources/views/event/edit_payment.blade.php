@extends('layouts.master')
@section('title')
    Edit Payment
@endsection
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{url('event/'.$event_payment->event_id.'/show')}}" class="list-group-item ">
                    <i class="fa fa-bar-chart"></i>&nbsp; &nbsp; &nbsp; {{trans_choice('general.overview',2)}}
                </a>
                <a href="{{url('event/'.$event_payment->event_id.'/attender')}}" class="list-group-item">
                    <i class="fa fa-user"></i>&nbsp; &nbsp; &nbsp; {{trans_choice('general.attender',2)}}
                </a>
                <a href="{{url('event/'.$event_payment->event_id.'/report')}}" class="list-group-item">
                    <i class="fa fa-th"></i>&nbsp; &nbsp; &nbsp; {{trans_choice('general.report',2)}}
                </a>
                <a href="{{url('event/'.$event_payment->event_id.'/volunteer')}}" class="list-group-item">
                    <i class="fa fa-group"></i>&nbsp; &nbsp; &nbsp; {{trans_choice('general.volunteer',2)}}
                </a>
                <a href="{{url('event/'.$event_payment->event_id.'/payment')}}" class="list-group-item active">
                    <i class="fa fa-money"></i>&nbsp; &nbsp; &nbsp; {{trans_choice('general.payment',2)}}
                </a>
                <a href="{{url('event/'.$event_payment->event_id.'/edit')}}" class="list-group-item">
                    <i class="fa fa-edit"></i>&nbsp; &nbsp; &nbsp; {{trans_choice('general.edit',2)}}
                </a>
            </div>
        </div>
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{trans_choice('general.edit',1)}} {{trans_choice('general.payment',1)}}</h3>

                    <div class="box-tools pull-right">

                    </div>
                </div>
                {!! Form::open(array('url' => url('event/payment/'.$event_payment->id.'/update'), 'method' => 'post','class'=>'', 'name' => 'form',"enctype"=>"multipart/form-data")) !!}
                <div class="box-body">
                    <div class="form-group">
                        {!! Form::label('member_id',trans_choice('general.member',1),array('class'=>' control-label')) !!}
                        <div id="memberDetails">
                            {!! Form::select('member_id',$members,$event_payment->member_id, array('class' => 'form-control select2','placeholder'=>'','required'=>'required','id'=>'member_id')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('amount',trans_choice('general.amount',1),array('class'=>'')) !!}
                        {!! Form::text('amount',$event_payment->amount, array('class' => 'form-control touchspin', 'placeholder'=>"",'required'=>'required')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('date',trans_choice('general.date',1),array('class'=>'')) !!}
                        {!! Form::text('date',$event_payment->date, array('class' => 'form-control date-picker', 'placeholder'=>"",'required'=>'required')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('payment_method_id',trans_choice('general.payment',1).' '.trans_choice('general.method',1),array('class'=>' control-label')) !!}

                        {!! Form::select('payment_method_id',$payment_methods,$event_payment->payment_method_id, array('class' => 'form-control select2','placeholder'=>'','id'=>'payment_method_id')) !!}

                    </div>
                    <div class="form-group">
                        {!! Form::label('notes',trans_choice('general.note',2),array('class'=>'')) !!}
                        {!! Form::textarea('notes',$event_payment->notes, array('class' => 'form-control')) !!}
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary margin pull-right" name="save_return" value="save_return">{{ trans_choice('general.save',1) }} </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
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

  

});

</script>
@endpush

