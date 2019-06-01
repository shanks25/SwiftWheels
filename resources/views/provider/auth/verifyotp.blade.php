@extends('provider.layout.auth')

@section('content')
    <div class="col-md-12">
        <a class="log-blk-btn" href="{{ url('/provider/login') }}">ALREADY REGISTERED?</a>
           <h3>Enter your Received Otp Here</h3>
             @if ($errors->any())
    @foreach($errors->all() as $error)
    <h4 class="alert alert-danger">  {{$error}}</h4>  
    @endforeach
    @endif
    @if (session()->has('message'))
<p class="alert alert-success">{{session('message')}} </p>
@endif
    </div>

   
        <form class="form-horizontal" role="form" method="POST" action="{{ url('providerverifyOtp') }}">

                               <input type="hidden" id="otp_check_id" value="{{session()->get('providerid')['id']}}" name="check_id">

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
  <form role="form" method="get" action="{{ url('/resendproviderotp') }}">
                            {{ csrf_field() }}
                  <div class="col-md-12" style="padding-bottom: 10px;" id="mobile_verfication_div">
                                <input type="submit" class="small" style="color: " 
                                value="Resend Otp"/>
                            </div>
                        </form>
@endsection


 