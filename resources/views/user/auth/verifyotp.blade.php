@extends('user.layout.app')

@section('content')
<br><br><br>
<style>
.corporate {
  background-color: #660066;
}
</style>
<div class="corporate">

    <?php $login_user = asset('asset/img/login-user-bg.jpg'); ?>
    
    <div class="log-overlay"></div>
    <div class="full-page-bg-inner">
        <div class="row no-margin">
            <div class="col-md-6 log-left">

                <h2>Create your account and get moving in minutes</h2>
                <p>Welcome to {{Setting::get('site_title','Tranxit')}}, the easiest way to get around at the tap of
                a button.</p>
            </div>
            
            <div class="col-md-6 log-right">
                <div class="login-box-outer">
                    <div class="login-box row no-margin">
                        <div class="col-md-12">
                            <a class="log-blk-btn" href="{{url('login')}}">ALREADY HAVE AN ACCOUNT?</a>
                            <h3>Enter your Received Otp Here</h3>
                            @if (session()->has('message'))
<p class="alert alert-success">{{session('message')}} </p>
@endif
                            @if ($errors->any())
                            @foreach($errors->all() as $error)
                            <h4 class="alert alert-danger">  {{$error}}</h4>  
                            @endforeach
                            @endif
                        </div>
                        

                        <form role="form" method="POST" action="{{ url('/verifyOtp') }}">

                            <input type="hidden" id="otp_check_id" value="{{session()->get('id')['id']}}" name="check_id">

                            <div id="first_step">

                                <div class="col-md-12">
                                    <input type="hidden" autofocus id="phone_number_back" class="form-control"
                                    name="phone_number_back"
                                    value="{{ old('phone_number') }}"/>
                                </div>

                                <div class="col-md-12">
                                    <input type="text" autofocus id="phone_number" class="form-control"
                                    placeholder="Enter Otp Number" name="otp"
                                    value="{{ old('phone_number') }}"/>
                                </div>

                                <div class="col-md-8">
                                    @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="col-md-12" id="verification_status"></div>

                                <div class="col-md-12" style="padding-bottom: 10px;" id="mobile_verfication_div">
                                    <input type="submit" class="log-teal-btn small" id="mobile_verfication"
                                    onclick="smsLogin();"
                                    value="Verify Phone Number"/>
                                </div>

                            </div>

                            {{ csrf_field() }}

                        </form>

                        <form role="form" method="get" action="{{ url('/resenduserotp') }}">
                            {{ csrf_field() }}
                  <div class="col-md-12" style="padding-bottom: 10px;" id="mobile_verfication_div">
                                <input type="submit" class="small" style="color: " 
                                value="Resend Otp"/>
                            </div>
                        </form>
                        <div class="col-md-12">
                            <p class="helper">Or <a href="{{route('login')}}">Sign in</a> with your user account.
                            </p>
                        </div>

                    </div>


                    <div class="log-copy"><p
                        class="no-margin">{{ Setting::get('site_copyright', '&copy; '.date('Y').' Appoets') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection


    @section('scripts')
    <script type="text/javascript">
        $('.checkbox-inline').on('change', function () {
            $('.checkbox-inline').not(this).prop('checked', false);
        });
    </script>
    {{--<script src="https://sdk.accountkit.com/en_US/sdk.js"></script>--}}
    <script>
                // phone form submission handler
                function smsLogin() {
                    var phoneNumber = document.getElementById("phone_number").value;
                    var phoneNumberBack = document.getElementById("phone_number_back").value;

                    $('#mobile_verfication').html("<p class='helper'> Please Wait... </p>");
                    $('#phone_number').attr('readonly', true);

                    var buttonVal = $('#mobile_verfication').val();

                    if (buttonVal === 'Verify Otp') {

                        verifyOtp(phoneNumberBack)

                    } else {

                        $('#phone_number_back').val(phoneNumber);


                        $.post("{{route('send_otp')}}", {mobile: phoneNumber}, function (data) {
                            $('#otp_check_id').val(data.id);
                            if (data.id === '') {
                                $('#verification_status').html("<p class='helper'> * Authentication Failed </p>");
                                $('#mobile_verfication').html("Resend Otp");
                                $('#phone_number').attr('readonly', true);
                            } else {
                                $('#verification_status').html("<p class='helper'>* OTP Sent.</p>");
                                $('#phone_number').text("value", "");
                                $('#phone_number').attr('placeholder', "Enter Otp Number");
                                $('#phone_number').attr('readonly', false);
                                $('#mobile_verfication').val("");
                            }
                        });
                    }

                    // AccountKit.login(
                    //     'PHONE',
                    //     {countryCode: countryCode, phoneNumber: phoneNumber}, // will use default values if not specified
                    //     loginCallback
                    // );
                }

                function verifyOtp(phone) {

                    var phoneNumber = $('#phone_number').val();
                    var check_id = $('#otp_check_id').val();

                    $.post("{{route('check_otp')}}", {
                        mobile: phone,
                        check_id: check_id,
                        otp: phoneNumber
                    }, function (data) {
                        $('#otp_check_id').val(data.id);
                        if (data.success === '') {
                            $('#verification_status').html("<p class='helper'>* OTP Not Match.</p>");
                            $('#phone_number').text("value", phone);
                            $('#phone_number').attr("readonly", false);
                            $('#phone_number').attr('placeholder', "Enter Otp");
                            $('#mobile_verfication').val("Verify Otp");
                        } else {
                            $('#verification_status').html("<p class='helper'> * Phone Number Verified </p>");
                            $('#mobile_verfication_div').html("");
                            $('#phone_number').attr('placeholder', phone);
                            $('#phone_number').val(phone);
                            $('#phone_number').attr('readonly', true);
                            $('#second_step').fadeIn(400);
                        }
                    });

                }

            </script>

            @endsection
