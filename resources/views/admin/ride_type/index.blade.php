@extends('admin.layout.base')

@section('title', 'Ride Types ')

@section('content')
    <div class="content-area py-1">
        <div class="container-fluid">
            <div class="box box-block bg-white">
                <h5 class="mb-1">Service Types</h5>
                <a href="{{ route('admin.rides.create') }}" style="margin-left: 1em;"
                   class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New Ride</a>
                <table class="table table-striped table-bordered dataTable" id="table-2">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ride Name</th>
                        <th>Ride Description</th>
                        <th>Ride Image</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rides as $index => $ride)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $ride->name }}</td>
                            <td>{{ $ride->description }}</td>
                            <td>
                                @if($ride->image)
                                    <img src="{{ url('storage/' . $ride->image) }}" style="height: 50px">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.rides.destroy', $ride->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <a href="{{ route('admin.rides.edit', $ride->id) }}"
                                       class="btn btn-info btn-block">
                                        <i class="fa fa-pencil"></i> Edit
                                    </a>
                                    <button class="btn btn-danger btn-block" onclick="return confirm('Are you sure?')">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Ride Name</th>
                        <th>Ride Description</th>
                        <th>Ride Image</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection