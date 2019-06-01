@extends('admin.layout.base')

@section('title', 'Ride Types ')

@section('content')
    <div class="content-area py-1">
        <div class="container-fluid">
            <div class="box box-block bg-white">
                <h5 class="mb-1">Outstation</h5>
                <a href="{{ route('admin.outstations.create') }}" style="margin-left: 1em;"
                   class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New Out Station</a>
                <table class="table table-striped table-bordered dataTable" id="table-2">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Outstation Name</th>
                        <th>Outstation Lat/Lon</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($outstations as $index => $outstation)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $outstation->name }}</td>
                            <td>{{ $outstation->address }}</td>
                            <td>{{ $outstation->latitude  . ' / ' . $outstation->longitude }}</td>
                            <td>
                                <form action="{{ route('admin.outstations.destroy', $outstation->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <a href="{{ route('admin.outstations.edit', $outstation->id) }}"
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
                        <th>Outstation Name</th>
                        <th>Outstation Lat/Lon</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection