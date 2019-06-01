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
                            <h3>Create a New Account</h3>
                            @if ($errors->any())
                            @foreach($errors->all() as $error)
                            <h4 class="alert alert-danger">  {{$error}}</h4>  
                            @endforeach
                            @endif
                        </div>
                        <form role="form" method="POST" action="{{ route('register') }}">

                            {{ csrf_field() }}

                            <div id="second_step">

                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="First Name"
                                    name="first_name" value="{{ old('first_name') }}">

                                    @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Last Name"
                                    name="last_name"
                                    value="{{ old('last_name') }}">

                                    @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    <input type="email" class="form-control" name="email"
                                    placeholder="Email Address" value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="phone_number"
                                    placeholder="phone_number Address" value="{{session()->get('id')['phone_number']}}" readonly>

                                    <input type="hidden" class="form-control" name="country_code"
                                    placeholder="phone_number Address" value="+91">

                                    @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="col-md-12">
                                  <label class="radio-inline"><input type="radio" name="gender" value="MALE" style="width:13px; height:13px;">Male</label>
                                  <label class="radio-inline"><input type="radio" name="gender" value="FEMALE" style="width:13px; height:13px;">Female</label>
                                  @if ($errors->has('gender'))
                                  <span class="help-block">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="col-md-12">
                                <input type="password" class="form-control" name="password"
                                placeholder="Password">

                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="col-md-12">
                                <input type="password" placeholder="Re-type Password" class="form-control"
                                name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="col-md-12">
                                <button class="log-teal-btn" type="submit">REGISTER</button>
                            </div>

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


