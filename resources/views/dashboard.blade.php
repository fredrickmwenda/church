@extends('layouts.mymaster')
@section('title')
{{ trans('general.dashboard') }}
@endsection

@section('page-header-scripts')
<link rel="stylesheet" href="{{ asset('assets/plugins/fullcalendar/fullcalendar.css')}}">

@endsection
@section('content')
<?php
$data = $monthly_overview_data;
$translations = [
    'today' => trans_choice('general.today', 1),
    'month' => trans_choice('general.month', 1),
    'week' => trans_choice('general.week', 1),
    'day' => trans_choice('general.day', 1),
];
$events = $events;



?>
<div class="row">
    <!-- @if (Sentinel::hasAccess('dashboard.members_statistics'))
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red">
                        <i class="fa fa-users"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ trans_choice('general.registered', 1) }}
                            <br>{{ trans_choice('general.member', 2) }}</span>
                        <span class="info-box-number">{{ \App\Models\Member::count() }}</span>
                    </div>
                </div>
            </div>
        @endif
        @if (Sentinel::hasAccess('dashboard.tags_statistics'))
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="fa fa-tags"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">
                            {{ trans_choice('general.total', 1) }}
                            <br>
                            {{-- {{ trans_choice('general.tag', 2) }} --}}
                            organization
                        </span>
                        <span class="info-box-number">{{ \App\Models\Tag::count() }}</span>
                    </div>
                </div>
            </div>
        @endif
        <div class="clearfix visible-sm-block"></div>
        @if (Sentinel::hasAccess('dashboard.contributions_statistics'))
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{ trans_choice('general.total', 1) }}
                            <br>{{ trans_choice('general.contribution', 2) }}</span>
                        @if (\App\Models\Setting::where('setting_key', 'currency_position')->first()->setting_value == 'left')
                            <span class="info-box-number">
                                {{ \App\Models\Setting::where('setting_key', 'currency_symbol')->first()->setting_value }}
                                {{ number_format(\App\Helpers\GeneralHelper::total_contributions(), 2) }} </span>
                        @else
                            <span class="info-box-number">
                                {{ number_format(\App\Helpers\GeneralHelper::total_contributions(), 2) }}
                                {{ \App\Models\Setting::where('setting_key', 'currency_symbol')->first()->setting_value }}</span>
                        @endif

                    </div>
                </div>
            </div>
        @endif
        <div class="clearfix visible-sm-block"></div>
        @if (Sentinel::hasAccess('dashboard.contributions_statistics'))
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-hand-lizard-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{ trans_choice('general.total', 1) }}
                            <br>{{ trans_choice('general.pledge', 2) }}</span>
                        @if (\App\Models\Setting::where('setting_key', 'currency_position')->first()->setting_value == 'left')
                            <span class="info-box-number">
                                {{ \App\Models\Setting::where('setting_key', 'currency_symbol')->first()->setting_value }}
                                {{ number_format(\App\Helpers\GeneralHelper::total_pledges_payments(), 2) }} </span>
                        @else
                            <span class="info-box-number">
                                {{ number_format(\App\Helpers\GeneralHelper::total_pledges_payments(), 2) }}
                                {{ \App\Models\Setting::where('setting_key', 'currency_symbol')->first()->setting_value }}</span>
                        @endif

                    </div>
                </div>
            </div>
        @endif -->
    @if (Sentinel::hasAccess('dashboard.members_statistics'))
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa-solid fa-users"></i></span>
                <div class="dash-widget-info">
                    <h4>{{ trans_choice('general.registered', 1) }}</h4>
                    <span>{{ \App\Models\Member::count() }}</span>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if (Sentinel::hasAccess('dashboard.tags_statistics'))
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa-solid fa-comments"></i></span>
                <div class="dash-widget-info">
                    <h4>{{ trans_choice('general.follow_up', 1) }}</h4>
                    <span>{{ \App\Models\FollowUp::count() }}</span>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if (Sentinel::hasAccess('dashboard.contributions_statistics'))
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa-solid fa-handshake"></i></span>
                <div class="dash-widget-info">
                    <h4>{{ trans_choice('general.soul_winning', 2) }}</h4>


                    <span>
                        {{ \App\Models\SoulWinning::count() }}

                        <span>


                </div>
            </div>
        </div>
    </div>
    @endif

    @if (Sentinel::hasAccess('dashboard.contributions_statistics'))
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa-solid fa-building"></i></span>
                <div class="dash-widget-info">
                    <h4>{{ trans_choice('general.branch', 2) }}</h4>


                    <span>
                        {{ \App\Models\Branch::count() }}
                        <span>


                </div>
            </div>
        </div>
    </div>
    @endif
    @if (Sentinel::hasAccess('dashboard.contributions_statistics'))
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa-solid fa-donate"></i></span>
                <div class="dash-widget-info">
                    <h4>{{ trans_choice('general.contribution', 2) }}</h4>
                    @if (\App\Models\Setting::where('setting_key', 'currency_position')->first()->setting_value == 'left')
                    <span>
                        {{ \App\Models\Setting::where('setting_key', 'currency_symbol')->first()->setting_value }}
                        {{ number_format(\App\Helpers\GeneralHelper::total_contributions(), 2) }}</span>

                    @else
                    <span>
                        {{ number_format(\App\Helpers\GeneralHelper::total_contributions(), 2) }}
                        {{ \App\Models\Setting::where('setting_key', 'currency_symbol')->first()->setting_value }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @endif
    @if (Sentinel::hasAccess('dashboard.contributions_statistics'))
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa-solid fa-gift"></i></span>
                <div class="dash-widget-info">
                    <h4>{{ trans_choice('general.pledge', 2) }}</h4>

                    @if (\App\Models\Setting::where('setting_key', 'currency_position')->first()->setting_value == 'left')
                    <span>
                        {{ \App\Models\Setting::where('setting_key', 'currency_symbol')->first()->setting_value }}
                        {{ number_format(\App\Helpers\GeneralHelper::total_pledges_payments(), 2) }} </span>
                    @else
                    <span>
                        {{ number_format(\App\Helpers\GeneralHelper::total_pledges_payments(), 2) }}
                        {{ \App\Models\Setting::where('setting_key', 'currency_symbol')->first()->setting_value }}</span>
                    @endif

                </div>
            </div>
        </div>
    </div>
    @endif




    @if (Sentinel::hasAccess('dashboard.contributions_statistics'))
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa-solid fa-donate"></i></span>
                <div class="dash-widget-info">
                    <h4>{{ trans_choice('general.expense', 2) }}</h4>

                    @if (\App\Models\Setting::where('setting_key', 'currency_position')->first()->setting_value == 'left')
                    <span>
                        {{ \App\Models\Setting::where('setting_key', 'currency_symbol')->first()->setting_value }}
                        {{ number_format(\App\Helpers\GeneralHelper::total_expenses(), 2) }} </span>
                    @else
                    <span>
                        {{ number_format(\App\Helpers\GeneralHelper::total_expenses(), 2) }}
                        {{ \App\Models\Setting::where('setting_key', 'currency_symbol')->first()->setting_value }}</span>
                    @endif

                </div>
            </div>
        </div>
    </div>
    @endif

    @if (Sentinel::hasAccess('dashboard.contributions_statistics'))
    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa-solid fa-calendar"></i></span>
                <div class="dash-widget-info">
                    <h4>{{ trans_choice('Event Payments', 2) }}</h4>

                    @if (\App\Models\Setting::where('setting_key', 'currency_position')->first()->setting_value == 'left')
                    <span>
                        {{ \App\Models\Setting::where('setting_key', 'currency_symbol')->first()->setting_value }}
                        {{ number_format(\App\Helpers\GeneralHelper::total_event_payments(), 2) }} </span>
                    @else
                    <span>
                        {{ number_format(\App\Helpers\GeneralHelper::total_event_payments(), 2) }}
                        {{ \App\Models\Setting::where('setting_key', 'currency_symbol')->first()->setting_value }}</span>
                    @endif

                </div>
            </div>
        </div>
    </div>
    @endif
</div>





<div class="row">
    @if (Sentinel::hasAccess('dashboard.finance_graph'))
    <div class="col-md-6">
        <!-- BEGIN PORTLET -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><b><span style="color: #16191c">
                            {{ trans_choice('general.contribution', 2) }}
                            and
                            {{ trans_choice('general.pledge', 2) }}

                        </span></b>
                </h3>

                <div class="box-tools pull-right mb-2">
                    <button class="btn btn-box-tool" data-bs-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-bs-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div id="overviewChart" class="chart" style="height: 350px;">
                </div>
            </div>
        </div>
        <!-- END PORTLET -->
    </div>
    @endif

    @if (Sentinel::hasAccess('dashboard.finance_graph'))
    <div class="col-md-6">
        <!-- BEGIN PORTLET -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><b><span style="color: #16191c">
                            {{ trans_choice('general.event', 2) }} Payment and
                            {{ trans_choice('general.other_income', 2) }}
                        </span></b>
                </h3>

                <div class="box-tools pull-right mb-2">
                    <button class="btn btn-box-tool" data-bs-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-bs-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div id="otherPaymentChart" class="chart" style="height: 350px;">
                </div>
            </div>
        </div>
        <!-- END PORTLET -->
    </div>
    @endif

    @if (Sentinel::hasAccess('dashboard.finance_graph'))
    <div class="col-md-6">
        <!-- BEGIN PORTLET -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><b><span style="color: #16191c">Payments Equivalence</span></b>
                </h3>

                <div class="box-tools pull-right mb-2">
                    <button class="btn btn-box-tool" data-bs-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-bs-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div id="overviewChart" class="chart" style="height: 350px;">
                </div>
            </div>
        </div>
        <!-- END PORTLET -->
    </div>
    @endif

    @if (Sentinel::hasAccess('dashboard.calendar'))

    <div class="col-md-6">
        <!-- BEGIN PORTLET -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><b><span style="">{{ trans_choice('general.event', 2) }}
                            {{ trans_choice('general.calendar', 1) }}</span></b>
                </h3>

                <div class="box-tools pull-right mb-2">
                    <button class="btn btn-box-tool" data-bs-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-bs-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div id="calendar" class="chart" style="">
                </div>
            </div>
        </div>
        <!-- END PORTLET -->
    </div>
</div>
@endif
@endsection
@section('footer-scripts')
<script src="{{ asset('assets/plugins/fullcalendar/fullcalendar.js') }}"></script>

<script src="{{ asset('assets/plugins/amcharts/amcharts.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/amcharts/serial.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/amcharts/pie.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/amcharts/themes/light.js') }}" type="text/javascript"></script>
<script>
    AmCharts.makeChart("overviewChart", {
        "type": "serial",
        "theme": "light",
        "autoMargins": true,
        "marginLeft": 30,
        "marginRight": 8,
        "marginTop": 10,
        "marginBottom": 26,
        "fontFamily": 'Open Sans',
        "color": '#888',

        "dataProvider": <?php echo $data; ?>,
        "valueAxes": [{
            "axisAlpha": 0,

        }],
        "startDuration": 1,
        "graphs": [{
            "balloonText": "<span style='font-size:13px;'>[[title]] in [[category]]:<b> [[value]]</b> [[additional]]</span>",
            "bullet": "round",
            "bulletSize": 8,
            "lineColor": "#1bd126",
            "lineThickness": 4,
            "negativeLineColor": "#b6481e",
            "title": " {{ trans_choice('general.contribution', 2) }}",
            "type": "smoothedLine",
            "valueField": "contributions"
        }, {
            "balloonText": "<span style='font-size:13px;'>[[title]] in [[category]]:<b> [[value]]</b> [[additional]]</span>",
            "bullet": "round",
            "bulletSize": 8,
            "lineColor": "#4846d1",
            "lineThickness": 4,
            "negativeLineColor": "#b6481e",
            "title": " {{ trans_choice('general.pledge', 2) }}",
            "type": "smoothedLine",
            "valueField": "pledges"
        }],
        "categoryField": "month",
        "categoryAxis": {
            "gridPosition": "start",
            "axisAlpha": 0,
            "tickLength": 0,
            "labelRotation": 30,

        },
        "export": {
            "enabled": true,
            "libs": {
                "path": "{{ asset('assets/plugins/amcharts/plugins/export/libs') }}/"
            }
        }

    }).addLegend(new AmCharts.AmLegend());

    AmCharts.makeChart("otherPaymentChart", {
        "type": "serial",
        "theme": "light",
        "autoMargins": true,
        "marginLeft": 30,
        "marginRight": 8,
        "marginTop": 10,
        "marginBottom": 26,
        "fontFamily": 'Open Sans',
        "color": '#888',

        "dataProvider": <?php echo $data; ?>,
        "valueAxes": [{
            "axisAlpha": 0,

        }],
        "startDuration": 1,
        "graphs": [{
            "balloonText": "<span style='font-size:13px;'>[[title]] in [[category]]:<b> [[value]]</b> [[additional]]</span>",
            "bullet": "round",
            "bulletSize": 8,
            "lineColor": "#d1cf0d",
            "lineThickness": 4,
            "negativeLineColor": "#b6481e",
            "title": " {{ trans_choice('general.other_income', 2) }}",
            "type": "smoothedLine",
            "valueField": "other_income"
        }, {
            "balloonText": "<span style='font-size:13px;'>[[title]] in [[category]]:<b> [[value]]</b> [[additional]]</span>",
            "bullet": "round",
            "bulletSize": 8,
            "lineColor": "#ff8b39",
            "lineThickness": 4,
            "negativeLineColor": "#ff8b39",
            "title": " {{ trans_choice('general.event', 1) }} {{ trans_choice('general.payment', 2) }}",
            "type": "smoothedLine",
            "valueField": "events"
        }],
        "categoryField": "month",
        "categoryAxis": {
            "gridPosition": "start",
            "axisAlpha": 0,
            "tickLength": 0,
            "labelRotation": 30,

        },
        "export": {
            "enabled": true,
            "libs": {
                "path": "{{ asset('assets/plugins/amcharts/plugins/export/libs') }}/"
            }
        }

    }).addLegend(new AmCharts.AmLegend());
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        buttonText: {
            today: 'Today',
            month: 'Month',
            week: 'Week',
            day: 'Day'
        },
        //Random default events
        events: <?php echo $events; ?>,
        selectable: false,

    });
</script>
@endsection