@extends('layouts.master')
@section('title')
    {{ trans_choice('general.edit',1) }} {{ trans_choice('general.event',1) }} {{ trans_choice('general.calendar',1) }}
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans_choice('general.edit',1) }} {{ trans_choice('general.event',1) }} {{ trans_choice('general.calendar',1) }}</h3>

            <div class="box-tools pull-right">

            </div>
        </div>
        {!! Form::open(array('url' => url('event/calendar/'.$calendar->id.'/update'), 'method' => 'post', 'class' => 'form-horizontal')) !!}
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('name',trans_choice('general.name',1),array('class'=>'col-sm-2 control-label')) !!}
                <div class="col-sm-10">
                    {!! Form::text('name',$calendar->name, array('class' => 'form-control', 'placeholder'=>"",'required'=>'required')) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('name',trans_choice('general.color',1),array('class'=>'col-sm-2 control-label')) !!}
                <div class="col-sm-10">
                    <div class="radio">
                        <label>
                            <input type="radio" name="color" id="inputType" value="#b2cd92" required="" @if($calendar->color=='#b2cd92') checked @endif>
                            <span class=""
                                  style="background-color: #b2cd92;border: 4px solid #fff;">
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            </span>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="color" id="inputType" value="#698497" required="" @if($calendar->color=='#698497') checked @endif>
                            <span class=""
                                  style="background-color: #698497;border: 4px solid #fff;">
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            </span>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="color" id="inputType" value="#cb6962" required="" @if($calendar->color=='#cb6962') checked @endif>
                            <span class=""
                                  style="background-color: #cb6962;border: 4px solid #fff;">
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            </span>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="color" id="inputType" value="#d1ba39" required="" @if($calendar->color=='#d1ba39') checked @endif>
                            <span class=""
                                  style="background-color: #d1ba39;border: 4px solid #fff;">
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            </span>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="color" id="inputType" value="#a773b8" required="" @if($calendar->color=='#a773b8') checked @endif>
                            <span class=""
                                  style="background-color: #a773b8;border: 4px solid #fff;">
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            </span>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="color" id="inputType" value="#a3cccb" required="" @if($calendar->color=='#a3cccb') checked @endif>
                            <span class=""
                                  style="background-color: #a3cccb;border: 4px solid #fff;">
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            </span>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="color" id="inputType" value="#bdbdbd" required="" @if($calendar->color=='#bdbdbd') checked @endif>
                            <span class=""
                                  style="background-color: #bdbdbd;border: 4px solid #fff;">
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            </span>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="color" id="inputType" value="#558B2F" required="" @if($calendar->color=='#558B2F') checked @endif>
                            <span class=""
                                  style="background-color: #558B2F;border: 4px solid #fff;">
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            </span>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="color" id="inputType" value="#283593" required="" @if($calendar->color=='#283593') checked @endif>
                            <span class=""
                                  style="background-color: #283593;border: 4px solid #fff;">
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            </span>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="color" id="inputType" value="#B71C1C" required="" @if($calendar->color=='#B71C1C') checked @endif>
                            <span class=""
                                  style="background-color: #B71C1C;border: 4px solid #fff;">
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            </span>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="color" id="inputType" value="#FF8F00" required="" @if($calendar->color=='#FF8F00') checked @endif>
                            <span class=""
                                  style="background-color: #FF8F00;border: 4px solid #fff;">
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            </span>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="color" id="inputType" value="#6A1B9A" required="" @if($calendar->color=='#6A1B9A') checked @endif>
                            <span class=""
                                  style="background-color: #6A1B9A;border: 4px solid #fff;">
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            </span>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="color" id="inputType" value="#00695C" required="" @if($calendar->color=='#00695C') checked @endif>
                            <span class=""
                                  style="background-color: #00695C;border: 4px solid #fff;">
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            </span>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="color" id="inputType" value="#b2cd92" required="" @if($calendar->color=='#b2cd92') checked @endif>
                            <span class=""
                                  style="background-color: #b2cd92;border: 4px solid #fff;">
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            </span>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="color" id="inputType" value="#424242" required="" @if($calendar->color=='#424242') checked @endif>
                            <span class=""
                                  style="background-color: #424242;border: 4px solid #fff;">
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            </span>
                        </label>
                    </div>
                </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right">{{ trans_choice('general.save',1) }}</button>
        </div>
        {!! Form::close() !!}
    </div>
    <!-- /.box -->
@endsection

