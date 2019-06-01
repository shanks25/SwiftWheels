@extends('admin.layout.base')

@section('title', 'Add OutStation ')

@section('content')
    <div class="content-area py-1">
        <div class="container-fluid">
            <div class="box box-block bg-white">
                <a href="{{ route('admin.outstations.index') }}" class="btn btn-default pull-right"><i
                            class="fa fa-angle-left"></i> @lang('admin.back')</a>

                <h5 style="margin-bottom: 2em;">Add OutStation</h5>

                <form class="form-horizontal" action="{{route('admin.outstations.store')}}" method="POST"
                      enctype="multipart/form-data" role="form">

                    {{ csrf_field() }}

                    <div class="form-group row">
                        <label for="name" class="col-xs-12 col-form-label">OutStation Name</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ old('name') }}" name="name" required
                                   id="name" placeholder="OutStation Name">
                        </div>
                    </div>

                    <input type="hidden" id="place" name="place">
                    <input type="hidden" id="latitude" name="latitude">
                    <input type="hidden" id="longitude" name="longitude">

                    <div class="form-group row">
                        <div class="col-xs-10">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <a href="{{ route('admin.outstations.index') }}"
                                       class="btn btn-danger btn-block">@lang('admin.cancel')</a>
                                </div>
                                <div class="col-xs-12 col-sm-6 offset-md-6 col-md-3">
                                    <button type="submit" class="btn btn-primary btn-block">Add OutStation</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ Setting::get('map_key') }}&libraries=places"></script>

    <script>
        var options = {
            // types: ['(cities)']
        };

        google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(document.getElementById('name'), options);
            google.maps.event.addListener(places, 'place_changed', function () {
                var place = places.getPlace();
                var latitude = place.geometry.location.lat();
                var longitude = place.geometry.location.lng();
                $('#latitude').val(latitude);
                $('#longitude').val(longitude);
                $('#place').val(place.city);
            });
        });

    </script>

    {{--<script>--}}
    {{--function initialize() {--}}
    {{--var input = document.getElementById('name');--}}
    {{--new google.maps.places.Autocomplete(input);--}}
    {{--}--}}

    {{--google.maps.event.addDomListener(window, 'load', initialize);--}}
    {{--</script>--}}

@endsection