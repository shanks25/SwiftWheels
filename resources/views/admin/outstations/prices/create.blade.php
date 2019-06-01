@extends('admin.layout.base')

@section('title', 'Add OutStations ')

@section('content')
    <div class="content-area py-1">
        <div class="container-fluid">
            <div class="box box-block bg-white">
                <a href="{{ route('admin.outstations_prices.index') }}" class="btn btn-default pull-right"><i
                            class="fa fa-angle-left"></i> @lang('admin.back')</a>

                <h5 style="margin-bottom: 2em;">Add OutStations </h5>

                <form class="form-horizontal" action="{{route('admin.outstations_prices.store')}}" method="POST"
                      enctype="multipart/form-data" role="form">

                    {{ csrf_field() }}

                    <div class="form-group row">
                        <label for="name" class="col-xs-12 col-form-label">First OutStation</label>
                        <div class="col-xs-10">
                            <select class="form-control" name="source_id" required title="First Outstation">
                                @foreach($outstations as $outstation)
                                    <option value="{{ $outstation->id }}">{{ $outstation->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-xs-12 col-form-label">Second OutStation</label>
                        <div class="col-xs-10">
                            <select class="form-control" name="destination_id" required title="First Outstation">
                                @foreach($outstations as $outstation)
                                    <option value="{{ $outstation->id }}">{{ $outstation->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="fixed" class="col-xs-12 col-form-label">@lang('admin.service.Base_Price')
                            ({{ currency() }})</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ old('fixed') }}"
                                   name="fixed" required
                                   id="fixed" placeholder="Base Price">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="distance" class="col-xs-12 col-form-label">@lang('admin.service.Base_Distance')
                            ({{ distance() }})</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ old('distance') }}"
                                   name="distance"
                                   required id="distance" placeholder="Base Distance">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="price" class="col-xs-12 col-form-label">@lang('admin.service.unit')
                            ({{ distance() }})</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ old('price') }}"
                                   name="price" required
                                   id="price" placeholder="Unit Distance Price">
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-xs-10">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <a href="{{ route('admin.outstations_prices.index') }}"
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