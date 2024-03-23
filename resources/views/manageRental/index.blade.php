@extends('adminlte::page')

@section('title', 'Manage Rental')

@section('content_header')
<h1>Manage Rental</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Drop Location Id</th>
                            <th>Pick Location Id</th>
                            <th>Vehicle Id</th>
                            <th>User Id</th>
                            <th>Total Cost</th>
                            <th>Rental Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rentals as $rental)
                        <tr>
                            <td>{{ $rental->id }}</td>
                            <td>{{ $rental->start_date }}</td>
                            <td>{{ $rental->end_date }}</td>
                            <td>{{ $rental->drop_location_id }}</td>
                            <td>{{ $rental->pick_location_id }}</td>
                            <td>{{ $rental->vehicle_id }}</td>
                            <td>{{ $rental->user_id }}</td>
                            <td>{{ $rental->total_cost }}</td>
                            <td>{{ $rental->rental_status }}</td>
                            <td>
                                <a class="mx-1" href="{{ route('rentals.edit', $rental->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
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