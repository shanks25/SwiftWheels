@extends('admin.layout.base')

@section('title', 'Update Ride Type ')

@section('content')
    <div class="content-area py-1">
        <div class="container-fluid">
            <div class="box box-block bg-white">
                <a href="{{ route('admin.rides.index') }}" class="btn btn-default pull-right"><i
                            class="fa fa-angle-left"></i> @lang('admin.back')</a>

                <h5 style="margin-bottom: 2em;">@lang('admin.service.Update_User')</h5>

                <form class="form-horizontal" action="{{route('admin.rides.update', $ride->id )}}" method="POST"
                      enctype="multipart/form-data" role="form">

                    {{csrf_field()}}

                    <input type="hidden" name="_method" value="PATCH">

                    <div class="form-group row">
                        <label for="name" class="col-xs-2 col-form-label">Ride Type Name</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ $ride->name }}" name="name" required
                                   id="name" placeholder="Ride Type Name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-xs-2 col-form-label">Ride Type Description</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ $ride->description }}" name="description"
                                   required
                                   id="description" placeholder="Ride Type description">
                        </div>
                    </div>

                    <div class="form-group row">

                        <label for="image" class="col-xs-2 col-form-label">@lang('admin.picture')</label>
                        <div class="col-xs-10">
                            @if(isset($ride->image))
                                <img style="height: 90px; margin-bottom: 15px; border-radius:2em;"
                                     src="{{ url('storage/' . $ride->image) }}">
                            @endif
                            <input type="file" accept="image/*" name="image" class="dropify form-control-file"
                                   id="image" aria-describedby="fileHelp">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <a href="{{route('admin.rides.index')}}"
                               class="btn btn-danger btn-block">@lang('admin.cancel')</a>
                        </div>
                        <div class="col-xs-12 col-sm-6 offset-md-6 col-md-3">
                            <button type="submit"
                                    class="btn btn-primary btn-block">Update Ride Type
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection