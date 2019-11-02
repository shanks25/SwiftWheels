@extends('admin.layout.base')

@section('title', 'Update Service Type ')
@section('content')
    <div class="content-area py-1">
        <div class="container-fluid">
            <div class="box box-block bg-white">
                <a href="{{ route('admin.service.index') }}" class="btn btn-default pull-right"><i
                            class="fa fa-angle-left"></i> @lang('admin.back')</a>

                <h5 style="margin-bottom: 2em;">@lang('admin.service.Update_User')</h5>

                <form class="form-horizontal" action="{{route('admin.service.update', $service->id )}}" method="POST"
                      enctype="multipart/form-data" role="form">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="form-group row">
                        <label for="name" class="col-xs-2 col-form-label">@lang('admin.service.Service_Name')</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ $service->name }}" name="name" required
                                   id="name" placeholder="Service Name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="provider_name"
                               class="col-xs-2 col-form-label">@lang('admin.service.Provider_Name')</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ $service->provider_name }}"
                                   name="provider_name" required id="provider_name" placeholder="Provider Name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="image" class="col-xs-2 col-form-label">@lang('admin.picture')</label>
                        <div class="col-xs-10">
                            @if(isset($service->image))
                                <img style="height: 90px; margin-bottom: 15px; border-radius:2em;"
                                     src="{{ $service->image }}">
                            @endif
                            <input type="file" accept="image/*" name="image" class="dropify form-control-file"
                                   id="image" aria-describedby="fileHelp">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="capacity"
                               class="col-xs-2 col-form-label">@lang('admin.service.Seat_Capacity')</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="number" value="{{ $service->capacity }}" name="capacity"
                                   required id="capacity" placeholder="Seat Capacity">
                        </div>
                    </div>
                                

                    @foreach($service->ride_service_prices as $key =>$ride_service_price)
                  
                  @php
                                        $i=0;
                                    @endphp
                                                                        

                        <h1>Service type charges for {{ $ride_types[$key]->name }}.</h1>
                                      {{$key++}}
                  
                        <div class="form-group row">
                            <label for="fixed" class="col-xs-12 col-form-label">@lang('admin.service.Base_Price')
                                ({{ currency() }})</label>
                            <div class="col-xs-10">
                                <input class="form-control" type="text" value="{{ $ride_service_price->fixed }}"
                                       name="{{ $ride_service_price->id }}_fixed" required
                                       id="fixed" placeholder="Base Price">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="distance" class="col-xs-12 col-form-label">@lang('admin.service.Base_Distance')
                                ({{ distance() }})</label>
                            <div class="col-xs-10">
                                <input class="form-control" type="text" value="{{ $ride_service_price->distance }}"
                                       name="{{ $ride_service_price->id }}_distance"
                                       required id="distance" placeholder="Base Distance">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="minute"
                                   class="col-xs-12 col-form-label">@lang('admin.service.unit_time')</label>
                            <div class="col-xs-10">
                                <input class="form-control" type="text" value="{{ $ride_service_price->minute }}"
                                       name="{{ $ride_service_price->id }}_minute"
                                       required
                                       id="minute" placeholder="Unit Time Pricing">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-xs-12 col-form-label">@lang('admin.service.unit')
                                ({{ distance() }}
                                )</label>
                            <div class="col-xs-10">
                                <input class="form-control" type="text" value="{{ $ride_service_price->price }}"
                                       name="{{ $ride_service_price->id }}_price" required
                                       id="price" placeholder="Unit Distance Price">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="distance" class="col-xs-12 col-form-label">@lang('admin.service.Max_Distance')
                                ({{ distance() }})</label>
                            <div class="col-xs-10">
                                <input class="form-control" type="text" value="{{ $ride_service_price->max_distance }}"
                                       name="{{ $ride_service_price->id }}_max_distance"
                                       required id="distance" placeholder="Max Distance">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-xs-12 col-form-label">@lang('admin.service.Max_Price')
                                ({{ currency() }})</label>
                            <div class="col-xs-10">
                                <input class="form-control" type="text"
                                       value="{{ $ride_service_price->max_distance_price }}"
                                       name="{{ $ride_service_price->id }}_max_distance_price" required
                                       id="price" placeholder="Max Distance Price">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="calculator"
                                   class="col-xs-12 col-form-label">@lang('admin.service.Pricing_Logic')</label>
                            <div class="col-xs-10">
                                <select class="form-control" id="calculator"
                                        name="{{ $ride_service_price->id }}_calculator">
                                    <option value="MIN">@lang('servicetypes.MIN')</option>
                                    <option value="HOUR">@lang('servicetypes.HOUR')</option>
                                    <option value="DISTANCE">@lang('servicetypes.DISTANCE')</option>
                                    <option value="DISTANCEMIN">@lang('servicetypes.DISTANCEMIN')</option>
                                    <option value="DISTANCEHOUR">@lang('servicetypes.DISTANCEHOUR')</option>
                                </select>
                            </div>
                        </div>

                    @endforeach
                    <div class="form-group row">
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <a href="{{route('admin.service.index')}}"
                               class="btn btn-danger btn-block">@lang('admin.cancel')</a>
                        </div>
                        <div class="col-xs-12 col-sm-6 offset-md-6 col-md-3">
                            <button type="submit"
                                    class="btn btn-primary btn-block">@lang('admin.service.Update_Service_Type')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection