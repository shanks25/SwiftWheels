@extends('provider.layout.auth')

@section('content')
    <div class="col-md-12">
        <a class="log-blk-btn" href="{{ url('/provider/login') }}">ALREADY REGISTERED?</a>
        <h3>Sign Up</h3>
                 @if ($errors->any())
                    @foreach($errors->all() as $error)
                    <h4 class="alert alert-danger">  {{$error}}</h4>  
                    @endforeach
                @endif
    </div>

    <div class="col-md-12">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('providerregister') }}">

            <div id="first_step">
                <div class="col-md-4">
                    <input  type="number" placeholder="+223" id="country_code" name="country_code" value="+223" readonly="" />
                </div>

                <div class="col-md-8">
                    <input type="number" autofocus id="phone_number" class="form-control" placeholder="Enter Phone Number"
                           name="mobile" value="{{ old('phone_number') }}"/ required="">
                </div>

                <div class="col-md-8">
                    @if ($errors->has('phone_number'))
                        <span class="help-block">
                        <strong>{{ $errors->first('phone_number') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="col-md-12" style="padding-bottom: 10px;" id="mobile_verfication">
                    <input type="submit" class="log-teal-btn small"/>
                </div>
            </div>

            {{ csrf_field() }}

            <div id="second_step" style="display: none;">

                <input id="name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}"
                       placeholder="First Name" autofocus>

                @if ($errors->has('first_name'))
                    <span class="help-block">
                    <strong>{{ $errors->first('first_name') }}</strong>
                </span>
                @endif

                <input id="name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}"
                       placeholder="Last Name">

                @if ($errors->has('last_name'))
                    <span class="help-block">
                    <strong>{{ $errors->first('last_name') }}</strong>
                </span>
                @endif

                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                       placeholder="E-Mail Address">

                @if ($errors->has('email'))
                    <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif

                <label class="radio-inline"><input type="radio" name="gender" value="MALE" checked>Male</label>
                <label class="radio-inline"><input type="radio" name="gender" value="FEMALE">Female</label>
                @if ($errors->has('gender'))
                    <span class="help-block">
                    <strong>{{ $errors->first('gender') }}</strong>
                </span>
                @endif

                <input id="password" type="password" class="form-control" name="password" placeholder="Password">

                @if ($errors->has('password'))
                    <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif

                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                       placeholder="Confirm Password">

                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
                @endif

                <select class="form-control" name="service_type" id="service_type">
                    <option value="">Select Service</option>
                    @foreach(get_all_service_types() as $type)
                        <option value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                </select>

                @if ($errors->has('service_type'))
                    <span class="help-block">
                    <strong>{{ $errors->first('service_type') }}</strong>
                </span>
                @endif

                <input id="service-number" type="text" class="form-control" name="service_number"
                       value="{{ old('service_number') }}" placeholder="Car Number">

                @if ($errors->has('service_number'))
                    <span class="help-block">
                    <strong>{{ $errors->first('service_number') }}</strong>
                </span>
                @endif

                <input id="service-model" type="text" class="form-control" name="service_model"
                       value="{{ old('service_model') }}" placeholder="Car Model">

                @if ($errors->has('service_model'))
                    <span class="help-block">
                    <strong>{{ $errors->first('service_model') }}</strong>
                </span>
                @endif

                <button type="submit" class="log-teal-btn">
                    Register
                </button>

            </div>
        </form>
    </div>
@endsection


 