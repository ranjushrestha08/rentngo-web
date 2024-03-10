@extends('adminlte::page')

@section('title', 'Vehicles')

@section('content_header')
<h1>Vehicles</h1>
@stop

@section('content')
<a class="btn btn-primary" href="{{route('vehicles.create')}}">+ ADD</a>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vehicles as $vehicle)
                        <tr>
                            <td>{{ $vehicle->id }}</td>
                            <td><img width=100 src="{{asset($vehicle->image_url)}}" alt=""></td>
                            <td>{{ $vehicle->name }}</td>
                            <td>
                                <a class="mx-1" href="{{ route('vehicles.show', $vehicle->id) }}"
                                    class="btn btn-primary btn-sm">View</a>
                                <a class="mx-1" href="{{ route('vehicles.edit', $vehicle->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this vehicle?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop