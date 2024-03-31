@extends('adminlte::page')

@section('title', 'Manage Rental')

@section('content')

    <div class="container-fluid py-3">
        <div class="d-flex w-100">
            <div class="card w-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4>Rental</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Drop Location </th>
                                <th>Pick Location</th>
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
                                    <td>{{ $rental->dropLocation?->address }}</td>
                                    <td>{{ $rental->pickLocation?->address }}</td>
                                    <td>{{ $rental->vehicle?->vehicle_name }}</td>
                                    <td>{{ $rental->user?->name }}</td>
                                    <td>{{ $rental->total_cost }}</td>
                                    <td>{{ $rental->rental_status }}</td>
                                    <td>
                                        <a href="{{ route('rentals.edit', $rental->id) }}"
                                           class="btn btn-outline-primary">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
