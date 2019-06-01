@extends('admin.layout.base')

@section('title', 'Add Ride Type ')

@section('content')
    <div class="content-area py-1">
        <div class="container-fluid">
            <div class="box box-block bg-white">
                <a href="{{ route('admin.rides.index') }}" class="btn btn-default pull-right"><i
                            class="fa fa-angle-left"></i> @lang('admin.back')</a>

                <h5 style="margin-bottom: 2em;">Add Ride Type</h5>

                <form class="form-horizontal" action="{{route('admin.rides.store')}}" method="POST"
                      enctype="multipart/form-data" role="form">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label for="name" class="col-xs-12 col-form-label">Ride Type Name</label>
                        <div class="col-xs-10">
                            <input class="form-control" type="text" value="{{ old('name') }}" name="name" required
                                   id="name" placeholder="Service Name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description"
                               class="col-xs-12 col-form-label">Ride Type Description</label>
                        <div class="col-xs-10">
                            <textarea class="form-control" type="number" value="{{ old('description') }}"
                                      name="description" required id="description" placeholder="Description"
                                      rows="4"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="picture" class="col-xs-12 col-form-label">
                            Ride Type Image</label>
                        <div class="col-xs-10">
                            <input type="file" accept="image/*" name="image" class="dropify form-control-file"
                                   id="picture" aria-describedby="fileHelp">
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-xs-10">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <a href="{{ route('admin.rides.index') }}"
                                       class="btn btn-danger btn-block">@lang('admin.cancel')</a>
                                </div>
                                <div class="col-xs-12 col-sm-6 offset-md-6 col-md-3">
                                    <button type="submit" class="btn btn-primary btn-block">Add Ride Type</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
