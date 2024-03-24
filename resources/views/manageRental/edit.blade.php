@extends('adminlte::page')

@section('title', 'Edit Rental')

@section('content_header')
    <h1>Edit Rental</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('rentals.update', $rental->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="start_date">Start Date:</label>
                            <input type="text" class="form-control" id="start_date" name="start_date" value="{{ $rental->start_date }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date:</label>
                            <input type="text" class="form-control" id="end_date" name="end_date" value="{{ $rental->end_date }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="drop_location_id">Drop Location ID:</label>
                            <input type="text" class="form-control" id="drop_location_id" name="drop_location_id" value="{{ $rental->drop_location_id }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="pick_location_id">Pick Location ID:</label>
                            <input type="text" class="form-control" id="pick_location_id" name="pick_location_id" value="{{ $rental->pick_location_id }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="vehicle_id">Vehicle ID:</label>
                            <input type="text" class="form-control" id="vehicle_id" name="vehicle_id" value="{{ $rental->vehicle_id }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="user_id">User ID:</label>
                            <input type="text" class="form-control" id="user_id" name="user_id" value="{{ $rental->user_id }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="total_cost">Total Cost:</label>
                            <input type="text" class="form-control" id="total_cost" name="total_cost" value="{{ $rental->total_cost }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="rental_status">Rental Status</label>
                            <select name="rental_status" id="rental_status" class="form-control">
                                <option value="pending" {{ $rental->rental_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="ongoing" {{ $rental->rental_status === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                <option value="completed" {{ $rental->rental_status === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="canceled" {{ $rental->rental_status === 'canceled' ? 'selected' : '' }}>Canceled</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
