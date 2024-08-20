@extends('layouts.auth')
@section('title')
    {{ trans('login.login') }}
@endsection

@section('content')

    <div class="container-fluid" style="
    height: 100vh !important;
    ">
        <div class="row "
            style="
           
            height: 100vh !important;
           _display: flex;
            align-items: center;
          ">
            <div class=" hidden-xs col-xs-12 col-sm-12 col-md-6 col-xl-6 col-lg-6"
                style="
                background:white;
                height: 100vh !important;
                display: flex;
                align-items: center;     /* Align the flex-items vertically */
                justify-content: center; /* Optional, to align inner flex-items horizontally within the column  */
                ">

                <img src="{{ asset('logo_688X688.png') }}" style="width:60%; height:auto;" class="img-responsive">

            </div>
            <div class=" col-xs-12 col-sm-12 col-md-6 col-xl-6 col-lg-6"
                style="
           
            background-image:url({{ asset('login_bg.jpg') }});
            background-size:cover;
            background-repat:no-repeat;
            height: 100vh !important;
            display: flex;
            align-items: center;     /* Align the flex-items vertically */
            justify-content: center; /* Optional, to align inner flex-items
                              horizontally within the column  */
             ">

                <div class="login-box " style=" background:rgba(255,255,255,0.5) !important;">
                    <div class="login-logo" style=" background:rgba(255,255,255,0.5) !important;">
                        <a href="#">

                            {{-- <b>{{ \App\Models\Setting::where('setting_key', 'company_name')
                            ->first()->setting_value }}
                            </b> --}}
                            <strong>Login</strong>
                        </a>
                    </div>
                    <!-- /.login-logo -->
                    <div class="login-box-body" style="background:rgba(255,255,255,0.5) !important;">
                        @if (Session::has('flash_notification'))
                            @foreach (Session::get('flash_notification') as $key)
                                <script>
                                    $(document).ready(function() {
                                        toastr.{{ $key->level }}('{{ $key->message }}', 'Response Status')
                                    })
                                </script>
                            @endforeach
                        @endif
                        @if (isset($msg))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-bs-dismiss="alert"
                                    aria-hidden="true">&times;</button>
                                {{ $msg }}
                            </div>
                        @endif
                        @if (isset($error))
                            <div class="alert alert-error">
                                <button type="button" class="close" data-bs-dismiss="alert"
                                    aria-hidden="true">&times;</button>
                                {{ $error }}
                            </div>
                        @endif
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {!! Form::open(['url' => url('login'), 'method' => 'post', 'name' => 'form', 'class' => 'login-form']) !!}
                        <p class="login-box-msg">{{ trans('login.sign_in') }}</p>

                        <div class="form-group has-feedback">
                            {!! Form::email('email', null, [
                                'class' => 'form-control',
                                'placeholder' => trans('login.email'),
                                'required' => 'required',
                            ]) !!}
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            {!! Form::password('password', [
                                'class' => 'form-control',
                                'placeholder' => trans('login.password'),
                                'required' => 'required',
                            ]) !!}
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>
                        <div class="row">
                            <div class="col-xs-8">
                                <div class="checkbox icheck">
                                    <label>
                                        <input type="checkbox" name="remember" value="1">
                                        {{ trans('login.remember') }}
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-xs-4">
                                <button type="submit"
                                    class="btn btn-primary btn-block btn-flat">{{ trans('login.login') }}</button>
                            </div>
                            <!-- /.col -->
                        </div>
                        <a href="javascript:;" id="forget-password">{{ trans('login.reset') }}</a><br>
                        {!! Form::close() !!}
                        {!! Form::open(['url' => url('reset'), 'method' => 'post', 'name' => 'form', 'class' => 'forget-form ']) !!}
                        <p class="login-box-msg">{{ trans('login.reset_msg') }}</p>

                        <div class="form-group has-feedback">
                            {!! Form::email('email', null, [
                                'class' => 'form-control',
                                'placeholder' => trans('login.email'),
                                'required' => 'required',
                            ]) !!}
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>
                        <div class="row">
                            <div class="col-xs-8">
                                <div class="">
                                    <a href="javascript:;" class="btn btn-primary  btn-flat" id="back-btn"><i
                                            class="fa fa-backward"></i> {{ trans('login.back') }}</a>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-xs-4">
                                <button type="submit"
                                    class="btn btn-primary btn-block btn-flat">{{ trans('login.reset_btn') }}</button>
                            </div>
                            <!-- /.col -->
                        </div>
                        {!! Form::close() !!}
                    </div>

                </div>


            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            jQuery('#forget-password').click(function() {
                jQuery('.login-form').hide();
                jQuery('.forget-form').show();
            });
            jQuery('#register-btn').click(function() {
                jQuery('.login-form').hide();
                jQuery('.register-form').show();
            });

            jQuery('#back-btn').click(function() {
                jQuery('.login-form').show();
                jQuery('.forget-form').hide();
            });
            jQuery('#register-back-btn').click(function() {
                jQuery('.login-form').show();
                jQuery('.register-form').hide();
            });
            $('#check_btn').click(function(e) {
                e.preventDefault();
                var repair = $('#repair_number').val();
                if (repair == '') {
                    toastr.warning('Repair Number can not be empty', 'Response Status')
                } else {
                    $.ajax({
                        url: '{!! url('check') !!}/' + repair,
                        success: function(data) {
                            toastr.success('Loading information', 'Response Status')
                            $('#status').find('.modal-body').html($(data));
                            $('#status').modal();
                        },
                        error: function() {
                            toastr.warning('There was an error processing the request',
                                'Response Status')
                        },
                        type: 'GET'
                    });
                }
            })
        });
    </script>
@endsection
